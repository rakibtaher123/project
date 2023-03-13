<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $result = Customer::where('email', $email)->where('password', $password)->first();
        if ($result) {
            Session::put('id', $result->id);
            return Redirect::to('checkout');
        } else {
            return Redirect::to('login-check');
        }
        // return $request;
    }
    public function registration(Request $request)
    {
        // return $request;
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->password = $request->password;
        $customer->save();
        // return $customer->id;
        Session::put('id', $customer->id);
        Session::put('name', $customer->name);
        return Redirect::to('checkout');
    }
    public function logout()
    {
        Session::flush();
        return Redirect::to('/');
    }
}
