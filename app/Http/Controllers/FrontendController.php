<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function shop()
    {
        return view('frontend.shop');
    }

    public function about()
    {
        return view('frontend.about');
    }   

    public function contact()
    {
        return view('frontend.contact');
    }
}
