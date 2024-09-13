@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 style="color: aliceblue;">Edit Test</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.tests.update', $test->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="test_name">Test Name</label>
                        <input type="text" class="form-control" id="test_name" name="test_name" placeholder="Enter test name" value="{{ old('test_name', $test->test_name) }}" required>
                        @error('test_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="course_id">Course Name</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id', $test->course_id) == $course->id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('teacher.tests.index') }}" class="btn btn-back">Back to Tests List</a>
                        <button type="submit" class="btn btn-edit">Update Test</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .btn-edit {
            background-color: #28a745;
            transition: background-color 0.3s, transform 0.3s;
            color: white;
            border-radius: 1em;
        }

        .btn-edit:hover {
            transform: scale(1.05);
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .btn-back {
            background-color: gray;
            color: white;
            margin-bottom: 10px;
            padding: 5px 10px;
        }

        .btn-back:hover {
            transform: scale(1.05);
            border: 1px solid black;
            background-color: white;
            color: black;
        }

        .card-header {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }
    </style>
@endsection