<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function payments(){
//        $user = \Auth::user();
//        $payments = $user->payments->sortBy('createdAt');
        return view('payments.payments');
    }

    public function paymentsQuery(Request $request){

        $user = \Auth::user();

        if( $request->get('search')['value'] ){
            $search = $request->get('search')['value'];
            $payments = $user->payments
                ->where('payment_forwarding_address', $search)
                ->orWhere('payment_token', $search);
        }else{
            $payments = $user->payments;
        }



        $data['recordsTotal'] = $payments->count();
        $data['recordsFiltered'] = $data['recordsTotal'];
        $data['data'] = $payments->sortBy('createdAt');

        return $data;
    }
}
