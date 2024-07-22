<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('id', 'DESC')->limit(3)->get();
        return view('homepage.index', compact('courses'));
    }

    public function login()
    {
        if(Auth::check()){
            return redirect()->back();
        }
        return view('homepage.login');
    }

    public function check_login()
    {
        request()->validate(
            [
                'email' => 'required|email|exists:users',
                'password' => 'required',
            ],
        );

        $data = request()->only('email', 'password');
        if (!isset($data)) {
            return redirect()->route('homepage.login');
        }
        if (auth()->attempt($data)) {
            return redirect()->route('homepage');
        }
        return redirect()->back()->withErrors(['password' => 'Password is incorrect']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }

    public function register()
    {
        if(Auth::check()){
            return redirect()->back();
        }
        return view('homepage.register');
    }

    public function check_register()
    {
        request()->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'phoneNumber' => 'required',
            'address' => 'required',
        ]);

        $data = request()->all('fullname', 'email', 'password', 'phoneNumber', 'address');
        $data['password'] = bcrypt(request('password'));
        User::create($data);

        return redirect()->route('homepage.login')->with('success', 'Registration successful!');
    }
}
