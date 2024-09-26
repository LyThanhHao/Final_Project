@extends('layouts.userLO')

@section('main')
    <div class="container mt-5">
        <h2>My Learning</h2>
        @if ($courses->isEmpty())
            <hr style="width: 75%;">
            <p style="text-align: center; font-size: 20px; font-weight: 500; color: red;">You will find your in-progress courses here.</p>
        @else
            @foreach ($courses as $course)
                <div class="card mt-3 shadow" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('uploads/course_image/' . $course->image) }}" alt="{{ $course->course_name }}"
                                style="width: 120px; height: 120px; border-radius: 15px; object-fit: cover;">
                            <div class="ml-3">
                                <div>
                                    <span style="font-size: 14px;">{{$course->user->fullname}}</span>
                                    <br>
                                    <span style="font-weight: bold; color: #0c64f2; font-size: 28px;">{{ $course->course_name }}</span>
                                </div>
                                <div style="margin-top: 5px;">
                                    <span class="card-text" style="font-size: 14px; color: #6c757d;">Updated on:
                                        {{ $course->updated_at->format('d/m/Y') }}</span>
                                    <br>
                                    <strong>Test completed: </strong><span>0/5</span>
                                </div>
                            </div>
                        </div>
                        <hr style="width: 1px; height: 100px; background-color: #e9ecef; border: none; margin-right: 50px;">
                        <a href="{{ route('courses.view', $course->id) }}" class="btn-view-course"><span class="button_top">Go To Course</span></a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <style>
        .btn-view-course {
            --button_radius: 0.75em;
            --button_color: #0c64f2;
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
