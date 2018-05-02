<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function payments(){
        return view('payments.payments');
    }

    public function paymentsQuery(Request $request){

        $user = \Auth::user();
        $payments = Payment::where('user_id', $user->id);

        if( $request->get('search')['value'] ){
            $search = $request->get('search')['value'];
            $payments
                ->where('payment_forwarding_address', $search)
                ->orWhere('payment_token', $search);
        }

        $data['recordsFiltered'] = $payments->count();

        $payments = $payments
            ->skip( $request->get('start') )
            ->take( $request->get('length') );

        $sortColumn = $request->get('order')[0]['column'];
        $dir = $request->get('order')[0]['dir'];
        $column = $request->get('columns')[$sortColumn]['name'];

        $payments = $payments
            ->orderByRaw("LENGTH($column) $dir")
            ->orderBy($column, $dir)
            ->get();

        $data['recordsTotal'] = $user->payments->count();
        $data['data'] = $payments;

        return $data;
    }
}
