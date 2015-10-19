<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Note-To-Myself : Notes</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href="notes.css" rel="stylesheet" type="text/css" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="pencil.ico" />
	<script type="text/javascript">
		function openInNew(textbox) {
			window.open(textbox.value);
			this.blur();
		}
	</script>
</head>

<body>
	<div id="wrapper" class="container">
		<form action="notes.php" enctype="multipart/form-data" method="post" role="form" class="form-horizontal">
			<h2 id="header">{{ auth()->user()-> email }} - <span><a href="{{ URL::to('auth/logout') }}">Log out</a></span></h2>

				<div id="notes-column" class="col-md-3">
					<h2>notes</h2>
					<textarea cols="25" rows="25" id="notes" name="notes" /></textarea>
				</div>

				<div id="websites-column" class="col-md-3">
					<h2>websites</h2>
					<h3>click to open</h3>
					<input type="text" name="websites[]" />
					<br>
					<input type="text" name="websites[]" />
					<br>
					<input type="text" name="websites[]" />
					<br>
					<input type="text" name="websites[]" />
					<br>
				</div>

			<div id="images-column" class="col-md-3">
				<h2>images</h2>
				<h3>click for full size</h3>
				<!-- <textarea cols="16" rows="40" id="image" name="image" /></textarea> -->
				<input type="file" name="i" />

				<div>
					<a href='uploadedimages/jondeluz@hotmail.com/png.jpg' target='_blank'>
						<img src='uploadedimages/jondeluz@hotmail.com/thumb_png.jpg' alt='png.jpg' />
					</a>
					<input type='checkbox' name='delete[]' value='20' />
					<label for='delete[]'>delete</label>
					<br />
					<br />
				</div>
			</div>

			<div id="tbd-column" class="col-md-3">
				<h2>tbd</h2>
				<textarea cols="25" rows="25" id="tbd" name="tbd" /></textarea>
			</div>

			<div id="submitArea" class="col-md-7 col-md-offset-5">
				<input type="submit" value="Save" style="width:200px;height:80px" name="submitting" />
			</div>
		</form>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>