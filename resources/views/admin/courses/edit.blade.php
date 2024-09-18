@extends('layouts/adminLO')

@section('main')

<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-center">Edit Course</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('admin.courses.update', ['course' => $course->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="course_name">Course Name</label>
              <input type="text" class="form-control" id="course_name" name="course_name" value="{{ $course->course_name }}">
              @error('course_name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="image">Course Image</label><br>
              <img id="current-image" src="{{ asset('uploads/course_image/' . $course->image) }}" alt="" style="border-radius: 5px; width: 70px; height: 70px; margin-top: 10px;">
            </div>
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <input type="file" class="form-control mb-3" id="image" name="image" onchange="previewImage(event)">
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $course->description }}">
                @error('description')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>              
            <div class="form-group">
              <label for="file">File</label><br>
              <a id="current-file" href="{{ asset('uploads/course_file/' . $course->file) }}" target="_blank">{{ $course->file }}</a>
            </div>
            @error('file')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <input type="file" class="form-control mb-3" id="file" name="file" onchange="updateFileName(event)">
            <div class="form-group">
              <label for="category_id">Category</label>
              <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $category)
                    @if($category->status)
                        <option style="color: black" value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
                    @endif
                @endforeach
              </select>
              @error('category_id')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="teacher">Teacher</label>
              <select name="teacher" id="teacher" class="form-control">
                @foreach($teachers as $teacher)
                    @if($teacher->role == 'Teacher')
                        <option style="color: black" value="{{ $teacher->id }}" {{ $course->user_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->fullname }}</option>
                    @endif
                @endforeach
              </select>
              @error('teacher')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option style="color: black;" value="0" {{ $course->status == '0' ? 'selected' : '' }}>Hidden</option>
                <option style="color: black;" value="1" {{ $course->status == '1' ? 'selected' : '' }}>Public</option>
              </select>
              @error('status')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <button type="submit" class="btn-update">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection()
