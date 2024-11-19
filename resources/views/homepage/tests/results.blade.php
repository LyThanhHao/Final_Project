@extends('layouts/userLO')

@section('main')
    <div class="main-content">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="course-header mb-4 text-center">
                <img src="{{ asset('uploads/avatar/' . $instructor->avatar) }}" alt="{{ $instructor->fullname }}"
                    class="img-fluid mb-2" style="max-height: 150px; width: 50px; border-radius: 10px">
                <div>
                    <span style="font-style: italic">{{ $instructor->fullname }}</span>
                </div>
                <div>
                    <b style="color: rgb(71, 99, 255)">{{ $course->course_name }}</b>
                </div>
                <div>
                    <span style="font-size: 13px">Updated at: {{ $course->updated_at->format('d/m/Y') }}</span>
                </div>
            </div>
            <hr>
            <ul class="list-unstyled">
                <li class="dropdown mb-2">
                    <button id="dropdown-taken"
                        class="w-100 text-left d-flex align-items-center dropdown-toggle toggle-arrow no-chevron"
                        type="button" data-toggle="collapse" data-target="#takenDropdown" aria-expanded="false"
                        aria-controls="takenDropdown">
                        Tests Taken<i class="bi bi-chevron-down ml-2"></i>
                    </button>
                    <div class="collapse" id="takenDropdown">
                        <ul class="list-unstyled ml-3">
                            @foreach ($takenTests as $takenTest)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('test.results', $takenTest->id) }}">
                                        <i class="bi bi-pencil mr-2"></i>{{ $takenTest->test_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="dropdown mb-2">
                    <button id="dropdown-test"
                        class="w-100 text-left d-flex align-items-center dropdown-toggle toggle-arrow no-chevron"
                        type="button" data-toggle="collapse" data-target="#testDropdown" aria-expanded="false"
                        aria-controls="testDropdown">
                        Tests of this course<i class="bi bi-chevron-down ml-2"></i>
                    </button>
                    <div class="collapse" id="testDropdown">
                        <ul class="list-unstyled ml-3">
                            @foreach ($course->tests as $test)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('test.view', $test->id) }}">
                                        <i class="bi bi-pencil mr-2"></i>{{ $test->test_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Nội dung chính của trang kết quả -->
        <div class="test-content">
            <h1>{{ $test->test_name }}</h1>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="percentage-box">
                    <h5>Percentage: <b style="color: white">{{ number_format($percentage, 2) }}%</b></h5>
                </div>
                <div class="score-box">
                    <h5>Score: <span style="color: white; font-weight: bold">{{ $correctCount }} / {{ $totalQuestions }}</span></h5>
                </div>
                <div class="time-box">
                    <h5>Time used: <br><span style="color: white; font-weight: bold">{{ $duration }}</span></h5>
                </div>
            </div>
            <hr>
            <div class="questions-container">
                @foreach ($questions as $index => $question)
                    <div class="question-item">
                        <h4>Question {{ $index + 1 }}: {{ $question['question_text'] }}</h4>
                        <ul>
                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                @php
                                    $textColor = 'black';
                                    $answerText = $question['answers'][$option] ?? '';
                                    if ($option == $question['selected_answer'] && $option == $question['correct_answer']) {
                                        $textColor = 'green';
                                    } elseif ($option == $question['selected_answer']) {
                                        $textColor = 'red';
                                    } elseif ($option == $question['correct_answer']) {
                                        $textColor = 'green';
                                    }
                                @endphp
                                <li style="color: {{ $textColor }};">
                                    {{ $option }}. {{ $answerText }}
                                </li>
                            @endforeach
                        </ul>
                        <p>Correct answer: <strong>{{ $question['correct_answer'] }}</strong></p>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .main-content {
            display: flex;
            gap: 20px;
            margin-left: 3rem;
            margin-right: 2.5rem;
            margin-top: 2rem;
        }

        .sidebar {
            height: fit-content;
            width: 25%;
            background: #e9e9e9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }

        .sidebar a {
            display: block;
            color: #333;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s, border-left 0.3s;
            padding: 8px 0;
            border-left: 3px solid transparent;
        }

        .sidebar a:hover {
            color: #007bff;
            border-left: 3px solid #007bff;
            background-color: #dadbdb;
        }

        #dropdown-test, #dropdown-taken {
            border: none;
            background: none;
            padding: 0;
            display: block;
            color: #333;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s, border-left 0.3s;
            padding: 8px 0;
            border-left: 3px solid transparent;
            width: 100%;
            text-align: left;
        }

        #dropdown-test:hover, #dropdown-taken:hover {
            color: #007bff;
            border-left: 3px solid #007bff;
            background-color: #dadbdb;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .collapse ul {
            margin-top: 5px;
        }

        .dropdown-item {
            padding: 5px 0;
            transition: background-color 0.3s;
        }

        .dropdown-item i {
            color: #999;
        }

        .dropdown-item:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .test-content {
            width: 75%;
            padding: 20px;
        }

        .test-summary {
            margin-bottom: 20px;
        }

        .questions-container .question-item {
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
        }

        .questions-container ul {
            list-style-type: none;
            padding: 0;
        }

        .questions-container ul li {
            padding: 5px;
        }

        .percentage-box, .score-box, .time-box {
            padding: 10px;
            border-radius: 10px;
            color: white;
            text-align: center;
            width: fit-content;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .percentage-box {
            background: linear-gradient(135deg, #66cc99, #33cc66);
        }

        .score-box {
            background: linear-gradient(135deg, #d4a5ff, #b084cc);
        }

        .time-box {
            background: linear-gradient(135deg, #ffcc99, #ff9966);
        }

        .percentage-box h5, .score-box h5, .time-box h5 {
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
    </style>
@endsection
