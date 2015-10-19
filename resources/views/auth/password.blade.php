<!-- resources/views/auth/password.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<form role="form" class="form-horizontal" method="POST" action="/password/email">
			{!! csrf_field() !!}

			@if (count($errors) > 0)
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			@endif

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
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>