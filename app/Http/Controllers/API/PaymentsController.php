<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    public function checkPaymentStatus(){

    }

    public function paymentCallback(Request $request){

    }
}
