<?php
 class Chatmodel extends CI_Model{
 
 	var $username='';
	var $password='';
 	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function login($name,$pass)
	{
		$query = $this->db->query("select * from login_table where username='".$name."' and password='".$pass."'");
		if($query->num_rows()>0)
		{
			return true;
   		}
		else
		{
			return false;
		}
	}
	
	public function register($name,$pass)
	{
		$query = $this->db->query("select * from login_table where username='".$name."' or password='".$pass."'");
		if($query->num_rows()>0)
		{
			return false;
   		}
		else
		{
			$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
	
			$this->db->insert('login_table', $data);
			return true;
		}
	}
	
	public function contactlist($name)
	{
		$query = $this->db->query("select username from login_table where username not like'".$name."'");
		return $query->result_array();
	}
}
?>
