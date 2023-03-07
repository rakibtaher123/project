<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::where('status', 1)->latest()->limit(12)->get();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        $sizes = Size::all();
        $colors = Color::all();
        return View('frontend.welcome', compact('product', 'categories', 'subcategories', 'brands', 'units', 'sizes', 'colors'));
    }
    public function view_details($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        $sizes = Size::find($product->size_id);
        $colors = Color::find($product->color_id);
        $cat_id = $product->cat_id;
        $related_product = Product::where('cat_id', $cat_id)->limit(4)->get();
        return View('frontend.pages.product_view', compact('product', 'categories', 'subcategories', 'brands', 'units', 'sizes', 'colors', 'related_product'));
    }
}
