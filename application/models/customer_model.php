<?php
class Customer_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_customer_all()
	{
		$this->db->select('*');
		$this->db->from('ext_company');
        $this->db->where('is_customer', true);
                
                
		return $this->db->get()->result_array();
	}
    
    public function add_customer($data)
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
            "is_customer" => true
        );
        
        $this->db->insert('ext_company', $data_input);
        $last_id = $this->db->insert_id();
        $this->add_customer_site($last_id, $data['sites']);
        
        $this->db->trans_complete();
    }
    
    public function add_customer_site($id, $data_post)
    {
        foreach($data_post as $data)
        {
            $data_input = array(
                "site_name" => $data['site_name'],
                "address" => $data['address'],
                "city" => $data['city'],
                "customer" => $id
            );
            
            $this->db->insert('customer_site', $data_input);
        }
        
    }
    
    public function delete_customer_site_by_customer($id)
    {
        $this->db->where('customer', $id);
        $this->db->delete('customer_site');
    }
    
    public function edit_customer($data)
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
        
        $this->delete_customer_site_by_customer($data['id_ext_company']);
        $this->add_customer_site($data['id_ext_company'], $data['sites']);
        
        $this->db->trans_complete();
    }
    
    public function delete_customer($id)
    {
        $this->db->trans_start();
        $this->db->where('id_ext_company', $id);
        
        $this->db->delete('ext_company');
        
        $this->db->trans_complete();
    }
    
    public function get_customer_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('ext_company');
        $this->db->where('id_ext_company', $id);
        $this->db->where('is_customer', true);
                
		return $this->db->get()->result_array();
    }
    
    public function get_customer_site($id)
    {
        $this->db->select('customer_site.*, city.name as city_name, ec.name as customer_name, customer_site.id_customer_site as site');
        
        $this->db->from('customer_site');
        $this->db->join('city', 'city.id_city=customer_site.city', 'INNER');
        $this->db->join('ext_company as ec', 'ec.id_ext_company=customer_site.customer', 'INNER');
        $this->db->where('customer_site.customer', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function get_customer_site_from_wo($wo)
    {
        $this->db->select('wo.customer, cs.*');
        $this->db->from('work_order as wo');
        $this->db->join('ext_company as ec', 'ec.id_ext_company=wo.customer', 'INNER');
        $this->db->join('customer_site as cs', 'cs.customer=ec.id_ext_company', 'INNER');
        

        $this->db->where('wo.id_work_order', $wo);
                
		return $this->db->get()->result_array();
    }
}