<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //direct user home page
    public function userHome($category_id = null) {
        $categories = Category::get();
        $products = Product::with('category')
                    ->when($category_id != null, function($query) use($category_id){
                        $query->where('category_id',$category_id);
                    })
                    ->orderBy('created_at','desc')->get();
        return view('user.home.list',compact('categories','products'));
    }
}
