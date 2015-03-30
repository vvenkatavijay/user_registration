<?php 

$profile_data = $this->session->userdata('user_details');
$profile_id = $profile_data['id'];

$header_data = array('profile_id'=> $profile_id);

// TO DO in controller 
// 1. edit created_at
// 2. 

//var_dump($messages);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Information</title>
	<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/user_page.css">
</head>
<body>
	<?php $this->load->view('partials/hearder_dashboard', $header_data) ?>

	<div class="container">
		<div>
			<h4><?php echo $user_details['first_name'] . " " . $user_details['last_name']?></h4>
			<div>
				<p class="inline">Registered at: </p> 
				<p class="inline"><?=$user_details['created_at']?></p>
			</div>
			<div>
				<p class="inline">User ID: </p> 
				<p class="inline"><?=$user_details['id']?></p>
			</div>
			<div>
				<p class="inline">Email Address: </p> 
				<p class="inline"><?=$user_details['email']?></p>
			</div>
			<div>
				<p class="inline">Description :</p> 
				<p class="inline"><?=$user_details['description']?></p>
			</div>
		</div>

		<div>
			<form action="/users/add_new_message" method="post">
				<div class="form-group">
					<label>Leave a mesage for <?=$user_details['first_name']?></label>
					<textarea name="new_message" placeholder="Enter your message" class="form-control message_box"></textarea>
				</div>
				<input type="hidden" name="message_for" value="<?=$user_details['id']?>">
				<input type="submit" value="Post" class="btn btn-success pull-right">
			</form>
		</div>

		<div>
<?php 

	foreach ($messages as $message) {
?>
			<div class="message_div">
				<p class="pull-right"><?=$message['created_at']?> </p>
				<p><?=$message['user_name']?></p>
				<p class="message"><?=$message['message']?></p>
			</div>

<?php 
			foreach ($message['comment_data'] as $comment) {
?>						
				<div class="comment_div">
					<p class="pull-right"><?=$comment['time']?></p>
					<p class="comment_name"><?=$comment['user_name']?></p>
					<p class="comment"><?=$comment['comment']?></p>
				</div>
<?php
			}
?>
			<form action="/users/add_new_comment" method="post" class="comment_form">
				<div class="form-group">
					<label>Comment</label>
					<textarea name="new_comment" placeholder="Enter your comment" class="form-control comment_box"></textarea>
				</div>
				<input type="hidden" name="comment_by" value="<?=$user_details['id']?>">
				<input type="hidden" name="comment_for_message" value="<?=$message['id']?>">
				<input type="submit" value="Post" class="btn btn-success pull-right">
		    </form>
<?php
	}
?>
		</div>
	</div>
</body>
</html>