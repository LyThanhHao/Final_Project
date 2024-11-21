@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 style="color: aliceblue;">Edit Test</h3>
            </div>
            <div class="card-body">
                <form id="edit-test-form" action="{{ route('teacher.tests.update', $test->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="test_name">Test Name</label>
                        <input type="text" class="form-control" id="test_name" name="test_name"
                            placeholder="Enter test name" value="{{ old('test_name', $test->test_name) }}" required>
                        @error('test_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="hidden" name="course_id" value="{{ $test->course_id }}">
                    {{-- <div class="form-group">
                        <label for="course_id">Course Name</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ old('course_id', $test->course_id) == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="question_count">Number of Questions</label>
                        <select class="form-control" id="question_count" name="question_count" required>
                            <option value="10" {{ count($test->questions) == 10 ? 'selected' : '' }}>10 Questions
                            </option>
                            <option value="20" {{ count($test->questions) == 20 ? 'selected' : '' }}>20 Questions
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deadline_after">Deadline after (days)</label>
                        <input type="number" class="form-control" id="deadline_after" name="deadline_after" min="1" value="{{ old('deadline_after', $test->deadline_after) }}" required>
                        @error('deadline_after')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="test_time">Test Time (minutes)</label>
                        <select class="form-control" id="test_time" name="test_time" required>
                            <option value="10" {{ old('test_time', $test->test_time) == 10 ? 'selected' : '' }}>10 minutes</option>
                            <option value="20" {{ old('test_time', $test->test_time) == 20 ? 'selected' : '' }}>20 minutes</option>
                            <option value="30" {{ old('test_time', $test->test_time) == 30 ? 'selected' : '' }}>30 minutes</option>
                            <option value="40" {{ old('test_time', $test->test_time) == 40 ? 'selected' : '' }}>40 minutes</option>
                            <option value="50" {{ old('test_time', $test->test_time) == 50 ? 'selected' : '' }}>50 minutes</option>
                            <option value="60" {{ old('test_time', $test->test_time) == 60 ? 'selected' : '' }}>60 minutes</option>
                        </select>
                        @error('test_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-center my-4">
                        <hr class="w-50 mx-auto" style="border: 1px solid rgba(0, 0, 0, 0.2);">
                    </div>
                    <div id="questions-container">
                        @foreach ($test->questions as $index => $question)
                            <div class="card mt-4 question-card shadow-sm">
                                <div class="card-header text-center text-white" style="background-color: #007bff;">
                                    <h4 style="color: aliceblue;">Question {{ $index + 1 }}</h4>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="questions[{{ $index }}][id]"
                                        value="{{ $question->id }}">
                                    <div class="form-group">
                                        <label for="questions[{{ $index }}][question]">Question</label>
                                        <textarea type="text" class="form-control"
                                            id="questions[{{ $index }}][question]"
                                            name="questions[{{ $index }}][question]" placeholder="Enter question"
                                            required>{{ old('questions.' . $index . '.question', $question->question) }}</textarea>
                                        @error('questions.' . $index . '.question')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="questions[{{ $index }}][a]">A:</label>
                                            <input type="text" class="form-control"
                                                id="questions[{{ $index }}][a]"
                                                name="questions[{{ $index }}][a]"
                                                value="{{ old('questions.' . $index . '.a', $question->a) }}" required>
                                            @error('questions.' . $index . '.a')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="questions[{{ $index }}][b]">B:</label>
                                            <input type="text" class="form-control"
                                                id="questions[{{ $index }}][b]"
                                                name="questions[{{ $index }}][b]"
                                                value="{{ old('questions.' . $index . '.b', $question->b) }}" required>
                                            @error('questions.' . $index . '.b')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="questions[{{ $index }}][c]">C:</label>
                                            <input type="text" class="form-control"
                                                id="questions[{{ $index }}][c]"
                                                name="questions[{{ $index }}][c]"
                                                value="{{ old('questions.' . $index . '.c', $question->c) }}" required>
                                            @error('questions.' . $index . '.c')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="questions[{{ $index }}][d]">D:</label>
                                            <input type="text" class="form-control"
                                                id="questions[{{ $index }}][d]"
                                                name="questions[{{ $index }}][d]"
                                                value="{{ old('questions.' . $index . '.d', $question->d) }}" required>
                                            @error('questions.' . $index . '.d')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="questions[{{ $index }}][answer]">Answer</label>
                                        <select class="form-control" id="questions[{{ $index }}][answer]"
                                            name="questions[{{ $index }}][answer]" required>
                                            <option value="a"
                                                {{ old('questions.' . $index . '.answer', $question->answer) == 'a' ? 'selected' : '' }}>
                                                A</option>
                                            <option value="b"
                                                {{ old('questions.' . $index . '.answer', $question->answer) == 'b' ? 'selected' : '' }}>
                                                B</option>
                                            <option value="c"
                                                {{ old('questions.' . $index . '.answer', $question->answer) == 'c' ? 'selected' : '' }}>
                                                C</option>
                                            <option value="d"
                                                {{ old('questions.' . $index . '.answer', $question->answer) == 'd' ? 'selected' : '' }}>
                                                D</option>
                                        </select>
                                        @error('questions.' . $index . '.answer')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group d-flex justify-content-between mt-4">
                        <a href="{{ route('teacher.tests.index') }}" class="btn btn-back">Back to Tests List</a>
                        <button type="submit" class="btn btn-edit">Update Test</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .form-group label {
            font-weight: bold;
        }

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

    <script>
        document.getElementById('question_count').addEventListener('change', function() {
            const questionsContainer = document.getElementById('questions-container');
            const questionCount = parseInt(this.value);
            const currentQuestions = questionsContainer.getElementsByClassName('question-card').length;

            if (questionCount > currentQuestions) {
                for (let i = currentQuestions; i < questionCount; i++) {
                    const newQuestionCard = document.createElement('div');
                    newQuestionCard.classList.add('card', 'mt-4', 'question-card', 'shadow-sm');
                    newQuestionCard.innerHTML = `
                        <div class="card-header text-center bg-secondary text-white">
                            <h4 style="color: aliceblue;">Question ${i + 1}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="questions[${i}][question]">Question</label>
                                <textarea type="text" class="form-control" id="questions[${i}][question]" name="questions[${i}][question]" placeholder="Enter question" required></textarea>
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
            } else if (questionCount < currentQuestions) {
                for (let i = currentQuestions; i > questionCount; i--) {
                    questionsContainer.removeChild(questionsContainer.lastChild);
                }
            }
        });

        document.getElementById('edit-test-form').addEventListener('submit', function(event) {
            const questionsContainer = document.getElementById('questions-container');
            const questionCards = questionsContainer.getElementsByClassName('question-card');
            let allFieldsFilled = true;

            for (let card of questionCards) {
                const inputs = card.querySelectorAll('input, select');
                for (let input of inputs) {
                    if (!input.value) {
                        allFieldsFilled = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                }
            }

            if (!allFieldsFilled) {
                event.preventDefault();
                alert('Please fill out all questions before submitting.');
            }
        });

        // Trigger change event to adjust questions on page load
        document.getElementById('question_count').dispatchEvent(new Event('change'));

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
    </script>
@endsection
