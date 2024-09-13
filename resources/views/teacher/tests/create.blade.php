@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white">
                <h3 style="color: aliceblue;">Create a new test</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.tests.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="test_name">Test name</label>
                        <input type="text" class="form-control" id="test_name" name="test_name"
                            placeholder="Enter test name" value="{{ old('test_name') }}" required>
                        @error('test_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="course_id">Course name</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                            <option value="">Select course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-center my-4">
                        <hr class="w-50 mx-auto" style="border: 1px solid rgba(0, 0, 0, 0.2);">
                    </div>
                    <div id="questions-container">
                        <div class="card mt-4 question-card shadow-sm">
                            <div class="card-header text-center text-white" style="background-color: #007bff;">
                                <h4 style="color: aliceblue;">Question 1</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="questions[0][question]">Question</label>
                                    <input type="text" class="form-control" id="questions[0][question]"
                                        name="questions[0][question]" placeholder="Enter question"
                                        value="{{ old('questions[0][question]') }}" required>
                                    @error('questions[0][question]')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="questions[0][a]">A:</label>
                                        <input type="text" class="form-control" id="questions[0][a]"
                                            name="questions[0][a]" value="{{ old('questions[0][a]') }}" required>
                                        @error('questions[0][a]')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="questions[0][b]">B:</label>
                                        <input type="text" class="form-control" id="questions[0][b]"
                                            name="questions[0][b]" value="{{ old('questions[0][b]') }}" required>
                                        @error('questions[0][b]')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="questions[0][c]">C:</label>
                                        <input type="text" class="form-control" id="questions[0][c]"
                                            name="questions[0][c]" value="{{ old('questions[0][c]') }}" required>
                                        @error('questions[0][c]')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="questions[0][d]">D:</label>
                                        <input type="text" class="form-control" id="questions[0][d]"
                                            name="questions[0][d]" value="{{ old('questions[0][d]') }}" required>
                                        @error('questions[0][d]')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="questions[0][answer]">Answer</label>
                                    <select class="form-control" id="questions[0][answer]" name="questions[0][answer]"
                                        required>
                                        <option value="a" {{ old('questions[0][answer]') == 'a' ? 'selected' : '' }}>A
                                        </option>
                                        <option value="b" {{ old('questions[0][answer]') == 'b' ? 'selected' : '' }}>B
                                        </option>
                                        <option value="c" {{ old('questions[0][answer]') == 'c' ? 'selected' : '' }}>C
                                        </option>
                                        <option value="d" {{ old('questions[0][answer]') == 'd' ? 'selected' : '' }}>D
                                        </option>
                                    </select>
                                    @error('questions[0][answer]')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group text-center d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-remove remove-question">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center d-flex justify-content-between mt-4">
                        <button type="button" id="add-question" class="btn btn-next">Next Question</button>
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .btn {
            background-color: #28a745;
            transform: scale(1.05);
            color: black;
            background-color: white;
            border-radius: 1em;
        }

        .btn-remove {
            background-color: #dc3545;
            color: white;
        }

        .btn-next {
            background-color: #007bff;
            color: white;
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
        }

        .btn:hover {
            background-color: #28a745;
            transform: scale(1.05);
            color: black;
            background-color: white;
            border: 1px solid black;
        }
        .card {
            border-radius: 10px;
        }

        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }

        .card-body {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .form-control {
            border-radius: 5px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            transition: box-shadow 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>

    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            const questionsContainer = document.getElementById('questions-container');
            const questionCount = questionsContainer.getElementsByClassName('question-card').length;
            const newQuestionIndex = questionCount;

            const newQuestionCard = document.createElement('div');
            newQuestionCard.classList.add('card', 'mt-4', 'question-card', 'shadow-sm');
            newQuestionCard.innerHTML = `
                <div class="card-header text-center bg-secondary text-white">
                    <h4 style="color: aliceblue;">Question ${newQuestionIndex + 1}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="questions[${newQuestionIndex}][question]">Question</label>
                        <input type="text" class="form-control" id="questions[${newQuestionIndex}][question]" name="questions[${newQuestionIndex}][question]" placeholder="Enter question" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="questions[${newQuestionIndex}][a]">A:</label>
                            <input type="text" class="form-control" id="questions[${newQuestionIndex}][a]" name="questions[${newQuestionIndex}][a]" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="questions[${newQuestionIndex}][b]">B:</label>
                            <input type="text" class="form-control" id="questions[${newQuestionIndex}][b]" name="questions[${newQuestionIndex}][b]" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="questions[${newQuestionIndex}][c]">C:</label>
                            <input type="text" class="form-control" id="questions[${newQuestionIndex}][c]" name="questions[${newQuestionIndex}][c]" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="questions[${newQuestionIndex}][d]">D:</label>
                            <input type="text" class="form-control" id="questions[${newQuestionIndex}][d]" name="questions[${newQuestionIndex}][d]" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="questions[${newQuestionIndex}][answer]">Answer</label>
                        <select class="form-control" id="questions[${newQuestionIndex}][answer]" name="questions[${newQuestionIndex}][answer]" required>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                    </div>
                    <div class="form-group text-center d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-danger remove-question">Remove</button>
                    </div>
                </div>
            `;

            questionsContainer.appendChild(newQuestionCard);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-question')) {
                e.target.closest('.question-card').remove();
            }
        });
    </script>
@endsection
