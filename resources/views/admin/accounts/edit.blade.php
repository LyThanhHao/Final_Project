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
    <!-- End Navbar -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold text-center">Edit Account</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.accounts.update', ['user' => $user->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    value="{{ $user->fullname }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option style="color: black;" value="Admin"
                                        {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option style="color: black;" value="Student"
                                        {{ $user->role == 'Student' ? 'selected' : '' }}>Student</option>
                                    <option style="color: black;" value="Teacher"
                                        {{ $user->role == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $user->address }}">
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                    value="{{ $user->phoneNumber }}">
                            </div>
                            <button type="submit" class="btn-save">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
