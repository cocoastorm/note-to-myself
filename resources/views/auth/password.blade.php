<!-- resources/views/auth/password.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="text-center">
            Reset Your Password
          </h1>
        </div>

        <div class="panel-body">
          @if (count($errors) > 0)
    				<ul>
    					@foreach ($errors->all() as $error)
    						<li>{{ $error }}</li>
    					@endforeach
    				</ul>
    			@endif

          <p>
            Type your email address in the text box below. A new password will be sent to your email address.
          </p>
      		<form role="form" class="form-horizontal" method="POST" action="/password/email">
      			{!! csrf_field() !!}

      			<div class="form-group">
      				<label class="col-md-4 control-label" for="email">Email</label>
      				<div class="col-md-6">
      					<input type="email" name="email" value="{{ old('email') }}">
      				</div>
      			</div>

      			<div class="form-group">
      				<div class="col-md-6 col-md-offset-4">
      					<button class="btn btn-primary" type="submit">
      						Send Password Reset Link
      					</button>
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
