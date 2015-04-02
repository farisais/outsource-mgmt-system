<?php
class Gr_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_gr_all()
	{
		$this->db->select('gr.*, po.po_number');
		$this->db->from('gr');
        $this->db->join('po', 'po.id_po=gr.po', 'LEFT');
                
		return $this->db->get()->result_array();
	}
    
    public function save_gr($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "po" => $data['id_po'],
            "date" => $data['date'],
            "do" => $data['do'],
            "gr_number" => $this->generate_gr_number(),
            "status" => 'open',
        );
        
        $this->db->insert('gr', $data_input);
        $gr_id = $this->db->insert_id();
        $this->insert_gr_product($gr_id, $data['product_detail'], $data['id_po']);
        $this->db->trans_complete();
    }
    
    public function generate_gr_number()
    {
        $this->db->select('*');
        $this->db->from('gr');
        $this->db->where('YEAR(date)', date('Y'));
        
        $result = $this->db->get()->result_array();
        $countResult = count($result) + 1;
        $zeroCount = '';
        
        for($i=0; $i<4 - strlen($countResult);$i++)
        {
            $zeroCount .= '0';
        }
        
        return ("GR" . date('y') . $zeroCount . $countResult);
    }
    
    public function delete_gr($id)
    {
        $this->db->trans_start();
        $this->db->where('id_product', $id);
        $this->db->delete('product');
        $this->db->trans_complete();
    }
    
    public function get_gr_by_id($id)
    {
        $this->db->select('gr.*, po.po_number');
		$this->db->from('gr');
        $this->db->join('po', 'gr.po=po.id_po', 'LEFT');
        
        $this->db->where('gr.id_gr', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function edit_gr($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "product_code" => $data['product_code'],
            "product_name" => $data['product_name'],
            "unit" => $data['unit'],
            "product_category" => $data['product_category'],
            "merk" => $data['merk'],
            "description" => $data['description'],
            "is_service" => ($data['is_service'] == true ? 1 : 0),
            "is_active" => ($data['is_active'] == true ? 1 : 0)
        );
        
        $this->db->where('id_product', $data['id_product']);
        $this->db->update('product', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function insert_gr_product($id, $data_product, $id_po)
    {
        $ci =& get_instance();
        $ci->load->model('po_model');
        $po_complete = true;
        foreach($data_product as $p)
        {
             $data = array(
                'gr' => $id,
                'product' => $p['id_product'],
                'qty' => $p['qty_received'],
                'uom' => $p['unit'],
                'source_location' => $p['warehouse']
            );
            
            $this->db->insert('gr_product', $data);
            
            if($p['qty_received'] != $p['qty_ordered'])
            {
                $po_complete == false;
            }
            
            $ci->po_model->update_product_qty_received($id_po, $p['id_product'], $p['qty_received']);
            //$ci->po_model->generate_barcode_number($id_po, $p['id_product']);
        }
        
        if($po_complete == true)
        {
            $po = $ci->po_model->get_po_by_id($id_po);
            if($po[0]['status'] == 'open' )
            {
                 $ci->po_model->change_po_status($id_po, 'good_received');
            }
            else if($po[0]['status'] == 'good_received')
            {
                 $ci->po_model->change_po_status($id_po, 'close');
            }
            else if($po[0]['status'] == 'payment_received')
            {
                 $ci->po_model->change_po_status($id_po, 'close');
            }
           
        }
    }
    
    public function get_gr_product_by_id($id)
    {
        $ci =& get_instance();
        $ci->load->model('po_model');
        
        $this->db->select('gr_product.*, gr_product.source_location as warehouse,gudang.*, gr_product.qty AS qty_received, gr_product.uom as unit, unit_measure.name as unit_name, product.*');
        $this->db->from('gr_product');
        $this->db->join('product', 'product.id_product=gr_product.product', 'INNER');
        $this->db->join('gudang', 'gudang.id_warehouse=gr_product.source_location', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=gr_product.uom', 'INNER');
        $this->db->where('gr', $id);
        
        $result = $this->db->get()->result_array();
        
        for($i=0;$i<count($result);$i++)
        {
            $po_product = $ci->po_model->get_po_product_by_id($this->get_id_po_from_gr($id)[0]['po']);
            
            for($j=0;$j<count($po_product);$j++)
            {
                if($po_product[$j]['product'] == $result[$i]['product'])
                {
                    $result[$i]['qty_ordered'] = $po_product[$j]['qty'];
                }
            }
        }
        return $result;
    }
    public function get_gr_history($po, $gr = null)
    {
        $ci =& get_instance();
        $ci->load->model('po_model');
        
        $gr_array = null;
        if($gr !=null)
        {
            $gr_array = $this->get_gr_by_id($gr);
        }
        
        $this->db->select('gr_product.*, gr.date as gr_date,gr.gr_number,gr_product.source_location as warehouse,gudang.*, gr_product.qty AS qty_received, gr_product.uom as unit, unit_measure.name as unit_name, product.*');
        $this->db->from('gr_product');
        $this->db->join('gr', 'gr.id_gr=gr_product.gr', 'INNER');
        $this->db->join('product', 'product.id_product=gr_product.product', 'INNER');
        $this->db->join('gudang', 'gudang.id_warehouse=gr_product.source_location', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=gr_product.uom', 'INNER');
        $this->db->where('po', $po);
        
        
        if($gr != null)
        {
            $this->db->where('gr_product.gr !=', $gr);
            $this->db->where('DATE(date) <= DATE(\''. $gr_array[0]['date'] . '\')', null, false );
            $this->db->where('gr_product.gr <', $gr_array[0]['id_gr']);
        }
        
        $result = $this->db->get()->result_array();
        
        for($i=0;$i<count($result);$i++)
        {
            $po_product = $ci->po_model->get_po_product_by_id($po);
            
            for($j=0;$j<count($po_product);$j++)
            {
                if($po_product[$j]['product'] == $result[$i]['product'])
                {
                    $result[$i]['qty_ordered'] = $po_product[$j]['qty'];
                }
            }
        }
        return $result;
    }
    
    public function get_id_po_from_gr($id_gr)
    {
        $this->db->select('po');
        $this->db->from('gr');
        $this->db->where('id_gr', $id_gr);
        
        return $this->db->get()->result_array();
    }
    
    public function change_gr_status($id, $status)
    {
        $this->db->trans_start();
        
        $this->db->where('id_gr', $id);
        $this->db->update('gr', array('status' => $status));
        
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
    
    //==========================================================================================
    
    public function add_product_by_id($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "product_code" => $data['product_code'],
            "product_name" => $data['product_name'],
            "unit" => $data['unit'],
            "product_category" => $data['product_category'],
            "merk" => $data['merk'],
            "description" => $data['description'],
            "is_service" => ($data['is_service'] == 'true' ? 1 : 0),
            "is_active" => ($data['is_active'] == 'true' ? 1 : 0)
        );
        
        $this->db->insert('product', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_product($id)
    {
        $this->db->trans_start();
        $this->db->where('id_product', $id);
        $this->db->delete('product');
        $this->db->trans_complete();
    }
    
    public function get_product_by_id($id)
    {
        $this->db->select('product.*, product_category.product_category AS category_name, merk.name, unit_measure.name as unit_name');
		$this->db->from('product');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
		$this->db->join('merk', 'merk.id_merk=product.merk', 'LEFT');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=product.unit', 'LEFT');
        
        $this->db->where('product.id_product', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function edit_product($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "product_code" => $data['product_code'],
            "product_name" => $data['product_name'],
            "unit" => $data['unit'],
            "product_category" => $data['product_category'],
            "merk" => $data['merk'],
            "description" => $data['description'],
            "is_service" => ($data['is_service'] == true ? 1 : 0),
            "is_active" => ($data['is_active'] == true ? 1 : 0)
        );
        
        $this->db->where('id_product', $data['id_product']);
        $this->db->update('product', $data_input);
        
        $this->db->trans_complete();
    }
    
}