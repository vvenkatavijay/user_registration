<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* The user controller. Registers and gets the user informantion
*/
class Users extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index() {
		$this->load->view('users/edit_profile');
	}

	public function show_user($id) 
	{
		$this->load->model('User');

		$user_details = $this->User->get_user_by_id($id);

		if(!$user_details) {

			$this->add_error("<p> Unable to login due to database error. Please try later </p>");

		} else {

			$curr_user = $this->session->userdata('user_details');
			$view_data = array('curr_user_level' => $curr_user['user_level'],
							   'user_data' => $user_details,
							   'errors' => $this->session->flashdata('errors'));

			$this->load->view('users/edit_profile', $view_data);
		}
	}

	
	public function edit_user()
	{
		$this->load->model('User');

		$user_level = $this->input->post('user_level');
		if($user_level) {
			$model_data = array('email' => $this->input->post('email'),
				            	'first_name' => $this->input->post('first_name'),
				            	'last_name' => $this->input->post('last_name'),
				            	'user_level' => $user_level,
				            	'id' => $this->input->post('id')
				            );

			if($this->User->update_user_info($model_data)) {
				redirect('/dashboard');
				die();
			} else {
				$this->add_error('<p>Unable to update user info. Please try later</p>');
				$url = "/users/show_user/" . $this->input->post('id');
				redirect($url);
			}
		} else {
			$model_data = array('email' => $this->input->post('email'),
				            	'first_name' => $this->input->post('first_name'),
				            	'last_name' => $this->input->post('last_name'),
				            	'id' => $this->input->post('id')
				            );

			if($this->User->update_user_info($model_data)) {
				redirect('/dashboard');
				die();
			} else {
				$this->add_error('<p>Unable to update user info. Please try later</p>');
				$url = "/users/show_user/" . $this->input->post('id');
				redirect($url);
			}
		}
	}

	public function edit_description() {

		$this->load->model('User');
		$model_data = array('description' => $this->input->post('description'),
				            'id' => $this->input->post('id')
				                );

		if($this->User->update_user_description($model_data)) {
			redirect('/dashboard');
			die();
		} else {
			$this->add_error('<p>Unable to update description. Please try later</p>');
			$url = "/users/show_user/" . $this->input->post('id');
			redirect($url);
		}
	}

	public function update_password() 
	{
		$this->load->library('form_validation');
		$this->load->model('User');

		$this->form_validation->set_rules('password', 'Password', 
			'required|min_length[8]|matches[confpassword]');

		if(!$this->form_validation->run()) {
			$this->add_error(validation_errors());
			$url = "/users/show_user/" . $this->input->post('id');
			redirect($url);
			die();
		} else {
			$model_data = array('password' => md5($this->input->post('password')),
				            	'id' => $this->input->post('id')
				                );

			if($this->User->update_user_password($model_data)) {
				redirect('/dashboard');
				die();
			} else {
				$this->add_error('<p>Unable to update description. Please try later</p>');
				$url = "/users/show_user/" . $this->input->post('id');
				redirect($url);
			}

		}
	}

	public function show($id) {

		$this->load->model('User');
		$user_details = $this->User->get_user_by_id($id);


		if(!$user_details) {
			$this->add_error('<p>Unable to fetch user details. Please try later </p>');
			redirect("/");
		}

		$user_messages = $this->get_user_messages($id);

		$view_data = array('user_details' => $user_details,
			         		'messages' => $user_messages);


		$this->load->view('users/user_page.php', $view_data);
	}

	public function get_user_messages($id) 
	{
		$this->load->model('User');

		$messages = $this->User->get_messages_of_user($id);

		foreach ($messages as $key => $message) {

			$comments = $this->User->get_comments_of_message($message['id']);

			foreach ($comments as $comment_index => $comment) {
				
				$comment_by = $comment['user_id'];

				$user_details = $this->User->get_user_by_id($comment_by);

				//Adding the user details to the comment array

				$comments[$comment_index]['user_name'] = $user_details['first_name'] . 
														 " " . 
														 $user_details['last_name'];

				//change this later
				$comments[$comment_index]['time'] = $comment['created_at'];

				unset($comments[$comment_index]['created_at'], 
					$comments[$comment_index]['message_id'], 
					$comments[$comment_index]['user_id'],
					$comments[$comment_index]['id']);

			}

			$user_message =  $this->User->get_user_by_id($message['by_user']);
			$messages[$key]['user_name'] = $user_message['first_name'] . 
											" " . 
											$user_message['last_name'];
			$messages[$key]['comment_data'] = $comments;
		}

		return $messages;
	}

	public function add_new_message() 
	{
		$this->load->model("User");
		$user_details = $this->session->userdata('user_details');

		$message_data = array('user_id' => $this->input->post('message_for'),
							  'by_user' => $user_details['id'],
							  'message' => $this->input->post('new_message'));

		$this->User->add_new_message($message_data);
		$url = "/users/show/" . $this->input->post('message_for');

		redirect($url);
	}

	public function add_new_comment()
	{
		$this->load->model("User");
		$user_details = $this->session->userdata('user_details');
	
		$message_data = array('user_id' => $user_details['id'],
							  'message_id' => $this->input->post('comment_for_message'),
							  'comment' => $this->input->post('new_comment'));

		$this->User->add_new_comment($message_data);

		$url = "/users/show/" . $this->input->post('comment_by');
		redirect($url);
	}

	public function remove($id) {
		$this->load->model('User');

		$this->User->delete_user($id);

		redirect("/dashboard");
	}

	public function add_error($error) 
	{
		$errors = $this->session->flashdata('errors');

		if($errors) {
			$errors .= $error;
		} else {
			$errors = $error;
		}

		$this->session->set_flashdata('errors', $errors);
	}

}

?>