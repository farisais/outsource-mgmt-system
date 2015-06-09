<?php
class Idr_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_idr_all()
	{
        $this->db->select('internal_delivery_return.*, so.so_number');
	$this->db->from('internal_delivery_return');
        $this->db->join('so', 'so.id_so=internal_delivery_return.so', 'LEFT');
                
		return $this->db->get()->result_array();
	}
    public function add_idr($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "so" => ($data['so'] == '' ? null : $data['so']),
            "date" => $data['date'],
            "note" => $data['note'],
            "from" => $data['from'],
            "to" => $data['to'],
            "status" => 'draft',
            "idr_number" => $this->generate_idr_number()
            
        );
        
        $this->db->insert('internal_delivery_return', $data_input);
        $id_idr = $this->db->insert_id();
        
        $this->add_idr_product($id_idr, $data['product_detail']);
            
        
        
        $this->db->trans_complete();
    }
    
    public function add_idr_product($id_idr, $data_product)
    {
        foreach($data_product as $p)
        {
            $data_input = array();
            $data_input['internal_delivery_return'] = $id_idr;
            $data_input['product'] = $p['id_product'];
            $data_input['uom'] = $p['unit'];
            $data_input['qty'] = $p['qty'];
            $data_input['source_location'] = $p['source_location'];
                        
            $this->db->insert('internal_delivery_return_product', $data_input);
        }
    }
    
    public function generate_idr_number()
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
        
        return ("IDR" . date('y') . $zeroCount . $countResult);
    }
    
    public function delete_idr_product($id)
    {
        $this->db->trans_start();
        $this->db->where('internal_delivery_return', $id);
        $this->db->delete('internal_delivery_return_product');
    }
    
    public function edit_idr($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "so" => ($data['so'] == '' ? null : $data['so']),
            "date" => $data['date'],
            "note" => $data['note'],
            "from" => $data['from'],
            "to" => $data['to'],
            "status" => 'draft',
        );
        
        $this->db->where('id_internal_delivery_return', $data['id_internal_delivery_return']);
        $this->db->update('internal_delivery_return', $data_input);
        
        $this->delete_idr_product($data['id_internal_delivery_return']);
        $this->add_idr_product($data['id_internal_delivery_return'], $data['product_detail']);
        
        $return_id = $data['id_internal_delivery_return'];
        
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function delete_idr($id)
    {
        $this->db->trans_start();
        $this->delete_product_idr($id);
        $this->db->where('id_internal_delivery_return', $id);
        
        $this->db->delete('internal_delivery_return');
        
        
        $this->db->trans_complete();
    }
    
        
    public function change_idr_status($id, $status)
    {
        $this->db->trans_start();
        
        $this->db->where('id_internal_delivery_return', $id);
        $this->db->update('internal_delivery_return', array('status' => $status));
        
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
    
            
        public function get_idr_history($id_so, $exclude_id = null)
    {
        $idr = null;
        if($exclude_id !=null)
        {
            $idr = $this->get_idr_by_id($exclude_id);
        }
        
        $this->db->select('internal_delivery_return.*, project_list.*, so.*, internal_delivery.*');
        $this->db->from('internal_delivery_return');
        $this->db->join('so','so.id_so=internal_delivery_return.so', 'LEFT');
        $this->db->join('project_list', 'project_list.so=so.id_so', 'INNER');
        $this->db->join('internal_delivery', 'internal_delivery.project_list=project_list.id_project_list', 'LEFT');
        $this->db->where('internal_delivery_return.so', $id_so);
        $this->db->where('internal_delivery.status', 'open');
        if($exclude_id !=null)
        {
            $this->db->where('internal_delivery_return.id_internal_delivery_return !=', $exclude_id);
            
            $this->db->where('DATE(internal_delivery_return.date) <= DATE(\''. $idr[0]['date'] . '\')', null, false );
            $this->db->where('internal_delivery_return.id_interal_delivery_return <', $idr[0]['id_internal_delivery_return']);
        }
                
		return $this->db->get()->result_array();
    }
    
    public function get_project_list_history($id_so)
    {
        $query = 'select idp.*, p.*, um.name as unit_name from internal_delivery_product as idp inner join product as p on p.id_product=idp.product
                    inner join unit_measure as um on um.id_unit_measure = idp.uom 
                    inner join internal_delivery as id on id.id_internal_delivery=idp.internal_delivery
                    where idp.so = '. $id_so . ' and id.status=\'open\'';
                    
        $result = $this->db->query($query)->result_array();
        
        return $result;
        
    }
    
    public function delete_product_idr($id)
    {
        $this->db->trans_start();
        $this->db->where('internal_delivery_return', $id);
        $this->db->delete('internal_delivery_return_product');
    }
    
    
    public function get_idr_by_id($id)
    {
        $this->db->select('internal_delivery_return.*, so.so_number');
		$this->db->from('internal_delivery_return');
                $this->db->join('so', 'so.id_so=internal_delivery_return.so', 'INNER');
        $this->db->where('id_internal_delivery_return', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function get_idr_product_by_id($id)
    {
        $this->db->select('internal_delivery_return_product.*, gudang.name AS warehouse_name, product_category.product_category AS category_name , unit_measure.name as unit_name, product.*');
        $this->db->from('internal_delivery_return_product');
        $this->db->join('product', 'internal_delivery_return_product.product=product.id_product', 'INNER');
        $this->db->join('gudang', 'gudang.id_warehouse=internal_delivery_return_product.source_location', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=internal_delivery_return_product.uom', 'INNER');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
        $this->db->where('internal_delivery_return', $id);
        
        return $this->db->get()->result_array();
    }
    
    //==========================================================================================
    
}