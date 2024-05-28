@extends('adminLO')

@section('main')
<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Role</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('admin.roles.update', ['role' => $role->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="role_name">Role Name</label>
              <input type="text" class="form-control" id="role_name" name="role_name" value="{{ $role->role_name }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
