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
        $categorys = Category::where('status', 1)->get();
        $courses = Course::orderBy('id', 'DESC')->paginate(15);
        return view('homepage.index', compact('courses', 'categorys'));
    }

    public function login()
    {
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
        return Redirect()->route('homepage.login');
    }
}
