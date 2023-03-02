<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        // return 123;
        return view('backend.admin_login');
    }

    public function dashboard()
    {
        $this->AdminAuthCheck();
        return view('backend.dashboard');
    }

    public function show_dashboard(Request $request)
    {

        $email = $request->email;
        $password = md5($request->password);
        $result = Admin::where('email', $email)->where('password',$password)->first();
        if ($result) {
            Session::put('id', $result->id);
            Session::put('name', $result->name);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message',"invalid email or password");
            return Redirect::back();
        }
    }

    public function logout(){
        Session::flush();
        return Redirect::to('/admin');
    }

    public function AdminAuthCheck(){
        $admin_id = Session::get('id');
        if($admin_id){
            return;
        }
        else{
            return Redirect::to('/admin')->send();
        }
        return $admin_id;

    }
}
