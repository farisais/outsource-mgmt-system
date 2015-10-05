<?php
class invoice_receipt_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_invoice_receipt_all()
	{
		$this->db->select('invoice_receipt.*, invoice.invoice_number');
		$this->db->from('invoice_receipt');
        $this->db->join('invoice', 'invoice.id_invoice=invoice_receipt.invoice', 'LEFT');
                
		return $this->db->get()->result_array();
	}
    
    public function save_invoice_receipt($data)
    {
        $this->db->trans_start();
        $ci =& get_instance();
        $ci->load->model('invoice_model');
        
        $po = $ci->invoice_model->get_invoice_by_id($data['id_invoice']);
        
        $data_input = array(
            "invoice" => $data['id_invoice'],
            "payment_date" => $data['date'],
            "sub_total" => $po[0]['sub_total'],
            "tax" => $po[0]['ppn'],
            "total_price" => $po[0]['total_invoice'],
            "total_payment" => $data['total_payment'],
            "invoice_receipt_number" => $this->generate_invoice_receipt_number(),
            "payment_method" => $data['payment_method'],
            "rekening" => $data['rekening'],
            "status" => 'open',
        );
        
        $this->db->insert('invoice_receipt', $data_input);
        $return_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function generate_invoice_receipt_number()
    {
        $this->db->select('*');
        $this->db->from('invoice_receipt');
        $this->db->where('YEAR(payment_date)', date('Y'));
        
        $result = $this->db->get()->result_array();
        $countResult = count($result) + 1;
        $zeroCount = '';
        
        for($i=0; $i<4 - strlen($countResult);$i++)
        {
            $zeroCount .= '0';
        }
        
        return ("IR" . date('y') . $zeroCount . $countResult);
    }
    
    public function delete_invoice_receipt($id)
    {
        $this->db->trans_start();
        $this->db->where('id_product', $id);
        $this->db->delete('product');
        $this->db->trans_complete();
    }
    
    public function get_invoice_receipt_by_id($id)
    {
        $this->db->select('invoice_receipt.*, invoice.invoice_number');
		$this->db->from('invoice_receipt');
        $this->db->join('invoice', 'invoice_receipt.invoice=invoice.id_invoice', 'LEFT');
        
        $this->db->where('invoice_receipt.id_invoice_receipt', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function edit_invoice_receipt($data)
    {
        $this->db->trans_start();
        $ci =& get_instance();
        $ci->load->model('invoice_model');
        
        $po = $ci->invoice_model->get_invoice_by_id($data['id_invoice']);
        

        $data_input = array(
            "invoice" => $data['id_invoice'],
            "payment_date" => $data['date'],
            "sub_total" => $po[0]['sub_total'],
            "tax" => $po[0]['ppn'],
            "total_price" => $po[0]['total_invoice'],
            "total_payment" => $data['total_payment'],
            "payment_method" => $data['payment_method'],
            "rekening" => $data['rekening'],
            "status" => 'open'
        );
        $this->db->where('id_invoice_receipt', $data['id_invoice_receipt']);
        $this->db->update('invoice_receipt', $data_input);
        $this->db->trans_complete();
    }
    
    public function get_invoice_receipt_product_by_id($id)
    {
        $ci =& get_instance();
        $ci->load->model('po_model');
        
        $this->db->select('invoice_receipt_product.*, invoice_receipt_product.qty AS qty_received, invoice_receipt_product.uom as unit, unit_measure.name as unit_name, product.*');
        $this->db->from('invoice_receipt_product');
        $this->db->join('product', 'product.id_product=invoice_receipt_product.product', 'INNER');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=invoice_receipt_product.uom', 'INNER');
        $this->db->where('invoice_receipt', $id);
        
        $result = $this->db->get()->result_array();
        
        for($i=0;$i<count($result);$i++)
        {
            $po_product = $ci->po_model->get_po_product_by_id($this->get_id_po_from_invoice_receipt($id)[0]['po']);
            
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
    
    public function get_id_po_from_invoice_receipt($id_invoice_receipt)
    {
        $this->db->select('po');
        $this->db->from('invoice_receipt');
        $this->db->where('id_invoice_receipt', $id_invoice_receipt);
        
        return $this->db->get()->result_array();
    }
    
    public function change_invoice_receipt_status($id, $status)
    {
        $this->db->where('id_invoice_receipt', $id);
        $this->db->update('invoice_receipt', array("status" => $status));
        
        return null;
    }
    
    public function get_invoice_receipt_history($id_po, $exclude_id = null)
    {
        $pr = null;
        if($exclude_id !=null)
        {
            $pr = $this->get_invoice_receipt_by_id($exclude_id);
        }
        
        $this->db->select('invoice_receipt.*, invoice.invoice_number');
		$this->db->from('invoice_receipt');
        $this->db->join('invoice', 'invoice.id_invoice=invoice_receipt.invoice', 'LEFT');
        
        $this->db->where('invoice_receipt.invoice', $id_po);
        $this->db->where('invoice_receipt.status', 'close');
        if($exclude_id !=null)
        {
            $this->db->where('invoice_receipt.id_invoice_receipt !=', $exclude_id);
            
            $this->db->where('DATE(invoice_receipt.payment_date) <= DATE(\''. $pr[0]['payment_date'] . '\')', null, false );
            $this->db->where('invoice_receipt.id_invoice_receipt <', $pr[0]['id_invoice_receipt']);
        }
                
		return $this->db->get()->result_array();
    }
    
    public function get_invoice_left($id_po, $exclude_id = null)
    {
        $pr = null;
        if($exclude_id !=null)
        {
            $pr = $this->get_invoice_receipt_by_id($exclude_id);
        }
        
        $this->db->select('ir.*, i.invoice_number');
		$this->db->from('invoice_receipt as ir');
        $this->db->join('invoice as i', 'i.id_invoice=ir.invoice', 'LEFT');
        
        $this->db->where('ir.invoice', $id_po);
        $this->db->where('ir.status', 'close');
        if($exclude_id!=null)
        {
            $this->db->where('ir.id_invoice_receipt !=', $exclude_id);
            $this->db->where('DATE(ir.payment_date) <= DATE(\''. $pr[0]['payment_date'] . '\')', null, false );
            $this->db->where('ir.id_invoice_receipt <', $pr[0]['id_invoice_receipt']);
        }
                
		$pr = $this->db->get()->result_array();
        $total = 0;
        foreach($pr as $p)
        {
            $total += $p['total_payment'];
        }
        
        $ci =& get_instance();
        $ci->load->model('invoice_model');
        
        $invoice = $ci->invoice_model->get_invoice_by_id($id_po);
        
        return $invoice[0]['total_invoice'] - $total;
    }
    
    public function validate_payment($id_payment)
    {   
        $pr = $this->get_invoice_receipt_by_id($id_payment);
        $this->db->trans_start();
         
        $this->db->where('id_invoice_receipt', $id_payment);
        $this->db->update('invoice_receipt', array('status' => 'close'));
         
        $this->db->trans_complete();
		
        $ci =& get_instance();
        $ci->load->model('invoice_model');
        if($this->get_invoice_left($pr[0]['invoice']) <= 0)
        {
            //close PO
            $po = $ci->invoice_model->get_invoice_by_id($pr[0]['invoice']);
			
            if($po[0]['status_invoice'] == 'open' || $po[0]['status_invoice'] == 'partial_paid')
            {
                $ci->invoice_model->change_invoice_status($pr[0]['invoice'], 'close');
            }
        }
    }
    
    public function cancel_invoice_receipt($id)
    {
        $this->db->trans_start();
        $this->db->where('id_invoice_receipt', $id);
        $this->db->update('invoice_receipt', array("status" => "cancel"));
        $this->db->trans_complete();
        
        $pr = $this->get_invoice_receipt_by_id($id);
        $ci =& get_instance();
        $ci->load->model('invoice_model');

        $po = $ci->invoice_model->get_invoice_by_id($pr[0]['invoice']);
        if($po[0]['status_invoice'] == 'close')
        {
            $ci->invoice_model->change_invoice_status($pr[0]['invoice'], 'open');
        }
    }
}