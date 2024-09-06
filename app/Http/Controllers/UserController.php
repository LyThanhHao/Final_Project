<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            return redirect()->back()->with('profile_success', 'Profile information updated successfully!');
        }
        return redirect()->back()->with('profile_fail', 'Something went wrong, please check the information again!');
    }

    public function change_avatar(Request $request){
        $user = auth()->user();
        $request->validate([
            'avatar' => 'required|file|mimes:jpg, jpeg, gif, png, webp, svg,'
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
            return redirect()->back()->with('avatar_success', 'Avatar updated successfully!');
        }
        return redirect()->back()->with('avatar_fail', 'Something went wrong, please check the information again!');
    }

    public function password()
    {
        if (Auth::check()) {
            return view('user.password');
        }
        return Redirect::route('homepage.login');
    }

    public function check_password(Request $request){
        $user = auth()->user();
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
            return redirect()->back()->with('password_success', 'Password updated successfully!');
        }
        return redirect()->back()->with('password_fail', 'Something went wrong, please check the information again!');
    }
}
