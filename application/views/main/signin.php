<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign In!</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/signin.css">
</head>
<body>
	<?php $this->load->view('partials/header');?>
	<div class="container">
		<h2>Sign in</h2>
		<div id="sign-in">
		<form>
			<div class="form-group">
				<label for="InputEmail">Email Address:</label>
				<input type="text" name="email" placeholder="Email" id="InputEmail" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputPassword">Password:</label>
				<input type="password" name="password" placeholder="Email" id="InputPassword" class="form-control">
			</div>
			<input type="submit" value="Sign in!" class="btn btn-success" id="sign_in_button">
		</form>
		<p id="register_link"><a href="/register">Don't have an account? Register here!</a></p>
		<div>
</body>
</html>