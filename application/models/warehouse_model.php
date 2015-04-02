<?php
class Warehouse_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_warehouse_all()
	{
		$this->db->select('gudang.*');
		$this->db->from('gudang');
                
                
		return $this->db->get()->result_array();
	}
    
    public function get_warehouse_not_virtual()
    {
        $this->db->select('gudang.*');
		$this->db->from('gudang');
        $this->db->where('is_virtual', 0);
                
                
		return $this->db->get()->result_array();
    }
    
    public function add_warehouse($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "name" => $data['name'],
            "address" => $data['address'],
            "note" => $data['note'],
            "kode_lokasi" => $data['kode_lokasi'],
            "is_virtual" => $data['is_virtual']
        );
        
        $this->db->insert('gudang', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function edit_warehouse($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "name" => $data['name'],
            "address" => $data['address'],
            "note" => $data['note'],
            "kode_lokasi" => $data['kode_lokasi'],
            "is_virtual" => $data['is_virtual']
        );
        
        $this->db->where('id_warehouse', $data['id_warehouse']);
        $this->db->update('gudang', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_warehouse($id)
    {
        $this->db->trans_start();
        $this->db->where('id_warehouse', $id);
        
        $this->db->delete('gudang');
        
        $this->db->trans_complete();
    }
    
    public function get_warehouse_by_id($id)
    {
        $this->db->select('gudang.*');
		$this->db->from('gudang');
        $this->db->where('id_warehouse', $id);
                
		return $this->db->get()->result_array();
    }
}