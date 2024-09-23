@extends('layouts.userLO')

@section('main')
    <div class="container mt-5">
        <h2>My Learning</h2>
        @foreach ($courses as $course)
            <div class="card mt-3 shadow" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('uploads/course_image/' . $course->image) }}" alt="{{ $course->course_name }}"
                            style="width: 120px; height: 120px; border-radius: 15px; object-fit: cover;">
                        <div class="ml-3">
                            <span class="card-title"
                                style="font-weight: bold; color: #0c64f2; font-size: 28px;">{{ $course->course_name }}</span>
                            <p class="card-text mb-0 mt-2" style="font-size: 16px;">Course by
                                <strong>{{ $course->user->fullname }}</strong></p>
                            <p class="card-text" style="font-size: 14px; color: #6c757d;">Updated on:
                                {{ $course->updated_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('courses.view', $course->id) }}" class="btn-view-course"><span class="button_top">Go To Course</span></a>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .btn-view-course {
            --button_radius: 0.75em;
            --button_color: #2859f9;
            --button_outline_color: #000000;
            font-size: 17px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            border-radius: var(--button_radius);
            background: var(--button_outline_color);
        }

        .button_top {
            display: block;
            box-sizing: border-box;
            border: 2px solid var(--button_outline_color);
            border-radius: var(--button_radius);
            padding: 0.75em 1.5em;
            background: var(--button_color);
            color: #fff;
            transform: translateY(-0.2em);
            transition: transform 0.1s ease;
        }

        .btn-view-course:hover .button_top {
            /* Pull the button upwards when hovered */
            transform: translateY(-0.33em);
        }

        .btn-view-course:active .button_top {
            /* Push the button downwards when pressed */
            transform: translateY(0);
        }
    </style>
@endsection
