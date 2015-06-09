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
    
    public function delete_bom($id)
    {
        $this->delete_bom_product($id);
        $this->db->trans_start();
        $this->db->where('id_bom', $id);
        $this->db->delete('bom');
        $this->db->trans_complete();
    }
    
    
    public function delete_bom_product($bom)
    {
        $this->db->where('bom', $bom);
        $this->db->delete('detail_bom');
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
        $this->db->select('detail_bom.*, product.* , um.*, um.name as unit_name');
        $this->db->from('detail_bom');
        $this->db->join('product', 'detail_bom.product=product.id_product', 'INNER');
        $this->db->join('unit_measure as um', 'detail_bom.uom=um.id_unit_measure', 'INNER');
        
        $this->db->where('bom', $id);
  
	return $this->db->get()->result_array();
    }
    
    public function get_bom_template_product_from_so($id_so)
    {
        $ci =& get_instance();
        $ci->load->model('material_valuation_model');
        
        $query = 'select sfp.*,p.*,bt.*,p2.product_code as dbom_prod_code,p2.product_name as dbom_prod_name,p2.unit as dbom_default_uom, um.name as dbom_uom_name, sum(if(sfp.uom=p.unit,if(p2.unit=dbom_uom,qty*dbom_prod_qty,
                    qty*dbom_prod_qty*
                    	(
                    		select if(uc.unit_measure_from = dbom_uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = dbom_uom and uc.unit_measure_to = p2.unit) or (uc.unit_measure_to = dbom_uom and uc.unit_measure_from = p2.unit)
                    	)
                    ),if(p2.unit=dbom_uom,qty*dbom_prod_qty*
                    	(
                    		select if(uc.unit_measure_from = sfp.uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = sfp.uom and uc.unit_measure_to = p.unit) or (uc.unit_measure_to = sfp.uom and uc.unit_measure_from = p.unit)
                    	),
                    qty*dbom_prod_qty*
                    	(
                    		select if(uc.unit_measure_from = dbom_uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = dbom_uom and uc.unit_measure_to = p2.unit) or (uc.unit_measure_to = dbom_uom and uc.unit_measure_from = p2.unit)
                    	)*
                    	(
                    		select if(uc.unit_measure_from = sfp.uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = sfp.uom and uc.unit_measure_to = p.unit) or (uc.unit_measure_to = sfp.uom and uc.unit_measure_from = p.unit)
                    	)
                    ))) as total_req 
                    from so_finish_product as sfp 
                    inner join (
                    	select b.product as bom_prod, db.product as dbom_prod, db.qty as dbom_prod_qty, db.uom as dbom_uom 
                    from bom as b
                    inner join detail_bom as db on db.bom=b.id_bom where b.status = \'active\'
                    ) as bt on bt.bom_prod=sfp.product 
                    inner join product as p on p.id_product=sfp.product
                    inner join product as p2 on p2.id_product=bt.dbom_prod
                    inner join unit_measure as um on um.id_unit_measure=dbom_uom
                    where sfp.so = '. $id_so .'
                    group by dbom_prod';
        $result_query = $this->db->query($query);
        $pl_product = $result_query->result_array();
        
        for($i=0;$i<count($pl_product);$i++)
        {
            $pl_product[$i]['unit_cogs'] = 0;
            $pl_product[$i]['total_cogs'] = 0;
            if($pl_product[$i]['is_material_valuation'] == 1)
            {
                $product_valuation = $ci->material_valuation_model->get_material_valuation_by_prod($pl_product[$i]['id_product']);
                if(count($product_valuation) > 0)
                {
                    $pl_product[$i]['unit_cogs'] = $product_valuation[0]['valuation'];
                    $pl_product[$i]['total_cogs'] = $pl_product[$i]['total_req'] * $product_valuation[0]['valuation'];
                }
            }
            else
            {
                $pl_product[$i]['unit_cogs'] = $pl_product[$i]['cost_price'];
                $pl_product[$i]['total_cogs'] = $pl_product[$i]['total_req'] * $pl_product[$i]['cost_price'];
            }
            
        }
        
        return $pl_product;
    }
}