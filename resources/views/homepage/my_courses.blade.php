@extends('layouts.userLO')

@section('main')
    <div class="container mt-5">
        <h2>My Learning</h2>
        @if ($courses->isEmpty())
            <hr style="width: 75%;">
            <p style="text-align: center; font-size: 20px; font-weight: 500; color: red;">You will find your in-progress
                courses here.</p>
        @else
            @foreach ($courses as $course)
                <div class="card mt-3 shadow"
                    style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); position: relative;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('uploads/course_image/' . $course->image) }}" alt="{{ $course->course_name }}"
                                style="width: 120px; height: 120px; border-radius: 15px; object-fit: cover;">
                            <div class="ml-3" style="max-width: 75%">
                                <div>
                                    <span style="font-size: 14px;">{{ $course->user->fullname }}</span>
                                    <br>
                                    <a href="{{ route('courses.detail', $course->id) }}" id="course-name"
                                        style="font-weight: bold; color: #0c64f2; font-size: 28px;">{{ $course->course_name }}</a>
                                </div>
                                <div style="margin-top: 5px;">
                                    <span class="card-text" style="font-size: 14px; color: #6c757d;">Updated on:
                                        {{ $course->updated_at->format('d/m/Y') }}</span>
                                    <br>
                                    <strong>Test completed: </strong><span>0/5</span>
                                </div>
                            </div>
                        </div>
                        <hr style="width: 1px; height: 100px; background-color: #e9ecef; border: none; margin-right: 10px;">
                        <a href="{{ route('courses.view', $course->id) }}" class="btn-view-course"><span class="button_top">Go To Course</span></a>
                    </div>

                    <div class="dropdown" style="position: absolute; top: 10px; right: 10px;">
                        <button class="dropdown-toggle" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form id="unenroll-form-{{ $course->id }}" action="{{ route('courses.unenroll', $course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="dropdown-item unenroll-btn" data-course-id="{{ $course->id }}">Unenroll</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <style>
        .btn-view-course {
            --button_radius: 0.75em;
            --button_color: #0cf259;
            --button_outline_color: #000000;
            font-size: 17px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            border-radius: var(--button_radius);
            background: var(--button_outline_color);
            margin: 0 20px;
        }

        .button_top {
            display: block;
            box-sizing: border-box;
            border: 2px solid var(--button_outline_color);
            border-radius: var(--button_radius);
            padding: 10px;
            background: var(--button_color);
            color: #fff;
            transform: translateY(-0.2em);
            transition: transform 0.1s ease;
            font-size: 15px;
            width: max-content;
        }

        .btn-view-course:hover .button_top {
            transform: translateY(-0.33em);
        }

        .btn-view-course:active .button_top {
            transform: translateY(0);
        }

        #course-name:hover {
            text-decoration: underline;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            color: #0c64f2;
            padding: 0;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 20px;
            right: 0;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
            z-index: 1000;
            min-width: 100px;
            padding: 0;
            list-style: none;
        }

        .dropdown-menu li {
            text-align: left;
        }

        .dropdown-menu .dropdown-item {
            padding: 10px 15px;
            cursor: pointer;
            color: #333;
            background: none;
            border: none;
            width: 100%;
            text-align: center;
        }

        .dropdown-toggle::after {
            display: none !important;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #0c64f2;
            color: white;
            transition: 0.3s;
            border: none;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').on('click', function(e) {
                $(this).toggleClass('active');
                $(this).next('.dropdown-menu').toggle();
            });

            $(window).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').hide();
                    $('.dropdown-toggle').removeClass('active');
                }
            });

            $('.unenroll-btn').on('click', function(e) {
                e.preventDefault();
                const courseId = $(this).data('course-id');
                Swal.fire({
                    title: "Are you sure you want to un-enroll?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    width: 650,
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, unenroll it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Unenrolled!",
                            text: "You have been unenrolled from the course.",
                            icon: "success"
                        }).then(() => {
                            $(`#unenroll-form-${courseId}`).submit();
                        });
                    }
                });
            });
        });
    </script>
@endsection
