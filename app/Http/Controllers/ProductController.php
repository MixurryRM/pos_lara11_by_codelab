<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //create product
    public function create()
    {
        $categories = Category::get();
        return view('admin.product.create', compact('categories'));
    }

    //product list page
    public function productListPage()
    {
        $products = Product::when(request('searchKey'), function ($query) {
            $query->where(function ($q) {
                $searchKey = '%' . request('searchKey') . '%';
                $q->whereAny(['products.name', 'categories.name'], 'like', $searchKey);
            });
        })
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('created_at', 'desc')->paginate(8);
        return view('admin.product.list', compact('products'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'required|unique:products,name',
            'category_id' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|max:999',
            'description' => 'required|max:2000',
        ]);

        if ($request->hasFile('image')) {
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('product'), $fileName);
            $fields['image'] = $fileName;
        }

        Product::create($fields);

        Alert::success('Product Create', 'Product Created Successfully!');

        return back();
    }
}
