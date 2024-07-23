<h3>Hi: {{ $account->fullname }}</h3>

<p>Chúc mừng bạn đã đăng ký tài khoản thành công!</p>

<p>
    <a href="{{ route('homepage.verify', $account->email) }}">Click here to verify your account</a>
</p>