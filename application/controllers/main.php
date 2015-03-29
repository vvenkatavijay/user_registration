<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{
		if($this->session->userdata('user_details')) {
			redirect('/dashboard/index');
			die();
		} else {
			$this->load->view('main/welcome.php');
		}
	}

	public function signin() 
	{
		if($this->session->userdata('user_details')) {
			redirect('/dashboard/index');
			die();
		}
		else {
			$errors = $this->session->flashdata('errors');

			$view_data = array('errors' => $errors );
			$this->load->view('main/signin.php', $view_data);
		}
	}

	public function register() 
	{
		$success = $this->session->flashdata('success');
		$message = $this->session->flashdata('message');

		$view_data = array('message' => $message,
						   'success' => $success 
					);

		$this->load->view('main/register.php', $view_data);
	}

	public function add_user()
	{
		$success = $this->session->flashdata('success');
		$message = $this->session->flashdata('message');

		$view_data = array('message' => $message,
						   'success' => $success 
					);

		$this->load->view('users/add_user.php', $view_data);
	}

	public function register_user($redirect) {
		$this->load->model("User");

		$errors = $this->User->add_user();

		if(!$errors) {
			$success = TRUE;
			$message = '<p>Resgistration successful</p>';
		} else {
			$success = FALSE;
			$message = $errors;
		}

		$this->session->set_flashdata('success', $success);
		$this->session->set_flashdata('message', $message);

		if ($redirect === "admin")
			redirect("/users/new");
		else 
			redirect("/register");
	}

	public function authenticate()
	{

		$this->load->library('form_validation');
		$this->load->model('User');

		$this->form_validation->set_rules('email', 'Email', 
			'required|valid_email');

		if(!$this->form_validation->run()) {

			$this->add_error(validation_errors());
		} else {

			$email = $this->input->post('email');
			$user_details = $this->User->get_user_details($email);

			if(!$user_details) {

				$this->add_error("<p> Unable to login due to database error. Please try later </p>");

			} else if(md5($this->input->post('password')) === $user_details['password']){

				unset($user_details['password']);
				$this->session->set_userdata('user_details', $user_details);

				redirect('/dashboard');
				die();

			} else {

				$this->add_error('<p>Invalid login credentials</p>');
			}
		}

		redirect("/signin");
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