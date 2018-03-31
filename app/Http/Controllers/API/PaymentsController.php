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

        $paymentToken = str_random(16);
        $callback = env('APP_URL'). '/payment-callback' . '?paymentToken=' . $paymentToken;

        app('BlockCypher')->currency = $currency->currency_code;
        $paymentForwardingObject = app('BlockCypher')->createPaymentEndpoint($user->btc_address, $callback);

        $payment = Payment::create([
            'payment_forwarding_address' => $paymentForwardingObject->input_address,
            'status' => Payment::AWAIT,
            'payed' => 0,
            'user_id' => $user->id,
            'currency_id' => $currency->id,
            'full_amount' => (int)$request->get('amount'),
            'payment_token' => $paymentToken,
            'pay_id' => $paymentForwardingObject->id,
            'callback_url' => $request->get('callback_url')
        ]);

        $data = [
            'address' => $payment->payment_forwarding_address,
            'amount' => $payment->full_amount,
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

    public function paymentCallback(Request $request, $paymentToken)
    {
        $payment = Payment::where('payment_token', $paymentToken)->firstOrFail();
        $payment->payed = $payment->payed+$request->get('value');
        if( $payment->payed >= $payment->full_amount ){
            $payment->status = Payment::PAYED;
        }else{
            $payment->status = Payment::PARTLY_PAYED;
        }
        $payment->save();
    }
}

/*  value: 16241000,
    input_address: 'mru16DpRPxUk5cneWGMy3LwyzmQbDYLzN5',
    destination: 'n22KqARet8c4hDjRYuMJJ9WFZwRACbyN6g',
    input_transaction_hash: 'f395a98504525d27ad61fd61186ea1dc0ed968b579f784cfb2b2e5b38f060eee',
    transaction_hash: 'ba1b294ab92cd4482e7559559233787c08a73bccc115dc40aff4d038162aada3'*/