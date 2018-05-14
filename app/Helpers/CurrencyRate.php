<?php

namespace App\Helpers;

class CurrencyRate
{

    public function __construct()
    {
        $this->url = 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,DOGE,LTC,DASH&tsyms=USD';
    }

    private $url;

    public $btc;
    public $doge;
    public $ltc;
    public $dash;

    public function getRate($currency){
        if( empty($this->btc) || empty($this->doge) || empty($this->ltc) || empty($this->dash) ){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $response = json_decode(curl_exec($ch));
            curl_close($ch);
            $this->btc = $response->BTC->USD;
            $this->doge = $response->DOGE->USD;
            $this->ltc = $response->LTC->USD;
            $this->dash = $response->DASH->USD;
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
            case 'dash':
                return $this->dash;
                break;
            default:
                return null;
        }
    }

    /**
     * return usd amount
     * @param $currency
     * @param $amount
     * @return float|null
     */
    public function getAmountRate( $currency, $amount ){
        switch($currency){
            case 'btc':
                return round($this->getRate('btc')/100000000 * $amount, 2);
                break;
            case 'doge':
                return round($this->getRate('doge')/100000000 * $amount, 2);
                break;
            case 'ltc':
                return round($this->getRate('ltc')/100000000 * $amount, 2);
                break;
            case 'dash':
                return round($this->getRate('dash')/100000000 * $amount, 2);
                break;
            default:
                return null;
        }
    }

    /**
     *  return cryptocurrency amount
     * @param $currency
     * @param $amount
     * @return float|null
     */
    public function getCurrencyRate( $currency, $amount ){
        switch($currency){
            case 'btc':
                return round( 100000000 / $this->getRate('btc') * $amount );
                break;
            case 'doge':
                return round( 100000000 / $this->getRate('doge') * $amount );
                break;
            case 'ltc':
                return round( 100000000 / $this->getRate('ltc') * $amount );
                break;
            case 'dash':
                return round( 100000000 / $this->getRate('dash') * $amount );
                break;
            default:
                return null;
        }
    }
}