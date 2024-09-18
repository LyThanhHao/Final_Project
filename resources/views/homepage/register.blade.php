<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/register.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Toast notification -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Register Form</title>
</head>

<body>
    <div class="container-fluid">
        <div class="form-image">
            <img src="{{ asset('uploads/image-register.jpeg') }}" alt="Image Description">
        </div>
        <hr style="display: block;">
        <div class="divider"></div>
        <div class="form-content">
            <form id="register-form" class="mx-auto" method="POST" role="form" action="{{ route('homepage.register') }}">
                @csrf
                <p class="form-title">LET'S CREATE YOUR ACCOUNT</p>
                <div class="input-container">
                    <input type="text" class="form-control" name="fullname" placeholder="Enter your full name"
                        required>
                    @error('fullname')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-container">
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
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
                <div class="input-container">
                    <label style="font-size: 11px;" for="password">Password must be at least 5 characters long. <br>
                        Contains at least one number and symbol (like !@$!%*?&#).</label>
                </div>
                <div class="input-container position-relative">
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        placeholder="Confirm your password" required>
                    <span id="toggle-password-confirmation" class="position-absolute top-50 end-0 translate-middle-y me-3"
                        style="cursor: pointer;">
                        <i id="icon-toggle-password-confirmation" class="bi bi-eye-slash-fill"></i>
                    </span>
                    @error('password_confirmation')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-container">
                    <input type="text" class="form-control" name="phoneNumber" placeholder="Enter your phone number"
                        required>
                    @error('phoneNumber')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-container">
                    <input type="text" class="form-control" name="address" placeholder="Enter your address" required>
                    @error('address')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="termsCheckbox" id="termsCheckbox" required>
                    <label class="form-check-label" for="termsCheckbox">
                        I accept the <a href="#">Terms and Conditions</a> and <a href="">Privacy
                            Policy</a>.
                    </label>
                    @error('termsCheckbox')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="submit">Create an account</button>
                <p class="signup-link">
                    Already have an account?
                    <a href="{{ route('homepage.login') }}">Login here!</a>
                </p>
                <div id="back"><a href="{{ route('homepage') }}">Back to homepage</a></div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    @if (Session::has('success'))
        <script>
            $.toast({
                heading: 'Registration successful!',
                text: "{{ Session::get('success') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'success',
                hideAfter: 5000
            })
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

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const iconToggle = document.getElementById('icon-toggle-password');
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

        document.getElementById('toggle-password-confirmation').addEventListener('click', function() {
            const passwordField = document.getElementById('password_confirmation');
            const iconToggle = document.getElementById('icon-toggle-password-confirmation');
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