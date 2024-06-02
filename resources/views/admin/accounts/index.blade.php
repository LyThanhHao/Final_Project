@extends('layouts/adminLO')

@section('main')
<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h4 class="card-title">Table of User accounts</h4>
        </div>
        <div class="card-body">
          <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">Create New User</a>
          <div>
            <table class="table" id="">
              <thead class="text-primary">
                <tr>
                  <th>Full name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Phone number</th>
                  <th>Role</th>
                  <th style="text-align: center;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr id="user_{{ $user->id }}">
                  <td>{{ $user->fullname }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->address }}</td>
                  <td>{{ $user->phoneNumber }}</td>
                  <td>{{ $user->role_name }}</td>
                  <td style="text-align: center;">
                    <a href="{{ route('admin.accounts.edit', $user->id) }}"><i class="bi bi-pencil-square" style="color: white;"></i></a>
                    <form action="{{ route('admin.accounts.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" style="border: none; background: border-box; color: white; margin-left: 15px;"><i class="bi bi-trash"></i></button>
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
@endsection
