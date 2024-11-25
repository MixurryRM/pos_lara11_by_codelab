<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //direct user home page
    public function userHome()
    {
        $categories = Category::get();
        $products = Product::with('category')
            ->when(request('searchKey'), function ($query) {
                $query->where('products.name', 'like', '%' . request('searchKey') . '%');
            })
            ->when(request('categoryId'), function ($query) { //filter by catgory_id
                $query->where('category_id', request('categoryId'));
            })
            ->when(request('minPrice') != null && request('maxPrice') != null, function ($query) { //min == true | max == true
                $query->whereBetween('price', [request('minPrice'), request('maxPrice')]);
            })
            ->when(request('minPrice') != null && request('maxPrice') == null, function ($query) { //min == true | max == false
                $query->where('price', '>=', request('minPrice'));
            })
            ->when(request('maxPrice') != null && request('minPrice') == null, function ($query) { //max == true | min == false
                $query->where('price', '<=', request('maxPrice'));
            })
            ->orderBy('created_at', 'desc')->paginate(8);
        return view('user.home.list', compact('categories', 'products'));
    }
}
