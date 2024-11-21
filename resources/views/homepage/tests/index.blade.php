@extends('layouts/userLO')

@section('main')
    <div class="main-content">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Hiển thị ảnh và tên của khóa học -->
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
                                        href="{{ route('test.results', $takenTest->test->id) }}">
                                        <i class="bi bi-pencil mr-2"></i>{{ $takenTest->test->test_name }}
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

        <!-- Nội dung chính của trang index bài test -->
        <div class="test-content">
            <h1>Practice Test - {{ $test->test_name }}</h1>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h4>Submit your test</h4>
                @if ($attempt && $attempt->status == 'Completed')
                    <button class="btn-completed" disabled>Completed</button>
                @else
                    @php
                        $isOverdue = $studentDeadline && \Carbon\Carbon::now()->greaterThan($studentDeadline->deadline);
                    @endphp

                    @if ($isOverdue)
                        <button class="btn-overdue" disabled>Overdue</button>
                    @else
                        <a href="{{ route('taking_test', $test->id) }}" id="take-test-btn"
                            class="btn-start">{{ $attempt ? 'Resume' : 'Take The Test' }}</a>
                    @endif
                @endif
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span style="font-size: 14px; color: #6c757d;">
                    Deadline:
                    <b>
                        @if ($studentDeadline)
                            {{ \Carbon\Carbon::parse($studentDeadline->deadline)->format('d/m/Y, H:i') }}
                        @else
                            Not set
                        @endif
                    </b>
                </span>
                <div>
                    <span style="font-size: 14px; color: #6c757d;">
                        Number of Questions: <b>{{ $test->questions->count() }}</b>
                    </span>
                    <br>
                    <span style="font-size: 14px; color: #6c757d;">
                        Test Time: <b>{{ $test->test_time }} minutes</b>
                    </span>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between mt-4" style="align-items: center;">
                <div>
                    <h5>Receive grades</h5>
                    <p><b style="color: rgb(71, 99, 255)">To Pass </b><span class="text-muted">65% or higher</span></p>
                    @if($attempt && $attempt->status == 'Completed')
                        <div class="percentage-box">
                            <h5>Percentage: <b style="color: white">{{ number_format($percentage, 2) }}%</b></h5>
                        </div>
                    @endif
                </div>
                <hr style="width: 1px; height: 65px; background-color: #e9ecef; border: none; margin-right: 40px;">
                <div class="score-container">
                    @if($attempt && $attempt->status == 'Completed')
                        <div class="score-box">
                            <h5>Score: <span style="color: white; font-weight: bold">{{ $correctCount }} /
                                    {{ $totalQuestions }}</span></h5>
                        </div>
                        <div class="time-box">
                            <h5>Time used: <br><span style="color: white; font-weight: bold">{{ $duration }}</span></h5>
                        </div>
                    @else
                        <b style="color: red">Not Submitted</b>
                    @endif
                </div>
            </div>
            <hr>
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
            background-color: #dadbdb
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

        .badge {
            font-size: 0.75rem;
            background: #007bff;
        }

        .test-content {
            width: 75%;
            padding: 20px;
        }

        .test-content h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        .test-content h4,
        .test-content h5 {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .test-content p {
            font-size: 1rem;
        }

        .test-content .btn {
            font-size: 1rem;
            padding: 10px 20px;
        }

        .test-content .text-muted {
            color: #6c757d;
        }

        .test-content a {
            color: #007bff;
            text-decoration: none;
        }

        .test-content a:hover {
            text-decoration: underline;
        }

        .btn-start {
            background-color: #007bff;
            color: white !important;
            border-radius: 5px;
            padding: 10px 20px;
            border: 1px solid #007bff;
            width: max-content;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none !important;
        }

        .btn-start:hover {
            background-color: #fff;
            color: #007bff !important;
            border: 1px solid #007bff;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
            text-decoration: none !important;
        }

        .btn-completed {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            border: 1px solid #28a745;
            width: max-content;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            cursor: not-allowed;
        }

        .score-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .score-box, .percentage-box, .time-box {
            padding: 10px;
            border-radius: 10px;
            color: white;
            text-align: center;
            width: fit-content  ;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .score-box {
            background: linear-gradient(135deg, #d4a5ff, #b084cc);
        }

        .percentage-box {
            background: linear-gradient(135deg, #66cc99, #33cc66);
        }

        .time-box {
            background: linear-gradient(135deg, #ffcc99, #ff9966);
        }

        .score-box h5, .percentage-box h5, .time-box h5 {
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .score-box p, .percentage-box p, .time-box p {
            font-size: 1.5rem;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .test-content {
                width: 100%;
            }
        }

        .btn-overdue {
            background-color: #dc3545; /* Màu đỏ */
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            border: 1px solid #dc3545;
            width: max-content;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            cursor: not-allowed;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const takeTestBtn = document.getElementById('take-test-btn');

            takeTestBtn.addEventListener('click', function(event) {
                if (takeTestBtn.innerText.trim() === 'Take The Test') {
                    event.preventDefault(); // Ngăn điều hướng mặc định
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to take this exam now, your time will start automatically",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, start now!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = takeTestBtn
                            .href; // Điều hướng nếu người dùng xác nhận
                        }
                    });
                }
            });
        });
    </script>
@endsection
