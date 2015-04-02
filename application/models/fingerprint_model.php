<?php
class Fingerprint_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_fingerprint_all()
	{
		$this->db->select('*');
		$this->db->from('fingerprint_device');
                
		return $this->db->get()->result_array();
	}
    
    public function get_fingerprint_all_active()
    {
        $this->db->select('*');
		$this->db->from('fingerprint_device');
        $this->db->where('status', 'active');
                
		return $this->db->get()->result_array();
    }
 
    public function save_fingerprint($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['merk'] = $data['merk'];
        $data_input['series'] = $data['series'];
        $data_input['serial_number'] = $data['serial_number'];
        $data_input['ip_local_setting'] = $data['ip_local_setting'];
        $data_input['comm_password'] = $data['comm_password'];
        $data_input['status'] = 'inactive';
        
        $this->db->insert('fingerprint_device', $data_input);
        
        $return_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function change_fingerprint_status($id, $status)
    {
        $this->db->trans_start();
        $this->db->where('id_fingerprint_device', $id);
        $this->db->update('fingerprint_device', array("status" => $status));
        $this->db->trans_complete();
    }
    
    public function edit_fingerprint($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['merk'] = $data['merk'];
        $data_input['series'] = $data['series'];
        $data_input['serial_number'] = $data['serial_number'];
        $data_input['ip_local_setting'] = $data['ip_local_setting'];
        $data_input['comm_password'] = $data['comm_password'];
        $data_input['status'] = 'inactive';
        
        $this->db->where('id_fingerprint_device', $data['id_fingerprint_device']);
        $this->db->update('fingerprint_device', $data_input);
        
        $this->db->trans_complete();
        
        return $data['id_fingerprint_device'];
    }
    
    public function delete_fingerprint($id)
    {
        $this->db->trans_start();
        $this->db->where('id_fingerprint_device', $id);
        
        $this->db->delete('fingerprint_device');
        
        $this->db->trans_complete();
    }
    
    public function get_fingerprint_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('fingerprint_device');
        $this->db->where('id_fingerprint_device', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function register_command($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['command'] = $data['command'];
        
        $this->db->insert('fdcommand_register', $data_input);
        $return_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function save_fingerprint_enroll($data)
    {        
        $returnVal = null;
        $this->db->select('id_employee');
        $this->db->from('employee');
        $this->db->where('employee_number', $data['respons']['employee_number']);
        
        $emp = $this->db->get()->result_array(); 
        if(count($emp) > 0)
        {
            $this->db->trans_start();
            
            $this->db->where('employee', $emp[0]['id_employee']);
            $this->db->delete('fingerprint_template');
            
            $data_input = array();
            $data_input['employee'] = $emp[0]['id_employee'];
            $data_input['fingerprint_tmp'] = $data['respons']['fingerprint_tmp'];
            $data_input['fid'] = $data['respons']['fid'];
            $data_input['flag'] = $data['respons']['flag'];
            $data_input['tmp_length'] = $data['respons']['tmp_length'];
            
            $this->db->insert('fingerprint_template', $data_input);
            
            $returnVal = $data_input;
            
            $this->db->where('so_assignment_number', $emp[0]['id_employee']);
            $this->db->update('so_assignment', array("fingerprint_assign_status" => "unassign"));
            
            $this->db->trans_complete();
        }
        
        return $returnVal;
    }
}