<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function index()
    {
        // $id = Session::get('id');
        // $customer = Customer::find($id);

        // return 1233;
        return view('frontend.pages.checkout');
    }
    public function login_chcek()
    {
        return view('frontend.pages.login');
    }
    public function shiping_address(Request $request)
    {
        $shiping = new Shipping;
        $shiping->name = $request->name;
        $shiping->email = $request->email;
        $shiping->address = $request->address;
        $shiping->city = $request->city;
        $shiping->country = $request->country;
        $shiping->zip_code = $request->zip_code;
        $shiping->mobile = $request->mobile;
        $shiping->save();
        Session::put('id', $shiping->id);
        return Redirect::to('/payment');
    }
    public function payment()
    {
        return view('frontend.pages.payment');
    }
    public function order_place(Request $request){
        $order_place = new Payment;
        $order_place->payment_method = $request->payment;
        $order_place->save();
        Session::put('id', $order_place->id);
        return redirect()->back();
        return $request;

    }
}
