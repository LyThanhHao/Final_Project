@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3>Create a new question</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.questions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="test_id" value="{{ $test->id }}">
                    <div id="questions-container">
                        <div class="card mt-4 question-card">
                            <div class="card-header text-center">
                                <h3 style="color: aliceblue;">Question 1</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="questions[0][question]">Question</label>
                                    <input type="text" class="form-control" id="questions[0][question]" name="questions[0][question]" placeholder="Enter question" value="{{ old('questions[0][question]') }}" required>
                                    @error('questions[0][question]')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="questions[0][a]">A:</label>
                                        <input type="text" class="form-control" id="questions[0][a]" name="questions[0][a]" value="{{ old('questions[0][a]') }}" required>
                                        @error('questions[0][a]')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="questions[0][b]">B:</label>
                                        <input type="text" class="form-control" id="questions[0][b]" name="questions[0][b]" value="{{ old('questions[0][b]') }}" required>
                                        @error('questions[0][b]')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="questions[0][c]">C:</label>
                                        <input type="text" class="form-control" id="questions[0][c]" name="questions[0][c]" value="{{ old('questions[0][c]') }}" required>
                                        @error('questions[0][c]')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="questions[0][d]">D:</label>
                                        <input type="text" class="form-control" id="questions[0][d]" name="questions[0][d]" value="{{ old('questions[0][d]') }}" required>
                                        @error('questions[0][d]')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="questions[0][answer]">Answer</label>
                                    <select class="form-control" id="questions[0][answer]" name="questions[0][answer]" required>
                                        <option value="a" {{ old('questions[0][answer]') == 'a' ? 'selected' : '' }}>A</option>
                                        <option value="b" {{ old('questions[0][answer]') == 'b' ? 'selected' : '' }}>B</option>
                                        <option value="c" {{ old('questions[0][answer]') == 'c' ? 'selected' : '' }}>C</option>
                                        <option value="d" {{ old('questions[0][answer]') == 'd' ? 'selected' : '' }}>D</option>
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
                        <button type="button" class="btn btn-next" id="add-question">Next Question</button>
                        <button type="submit" class="btn btn-submit">Create Questions</button>
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

        .card-header {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }
    </style>

    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            const questionsContainer = document.getElementById('questions-container');
            const questionCount = questionsContainer.getElementsByClassName('question-card').length;
            const newQuestionIndex = questionCount;

            const newQuestionCard = document.createElement('div');
            newQuestionCard.classList.add('card', 'mt-4', 'question-card');
            newQuestionCard.innerHTML = `
                <div class="card-header text-center">
                    <h3 style="color: aliceblue;">Question ${newQuestionIndex + 1}</h3>
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
                        <button type="button" class="btn btn-secondary remove-question">Remove</button>
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