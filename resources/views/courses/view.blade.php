@extends('layouts/userLO')

@section('main')
    <div class="container">
        <h1>{{ $course->course_name }}</h1>
        <p>{{ $course->description }}</p>

        <div class="pdf-viewer">
            <iframe src="{{ asset('uploads/course_file/' . $course->file) }}" width="100%" height="600px"></iframe>
        </div>

        <!-- Hiển thị các thông tin liên quan khác -->
        <div class="related-info">
            <!-- Thêm các thông tin liên quan ở đây -->
        </div>
    </div>
@endsection