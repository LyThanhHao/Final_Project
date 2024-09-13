@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card shadow-lg">
            <div class="card-header text-center bg-primary text-white">
                <h3 style="color: aliceblue;">Edit Question</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.questions.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" name="question" placeholder="Enter question" value="{{ old('question', $question->question) }}" required>
                        @error('question')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="a">A:</label>
                            <input type="text" class="form-control" id="a" name="a" value="{{ old('a', $question->a) }}" required>
                            @error('a')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="b">B:</label>
                            <input type="text" class="form-control" id="b" name="b" value="{{ old('b', $question->b) }}" required>
                            @error('b')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="c">C:</label>
                            <input type="text" class="form-control" id="c" name="c" value="{{ old('c', $question->c) }}" required>
                            @error('c')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="d">D:</label>
                            <input type="text" class="form-control" id="d" name="d" value="{{ old('d', $question->d) }}" required>
                            @error('d')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer:</label>
                        <select class="form-control" id="answer" name="answer" required>
                            <option value="a" {{ old('answer', $question->answer) == 'a' ? 'selected' : '' }}>A</option>
                            <option value="b" {{ old('answer', $question->answer) == 'b' ? 'selected' : '' }}>B</option>
                            <option value="c" {{ old('answer', $question->answer) == 'c' ? 'selected' : '' }}>C</option>
                            <option value="d" {{ old('answer', $question->answer) == 'd' ? 'selected' : '' }}>D</option>
                        </select>
                        @error('answer')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('teacher.tests.detail', $question->test_id) }}" class="btn btn-secondary">Back to Questions List</a>
                        <button type="submit" class="btn btn-edit">Update Question</button>
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

        .card {
            border-radius: 10px;
        }

        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .form-control {
            border-radius: 5px;
        }

        .card-header {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }
    </style>
@endsection