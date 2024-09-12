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
        $categories = Category::where('status', 1)
            ->with('courses')
            ->get()
            ->sortByDesc(function($category) {
                return $category->courses->count();
            });
        $teachers = User::where('role', 'Teacher')->get();
        $courses = Course::orderBy('id', 'DESC')->limit(3)->get();
        return view('homepage.index', compact('courses', 'categories', 'teachers'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $courses = Course::where(function ($query) use ($keyword) {
                $query->where('course_name', 'LIKE', "%{$keyword}%")
                      ->orWhereHas('user', function ($q) use ($keyword) {
                          $q->where('role', 'Teacher')
                            ->where('fullname', 'LIKE', "%{$keyword}%");
                      });
            })
            ->where('status', 1)
            ->whereHas('category', function ($q) {
                $q->where('status', 1);
            })
            ->get();

        return view('homepage.search', compact('courses', 'keyword'));
    }

    public function login()
    {
        if (Auth::check()) {
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
        $check = Auth::attempt($data);

        if ($check) {
            if (Auth::user()->email_verified_at == '') {
                Auth::logout();
                return redirect()->back()->with('fail', 'Your account is not verify, please check your email again');
            }
            return redirect()->route('homepage')->with('success', 'Welcome back');
        }
        return redirect()->back()->with('fail', 'Your email or password invalid');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }

    public function register()
    {
        if (Auth::check()) {
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

        if ($acc = User::create($data)) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('homepage.login')->with('success', 'Registration successful!, Please check your email to verify your account');
        }
        return redirect()->back()->with('fail', 'Something wrong, please try again!');
    }

    public function verify($email)
    {
        $acc = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => now()]);
        return redirect()->route('homepage.login')->with('success', 'Verify account successfully! Now you can login.');
    }

    
}
