<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use App\Models\TestAttempt;
use App\Models\TestResult;
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

        $takenTests = TestAttempt::whereHas('test', function ($query) {
            $query->where('user_id', auth()->id())
                  ->where('status', 'Completed');
        })->get();

        $correctCount = 0;
        $totalQuestions = $test->questions->count();
        $duration = null;
        $percentage = null;
        $results = collect();

        if ($attempt && $attempt->status == 'Completed') {
            $correctCount = TestResult::where('test_attempt_id', $attempt->id)
                ->where('is_correct', true)
                ->count();

            $duration = $attempt->updated_at->diffForHumans($attempt->created_at);
            $percentage = ($correctCount / $totalQuestions) * 100;

            $results = TestResult::where('test_attempt_id', $attempt->id)->get();
        }

        return view('homepage.tests.index', compact('instructor', 'course', 'test', 'attempt', 'correctCount', 'totalQuestions', 'duration', 'percentage', 'results', 'takenTests'));
    }

    public function takingTest(Test $test)
    {
        $attempt = TestAttempt::firstOrCreate(
            ['user_id' => auth()->id(), 'test_id' => $test->id],
            ['status' => 'Taking', 'created_at' => now(), 'updated_at' => now()]
        );

        // Hiển thị thông báo xác nhận hoặc chuyển ngay đến trang làm bài
        return view('homepage.tests.taking', compact('test', 'attempt'));
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

        $duration = $attempt->updated_at->diffForHumans($attempt->created_at);
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
        $duration = $attempt ? $attempt->updated_at->diffForHumans($attempt->created_at) : 'N/A';
    
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
    
        $takenTests = Test::whereHas('testAttempts', function ($query) {
            $query->where('user_id', auth()->id())
                  ->where('status', 'Completed');
        })->get();
    
        return view('homepage.tests.results', compact('instructor', 'course', 'test', 'questions', 'correctCount', 'totalQuestions', 'percentage', 'duration', 'takenTests'));
    }
}
