<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Favorite;
use App\Models\Test;
use App\Models\TestAttempt;
use App\Models\User;
use App\Models\StudentDeadline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ], [
            'course_name.required' => 'The course name is required.',
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The category must be a valid category.',
            'teacher.required' => 'The teacher is required.',
            'teacher.exists' => 'The teacher must be a valid teacher.',
            'image.required' => 'The image is required.',
            'image.file' => 'The image must be a file.',
            'image.mimes' => 'The image must be a valid image file.',
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


    public function course_detail(Course $course)
    {
        $user = Auth::user();
        $favorite = $user ? Favorite::where('user_id', $user->id)->where('course_id', $course->id)->first() : null;
        $enrolled = $user ? Enroll::where('user_id', $user->id)->where('course_id', $course->id)->first() : null;
        $instructor = $course->user;
        $enrollCount = $course->enrolls()->count();
        $courseCount = $instructor->courses()->count();
        $relatedCourses = Course::where('category_id', $course->category_id)->where('id', '!=', $course->id)->limit(3)->get();
        $comments = $course->comments()->with('user')->get();

        return view('courses.detail', compact('courseCount', 'relatedCourses', 'course', 'comments', 'favorite', 'enrolled', 'enrollCount'));
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
        ], [
            'course_name.required' => 'The course name is required.',
            'image.file' => 'The image must be a file.',
            'image.mimes' => 'The image must be a valid image file.',
            'description.required' => 'The description is required.',
            'file.file' => 'The file must be a file.',
            'file.mimes' => 'The file must be a valid file.',
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The category must be a valid category.',
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

    public function favorite($courseId)
    {
        $user = Auth::user();
        Favorite::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
        ]);

        return response()->json(['success' => 'Course added to favorites'], 201);
    }

    public function unfavorite($courseId)
    {
        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)->where('course_id', $courseId)->first();

        if ($favorite) {
            $favorite->delete();
        }

        return response()->json(['success' => 'Course removed from favorites'], 200);
    }

    public function enroll(Request $request, $course_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $existingEnroll = Enroll::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$existingEnroll) {
            Enroll::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
            ]);

            // Tạo student_deadlines cho mỗi bài test trong khóa học
            $tests = $course->tests;
            foreach ($tests as $test) {
                $enrollDate = now();
                $calculatedDeadline = $enrollDate->copy()->addDays($test->deadline_after);

                // Nếu deadline tính toán là quá khứ, sử dụng ngày tạo test + deadline_after
                if ($calculatedDeadline->isPast()) {
                    $calculatedDeadline = $test->created_at->copy()->addDays($test->deadline_after);
                }

                StudentDeadline::create([
                    'user_id' => $user->id,
                    'test_id' => $test->id,
                    'deadline' => $calculatedDeadline,
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function unenroll($course_id)
    {
        $user = Auth::user();
        $enrollment = Enroll::where('course_id', $course_id)->where('user_id', $user->id)->first();
    
        if ($enrollment) {
            $enrollment->delete();
            return redirect()->back();
        }
    
        return redirect()->back()->with('error', 'Unable to unenroll from the course.');
    }
    


    public function view(Request $request, $course_id)
    {
        $user = Auth::user();
        $course = Course::with('tests')->findOrFail($course_id);
        $instructor = $course->user;

        // Lấy danh sách các bài kiểm tra đã thực hiện
        $takenTests = Test::whereHas('testAttempts', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->where('status', 'Completed');
        })->where('course_id', $course->id)->get();

        return view('courses.view', compact('course', 'instructor', 'takenTests'));
    }
}
