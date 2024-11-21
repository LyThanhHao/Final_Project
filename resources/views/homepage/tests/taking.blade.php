@extends('layouts/userLO')

@section('main')
    <div class="test-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ $test->test_name }}</h1>
            <div>
                <span id="remaining-time">Remaining Time: <span id="time-display">Loading...</span></span>
            </div>
        </div>
    </div>

    <form action="{{ route('submit_test', $test->id) }}" method="POST" id="test-form">
        @csrf
        @foreach ($test->questions as $index => $question)
            <div class="question mb-4">
                <h4>{{ $index + 1 }}. {{ $question->question }}</h4>
                @foreach (['a', 'b', 'c', 'd'] as $option)
                    <div class="option">
                        <input type="radio" id="question_{{ $question->id }}_{{ $option }}"
                            name="answers[{{ $question->id }}]" value="{{ $option }}"
                            {{ old('answers.' . $question->id) == $option ? 'checked' : '' }}>
                        <label for="question_{{ $question->id }}_{{ $option }}">{{ $question->$option }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach
        <div class="buttons mt-4">
            <button type="reset" class="btn-reset">Reset</button>
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
@endsection

<style>
    .test-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 10px;
        background-color: #e9ecef;
        border-radius: 5px;
    }

    .question {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
    }

    .option {
        margin-left: 20px;
        margin-top: 10px;
    }

    .buttons {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .btn-reset,
    .btn-submit {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-left: 10px;
    }

    .btn-reset:hover,
    .btn-submit:hover {
        background-color: #218838;
    }

    #remaining-time {
        font-size: 1.25rem;
        color: #dc3545;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Thiết lập thời gian
        const duration = {{ $test->test_time * 60 }}; // giả sử test_time là phút
        let endTime = localStorage.getItem('test_end_time_{{ $test->id }}');

        if (!endTime || {{ $attempt->status === 'Completed' ? 'true' : 'false' }}) {
            // Nếu không có thời gian kết thúc hoặc bài thi đã hoàn thành, thiết lập lại thời gian
            const now = new Date().getTime();
            endTime = now + duration * 1000;
            localStorage.setItem('test_end_time_{{ $test->id }}', endTime);
        }

        function updateTimer() {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance <= 0) {
                clearInterval(timerInterval);
                // Tự động submit bài thi khi hết giờ
                document.getElementById('test-form').submit();
                // Xóa dữ liệu thời gian trong localStorage
                localStorage.removeItem('test_end_time_{{ $test->id }}');
            } else {
                const minutes = Math.floor(distance / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById('time-display').innerText =
                    `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            }
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        // Xóa dữ liệu thời gian khi người dùng submit bài thi bằng tay
        const testForm = document.getElementById('test-form');
        testForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn chặn hành động submit mặc định

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to submit your test?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    testForm.submit(); // Thực hiện submit nếu người dùng xác nhận
                }
            });
        });
    });
</script>
