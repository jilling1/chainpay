<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sellers(){
        return view('admin.sellers');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function sellersQuery(Request $request){
        $users = new User();
        $data['recordsFiltered'] = $users->count();
        $users = $users::skip( $request->get('start') )
            ->take( $request->get('length') );
        $users = $users->get();
        $data['recordsTotal'] = User::count();
        $data['data'] = $users;
        return $data;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payments(){
        return view('admin.payments');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function paymentsQuery(Request $request){

        $payments = Payment::with('user');

        if( $request->get('search')['value'] ){
            $search = $request->get('search')['value'];
            $payments
                ->where('payment_forwarding_address', $search)
                ->orWhere('payment_token', $search)
                ->orWhereHas('user', function($query) use ($search){
                    $query->where(DB::raw('concat(first_name," ",last_name)') , 'LIKE' , '%'.$search.'%')
                        ->orWhere('seller_token', '=', $search);
                });
        }

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

        $data['recordsFiltered'] = Payment::count();
        $data['recordsTotal'] = $payments->count();
        $data['data'] = $payments->flatten()->toArray();

        return $data;
    }

}
