@extends('layouts/userLO')

@section('main')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .img-account-profile {
            height: 7rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(54, 81, 246, 1); 
            color: #fff;
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .btn-save {
            width: 9em;
            height: 2.5em;
            border-radius: 30em;
            font-size: 15px;
            font-family: inherit;
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 6px 6px 12px #c5c5c5,
                -6px -6px 12px #ffffff;
            border: solid 1px black;
        }

        .btn-save::before {
            content: '';
            width: 0;
            height: 2.5em;
            border-radius: 30em;
            position: absolute;
            top: 0;
            left: 0;
            background-image: linear-gradient(to right, #0f98d8 0%, #f9f047 100%);
            transition: .5s ease;
            display: block;
            z-index: -1;
        }

        .btn-save:hover::before {
            width: 9em;
        }

        .input-container {
            position: relative;
        }

        .input-container .position-absolute {
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container-xl px-4 mt-4">

        <nav class="nav nav-borders">
            <a class="nav-link  ms-0" href="{{ route('profile') }}">Profile</a>
            <a class="nav-link active" href="{{ route('profile.password') }}">Password</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-8" style="margin: 0 auto;">
                <div class="card mb-4">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <form action="{{ route('check_change_password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="currentPassword">Current Password</label>
                                <div class="input-container">
                                    <input class="form-control" id="currentPassword" name="currentPassword" type="password" placeholder="Enter current password" required>
                                    <span id="toggle-current-password" class="position-absolute">
                                        <i id="icon-toggle-current-password" class="bi bi-eye-slash-fill"></i>
                                    </span>
                                </div>
                                @error('currentPassword')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <label class="small mb-1" for="newPassword">New Password</label>
                                <div class="input-container">
                                    <input class="form-control" id="newPassword" name="newPassword" type="password" placeholder="Enter new password" required>
                                    <span id="toggle-new-password" class="position-absolute">
                                        <i id="icon-toggle-new-password" class="bi bi-eye-slash-fill"></i>
                                    </span>
                                </div>
                                @error('newPassword')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <label style="font-size: 13px; font-weight: bold;" for="password">Password must be at least 5 characters long. <br>
                                    Contains at least one number and symbol (like !@$!%*?&#).</label>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                <div class="input-container">
                                    <input class="form-control" id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm new password" required>
                                    <span id="toggle-confirm-password" class="position-absolute">
                                        <i id="icon-toggle-confirm-password" class="bi bi-eye-slash-fill"></i>
                                    </span>
                                </div>
                                @error('confirmPassword')
                                    <small style="color: red;">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn-save" type="submit">Save changes</button>
                        </form>
                    </div>
                </div>
                {{-- <div class="card mb-4">
                    <div class="card-header">Delete Account</div>
                    <div class="card-body">
                        <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
                        <button class="btn btn-danger-soft text-danger" type="button">I understand, delete my account</button>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    @if (Session::has('password_success'))
        <script>
            $.toast({
                heading: 'Notification',
                text: "{{ Session::get('password_success') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'success',
                hideAfter: 5000
            })
        </script>
    @endif

    @if (Session::has('password_fail'))
        <script>
            $.toast({
                heading: 'Notification',
                text: "{{ Session::get('password_fail') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'error',
                hideAfter: 5000
            })
        </script>
    @endif

    @if (Session::has('incorrect_password'))
        <script>
            $.toast({
                heading: 'Notification',
                text: "{{ Session::get('incorrect_password') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'error',
                hideAfter: 5000
            })
        </script>
    @endif

    <script>
        document.getElementById('toggle-current-password').addEventListener('click', function() {
            const passwordField = document.getElementById('currentPassword');
            const iconToggle = document.getElementById('icon-toggle-current-password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            if (type === 'password') {
                iconToggle.classList.remove('bi-eye-fill');
                iconToggle.classList.add('bi-eye-slash-fill');
            } else {
                iconToggle.classList.remove('bi-eye-slash-fill');
                iconToggle.classList.add('bi-eye-fill');
            }
        });

        document.getElementById('toggle-new-password').addEventListener('click', function() {
            const passwordField = document.getElementById('newPassword');
            const iconToggle = document.getElementById('icon-toggle-new-password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            if (type === 'password') {
                iconToggle.classList.remove('bi-eye-fill');
                iconToggle.classList.add('bi-eye-slash-fill');
            } else {
                iconToggle.classList.remove('bi-eye-slash-fill');
                iconToggle.classList.add('bi-eye-fill');
            }
        });

        document.getElementById('toggle-confirm-password').addEventListener('click', function() {
            const passwordField = document.getElementById('confirmPassword');
            const iconToggle = document.getElementById('icon-toggle-confirm-password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            if (type === 'password') {
                iconToggle.classList.remove('bi-eye-fill');
                iconToggle.classList.add('bi-eye-slash-fill');
            } else {
                iconToggle.classList.remove('bi-eye-slash-fill');
                iconToggle.classList.add('bi-eye-fill');
            }
        });
    </script>
</body>

</html>
@endsection()