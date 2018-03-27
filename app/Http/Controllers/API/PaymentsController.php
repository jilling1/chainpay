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
            'currency' => 'required',
            'amount' => 'required|numeric',
            'callback_url' => 'url',
        ]);

        $user = User::where('user_token');

        $paymentForwardingObject = app('BlockCypher')->createPaymentEndpoint();

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
