<?php
class Po_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_po_all()
	{
		$this->db->select('po.*, ext_company.name AS supplier_name, mr.id_mr, mr.mr_number');
		$this->db->from('po');
        $this->db->join('ext_company', 'po.supplier=ext_company.id_ext_company', 'INNER');
		$this->db->join('mr', 'mr.id_mr=po.mr', 'LEFT');
		return $this->db->get()->result_array();
	}
    
    public function get_po_open()
    {
        $this->db->select('po.*, ext_company.name AS supplier_name');
		$this->db->from('po');
        $this->db->join('ext_company', 'po.supplier=ext_company.id_ext_company', 'INNER');
        
        $this->db->where('status !=', 'draft');
        $this->db->where('status !=', 'close');
                
		return $this->db->get()->result_array();
    }
    
    public function save_po()
    {
        $this->db->trans_start();
        $data_post = $this->input->post();
        $data = array(
            'po_number' => $this->generate_po_number(),
            'supplier' => $data_post['supplier'],
            'note' => $data_post['note'],
            'date' => $data_post['date'],
            'delivery_date' => $data_post['delivery_date'],
            'supplier' => $data_post['supplier'],
            'status' => ($data_post['is_edit'] == 'false' ? 'draft' : 'open'),
            'mr' => (!isset($data_post['mr']) || $data_post['mr'] == '' || $data_post['mr'] == null ? null : $data_post['mr']),
            'user_create' => $this->session->userdata('app_userid'),
            'date_create' => date('Y-m-d H:i:s'),
            'source' => (!isset($data_post['mr']) || $data_post['mr'] == '' ||  $data_post['mr'] == null ? 'make_stock' : 'mr'),
            'total_price' => $data_post['total_price'],
            'tax' => $data_post['tax'],
            'sub_total' => $data_post['sub_total'],
            'discount_type' => $data_post['discount_type'],
            'discount_value' => $data_post['discount_value']
        );
        
        $this->db->insert('po', $data);
        $last_id = $this->db->insert_id();
        
        $this->add_po_product($last_id, $data_post['product_detail']);
        $this->db->trans_complete();
        
        $data_post['id_po'] = $last_id;
        $data_post['po_number'] = $data['po_number'];
        
        return $data_post;
    }
    
    public function edit_po($data_post)
    {
        $this->db->trans_start();
        
        $data = array(
            'po_number' => $data_post['po_number'],
            'supplier' => $data_post['supplier'],
            'note' => $data_post['note'],
            'date' => $data_post['date'],
            'delivery_date' => $data_post['delivery_date'],
            'supplier' => $data_post['supplier'],
            'status' => 'draft',
            'mr' => (!isset($data_post['mr']) || $data_post['mr'] == '' || $data_post['mr'] == null ? null : $data_post['mr']),
            'user_create' => $this->session->userdata('app_userid'),
            'date_create' => date('Y-m-d H:i:s'),
            'source' => (!isset($data_post['mr']) || $data_post['mr'] == '' ||  $data_post['mr'] == null ? 'make_stock' : 'mr'),
            'total_price' => $data_post['total_price'],
            'tax' => $data_post['tax'],
            'sub_total' => $data_post['sub_total'],
            'discount_type' => $data_post['discount_type'],
            'discount_value' => $data_post['discount_value']
        );
        
        $this->db->where('id_po', $data_post['id_po']);
        $this->db->update('po', $data);
        $last_id = $data_post['id_po'];
        
        $this->delete_po_product($last_id);
        $this->add_po_product($last_id, $data_post['product_detail']);
        
        $this->db->trans_complete();
        
        array_merge($data_post, array("id_po" => $last_id, "po_number" => $data['po_number']));
        return $data_post;
    }
    
    public function add_po_product($id, $data_product)
    {
        foreach($data_product as $p)
        {
             $data = array(
                'po' => $id,
                'product' => $p['id_product'],
                'qty' => $p['qty'],
                'uom' => $p['unit'],
                'unit_price' => $p['unit_price'],
                'total_price' => ($p['unit_price'] * $p['qty']),
                'product_barcode' => $this->generate_barcode_number($id, $p['id_product'])
            );
            
            $this->db->insert('po_product', $data);
        }
    }
    
    public function generate_po_number()
    {
        $this->db->select('*');
        $this->db->from('po');
        $this->db->where('YEAR(date)', date('Y'));
        
        $result = $this->db->get()->result_array();
        $countResult = count($result) + 1;
        $zeroCount = '';
        
        for($i=0; $i<4 - strlen($countResult);$i++)
        {
            $zeroCount .= '0';
        }
        
        return ("PO" . date('y') . $zeroCount . $countResult);
    }
    
    public function validate_po($id)
    {
        $this->db->where('id_po', $id);
        $this->db->update('po', array('status' => 'open'));
        
        return array('id_po' => $id, 'status' => 'open');
    }
    
    public function get_po_history($id_mr, $exclude_id = null)
    {
        $po = null;
        if($exclude_id !=null)
        {
            $po = $this->get_po_by_id($exclude_id);
        }
        
        $this->db->select('po.*, mr.mr_number, pp.*,p.*, um.name as unit_name');
		$this->db->from('po');
        $this->db->join('mr', 'mr.id_mr=po.mr', 'LEFT');
        $this->db->join('po_product as pp', 'pp.po=po.id_po', 'INNER');
        $this->db->join('product as p', 'p.id_product=pp.product', 'INNER');
        $this->db->join('unit_measure as um', 'um.id_unit_measure=pp.uom', 'INNER');
        $this->db->join('ext_company as s', 's.id_ext_company=po.supplier', 'INNER');
        $this->db->where('po.mr', $id_mr);
        $this->db->where('po.status', 'open');
        if($exclude_id !=null)
        {
            $this->db->where('po.id_po !=', $exclude_id);
            
            $this->db->where('DATE(po.date) <= DATE(\''. $po[0]['date'] . '\')', null, false );
            $this->db->where('po.id_po <', $po[0]['id_po']);
        }
                
		return $this->db->get()->result_array();
    }
    
    
    public function get_po_by_id($id)
    {
        $this->db->select('po.*, ext_company.name as supplier_name, ext_company.address, mr.id_mr, mr.mr_number,mr.date as mr_date, mr.status as mr_status');
        $this->db->from('po');
        $this->db->where('po.id_po', $id);
		$this->db->join('mr', 'mr.id_mr=po.mr', 'LEFT');
        $this->db->join('ext_company', 'ext_company.id_ext_company=po.supplier', 'INNER');
        return $this->db->get()->result_array();
    }
    
    public function get_po_product_by_id($id)
    {
        $this->db->select('po_product.*, po_product.uom as unit, unit_measure.name as unit_name, product.*');
        $this->db->from('po_product');
        $this->db->join('product', 'product.id_product=po_product.product', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=po_product.uom', 'INNER');
        $this->db->where('po', $id);
        
        $result = $this->db->get()->result_array();
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['qty_ordered'] = $result[$i]['qty'] - $result[$i]['qty_received'];
        }
        return $result;
    }
	
	public function get_po_product_by_id_received($id)
    {
        $this->db->select('po_product.*, po_product.uom as unit, unit_measure.name as unit_name, product.*');
        $this->db->from('po_product');
        $this->db->join('product', 'product.id_product=po_product.product', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=po_product.uom', 'INNER');
        $this->db->where('po', $id);
        
        $result = $this->db->get()->result_array();
		$return = array();
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['qty_ordered'] = $result[$i]['qty'] - $result[$i]['qty_received'];
			if($result[$i]['qty_ordered'] > 0)
			{
				array_push($return, $result[$i]);
			}
        }
        return $return;
    }
    
    public function get_barcode_list()
    {
        $this->db->select('po_product.*, po_product.uom as unit, unit_measure.name as unit_name, product.*, po.*');
        $this->db->from('po_product');
        $this->db->join('product', 'product.id_product=po_product.product', 'INNER');
        $this->db->join('po', 'po.id_po=po_product.po', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=po_product.uom', 'INNER');
        $this->db->where('po_product.product_barcode is not NULL');
        $this->db->where('po_product.product_barcode <> \'\'');
        $result = $this->db->get()->result_array();
        return $result;
    }
    
    public function change_po_status($id, $status)
    {
        $this->db->trans_start();
        $this->db->where('id_po', $id);
        $this->db->update('po', array("status" => $status));
        
        $this->db->trans_complete();
        
    }
    
    public function update_product_qty_received($id_po, $id_product, $qty_received)
    {
        $this->db->trans_start();
        
        $this->db->query("UPDATE po_product SET qty_received = qty_received + " . $qty_received . " WHERE po='". $id_po ."' AND product = '". $id_product ."'");

        $this->db->trans_complete();
    }
    
    public function generate_barcode_number($id_po, $id_product)
    {
        $po_barcode = $id_po;
        for($i=0;$i<4-strlen($id_po);$i++)
        {
            $po_barcode = '0' . $po_barcode;
        }
        
        $product_barcode = $id_product;
        for($i=0;$i<4 - strlen($id_product);$i++)
        {
            $product_barcode = '0' . $product_barcode;
        }
        
        $barcode_number = $product_barcode . $po_barcode;
        
        return $barcode_number;
//        
//        $data = array();
//        $data['product'] = $id_product;
//        $data['po'] = $id_po;
//        $data['product_barcode'] = $barcode_number;
//        
//        if(count($this->get_product_from_barcode($barcode_number)) == 0)
//        {
//            $this->db->trans_start();
//            $this->db->insert('product_po_barcode', $data);
//            $this->db->trans_complete();
//        }
    }
    
    public function get_product_from_barcode($barcode)
    {
        if($barcode == '' || $barcode == null)
        {
            $barcode = -1;
        }
        $this->db->select('p.*,pc.product_category as category, um.name as unit_name_product, tm.type_material, po.*, pp.*, um2.name as unit_name, merk.name as merk_name');
        $this->db->from('po_product as pp');
        $this->db->join('product as p', 'p.id_product=pp.product', 'INNER');
        $this->db->join('product_category as pc', 'pc.id_product_category=p.product_category', 'INNER');
        $this->db->join('unit_measure as um', 'um.id_unit_measure=p.unit', 'INNER');
        $this->db->join('merk', 'merk.id_merk=p.merk', 'INNER');
        $this->db->join('type_material as tm', 'tm.id_type_material=p.type', 'LEFT');
        $this->db->join('po', 'po.id_po=pp.po', 'INNER');
        $this->db->join('unit_measure as um2', 'um2.id_unit_measure=pp.uom', 'INNER');
        $this->db->where('pp.product_barcode', $barcode);
        
        return $this->db->get()->result_array();
    }
    
    public function check_po_product_receive($id)
    {
        $this->db->select('*');
        $this->db->from('po_product');
        $this->db->where('po', $id);
        
        $pp = $this->db->get()->result_array();
        
        foreach($pp as $p)
        {
            if($p['qty_received'] != $p['qty'])
            {
                return false;
            }
        }
        
        return true;
    }
}