<?php 

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
		echo 'This is the user/index controller';
	}

}

?>