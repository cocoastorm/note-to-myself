<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
  <div class="container-fluid">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="text-center">Register!</h2>
        </div>
        <div class="panel-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input!
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

          <form class="form-horizontal" role="form" method="POST" action="/auth/register">
            {!! csrf_field() !!}

            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Name</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email</label>
                <div class="col-md-6">
                  <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col-md-6">
                  <input class="form-control" type="password" name="password">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="password_confirmation">Confirm Password</label>
                <div class="col-md-6">
                  <input class="form-control" type="password" name="password_confirmation">
                </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button class="btn btn-primary" type="submit">Register</button>
                <span>or</span> <a href="{{ url('auth/login') }}">Log In</a>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
