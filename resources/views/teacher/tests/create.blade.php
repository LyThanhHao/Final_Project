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
                    <div class="form-group">
                        <label for="question_count">Number of Questions</label>
                        <select class="form-control" id="question_count" name="question_count" required>
                            <option value="">Choose the number of questions</option>
                            <option value="10">10 Questions</option>
                            <option value="20">20 Questions</option>
                        </select>
                    </div>
                    <div class="text-center my-4">
                        <hr class="w-50 mx-auto" style="border: 1px solid rgba(0, 0, 0, 0.2);">
                    </div>
                    <div id="questions-container">
                        <!-- Questions will be generated here -->
                    </div>
                    <div class="form-group text-center d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
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
        document.getElementById('question_count').addEventListener('change', function() {
            const questionsContainer = document.getElementById('questions-container');
            const questionCount = parseInt(this.value);
            questionsContainer.innerHTML = ''; // Clear existing questions

            for (let i = 0; i < questionCount; i++) {
                const newQuestionCard = document.createElement('div');
                newQuestionCard.classList.add('card', 'mt-4', 'question-card', 'shadow-sm');
                newQuestionCard.innerHTML = `
                    <div class="card-header text-center bg-secondary text-white">
                        <h4 style="color: aliceblue;">Question ${i + 1}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="questions[${i}][question]">Question</label>
                            <input type="text" class="form-control" id="questions[${i}][question]" name="questions[${i}][question]" placeholder="Enter question" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="questions[${i}][a]">A:</label>
                                <input type="text" class="form-control" id="questions[${i}][a]" name="questions[${i}][a]" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="questions[${i}][b]">B:</label>
                                <input type="text" class="form-control" id="questions[${i}][b]" name="questions[${i}][b]" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="questions[${i}][c]">C:</label>
                                <input type="text" class="form-control" id="questions[${i}][c]" name="questions[${i}][c]" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="questions[${i}][d]">D:</label>
                                <input type="text" class="form-control" id="questions[${i}][d]" name="questions[${i}][d]" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="questions[${i}][answer]">Answer</label>
                            <select class="form-control" id="questions[${i}][answer]" name="questions[${i}][answer]" required>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                    </div>
                `;
                questionsContainer.appendChild(newQuestionCard);
            }
        });

        // Trigger change event to generate initial questions
        document.getElementById('question_count').dispatchEvent(new Event('change'));
    </script>
@endsection