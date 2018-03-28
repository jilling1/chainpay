<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function requestCurrency(){

    }

    public function requestPayment(Request $request){
        $request->validate([
            'seller_id' => 'required',
//            'currency' => 'required',
//            'amount' => 'required|numeric',
//            'callback_url' => 'url',
        ]);

        $user = User::where('seller_token', $request->get('seller_id') )->first();

        $paymentForwardingObject = app('BlockCypher')->createPaymentEndpoint($user->btc_address);

        print_r($paymentForwardingObject);

//        $payment = Payment::create([
//
//        ]);
    }

    public function checkPaymentStatus(){

    }

    public function paymentCallback(Request $request){

    }
}
