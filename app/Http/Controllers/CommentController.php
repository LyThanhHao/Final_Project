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
            return redirect()->route('homepage.login')->with('error', 'Unauthorized');
        }
        
        // Validate dữ liệu đầu vào
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'content' => 'required|string|max:255',
        ], [
            'course_id.required' => 'The course ID is required.',
            'course_id.exists' => 'The selected course ID is invalid.',
            'content.required' => 'The content is required.',
            'content.string' => 'The content must be a string.',
            'content.max' => 'The content must be less than 255 characters.',
        ]);

        // Người dùng đã đăng nhập, thực hiện logic lưu comment
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'content' => $request->input('content'),
        ]);

        // Chuyển hướng về trang chi tiết khóa học với thông báo thành công
        return redirect()->route('courses.detail', $request->course_id)
                         ->with('success', 'Comment added successfully.')
                         ->with('new_comment_id', $comment->id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully.')->with('updated_comment_id', $comment->id);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.')->with('deleted_comment_id', $id);
    }
}
