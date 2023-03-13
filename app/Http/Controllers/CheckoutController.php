<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function index()
    {
        $id = Session::get('id');
        $customer_id = Customer::find($id);

        // return 1233;
        return view('frontend.pages.checkout', compact('customer_id'));
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
        $sid = $shiping->id;
        // return $sid;
        Session::put('sid', $sid);
        return Redirect::to('/payment');
    }
    public function payment()
    {
        return view('frontend.pages.payment');
    }
    public function order_place(Request $request)
    {
        $payment = new Payment;
        $payment->payment_method = $request->payment;
        $payment->save();
        Session::put('pid', $payment->id);

        $order = new Order;
        $order->cus_id = Session::get('id');
        $order->ship_id = Session::get('sid');
        $order->pay_id = Session::get('pid');
        $order->total = Cart::getTotal();
        $order->status = 'pending';
        $order->save();
        $order_id = $order->id;
        Session::put('oid', $order_id);

        $cartCollection = Cart::getContent();
        foreach ($cartCollection as $item){
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order_id;
            $orderDetail->product_id = $item->id;
            $orderDetail->product_name = $item->name;
            $orderDetail->product_price = $item->price;
            $orderDetail->product_sales_qty = $item->quantity;
            $orderDetail->save();
        }
        if ($request->payment=='cash'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }else if ($request->payment=='bkash'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }else if ($request->payment=='nogod'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }else if ($request->payment=='rocket'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }

        // return $request;
    }
}
