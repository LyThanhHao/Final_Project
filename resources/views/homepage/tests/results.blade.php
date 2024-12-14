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
                        Tests Completed<i class="bi bi-chevron-down ml-2"></i>
                    </button>
                    <div class="collapse" id="takenDropdown">
                        <ul class="list-unstyled ml-3">
                            @foreach ($testsCompleted as $data)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('test.results', $data->id) }}">
                                        <i class="bi bi-pencil mr-2"></i>{{ $data->test_name }}
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
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div class="percentage-box mb-2">
                    <h5>Percentage: <b style="color: white">{{ number_format($percentage, 2) }}%</b></h5>
                </div>
                <div class="score-box mb-2">
                    <h5>Score: <span style="color: white; font-weight: bold">{{ $correctCount }} / {{ $totalQuestions }}</span></h5>
                </div>
                <div class="time-box mb-2">
                    <h5>Time used: <br><span style="color: white; font-weight: bold">{{ $duration }}</span></h5>
                </div>
            </div>
            <hr>

            <!-- Phần hiển thị Feedback -->
            <div class="feedback-section mt-5">
                <h3 class="text-center">Feedback from Teacher</h3>
                @if ($attempt->feedbacks->isEmpty())
                    <p class="text-center">No feedback available.</p>
                @else
                    <div id="feedbacks-list" class="mt-3">
                        @foreach ($attempt->feedbacks as $feedback)
                            <div class="feedback-box px-3" data-feedback-id="{{ $feedback->id }}">
                                <div class="comment-content" style="font-size: 0.9em;">
                                    {{ $feedback->content }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="questions-container">
                @foreach ($questions as $index => $question)
                    <div class="question-item">
                        <h4>Question {{ $index + 1 }}: {{ $question['question_text'] }}</h4>
                        <ul style="font-weight: 600">
                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                @php
                                    $icon = '';
                                    $textColor = 'black';
                                    $answerText = $question['answers'][$option] ?? '';
                                    if (($question['selected_answer'] == "Not Answered")) {
                                        $textColor = 'black';
                                        $icon = '';
                                    } else if ($option == $question['selected_answer'] && $option == $question['correct_answer']) {
                                        $textColor = 'green';
                                        $icon = '<i class="bi bi-check-lg" style="color: green;"></i>';
                                    } elseif ($option == $question['selected_answer']) {
                                        $textColor = 'red';
                                        $icon = '<i class="bi bi-x-lg" style="color: red;"></i>';
                                    } elseif ($option == $question['correct_answer']) {
                                        $textColor = 'green';
                                    }
                                @endphp
                                <li style="color: {{ $textColor }};">
                                    {{ $option }}. {{ $answerText }} {!! $icon !!}
                                </li>
                            @endforeach
                        </ul>
                        <b>
                            <p style="color: #007bff">Correct answer: <strong>{{ $question['correct_answer'] }}</strong></p>
                            @if ($question['selected_answer'] == "Not Answered")
                                <p style="color: red">You did not select an answer.</p>
                            @endif
                        </b>
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
            margin-left: 1rem;
            margin-right: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .sidebar {
            height: fit-content;
            width: 100%;
            background: #e9e9e9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
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
            width: 100%;
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
            width: 100%;
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

        @media (min-width: 768px) {
            .main-content {
                flex-wrap: nowrap;
                margin-left: 3rem;
                margin-right: 2.5rem;
            }

            .sidebar {
                width: 25%;
                margin-bottom: 0;
            }

            .test-content {
                width: 75%;
            }

            .percentage-box, .score-box, .time-box {
                width: fit-content;
            }
        }

        .feedback-section {
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .feedback-box {
            position: relative;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment-content {
            font-size: 14px;
            color: #6c757d;
        }
    </style>

@endsection
