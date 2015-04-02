<?php
class Log_error_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_log_error_all()
	{
		$this->db->select('*');
		$this->db->from('log_error');
        //$this->db->where('is_customer', true);
                
                
		return $this->db->get()->result_array();
	}
    
    public function add_log_error($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "log_error" => $data['log_error'],
            "date" => $data['date'],
            "pelapor" => $data['pelapor'],
            "handle_by" => $data['handle_by'],
            "kategori" => $data['kategori'],
            "waktu_pengerjaan" => $data['waktu_pengerjaan'],
            "status_pekerjaan" => $data['status_pekerjaan']
        );
        
        $this->db->insert('log_error', $data_input);
         $this->db->trans_complete();
    }
     
    public function edit_log_error($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "log_error" => $data['log_error']
        );
        
        $this->db->where('id', $data['log_error_code']);
        $this->db->update('log_error', $data_input);
         
        $this->db->trans_complete();
    }
    
    public function delete_log_error($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        
        $this->db->delete('log_error');
        
        $this->db->trans_complete();
    }
    
    public function get_log_error_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('log_error');
        $this->db->where('id', $id);
                
		return $this->db->get()->result_array();
    }
}