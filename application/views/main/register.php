<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/register.css">
</head>
<body>
	<?php $this->load->view('partials/header');?>
	<div class="container">
		<h2>Register</h2>
		<div id="register">
		<form>
			<div class="form-group">
				<label for="InputEmail">Email Address:</label>
				<input type="text" name="email" placeholder="Email" id="InputEmail" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputFirstName">First Name:</label>
				<input type="text" name="first_name" placeholder="Email" id="InputFirstName" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputEmail">Last Name:</label>
				<input type="text" name="email" placeholder="Email" id="InputEmail" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputPassword">Password:</label>
				<input type="password" name="password" placeholder="Email" id="InputPassword" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputConfirmPassword">Password Confirmation:</label>
				<input type="password" name="confpassword" placeholder="Email" id="InputConfirmPassword" class="form-control">
			</div>
			<input type="submit" value="Register" class="btn btn-success" id="sign_in_button">
		</form>
		<p id="signin_link"><a href="/signin">Already have an account? Log in here!</a></p>
	</div>
</body>
</html>