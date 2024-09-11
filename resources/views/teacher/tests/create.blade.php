@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3>Create a new test</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.tests.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="test_name">Test name</label>
                        <input type="text" class="form-control" id="test_name" name="test_name" placeholder="Enter test name" value="{{ old('test_name') }}" required>
                        @error('test_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="course_id">Course name</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                            <option value="">Select course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" name="question" placeholder="Enter question" value="{{ old('question') }}" required>
                        @error('question')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="a">A:</label>
                            <input type="text" class="form-control" id="a" name="a" value="{{ old('a') }}" required>
                            @error('a')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="b">B:</label>
                            <input type="text" class="form-control" id="b" name="b" value="{{ old('b') }}" required>
                            @error('b')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="c">C:</label>
                            <input type="text" class="form-control" id="c" name="c" value="{{ old('c') }}" required>
                            @error('c')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="d">D:</label>
                            <input type="text" class="form-control" id="d" name="d" value="{{ old('d') }}" required>
                            @error('d')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer:</label>
                        <select class="form-control" id="answer" name="answer" required>
                            <option value="a" {{ old('answer') == 'a' ? 'selected' : '' }}>A</option>
                            <option value="b" {{ old('answer') == 'b' ? 'selected' : '' }}>B</option>
                            <option value="c" {{ old('answer') == 'c' ? 'selected' : '' }}>C</option>
                            <option value="d" {{ old('answer') == 'd' ? 'selected' : '' }}>D</option>
                        </select>
                        @error('answer')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <button type="submit" class="btn btn-add">Add Test</button>
                </form>
            </div>
        </div>
    </div>

    <style>
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
    </style>
@endsection