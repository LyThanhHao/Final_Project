@extends('layouts/adminLO')

@section('main')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold text-center"> Create a new Course</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="course_name">Name of Course</label>
                                <input type="text" class="form-control" id="course_name" name="course_name" required>
                                @error('course_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option style="color: black;" value=""
                                        {{ old('category_id') == '' ? 'selected' : '' }}>Select a category</option>
                                    @foreach ($category as $data)
                                        @if ($data->status)
                                            <option style="color: black;" value="{{ $data->id }}"
                                                {{ old('category_id') == $data->id ? 'selected' : '' }}>
                                                {{ $data->cat_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher">Teacher</label>
                                <select name="teacher" id="teacher" class="form-control">
                                    <option style="color: black;" value="">Select a teacher for this course</option>
                                    @foreach ($users as $user)
                                        @if ($user->role == 'Teacher')
                                            <option style="color: black;" value="{{ $user->id }}"
                                                {{ old('teacher') == $user->id ? 'selected' : '' }}>
                                                {{ $user->fullname }} ({{ $user->email }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="image">Image</label>
                            </div>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="file" class="form-control mb-3" id="image" name="image" required>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="file">File</label>
                            </div>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="file" class="form-control mb-3" id="file" name="file" required>
                            {{-- <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Hidden</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Public</option>
                                </select>
                            </div> --}}
                            <button type="submit" class="btn-add">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- toast notification -->
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
