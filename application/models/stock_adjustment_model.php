<?php
class stock_adjustment_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_stock_adjustment_all()
	{
        $this->db->select('*');
        $this->db->from('stock_adjustment');
		return $this->db->get()->result_array();
	}
    
    public function get_stock_adjustment_open()
    {

    }
    
    public function save_stock_adjustment($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['description'] = $data['description'];
        $data_input['product'] = $data['product'];
        $data_input['uom'] = $data['uom'];
        $data_input['qty'] = $data['qty'];
        $data_input['picking_type'] = $data['picking_type'];
        $data_input['transaction_date'] = $data['transaction_date'];
        $data_input['status'] = 'unpost';
        $data_input['source_location'] = $data['source_location'];
        $data_input['destination_location'] = $data['destination_location'];
        
        $this->db->insert('stock_adjustment', $data_input);
        $return_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function edit_stock_adjustment($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['description'] = $data['description'];
        $data_input['product'] = $data['product'];
        $data_input['uom'] = $data['uom'];
        $data_input['qty'] = $data['qty'];
        $data_input['picking_type'] = $data['picking_type'];
        $data_input['transaction_date'] = $data['transaction_date'];
        $data_input['status'] = 'unpost';
        $data_input['source_location'] = $data['source_location'];
        $data_input['destination_location'] = $data['destination_location'];
        
        $this->db->where('id_stock_adjustment', $data['id_stock_adjustment']);
        $this->db->update('stock_adjustment', $data_input);
        
        $this->db->trans_complete();
    }

    public function validate_stock_adjustment($id)
    {
      
    }
    
    public function get_stock_adjustment_by_id($id)
    {
        $this->db->select('stock_adjustment.*, product.product_code,product.product_name,gudang.name AS gudang1_name, gudang.kode_lokasi AS gudang1_code, gudang2.name AS gudang2_name, gudang2.kode_lokasi AS gudang2_code ,unit_measure.name AS unit_name');
		$this->db->from('stock_adjustment');
        $this->db->join('product', 'stock_adjustment.product=product.id_product', 'INNER');
        $this->db->join('unit_measure', 'stock_adjustment.uom=unit_measure.id_unit_measure', 'INNER');
        $this->db->join('gudang', 'stock_adjustment.source_location=gudang.id_warehouse', 'INNER');
        $this->db->join('gudang AS gudang2', 'stock_adjustment.destination_location=gudang2.id_warehouse', 'INNER');      
        
        $this->db->where('id_stock_adjustment', $id);
		return $this->db->get()->result_array();
    }
    
    public function change_stock_adjustment_status($id, $status)
    {
        $this->db->trans_start();
        
        $this->db->where('id_stock_adjustment', $id);
        $this->db->update('stock_adjustment', array('status' => $status));
        
        $this->db->trans_complete();
    }
    
    public function automatic_stock_adjustment($description, $picking_type, $transaction_date, $source_location, $destination_location, $products)
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
            
            $this->db->insert('stock_adjustment', $data_input);
            $return_id = $this->db->insert_id();
            
            $this->db->trans_complete();
        }
    }
}