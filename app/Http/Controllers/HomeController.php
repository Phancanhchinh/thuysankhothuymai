<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $user = Auth::user()->full_name;
        $role = Auth::user()->role;
        return view('admin.pages.index',compact(['user','role']));
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->back();
    }
}
