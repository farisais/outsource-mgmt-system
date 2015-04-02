<?php
class Organisation_structure_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
    
    public function get_organisation_structure_all()
    {
        $this->db->select('organisation_structure.*, os.structure_name AS parent_name');
        $this->db->from('organisation_structure');
        $this->db->join('organisation_structure AS os', 'organisation_structure.parent_structure=os.id_organisation_structure', 'LEFT');
        
        return $this->db->get()->result_array();
    }
    public function get_organisation_structure_all_grid()
    {
        $this->db->select('organisation_structure.*,organisation_structure.id_organisation_structure as structure_org_id');
        $this->db->from('organisation_structure');
        
        return $this->db->get()->result_array();
    }
    public function save_organisation_structure($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "structure_name" => $data['structure_name'],
            "parent_structure" => ($data['parent_structure'] == '' ? null : $data['parent_structure'])
//            "employment_type" => $data['position_type']
        );
        
        $this->db->insert('organisation_structure', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function get_organisation_structure_by_id($id)
    {
        $this->db->select('organisation_structure.*, os.structure_name AS parent_name');
        $this->db->from('organisation_structure');
        $this->db->join('organisation_structure AS os', 'organisation_structure.parent_structure=os.id_organisation_structure', 'LEFT');
        $this->db->where('organisation_structure.id_organisation_structure', $id);
        return $this->db->get()->result_array();
    }
    
    public function edit_organisation_structure($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "structure_name" => $data['structure_name'],
            "parent_structure" => ($data['parent_structure'] == '' ? null : $data['parent_structure'])
        );
        
        $this->db->where('id_organisation_structure', $data['id_organisation_structure']);
        $this->db->update('organisation_structure', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_organisation_structure($id)
    {
        $this->db->trans_start();
        $this->db->where('id_organisation_structure', $id);
        $this->db->delete('organisation_structure');
        $this->db->trans_complete();
    }
}
?>