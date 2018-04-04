<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function createAddress(){
        echo '<pre>';
        print_r ( app('BlockCypher')->createAddressEndpoint() );
        return '';
    }

    public function testingApi(){
        return view('test.api');
    }
}
