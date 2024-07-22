@extends('layouts/userLO')

@section('main')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <img class="img-fluid mb-4" src="{{ asset('uploads/course/' . $course->image) }}" alt="{{ $course->course_name }}" width="">
            <!-- <h2>Course Description</h2>
            <p>{{ $course->description }}</p> -->
        </div>
        <div class="col-md-4">
            <h2>What You'll Learn</h2>
            <ul>
                
            </ul>
            
        </div>
    </div>
</div>
@endsection
