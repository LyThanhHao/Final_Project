<h3>Hi: {{ $account->fullname }}</h3>

<p>Congratulations on successfully registering an account!</p>

<p>
    <a href="{{ route('homepage.verify', $account->email) }}">Click here to verify your account</a>
</p>