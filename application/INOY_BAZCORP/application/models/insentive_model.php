<?php
class Insentive_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_insentive_all()
	{ 
	    $this->db->select('insentive.*,master_salary_type.salary_type,employee.full_name,payroll_periode.periode_name');
		$this->db->from('insentive');
        $this->db->join('master_salary_type', 'master_salary_type.id=insentive.master_salary_type_id');
        $this->db->join('employee', 'employee.id_employee=insentive.employee_id');
        $this->db->join('payroll_periode', 'payroll_periode.id_payroll_periode=insentive.payroll_periode_id');
         
		return $this->db->get()->result_array();
	}
    
    public function add_insentive($data)
    {
        $this->db->trans_start();
       
        $data_input = array(
            "master_salary_type_id" => $data['select_salary_type'],
            "employee_id" => $data['select_employee'],
            "payroll_periode_id" => $data['select_payroll_periode'],
            "nominal" => $data['nominal'],
            "description" => $data['description'],
        );
        
        $this->db->insert('insentive', $data_input);
         $this->db->trans_complete();
    }
     
    public function edit_insentive($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "salary_code" => $data['salary_code'],
            "insentive" => $data['insentive']
        );
        
        $this->db->where('id', $data['id']);
        $this->db->update('master_insentive', $data_input);
         
        $this->db->trans_complete();
    }
    
    public function delete_insentive($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        
        $this->db->delete('insentive');
        
        $this->db->trans_complete();
    }
    
    public function get_insentive_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('master_insentive');
        $this->db->where('id', $id);
                
		return $this->db->get()->result_array();
    }
    public function get_combo_salary_type(){
        $this->db->select('*');
        $this->db->from('master_salary_type');
        
        return $this->db->get()->result_array();
    }
    public function get_combo_employees(){
        $this->db->select('*');
        $this->db->from('employee');
        
        return $this->db->get()->result_array();
    }
    public function get_combo_payroll_periodes(){
        $this->db->select('*');
        $this->db->from('payroll_periode');
        
        return $this->db->get()->result_array();
    }
}