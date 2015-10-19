<!-- resources/views/auth/login.blade.php -->
<h1>Log in</h1>
<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        Email address
        <input type="email" name="email" value="{{ old('email') }}">
    </div>
    
    <div>
        Password
        <input type="password" name="password" id="password">
    </div>
   


    <div>
        <button type="submit">Login</button>
    </div>

    <a href="{{ URL::to('auth/register') }}">Register</a> | <a href="{{ URL::to('auth/reset') }}">Forgot password</a>
    <hr>
    <a href="https://twitter.com/notes_myself">Twitter</a>
</form>
