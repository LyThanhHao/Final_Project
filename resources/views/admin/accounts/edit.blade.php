@extends('layouts/adminLO')

@section('main')
<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Account</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('admin.accounts.update', ['user' => $user->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="fullname">Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $user->fullname }}">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
              <label for="role">Role</label>
              <select name="role" id="role" class="form-control">
                <option style="color: black;" value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option style="color: black;" value="Student" {{ $user->role == 'Student' ? 'selected' : '' }}>Student</option>
                <option style="color: black;" value="Teacher" {{ $user->role == 'Teacher' ? 'selected' : '' }}>Teacher</option>
              </select>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
            </div>
            <div class="form-group">
              <label for="phoneNumber">Phone Number</label>
              <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ $user->phoneNumber }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection