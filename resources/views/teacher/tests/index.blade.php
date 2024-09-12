@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3>Tests Management</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('teacher.tests.create') }}" class="btn btn-add mb-3">Add New Test</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="max-width: 20px;">No.</th>
                            <th>Test Name</th>
                            <th>Course Name</th>
                            <th style="max-width: 35px;">Questions Count</th>
                            <th style="max-width: 50px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tests as $test)
                            <tr>
                                <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                <td>{{ $test->test_name }}</td>
                                <td>{{ $test->course->course_name }}</td>
                                <td style="text-align: center;">{{ $test->questions->count() }}</td>
                                <td style="text-align: center; max-width: 50px;">
                                    <a href="{{ route('teacher.tests.detail', $test->id) }}" class="btn btn-detail">View detail</a>
                                    <a href="{{ route('teacher.tests.edit', $test->id) }}" class="btn btn-edit"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('teacher.tests.destroy', $test->id) }}" method="POST" style="display:inline-block; width: 100%;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-delete" type="submit" onclick="confirmDelete(event)"><i class="bi bi-trash"></i></button>
                                    </form>
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
            border: 1px solid black;
        }

        .btn-add:hover {
            background-color: #28a745;
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
        }

        .btn-detail:hover {
            border: 1px solid black;
            background-color: white;
            color: black;
        }

        .btn-edit {
            background-color: green; 
            color: white; 
            margin-bottom: 10px; 
            width: 100%;
            padding: 5px;
        }

        .btn-edit:hover {
            border: 1px solid black;
            background-color: white;
            color: black;
        }

        .btn-delete {
            background-color: red; 
            color: white; 
            width: 100%;
            padding: 5px;
        }

        .btn-delete:hover {
            border: 1px solid black;
            background-color: white;
            color: black;
        }
    </style>
@endsection()
