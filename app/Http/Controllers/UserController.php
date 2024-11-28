<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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
            ->when(request('sortingType'), function ($query) {
                $sortRule = explode(",", request(('sortingType')));
                $sortName = 'products.' . $sortRule[0];
                $sortBy = $sortRule[1];
                $query->orderBy($sortName, $sortBy);
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
            ->get();
        return view('user.home.list', compact('categories', 'products'));
    }

    public function editPage()
    {
        $userData = Auth::user();
        return view("user.home.editPage", compact('userData'));
    }

    public function edit(Request $request)
    {
        $userId = Auth::id();

        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $userId,
            'phone' => 'required|min:8|max:15|unique:users,phone,' . $userId,
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5120', // max 5MB
        ]);

        if ($request->hasFile('image')) {
            $user = User::find($userId);

            // Check if there's an existing image to delete
            if ($user->profile) {
                Storage::disk('public')->delete('profile/' . $user->profile);
            }

            // Store new image with unique name
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('profile', $fileName, 'public');
            $fields['profile'] = $fileName;
        }

        // Update user profile with validated data
        User::where('id', $userId)->update($fields);

        return back();
    }

    public function changePasswordPage()
    {
        return view('user.home.changePassword');
    }

    public function changePassword(Request $request){
        dd($request->all());
    }
}
