<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401); // Trả về mã 401 Unauthorized
        }
        
        // Validate dữ liệu đầu vào
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'content' => 'required|string|max:255',
        ]);

        // Người dùng đã đăng nhập, thực hiện logic lưu comment
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'content' => $request->input('content'),
        ]);

        // Trả về trang hiện tại
        return response()->json(['comment' => $comment->load('user')]);
    }
}
