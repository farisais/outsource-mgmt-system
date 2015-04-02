<?php
class Id_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_id_all()
	{
        $this->db->select('internal_delivery.*, project_list.project_list_number');
	$this->db->from('internal_delivery');
        $this->db->join('project_list', 'project_list.project_list_number=internal_delivery.project_list', 'LEFT');
                
		return $this->db->get()->result_array();
	}
    public function add_id($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "project_list" => ($data['project_list'] == '' ? null : $data['project_list']),
            "date" => $data['date'],
            "note" => $data['note'],
            "from" => $data['from'],
            "to" => $data['to'],
            "status" => 'draft',
            "id_number" => $this->generate_id_number()
            
        );
        
        $this->db->insert('internal_delivery', $data_input);
        $id_id = $this->db->insert_id();
        
        $this->add_id_product($id_id, $data['product_detail']);
            
        
        
        $this->db->trans_complete();
    }
    
    public function add_id_product($id_id, $data_product)
    {
        foreach($data_product as $p)
        {
            $data_input = array();
            $data_input['internal_delivery'] = $id_id;
            $data_input['product'] = $p['product'];
            $data_input['uom'] = $p['uom'];
            $data_input['qty'] = $p['qty'];
            $data_input['source_location'] = $p['source_location'];
                        
            $this->db->insert('internal_delivery_product', $data_input);
        }
    }
    
    public function generate_id_number()
    {
        $this->db->select('*');
        $this->db->from('internal_delivery');
        $this->db->where('YEAR(date)', date('Y'));
        
        $result = $this->db->get()->result_array();
        $countResult = count($result) + 1;
        $zeroCount = '';
        
        for($i=0; $i<4 - strlen($countResult);$i++)
        {
            $zeroCount .= '0';
        }
        
        return ("ID" . date('y') . $zeroCount . $countResult);
    }
    
    public function edit_id($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "project_list" => ($data['project_list'] == '' ? null : $data['project_list']),
            "date" => $data['date'],
            "note" => $data['note'],
            "from" => $data['from'],
            "to" => $data['to'],
            "status" => 'draft',
        );
        
        $id_id = $data['id_internal_delivery'];
        $this->add_id_product($id_id, $data['product_detail']);
        $this->db->where('id_internal_delivery', $data['id_internal_delivery']);
        $this->db->update('internal_delivery', $data_input);
        
        
        $this->db->trans_complete();
    }
    
    public function delete_id($id)
    {
        $this->db->trans_start();
        $this->delete_product_id($id);
        $this->db->where('id_internal_delivery', $id);
        
        $this->db->delete('internal_delivery');
        
        
        $this->db->trans_complete();
    }
    
    public function change_id_status($id, $status)
    {
        $this->db->trans_start();
        
        $this->db->where('id_internal_delivery', $id);
        $this->db->update('internal_delivery', array('status' => $status));
        
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
    
    
    public function delete_product_id($id)
    {
        $this->db->trans_start();
        $this->db->where('id_internal_delivery', $id);
        $this->db->delete('internal_delivery_product');
    }
    
    public function get_id_by_id($id)
    {
        $this->db->select('internal_delivery.*');
		$this->db->from('internal_delivery');
        $this->db->where('id_internal_delivery', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function get_id_product_by_id($id)
    {
        $this->db->select('internal_delivery_product.*, gudang.name AS warehouse_name, product_category.product_category AS category_name , unit_measure.name as unit_name, product.*');
        $this->db->from('internal_delivery_product');
        $this->db->join('product', 'internal_delivery_product.product=product.id_product', 'INNER');
        $this->db->join('gudang', 'gudang.id_warehouse=internal_delivery_product.source_location', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=internal_delivery_product.uom', 'INNER');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
        $this->db->where('internal_delivery', $id);
        
        return $this->db->get()->result_array();
    }
    
    //==========================================================================================
    
}