<?php
class Group_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_group_all()
	{
        $ci =& get_instance();
        $ci->load->model('appsetting_model');
        
        $auth = $ci->appsetting_model->check_action_authorization(169);
      
        
		$this->db->select('g.*, g.name as group_name, u1.full_name as creator, u2.full_name as administrator');
		$this->db->from('group as g');
        $this->db->join('user as u1', 'u1.id_user=g.created_by', 'INNER');
        $this->db->join('user as u2', 'u2.id_user=g.administrator', 'INNER');
        
        $ci =& get_instance();
        $ci->load->model('appsetting_model');
        
        if(!$auth)
        {
            $this->db->where('g.administrator', $this->session->userdata('app_userid'));
        }
  
		return $this->db->get()->result_array();
	}
    
    public function save_group($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['name'] = $data['name'];
        $data_input['description'] = $data['description'];
        $data_input['created_by'] = $this->session->userdata('app_userid');
        $data_input['administrator'] = $data['administrator'];
                
        $this->db->insert('group', $data_input);
        $return_id = $this->db->insert_id();
        
        $this->insert_group_member($return_id, $data['group_member']);
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function insert_group_member($id, $data)
    {
        foreach($data as $d)
        {
            $data_input = array();
            $data_input['group'] = $id;
            $data_input['user_member'] = $d['id_user'];
            
            $this->db->insert('group_member', $data_input);
        }
    }
    
    public function delete_group($id)
    {
        $this->db->trans_start();
        
        $this->delete_group_member($id);
        $this->db->where('id_group', $id);
        $this->db->delete('group');
        
        $this->db->trans_complete();
    }
    
    public function delete_group_member($id)
    {
        $this->db->where('group', $id);
        $this->db->delete('group_member');
    }
    
    public function edit_group($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['name'] = $data['name'];
        $data_input['description'] = $data['description'];
        //$data_input['created_by'] = $data['created_by'];
        //$data_input['administrator'] = $this->session->userdata('app_userid');
        $return_id = $data['id_group'];
        
        $this->db->where('id_group', $return_id);       
        $this->db->update('group', $data_input);
        
        $this->delete_group_member($return_id);
        $this->insert_group_member($return_id, $data['group_member']);
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function get_group_by_id($id)
    {
        $this->db->select('g.*');
		$this->db->from('group as g');
        $this->db->join('user as u', 'u.id_user=g.administrator', 'INNER');
        $this->db->where('id_group', $id);
		return $this->db->get()->result_array();
    }
    
    public function get_group_member_by_id($id)
    {
        $this->db->select('u.*');
        $this->db->from('group_member as g');
        $this->db->join('user as u', 'u.id_user=g.user_member', 'INNER');
        $this->db->where('group', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function check_access_to_group($group)
    {
        $this->db->select('*');
        $this->db->from('group');
        $this->db->where('id_group', $group);
        $this->db->where('administrator', $this->session->userdata('app_userid'));
        $this->db->or_where('created_by', $this->session->userdata('app_userid'));
        
        $result = $this->db->get()->result_array();
        
        return (count($result) > 0 ? true : false );
    }
    
    public function get_group_member_email($user)
    {
        $query = 'select g3.group, g4.*, u.email from (select g2.group from `group` as g 
        inner join group_member as g2 on g2.group=g.id_group where g2.user_member = '. $user .') as g3 inner join group_member as g4 on g4.group=g3.group
        inner join user as u on u.id_user=g4.user_member
        where g4.user_member <> ' . $user;
        
        $result = $this->db->query($query);
        return $result->result_array();
    }

}