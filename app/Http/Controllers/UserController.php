<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function accountSettings(){
        return view('user.account_settings');
    }

    public function companyInfo(){
        \Hash::make('111111');
        return view('user.company_info');
    }

    public function saveWalletsAddresses(Request $request){
        $request->validate([
            'btc' => 'sometimes|size:34',
            'doge' => 'sometimes|size:34',
            'ltc' => 'sometimes|size:34'
        ]);
        $request->user()->fill([
            'btc_address' => $request->get('btc_address'),
            'doge_address' => $request->get('doge_address'),
            'ltc_address' => $request->get('ltc_address')
        ])->save();
    }

    public function saveSellerDetails(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required',
            'phone_number' => ''
        ]);
        $request->user()->fill([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'company_name' => $request->get('company_name'),
            'phone_number' => $request->get('phone_number')
        ])->save();
    }

    public function saveUserEmail(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        // TODO make email confirmation

        $request->user()->fill([
            'email' => $request->get('email')
        ])->save();
    }

    public function saveUserPassword(Request $request){

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required_with:new_password|same:new_password'
        ]);

        if ( !(\Hash::check($request->get('old_password'), \Auth::user()->password)) ) {
            return response()
                ->json(['message' => 'Current password does not match.'])
                ->setStatusCode(403);
        }

        if(strcmp($request->get('old_password'), $request->get('new_password')) == 0){
            return response()
                ->json(['message' => 'New Password cannot be same as your current password. Please choose a different password.'])
                ->setStatusCode(403);
        }

        $request->user()->fill([
            'password' => \Hash::make($request->get('new_password'))
        ])->save();

        return response()
            ->json(['message' => 'Password changed successfully !']);
    }

}
