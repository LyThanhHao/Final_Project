<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::orderBy('id', 'ASC')->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }


    public function create(Course $course)
    {   
        $category = Category::all();
        $users = User::all();
        return view('admin.courses.create', compact('course', 'category', 'users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'image' => 'required|file|mimes:jpg,jpeg,gif,png,webp,svg,',
            'file' => 'required|file|mimes:pdf,',
            'description' => 'required',
        ]);
    
        $data = $request->except(['image', 'file']); 
    
        if ($request->has('image')) {
            $img_name = $request->image->hashName();
            $request->image->move(public_path('uploads/course_image'), $img_name);
            $data['image'] = $img_name;
        }
    
        if ($request->has('file')) {
            $file_name = $request->file->hashName();
            $request->file->move(public_path('uploads/course_file'), $file_name);
            $data['file'] = $file_name;
        }
    
        $course = Course::create($data);
    
        if ($course) {
            return redirect()->route('admin.courses.index')->with('create_success', 'Course created successfully');
        }
        return redirect()->route('admin.courses.index')->with('create_fail', 'Course creation failed');
    }
    

    public function coourse_detail(Course $course)
    {
        $instructor = $course->user;

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
