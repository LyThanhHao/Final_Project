<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\UserResetToken;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::find(Auth::id());
        return view('homepage.profile', compact('user'));
    }

    public function check_profile(Request $request){
        $user = User::find(Auth::id());
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

    public function change_avatar(Request $request)
    {
        try {
            $user = User::find(Auth::id());
    
            // Validate file input
            $request->validate([
                'avatar' => 'required|file|mimes:jpg,jpeg,gif,png,webp,svg|max:20480',
            ], [
                'avatar.required' => 'The avatar is required.',
                'avatar.file' => 'The avatar must be a file.',
                'avatar.mimes' => 'The avatar must be a valid image file (jpg, jpeg, gif, png, webp, svg).',
                'avatar.max' => 'The avatar must be less than 20MB.',
            ]);
    
            // Xóa file ảnh cũ
            if ($user->avatar) {
                $oldAvatarPath = public_path('uploads/avatar/' . $user->avatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }
    
            // Upload file ảnh mới
            $data = [];
            if ($request->has('avatar')) {
                $img_name = $request->avatar->hashName();
                $request->avatar->move(public_path('uploads/avatar'), $img_name);
                $data['avatar'] = $img_name;
            }
    
            // Cập nhật thông tin người dùng
            if ($user->update($data)) {
                return redirect()->back()->with('success', 'Avatar updated successfully!');
            }
    
            // Trường hợp update thất bại
            return redirect()->back()->with('fail', 'Failed to update avatar. Please try again.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Xử lý lỗi validation
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            // Bắt tất cả các lỗi khác
            return redirect()->back()->with('fail', 'Something went wrong. Please try again later.');
        }
    }

    public function check_password(Request $request){
        $user = User::find(Auth::id());
        $request->validate([
            'currentPassword' => ['required', function($attribute, $value, $fail) use ($user) { 
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect!');
                }
            }],
            'newPassword' => 'required|min:5|regex:/[a-zA-Z]/|regex:/[@$!%*?&#]/',
            'password_confirmation' => 'required|same:newPassword',
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

    public function check_forgot_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
    
        $user = User::where('email', $request->email)->first();
        $existingToken = UserResetToken::where('email', $request->email)->first();
    
        if ($existingToken) {
            // Kiểm tra xem token có quá 3 ngày không
            if ($existingToken->updated_at->lt(now()->subDays(3))) {
                // Cập nhật token mới nếu token đã quá 3 ngày
                $existingToken->update([
                    'token' => Str::random(40),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
    
                Mail::to($request->email)->send(new ForgotPassword($user, $existingToken->token));
                return redirect()->route('forgot_password')->with('send-success', 'Please check your email to reset your password!');
            } else {
                // Nếu token chưa quá hạn, có thể từ chối yêu cầu hoặc thông báo cho người dùng
                return redirect()->route('forgot_password')->with('resend-fail', 'A reset link has already been sent. Please check your email!');
            }
        }
    
        // Nếu không tồn tại token, tạo token mới
        $tokenData = [
            'email' => $request->email,
            'token' => Str::random(40),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    
        if (UserResetToken::create($tokenData)) {
            Mail::to($request->email)->send(new ForgotPassword($user, $tokenData['token']));
            return redirect()->route('forgot_password')->with('send-success', 'Please check your email to reset your password!');
        }
        return redirect()->route('forgot_password')->with('fail', 'Something went wrong, please try again!');
    }
    

    public function reset_password($token)
    {
        try {
            $resetToken = UserResetToken::where('token', $token)
                ->where('updated_at', '>', now()->subDays(3))
                ->firstOrFail();
    
            // Chuyển hướng tới trang nhập mật khẩu mới (thay vì route chính nó)
            return view('homepage.reset_password', ['token' => $token])->with('success', 'Successfully! Now you can reset your password');
        } catch (ModelNotFoundException $e) {
            // Xử lý khi không tìm thấy token hoặc token không thỏa mãn điều kiện
            return redirect()->route('forgot_password')->with('token-error', 'The reset link is invalid or has expired.');
        }
    }
    

    public function check_reset_password($token, Request $request){
        $request->validate([
            'password' => 'required|min:5|regex:/[a-zA-Z]/|regex:/[0-9]/|regex:/[@$!%*?&#]/',
            'password_confirmation' => 'required|same:password',
        ], [
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 5 characters.',
            'password.regex' => 'The password must contain at least one letter, one number, and one special character.',
            'password_confirm.required' => 'The password confirmation is required.',
            'password_confirm.same' => 'The password confirmation must be same as password.',
        ]);
        $data = $request->only('password');
        
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
