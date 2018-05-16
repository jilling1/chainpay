<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class GenericController extends Controller
{
    public function introPage(){
        return view('intro_page');
    }
}
