<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use App\Models\TestAttempt;
use App\Models\TestResult;
use App\Models\StudentDeadline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index($id)
    {
        $test = Test::findOrFail($id);
        $course = $test->course;
        $instructor = $course->user;

        $attempt = TestAttempt::where('user_id', auth()->id())
            ->where('test_id', $test->id)
            ->first();

        $testsCompleted = TestAttempt::where('user_id', auth()->id())
            ->where('status', 'Completed')
            ->with('test')
            ->get();

        $correctCount = 0;
        $totalQuestions = $test->questions->count();
        $duration = null;
        $percentage = null;
        $results = collect();

        if ($attempt && $attempt->status == 'Completed') {
            $correctCount = TestResult::where('test_attempt_id', $attempt->id)
                ->where('is_correct', true)
                ->count();

            $startTime = $attempt->created_at;
            $endTime = $attempt->updated_at;
            $minutes = $endTime->diffInMinutes($startTime);
            $seconds = $endTime->diffInSeconds($startTime) % 60;
            $duration = sprintf('%02d:%02d', $minutes, $seconds);

            $percentage = ($correctCount / $totalQuestions) * 100;

            $results = TestResult::where('test_attempt_id', $attempt->id)->get();
        }

        $studentDeadline = StudentDeadline::where('user_id', auth()->id())
            ->where('test_id', $test->id)
            ->first();

        return view('homepage.tests.index', compact('instructor', 'course', 'test', 'attempt', 'correctCount', 'totalQuestions', 'duration', 'percentage', 'results', 'testsCompleted', 'studentDeadline'));
    }

    public function takingTest(Test $test)
    {
        $attempt = TestAttempt::firstOrCreate(
            ['user_id' => auth()->id(), 'test_id' => $test->id],
            ['status' => 'Taking', 'created_at' => now(), 'updated_at' => now()]
        );

        $questions = $test->questions; // Lấy danh sách câu hỏi

        // Hiển thị thông báo xác nhận hoặc chuyển ngay đến trang làm bài
        return view('homepage.tests.taking', compact('test', 'attempt', 'questions'));
    }


    public function submitTest(Request $request, Test $test)
    {
        $answers = $request->input('answers', []);
        $correctCount = 0;
        $totalQuestions = $test->questions->count();

        $attempt = TestAttempt::where('user_id', auth()->id())
            ->where('test_id', $test->id)
            ->first();

        foreach ($test->questions as $question) {
            $selectedAnswer = $answers[$question->id] ?? 'Not Answered';
            $isCorrect = $selectedAnswer === $question->answer;

            if ($isCorrect) {
                $correctCount++;
            }

            TestResult::create([
                'test_attempt_id' => $attempt->id,
                'question_id' => $question->id,
                'selected_answer' => $selectedAnswer,
                'is_correct' => $isCorrect,
            ]);
        }

        $attempt->update([
            'status' => 'Completed',
            'completed_at' => now(),
        ]);

        $startTime = $attempt->created_at;
        $endTime = $attempt->updated_at;
        $minutes = $endTime->diffInMinutes($startTime);
        $seconds = $endTime->diffInSeconds($startTime) % 60;
        $duration = sprintf('%02d:%02d', $minutes, $seconds);
        $percentage = ($correctCount / $totalQuestions) * 100;

        return redirect()->route('test.view', $test->id)->with([
            'correctCount' => $correctCount,
            'totalQuestions' => $totalQuestions,
            'duration' => $duration,
            'percentage' => $percentage,
        ]);
    }

    public function showResults($id)
    {
        $test = Test::findOrFail($id);
        $course = $test->course;
        $instructor = $course->user;
        $user = Auth::user();
    
        $attempt = TestAttempt::where('user_id', $user->id)
            ->where('test_id', $test->id)
            ->first();
    
        $results = TestResult::where('test_attempt_id', $attempt->id)->get();
    
        $correctCount = $results->where('is_correct', true)->count();
        $totalQuestions = $test->questions->count();
        $percentage = ($totalQuestions > 0) ? ($correctCount / $totalQuestions) * 100 : 0;
        $startTime = $attempt->created_at;
        $endTime = $attempt->updated_at;
        $minutes = $endTime->diffInMinutes($startTime);
        $seconds = $endTime->diffInSeconds($startTime) % 60;
        $duration = sprintf('%02d:%02d', $minutes, $seconds);
    
        $questions = $test->questions->map(function ($question) use ($results) {
            $result = $results->firstWhere('question_id', $question->id);
            $selectedAnswer = $result->selected_answer ?? null;
            $correctAnswer = $question->answer;
            $questionText = $question->question;
    
            $answers = [
                'a' => $question->a,
                'b' => $question->b,
                'c' => $question->c,
                'd' => $question->d,
            ];
    
            return [
                'question_text' => $questionText,
                'selected_answer' => $selectedAnswer,
                'correct_answer' => $correctAnswer,
                'answers' => $answers,
            ];
        });
    
        $testsCompleted = Test::whereHas('testAttempts', function ($query) {
            $query->where('user_id', auth()->id())
                  ->where('status', 'Completed');
        })->get();
    
        return view('homepage.tests.results', compact('instructor', 'course', 'test', 'questions', 'correctCount', 'totalQuestions', 'percentage', 'duration', 'testsCompleted'));
    }
}
