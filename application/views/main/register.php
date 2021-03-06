<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/register.css">
</head>
<body>
	<?php $this->load->view('partials/header');?>
	<div class="container">
		<h2>Register</h2>
<?php
		if($message) {

			if ($success) { 
?>
				<div class="alert alert-success">
<?php 
			} else {
?>
				<div class="alert alert-danger">
<?php 
			}
?>
					<?=$message?>
				</div>
<?php 
		}
?>

		<div id="register">
		<form action="/main/register_user/register" method="post">
			<div class="form-group">
				<label for="InputEmail">Email Address:</label>
				<input type="text" name="email" placeholder="Email" id="InputEmail" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputFirstName">First Name:</label>
				<input type="text" name="first_name" placeholder="First Name" id="InputFirstName" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputEmail">Last Name:</label>
				<input type="text" name="last_name" placeholder="Last Name" id="InputEmail" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputPassword">Password:</label>
				<input type="password" name="password" placeholder="Password" id="InputPassword" class="form-control">
			</div>
			<div class="form-group">
				<label for="InputConfirmPassword">Password Confirmation:</label>
				<input type="password" name="confpassword" placeholder="Confirm Password" id="InputConfirmPassword" class="form-control">
			</div>
			<input type="submit" value="Register" class="btn btn-success" id="sign_in_button">
		</form>
		<p id="signin_link"><a href="/signin">Already have an account? Log in here!</a></p>
	</div>
</body>
</html>