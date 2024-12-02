@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="questions-container">
            <h2 style="text-align: center; margin-bottom: 25px;">{{ $test->test_name }} - {{ $test->course->course_name }}
            </h2>
            <hr style="width: 50%; margin: 0 auto;">
            <h1 style="color: #007bff; margin: 20px 0">Result of {{ $attempt->user->fullname }}</h1>
            <div id="questions"></div>
            <div class="pagination" id="pagination"></div>
        </div>
    </div>
    <hr>
    <div class="row mt-5">
        <div class="col-md-12" style="padding: 10px;">
            <div class="card-comment p-3">
                <h3 class="text-center">Feedback</h3>
                @if ($attempt->feedbacks->isEmpty())
                    <form id="feedback-form" method="POST" action="{{ route('feedbacks.store') }}">
                        @csrf
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="group flex-grow-1 mr-2">
                                <input type="hidden" name="test_attempt_id" value="{{ $attempt->id }}">
                                <input required type="text" name="content" class="input" id="feedback-content">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Write feedback</label>
                            </div>
                            <button type="submit" class="btn-feedback"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                @else
                    <div id="feedbacks-list" class="mt-3">
                        @foreach ($attempt->feedbacks as $feedback)
                            <div class="feedback-box px-3" data-feedback-id="{{ $feedback->id }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="comment-content" style="font-size: 0.9em;">
                                        {{ $feedback->content }}
                                    </div>
                                    <div class="options">
                                        <button class="btn-options" onclick="toggleOptions(this)">...</button>
                                        <div class="options-menu" style="display: none;">
                                            <button onclick="updateFeedback({{ $feedback->id }})"><i
                                                    style="color: black; margin: 0 5px;"
                                                    class="bi bi-pen"></i>Update</button>
                                            <form method="POST" action="{{ route('feedbacks.destroy', $feedback->id) }}"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="confirmDelete(event, this)"><i style="color: black; margin: 0 5px;" class="bi bi-trash"></i>Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('feedbacks.update', $feedback->id) }}"
                                    style="display: none; width: 100%;" class="edit-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="group flex-grow-1 mr-2">
                                        <input type="text" name="content" class="input edit-feedback-input"
                                            value="{{ $feedback->content }}">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Update feedback</label>
                                    </div>
                                    <div class="button-group">
                                        <button type="button" class="btn-cancel" onclick="cancelEdit(this)">Cancel</button>
                                        <button type="submit" class="btn-save">Save</button>
                                    </div>
                                </form>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<style>
    .questions-container {
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
        margin-bottom: 20px;
    }

    .question-item {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
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

    .card-comment {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 10px;
        background-color: #fff;
    }

    .btn-feedback {
        background-color: #0088cc;
        color: #6c757d;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.3s;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-feedback:hover {
        transform: scale(1.1);
        color: #ffffff;
        background: #008cff;
        border: 1px solid #008cff;
        text-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 20px #ffffff;
        box-shadow: 0 0 5px #008cff, 0 0 20px #008cff, 0 0 50px #008cff, 0 0 100px #008cff;
    }

    .btn-feedback i {
        color: snow;
    }

    .btn-feedback:hover i {
        color: #ffffff;
    }

    .feedback-box .user-info {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .feedback-box .user-info img {
        border-radius: 50%;
        width: 30px;
        height: 30px;
        margin-right: 10px;
    }

    .feedback-box .user-info .user-name {
        font-weight: bold;
        font-size: 15px;
        text-decoration: underline;
    }

    .feedback-box .comment-content {
        font-size: 14px;
        color: #6c757d;
    }

    .group {
        display: inline-block;
        position: relative;
        align-items: center;
        margin-top: 10px;
        width: 100%;
    }

    .edit-feedback-input {
        flex-grow: 1;
    }

    .btn-cancel {
        display: inline-block;
        margin-right: 10px;
        margin-top: 20px;
        background-color: #515151;
        color: white;
        border: 1px solid #515151;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-save {
        display: inline-block;
        margin-right: 10px;
        margin-top: 20px;
        background-color: green;
        color: white;
        border: 1px solid green;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-cancel:hover,
    .btn-save:hover {
        background-color: #ddd;
        border: 1px solid #515151;
        color: #515151;
        transition: 0.3s;
    }

    .input {
        font-size: 16px;
        padding: 10px 0;
        display: block;
        width: 100%;
        border: none;
        border-bottom: 1px solid #515151;
        background: transparent;
        transition: border-color 0.3s;
    }

    .input:focus {
        outline: none;
        border-bottom: 2px solid #5264AE;
    }

    label {
        position: absolute;
        top: 10px;
        color: #999;
        font-size: 16px;
        transition: 0.2s ease all;
        pointer-events: none;
    }

    .input:focus~label,
    .input:valid~label {
        top: -20px;
        font-size: 14px;
        color: #5264AE;
    }

    .bar {
        position: relative;
        display: block;
        width: 100%;
    }

    .bar:before,
    .bar:after {
        content: '';
        height: 2px;
        width: 0;
        bottom: 1px;
        position: absolute;
        background: #5264AE;
        transition: 0.2s ease all;
    }

    .bar:before {
        left: 50%;
    }

    .bar:after {
        right: 50%;
    }

    .input:focus~.bar:before,
    .input:focus~.bar:after {
        width: 50%;
    }

    .highlight {
        position: absolute;
        height: 60%;
        width: 100px;
        top: 25%;
        left: 0;
        pointer-events: none;
        opacity: 0.5;
    }

    .input:focus~.highlight {
        animation: inputHighlighter 0.3s ease;
    }

    @keyframes inputHighlighter {
        from {
            background: #5264AE;
        }

        to {
            width: 0;
            background: transparent;
        }
    }

    .feedback-box {
        position: relative;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 10px;
        background-color: #f9f9f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-options {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 1.2em;
        padding: 5px;
        transition: transform 0.2s;
    }

    .options-menu {
        position: absolute;
        right: 0;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .options-menu button {
        display: block;
        width: 100%;
        padding: 10px;
        border: none;
        background: none;
        text-align: left;
        cursor: pointer;
    }

    .options-menu button:hover {
        background-color: #f1f1f1;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questions = @json($questions);
        const questionsPerPage = 5;
        let currentPage = 1;

        function renderQuestions() {
            const start = (currentPage - 1) * questionsPerPage;
            const end = start + questionsPerPage;
            const paginatedQuestions = questions.slice(start, end);

            const questionsContainer = document.getElementById('questions');
            questionsContainer.innerHTML = '';

            paginatedQuestions.forEach((question, index) => {
                const questionItem = document.createElement('div');
                questionItem.classList.add('question-item');
                questionItem.innerHTML = `
                    <h4>Question ${start + index + 1}: ${question.question_text}</h4>
                    <ul style="font-weight: 600">
                        ${['a', 'b', 'c', 'd'].map(option => {
                            let icon = '';
                            let textColor = 'black';
                            const answerText = question.answers[option] || '';
                            if (option === question.selected_answer && option === question.correct_answer) {
                                textColor = 'green';
                                icon = '<i class="bi bi-check-lg" style="color: green;"></i>';
                            } else if (option === question.selected_answer) {
                                textColor = 'red';
                                icon = '<i class="bi bi-x-lg" style="color: red;"></i>';
                            } else if (option === question.correct_answer) {
                                textColor = 'green';
                            }
                            return `<li style="color: ${textColor};">${option}. ${answerText} ${icon}</li>`;
                        }).join('')}
                    </ul>
                    <b>
                        <p style="color: #007bff">Correct answer: <strong>${question.correct_answer}</strong></p>
                    </b>
                `;
                questionsContainer.appendChild(questionItem);
            });

            renderPagination();
        }

        function renderPagination() {
            const paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = '';

            const totalPages = Math.ceil(questions.length / questionsPerPage);

            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.classList.toggle('active', i === currentPage);
                pageButton.addEventListener('click', function() {
                    currentPage = i;
                    renderQuestions();
                });
                paginationContainer.appendChild(pageButton);
            }
        }

        renderQuestions();

        // Cuộn đến feedback mới
        @if(session('new_feedback_id'))
            const newFeedbackId = {{ session('new_feedback_id') }};
            const newFeedbackElement = document.querySelector(`.feedback-box[data-feedback-id='${newFeedbackId}']`);
            if (newFeedbackElement) {
                newFeedbackElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        @endif

        // Cuộn đến feedback đã cập nhật
        @if(session('updated_feedback_id'))
            const updatedFeedbackId = {{ session('updated_feedback_id') }};
            const updatedFeedbackElement = document.querySelector(`.feedback-box[data-feedback-id='${updatedFeedbackId}']`);
            if (updatedFeedbackElement) {
                updatedFeedbackElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        @endif

        // Cuộn đến vị trí của feedback đã xóa
        @if(session('deleted_feedback_id'))
            const deletedFeedbackId = {{ session('deleted_feedback_id') }};
            const deletedFeedbackElement = document.querySelector(`.feedback-box[data-feedback-id='${deletedFeedbackId}']`);
            if (deletedFeedbackElement) {
                deletedFeedbackElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        @endif
    });

    function toggleOptions(button) {
        const menu = button.nextElementSibling;
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }

    function updateFeedback(feedbackId) {
        const feedbackBox = document.querySelector(`.feedback-box[data-feedback-id='${feedbackId}']`);
        const commentContent = feedbackBox.querySelector('.comment-content');
        const editForm = feedbackBox.querySelector('.edit-form');
        const btnOptions = feedbackBox.querySelector('.btn-options');
        const optionsMenu = feedbackBox.querySelector('.options-menu');
        const editInput = editForm.querySelector('.edit-feedback-input');

        // Ẩn nội dung hiện tại và hiển thị form để chỉnh sửa
        commentContent.style.display = 'none';
        editForm.style.display = 'block';
        btnOptions.style.display = 'none'; // Ẩn dấu ba chấm
        optionsMenu.style.display = 'none'; // Ẩn menu tùy chọn

        // Focus vào input
        editInput.focus();
        editInput.setSelectionRange(editInput.value.length, editInput.value.length);
    }

    function deleteFeedback(feedbackId) {
        const feedbackBox = document.querySelector(`.feedback - box[data - feedback - id = '${feedbackId}'] `);
        const optionsMenu = feedbackBox.querySelector('.options-menu');

        // Logic để xóa feedback (bạn cần thêm logic để xóa khỏi cơ sở dữ liệu)
        console.log('Delete feedback:', feedbackId);

        // Ẩn menu tùy chọn
        optionsMenu.style.display = 'none';
    }

    function cancelEdit(button) {
        const feedbackBox = button.closest('.feedback-box');
        const commentContent = feedbackBox.querySelector('.comment-content');
        const editForm = feedbackBox.querySelector('.edit-form');
        const btnOptions = feedbackBox.querySelector('.btn-options');

        commentContent.style.display = 'block';
        editForm.style.display = 'none';
        btnOptions.style.display = 'inline-block'; // Hiển thị lại dấu ba chấm
    }

    document.addEventListener('click', function(event) {
        const optionsMenus = document.querySelectorAll('.options-menu');
        optionsMenus.forEach(menu => {
            if (!menu.contains(event.target) && !menu.previousElementSibling.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    });
</script>
