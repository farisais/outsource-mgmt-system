<?php
class Supplier_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_supplier_all()
	{
		$this->db->select('*');
		$this->db->from('ext_company');
        $this->db->where('is_supplier', true);
                
                
		return $this->db->get()->result_array();
	}
    
    public function add_supplier($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "company_code" => $data['company_code'],
            "name" => $data['name'],
            "address" => $data['address'],
            "city" => $data['city'],
            "npwp" => $data['npwp'],
            "contact" => $data['contact'],
            "tlp" => $data['tlp'],
            "fax" => $data['fax'],
            "email" => $data['email'],
            "rekening" => $data['rekening'],
            "is_supplier" => true
        );
        
        $this->db->insert('ext_company', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function edit_supplier($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "company_code" => $data['company_code'],
            "name" => $data['name'],
            "address" => $data['address'],
            "city" => $data['city'],
            "npwp" => $data['npwp'],
            "contact" => $data['contact'],
            "tlp" => $data['tlp'],
            "fax" => $data['fax'],
            "email" => $data['email'],
            "rekening" => $data['rekening']
        );
        
        $this->db->where('id_ext_company', $data['id_ext_company']);
        $this->db->update('ext_company', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_supplier($id)
    {
        $this->db->trans_start();
        $this->db->where('id_ext_company', $id);
        
        $this->db->delete('ext_company');
        
        $this->db->trans_complete();
    }
    
    public function get_supplier_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('ext_company');
        $this->db->where('id_ext_company', $id);
        $this->db->where('is_supplier', true);
                
		return $this->db->get()->result_array();
    }
}