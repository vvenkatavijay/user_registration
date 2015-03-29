<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign In!</title>
	<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/signin.css">
</head>
<body>
	<?php $this->load->view('partials/header');?>
	<div class="container">
		<h2>Sign in</h2>
<?php
		if ($errors) { 
?>
		<div class="alert alert-danger">
			<?=$errors?>
		</div>

<?php
		}
?>
		<div id="sign-in">
		<form action="/main/authenticate" method="post">
			<div class="form-group">
				<label for="InputEmail">Email Address:</label>
				<input type="text" name="email" placeholder="Email" id="InputEmail" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputPassword">Password:</label>
				<input type="password" name="password" placeholder="Password" id="InputPassword" class="form-control">
			</div>
			<input type="submit" value="Sign in!" class="btn btn-success" id="sign_in_button">
		</form>
		<p id="register_link"><a href="/register">Don't have an account? Register here!</a></p>
		<div>
</body>
</html>