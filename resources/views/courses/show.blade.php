@extends('layouts/userLO')

@section('main')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Result for</h5>
            <h1>{{ $category->cat_name }}</h1>
        </div>
        <div class="row">
            @foreach($courses as $course)
            <a href="{{ route('courses.detail', $course->id) }}" title="{{ $course->course_name }}">
                <div id="course" class="col-lg-4 col-md-6 mb-4">
                    <div class="rounded overflow-hidden">
                        <img class="img-fluid" src="{{ asset('uploads/course/' . $course->image) }}" width="" alt="{{ $course->course_name }}">
                        <div class="bg-secondary p-4">
                            <a class="h6" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%; display: block; text-align: center;" title="{{ $course->course_name }}" href="">{{ $course->course_name }}</a>
                            <div class="border-top mt-3 pt-3 d-flex justify-content-center">
                                <img src="{{ asset('uploads/avatar/' . $course->user->avatar) }}" alt="" style="border-radius: 50%; width: 30px; margin: 0 8px">
                                <a href="" style="text-decoration: underline;">{{ $course->user->fullname }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection()
