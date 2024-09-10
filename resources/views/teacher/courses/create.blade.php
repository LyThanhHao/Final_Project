@extends('layouts/teacherLO')

@section('main')
    <div class="content mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3>Add New Course</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="course_name">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" required>
                        @error('course_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" style="margin-bottom: 0">Course Image</label>
                        <br>
                        <img id="current-image" src="" alt="" style="border-radius: 5px; width: 70px; height: 70px; margin-top: 5px;">
                        <br>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="file" style="border: solid 1px; padding: 5px; width: 100%; border-radius: 5px; margin-bottom: 15px;" id="image" name="image" required onchange="previewImage(event)">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label le="margin-bottom: 0" for="file">Course File</label>
                        <br>
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="file" style="border: solid 1px; padding: 5px; width: 100%; border-radius: 5px; margin-bottom: 10px;" id="file" name="file" required onchange="updateFileName(event)">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-add">Add Course</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .btn-add {
            background-color: #28a745;
            transition: background-color 0.3s, transform 0.3s;
            color: white;
            border: 1px solid black;
        }

        .btn-add:hover {
            background-color: #28a745;
            transform: scale(1.05);
            color: black;
            background-color: white;
            border: 1px solid black;
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
