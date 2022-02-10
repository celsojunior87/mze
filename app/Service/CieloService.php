<?php

namespace App\Service;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\CreditCard;
use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\Request\CieloRequestException;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Merchant;
use Illuminate\Http\Request;


class CieloService
{

    private $environment;
    private $merchant;
    private $cielo;
    private $sale;
    private $payment;

    public function __construct(Request $request, CardValidationService $cardValidationService)
    {
        $this->cardValidationService = $cardValidationService;

        // Configure o ambiente
        if(env('CIELO_PRODUCTION')){
            $this->environment = Environment::production();
        }else{
            $this->environment = Environment::sandbox();
        }

        // Configure seu merchant
        $this->merchant = new Merchant(config('cielo.MerchantId'), config('cielo.MerchantKey'));

        $this->cielo = new CieloEcommerce($this->merchant, $this->environment);


        // Crie uma instância de Sale informando o ID do pedido na loja
        $this->sale = new Sale('1');


        // Crie uma instância de Payment informando o valor do pagamento
        $this->payment = Payment::PAYMENTTYPE_CREDITCARD;
    }

    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
    private function createSale()
    {
        return ($this->cielo)->createSale($this->sale);
    }

    // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
    private function captureSale($paymentId, $price)
    {
        return ($this->cielo)->captureSale($paymentId, $price, 0);
    }

    //E também podemos fazer seu cancelamento, se for o caso
    private function cancelSale($paymentId, $price)
    {
        return ($this->cielo)->cancelSale($paymentId, $price);;
    }

    // Crie uma instância de Payment informando o valor do pagamento
    private function paymentInit($price)
    {
        return $this->sale->payment($price);
    }

    private function paymentId()
    {
        return $this->createSale()->getPayment()
            ->getPaymentId();
    }

    //Cartao de Credito
    private function creditCard($cvv, $date, $numberCard, $holder, $price)
    {
        // Crie uma instância de Credit Card utilizando os dados de teste
        // esses dados estão disponíveis no manual de integração
        $this->paymentInit($price)->setType($this->payment)
            ->creditCard($cvv, CreditCard::MASTERCARD)
            ->setExpirationDate($date)
            ->setCardNumber($numberCard)
            ->setHolder($holder);
    }

    //Gerar token cartao
    public function getTokenCard($holder, $numberCard, $date)
    {

        try {

            // Configure o ambiente

            // Crie uma instância do objeto que irá retornar o token do cartão

            $brand = $this->cardValidationService->valida_cartao($numberCard);


            $card = new CreditCard();
            $card->setCustomerName($holder);
            $card->setCardNumber($numberCard);
            $card->setHolder($holder);
            $card->setExpirationDate($date);
            $card->setBrand($brand["brand"]);


            try {
                // Configure o SDK com seu merchant e o ambiente apropriado para recuperar o cartão
                $card = (new CieloEcommerce($this->merchant, $this->environment))->tokenizeCard($card);

                // Get the token
                $cardToken = $card->getCardToken();
                return ["token" => $cardToken];
            } catch (CieloRequestException $e) {
                // Em caso de erros de integração, podemos tratar o erro aqui.
                // os códigos de erro estão todos disponíveis no manual de integração.
                $error = $e->getCieloError();

                return response()->json(
                    ["error" => $error, "message"=>"Falha ao cadastrar token de cartão"], 500
                );
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function peyerCreditToken($price, $holder, $cvv, $token)
    {

        $sale = new Sale($price);

        // Crie uma instância de Customer informando o nome do cliente
        $customer = $sale->customer($holder);

        // Crie uma instância de Payment informando o valor do pagamento
        $payment = $sale->payment($price * 100);

        // Crie uma instância de Credit Card utilizando os dados de teste
        // esses dados estão disponíveis no manual de integração
        $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
            ->creditCard($cvv, CreditCard::MASTERCARD)
            ->setCardToken($token);

        // Crie o pagamento na Cielo
        try {
            // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
            $sale = (new CieloEcommerce($this->merchant, $this->environment))->createSale($sale);

            // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
            // dados retornados pela Cielo
            return $sale;
        } catch (CieloRequestException $e) {
            // Em caso de erros de integração, podemos tratar o erro aqui.
            // os códigos de erro estão todos disponíveis no manual de integração.
            $error = $e->getCieloError();
            return response()->json(
                ["error" => $error, "message"=>"Falha ao realizar pagamento"], 500
            );
        }
    }
}
