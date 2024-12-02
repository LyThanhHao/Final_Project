<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccount;
use App\Models\Category;
use App\Models\Course;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = Category::where('status', 1)
            ->with('courses')
            ->get()
            ->sortByDesc(function ($category) {
                return $category->courses->count();
            });
        $courses = Course::orderBy('id', 'DESC')
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })->limit(4)->get();
        if ($user) {
            $favorites = $user ? Favorite::where('user_id', $user->id)->get() : null;
        } else {
            $favorites = null;
        }
        return view('homepage.index', compact('courses', 'categories', 'favorites'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('keyword');
        $favorites = $user ? Favorite::where('user_id', $user->id)->get() : null;
        $courses = Course::where('status', 1)
            ->where(function ($query) use ($keyword) {
                $query->where('course_name', 'LIKE', "%{$keyword}%")
                    ->orWhereHas('user', function ($q) use ($keyword) {
                        $q->where('role', 'Teacher')->where('fullname', 'LIKE', "%{$keyword}%");
                    });
            })->whereHas('category', function ($q) {
                $q->where('status', 1);
            })->get();

        return view('homepage.search', compact('courses', 'keyword', 'favorites'));
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
            'password' => 'required|min:5|regex:/[a-zA-Z]/|regex:/[0-9]/|regex:/[@$!%*?&#]/',
            'password_confirmation' => 'required|same:password',
            'phoneNumber' => 'required',
            'address' => 'required',
            'termsCheckbox' => 'required',
        ], [
            'fullname.required' => 'The fullname is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password is required.',
            'password.min' => 'Password must be at least 5 characters long.',
            'password.regex' => 'Password must contain at least one letter, one number, and one special character.',
            'password_confirmation.required' => 'The confirm password is required.',
            'password_confirmation.same' => 'The confirm password must be same as password.',
            'termsCheckbox.required' => 'You must agree to the terms and conditions.',
        ]);

        $data = $request->only('fullname', 'email', 'password', 'phoneNumber', 'address');
        $data['role'] = 'Student';
        //ma hoa password
        $data['password'] = bcrypt($request->password);

        $acc = User::create($data);

        if ($acc) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('homepage.login')->with('register-success', 'Please check your email to verify your account!');
        }
        return redirect()->back()->with('fail', 'Something wrong, please try again!');
    }

    public function verify($email)
    {
        $acc = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => now()]);
        return redirect()->route('homepage.login')->with('success', 'Verify account successfully! Now you can login.');
    }

    public function getEnrolledCourses()
    {
        $user = Auth::user();
        $enrolledCourses = Course::whereHas('enrolls', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        return response()->json($enrolledCourses);
    }

    public function my_courses()
    {
        $user = Auth::user();
        $courses = Course::whereHas('enrolls', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['tests' => function ($query) use ($user) {
            $query->withCount(['testAttempts' => function ($query) use ($user) {
                $query->where('user_id', $user->id)->where('status', 'Completed');
            }]);
        }])->get();

        return view('homepage.my_courses', compact('courses'));
    }
}
