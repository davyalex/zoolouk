<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    //
    public function index(){
        return view('site.pages.support.help');
        }
}
