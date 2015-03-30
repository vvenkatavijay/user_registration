<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Model for the users
*/
class User extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_user_details($email)
	{
		$user_query = "SELECT * FROM users WHERE email=?";

		return $this->db->query($user_query, $email)->row_array();
	} 

	public function get_user_by_id($id)
	{
		$user_query = "SELECT * FROM users WHERE id=?";

		return $this->db->query($user_query, $id)->row_array();
	} 

	public function add_user() 
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha');
		$this->form_validation->set_rules('password', 'Password', 
			'required|min_length[8]|matches[confpassword]');
		$this->form_validation->set_rules('email', 'Email', 
			'required|valid_email|is_unique[users.email]');

		$this->form_validation->set_message('is_unique', '%s already exists.');

		$errors = NULL;

		if($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
		} else {

			$user_level = $this->get_new_user_level();
			$register_query = "INSERT INTO users VALUES (NULL, ?, ?, ?, ?, NULL, ?, NOW(), NOW())";

			$query_data = array($this->input->post("first_name"),
								$this->input->post("last_name"),
								$this->input->post("email"),
								md5($this->input->post("password")),
								$user_level
						   );

			if(!$this->db->query($register_query, $query_data)) {
				$errors = "<p>There was a problem registering. Please try again later</p>";
			}
		}

		return $errors;
	}

	public function get_new_user_level() {

		if(count($this->db->query("SELECT * FROM users")->result_array()) == 0) {
			return "admin";
		} else { 
			return "normal";
		}
	}

	public function get_all_users() 
	{

		return $this->db->query("SELECT id, first_name, last_name, email, created_at, user_level FROM users")->result_array();
	}

	public function update_user_description($user_details) 
	{
		$query = "UPDATE users SET description = ? WHERE id = ?";

		return $this->db->query($query, $user_details);
	}

	public function update_user_info($model_data)
	{
		if(isset($model_data['user_level'])) {

			$query = "UPDATE users SET email = ?, 
								   	   first_name = ?, 
								   	   last_name = ?, 
								   	   user_level = ? WHERE id = ?";

			return $this->db->query($query, $model_data);

		} else {

			$query = "UPDATE users SET email = ?, 
								   	   first_name = ?, 
								   	   last_name = ? WHERE id = ?";

			return $this->db->query($query, $model_data);

		}
	}

	public function update_user_password($user_details) {
		$query = "UPDATE users SET password = ? WHERE id = ?";

		return $this->db->query($query, $user_details);
	}

	public function get_messages_of_user($id) {

		$query = "SELECT * FROM messages WHERE user_id = ?";

		return $this->db->query($query, $id)->result_array();
	}

	public function get_comments_of_message($message_id) {

		$query = "SELECT * FROM comments WHERE message_id = ?";

		return $this->db->query($query, $message_id)->result_array();
	} 

	public function add_new_message($message_data) 
	{
		$query = "INSERT INTO messages VALUES(NULL, ?, ?, ?, NOW())";

		return $this->db->query($query, $message_data);
	}

	public function add_new_comment($comment_data) 
	{
		$query = "INSERT INTO comments VALUES(NULL, ?, ?, ?, NOW())";

		return $this->db->query($query, $comment_data);
	}

	public function delete_user($id) 
	{
		$comment_query = "DELETE FROM comments WHERE user_id = ?";
		$message_query = "DELETE FROM messages WHERE user_id = ?";
		$user_query = "DELETE FROM users WHERE user_id = ?";

		$result = ($this->db->query($comment_query, $id)) || 
		          ($this->db->query($message_query, $id)) ||
				  ($this->db->query($user_query, $id));

		return $result;
	}
}

?>