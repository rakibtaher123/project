<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function manage_order()
    {
        $orders = Order::all();
        $customr = Customer::all();
        return view('backend.order.manage_order', compact('orders', 'customr'));
    }

    public function view_order($id)
    {
        $order = Order::find($id);
        $order_by_id = OrderDetail::where('order_id', $id)->get();
        return view('backend.order.view_order', compact('order', 'order_by_id'));
    }
    public function change_status($id)
    {
        $order = Order::find($id);
        if ($order->status == "success") {
            $order->update(['status' => 'pending']);
        } else {
            $order->update(['status' => 'success']);
        }
        return redirect()->back()->with('message', 'order status updated');
    }
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('message', 'order deleted');
    }
}
