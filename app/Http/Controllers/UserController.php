<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\User;
use App\Models\UserResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Str;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('homepage.profile', compact('user'));
    }

    public function check_profile(Request $request){
        $user = Auth::user();
        $request->validate([
            'fullname' => 'required',
            'email' => '|email|unique:users,email,'.$user->id,
            'address' => 'required',
            'phoneNumber' => 'required',
        ], [
            'fullname.required' => 'The fullname is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'address.required' => 'The address is required.',
            'phoneNumber.required' => 'The phone number is required.',
        ]);
        $data = $request->only('fullname', 'email', 'address', 'phoneNumber');

        if ($user->update($data)){
            return redirect()->back()->with('success', 'Profile information updated successfully!');
        }
        return redirect()->back()->with('fail', 'Something went wrong, please check the information again!');
    }

    public function change_avatar(Request $request){
        $user = Auth::user();
        $request->validate([
            'avatar' => 'required|file|mimes:jpg, jpeg, gif, png, webp, svg,'
        ], [
            'avatar.required' => 'The avatar is required.',
            'avatar.file' => 'The avatar must be a file.',
            'avatar.mimes' => 'The avatar must be a valid image file.',
        ]);
        
        // Xóa file ảnh cũ
        if ($user->avatar) {
            $oldAvatarPath = public_path('uploads/avatar/' . $user->avatar);
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath); 
            }
        }
        
        if($request->has('avatar')){
            $img_name = $request->avatar->hashName();
            $request->avatar->move(public_path('uploads/avatar'), $img_name);
            $data['avatar'] = $img_name;
        }

        if($user->update($data)){   
            return redirect()->back()->with('success', 'Avatar updated successfully!');
        }
        return redirect()->back()->with('fail', 'Something went wrong, please check the information again!');
    }

    public function check_password(Request $request){
        $user = Auth::user();
        $request->validate([
            'currentPassword' => ['required', function($attribute, $value, $fail) use ($user) { 
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect!');
                }
            }],
            'newPassword' => 'required|min:5|regex:/[a-zA-Z]/|regex:/[@$!%*?&#]/',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $data = $request->only('newPassword');
        $data['password'] = bcrypt($request->newPassword);
        
        if ($user->update($data)){
            return redirect()->back()->with('success', 'Password updated successfully!');
        }
        return redirect()->back()->with('fail', 'Something went wrong, please check the information again!');
    }

    public function forgot_password()
    {
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('homepage.forgot_password');
    }

    public function check_forgot_password(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        
        $user = User::where('email', $request->email)->first();
        $token = Str::random(40);
        $tokenData = [
            'email' => $request->email,
            'token' => $token,
        ];

        if(UserResetToken::create($tokenData)){
            Mail::to($request->email)->send(new ForgotPassword($user, $token));
            return view('homepage.forgot_password')->with('success', 'Please check your email to reset your password!');
        }
        return view('homepage.forgot_password')->with('fail', 'Something went wrong, please try again!');
    }

    public function reset_password($token){
        $resetToken = UserResetToken::where('token', $token)
            ->where('created_at', '>', now()->subDays(3))
            ->firstOrFail();
        if($resetToken){
            return view('homepage.reset_password')->with('success', 'Successfully! Now you can reset your password');
        }
        return view('homepage.reset_password')->with('fail', 'Something went wrong, please try again!');
    }

    public function check_reset_password($token, Request $request){
        $request->validate([
            'password' => 'required|min:5|regex:/[a-zA-Z]/|regex:/[@$!%*?&#]/',
            'password_confirm' => 'required|same:password',
        ], [
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 5 characters.',
            'password.regex' => 'The password must contain at least one letter and one special character.',
            'password_confirm.required' => 'The password confirmation is required.',
            'password_confirm.same' => 'The password confirmation must be same as password.',
        ]);

        $resetToken = UserResetToken::where('token', $token)->firstOrFail();
        $user = $resetToken->user;

        $data['password'] = bcrypt($request->password);

        $check = $user->update($data);
        if($check){
            $resetToken->delete();
            return redirect()->route('homepage.login')->with('success', 'Reset password successfully! \n Now you can login with your new password');
        }
        return redirect()->back()->with('fail', 'Something went wrong, please try again!');
    }

    public function favorite_list(){
        $user = Auth::user();
        $courses = $user->favorites;
        return view('homepage.favorite_list', compact('courses'));
    }
}
