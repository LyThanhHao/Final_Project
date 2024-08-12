<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccount;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function check_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $data = $request->only('email', 'password');
        $check = auth()->attempt($data);

        if($check){
            if(auth()->user()->email_verified_at == ''){
                auth()->logout();
                return redirect()->back()->with('not-verify', 'Your account is not verify, please check your email again');
            }
            return redirect()->route('homepage')->with('success-login', 'Welcome back' );
        }
        return redirect()->back()->with('fail-login', 'Your email or password invalid');
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

    public function check_register(Request $request)
    {
        //validate data
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|regex:/[a-zA-Z]/|regex:/[@$!%*?&#]/',
            'confirm_password' => 'required|same:password',
            'phoneNumber' => 'required',
            'address' => 'required',
            'termsCheckbox' => 'required',
        ], [
            'password.regex' => 'Password must contain at least one letter and one special character.',
            'password.min' => 'Password must be at least 5 characters long.',
        ]);

        $data = $request->only('fullname', 'email', 'password', 'phoneNumber', 'address');
        //ma hoa password
        $data['password'] = bcrypt($request->password);

        if($acc = User::create($data)){
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('homepage.login')->with('success-register', 'Registration successful!, Please check your email to verify your account');
        }
        return redirect()->back()->with('fail-register', 'Something wrong, please try again!');
    }

    public function verify($email){
        $acc = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => now()]);
        return redirect()->route('homepage.login')->with('confirmed', 'Verify account successfully! Now you can login.');
    }
}
