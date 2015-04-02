<?php
class Menu_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
    
    public function get_group()
    {
        $this->db->select('application_side_menu.*, asm.name');
        $this->db->from('application_side_menu AS application_side_menu');
        $this->db->join('division', 'division.id_division=application_side_menu.division', 'LEFT');
        $this->db->join('application_side_menu AS asm', 'application_side_menu.parent=asm.id_application_menu', 'LEFT');
        $this->db->where('application_side_menu.type', 'group');
        $this->db->order_by('application_side_menu.index', 'ASC');
        
        return $this->db->get()->result_array();
    }
    
    public function get_child($group)
    {
        $this->db->select('application_side_menu.*, asm.name');
        $this->db->from('application_side_menu AS application_side_menu');
        $this->db->join('division', 'division.id_division=application_side_menu.division', 'LEFT');
        $this->db->join('application_side_menu AS asm', 'application_side_menu.parent=asm.id_application_menu', 'LEFT');
        $this->db->where('application_side_menu.parent', $group);
        $this->db->order_by('application_side_menu.index', 'ASC');
        
        return $this->db->get()->result_array();
    }
    
    public function get_all_side_menu()
    {
        $this->db->select('application_side_menu.*, asm.name AS parent_name, division.name AS division_name, application_action.name AS action_name');
        $this->db->from('application_side_menu AS application_side_menu');
        $this->db->join('division', 'division.id_division=application_side_menu.division', 'LEFT');
        $this->db->join('application_side_menu AS asm', 'application_side_menu.parent=asm.id_application_menu', 'LEFT');
        $this->db->join('application_action', 'application_action.id_application_action=application_side_menu.action', 'LEFT');
        
        $this->db->order_by('application_side_menu.index', 'ASC');
        
        return $this->db->get()->result_array();
    }
    
    public function get_side_menu_view_by_value($val)
    {
        $this->db->select('views_path');
        $this->db->from('application_side_menu');
        $this->db->where('stored_value', $val);
        
        return $this->db->get()->result_array();
    }
    
    public function get_action_from_menu($smenu)
    {
        $this->db->select('action');
        $this->db->from('application_side_menu');
        $this->db->where('id_application_menu', $smenu);
        
        $action = $this->db->get()->result_array();
        if($action[0]['action'] != '' && $action[0]['action'] != null)
        {
            return $action[0]['action'];
        }
        else
        {
            return 'not_find';
        }
    }
    
    public function get_detail_action($action_id)
    {
        $this->db->select('*');
        $this->db->from('application_action');
        $this->db->where('id_application_action', $action_id);
        $this->db->or_where('uname', $action_id);
        
        return $this->db->get()->result_array();
    }
    
   
    
    public function get_side_menu_by_id($id)
    {
        $this->db->select('application_side_menu.*, asm.name AS parent_name, division.name AS division_name, application_action.name AS action_name');
        $this->db->from('application_side_menu AS application_side_menu');
        $this->db->join('division', 'division.id_division=application_side_menu.division', 'LEFT');
        $this->db->join('application_side_menu AS asm', 'application_side_menu.parent=asm.id_application_menu', 'LEFT');
        $this->db->join('application_action', 'application_action.id_application_action=application_side_menu.action', 'LEFT');
        
        $this->db->where('application_side_menu.id_application_menu', $id);
        
        return $this->db->get()->result_array();
    }
}
?>