<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"
        integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Toast notification -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<style>
    body {
        background-image: linear-gradient(109.6deg, rgba(156, 252, 248, 1) 11.2%, rgba(110, 123, 251, 1) 91.1%);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    .form-container {
        max-width: 400px;
        width: 100%;
        background-color: #fff;
        padding: 32px 24px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        color: #212121;
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
        border-radius: 10px;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.084), 0px 2px 3px rgba(0, 0, 0, 0.168);
    }

    .form-container button:active {
        scale: 0.95;
    }

    .form-container .logo-container {
        text-align: center;
        font-weight: 600;
        font-size: 18px;
    }

    .form-container .form {
        display: flex;
        flex-direction: column;
    }

    .form-container .form-group {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .form-container .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-container .form-group input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 6px;
        font-family: inherit;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .form-container .form-group input::placeholder {
        opacity: 0.5;
    }

    .form-container .form-group input:focus {
        outline: none;
        border-color: #1778f2;
    }

    .form-container .form-submit-btn {
        display: block;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        background-color: #0066ff;
        color: #ffffff;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        width: -webkit-fill-available;
        border-radius: 0.5rem;
        text-transform: uppercase;
        margin-top: 20px;
    }

    .form-container .form-submit-btn:hover {
        cursor: pointer;
        background-color: #fff;
        color: #000;
        transform: scale(1);
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .form-container .link {
        color: #1778f2;
        text-decoration: none;
    }

    .form-container .signup-link {
        align-self: center;
        font-weight: 500;
    }

    .form-container .signup-link .link {
        font-weight: 400;
    }

    .form-container .link:hover {
        text-decoration: underline;
    }

    #back {
        width: auto;
        border: solid;
        border-radius: 50px;
        background: black;
        transition: background-color 0.3s ease;
    }

    #back a {
        color: white;
        text-decoration: none;
        display: block;
        text-align: center;
        padding: 8px;
        transition: color 0.3s ease;
    }

    #back:hover {
        background-color: white;
    }

    #back:hover a {
        color: black;
    }
</style>

<body>
    <div class="form-container">
        <div class="logo-container">
            Forgot Password
        </div>
        <form class="form" method="POST" action="{{ route('check_forgot_password') }}">
            @csrf
            <div class="form-group">
                <label for="email" style="margin-top: 30px;">Email</label>
                <input type="text" id="email" name="email" placeholder="Enter your email" required="">
                @error('email')
                    <small style="color: red; margin-top: 5px;">{{ $message }}</small>
                @enderror
            </div>
            <button class="form-submit-btn" type="submit">Send Email</button>
        </form>

        <p class="signup-link">
            Don't have an account?
            <a href="{{ route('homepage.register') }}" class="signup-link link"> Sign up now</a>
        </p>
        <div id="back"><a href="{{ route('homepage.login') }}">Cancel</a></div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery Toast Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    @if (Session::has('send-success'))
        <script>
            Swal.fire({
                title: "Notification",
                text: "{{ Session::get('send-success') }}",
                icon: "success"
            });
        </script>
    @endif

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

    @if (Session::has('resend-fail'))
        <script>
            Swal.fire({
                title: "Notification",
                text: "{{ Session::get('resend-fail') }}",
                icon: "info"
            });
        </script>
    @endif

    @if (Session::has('token-error'))
        <script>
            Swal.fire({
                title: "Notification",
                text: "{{ Session::get('token-error') }}",
                icon: "info"
            });
        </script>
    @endif
</body>

</html>
