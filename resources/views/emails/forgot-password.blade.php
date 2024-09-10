<div style="border: 1px solid black; padding: 15px; border-radius: 10px; width: 500px; background: #4884fd; margin: auto;">
    <h3>Hi: {{ $user->fullname }}</h3>
    
    <p> You have requested to reset your password!</p>
    
    <p>
        <a href="{{ route('reset_password', $token) }}" style="display: inline-block; padding: 7px 25px; background: #000; color: white; text-decoration: none;">Click here to reset your password</a>
    </p>
</div>