<?php
class Salary_type_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_salary_type_all()
	{
		$this->db->select('*');
		$this->db->from('master_salary_type');
        //$this->db->where('is_customer', true);
                
                
		return $this->db->get()->result_array();
	}
    
    public function add_salary_type($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "salary_code" => $data['salary_code'],
            "salary_type" => $data['salary_type']
        );
        
        $this->db->insert('master_salary_type', $data_input);
         $this->db->trans_complete();
    }
     
    public function edit_salary_type($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "salary_code" => $data['salary_code'],
            "salary_type" => $data['salary_type']
        );
        
        $this->db->where('id', $data['id']);
        $this->db->update('master_salary_type', $data_input);
         
        $this->db->trans_complete();
    }
    
    public function delete_salary_type($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        
        $this->db->delete('salary_type');
        
        $this->db->trans_complete();
    }
    
    public function get_salary_type_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('master_salary_type');
        $this->db->where('id', $id);
                
		return $this->db->get()->result_array();
    }
}