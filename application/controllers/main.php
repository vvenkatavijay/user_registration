<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('main/welcome.php');
	}

	public function signin() {
		$this->load->view('main/signin.php');
	}

	public function register() {
		$this->load->view('main/register.php');
	}
}

//end of main controller