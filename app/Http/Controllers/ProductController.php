<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index()
    {
        //this returns all the products (can shorten it if needed)
        $products = Product::all();
        return view('product-page', compact('products'));

        

    }

    public function show() {
        //not needed right now
    }
}
