@extends('layouts/adminLO')

@section('main')
<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-center">Table of Courses</h3>
        </div>
        <div class="card-body">
          <a href="{{ route('admin.courses.create') }}" class="btn-add">Create New Course</a>
          <div>
            <table class="table table-striped" id="">
              <thead class="text-primary">
                <tr>
                  <th>Course Name</th>
                  <th>Course Image</th>
                  <th>Description</th>
                  <th>File</th>
                  <th>Category</th>
                  <th>Teacher</th>
                  <th>Status</th>
                  <th style="text-align: center;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($courses as $course)
                <tr>
                  <td style="max-width: 180px;">{{ $course->course_name }}</td>
                  <td><img src="{{ asset('uploads/course_image/' . $course->image) }}" alt="" style="border-radius: 5px; width: 70px; height: 70px;"></td>
                  <td style="max-width: 180px;">{{ $course->description }}</td>
                  <td style="max-width: 180px; overflow: hidden; white-space: nowrap;">
                    <a href="{{ asset('uploads/course_file/' . $course->file) }}" 
                       style="display: inline-block; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; max-width: 100%;" target="_blank">
                       <i class="fas fa-file-pdf"></i> {{ $course->file }}
                    </a>
                  </td>                
                  <td style="max-width: 100px;">{{ $course->category->cat_name }}</td>
                  <td>{{ $course->user->fullname }}</td>
                  <td style="color: {{ $course->status == 0 ? 'gray !important' : '#00f708 !important' }};">{{ $course->status == 0 ? 'Hidden' : 'Publish' }}</td>  
                  <td style="text-align: center;">
                    <a href="{{ route('admin.courses.edit', $course->id) }}"><i class="bi bi-pencil-square" style="color: white; margin: 0 5px;"></i></a>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="confirmDelete(event, this)" style="border: none; background: border-box; color: white;"><i class="bi bi-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
@if (Session::has('fail'))
<script>
    $.toast({
        heading: 'Notification',
        text: "{{ Session::get('fail') }}",
        showHideTransition: 'slide',
        position: 'top-center',
        icon: 'error',
        hideAfter: 5000
    })
</script>
@endif  

@if (Session::has('success'))
<script>
    $.toast({
        heading: 'Notification',
        text: "{{ Session::get('success') }}",
        showHideTransition: 'slide',
        position: 'top-center',
        icon: 'success',
        hideAfter: 5000
    })
</script>
@endif

@endsection()
