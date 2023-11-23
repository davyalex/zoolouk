<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //home dashboard
    public function index(){
        return view('admin.admin');
        // if (Auth::check()) {
        // }else {
        //    return redirect()->route('auth.login');
        // }
    }

}
