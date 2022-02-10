<?php

namespace App\Service;

use App\Events\Messages;
use Cielo\API30\Ecommerce\CreditCard;
use Pusher\Pusher;


class CardValidationService
{

    function valida_cartao($cartao)
    {
        $cartao = preg_replace("/[^0-9]/", "", $cartao);

        $cartoes = array(
            CreditCard::VISA => array('len' => array(13, 16), 'cvc' => 3),
            CreditCard::MASTERCARD => array('len' => array(16), 'cvc' => 3),
            CreditCard::DINERS => array('len' => array(14, 16), 'cvc' => 3),
            CreditCard::ELO => array('len' => array(16), 'cvc' => 3),
            CreditCard::AMEX => array('len' => array(15), 'cvc' => 4),
            CreditCard::DISCOVER => array('len' => array(16), 'cvc' => 4),
            CreditCard::AURA => array('len' => array(16), 'cvc' => 3),
            CreditCard::JCB => array('len' => array(16), 'cvc' => 3),
            CreditCard::HIPERCARD => array('len' => array(13, 16, 19), 'cvc' => 3),
        );


        switch ($cartao) {
            case (bool)preg_match('/^(636368|438935|504175|451416|636297)/', $cartao) :
                $bandeira = CreditCard::ELO;
                break;

            case (bool)preg_match('/^(606282)/', $cartao) :
                $bandeira = CreditCard::HIPERCARD;
                break;

            case (bool)preg_match('/^(5067|4576|4011)/', $cartao) :
                $bandeira = CreditCard::ELO;
                break;

            case (bool)preg_match('/^(3841)/', $cartao) :
                $bandeira = CreditCard::HIPERCARD;
                break;

            case (bool)preg_match('/^(6011)/', $cartao) :
                $bandeira = CreditCard::DISCOVER;
                break;

            case (bool)preg_match('/^(622)/', $cartao) :
                $bandeira = CreditCard::DISCOVER;
                break;

            case (bool)preg_match('/^(301|305)/', $cartao) :
                $bandeira = CreditCard::DINERS;
                break;

            case (bool)preg_match('/^(34|37)/', $cartao) :
                $bandeira = CreditCard::AMEX;
                break;

            case (bool)preg_match('/^(36,38)/', $cartao) :
                $bandeira = CreditCard::DINERS;
                break;

            case (bool)preg_match('/^(64,65)/', $cartao) :
                $bandeira = CreditCard::DISCOVER;
                break;

            case (bool)preg_match('/^(50)/', $cartao) :
                $bandeira = CreditCard::AURA;
                break;

            case (bool)preg_match('/^(35)/', $cartao) :
                $bandeira = CreditCard::JCB;
                break;

            case (bool)preg_match('/^(60)/', $cartao) :
                $bandeira = CreditCard::HIPERCARD;
                break;

            case (bool)preg_match('/^(4)/', $cartao) :
                $bandeira = CreditCard::VISA;
                break;

            case (bool)preg_match('/^(5)/', $cartao) :
                $bandeira = CreditCard::MASTERCARD;
                break;
        }


        $dados_cartao = $cartoes[$bandeira];
        if(!is_array($dados_cartao)) return array(false);


        return ["brand" => $bandeira];
    }
}
