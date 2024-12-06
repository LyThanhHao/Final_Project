@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 style="color: aliceblue;">List of Tests</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('teacher.tests.create') }}" class="btn btn-add mb-3">Add New Test</a>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="max-width: 35px;">No.</th>
                            <th>Test Name</th>
                            <th>Course Name</th>
                            <th style="width: 130px;">Questions Count</th>
                            <th style="width: 130px;">Deadline After</th>
                            <th style="width: 130px;">Test Time</th>
                            <th style="width: 130px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tests as $test)
                            <tr>
                                <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                <td>{{ $test->test_name }}</td>
                                <td>{{ $test->course->course_name }}</td>
                                <td style="text-align: center;">{{ $test->questions->count() }}</td>
                                <td style="text-align: center;">{{ $test->deadline_after }} days</td>
                                <td style="text-align: center;">{{ $test->test_time }} minutes</td>
                                <td style="text-align: center; position: relative;">
                                    <button class="btn btn-toggle" onclick="toggleActions(this)"><i class="bi bi-list"></i></button>
                                    <div class="action-buttons" style="display: none; position: absolute; top: 75%; left: 50%; transform: translateX(-50%); width: 75%; z-index: 1; background: white; border: 1px solid #ccc; border-radius: 5px; padding: 5px;">
                                        <a href="{{ route('teacher.tests.edit', $test->id) }}" class="btn btn-edit"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('teacher.tests.destroy', $test->id) }}" method="POST" style="display:inline-block; width: 100%;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-delete" type="button" onclick="confirmDelete(event, this)"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
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
        }

        td:hover {
            background-color: #f1f1f1;
        }

        th {
            font-size: 13px;
            text-align: center;
            align-content: center;
        }

        .btn-add {
            background-color: #28a745;
            transition: background-color 0.3s, transform 0.3s;
            color: white;
            border-radius: 1em;
        }

        .btn-add:hover {
            transform: scale(1.05);
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .btn-detail {
            background-color: steelblue;
            color: white;
            margin-bottom: 10px;
            width: 100%;
            padding: 5px;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 13px;
        }

        .btn-detail:hover {
            border: 1px solid black;
            background-color: white;
            color: black;
            transform: scale(1.05);
        }

        .btn-edit {
            background-color: green;
            color: white;
            margin-bottom: 10px;
            width: 100%;
            padding: 5px;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 13px;
        }

        .btn-edit:hover {
            border: 1px solid black;
            background-color: white;
            color: black;
            transform: scale(1.05);
        }

        .btn-delete {
            background-color: red;
            color: white;
            width: 100%;
            padding: 5px;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 13px;
        }

        .btn-delete:hover {
            border: 1px solid black;
            background-color: white;
            color: black;
            transform: scale(1.05);
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
