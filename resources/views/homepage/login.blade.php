<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/login.css" rel="stylesheet">
    <!-- Toast notification -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Login Form</title>
</head>

<body>
    <div class="container-fluid">
        <div class="form-image">
            <img src="{{ asset('uploads/image-login.jpeg') }}" alt="Image Description">
        </div>
        <hr style="display: block;">
        <div class="divider"></div>
        <div class="form-content">
            <form id="login-form" class="mx-auto" method="POST" role="form" action="{{ route('homepage.login') }}">
                @csrf
                <p class="form-title">LOGIN TO YOUR ACCOUNT</p>
                <div class="input-container">
                    <input type="email" id="email" class="form-control" name="email" placeholder="name@gmail.com" required>
                    @error('email')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-container position-relative">
                    <input id="password" type="password" class="form-control" name="password"
                        placeholder="Enter your password" required>
                    <span id="toggle-password" class="position-absolute top-50 end-0 translate-middle-y me-3"
                        style="cursor: pointer;">
                        <i id="icon-toggle-password" class="bi bi-eye-slash-fill"></i>
                    </span>
                    @error('password')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
                <div style="margin: 10px 0; font-size: 14px;">
                    <a href="{{ route('forgot_password') }}" class="mt-3">Forgot password?</a>
                </div>
                <button type="submit" class="submit">Login</button>
                <p class="signup-link">
                    No account?
                    <a href="{{ route('homepage.register') }}">Sign up</a>
                </p>
                <div id="back"><a href="{{ route('homepage') }}">Back to homepage</a></div>
            </form>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery Toast Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

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

    <script>
        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const iconToggle = document.getElementById('icon-toggle-password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            // Toggle the icon
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