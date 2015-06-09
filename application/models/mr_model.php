<?php
class Mr_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_mr_all()
	{
        $this->db->select('mr.*, work_order.work_order_number');
	    $this->db->from('mr');
        $this->db->join('work_order', 'work_order.id_work_order=mr.work_order', 'LEFT');
                
		return $this->db->get()->result_array();
	}
        
        public function get_mr_open()
	{
        $this->db->select('mr.*, work_order.work_order_number');
        $this->db->from('mr');
        $this->db->join('work_order', 'work_order.id_work_order=mr.work_order', 'LEFT');
        
        $this->db->where('mr.status =', 'open');
                
		return $this->db->get()->result_array();
	}
        
    public function add_mr($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "work_order" => ($data['work_order'] == '' ? null : $data['work_order']),
            "date" => $data['date'],
            "mr_number" => $this->generate_mr_number(),
            "status" => 'draft'
        );
        
        $this->db->insert('mr', $data_input);
        $id_mr = $this->db->insert_id();
        
        $this->add_mr_product($id_mr, $data['product_detail']);
            
        //=====================
        
        
        $this->db->trans_complete();
    }
    
    public function add_mr_product($id_mr, $data_product)
    {
        foreach($data_product as $p)
        {
            $data_input = array();
            $data_input['mr'] = $id_mr;
            $data_input['product'] = $p['id_product'];
            $data_input['qty_request'] = $p['qty_request'];
            $data_input['qty_require'] = $p['qty_require'];
            $data_input['uom'] = $p['unit'];
            $this->db->insert('mr_product', $data_input);
        }
    }
    
    public function validate_mr($id)
    {
        $this->db->where('id_mr', $id);
        $this->db->update('mr', array('status' => 'open'));
        
        return array('id_mr' => $id, 'status' => 'open');
    }
    
    public function change_mr_status($id, $status)
    {
        $this->db->trans_start();
        
        $this->db->where('id_mr', $id);
        $this->db->update('mr', array("status" => $status));        
                        
        $this->db->trans_complete();                
            
    }        
    
    public function generate_mr_number()
    {
        $this->db->select('*');
        $this->db->from('mr');
        $this->db->where('YEAR(date)', date('Y'));
        
        $result = $this->db->get()->result_array();
        $countResult = count($result) + 1;
        $zeroCount = '';
        
        for($i=0; $i<4 - strlen($countResult);$i++)
        {
            $zeroCount .= '0';
        }
        
        return ("MR" . date('y') . $zeroCount . $countResult);
    }
    
    public function edit_mr($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "project_list" => ($data['work_order'] == '' ? null : $data['work_order']),
            "date" => $data['date'],
            "mr_number" => $data['mr_number'],
        );
        $this->add_mr_product($id_mr, $data['product_detail']);
        $this->db->where('id_mr', $data['id_mr']);
        $this->db->update('mr', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_mr($id)
    {
        $this->db->trans_start();
        
        $this->delete_mr_product($id);
        $this->db->where('id_mr', $id);
        
        $this->db->delete('mr');
        
        $this->db->trans_complete();
    }
    
    public function delete_mr_product($id)
    {
        $this->db->trans_start();
        $this->db->where('mr', $id);
        
        $this->db->delete('mr_product');
        
        $this->db->trans_complete();
    }
    
    public function get_mr_by_id($id)
    {
        $this->db->select('mr.*, work_order.work_order_number');
	    $this->db->from('mr');
        $this->db->join('work_order', 'work_order.id_work_order=mr.work_order', 'LEFT');
                
        $this->db->where('mr.id_mr', $id);
                
		return $this->db->get()->result_array();
    }
	
	public function get_mr_product_from_wo($wo)
	{
		$this->db->select('mr_product.*, product.*, unit_measure.name AS unit_name, product_category.product_category AS category_name, mr.*');
        $this->db->from('mr_product');
		$this->db->join('mr', 'mr.id_mr=mr_product.mr', 'INNER');
        $this->db->join('product', 'mr_product.product=product.id_product', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=product.unit', 'LEFT');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
        $this->db->where('mr.work_order', $wo);
        
        return $this->db->get()->result_array();
	}
    
    public function get_mr_product_by_id_mr($id_mr)
    {
        $this->db->select('mr_product.*, product.*, unit_measure.name AS unit_name, product_category.product_category AS category_name');
        $this->db->from('mr_product');
        $this->db->join('product', 'mr_product.product=product.id_product', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=product.unit', 'LEFT');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
        $this->db->where('mr_product.mr', $id_mr);
        
        return $this->db->get()->result_array();
    }
    
    public function get_mr_product_open_by_id_mr($id_mr)
    {
        $this->db->select('mr_product.*, mr_product.qty_require AS qty , product.*, unit_measure.name AS unit_name, product_category.product_category AS category_name, m.name');
        $this->db->from('mr_product');
        $this->db->join('product', 'mr_product.product=product.id_product', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=product.unit', 'LEFT');
        $this->db->join('merk as m', 'm.id_merk=product.merk', 'LEFT');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
        $this->db->where('mr_product.mr', $id_mr);
        
		
        $result = $this->db->get()->result_array();
        
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['unit_price'] = 0;
        }
        return $result;
        
        
    }
    
    public function get_mr_product_open_po($id_mr)
    {
        $query = 'select pp.* from po_product as pp inner join po on po.id_po=pp.po inner join mr on mr.id_mr=po.mr where mr.id_mr=' . $id_mr;
        $check_po = $this->db->query($query);
        
        $check_po = $check_po->result_array();
        
        $this->db->select('mr_product.*, mr_product.qty_request AS qty , product.*, unit_measure.name AS unit_name, product_category.product_category AS category_name, m.name');
        $this->db->from('mr_product');
        $this->db->join('product', 'mr_product.product=product.id_product', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=product.unit', 'LEFT');
        $this->db->join('merk as m', 'm.id_merk=product.merk', 'LEFT');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
        if(count($check_po) > 0)
        {
            $this->db->join('po', 'po.mr=mr_product.mr', 'INNER');
            $this->db->join('po_product as pp', 'pp.po=po.id_po', 'INNER');
            $this->db->where('pp.product != mr_product.product');
        }

        
        $this->db->where('mr_product.mr', $id_mr);
        
        $result = $this->db->get()->result_array();
        
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['unit_price'] = 0;
        }
        return $result;
    }
    
    //==========================================================================================
    
}