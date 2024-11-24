<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //direct user home page
    public function userHome() {
        $categories = Category::get();
        $products = Product::with('category')->orderBy('created_at','desc')->get();
        return view('user.home.list',compact('categories','products'));
    }
}
