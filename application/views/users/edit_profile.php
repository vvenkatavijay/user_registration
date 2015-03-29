<?php 

$profile_data = $this->session->userdata('user_details');
$profile_id = $profile_data['id'];

$header_data = array('profile_id'=> $profile_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
		<title>
<?php  
	if ($curr_user_level === 'admin') {
?>
	Edit User
<?php 
	} else {
?>
	Edit Profile
<?php 
    }
?>
	</title>
	<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/edit_profile.css">
</head>
<body>
	<?php $this->load->view('partials/hearder_dashboard', $header_data) ?>
	<div class="container">
<?php 
		if ($curr_user_level === 'admin') {
?>
			<h3>Edit User: <?= $user_data['id'] ?></h3>			
<?php
		} else {
?>
			<h3>Edit Profile</h3>
<?php   
		}
?>

<?php
		if ($errors) { 
?>
		<div class="alert alert-danger">
			<?=$errors?>
		</div>

<?php
		}
?>

	<div>
		<form action="/users/edit_user" method="post" class="col-md-6">
			<fieldset>
				<legend>Edit Information</legend>
				<div class="form-group">
					<label>Email:</label>
					<input type="text" name="email" placeholder="Enter new Email" 
						   class="form-control" value=<?=$user_data["email"]?>>
				</div>
				<div class="form-group">
					<label>First Name:</label>
					<input type="text" name="first_name" placeholder="Enter new First Name" 
						   class="form-control" value=<?=$user_data["first_name"]?>>
				</div>
				<div class="form-group">
					<label>Last Name:</label>
					<input type="text" name="last_name" placeholder="Enter new Last Name" 
						   class="form-control" value=<?=$user_data["last_name"]?>>
				</div>
<?php 
		if ($curr_user_level === 'admin') {
?>
				<div class="form-group">
					<label>User Level:</label>
					<select name="user_level" value=<?=$user_data['user_level']?> selected="selected">
						<option value = 'admin' 
<?php if ($user_data['user_level'] === 'admin') echo "selected = 'selected'"; ?> >admin</option>
						<option value = 'normal'
<?php if ($user_data['user_level'] === 'normal') echo "selected = 'selected'"; ?> >normal</option>
					</select>
				</div>
<?php 
		}
?>
				<input type="hidden" name = "id" value="<?=$user_data['id']?>">
				<input type="submit" value="Edit Info" class="pull-right btn btn-success">
			</fieldset>
		</form>

		<form action="/users/update_password" method="post" class="col-md-6">
			<fieldset>
				<legend>Change Password</legend>
				<div class="form-group">
					<label>Password:</label>
					<input type="password" name="password" placeholder="Enter new password" class="form-control">
				</div>
				<div class="form-group">
					<label>Confirm Password:</label>
					<input type="password" name="confpassword" placeholder="Re-enter new password" class="form-control">
				</div>
				<input type="hidden" name = "id" value="<?=$user_data['id']?>">
				<input type="submit" value="Update Password" class="pull-right btn btn-success">
			</fieldset>
		</form>
	</div> 

<?php
		if( ($curr_user_level !== 'admin') || 
			($curr_user_level === $user_data['user_level'])) { 
?>
	<form action="/users/edit_description" method="post" class="col-md-12">
		<fieldset>
			<legend>Edit description</legend>

			<div class="form-group">
				<label>Descripton:</label>
				<textarea name="description" placeholder="Enter description" class="form-control"><?=$user_data['description']?>
				</textarea>
			</div>
			<input type="hidden" name = "id" value="<?=$user_data['id']?>">
			<input type="submit" value="Edit description" class="pull-right btn btn-success">
		</fieldset>
	</form>
<?php 
        }
?>
</body>
</html>