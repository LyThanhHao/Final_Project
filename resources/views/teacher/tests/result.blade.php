@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 style="color: aliceblue;">Test Results</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="max-width: 30px;">No.</th>
                            <th>Student Name</th>
                            <th>Test Name</th>
                            <th>Course Name</th>
                            <th style="width: 100px;">Correct Answers</th>
                            <th style="width: 90px;">Time Used</th>
                            <th style="width: 80px;">Feedback</th>
                            <th style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $index => $result)
                            <tr>
                                <td class="text-center font-weight-bold">{{ $index + 1 }}</td>
                                <td>{{ $result['student_name'] }}</td>
                                <td>{{ $result['test_name'] }}</td>
                                <td>{{ $result['course_name'] }}</td>
                                <td style="text-align: center;">{{ $result['correct_answers'] }}</td>
                                <td style="text-align: center;">{{ $result['time_used'] }}</td>
                                <td style="text-align: center; font-size: 20px;">
                                    @if ($result['has_feedback'])
                                    <i class="bi bi-check-circle-fill" style="color: green;"></i>
                                    @else
                                    <i class="bi bi-x-circle-fill" style="color: red;"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('teacher.tests.result_detail', $result['test_id']) }}" class="btn btn-detail">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        td {
            font-size: 13px;
            transition: background-color 0.3s;
            align-content: center;
        }

        td:hover {
            background-color: #f1f1f1;
        }

        th {
            font-size: 13px;
            text-align: center;
            align-content: center;
        }

        .btn-detail {
            background-color: #007bff;
            color: white;
            width: 100%;
            padding: 5px;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 13px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-detail:hover {
            border: 1px solid black;
            background-color: white;
            color: black;
            transition: 0.3s;
        }

        .btn-toggle {
            background-color: transparent;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .btn-toggle i {
            color: #007bff;
        }

        .btn-toggle.active i {
            color: red;
        }

        .action-buttons {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }

        .card-header {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }
    </style>
@endsection
