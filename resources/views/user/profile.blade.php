@extends('layouts/userLO')

@section('main')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            .img-account-profile {
                width: 100px;
                max-width: 100px;
                height: 100px;
                border-radius: 50%;
            }

            .rounded-circle {
                border-radius: 50% !important;
            }

            .card {
                box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
                margin-bottom: 1rem;
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

            @media (max-width: 576px) {
                .container-xl {
                    padding: 0 1rem;
                }
            }

            .btn-update {
                width: 12em;
                height: 3em;
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

            .btn-update::before {
                content: '';
                width: 0;
                height: 3em;
                border-radius: 30em;
                position: absolute;
                top: 0;
                left: 0;
                background-image: linear-gradient(to right, #0f98d8 0%, #f9f047 100%);
                transition: .5s ease;
                display: block;
                z-index: -1;
            }

            .btn-update:hover::before {
                width: 12em;
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
        </style>
    </head>

    <body>
        <div class="container-xl px-4 mt-4">
            <nav class="nav nav-borders">
                <a class="nav-link active ms-0" href="{{ route('profile') }}">Profile</a>
                <a class="nav-link" href="{{ route('profile.password') }}">Password</a>
            </nav>
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-md-4"> <!-- Thay thế col-xl-4 bằng col-md-4 -->
                    <div class="card mb-4 mb-md-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            @if (empty($user->avatar))
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="{{ asset('uploads/avatar/avatar_default.jpg') }}" alt="">
                            @else
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="{{ asset('uploads/avatar/' . $user->avatar) }}" alt="">
                            @endif
                            <div class="small font-italic text-muted mb-2">JPG, PNG, JPEG, GIF, WEBP or SVG no larger than 5
                                MB</div>
                            <form action="{{ route('change_avatar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="file" name="avatar" id="avatar" class="form-control">
                                    @error('avatar')
                                        <div class="mt-2">
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                                <button class="btn-update" type="submit">Upload new image</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8"> <!-- Thay thế col-xl-8 bằng col-md-8 -->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form action="{{ route('check_change_profile') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="fullname">Full name</label>
                                        <input class="form-control" id="fullname" name="fullname" type="text"
                                            placeholder="Enter your username" value="{{ $user->fullname }}" required>
                                        @error('fullname')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="text"
                                            placeholder="Enter your email" value="{{ $user->email }}" required>
                                        @error('email')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="address">Address</label>
                                        <input class="form-control" id="address" name="address" type="text"
                                            placeholder="Enter your address" value="{{ $user->address }}" required>
                                        @error('address')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="phoneNumber">Phone number</label>
                                        <input class="form-control" id="phoneNumber" name="phoneNumber" type="tex"
                                            placeholder="Enter your phone number" value="{{ $user->phoneNumber }}" required>
                                        @error('phoneNumber')
                                            <small style="color: red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn-save" type="submit">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
        @if (Session::has('profile_success'))
            <script>
                $.toast({
                    heading: 'Notification',
                    text: "{{ Session::get('profile_success') }}",
                    showHideTransition: 'slide',
                    position: 'top-center',
                    icon: 'success',
                    hideAfter: 5000
                })
            </script>
        @endif

        @if (Session::has('profile_fail'))
            <script>
                $.toast({
                    heading: 'Notification',
                    text: "{{ Session::get('profile_fail') }}",
                    showHideTransition: 'slide',
                    position: 'top-center',
                    icon: 'error',
                    hideAfter: 5000
                })
            </script>
        @endif

        @if (Session::has('avatar_success'))
            <script>
                $.toast({
                    heading: 'Notification',
                    text: "{{ Session::get('avatar_success') }}",
                    showHideTransition: 'slide',
                    position: 'top-center',
                    icon: 'success',
                    hideAfter: 5000
                })
            </script>
        @endif

        @if (Session::has('avatar_fail'))
            <script>
                $.toast({
                    heading: 'Notification',
                    text: "{{ Session::get('avatar_fail') }}",
                    showHideTransition: 'slide',
                    position: 'top-center',
                    icon: 'error',
                    hideAfter: 5000
                })
            </script>
        @endif
    </body>

    </html>
@endsection()
