<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Service\CardValidationService;
use Illuminate\Http\Request;
use Cielo\API30\Merchant;

use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\CreditCard;

use Cielo\API30\Ecommerce\Request\CieloRequestException;

class CieloController extends Controller
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

    //Cartao de Debito
    private function debitCard($cvv, $date, $numberCard, $holder, $price)
    {
        // Crie uma instância de Credit Card utilizando os dados de teste
        // esses dados estão disponíveis no manual de integração
        $this->paymentInit($price)->setType($this->payment)
            ->debitCard("123", CreditCard::MASTERCARD)
            ->setExpirationDate("12/2022")
            ->setCardNumber("0000000000000001")
            ->setHolder("Fulano de Tal");
    }

    public function peyerCredit(Request $request)
    {
        // Crie uma instância de Customer informando o nome do cliente
        $this->sale->customer($request->holder);

        // Crie uma instância de Payment informando o valor do pagamento
        $payment = $this->paymentInit($request->price);


        $this->creditCard($request->cvv, $request->date, $request->numberCard, $request->holder, $request->price);

        // Crie o pagamento na Cielo
        try {
            // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
            $this->createSale();
//            return $this->sale;


            // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais dados retornados pela Cielo
            $paymentId = $this->paymentId();
//            return $paymentId;

            // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
            return $this->sale;

//            $total = $request->price;
//            return view('success', compact('total'));

        } catch (CieloRequestException $e) {
            // Em caso de erros de integração, podemos tratar o erro aqui.
            // os códigos de erro estão todos disponíveis no manual de integração.
            $error = $e->getCieloError();
            return $error->getMessage();
//            return view('error', compact('error'));
        }
    }

    public function peyerCreditToken(Request $request)
    {

        $sale = new Sale($request->price);

        // Crie uma instância de Customer informando o nome do cliente
        $customer = $sale->customer($request->holder);

        // Crie uma instância de Payment informando o valor do pagamento
        $payment = $sale->payment($request->price);

        // Crie uma instância de Credit Card utilizando os dados de teste
        // esses dados estão disponíveis no manual de integração
        $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
            ->creditCard($request->cvv, CreditCard::MASTERCARD)
            ->setCardToken($request->token);

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
//            return $error->getMessage();
            return response()->json(
                ["error" => $error, "message"=>"Falha ao realizar pagamento"], 500
            );
        }
    }

    public function peyerDebit(Request $request)
    {
        // Crie uma instância de Customer informando o nome do cliente
        $this->sale->customer($request->holder);

        // Crie uma instância de Payment informando o valor do pagamento
        $payment = $this->paymentInit($request->price);


        $this->creditCard($request->cvv, $request->date, $request->numberCard, $request->holder, $request->price);
        try {
            // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
            $this->createSale();

            // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais dados retornados pela Cielo
            $paymentId = $this->paymentId();
//            return $paymentId;

            // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
            return $this->captureSale($paymentId, $request->price);

//            $total = $request->price;
//            return view('success', compact('total'));
        } catch (CieloRequestException $e) {
            // Em caso de erros de integração, podemos tratar o erro aqui.
            // os códigos de erro estão todos disponíveis no manual de integração.
            $error = $e->getCieloError();
        }
    }


    public function tokenize(Request $request)
    {

        $brand = $this->cardValidationService->valida_cartao($request->numberCard);

        // Configure o ambiente

        // Crie uma instância do objeto que irá retornar o token do cartão

        $card = new CreditCard();
        $card->setCustomerName($request->holder);
        $card->setCardNumber($request->numberCard);
        $card->setHolder($request->holder);
        $card->setExpirationDate($request->date);
        $card->setBrand($brand["brand"]);


        try {
            // Configure o SDK com seu merchant e o ambiente apropriado para recuperar o cartão
            $token = (new CieloEcommerce($this->merchant, $this->environment))->tokenizeCard($card);

            // Get the token
            $cardToken = $token->getCardToken();
            return response()->json(["token" => $cardToken], 200);
        } catch (CieloRequestException $e) {
            // Em caso de erros de integração, podemos tratar o erro aqui.
            // os códigos de erro estão todos disponíveis no manual de integração.
            $error = $e->getCieloError();

            return response()->json([$error], 500);
        }



//        header( "Content-Type: text/html; charset=utf-8" );
//
////        require_once "_global/_erros/erros.ini";
//
//        $dados = array(
//            "MerchantId"  => "3ae9d4f0-3f97-4b5d-bbed-9725cd49b42d",
//            "MerchantKey" => "TOFCEOKNQWMOTTQVGIDITAFEAPJFYRDWUHICNNHG",
//            "MerchantOrderId" => "1",
//            "Authenticate" => true,
//            "sandbox" => false, // Opcional - Ambiente de Testes
//            "debug" => true, // Opcional - Exibe os dados enviados na requisição para a Cielo
//            "Customer" => array(
//                "Name" => "Comprador crédito completo",
//                "Email" => "compradorteste@teste.com",
//                "Birthdate" => "1991-01-02",
//                "Address" => array(
//                    "Street" => "Rua Teste",
//                    "Number" => "123",
//                    "Complement" => "AP 123",
//                    "ZipCode" => "12345987",
//                    "City" => "Rio de Janeiro",
//                    "State" => "RJ",
//                    "Country" => "BRA"
//                ),
//                "DeliveryAddress" => array(
//                    "Street" => "Rua Teste",
//                    "Number" => "123",
//                    "Complement" => "AP 123",
//                    "ZipCode" => "12345987",
//                    "City" => "Rio de Janeiro",
//                    "State" => "RJ",
//                    "Country" => "BRA"
//                )
//            ),
//            "Payment" => array(
//                "Type" => "CreditCard",
//                "Amount" => 15700,
//                "Currency" => "BRL",
//                "Country" => "BRA",
//                "ServiceTaxAmount" => 0,
//                "Installments" => 1,
//                "Interest" => "ByMerchant",
//                "Capture" => true,
//                "Authenticate" => false,
//                "ReturnUrl" => "http://www.hotplateprensas.com.br/retornoCielo.php",
//                "SoftDescriptor" => "123456789ABCD",
//                "CreditCard" => array(
//                    "CardNumber" => "1234123412341231",
//                    "Holder" => "Teste Holder",
//                    "ExpirationDate" => "12/2030",
//                    "SecurityCode" => "123",
//                    "SaveCard" => "false",
//                    "Brand" => "Visa"
//                )
//            ),
//
//        );
//
//        $dadosJson = json_encode( $dados );
//
////        $urlProducao = "https://api.cieloecommerce.cielo.com.br/";
//        $urlSandbox  = "https://apisandbox.cieloecommerce.cielo.com.br/";
//
//        $ch = curl_init( $urlSandbox );
//        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
//        curl_setopt( $ch, CURLOPT_POSTFIELDS, $dadosJson );
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
//        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json',
//            'Content-Length: ' . strlen( $dadosJson ) ) );
////        curl_setopt($ch, CURLOPT_CAINFO, 'ssl/Root.crt');
//        curl_setopt($ch, CURLOPT_SSLVERSION, 4);
//
////        $result = curl_exec( $ch );
//
//        return $ch;
    }
}
