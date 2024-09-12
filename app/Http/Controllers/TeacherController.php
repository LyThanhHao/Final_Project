<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Question;
use App\Models\Test;
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
            return redirect()->route('teacher.courses.index')->with('success', 'Course created successfully');
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
            return redirect()->route('teacher.courses.index')->with('success', 'Your course updated successfully');
        }
        return redirect()->back()->with('fail', 'Your course update failed! Something went wrong, please try again!');
    }

    public function destroy_course(Course $course){
        if ($course->delete()) {
            return redirect()->route('teacher.courses.index')->with('success', 'Course deleted successfully');
        }
        return redirect()->back()->with('fail', 'Course deletion failed! Something went wrong, please try again!');
    }

    public function tests(){
        $tests = Test::orderBy('id', 'DESC')->get();
        return view('teacher.tests.index', compact('tests'));
    }

    public function create_test(){
        $courses = Course::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('teacher.tests.create', compact('courses'));
    }

    public function store_test(Request $request){
        $request->validate([
            'course_id' => 'required',
            'test_name' => 'required',
        ]);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        $check = Test::create($data);
        if ($check) {
            return redirect()->route('teacher.tests.index')->with('success', 'Test created successfully');
        }
        return redirect()->back()->with('fail', 'Test creation failed! Something went wrong, please try again!');
    }

    public function edit_test(Test $test){
        $courses = Course::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('teacher.tests.edit', compact('courses', 'test'));
    }

    public function update_test(Request $request, Test $test){
        $request->validate([
            'course_id' => 'required',
            'test_name' => 'required',
        ]);

        $data = $request->all();

        $check = $test->update($data);
        if ($check) {
            return redirect()->route('teacher.tests.index')->with('success', 'Test updated successfully');
        }
        return redirect()->back()->with('fail', 'Test update failed! Something went wrong, please try again!');
    }

    public function test_detail(Test $test){
        $questions = Question::where('test_id', $test->id)->orderBy('id', 'DESC')->get();
        return view('teacher.tests.detail', compact('test', 'questions'));
    }

    public function create_question(Test $test){
        return view('teacher.questions.create', compact('test'));
    }

    public function store_question(Request $request, Test $test){
        $request->validate([
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'answer' => 'required',
            'test_id' => 'required|exists:tests,id',
        ]);

        $data = $request->all();

        $check = Question::create($data);
        if ($check) {
            return redirect()->route('teacher.tests.detail', $data['test_id'])->with('success', 'Question created successfully');
        }
        return redirect()->back()->with('fail', 'Question creation failed! Something went wrong, please try again!');
    }

    public function edit_question(Question $question){
        return view('teacher.questions.edit', compact('question'));
    }

    public function update_question(Request $request, Question $question){
        $request->validate([
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'answer' => 'required',
        ]);

        $data = $request->all();

        $check = $question->update($data);
        
        if ($check) {
            return redirect()->route('teacher.tests.detail', $question->test_id)->with('success', 'Question updated successfully');
        }
        return redirect()->back()->with('fail', 'Question update failed! Something went wrong, please try again!');
    }

    public function destroy_question(Question $question){
        if ($question->delete()) {
            return redirect()->route('teacher.tests.detail', $question->test_id)->with('success', 'Question deleted successfully');
        }
        return redirect()->back()->with('fail', 'Question deletion failed! Something went wrong, please try again!');
    }
}
