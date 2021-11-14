<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('home.home', compact('data'));
    }
}
