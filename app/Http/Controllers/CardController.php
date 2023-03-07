<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CardController extends Controller
{
    public function add_to_card(Request $request)
    {
        // return $request;
        $qty = $request->quantity;
        $id = $request->id;
        $products = Product::where('id', $id)->first();
        $data['quantity'] = $qty;
        $data['id'] = $products->id;
        $data['name'] = $products->name;
        $data['price'] = $products->price - $products->discount;
        $data['attributes'] = $products;

        Cart::add($data);
        cardArray();
        return redirect()->back();
    }
}
