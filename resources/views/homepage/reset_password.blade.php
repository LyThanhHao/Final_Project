<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
    body {
        background-image: linear-gradient(109.6deg, rgba(156, 252, 248, 1) 11.2%, rgba(110, 123, 251, 1) 91.1%);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
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
        gap: 20px;
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

    .form-container .form-group .input-container {
        position: relative;
    }

    .form-container .form-group .input-container input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 6px;
        font-family: inherit;
        border: 1px solid #ccc;
        box-sizing: border-box;
        padding-right: 40px; /* Để chừa chỗ cho icon */
    }

    .form-container .form-group .input-container input::placeholder {
        opacity: 0.5;
    }

    .form-container .form-group .input-container input:focus {
        outline: none;
        border-color: #1778f2;
    }

    .form-container .form-group .input-container .icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
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
</style>

<body>
    <div class="form-container">
        <div class="logo-container">
            Reset Password
        </div>

        <form class="form" method="POST"">
            @csrf
            <div>
                <label style="font-size: 13px; font-style: italic;" for="password">Password must be at
                    least 5 characters long. <br>
                    Contains at least one number and symbol (like !@$!%*?&#).</label>
            </div>
            <br>
            <div class="form-group">
                <label for="password">New Password</label>
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Enter your new password" required="">
                    <span class="icon" id="toggle-password">
                        <i class="bi bi-eye-slash-fill" id="icon-toggle-password"></i>
                    </span>
                </div>
                @error('password')
                    <small style="color: red; margin-top: 5px;">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label style="margin-top: 15px;" for="password_confirm">Confirm Password</label>
                <div class="input-container">
                    <input type="password" id="password_confirma" name="password_confirm" placeholder="Confirm your new password" required="">
                    <span class="icon" id="toggle-confirm-password">
                        <i class="bi bi-eye-slash-fill" id="icon-toggle-confirm-password"></i>
                    </span>
                </div>
                @error('password_confirm')
                    <small style="color: red; margin-top: 5px;">{{ $message }}</small>
                @enderror
            </div>
            <button class="form-submit-btn" type="submit">Reset Password</button>
        </form>

        <p class="signup-link">
            Don't have an account?
            <a href="{{ route('homepage.register') }}" class="signup-link link"> Sign up now</a>
        </p>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

    document.getElementById('toggle-confirm-password').addEventListener('click', function() {
        const passwordField = document.getElementById('password_confirm');
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

</html>
