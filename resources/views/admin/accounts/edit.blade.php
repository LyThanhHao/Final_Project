@extends('layouts/adminLO')

@section('main')
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
                                @error('fullname')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
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
                                @error('role')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $user->address }}">
                                @error('address')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                    value="{{ $user->phoneNumber }}">
                                @error('phoneNumber')
                                    <small style="color: red;">{{ $message }}</small>
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
