<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Invoice extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "invoice", true);
        $this->load->model('invoice_model');
        $this->load->model('so_model');
        $this->load->model('bank_model');
          
    }
    public function get_invoice_list()
    {
        echo "{\"data\" : " . json_encode($this->invoice_model->get_invoice_all()) . "}";
    }
    
     public function init_invoice_product()
    {
        $data = array(
            "so" => $this->so_model->get_so_all(),
            "invoice" => $this->invoice_model->get_invoice_all(),
            
        );
        
        return $data;
    }
    
    public function init_create_invoice()
    {
        $data = array();
        if($this->input->post('id_so'))
        {
            $data['from_so'] = 'true';
            $data['so'] = $this->so_model->get_so_by_id($this->input->post('id_so'));
        }
        
        return $data;
    }
     
    public function save_invoice()
    {
        $id_invoice = null;
        if($this->input->post('is_edit') == 'false')
        {
            $id_invoice = $this->invoice_model->save_invoice($this->input->post());
        }
        else
        {
            $this->invoice_model->edit_invoice($this->input->post());
            $id_invoice = $this->input->post('id_invoice');
        }
        
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_invoice);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function delete_invoice()
    {
        $this->invoice_model->delete_invoice($this->input->post('id_invoice'));
        //$this->payment_receipt_product_model->delete_payment_receipt_product->('payment_receipt')
        
        return null;
    }
    
    public function init_edit_invoice($id)
    {
        $data = array(
            "so" => $this->so_model->get_so_all(),
            "bank" => $this->bank_model->get_bank_all(),
            "invoice" => $this->invoice_model->get_invoice_all(),
            "data_edit" => $this->invoice_model->get_invoice_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;   
    }
    
    public function get_invoice_product_list()
    {
        echo "{\"data\" : " . json_encode($this->invoice_model->get_invoice_product_by_id($this->input->get('id'))) . "}";
    }
    
    public function get_invoice_history()
    {
        echo "{\"data\" : " . json_encode($this->invoice_model->get_invoice_history($this->input->get('id_so'), $this->input->get('id_invoice'))) . "}";
    }
    
    public function get_invoice_left()
    {
        echo json_encode($this->invoice_model->get_invoice_left($this->input->get('id_so'), $this->input->get('id_invoice')));
    }
    
    public function make_invoice($id)
    {
        $this->invoice_model->validate_invoice($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function cancel_invoice()
    {
        $this->invoice_model->cancel_invoice($this->input->post('id_invoice'));
        
        return null;
    }
}
?>
