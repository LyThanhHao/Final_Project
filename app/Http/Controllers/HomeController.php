<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccount;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        //xac thuc du lieu
        request()->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|regex:/[a-zA-Z]/|regex:/[@$!%*?&#]/',
            'confirm_password' => 'required|same:password',
            'phoneNumber' => 'required',
            'address' => 'required',
        ], [
            'password.regex' => 'Password must contain at least one letter and one special character.',
            'password.min' => 'Password must be at least 6 characters long.',
        ]);

        $data = request()->only('fullname', 'email', 'password', 'phoneNumber', 'address');
        //ma hoa password
        $data['password'] = bcrypt(request('password'));

        if($acc = User::create($data)){
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('homepage.login')->with('success', 'Registration successful!, Please check your email to verify your account');
        }
        return redirect()->back()->with('fail', 'Something wrong, please try again!');
    }

    public function verify($email){
        $acc = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => now()]);
        return redirect()->route('homepage.login')->with('confirmed', 'Verify account successfully! Now you can login.');
    }
}
