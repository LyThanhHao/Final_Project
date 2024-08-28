<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index() {
        return view('admin.courses.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function coourse_detail(Course $course)
    {
        // Lấy giáo viên dạy khóa học này
        $instructor = $course->user;

        // Đếm số lượng khóa học mà giáo viên này đang giảng dạy
        $courseCount = Course::where('user_id', $instructor->id)->count();

        $relatedCourses = Course::where('category_id', $course->category_id)->where('id', '!=', $course->id)->limit(3)->get();

        return view('courses.detail', compact('courseCount', 'relatedCourses', 'courseCount', 'course'));
    }

    public function edit(Course $course)
    {
        //
    }

    public function update(Request $request, Course $course)
    {
        //
    }

    public function destroy(Course $course)
    {
        //
    }
}
