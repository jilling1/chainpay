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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generalSettings(){
        return view('admin.settings');
    }

    public function saveGeneralSettings(Request $request){
        $request->validate([
            'fees_percent' => 'numeric|min:0|max:99',
            'btc_fees_address' => 'required',
            'doge_fees_address' => 'required',
            'ltc_fees_address' => 'required',
            'dash_fees_address' => 'required',
            'payment_await_limit' => 'numeric|min:1|max:999999'
        ]);

        $envArray = [];
        if( ($request->get('fees_percent')) !==  env('FEES_PERCENT')||0*100){
            $envArray['FEES_PERCENT'] = $request->get('fees_percent')/100;
        }
        if( $request->get('btc_fees_address') !==  env('BTC_FEES_ADDRESS') ){
            $envArray['BTC_FEES_ADDRESS'] = $request->get('btc_fees_address');
        }
        if( $request->get('doge_fees_address') !==  env('DOGE_FEES_ADDRESS') ){
            $envArray['DOGE_FEES_ADDRESS'] = $request->get('doge_fees_address');
        }
        if( $request->get('ltc_fees_address') !==  env('LTC_FEES_ADDRESS') ){
            $envArray['LTC_FEES_ADDRESS'] = $request->get('ltc_fees_address');
        }
        if( $request->get('dash_fees_address') !==  env('DASH_FEES_ADDRESS') ){
            $envArray['DASH_FEES_ADDRESS'] = $request->get('dash_fees_address');
        }
        if( $request->get('payment_await_limit') !==  env('PAYMENTS_AWAIT_LIMIT_SECONDS') ){
            $envArray['PAYMENTS_AWAIT_LIMIT_SECONDS'] = $request->get('payment_await_limit');
        }
        if( count($envArray) > 0 )
            $this->changeEnv( $envArray );
    }

    private function changeEnv($data = array()){
        if(count($data) > 0){
            $env = file_get_contents(base_path() . '/.env');
            $env = preg_split('/\s+/', $env);
            foreach((array)$data as $key => $value){
                foreach($env as $env_key => $env_value){
                    $entry = explode("=", $env_value, 2);
                    if($entry[0] == $key){
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        $env[$env_key] = $env_value;
                    }
                }
            }
            $env = implode("\n", $env);
            file_put_contents(base_path() . '/.env', $env);
            return true;
        } else {
            return false;
        }
    }

}
