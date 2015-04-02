<?php
class Stock_transaction_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_stock_transaction_all()
	{
		$this->db->select('stock_transaction.*, product.product_code,product.product_name,gudang.name AS gudang1_name, gudang2.name AS gudang2_name ,unit_measure.name AS unit_name');
		$this->db->from('stock_transaction');
        $this->db->join('product', 'stock_transaction.product=product.id_product', 'INNER');
        $this->db->join('unit_measure', 'stock_transaction.uom=unit_measure.id_unit_measure', 'INNER');
        $this->db->join('gudang', 'stock_transaction.source_location=gudang.id_warehouse', 'INNER');
        $this->db->join('gudang AS gudang2', 'stock_transaction.destination_location=gudang2.id_warehouse', 'INNER');
  
                
		return $this->db->get()->result_array();
	}
    
    public function get_stock_transaction_open()
    {

    }
    
    public function save_stock_transaction($data)
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
        
        $this->db->insert('stock_transaction', $data_input);
        $return_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function edit_stock_transaction($data)
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
        
        $this->db->where('id_stock_transaction', $data['id_stock_transaction']);
        $this->db->update('stock_transaction', $data_input);
        
        $this->db->trans_complete();
    }

    public function validate_stock_transaction($id)
    {
      
    }
    
    public function get_stock_transaction_by_id($id)
    {
        $this->db->select('stock_transaction.*, product.product_code,product.product_name,gudang.name AS gudang1_name, gudang.kode_lokasi AS gudang1_code, gudang2.name AS gudang2_name, gudang2.kode_lokasi AS gudang2_code ,unit_measure.name AS unit_name');
		$this->db->from('stock_transaction');
        $this->db->join('product', 'stock_transaction.product=product.id_product', 'INNER');
        $this->db->join('unit_measure', 'stock_transaction.uom=unit_measure.id_unit_measure', 'INNER');
        $this->db->join('gudang', 'stock_transaction.source_location=gudang.id_warehouse', 'INNER');
        $this->db->join('gudang AS gudang2', 'stock_transaction.destination_location=gudang2.id_warehouse', 'INNER');      
        
        $this->db->where('id_stock_transaction', $id);
		return $this->db->get()->result_array();
    }
    
    public function change_stock_transaction_status($id, $status)
    {
        $this->db->trans_start();
        
        $this->db->where('id_stock_transaction', $id);
        $this->db->update('stock_transaction', array('status' => $status));
        
        $this->db->trans_complete();
    }
    
    public function automatic_stock_transaction($description, $picking_type, $transaction_date, $source_location, $products)
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
            $data_input['destination_location'] = $prod['warehouse'];
            
            $this->db->insert('stock_transaction', $data_input);
            $return_id = $this->db->insert_id();
            
            $this->db->trans_complete();
        }
    }
    
    public function automatic_stock_transaction_out($description, $picking_type, $transaction_date, $source_location, $products)
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
            $data_input['source_location'] = $prod['warehouse'];
            $data_input['destination_location'] = $source_location;
            
            $this->db->insert('stock_transaction', $data_input);
            $return_id = $this->db->insert_id();
            
            $this->db->trans_complete();
        }
    }
    
    public function insert_stock_transaction($description, $product, $uom, $qty, $picking_type, $transaction_date, $source_location, $destination_location)
    {
        $data_input = array();
            
        $data_input['description'] =$description;
        $data_input['product'] = $product;
        $data_input['uom'] = $uom;
        $data_input['qty'] = $qty;
        $data_input['picking_type'] = $picking_type;
        $data_input['transaction_date'] = $transaction_date;
        $data_input['status'] = 'post';
        $data_input['source_location'] = $source_location;
        $data_input['destination_location'] = $destination_location;
        
        $this->db->insert('stock_transaction', $data_input);
    }
    
}