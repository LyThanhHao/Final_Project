<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Course;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Question;
use App\Models\TestResult;
use App\Models\TestAttempt;
use Illuminate\Http\Request;
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
            'deadline' => 'required|date',
            'test_time' => 'required|integer|min:1',
            'questions.*.question' => 'required',
            'questions.*.a' => 'required',
            'questions.*.b' => 'required',
            'questions.*.c' => 'required',
            'questions.*.d' => 'required',
            'questions.*.answer' => 'required|in:a,b,c,d',
        ], [
            'course_id.required' => 'The course is required.',
            'test_name.required' => 'The test name is required.',
            'questions.*.question.required' => 'The question is required.',
            'test_time.required' => 'The test time is required.',
            'test_time.integer' => 'The test time must be an integer.',
            'test_time.min' => 'The test time must be at least 1 minute.',
            'questions.*.a.required' => 'The option A is required.',
            'questions.*.b.required' => 'The option B is required.',
            'questions.*.c.required' => 'The option C is required.',
            'questions.*.d.required' => 'The option D is required.',
            'questions.*.answer.required' => 'The correct answer is required.',
            'questions.*.answer.in' => 'The correct answer must be one of the options (A, B, C, or D).',
        ]);

        $test = Test::create([
            'test_name' => $request->test_name,
            'course_id' => $request->course_id,
            'user_id' => Auth::id(),
            'deadline' => $request->deadline,
            'test_time' => $request->test_time,
        ]);

        $questions = [];
        foreach ($request->questions as $questionData) {
            $questionData['test_id'] = $test->id;
            $questions[] = Question::create($questionData);
        }

        if ($test && $questions) {
            return redirect()->route('teacher.tests.index')->with('success', 'Test and questions created successfully');
        }
        return redirect()->back()->with('fail', 'Test and questions creation failed! Something went wrong, please try again!');
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
            'deadline' => 'required|date',
            'test_time' => 'required|integer|min:1',
            'questions.*.question' => 'required',
            'questions.*.a' => 'required',
            'questions.*.b' => 'required',
            'questions.*.c' => 'required',
            'questions.*.d' => 'required',
            'questions.*.answer' => 'required|in:a,b,c,d',
        ], [
            'course_id.required' => 'The course is required.',
            'test_name.required' => 'The test name is required.',
            'questions.*.question.required' => 'The question is required.',
            'test_time.required' => 'The test time is required.',
            'test_time.integer' => 'The test time must be an integer.',
            'test_time.min' => 'The test time must be at least 1 minute.',
            'questions.*.a.required' => 'The option A is required.',
            'questions.*.b.required' => 'The option B is required.',
            'questions.*.c.required' => 'The option C is required.',
            'questions.*.d.required' => 'The option D is required.',
            'questions.*.answer.required' => 'The correct answer is required.',
        ]);

        $check_test = $test->update([
            'course_id' => $request->course_id,
            'test_name' => $request->test_name,
            'deadline' => $request->deadline,
            'test_time' => $request->test_time,
        ]);

        $check_question = [];

        foreach ($request->questions as $questionData) {
            if (isset($questionData['id'])) {
                $question = Question::find($questionData['id']);
                if ($question) {
                    $check_question = $question->update($questionData);
                }
            }
        }
        if ($check_test && $check_question) {
            return redirect()->route('teacher.tests.index')->with('success', 'Test updated successfully');
        }
        return redirect()->back()->with('fail', 'Test update failed! Something went wrong, please try again!');
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
 
        Feedback::create([
            'test_attempt_id' => $request->test_attempt_id,
            'content' => $request->content,
        ]);
 
        return redirect()->back()->with('success', 'Feedback added successfully!');
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

            return redirect()->back()->with('success', 'Feedback updated successfully');
        }

        return redirect()->back()->with('fail', 'Feedback not found');
    }

    public function destroyFeedback($id)
    {
        $feedback = Feedback::find($id);
        if ($feedback) {
            $feedback->delete();
            return redirect()->back()->with('success', 'Feedback deleted successfully');
        }
        return redirect()->back()->with('fail', 'Feedback not found');
    }
}
