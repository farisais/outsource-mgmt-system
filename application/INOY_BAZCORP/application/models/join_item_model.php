<?php
class Join_item_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_join_item_all()
	{
		$this->db->select('join_item.*, product.product_code,product.product_name, bom.name as bom_name');
		$this->db->from('join_item');
        $this->db->join('bom', 'bom.id_bom=join_item.bom', 'INNER');
        $this->db->join('product', 'bom.product=product.id_product', 'INNER');
        
		return $this->db->get()->result_array();
	}

    
    public function save_join_item($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['date'] = $data['date'];
        $data_input['join_item_number'] = 'temp';
        $data_input['activity'] = $data['activity'];
        $data_input['qty'] = $data['qty'];
        $data_input['bom'] = $data['bom'];
        $data_input['gudang'] = ($data['gudang'] == '' ? null : $data['gudang']);
        $data_input['status'] = 'open';
        //data_post['join_item_product'] = $("#join-item-product-grid").jqxGrid('getrows');
                
        $this->db->insert('join_item', $data_input);
        $return_id = $this->db->insert_id();
        $this->generate_join_item_number($return_id, 'join_item', 'JI', 'date', 'id_join_item', 'join_item_number');
        
        $this->insert_join_item_product($return_id, $data['join_item_product']);
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function insert_join_item_product($id, $data)
    {
        foreach($data as $d)
        {
            $data_input = array();
            $data_input['join_item'] = $id;
            $data_input['product'] = $d['product'];
            $data_input['qty_bom'] = $d['qty'];
            $data_input['qty_transfer'] = $d['qty_transfer'];
            $data_input['gudang'] = $d['warehouse'];
            
            $this->db->insert('join_item_product', $data_input);
        }
    }
    
    public function delete_join_item($join_item)
    {
        $this->db->where('join_item', $join_item);
        $this->db->delete('join_item');
    }
    
    public function edit_join_item($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['date'] = $data['date'];
        $data_input['activity'] = $data['activity'];
        $data_input['qty'] = $data['qty'];
        $data_input['bom'] = $data['bom'];
        $data_input['gudang'] = ($data['gudang'] == '' ? null : $data['gudang']);
        $data_input['status'] = 'open';
        //data_post['join_item_product'] = $("#join-item-product-grid").jqxGrid('getrows');
        
        $this->db->where('id_join_item', $data['id_join_item']);
        $this->db->update('join_item', $data_input);
        
        $this->delete_join_item_product($data['id_join_item']);
        $this->insert_join_item_product($data['id_join_item'], $data['join_item_product']);
        
        $this->db->trans_complete();
    }
    
    public function delete_join_item_product($id)
    {
        $this->db->where('join_item', $id);
        $this->db->delete('join_item_product');
    }
    
    public function get_join_item_by_id($id)
    {
   	    $this->db->select('join_item.*, join_item.status as status_join, product.*, bom.*, bom.name as bom_name, bom.status as bom_status');
		$this->db->from('join_item');
        $this->db->join('bom', 'bom.id_bom=join_item.bom', 'INNER');
        $this->db->join('product', 'bom.product=product.id_product', 'INNER');
  
        $this->db->where('id_join_item', $id);
        
		return $this->db->get()->result_array();
    }
    
    
    
    public function transfer_join_item($id)
    {
        $ji = $this->get_join_item_by_id($id);
        $ci =& get_instance();
        $ci->load->model('stock_transaction_model');
        
        $ci2 =& get_instance();
        $ci2->load->model('gudang_model');
        
        $ji_product = $this->get_join_item_product_by_id($id);
        
        $vloc = $ci2->gudang_model->get_virtual_location();
        
        if($ji[0]['activity'] == 'join')
        {
            $ci->stock_transaction_model->insert_stock_transaction($ji[0]['join_item_number'], $ji[0]['product'], $ji[0]['unit'], $ji[0]['qty'],'join_item', $ji[0]['date'], $vloc[0]['id_warehouse'], $ji[0]['gudang']); 
            foreach($ji_product as $jip)
            {
                $ci->stock_transaction_model->insert_stock_transaction($ji[0]['join_item_number'], $jip['product'], $jip['unit'], $jip['qty_transfer'],'join_item', $ji[0]['date'], $jip['gudang'], $vloc[0]['id_warehouse']);
            }    
        }
        else
        {
            $ci->stock_transaction_model->insert_stock_transaction($ji[0]['join_item_number'], $ji[0]['product'], $ji[0]['unit'], $ji[0]['qty'],'join_item', $ji[0]['date'], $ji[0]['gudang'], $vloc[0]['id_warehouse']); 
            foreach($ji_product as $jip)
            {
                $ci->stock_transaction_model->insert_stock_transaction($ji[0]['join_item_number'], $jip['product'], $jip['unit'], $jip['qty_transfer'],'join_item', $ji[0]['date'], $vloc[0]['id_warehouse'], $jip['gudang']);
            }
        }
        
        $this->change_join_item_status($id, 'transfer');
    }
    
    public function change_join_item_status($id, $status)
    {
        $this->db->where('id_join_item', $id);
        $this->db->update('join_item', array("status" => $status));
    }
    
    public function get_join_item_product_by_id($id)
    {
        $this->db->select('jip.*, p.*, um.name as unit_name, g.name as warehouse_name, g.id_warehouse as warehouse');
		$this->db->from('join_item_product as jip');
        $this->db->join('product as p', 'p.id_product=jip.product', 'INNER');
        $this->db->join('unit_measure as um', 'um.id_unit_measure=p.unit', 'INNER');
        $this->db->join('gudang as g', 'g.id_warehouse=jip.gudang', 'INNER');
        $this->db->where('jip.join_item', $id);
  
		return $this->db->get()->result_array();
    }
    
    public function generate_join_item_number($id, $table, $prefix, $date_col, $id_string, $doc_number_col)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('YEAR('. $date_col .')', date('Y'));
        $this->db->where($id_string, $id);
        
        $result = $this->db->get()->result_array();
        $countResult = $result[0][$id_string];
        $zeroCount = '';
        
        for($i=0; $i<4 - strlen($countResult);$i++)
        {
            $zeroCount .= '0';
        }
        
        $doc_number ($prefix . date('y') . $zeroCount . $countResult);
        
        $this->db->where($id_string, $id);
        $this->db->update($table, array($doc_number_col => $doc_number));
    }
}