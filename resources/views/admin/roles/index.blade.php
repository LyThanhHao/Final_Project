@extends('adminLO')

@section('main')
<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h4 class="card-title"> Table of User roles</h4>
        </div>
        <div class="card-body">
          <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create New Role</a>
          <div>
            <table class="table" id="">
              <thead class="text-primary">
                <tr>
                  <th>Role ID</th>
                  <th>Role Name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $role)
                <tr>
                  <td> {{ $role->id }} </td>
                  <td> {{ $role->role_name }} </td>
                  <td>
                    <a href="{{ route('admin.roles.edit', $role->id) }}"><i class="bi bi-pencil-square" style="color: white; margin-right: 15px;"></i></a>
                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" style="border: none; background: border-box; color: white;"><i class="bi bi-trash"></i></button>
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
@endsection()