<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('backend.product.index', compact('product', 'categories', 'subcategories', 'brands', 'units', 'sizes', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('backend.product.create', compact('categories', 'subcategories', 'brands', 'units', 'sizes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->cat_id = $request->cat_id;
        $product->subcat_id = $request->subcat_id;
        $product->brand_id = $request->brand_id;
        $product->unit_id = $request->unit_id;
        $product->size_id = $request->size_id;
        $product->color_id = $request->color_id;
        $product->description = $request->description;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $images = array();
        if ($files = $request->file('file')) {
            // return $files;
            $i = 0;
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $fileNameExtract = explode('.', $name);
                $fileName = $fileNameExtract[0];
                $fileName .= time();
                $fileName .= $i;
                $fileName .= '.';
                $fileName .= $fileNameExtract[1];
                $file->move('image', $fileName);
                $images[] = $fileName;
                $i++;
                // return $i;
            }
            // return $images;
            $product['image'] = implode("|", $images);
            $product->save();
        } else {
            echo 'Error';
        }
        return redirect()->back()->with('message', 'added product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function change_status(Product $product)
    {
        if ($product->status == 1) {
            $product->update(['status' => 0]);
        } else {
            $product->update(['status' => 1]);
        }
        return redirect()->back()->with('message', 'product status updated ');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $units = Unit::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('backend.product.edit', compact('product', 'categories', 'subcategories', 'brands', 'units', 'sizes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->code = $request->code;
        $product->name = $request->name;
        if (isset($request->cat_id)) {
            $product->cat_id = $request->cat_id;
        } else if (isset($request->subcat_id)) {
            $product->subcat_id = $request->subcat_id;
        } else if (isset($request->brand_id)) {
            $product->brand_id = $request->brand_id;
        } else if (isset($request->unit_id)) {
            $product->unit_id = $request->unit_id;
        } else if (isset($request->size_id)) {
            $product->size_id = $request->size_id;
        } else if (isset($request->color_id)) {
            $product->color_id = $request->color_id;
        }

        $product->description = $request->description;


        $product->price = $request->price;
        $product->discount = $request->discount;
        $images = array();
        if ($files = $request->file('file')) {
            // return $files;
            $i = 0;
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $fileNameExtract = explode('.', $name);
                $fileName = $fileNameExtract[0];
                $fileName .= time();
                $fileName .= $i;
                $fileName .= '.';
                $fileName .= $fileNameExtract[1];
                $file->move('image', $fileName);
                $images[] = $fileName;
                $i++;
                // return $i;
            }
            // return $images;
            $product['image'] = implode("|", $images);
        }
        $product->update();
        return redirect('/products')->with('message', "updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/products')->with('message', "deleted");
    }
}
