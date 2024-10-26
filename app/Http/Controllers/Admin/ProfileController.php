<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //direct account profile
    public function accountProfile()
    {
        return view("profile.accountProfile");
    }

    //account edit
    public function accountEdit()
    {
        $userData = Auth::user();
        return view("profile.accountEdit", compact('userData'));
    }

    //change password page
    public function changePasswordPage()
    {
        return view('profile.changePassword');
    }

    public function changePassword(Request $request)
    {
        $fields = $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|max:12',
            'confirmPassword' => 'required|same:newPassword'
        ]);

        $dbHashPassword = Auth::user()->password;
        $authId = Auth::user()->id;

        if (Hash::check($request->currentPassword, $dbHashPassword)) {

            $data = ['password' => Hash::make($request->newPassword)];

            User::where('id', $authId)->update($data);

            Alert::success('Password Change', 'Password Changed Successfully!');

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        } else {
            Alert::success('Error Message', 'Old password do not match , Try again!');

            return back();
        }
    }
}
