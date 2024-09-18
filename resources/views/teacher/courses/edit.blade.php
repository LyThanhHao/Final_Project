@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white">
                <h3 style="color: aliceblue;">Edit Course</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="course_name">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name"
                            value="{{ $course->course_name }}" required>
                        @error('course_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" style="margin-bottom: 0">Course Image</label>
                        <br>
                        <img id="current-image" src="{{ asset('uploads/course_image/' . $course->image) }}" alt=""
                            style="border-radius: 5px; width: 70px; height: 70px; margin-top: 5px;">
                        <br>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="file"
                            style="border: solid 1px; padding: 5px; width: 100%; border-radius: 5px; margin: 10px 0;"
                            id="image" name="image" onchange="previewImage(event)">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $course->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label le="margin-bottom: 0" for="file">Course File</label>
                        <br>
                        <a id="current-file" href="{{ asset('uploads/course_file/' . $course->file) }}"
                            target="_blank">{{ $course->file }}</a>
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="file"
                            style="border: solid 1px; padding: 5px; width: 100%; border-radius: 5px; margin: 10px 0;"
                            id="file" name="file" onchange="updateFileName(event)">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category_id" required>
                            @foreach ($categories as $category)
                                @if ($category->status)
                                    <option value="{{ $category->id }}"
                                        {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->cat_name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option style="color: black;" value="0" {{ $course->status == '0' ? 'selected' : '' }}>
                                Hidden</option>
                            <option style="color: black;" value="1" {{ $course->status == '1' ? 'selected' : '' }}>
                                Public</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-add">Update Course</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .btn-add {
            background-color: #28a745;
            transition: background-color 0.3s, transform 0.3s;
            color: white;
            border-radius: 1em;
        }

        .btn-add:hover {
            transform: scale(1.05);
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            border-radius: 0.5rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        label {
            font-weight: bold;
            color: #44425A;
        }

        .card {
            border-radius: 1rem;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }

        .card-body {
            background-color: #f8f9fa;
        }
    </style>

@endsection()
