    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Taking Test</title>
    </head>

    <body>
        <div class="test-header" style="text-align: center;">
            <h1>{{ $test->test_name }}</h1>
            <div>
                <span id="remaining-time">Time Left: <span id="time-display">Loading...</span></span>
            </div>
        </div>
        <form action="{{ route('submit_test', $test->id) }}" method="POST" id="test-form">
            @csrf
            @foreach ($test->questions->chunk(2) as $questionChunk)
                <div class="row">
                    @foreach ($questionChunk as $index => $question)
                        <div class="col-md-6 question mb-4">
                            <h4 style="margin-top: 0;">{{ $index + 1 }}. {{ $question->question }}</h4>
                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                <div>
                                    <div class="option">
                                        <input type="radio" id="question_{{ $question->id }}_{{ $option }}"
                                            name="answers[{{ $question->id }}]" value="{{ $option }}"
                                            {{ old('answers.' . $question->id, session('answers.' . $question->id)) == $option ? 'checked' : '' }}>
                                        <label
                                            for="question_{{ $question->id }}_{{ $option }}">{{ $question->$option }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
            <div class="buttons my-4">
                <button type="submit" class="btn-submit">Submit</button>
            </div>
        </form>
    </body>

    </html>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .test-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .question {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .question:hover {
            transform: translateY(-5px);
        }

        .option {
            margin-top: 12px;
            font-size: 1.1rem;
        }

        .buttons {
            display: flex;
            justify-content: flex-start;
            margin-top: 25px;
        }

        .btn-reset,
        .btn-submit {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin-left: 15px;
        }

        .btn-reset:hover,
        .btn-submit:hover {
            border: 1px solid #007bff;
            background-color: #ffffff;
            color: #007bff;
            transform: translateY(-2px);
        }

        #remaining-time {
            font-size: 1.5rem;
            color: #dc3545;
            font-weight: bold;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const duration = {{ $test->test_time * 60 }};
            let endTime = localStorage.getItem('test_end_time_{{ $test->id }}');

            if (!endTime || {{ $attempt->status === 'Completed' ? 'true' : 'false' }}) {
                const now = new Date().getTime();
                endTime = now + duration * 1000;
                localStorage.setItem('test_end_time_{{ $test->id }}', endTime);
            }

            function updateTimer() {
                const now = new Date().getTime();
                const distance = endTime - now;

                if (distance <= 0) {
                    clearInterval(timerInterval);
                    localStorage.removeItem('test_end_time_{{ $test->id }}');
                    document.getElementById('test-form').submit();
                } else {
                    const minutes = Math.floor(distance / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById('time-display').innerText =
                        `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                }
            }

            const timerInterval = setInterval(updateTimer, 1000);
            updateTimer();

            const testForm = document.getElementById('test-form');
            testForm.addEventListener('submit', function(event) {
                event.preventDefault();

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
                        const radioButtons = document.querySelectorAll('input[type="radio"]');
                        radioButtons.forEach(radio => {
                            const questionId = radio.name.split('[')[1].split(']')[0];
                            localStorage.removeItem('answer_' + questionId);
                        });

                        localStorage.removeItem('test_end_time_{{ $test->id }}');
                        testForm.submit();
                    }
                });
            });

            const radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    const questionId = this.name.split('[')[1].split(']')[0];
                    localStorage.setItem('answer_' + questionId, this.value);
                });
            });

            radioButtons.forEach(radio => {
                const questionId = radio.name.split('[')[1].split(']')[0];
                const savedAnswer = localStorage.getItem('answer_' + questionId);
                if (savedAnswer && savedAnswer === radio.value) {
                    radio.checked = true;
                }
            });
        });
    </script>
