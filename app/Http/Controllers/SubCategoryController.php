<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategory = SubCategory::all();
        $categories = Category::all();
        return view('backend.subcategory.index', compact('categories', 'subCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subCategory = new SubCategory;
        $subCategory->name = $request->name;
        $subCategory->cat_id = $request->cat_id;
        $subCategory->description = $request->description;
        $subCategory->save();
        return redirect()->back()->with('message', 'added sub category');
        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function change_status($id)
    {
        $subCategory = SubCategory::find($id);
        if ($subCategory->status == 1) {
            $subCategory->update(['status' => 0]);
        } else {
            $subCategory->update(['status' => 1]);
        }
        return redirect()->back()->with('message', 'SubCategory status updated');
    }

    public function show($id)
    {
        // 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory = SubCategory::find($id);
        $categories = Category::all();
        return View('backend.subcategory.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->name = $request->name;
        if (isset($request->cat_id)) {
            $subCategory->cat_id = $request->cat_id;
        }
        $subCategory->description = $request->description;
        $subCategory->update();
        return redirect()->back()->with('message', 'update sub category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id)->delete();
        return redirect('/subcategories')->with('message', "deleted");
    }
}
