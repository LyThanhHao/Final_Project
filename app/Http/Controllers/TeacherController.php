<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function courses(){
        $teacher = Auth::user();
        $courses = $teacher->courses;
        return view('teacher.courses.index', compact('courses'));
    }

    public function create_course(){
        $categories = Category::orderBy('id', 'ASC')->get();
        return view('teacher.courses.create', compact('categories'));
    }

    public function store_course(Request $request){
        $request->validate([
            'course_name' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,gif,png,webp,svg,',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf,',
            'category_id' => 'required',
        ]);
        
        $data = $request->except(['image', 'file']); 

        $user = Auth::user();
    
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

        $data['user_id'] = $user->id;
    
        $check = Course::create($data);
    
        if ($check) {
            return redirect()->route('teacher.courses')->with('success', 'Course created successfully');
        }
        return redirect()->back()->with('fail', 'Course creation failed');

    }

    public function edit_course(Course $course){
        $categories = Category::orderBy('id', 'ASC')->get();
        return view('teacher.courses.edit', compact('categories', 'course'));
    }

    public function update_course(Request $request, Course $course){
        $request->validate([
            'course_name' => 'required',
            'image' => 'nullable|file|mimes:jpg,jpeg,gif,png,webp,svg',
            'description' => 'required',
            'file' => 'nullable|file|mimes:pdf',
            'category_id' => 'required',
            'status' => 'required',
        ]);
        
        $user = Auth::user();
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

        $data['user_id'] = $user->id;
        
        if ($course->update($data)) {
            return redirect()->route('teacher.courses')->with('success', 'Your course updated successfully');
        }
        return redirect()->back()->with('fail', 'Your course update failed! Something went wrong, please try again!');
    }

    public function destroy_course(Course $course){
        if ($course->delete()) {
            return redirect()->route('teacher.courses')->with('success', 'Course deleted successfully');
        }
        return redirect()->back()->with('fail', 'Course deletion failed! Something went wrong, please try again!');
    }
}
