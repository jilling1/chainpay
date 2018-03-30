<?php

namespace App\Http\Controllers\API;

use App\Models\Currency;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function requestCurrency()
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentCreate(Request $request)
    {
        $request->validate([
            'seller_token' => 'required',
            'currency' => 'required',
            'amount' => 'required|numeric',
            'callback_url' => 'url'
        ]);

        if ( !in_array($request->get('currency'), ['btc', 'doge', 'ltc']) )
            return response()->json($this->getErrorArray('Currency not found'));

        $currency = Currency::where('currency_code', $request->get('currency'))->first();
        if (empty($currency)) return response()->json($this->getErrorArray('Currency not found'));

        $user = User::where('seller_token', $request->get('seller_token'))->first();
        if (empty($user)) return response()->json($this->getErrorArray('User not found'));

        $currencyFieldName = $currency->currency_code . '_address';
        if (empty($user->$currencyFieldName)) return response()->json($this->getErrorArray('User does not have a wallet'));

        app('BlockCypher')->currency = $currency->currency_code;
        $paymentForwardingObject = app('BlockCypher')->createPaymentEndpoint($user->btc_address);

        $payment = Payment::create([
            'payment_forwarding_address' => $paymentForwardingObject->input_address,
            'status' => Payment::AWAIT,
            'payed' => 0,
            'user_id' => $user->id,
            'currency_id' => $currency->id,
            'full_Amount' => $request->get('amount'),
            'payment_token' => str_random(16),
            'pay_id' => $paymentForwardingObject->id,
            'callback_url' => $request->get('callback_url')
        ]);

        $data = [
            'address' => $payment->payment_forwarding_address,
            'amount' => $payment->full_Amount,
            'payment_token' => $payment->payment_token
        ];

        return response()->json($this->getSuccessResponse($data));
    }

    /**
     * @param $message
     * @return array
     */
    private function getErrorArray($message)
    {
        return [
            'status' => 'error',
            'error' => $message,
            'data' => null
        ];
    }

    /**
     * @param $data
     * @return array
     */
    private function getSuccessResponse($data)
    {
        return [
            'status' => 'success',
            'error' => null,
            'data' => $data
        ];
    }

    /**
     * @param $paymentToken
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentStatus($paymentToken)
    {
        $payment = Payment::where('payment_token', $paymentToken)->first();
        if(empty($payment)) return response()->json($this->getErrorArray('Payment not found'));

        $data = [
            'status' => Payment::$status[$payment->status],
            'payed' => $payment->payed,
            'full_amount' => $payment->full_amount,
            'payment_forwarding_address' => $payment->payment_forwarding_address
        ];
        return response()->json($this->getSuccessResponse($data));
    }

    public function paymentCallback(Request $request)
    {

    }


}
