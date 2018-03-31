<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function payments(){
        $user = \Auth::user();
        $payments = $user->payments;
        return view('payments.payments', compact('payments'));
    }
}
