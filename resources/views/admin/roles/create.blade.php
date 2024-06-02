@extends('layouts/adminLO')

@section('main')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h4 class="card-title"> Create Roles</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="role_name">Role Name</label>
              <input type="text" class="form-control" id="role_name" name="role_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
