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
    public $btcAPIContext;
    private $dogeAPIContext;
    private $ltcAPIContext;

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

    public function createPaymentEndpoint($destination)
    {
        $context = 'btc' . 'APIContext';
        $apiContext = $this->$context;
        $paymentForwardClient = new PaymentForwardClient($apiContext);
        $options = array(
            'callback_url' => env('APP_URL') . '/' . route('request-payment'),
            'process_fees_address' => env('FEES_ADDRESS'),
            'process_fees_percent' => env('FEE_PERCENT')
        );
        $paymentForwardObject = $paymentForwardClient->createForwardingAddress($destination, $options);
        dd($paymentForwardObject);
    }

    public function createAddressEndpoint()
    {
        $addressClient = new AddressClient($this->btcAPIContext);
        $addressKeyChain = $addressClient->generateAddress();
        return $addressKeyChain;
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