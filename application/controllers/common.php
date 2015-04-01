<?php 

/**
* 
*/
class Common extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
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