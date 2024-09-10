@extends('layouts/adminLO')

@section('main')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold text-center"> Create User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.accounts.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                            </div>
                            <button type="submit" class="btn-add">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
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
