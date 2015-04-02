<?php
class Position_level_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
    
    public function get_position_level_all()
    {
        $this->db->select('*');
        $this->db->from('position_level');
        
        return $this->db->get()->result_array();
    }
    
    public function save_position_level($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "name" => $data['name'],
            "position_code" => $data['position_code'],
            "weight" => $data['weight']
        );
        
        $this->db->insert('position_level', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function get_position_level_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('position_level');
        $this->db->where('id_position_level', $id);
        return $this->db->get()->result_array();
    }
    
    public function edit_position_level($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "name" => $data['name'],
            "position_code" => $data['position_code'],
            "weight" => $data['weight']
        );
        
        $this->db->where('id_position_level', $data['id_position_level']);
        $this->db->update('position_level', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_position_level($id)
    {
        $this->db->trans_start();
        $this->db->where('id_position_level', $id);
        $this->db->delete('position_level');
        $this->db->trans_complete();
    }
}
?>