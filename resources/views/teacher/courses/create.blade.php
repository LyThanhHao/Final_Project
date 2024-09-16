@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white">
                <h3 style="color: aliceblue;">Create a new course</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="course_name">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" value="{{ old('course_name') }}" required>
                        @error('course_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" style="margin-bottom: 0">Course Image</label>
                        <br>
                        <img id="current-image" src="{{ old('image') ? asset('uploads/course_image/' . old('image')) : '' }}" alt="" class="img-thumbnail mt-2" style="width: 100px; height: 100px;">
                        <br>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="file" class="form-control-file mb-3" id="image" name="image" required onchange="previewImage(event)">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Course File</label>
                        <br>
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="file" class="form-control-file mb-3" id="file" name="file" required onchange="updateFileName(event)">
                    </div>
                    <div class="form-group mb-3">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-add btn-block">Add Course</button>
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
            width: 20%;
        }

        .btn-add:hover {
            transform: scale(1.05);
            color: black;
            background-color: white;
            border: 1px solid black;
        }

        .card {
            border-radius: 15px;
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }

        .card-body {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .form-control {
            border-radius: 5px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            transition: box-shadow 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
        
    </style>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('current-image');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    
        function updateFileName(event) {
            var fileInput = event.target;
            var fileName = fileInput.files[0].name;
            var currentFileLink = document.getElementById('current-file');
            currentFileLink.textContent = fileName;
        }
    </script>
@endsection()
