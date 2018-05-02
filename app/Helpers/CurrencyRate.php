<?php

namespace App\Helpers;

class CurrencyRate
{

    public function __construct()
    {
        $this->url = 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,DOGE,LTC&tsyms=USD';
    }

    private $url;

    public $btc;
    public $doge;
    public $ltc;

    public function getRate($currency){
        if( empty($this->btc) || empty($this->doge) || empty($this->ltc) ){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $response = json_decode(curl_exec($ch));
            curl_close($ch);
            $this->btc = $response->BTC->USD;
            $this->doge = $response->DOGE->USD;
            $this->ltc = $response->LTC->USD;
        }

        switch($currency){
            case 'btc':
                return $this->btc;
                break;
            case 'doge':
                return $this->doge;
                break;
            case 'ltc':
                return $this->ltc;
                break;
            default:
                return null;
        }
    }

    public function getAmountRate( $currency, $amount ){

        $amount *= 100000000;

        switch($currency){
            case 'btc':
                return $this->getRate('btc') * $amount;
                break;
            case 'doge':
                return $this->getRate('doge') * $amount;
                break;
            case 'ltc':
                return $this->getRate('ltc') * $amount;
                break;
            default:
                return null;
        }
    }

}