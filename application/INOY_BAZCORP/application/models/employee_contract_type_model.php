<?php
class Employee_contract_type_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
    
    public function get_employee_contract_type_all()
    {
        $this->db->select('*');
        $this->db->from('employee_contract_type');
        
        return $this->db->get()->result_array();
    }
    
    public function save_employee_contract_type($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "name" => $data['name'],
            "abv" => $data['abv']
        );
        
        $this->db->insert('employee_contract_type', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function get_employee_contract_type_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('employee_contract_type');
        $this->db->where('id_employee_contract_type', $id);
        return $this->db->get()->result_array();
    }
    
    public function edit_employee_contract_type($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "name" => $data['name'],
            "abv" => $data['abv']
        );
        
        $this->db->where('id_employee_contract_type', $data['id_employee_contract_type']);
        $this->db->update('employee_contract_type', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_employee_contract_type($id)
    {
        $this->db->trans_start();
        $this->db->where('id_employee_contract_type', $id);
        $this->db->delete('employee_contract_type');
        $this->db->trans_complete();
    }
}
?>