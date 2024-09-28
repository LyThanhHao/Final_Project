<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index($id)
    {
        $test = Test::findOrFail($id);
        $course = $test->course;
        $instructor = $course->user;

        return view('homepage.test.index', compact('test', 'course', 'instructor'));
    }
}
