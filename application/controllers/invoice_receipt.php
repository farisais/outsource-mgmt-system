<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Invoice_receipt extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "invoice_receipt", true);
        $this->load->model('invoice_receipt_model');
        $this->load->model('po_model');
          
    }
    public function get_invoice_receipt_list()
    {
        echo "{\"data\" : " . json_encode($this->invoice_receipt_model->get_invoice_receipt_all()) . "}";
    }
    
     public function init_invoice_receipt_product()
    {
        $data = array(
            "po" => $this->po_model->get_po_all(),
            "invoice_receipt" => $this->invoice_receipt_model->get_invoice_receipt_all(),
            
        );
        
        return $data;
    }
    
    public function init_create_invoice_receipt()
    {
        $data = array();
        if($this->input->post('id_po'))
        {
            $data['from_po'] = 'true';
            $data['po'] = $this->po_model->get_po_by_id($this->input->post('id_po'));
        }
        
        return $data;
    }
     
    public function save_invoice_receipt()
    {
        $id_invoice = null;
        if($this->input->post('is_edit') == 'false')
        {
            $id_invoice = $this->invoice_receipt_model->save_invoice_receipt($this->input->post());
        }
        else
        {
            $this->invoice_receipt_model->edit_invoice_receipt($this->input->post());
            $id_invoice = $this->input->post('id_invoice_receipt');
        }
        
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_invoice);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function delete_invoice_receipt()
    {
        $this->invoice_receipt_model->change_invoice_receipt_status($this->input->post('id_invoice_receipt'), 'void');
    }
    
    public function init_edit_invoice_receipt($id)
    {
        $data = array(
            "po" => $this->po_model->get_po_all(),
            "invoice_receipt" => $this->invoice_receipt_model->get_invoice_receipt_all(),
            "data_edit" => $this->invoice_receipt_model->get_invoice_receipt_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;   
    }
    
    public function get_invoice_receipt_product_list()
    {
        echo "{\"data\" : " . json_encode($this->invoice_receipt_model->get_invoice_receipt_product_by_id($this->input->get('id'))) . "}";
    }
    
    public function get_invoice_receipt_history()
    {
        echo "{\"data\" : " . json_encode($this->invoice_receipt_model->get_invoice_receipt_history($this->input->get('id_invoice'), $this->input->get('id_payment'))) . "}";
    }
    
    public function get_payment_left()
    {
        echo json_encode($this->invoice_receipt_model->get_invoice_left($this->input->get('id_invoice'), $this->input->get('id_payment')));
    }
    
    public function validate_invoice_receipt($id)
    {
        $this->invoice_receipt_model->validate_payment($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function cancel_invoice_receipt()
    {
        $this->invoice_receipt_model->cancel_invoice_receipt($this->input->post('id_payment'));
        
        return null;
    }
}
?>
