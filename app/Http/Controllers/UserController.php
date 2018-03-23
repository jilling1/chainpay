<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function accountSettings(){
        return view('user.account_settings');
    }

    public function companyInfo(){
        return view('user.company_info');
    }

    public function saveWalletsAddresses(Request $request){
        $request->validate([
            'btc' => 'sometimes|size:34',
            'doge' => 'sometimes|size:34',
            'ltc' => 'sometimes|size:34'
        ]);
    }

    public function saveSellerDetails(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required',
            'phone_number' => ''
        ]);
    }

    public function saveUserEmail(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        // TODO make email confirmation

        $user = \Auth()->user();
        $user->email = $request->get('email');
        $user->save();
    }

    public function saveUserPassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required_with:new_password|same:new_password'
        ]);
        $this->changePassword($request);
    }

    private function changePassword(Request $request){
        if ( !(\Hash::check($request->get('old_password'), \Auth::user()->password)) ) {
            return response(403)
                ->json(['message' => 'Current password does not match.']);
        }

        if(strcmp($request->get('old_password'), $request->get('new_password')) == 0){
            return response(403)
                ->json(['message' => 'New Password cannot be same as your current password. Please choose a different password.']);
        }

        $user = \Auth::user();
        $user->password = \Hash::make($request->get('new-password'));
        $user->save();

        return response(200)
            ->json(['message' => 'Password changed successfully !']);
    }
}
