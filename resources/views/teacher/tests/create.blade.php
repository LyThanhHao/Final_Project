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
                    <div class="form-group">
                        <label for="deadline_after">Deadline after (days)</label>
                        <input type="number" class="form-control" id="deadline_after" name="deadline_after" min="1" value="1" required>
                        @error('deadline_after')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="test_time">Test Time (minutes)</label>
                        <select class="form-control" id="test_time" name="test_time" required>
                            <option value="10" {{ old('test_time') == 10 ? 'selected' : '' }}>10 minutes</option>
                            <option value="20" {{ old('test_time') == 20 ? 'selected' : '' }}>20 minutes</option>
                            <option value="30" {{ old('test_time') == 30 ? 'selected' : '' }}>30 minutes</option>
                            <option value="40" {{ old('test_time') == 40 ? 'selected' : '' }}>40 minutes</option>
                            <option value="50" {{ old('test_time') == 50 ? 'selected' : '' }}>50 minutes</option>
                            <option value="60" {{ old('test_time') == 60 ? 'selected' : '' }}>60 minutes</option>
                        </select>
                        @error('test_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination button {
            margin: 0 5px;
            padding: 5px 10px;
            border: none;
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .pagination button.active {
            background-color: #007bff;
            color: white;
        }

        .pagination button:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionCountElement = document.getElementById('question_count');
            const questionsContainer = document.getElementById('questions-container');
            const questionData = {};

            function renderQuestions() {
                const questionCount = parseInt(questionCountElement.value);
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
                                <textarea type="text" class="form-control" id="questions[${i}][question]" name="questions[${i}][question]" placeholder="Enter question" required>${questionData[i]?.question || ''}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="questions[${i}][a]">A:</label>
                                    <input type="text" class="form-control" id="questions[${i}][a]" name="questions[${i}][a]" value="${questionData[i]?.a || ''}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="questions[${i}][b]">B:</label>
                                    <input type="text" class="form-control" id="questions[${i}][b]" name="questions[${i}][b]" value="${questionData[i]?.b || ''}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="questions[${i}][c]">C:</label>
                                    <input type="text" class="form-control" id="questions[${i}][c]" name="questions[${i}][c]" value="${questionData[i]?.c || ''}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="questions[${i}][d]">D:</label>
                                    <input type="text" class="form-control" id="questions[${i}][d]" name="questions[${i}][d]" value="${questionData[i]?.d || ''}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="questions[${i}][answer]">Answer</label>
                                <select class="form-control" id="questions[${i}][answer]" name="questions[${i}][answer]" required>
                                    <option value="a" ${questionData[i]?.answer === 'a' ? 'selected' : ''}>A</option>
                                    <option value="b" ${questionData[i]?.answer === 'b' ? 'selected' : ''}>B</option>
                                    <option value="c" ${questionData[i]?.answer === 'c' ? 'selected' : ''}>C</option>
                                    <option value="d" ${questionData[i]?.answer === 'd' ? 'selected' : ''}>D</option>
                                </select>
                            </div>
                        </div>
                    `;
                    questionsContainer.appendChild(newQuestionCard);
                }
            }

            questionCountElement.addEventListener('change', function() {
                renderQuestions();
            });

            // Trigger change event to generate initial questions
            questionCountElement.dispatchEvent(new Event('change'));
        });

        window.addEventListener('scroll', function() {
            const scrollToTopBtn = document.getElementById('scrollToTopBtn');
            if (window.scrollY > 200) {
                scrollToTopBtn.style.display = 'block';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        });

        document.getElementById('scrollToTopBtn').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const deadlineInput = document.getElementById('deadline');
            const now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset()); // Điều chỉnh múi giờ
            const formattedNow = now.toISOString().slice(0, 16); // Định dạng thành 'YYYY-MM-DDTHH:MM'
            deadlineInput.setAttribute('min', formattedNow);
        });
    </script>
@endsection