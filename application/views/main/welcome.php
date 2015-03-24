<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign In</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/welcome.css">
</head>
<body>
	<?php $this->load->view('partials/header');?>
	<div class="container">
		<div class="jumbotron" id="welcome">
			<h2>Welcome to the Test App</h2>
			<p>This is a proof of concept app built using Code Igniter</p>
			<p><a class="btn btn-primary btn-lg" href="#">Start</a></p>
		</div>
		<div class = "row" id="details">
			<div class="col-md-4"> 
				<h3>Manage Users</h3>
				<p>Using this application, you'll learn how to add remove and edit users for the application</p>
			</div>
			<div class="col-md-4"> 
				<h3>Leave Messages</h3>
				<p>Users will be able to leave a message to another user using this application.</p>
			</div>
			<div class="col-md-4"> 
				<h3>Edit User Information</h3>
				<p>Admins will be able to edit another user's information(email address, first name, last name,etc.)</p>
			</div>
		</div>
	</div>
</body>
</html>