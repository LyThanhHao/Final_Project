<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">

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
            <form id="register-form" class="mx-auto" method="POST" role="form" action="{{ route('homepage.check_register') }}">
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
                        Contains at least one letter, one number, and one symbol (like !@$!%*?&#).</label>
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
                        I accept the <a href="#" id="terms-link">Terms and Conditions</a> and <a href="#" id="privacy-link">Privacy Policy</a>.
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('terms-link').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: '<div class="popup-title">Terms and Conditions</div>',
                html: `
                    <div class="content">
                        <h3>1. Acceptance of Terms</h3>
                        <p>By registering and using the ECOURSES platform, you agree to comply with these Terms and Conditions. If you do not accept any part of these terms, please refrain from using the platform.</p>
                        <h3>2. Account Registration</h3>
                        <p>Users must provide accurate and current personal information during the registration process. You are responsible for safeguarding your account credentials and activities on your account.</p>
                        <h3>3. Content Usage</h3>
                        <p>The courses, materials, and tests provided on the platform are for educational purposes only. Users are not allowed to copy, distribute, or resell any content without explicit permission from the platform or content providers.</p>
                        <h3>4. User Conduct</h3>
                        <p>You agree not to engage in any of the following: Uploading harmful, illegal, or inappropriate content. Attempting to disrupt the platform’s services or compromise its security.</p>
                        <h3>5. Modifications and Termination</h3>
                        <p>We reserve the right to update these terms, modify or terminate the platform services at any time, with or without notice.</p>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Close',
                customClass: {
                    popup: 'swal-scrollable'
                }
            });
        });

        document.getElementById('privacy-link').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: '<div class="popup-title">Privacy Policy</div>',
                html: `
                    <div class="content">
                        <h3>1. Data Collection</h3>
                        <p>We collect personal data such as name, email, and account information to provide you with the best educational experience.</p>
                        <h3>2. Use of Personal Data</h3>
                        <p>Your information is used for: Providing access to courses, tests, and user dashboards. Communicating updates, notifications, or support responses.</p>
                        <h3>3. Data Sharing</h3>
                        <p>We do not sell or share your data with third-party services, except when required by law or for the improvement of the platform’s functionality (e.g., hosting providers).</p>
                        <h3>4. Data Security</h3>
                        <p>We take the security of your personal data seriously. All information is stored securely and protected against unauthorized access.</p>
                        <h3>5. User Rights</h3>
                        <p>You have the right to access, update, or request the deletion of your personal information by contacting our support team.</p>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Close',
                customClass: {
                    popup: 'swal-scrollable'
                }
            });
        });
    </script>

    <style>
        .swal-scrollable {
            max-width: 90vw;
            max-height: 95vh;
            overflow-y: auto;
        }
        .content {
            text-align: left;
        }
        .content h3, .popup-title {
            overflow: hidden;
            margin: 0;
            padding: 0;
        }
    </style>

</body>

</html>