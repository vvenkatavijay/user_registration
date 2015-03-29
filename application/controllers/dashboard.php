<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Dashboard extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index() {

		$this->load->model('User');
		$user_details = $this->session->userdata('user_details');
		$all_users = $this->User->get_all_users();

		
		$view_data = array('user_data' => $all_users);

		if($all_users) {
			if ($user_details['user_level'] === 'admin') {
				
				$view_data['table_header'] = array("ID", "Name", "email", "created_at", "user_level", "action");
				$view_data['user_level'] = 9;
				$this->admin($view_data);
			} else {

				$view_data['user_level'] = 0;
				$view_data['table_header'] = array("ID", "Name", "email", "created_at", "user_level");
				$this->load->view('dashboard/dashboard.php', $view_data);
			}

		} else {
			redirect("/signin");
		}

		
	}

	public function admin($view_data) {
		$this->load->view('dashboard/dashboard.php', $view_data);
	}

	public function add_error($error) {
		$errors = $this->session->flashdata('errors');

		if($errors) {
			$errors .= $error;
		} else {
			$errors = $error;
		}

		$this->session->set_flashdata('errors', $errors);
	}

	public function log_off() {
		$this->session->sess_destroy();
		redirect("/");
	}

}

?>