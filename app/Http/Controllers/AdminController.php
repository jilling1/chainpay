<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function sellers(){
        $sellers = User::whereType(User::SELLER)->get();
        return view('admin.sellers', compact('sellers'));
    }

}
