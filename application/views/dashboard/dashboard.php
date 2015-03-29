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
	if ($user_level == 9) {
?>
	Admin Dashboard
<?php 
	} else {
?>
	Dashboard
<?php 
    }
?>
	</title>

	<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/dashboard.css">
</head>
<body>
	<?php $this->load->view('partials/hearder_dashboard', $header_data) ?>

	<div class="container">
		<div>
<?php 
		if ($user_level == 9) {
?>
			<form action="/users/new">
				<button class="pull-right btn btn-primary btn-lg dashboard_button">
					Add new
				</button>
			</form>
			<h3>Manage Users</h3>
			
<?php
		} else {
?>
			<h3>All Users</h3>
<?php   }
?>
		</div>
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
<?php 
					foreach ($table_header as $header) {
?>
						<th><?=$header?></th>
<?php
					}
?>
				</tr>
			</thead>
			<tbody>
<?php 
					foreach ($user_data as $user) {
?>					
						<tr>
<?php
							foreach ($user as $heading => $entry) {

								if ($heading === 'last_name') continue;
								if($heading === "first_name") {
?>
									<td><a href="/users/show/<?=$user['id']?>">
											<?php  echo $entry . ' ' . $user['last_name']; 
											unset($user['last_name']) ?>
										</a>
									</td>
<?php
								} else {
?>
									<td><?=$entry?></td>
<?php
								}
							}
							if ($user_level == 9) {
								$url = "/users/show_user/" . $user['id'];
?>	
								<td>
									<a href= <?=$url?>>edit</a>
									<a href="#">remove</a>
								</td>		
<?php 
							}
?>
						</tr>
<?php 
					}
?>
			</tbody>
		</table>
	</div>
</body>
</html>