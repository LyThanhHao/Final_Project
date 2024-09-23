@extends('layouts/userLO')

@section('main')
    <div class="container">
        <div class="pdf-viewer">
            <iframe src="{{ asset('uploads/course_file/' . $course->file) }}" width="100%" height="600px"></iframe>
        </div>

        <div class="related-info">
            <!-- Thêm các thông tin liên quan ở đây -->
        </div>
    </div>
@endsection