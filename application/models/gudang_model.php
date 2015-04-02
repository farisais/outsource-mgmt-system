<?php
class Gudang_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_gudang_all()
	{
		$this->db->select('gudang.*');
		$this->db->from('gudang');
                
                
		return $this->db->get()->result_array();
	}
    
    public function get_real_gudang_all()
	{
		$this->db->select('gudang.*');
		$this->db->from('gudang');
        $this->db->where('is_virtual', 0);
                
		return $this->db->get()->result_array();
	}
    
    public function add_gudang($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "name" => $data['name'],
            "address" => $data['address'],
            "note" => $data['note'],
            "kode_lokasi" => $data['kode_lokasi'],
            
        );
        
        $this->db->insert('gudang', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function edit_gudang($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "name" => $data['name'],
            "address" => $data['address'],
            "note" => $data['note'],
            "kode_lokasi" => $data['kode_lokasi'],
        );
        
        $this->db->where('id_warehouse', $data['id_warehouse']);
        $this->db->update('gudang', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_gudang($id)
    {
        $this->db->trans_start();
        $this->db->where('id_warehouse', $id);
        
        $this->db->delete('gudang');
        
        $this->db->trans_complete();
    }
    
    public function get_gudang_by_id($id)
    {
        $this->db->select('gudang.*');
		$this->db->from('gudang');
        $this->db->where('id_warehouse', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function get_virtual_location()
    {
        $this->db->select('*');
        $this->db->from('gudang');
        $this->db->where('is_virtual', 1);
        
        return $this->db->get()->result_array();
    }
}