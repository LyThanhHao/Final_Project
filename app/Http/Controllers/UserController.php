<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function profile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('user.profile', compact('user'));
        }
        return Redirect::route('homepage.login');
    }

    public function check_profile(Request $request){
        $user = auth()->user();
        $request->validate([
            'fullname' => 'required',
            'email' => '|email|unique:users,email,'.$user->id,
            'address' => 'required',
            'phoneNumber' => 'required',
        ]);
        $data = $request->only('fullname', 'email', 'address', 'phoneNumber');

        $check = $user->update($data);
        if ($check){
            return redirect()->back()->with('success', 'Profile information updated successfully!');
        }
        return redirect()->back()->with('fail', 'Something went wrong, please check the information again!');
    }

    public function password()
    {
        if (Auth::check()) {
            return view('user.password');
        }
        return Redirect::route('homepage.login');
    }
}
