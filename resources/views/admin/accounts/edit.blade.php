@extends('layouts/adminLO')

@section('main')
<style>
    .btn-update {
        background-color: #28a745;
        transition: background-color 0.3s, transform 0.3s;
        color: white;
        border: 1px solid white;
        padding: 10px 30px;
        margin: 4px 1px;
        display: inline-block;
        border-radius: 10px;
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
    }

    .btn-update:hover {
        background-color: #28a745;
        transform: scale(1.05);
        color: black;
        background-color: white;
        border: 1px solid black;
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
                            <button type="submit" class="btn-update">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
