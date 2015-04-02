<?php
class bom_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_bom_all()
	{
		$this->db->select('bom.*, product.product_code,product.product_name');
		$this->db->from('bom');
        $this->db->join('product', 'bom.product=product.id_product', 'INNER');
  
		return $this->db->get()->result_array();
	}
    
    public function get_bom_open()
    {
   	    $this->db->select('bom.*, bom.name as bom_name, product.*');
		$this->db->from('bom');
        $this->db->join('product', 'bom.product=product.id_product', 'INNER');
        $this->db->where('bom.status', 'active');
  
		return $this->db->get()->result_array();
    }
    
    public function save_bom($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['name'] = $data['name'];
        $data_input['product'] = $data['product'];
        $data_input['status'] = 'draft';
                
        $this->db->insert('bom', $data_input);
        $return_id = $this->db->insert_id();
        
        $this->insert_bom_product($return_id, $data['bom_product']);
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function insert_bom_product($id, $data)
    {
        foreach($data as $d)
        {
            $data_input = array();
            $data_input['bom'] = $id;
            $data_input['product'] = $d['id_product'];
            $data_input['qty'] = $d['qty'];
            $data_input['uom'] = $d['unit'];
            
            $this->db->insert('detail_bom', $data_input);
        }
    }
    
    public function delete_bom_product($bom)
    {
        $this->db->where('bom', $bom);
        $this->db->delete('bom');
    }
    
    public function edit_bom($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['name'] = $data['name'];
        $data_input['product'] = $data['product'];
        $data_input['status'] = 'draft';
        
        $this->db->where('id_bom', $data['id_bom']);
        $this->db->update('bom', $data_input);
        $return_id = $data['id_bom'];
        
        $this->delete_bom_product($data['id_bom']);
        
        $this->insert_bom_product($return_id, $data['bom_product']);
        
        $this->db->trans_complete();
        
        return $return_id;
    }

    public function validate_bom($id)
    {
        $this->db->where('id_bom', $id);
        $this->db->update('bom', array("status" => "active"));
    }
    
    public function get_bom_by_id($id)
    {
        $this->db->select('bom.*, product.product_code,product.product_name');
		$this->db->from('bom');
        $this->db->join('product', 'bom.product=product.id_product', 'INNER');
        
        $this->db->where('id_bom', $id);
		return $this->db->get()->result_array();
    }
    
    public function change_bom_status($id, $status)
    {
        $this->db->trans_start();
        
        $this->db->where('id_bom', $id);
        $this->db->update('bom', array('status' => $status));
        
        $this->db->trans_complete();
    }
    
    public function automatic_bom($description, $picking_type, $transaction_date, $source_location, $destination_location, $products)
    {
        foreach($products as $prod)
        {
            $this->db->trans_start();
        
            $data_input = array();
            
            $data_input['description'] =$description;
            $data_input['product'] = $prod['product'];
            $data_input['uom'] = $prod['uom'];
            $data_input['qty'] = $prod['qty'];
            $data_input['picking_type'] = $picking_type;
            $data_input['transaction_date'] = $transaction_date;
            $data_input['status'] = 'post';
            $data_input['source_location'] = $source_location;
            $data_input['destination_location'] = $destination_location;
            
            $this->db->insert('bom', $data_input);
            $return_id = $this->db->insert_id();
            
            $this->db->trans_complete();
        }
    }
    
    public function get_bom_product_by_id($id)
    {
        $this->db->select('detail_bom.*, product.product_code,product.product_name, um.name as unit_name');
		$this->db->from('detail_bom');
        $this->db->join('product', 'detail_bom.product=product.id_product', 'INNER');
        $this->db->join('unit_measure as um', 'detail_bom.uom=um.id_unit_measure', 'INNER');
        
        $this->db->where('bom', $id);
  
		return $this->db->get()->result_array();
    }
}