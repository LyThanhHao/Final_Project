@extends('layouts/userLO')

@section('main')
<div class="container">
    <h2 class="text-center my-5">Search results for "{{ $keyword }}"</h2>

    @if($courses->isEmpty())
        <p>No courses found.</p>
    @else
        <div class="row">
            @foreach($courses as $course)
            <a href="{{ route('courses.detail', $course->id) }}" title="{{ $course->course_name }}">
                <div id="course" class="col-lg-4 col-md-6 mb-4">
                    <div class="rounded overflow-hidden">
                        <img class="img-fluid" src="{{ asset('uploads/course/' . $course->image) }}" width="" alt="Web design & development courses for beginner" alt="$course->course_name">
                        <div class="bg-secondary p-4">
                            <a class="h6" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%; display: block; text-align: center;" title="{{ $course->course_name }}" href="">{{ $course->course_name }}</a>
                            <div class="border-top mt-3 pt-3 d-flex justify-content-center">
                                @if (empty($course->user->avatar))
                                    <img src="{{ asset('uploads/avatar/avatar_default.jpg') }}" alt="" style="border-radius: 50%; width: 30px; margin: 0 8px">                                        
                                @else
                                    <img src="{{ asset('uploads/avatar/' . $course->user->avatar) }}" alt="" style="border-radius: 50%; width: 30px; height: 30px; margin: 0 8px">
                                @endif
                                <a href="" style="text-decoration: underline;">{{ $course->user->fullname }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</div>
@endsection