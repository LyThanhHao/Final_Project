@extends('layouts/userLO')

@section('main')
    <div class="main-content">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Hiển thị ảnh và tên của khóa học -->
            <div class="course-header mb-4 text-center">
                <img src="{{ asset('uploads/avatar/' . $instructor->avatar) }}" alt="{{ $instructor->fullname }}"
                    class="img-fluid mb-2" style="max-height: 150px; width: 50px; border-radius: 10px">
                <div>
                    <span style="font-style: italic">{{ $instructor->fullname }}</span>
                </div>
                <div>
                    <b style="color: rgb(71, 99, 255)">{{ $course->course_name }}</b>
                </div>
                <div>
                    <span style="font-size: 13px">Updated at: {{ ($course->updated_at)->format('d/m/Y') }}</span>
                </div>
            </div>
            <hr>
            <ul class="list-unstyled">
                <li class="dropdown mb-2">
                    <button id="dropdown-taken"
                        class="w-100 text-left d-flex align-items-center dropdown-toggle toggle-arrow no-chevron"
                        type="button" data-toggle="collapse" data-target="#takenDropdown" aria-expanded="false"
                        aria-controls="takenDropdown">
                        Tests Taken<i class="bi bi-chevron-down ml-2"></i>
                    </button>
                    <div class="collapse" id="takenDropdown">
                        <ul class="list-unstyled ml-3">
                            @foreach ($takenTests as $takenTest)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('test.results', $takenTest->id) }}">
                                        <i class="bi bi-pencil mr-2"></i>{{ $takenTest->test_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="dropdown mb-2">
                    <button class="w-100 text-left d-flex align-items-center dropdown-toggle toggle-arrow no-chevron"
                        type="button" data-toggle="collapse" data-target="#testDropdown" aria-expanded="false"
                        aria-controls="testDropdown">
                        Tests of this course<i class="bi bi-chevron-down ml-2"></i>
                    </button>
                    <div class="collapse" id="testDropdown">
                        <ul class="list-unstyled ml-3">
                            @foreach ($course->tests as $test)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('test.view', $test->id) }}">
                                        <i class="bi bi-pencil mr-2"></i>{{ $test->test_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Nội dung PDF -->
        <div class="pdf-content">
            <iframe src="{{ asset('uploads/course_file/' . $course->file) }}" width="100%" height="600px"></iframe>
        </div>
    </div>

    <style>
        .main-content {
            display: flex;
            gap: 20px;
            margin-left: 3.5rem;
            margin-right: 3.5rem;
            margin-top: 2rem;
        }

        .sidebar {
            height: fit-content;
            width: 25%;
            background: #e9e9e9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }

        .sidebar a {
            display: block;
            color: #333;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s, border-left 0.3s;
            padding: 8px 0;
            border-left: 3px solid transparent;
        }

        .sidebar a:hover {
            color: #007bff;
            border-left: 3px solid #007bff;
            background-color: #dadbdb;
        }

        button {
            border: none;
            background: none;
            padding: 0;
            display: block;
            color: #333;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s, border-left 0.3s;
            padding: 8px 0;
            border-left: 3px solid transparent;
            width: 100%;
            text-align: left;
        }

        button:hover {
            color: #007bff;
            border-left: 3px solid #007bff;
            background-color: #dadbdb
        }

        .dropdown-toggle::after {
            display: none;
        }

        .collapse ul {
            margin-top: 5px;
        }

        .dropdown-item {
            padding: 5px 0;
            transition: background-color 0.3s;
        }

        .dropdown-item i {
            color: #999;
        }

        .dropdown-item:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .badge {
            font-size: 0.75rem;
            background: #007bff;
        }

        .pdf-content {
            width: 75%;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .pdf-content {
                width: 100%;
            }
        }
    </style>

    <script>
        document.querySelectorAll('.toggle-arrow').forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (this.getAttribute('aria-expanded') === 'true') {
                    icon.classList.remove('bi-chevron-up');
                    icon.classList.add('bi-chevron-down');
                } else {
                    icon.classList.remove('bi-chevron-down');
                    icon.classList.add('bi-chevron-up');
                }
            });
        });
    </script>
@endsection
