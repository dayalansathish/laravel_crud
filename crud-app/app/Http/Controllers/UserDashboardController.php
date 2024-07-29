<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view("components.UserDashboard", ["products" => $products]);
    }

    public function show($id)
    {
        $product = Product::show($id);
        return view('components.show', ['product' => $product]);
    }
}
