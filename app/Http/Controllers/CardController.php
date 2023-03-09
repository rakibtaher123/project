<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CardController extends Controller
{
    public function add_to_cart(Request $request)
    {
        // return $request;
        $qty = $request->quantity;
        $id = $request->id;
        $products = Product::where('id', $id)->first();
        $data['quantity'] = $qty;
        $data['id'] = $products->id;
        $data['name'] = $products->name;
        $data['price'] = $products->price - $products->discount;
        $data['attributes'] = [$products->image];
        // return $data['attributes'][0];

        Cart::add($data);
        cardArray();
        return redirect()->back();
    }
    public function delete($id)
    {
        // $product = Cart::get($id);
        // if($product->quantity){

        // }
        // return $product->quantity;
        
        // return $id;
        Cart::remove($id);
        return redirect()->back();
    }
}
