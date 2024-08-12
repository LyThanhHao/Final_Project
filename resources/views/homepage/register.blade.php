<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="css/register.css" rel="stylesheet">

  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />

  <title>Register Form</title>
</head>

<body>
  <div class="container-fluid">
    <form id="register-form" class="mx-auto" method="POST" role="form">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p class="form-title">Let's create your account</p>
        <div class="input-container">
            <input type="text" class="form-control" name="fullname" placeholder="Enter your full name">
            @error('fullname')
                <small style="color: red;">{{ $message }}</small>
            @enderror
            <span>
            </span>
        </div>
        <div class="input-container">
            <input type="email" class="form-control" name="email" placeholder="Enter your email">
            @error('email')
                <small style="color: red;">{{ $message }}</small>
            @enderror
            <span>
            </span>
        </div>
        <div class="input-container">
            {{-- <label style="font-size: 15px" for="">Password must be 5 characters long and contain letters and special characters</label> --}}
            <input type="password" class="form-control" name="password" placeholder="Enter your password">
            @error('password')
                <small style="color: red;">{{ $message }}</small>
            @enderror
            <span>
            </span>
        </div>
        <div class="input-container">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your password">
            @error('confirm_password')
                <small style="color: red;">{{ $message }}</small>
            @enderror
            <span>
            </span>
        </div>
        <div class="input-container">
            <input type="text" class="form-control" name="phoneNumber" placeholder="Enter phone number">
            @error('phoneNumber')
                <small style="color: red;">{{ $message }}</small>
            @enderror
            <span>
            </span>
        </div>
        <div class="input-container">
            <input type="text" class="form-control" name="address" placeholder="Enter your address">
            @error('address')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="termsCheckbox" id="termsCheckbox" required>
          <label class="form-check-label" for="termsCheckbox">
            I accept the <a href="#">Terms and Conditions</a> and <a href="">Privacy Policy</a>.
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    @if (Session::has('success-register'))
        <script>
            $.toast({
                heading: 'Notification',
                text: "{{ Session::get('success-register') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'success',
                hideAfter: 5000
            })
        </script>
    @endif

    @if (Session::has('fail-register'))
        <script>
            $.toast({
                heading: 'Notification',
                text: "{{ Session::get('fail-register') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'success',
                hideAfter: 5000
            })
        </script>
    @endif

</body>

</html>