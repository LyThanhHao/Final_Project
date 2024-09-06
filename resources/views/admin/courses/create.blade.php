@extends('layouts/adminLO')

@section('main')
    <style>
        .btn-save {
            width: 9em;
            height: 3em;
            border-radius: 30em;
            font-size: 15px;
            font-family: inherit;
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 3px 3px 6px #c5c5c5,
                -3px -3px 6px #ffffff;
            border: solid 1px black;
        }

        .btn-save::before {
            content: '';
            width: 0;
            height: 3em;
            border-radius: 30em;
            position: absolute;
            top: 0;
            left: 0;
            background-image: linear-gradient(to right, #c10fd8 0%, #f9f047 100%);
            transition: .5s ease;
            display: block;
            z-index: -1;
        }

        .btn-save:hover::before {
            width: 9em;
        }
    </style>

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
                                    <option style="color: black;" value="" {{ old('category_id') == '' ? 'selected' : '' }}>Select a category</option>
                                    @foreach($category as $data)
                                        <option style="color: black;" value="{{ $data->id }}" {{ old('category_id') == $data->id ? 'selected' : '' }}>
                                            {{ $data->cat_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="user_id">Teacher</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option style="color: black;" value="">Select a teacher for this course</option>
                                    @foreach($users as $user)
                                        <option style="color: black;" value="{{ $user->id }}" {{ old('user_id') == $data->id ? 'selected' : '' }}>
                                            {{ $user->fullname }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="image">Image</label>
                            </div>
                            <input type="file" class="form-control mb-3" id="image" name="image" required>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
                            <input type="file" class="form-control mb-3" id="file" name="file" required>
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            {{-- <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Hidden</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Public</option>
                                </select>
                            </div> --}}
                            <button type="submit" class="btn-save">Create</button>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    @if (Session::has('create_success'))
        <script>
            $.toast({
                heading: 'Notification',
                text: "{{ Session::get('create_success') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'success',
                hideAfter: 5000
            })
        </script>
    @endif
    @if (Session::has('create_fail'))
        <script>
            $.toast({
                heading: 'Notification',
                text: "{{ Session::get('create_fail') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'error',
                hideAfter: 5000
            })
        </script>
    @endif
@endsection()
