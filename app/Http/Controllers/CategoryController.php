<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 12313;
        $category = Category::all();
        return View('backend.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        // laravel functionality path is storage->app->'category(all images)' {{limitation not work multiple images}}
        $category->image = $request->image->store('category');

        // if($request->hasFile('image')){
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = $category->name.'.'.$extension;
        //     $file->move('category', $filename);
        //     $category->image = $filename;
        // }
        $category->save();
        return redirect()->back()->with('message', 'added category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function change_status(Category $category)
    {
        return $category;
        if ($category->status == 1) {
            $category->update(['status' => 0]);
        } else {
            $category->update(['status' => 1]);
        }
        return redirect()->back()->with('message', 'category status updated successfully');
    }
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // return $category;
        return View('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        if ($request->image) {
            $category->image = $request->image->store('category');
        }
        $category->save();
        return redirect('/categories')->with('message', "updated");
        // return $request->file('image')->store('category');
        // $update = $category->update([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'image' => $request->file('image')->store('category'),
        // ]);
        // if($update)
        // {
        //     return redirect('/categories')->with('message', "updated");
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Category::find($id);
        $delete->delete();
        return redirect('/categories')->with('message', "deleted");
    }
}
