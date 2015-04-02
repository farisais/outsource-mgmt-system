<?php
class Dn_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_dn_all()
	{
		$this->db->select('dn.*, so.*, dn.status AS status_dn');
		$this->db->from('dn');
                $this->db->join('so', 'so.id_so=dn.so', 'LEFT');
                
		return $this->db->get()->result_array();
	}
        
        public function get_dn_open()
	{
		$this->db->select('dn.*, so.*');
		$this->db->from('dn');
                $this->db->join('so', 'so.id_so=dn.so', 'INNER');
                
                $this->db->where('dn.status !=', 'close');
                
		return $this->db->get()->result_array();
	}
        
        public function get_dn_close()
	{
		$this->db->select('dn.*, so.*');
		$this->db->from('dn');
                $this->db->join('so', 'so.id_so=dn.so', 'LEFT');
                
                $this->db->where('dn.status ==', 'close');
                                
		return $this->db->get()->result_array();
	}
    
    public function save_dn($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "so" => ($data['so'] == '' ? null : $data['so']),
            "date" => $data['date'],
            "no_dn" => $this->generate_dn_number(),
            "note" => $data['note'],
            "status" => 'draft'
        );
        
        $this->db->insert('dn', $data_input);
        $id_dn = $this->db->insert_id();
        //$this->insert_dn_product($id_dn, $data['product_detail'], $data['id_so']);
        
        $this->add_dn_product($id_dn, $data['product_detail']);
            
        //=====================
        
        
        $this->db->trans_complete();
    }
    
    public function add_dn_product($id_dn, $data_product)
    {
        foreach($data_product as $p)
        {
            $data_input = array();
            $data_input['dn'] = $id_dn;
            $data_input['product'] = $p['id_product'];
            $data_input['qty'] = $p['qty'];
            $data_input['uom'] = $p['unit'];
            $data_input['source_location'] = $p['source_location'];
            
            $this->db->insert('dn_product', $data_input);
        }
    }
    
    public function insert_dn_product($id, $data_product, $id_so)
    {
        $ci =& get_instance();
        $ci->load->model('so_model');
        $so_complete = true;
        foreach($data_product as $p)
        {
             $data = array(
                'dn' => $id,
                'product' => $p['id_product'],
                'qty' => $p['qty_order'],
                'uom' => $p['unit'],
            );
            
            $this->db->insert('dn_product', $data);
            
            if($p['qty_order'] != $p['qty_ordered'])
            {
                $so_complete == false;
            }
            
            $ci->so_model->update_product_qty_received($id_so, $p['id_product'], $p['qty_received']);
            //$ci->po_model->generate_barcode_number($id_po, $p['id_product']);
        }
        
        if($so_complete == true)
        {
            $so = $ci->so_model->get_so_by_id($id_po);
            if($so[0]['status'] == 'open' )
            {
                 $ci->so_model->change_so_status($id_so, 'deliver');
            }
            
           
        }
    }
    
    public function change_dn_status($id, $status)
    {
        $this->db->trans_start();
        
        $this->db->where('id_dn', $id);
        $this->db->update('dn', array('status' => $status));
        
        $this->db->trans_complete();
    }
    
    public function get_virtual_location()
    {
        $this->db->select('*');
        $this->db->from('gudang');
        $this->db->where('is_virtual', 1);
        
        $result = $this->db->get()->result_array();
        
        if(count($result) > 0)
        {
            return $result[0]['id_warehouse'];
        }
        else
        {
            return -1;
        }
    }
    
    public function generate_dn_number()
    {
        $this->db->select('*');
        $this->db->from('dn');
        $this->db->where('YEAR(date)', date('Y'));
        
        $result = $this->db->get()->result_array();
        $countResult = count($result) + 1;
        $zeroCount = '';
        
        for($i=0; $i<4 - strlen($countResult);$i++)
        {
            $zeroCount .= '0';
        }
        
        return ("DN" . date('y') . $zeroCount . $countResult);
    }
    
    public function edit_dn($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "so" => $data['so'],
            "date" => $data['date'],
            "note" => $data['note'],
            "status" => 'draft'
        );
        
        $this->db->where('id_dn', $data['id_dn']);
        $id_dn = $data['id_dn'];
        $this->add_dn_product($id_dn, $data['product_detail']);
        
        $this->db->update('dn', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_dn($id)
    {
        $this->db->trans_start();
        $this->delete_product_id($id);
        $this->db->where('id_dn', $id);
        
        $this->db->delete('dn');
        
        $this->db->trans_complete();
    }
    
        
    public function delete_product_id($id)
    {
        $this->db->trans_start();
        $this->db->where('dn', $id);
        $this->db->delete('dn_product');
    }
    
    public function get_dn_by_id($id)
    {
        $this->db->select('dn.*, so.*, customer.name AS customer_name, dn.status AS status_dn, so.status AS status_so');
	$this->db->from('dn');
        $this->db->join('so', 'so.id_so=dn.so', 'INNER');
        $this->db->join('customer', 'customer.id_customer=so.customer','INNER');
        $this->db->where('dn.id_dn', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function get_dn_product_by_id_dn($id)
    {
        $this->db->select('dn_product.*, product.*, unit_measure.name AS unit_name, gudang.name AS warehouse_name , product_category.product_category AS category_name');
        $this->db->from('dn_product');
        $this->db->join('product', 'dn_product.product=product.id_product', 'INNER');
        $this->db->join('gudang', 'dn_product.source_location=gudang.id_warehouse', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=product.unit', 'LEFT');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
        $this->db->where('dn_product.dn', $id);
        
        return $this->db->get()->result_array();
    }
    
    //==========================================================================================
    
}