<?php

namespace App\Http\Controllers;

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

    public function password()
    {
        if (Auth::check()) {
            return view('user.password');
        }
        return Redirect::route('homepage.login');
    }
}
