<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="css/login.css" rel="stylesheet">
  <title>Register Form</title>
</head>

<body>
  <div class="container-fluid">
    <form class="mx-auto" method="POST" role="form">
      @csrf
      <h4 class="text-center">Register</h4>
      <div class="mb-3 mt-4 form-group">
        <label class="form-label">Full name</label>
        <input type="text" class="form-control" name="fullname" placeholder="Enter your full name">
        @error('fullname') <small style="color: red;">{{ $message }}</small> @enderror
      </div>
      <div class="mb-3 mt-4 form-group">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter your email">
        @error('email') <small style="color: red;">{{ $message }}</small> @enderror
      </div>
      <div class="mb-3 mt-4 form-group">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter your password">
        @error('password') <small style="color: red;">{{ $message }}</small> @enderror
      </div>
      <div class="mb-3 mt-4 form-group">
        <label class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your password">
        @error('confirm_password') <small style="color: red;">{{ $message }}</small> @enderror
      </div>
      <div class="mb-3 mt-4 form-group">
        <label class="form-label">Phone number</label>
        <input type="text" class="form-control" name="phoneNumber" placeholder="Enter your phone number">
        @error('phone_number') <small style="color: red;">{{ $message }}</small> @enderror
      </div>
      <div class="mb-3 mt-4 form-group">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" name="address" placeholder="Enter your address">
        @error('address') <small style="color: red;">{{ $message }}</small> @enderror
      </div>
      <button type="submit" class="btn btn-primary mt-4">Register</button>
      <a href="{{ route('homepage.login') }}" style="display: block; text-align: right; margin: 10px 0">I already have an account</a>
      <hr style="width: 100%; background: black; margin-top: 25px">
      <div style="width: 100%; border: none; border-radius: 50px; background: black;"><a href="{{ route('homepage') }}" style="color: white; text-decoration: none; display: block; text-align: center; padding: 8px">Back to homepage</a></div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>