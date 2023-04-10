<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $top_sales = DB::table('products')
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('products.id, SUM(order_details.product_sales_qty) as total')
            ->groupBy('products.id')
            ->orderBy('total', 'desc')
            ->take(8)
            ->get();
        $topProducts = [];
        foreach ($top_sales as $s) {

            $p = Product::findOrFail($s->id);
            // return $p->totalQty=$s->total;
            $p->totalQty = $s->total;
            $topProducts[] = $p;
        }
        // return $topProducts;
        $banners = Banner::where('status',1)->orderBy('updated_at','desc')->limit(3)->get();

        return response()->json([
            "success" => true,
            "message" => "all product get successfully.",
            "data" => [
                "product" => $product,
                "categories" => $categories,
                "subcategories" => $subcategories,
                "topProducts" => $topProducts,
            ]
        ]);
        return View('frontend.welcome', compact('product', 'categories', 'subcategories', 'brands', 'units', 'sizes', 'colors', 'topProducts','banners'));
    }
    public function view_details($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        // $sizes = Size::find($product->size_id);
        // $colors = Color::find($product->color_id);
        // $cat_id = $product->cat_id;
        // $related_product = Product::where('cat_id', $cat_id)->limit(4)->get();
        return response()->json([
            "success" => true,
            "message" => "view_details product get successfully.",
            "data" => [
                "product" => $product,
                "categories" => $categories,
                "subcategories" => $subcategories,
            ]
        ]);
        return View('frontend.pages.product_view', compact('product', 'categories', 'subcategories', 'brands', 'units', 'sizes', 'colors', 'related_product'));
    }
    public function product_by_cat($id)
    {
        $product = Product::where('status', 1)->where('cat_id', $id)->limit(12)->get();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('frontend.pages.product_by_cat', compact('product', 'categories', 'subcategories', 'brands'));
    }
    public function product_by_subcat($id)
    {
        $product = Product::where('status', 1)->where('subcat_id', $id)->limit(12)->get();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('frontend.pages.product_by_subcat', compact('product', 'categories', 'subcategories', 'brands'));
    }
    public function product_by_brand($id)
    {
        $product = Product::where('status', 1)->where('brand_id', $id)->limit(12)->get();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('frontend.pages.product_by_brand', compact('product', 'categories', 'subcategories', 'brands'));
    }

    public function search(Request $request)
    {
        // return $request;

        $product = Product::orderBy('id', 'Desc')->where('name', 'LIKE', '%' . $request->product . '%');
        if ($request->category != 'ALL') {
            $product->where('cat_id', $request->category);
        }

        $product = $product->get();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('frontend.pages.product_by_cat', compact('product', 'categories', 'subcategories', 'brands'));
    }
    public function productAjax(){
        $products = Product::select('name')->where('status',1)->get();
        $data=[];
        foreach($products as $p){
            $data[]=$p['name'];
        }
        return $data;
    }
}
