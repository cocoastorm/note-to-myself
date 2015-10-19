<!DOCTYPE html>
<html>
    <head>
        <title>Log Out</title>
    </head>
    <body>
      <h2 id="header"> {{$email}} is now logged out. Thank you.</h2>
<a href="{{ URL::to('auth/login') }}">Log in</a> again
    </body>
</html>
