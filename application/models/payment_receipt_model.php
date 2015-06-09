<?php
class payment_receipt_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_payment_receipt_all()
	{
		$this->db->select('payment_receipt.*, po.po_number');
		$this->db->from('payment_receipt');
        $this->db->join('po', 'po.id_po=payment_receipt.po', 'LEFT');
                
		return $this->db->get()->result_array();
	}
    
    public function save_payment_receipt($data)
    {
        $this->db->trans_start();
        $ci =& get_instance();
        $ci->load->model('po_model');
        
        $po = $ci->po_model->get_po_by_id($data['id_po']);
        
        $data_input = array(
            "po" => $data['id_po'],
            "payment_date" => $data['date'],
            "sub_total" => $po[0]['sub_total'],
            "tax" => $po[0]['tax'],
            "total_price" => $po[0]['total_price'],
            "total_payment" => $data['total_payment'],
            "payment_receipt_number" => $this->generate_payment_receipt_number(),
            "payment_method" => $data['payment_method'],
            "rekening" => $data['rekening'],
            "status" => 'open',
        );
        
        $this->db->insert('payment_receipt', $data_input);
        $return_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function generate_payment_receipt_number()
    {
        $this->db->select('*');
        $this->db->from('payment_receipt');
        $this->db->where('YEAR(payment_date)', date('Y'));
        
        $result = $this->db->get()->result_array();
        $countResult = count($result) + 1;
        $zeroCount = '';
        
        for($i=0; $i<4 - strlen($countResult);$i++)
        {
            $zeroCount .= '0';
        }
        
        return ("PR" . date('y') . $zeroCount . $countResult);
    }
    
    public function delete_payment_receipt($id)
    {
        $this->db->trans_start();
        $this->db->where('id_product', $id);
        $this->db->delete('product');
        $this->db->trans_complete();
    }
    
    public function get_payment_receipt_by_id($id)
    {
        $this->db->select('payment_receipt.*, po.po_number');
		$this->db->from('payment_receipt');
        $this->db->join('po', 'payment_receipt.po=po.id_po', 'LEFT');
        
        $this->db->where('payment_receipt.id_payment_receipt', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function edit_payment_receipt($data)
    {
        $this->db->trans_start();
        $ci =& get_instance();
        $ci->load->model('po_model');
        
        $po = $ci->po_model->get_po_by_id($data['id_po']);
        

        $data_input = array(
            "po" => $data['id_po'],
            "payment_date" => $data['date'],
            "sub_total" => $po[0]['sub_total'],
            "tax" => $po[0]['tax'],
            "total_price" => $po[0]['total_price'],
            "total_payment" => $data['total_payment'],
            "payment_method" => $data['payment_method'],
            "rekening" => $data['rekening'],
            "status" => 'open'
        );
        $this->db->where('id_payment_receipt', $data['id_payment_receipt']);
        $this->db->update('payment_receipt', $data_input);
        $this->db->trans_complete();
    }
    
    public function get_payment_receipt_product_by_id($id)
    {
        $ci =& get_instance();
        $ci->load->model('po_model');
        
        $this->db->select('payment_receipt_product.*, payment_receipt_product.qty AS qty_received, payment_receipt_product.uom as unit, unit_measure.name as unit_name, product.*');
        $this->db->from('payment_receipt_product');
        $this->db->join('product', 'product.id_product=payment_receipt_product.product', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=payment_receipt_product.uom', 'INNER');
        $this->db->where('payment_receipt', $id);
        
        $result = $this->db->get()->result_array();
        
        for($i=0;$i<count($result);$i++)
        {
            $po_product = $ci->po_model->get_po_product_by_id($this->get_id_po_from_payment_receipt($id)[0]['po']);
            
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
    
    public function get_id_po_from_payment_receipt($id_payment_receipt)
    {
        $this->db->select('po');
        $this->db->from('payment_receipt');
        $this->db->where('id_payment_receipt', $id_payment_receipt);
        
        return $this->db->get()->result_array();
    }
    
    public function change_payment_receipt_status($id, $status)
    {
        $this->db->where('id_payment_receipt', $id);
        $this->db->update('payment_receipt', array("status" => $status));
        
        return null;
    }
    
    public function get_payment_receipt_history($id_po, $exclude_id = null)
    {
        $pr = null;
        if($exclude_id !=null)
        {
            $pr = $this->get_payment_receipt_by_id($exclude_id);
        }
        
        $this->db->select('payment_receipt.*, po.po_number');
		$this->db->from('payment_receipt');
        $this->db->join('po', 'po.id_po=payment_receipt.po', 'LEFT');
        
        $this->db->where('payment_receipt.po', $id_po);
        $this->db->where('payment_receipt.status', 'close');
        if($exclude_id !=null)
        {
            $this->db->where('payment_receipt.id_payment_receipt !=', $exclude_id);
            
            $this->db->where('DATE(payment_receipt.payment_date) <= DATE(\''. $pr[0]['payment_date'] . '\')', null, false );
            $this->db->where('payment_receipt.id_payment_receipt <', $pr[0]['id_payment_receipt']);
        }
                
		return $this->db->get()->result_array();
    }
    
    public function get_payment_left($id_po, $exclude_id = null)
    {
        $pr = null;
        if($exclude_id !=null)
        {
            $pr = $this->get_payment_receipt_by_id($exclude_id);
        }
        
        $this->db->select('payment_receipt.*, po.po_number');
		$this->db->from('payment_receipt');
        $this->db->join('po', 'po.id_po=payment_receipt.po', 'LEFT');
        
        $this->db->where('payment_receipt.po', $id_po);
        $this->db->where('payment_receipt.status', 'close');
        if($exclude_id!=null)
        {
            $this->db->where('payment_receipt.id_payment_receipt !=', $exclude_id);
            $this->db->where('DATE(payment_receipt.payment_date) <= DATE(\''. $pr[0]['payment_date'] . '\')', null, false );
            $this->db->where('payment_receipt.id_payment_receipt <', $pr[0]['id_payment_receipt']);
        }
                
		$pr = $this->db->get()->result_array();
        $total = 0;
        foreach($pr as $p)
        {
            $total += $p['total_payment'];
        }
        
        $ci =& get_instance();
        $ci->load->model('po_model');
        
        $po = $ci->po_model->get_po_by_id($id_po);
        
        return $po[0]['total_price'] - $total;
    }
    
    public function validate_payment($id_payment)
    {   
        $pr = $this->get_payment_receipt_by_id($id_payment);
        $this->db->trans_start();
         
        $this->db->where('id_payment_receipt', $id_payment);
        $this->db->update('payment_receipt', array('status' => 'close'));
         
        $this->db->trans_complete();
        
        if($this->get_payment_left($pr[0]['po']) == 0)
        {   
            //close PO
			
            $ci =& get_instance();
            $ci->load->model('po_model');
        
            $po = $ci->po_model->get_po_by_id($pr[0]['po']);
			
            if($po[0]['status'] == 'open')
            {
                $ci->po_model->change_po_status($pr[0]['po'], 'payment_received');
            }
            else if($po[0]['status'] == 'good_received')
            {
                $ci->po_model->change_po_status($pr[0]['po'], 'close');
            }
        }
    }
    
    public function cancel_payment_receipt($id)
    {
        $this->db->trans_start();
        $this->db->where('id_payment_receipt', $id);
        $this->db->update('payment_receipt', array("status" => "cancel"));
        $this->db->trans_complete();
        
        $pr = $this->get_payment_receipt_by_id($id);
        $ci =& get_instance();
        $ci->load->model('po_model');

        $po = $ci->po_model->get_po_by_id($pr[0]['po']);
        if($po[0]['status'] == 'close')
        {
            $ci->po_model->change_po_status($pr[0]['po'], 'good_received');
        }
        else if($po[0]['status'] == 'payment_received')
        {
            $ci->po_model->change_po_status($pr[0]['po'], 'open');
        }
    }
}