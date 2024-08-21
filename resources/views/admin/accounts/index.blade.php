@extends('layouts/adminLO')

@section('main')
<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title font-weight-bold text-center">Table of User accounts</h3>
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
                <tr>
                  <td>{{ $user->fullname }}</td>
                  <td>{{ $user->email }}</td>
                  <td style="max-width: 300px;">{{ $user->address }}</td>
                  <td>{{ $user->phoneNumber }}</td>
                  <td>{{ $user->role }}</td>
                  <td style="text-align: center;">
                    <a href="{{ route('admin.accounts.edit', $user->id) }}"><i class="bi bi-pencil-square" style="color: white; margin: 0 10px;"></i></a>
                    <form action="{{ route('admin.accounts.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="confirmDelete(event)" style="border: none; background: border-box; color: white;"><i class="bi bi-trash"></i></button>
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
