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


    public function create()
    {   
        $category = Category::all();
        $users = User::all();
        return view('admin.courses.create', compact('category', 'users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'teacher' => 'required|exists:users,id',
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

        $data['user_id'] = $request->input('teacher');
    
        $check = Course::create($data);
    
        if ($check) {
            return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
        }
        return redirect()->route('admin.courses.index')->with('fail', 'Course creation failed');
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
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();
    
        return view('admin.courses.edit', compact('course', 'categories', 'teachers'));
    }
    
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_name' => 'required',
            'image' => 'nullable|file|mimes:jpg,jpeg,gif,png,webp,svg',
            'description' => 'required',
            'file' => 'nullable|file|mimes:pdf',
            'category_id' => 'required|exists:categories,id',
            'teacher' => 'required|exists:users,id',
            'status' => 'required',
        ]);
        
        $data = $request->except(['image', 'file']);
        
        if ($request->hasFile('image')) {
            $img_name = $request->image->hashName();
            $request->image->move(public_path('uploads/course_image'), $img_name);
            $data['image'] = $img_name;
        }
    
        if ($request->hasFile('file')) {
            $file_name = $request->file->hashName();
            $request->file->move(public_path('uploads/course_file'), $file_name);
            $data['file'] = $file_name;
        }

        $data['user_id'] = $request->input('teacher');
        
        if ($course->update($data)) {
            return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully');
        }
        return redirect()->back()->with('fail', 'Course update failed! Something went wrong, please try again!');
    }
    
    public function destroy(Course $course)
    {
        if ($course->delete()) {
            return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');
        }
        return redirect()->back()->with('fail', 'Course deletion failed! Something went wrong, please try again!');
    }
}
