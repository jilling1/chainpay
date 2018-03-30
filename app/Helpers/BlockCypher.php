<?php

namespace App\Helpers;

use BlockCypher\Client\AddressClient;
use BlockCypher\Client\PaymentForwardClient;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Exception\BlockCypherConfigurationException;
use BlockCypher\Rest\ApiContext;
use function MongoDB\BSON\toJSON;

class BlockCypher
{
    private $token;
    private $btcAPIContext;
    private $dogeAPIContext;
    private $ltcAPIContext;

    public $currency;

    /**
     * BlockCypher constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
        $config = ['mode' => 'sandbox'];
        try {
            $this->btcAPIContext = ApiContext::create(env('APP_ENV') === 'local' ? 'test3' : 'main', 'btc', 'v1',
                new SimpleTokenCredential($token),
                $config
            );
            $this->dogeAPIContext = ApiContext::create('main', 'doge', 'v1',
                new SimpleTokenCredential($token),
                $config
            );
            $this->ltcAPIContext = ApiContext::create('main', 'ltc', 'v1',
                new SimpleTokenCredential($token),
                $config
            );
        } catch (BlockCypherConfigurationException $e) {
            dd($e);
        }
    }

    /**
     * @param $destination
     * @return \BlockCypher\Api\PaymentForward
     */
    public function createPaymentEndpoint($destination)
    {
        $apiContext = $this->getApiContext();
        $paymentForwardClient = new PaymentForwardClient($apiContext);
        $options = array(
            'callback_url' => route('request-payment'),
            'process_fees_address' => env('FEES_ADDRESS'),
            'process_fees_percent' => (float)env('FEE_PERCENT')
        );
        $paymentForwardObject = $paymentForwardClient->createForwardingAddress($destination, $options);
        return $paymentForwardObject;
    }

    /**
     * For testing
     * @return \BlockCypher\Api\AddressKeyChain
     */
    public function createAddressEndpoint()
    {
        $addressClient = new AddressClient($this->btcAPIContext);
        $addressKeyChain = $addressClient->generateAddress();
        return $addressKeyChain;
    }

    /**
     * @param $payId
     */
    public function removePaymentEndpoint($payId){
        $apiContext = $this->getApiContext();
        $paymentForwardClient = new PaymentForwardClient($apiContext);
        $paymentForwardClient->deleteForwardingAddress($payId);
    }

    /**
     * @return mixed
     */
    private function getApiContext(){
        $context = $this->currency . 'APIContext';
        return $this->$context;
    }
}

/*
Sender
[private] => df0c105eb1c2d4f8ef6cbfe9d4e91e8b8d3df9161836e35dad1b2f568e1334d4
[public] => 02954efcaf2deb4ca5e7a8a39256c37b7d84df583cef4a890075b35e57dd105f65
[address] => n2JKwnRpis1ByDWmSgCi5ANchVNh31pXEx
[wif] => cV4Gy4xBUBJWNY36SQGSE5cHGqdnYMD8LyhbNryDd3UQs5sWukSj

Destination
[private] => 5506609fe9d3fd4381b9eae58003cfdef7dec04490b116213f003893554b90ca
[public] => 02dda01523dc313ae2f2e84f790cb6657608dddc78134795abac39a7542a78c631
[address] => n22KqARet8c4hDjRYuMJJ9WFZwRACbyN6g
[wif] => cQRyjUDLUdShW7T3UzAytLRdqTqVifNuvZ43fn6y6BVKTcJMPhPk

Fees address
[private] => d323e969d065070ba069378da07a358aa96d4b3ddedb4cf5a68041c3eec75849
[public] => 02b14f021aaa656481a530cbbce3b8877387dfabc9e2f272a4b80d04600e165835
[address] => mkuHeAJcN4M5npcazVcMxeJS7aopEpeRCZ
[wif] => cUf8Y7VQm3DvrVfhnFCSS5gdaSEBGwuiBKYL7qVsAu5Mojc3rMKc
*/

//        [destination] => n22KqARet8c4hDjRYuMJJ9WFZwRACbyN6g
//        [callback_url] => http://127.0.0.1:8000/api/request-payment
//        [process_fees_address] => mkuHeAJcN4M5npcazVcMxeJS7aopEpeRCZ
//        [process_fees_percent] => 0.01
//        [id] => 51384e47-7353-4e5b-b0b5-db011f7b7adb
//        [token] => 55531b01ed804d7e8ac642fed5586b62
//        [input_address] => n42QeEtTLy6c3zBxucbvvTE8hBT4kLZ8DZ