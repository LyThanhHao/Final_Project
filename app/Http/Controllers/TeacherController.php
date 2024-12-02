<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Question;
use App\Models\TestResult;
use App\Models\TestAttempt;
use Illuminate\Http\Request;
use App\Models\StudentDeadline;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function courses()
    {
        $teacher = Auth::user();
        $courses = Course::where('user_id', $teacher->id)->withCount('enrolls')->get();
        return view('teacher.courses.index', compact('courses'));
    }

    public function create_course()
    {
        $categories = Category::where('status', 1)->orderBy('id', 'ASC')->get();
        return view('teacher.courses.create', compact('categories'));
    }

    public function store_course(Request $request)
    {
        $request->validate([
            'course_name' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,gif,png,webp,svg,',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf,',
            'category_id' => 'required',
        ], [
            'course_name.required' => 'The course name is required.',
            'image.file' => 'The course image must be a file.',
            'image.mimes' => 'The course image must be a valid image file.',
            'image.max' => 'The course image must be less than 2MB.',
            'description.required' => 'The course description is required.',
            'file.file' => 'The course file must be a file.',
            'file.mimes' => 'The course file must be a valid file.',
            'category_id.required' => 'The course category is required.',
        ],);

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

    public function edit_course(Course $course)
    {
        $categories = Category::orderBy('id', 'ASC')->get();
        return view('teacher.courses.edit', compact('categories', 'course'));
    }

    public function update_course(Request $request, Course $course)
    {
        $request->validate([
            'course_name' => 'required',
            'image' => 'nullable|file|mimes:jpg,jpeg,gif,png,webp,svg',
            'description' => 'required',
            'file' => 'nullable|file|mimes:pdf',
            'category_id' => 'required',
            'status' => 'required',
        ], [
            'course_name.required' => 'The course name is required.',
            'image.file' => 'The course image must be a file.',
            'image.mimes' => 'The course image must be a valid image file.',
            'image.max' => 'The course image must be less than 2MB.',
            'description.required' => 'The course description is required.',
            'file.file' => 'The course file must be a file.',
            'file.mimes' => 'The course file must be a valid file.',
            'category_id.required' => 'The course category is required.',
            'status.required' => 'The course status is required.',
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

    public function destroy_course(Course $course)
    {
        if ($course->delete()) {
            return redirect()->route('teacher.courses.index')->with('success', 'Course deleted successfully');
        }
        return redirect()->back()->with('fail', 'Course deletion failed! Something went wrong, please try again!');
    }

    public function tests()
    {
        $teacher = Auth::user();
        $tests = Test::where('user_id', $teacher->id)->orderBy('id', 'DESC')->get();
        return view('teacher.tests.index', compact('tests'));
    }

    public function create_test()
    {
        $courses = Course::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('teacher.tests.create', compact('courses'));
    }

    public function store_test(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'test_name' => 'required',
            'deadline_after' => 'required|integer|min:1',
            'test_time' => 'required|integer|min:1',
            'questions.*.question' => 'required',
            'questions.*.a' => 'required',
            'questions.*.b' => 'required',
            'questions.*.c' => 'required',
            'questions.*.d' => 'required',
            'questions.*.answer' => 'required|in:a,b,c,d',
        ]);

        $test = Test::create([
            'course_id' => $request->course_id,
            'test_name' => $request->test_name,
            'user_id' => Auth::user()->id,
            'deadline_after' => $request->deadline_after,
            'test_time' => $request->test_time,
        ]);

        foreach ($request->questions as $questionData) {
            Question::create(array_merge($questionData, ['test_id' => $test->id]));
        }

        $students = User::whereHas('enrolls', function ($query) use ($request) {
            $query->where('course_id', $request->course_id);
        })->get();

        foreach ($students as $student) {
            $enrollDate = $student->enrolls()->where('course_id', $request->course_id)->first()->created_at;
            $deadline = $enrollDate->copy()->addDays($request->deadline_after);

            if ($deadline->isPast()) {
                $deadline = $test->created_at->copy()->addDays($request->deadline_after);
            }

            StudentDeadline::create([
                'user_id' => $student->id,
                'test_id' => $test->id,
                'deadline' => $deadline,
            ]);
        }

        return redirect()->route('teacher.tests.index')->with('success', 'Test created successfully');
    }

    public function edit_test(Test $test)
    {
        $courses = Course::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('teacher.tests.edit', compact('courses', 'test'));
    }

    public function update_test(Request $request, Test $test)
    {
        $request->validate([
            'course_id' => 'required',
            'test_name' => 'required',
            'deadline_after' => 'required|integer|min:1',
            'test_time' => 'required|integer|min:1',
            'questions.*.question' => 'required',
            'questions.*.a' => 'required',
            'questions.*.b' => 'required',
            'questions.*.c' => 'required',
            'questions.*.d' => 'required',
            'questions.*.answer' => 'required|in:a,b,c,d',
        ]);

        $test->update([
            'course_id' => $request->course_id,
            'test_name' => $request->test_name,
            'deadline_after' => $request->deadline_after,
            'test_time' => $request->test_time,
        ]);

        foreach ($request->questions as $questionData) {
            if (isset($questionData['id'])) {
                $question = Question::find($questionData['id']);
                if ($question) {
                    $question->update($questionData);
                }
            }
        }

        $students = User::whereHas('enrolls', function ($query) use ($request) {
            $query->where('course_id', $request->course_id);
        })->get();

        foreach ($students as $student) {
            $enrollDate = $student->enrolls()->where('course_id', $request->course_id)->first()->created_at;
            $deadline = $enrollDate->addDays($request->deadline_after);

            StudentDeadline::updateOrCreate(
                ['user_id' => $student->id, 'test_id' => $test->id],
                ['deadline' => $deadline]
            );
        }

        return redirect()->route('teacher.tests.index')->with('success', 'Test updated successfully');
    }

    public function destroy_test(Test $test)
    {
        if ($test->delete()) {
            return redirect()->route('teacher.tests.index')->with('success', 'Test deleted successfully');
        }
        return redirect()->back()->with('fail', 'Test deletion failed! Something went wrong, please try again!');
    }

    public function test_detail(Test $test)
    {
        $questions = Question::where('test_id', $test->id)->orderBy('id', 'ASC')->get();
        return view('teacher.tests.detail', compact('test', 'questions'));
    }

    public function test_results()
    {
        $teacher = Auth::user();
        $results = TestAttempt::with(['user', 'test.course', 'testResults'])
            ->whereHas('test', function ($query) use ($teacher) {
                $query->where('user_id', $teacher->id);
            })->orderBy('id', 'ASC')->get()
            ->map(function ($attempt) {
                $correctAnswers = $attempt->testResults->where('is_correct', 1)->count();
                $totalQuestions = $attempt->testResults->count();
                $timeUsedInSeconds = $attempt->updated_at->diffInSeconds($attempt->created_at);

                $minutes = floor($timeUsedInSeconds / 60);
                $seconds = $timeUsedInSeconds % 60;

                $timeUsed = $minutes > 0
                    ? "{$minutes} minutes " . ($seconds > 0 ? "{$seconds} seconds" : "")
                    : "{$seconds} seconds";

                return [
                    'student_name' => $attempt->user->fullname ?? 'N/A',
                    'test_name' => $attempt->test->test_name ?? 'N/A',
                    'course_name' => $attempt->test->course->course_name ?? 'N/A',
                    'correct_answers' => "$correctAnswers / $totalQuestions",
                    'time_used' => $timeUsed,
                    'test_id' => $attempt->test_id,
                    'has_feedback' => $attempt->feedbacks->count() > 0 ? true : false,
                ];
            });

        return view('teacher.tests.result', compact('results'));
    }

    public function view_test_detail($id)
    {
        $test = Test::with('questions')->findOrFail($id);
        $attempt = TestAttempt::with('feedbacks.testAttempt.user', 'user', 'testResults')
            ->where('test_id', $id)
            ->first();

        $questions = $test->questions->map(function ($question) use ($attempt) {
            $result = $attempt->testResults->firstWhere('question_id', $question->id);
            $selectedAnswer = $result->selected_answer ?? null;

            return [
                'question_text' => $question->question,
                'selected_answer' => $selectedAnswer,
                'correct_answer' => $question->answer,
                'answers' => [
                    'a' => $question->a,
                    'b' => $question->b,
                    'c' => $question->c,
                    'd' => $question->d,
                ],
            ];
        });

        return view('teacher.tests.result_detail', compact('test', 'questions', 'attempt'));
    }

    public function storeFeedback(Request $request)
    {
        $request->validate([
            'test_attempt_id' => 'required|exists:test_attempts,id',
            'content' => 'required|string|max:255',
        ]);

        $feedback = Feedback::create([
            'test_attempt_id' => $request->test_attempt_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Feedback added successfully!')->with('new_feedback_id', $feedback->id);
    }

    public function updateFeedback(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $feedback = Feedback::find($id);
        if ($feedback) {
            $feedback->content = $request->input('content');
            $feedback->save();

            return redirect()->back()->with('success', 'Feedback updated successfully')->with('updated_feedback_id', $feedback->id);
        }

        return redirect()->back()->with('fail', 'Feedback not found');
    }

    public function destroyFeedback($id)
    {
        $feedback = Feedback::find($id);
        if ($feedback) {
            $feedback->delete();
            return redirect()->back()->with('success', 'Feedback deleted successfully')->with('deleted_feedback_id', $id);
        }
        return redirect()->back()->with('fail', 'Feedback not found');
    }
}
