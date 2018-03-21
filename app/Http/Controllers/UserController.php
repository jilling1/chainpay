<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function accountSettings(){

        return view('user.account_settings');
    }

    public function saveSellerDetails(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'company_name' => 'required',
        ]);


    }
}
