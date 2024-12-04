<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function productDetail($id, $categotyId)
    {

        $product = Product::with('category')->find($id);

        $relatedProduct = Product::with('category')->where('category_id', $categotyId)->get();

        return view('user.home.detail', compact('product', 'relatedProduct'));
    }
}
