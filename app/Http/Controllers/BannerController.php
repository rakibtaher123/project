<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'title' => 'string | required',
            'description' => 'string',
            'photo' => 'required',
            'condition' => 'nullable |in:Banner,Promo',
            'status' => 'nullable |in:0,1',
        ]);
        $banner = new Banner;
        $banner->title = $request->title;
        $slug = Str::slug($request->title);
        $slug_count = Banner::where('slug', $slug)->count();
        if ($slug_count) {
            $slug .= time() . '-' . $slug;
        }
        $banner->slug = $slug;
        $banner->description = $request->description;
        $banner->photo = $request->photo->store('banner');
        $banner->condition = $request->condition;
        $banner->status = $request->status;

        // $data = $request->all();
        // $slug=Str::slug($request->title);
        // $slug_count = Banner::where('slug', $slug)->count();
        // if ($slug_count){
        //     $slug .=time().'-'.$slug;
        // }
        // $data['slug'] = $slug;
        // $banner = Banner::create($data);
        if ($banner) {
            $banner->save();
            return redirect('banners')->with('message', 'created banner');
        } else {
            return back()->with('error', 'error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status($id)
    {
        $banner = Banner::find($id);
        if ($banner->status == 1) {
            $banner->update(['status' => 0]);
        } else {
            $banner->update(['status' => 1]);
        }
        return redirect()->back()->with('message', 'Banner status updated');
    }
    // public function show($id)
    // {
    //     return $id;
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $banner = Banner::find($id);
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $banner = Banner::find($id);
        $banner->title = $request->title;
        $slug = Str::slug($request->title);
        $slug_count = Banner::where('slug', $slug)->count();
        if ($slug_count) {
            $slug .= $banner->id . '-' . $slug;
        }
        $banner->slug = $slug;
        $banner->condition = $request->condition;
        $banner->status = $request->status;
        if(isset($request->photo)){
            $banner->photo = $request->photo->store('banner');
        }
        // return $banner;
        $banner->update();
        return redirect('/banners')->with('message', "updatedBanner");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::find($id)->delete();
        return redirect()->back()->with('message', 'banner deleted');
    }
}
