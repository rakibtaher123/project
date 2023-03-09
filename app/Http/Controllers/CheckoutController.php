<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // return 1233;
        return view('frontend.pages.checkout');
    }
    public function login_chcek(){
        return view('frontend.pages.login');
    }
}
