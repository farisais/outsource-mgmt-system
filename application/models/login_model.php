<?php
class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function validate()
	{
		//grab user input
		$username = $this->security->xss_clean($this->input->post('username'));
		$password = md5($this->security->xss_clean($this->input->post('password')));
		
		//prepare the query
		$this->db->select('user.*,role.name AS role_name');
		$this->db->from('user');
		$this->db->join('role', 'user.role=role.id_role', 'INNER');
		//$this->db->join('division', 'user.division=division.id_division', 'INNER');
		
		$this->db->where('user_name', $username);
		$this->db->where('password', $password);
		//Run the query
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$row = $query->row();
			$this->db->select('*');
			$this->db->from('division');
			$this->db->where('id_division', $row->division);
			$div_query = $this->db->get();
			$div_name = 'admin';
			if($div_query->num_rows() != 0)
			{
				$div_name = $div_query->row()->name;
			}
			
			$row = $query->row();
			$data = array(
					'app_userid' => $row->id_user,
					'app_username' => $row->user_name,
					'app_fullname' => $row->full_name,
					'app_role' => $row->role_name,
					'app_role_id' => $row->role,
					'app_div_id' => $row->division,
					'app_div_name' => $div_name
					);
			$this->session->set_userdata($data);
			return true;
		}
		return false;
	}
}
?>