<?php 

$profile_data = $this->session->userdata('user_details');
$profile_id = $profile_data['id'];

$header_data = array('profile_id'=> $profile_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add New User</title>
	<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/add_user.css">
</head>
<body>
	<?php $this->load->view('partials/hearder_dashboard', $header_data); ?>
	<div class="container">
		<div>
			<form action="/dashboard">
				<button class="pull-right btn btn-primary btn-lg back_button">
					Back to Dashboard
				</button>
			</form>
			<h3>Add User</h3>
		</div>
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
		<div>
		<form action="/main/register_user/admin" method="post" class="col-md-4">
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
			<input type="submit" value="Add User" class="btn btn-success pull-right">
		</form>
	</div>
</body>
</html>