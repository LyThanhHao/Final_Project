@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3>Questions table of "{{ $test->test_name }}"</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('teacher.questions.create', $test->id) }}" class="btn btn-add mb-3">Add New Question</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="max-width: 20px;">No.</th>
                            <th>Question</th>
                            <th style="max-width: 30px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                <td>{{ $question->question }}</td>
                                <td style="text-align: center; max-width: 50px;">
                                    <div style="display: flex; justify-content: space-around; align-items: center;">
                                        <a href="{{ route('teacher.questions.edit', $question->id) }}" style="margin-right: 10px;">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('teacher.questions.destroy', $question->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button style="border: none; background-color: transparent;" type="submit" onclick="confirmDelete(event)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display: flex; justify-content: center;">
                    <a href="{{ route('teacher.tests.index') }}" class="btn btn-back mb-3">Back to Tests List</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        td {
            font-size: 13px;
        }

        th {
            font-size: 15px;
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

        .btn-back {
            background-color: grey;
            transition: background-color 0.3s, transform 0.3s;
            color: white;
            border: 1px solid black;
        }

        .btn-back:hover {
            background-color: #28a745;
            transform: scale(1.05);
            color: black;
            background-color: white;
            border: 1px solid black;
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
