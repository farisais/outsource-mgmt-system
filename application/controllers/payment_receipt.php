<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class payment_receipt extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "payment_receipt", true);
        $this->load->model('payment_receipt_model');
        $this->load->model('po_model');
          
    }
    public function get_payment_receipt_list()
    {
        echo "{\"data\" : " . json_encode($this->payment_receipt_model->get_payment_receipt_all()) . "}";
    }
    
     public function init_payment_receipt_product()
    {
        $data = array(
            "po" => $this->po_model->get_po_all(),
            "payment_receipt" => $this->payment_receipt_model->get_payment_receipt_all(),
            
        );
        
        return $data;
    }
    
    public function init_create_payment_receipt()
    {
        $data = array();
        if($this->input->post('id_po'))
        {
            $data['from_po'] = 'true';
            $data['po'] = $this->po_model->get_po_by_id($this->input->post('id_po'));
        }
        
        return $data;
    }
     
    public function save_payment_receipt()
    {
        $id_payment = null;
        if($this->input->post('is_edit') == 'false')
        {
            $id_payment = $this->payment_receipt_model->save_payment_receipt($this->input->post());
        }
        else
        {
            $this->payment_receipt_model->edit_payment_receipt($this->input->post());
            $id_payment = $this->input->post('id_payment_receipt');
        }
        
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_payment);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function delete_payment_receipt()
    {
        $this->payment_receipt_model->delete_payment_receipt($this->input->post('id_payment_receipt'));
        //$this->payment_receipt_product_model->delete_payment_receipt_product->('payment_receipt')
        
        return null;
    }
    
    public function init_edit_payment_receipt($id)
    {
        $data = array(
            "po" => $this->po_model->get_po_all(),
            "payment_receipt" => $this->payment_receipt_model->get_payment_receipt_all(),
            "data_edit" => $this->payment_receipt_model->get_payment_receipt_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;   
    }
    
    public function get_payment_receipt_product_list()
    {
        echo "{\"data\" : " . json_encode($this->payment_receipt_model->get_payment_receipt_product_by_id($this->input->get('id'))) . "}";
    }
    
    public function get_payment_receipt_history()
    {
        echo "{\"data\" : " . json_encode($this->payment_receipt_model->get_payment_receipt_history($this->input->get('id_po'), $this->input->get('id_payment'))) . "}";
    }
    
    public function get_payment_left()
    {
        echo json_encode($this->payment_receipt_model->get_payment_left($this->input->get('id_po'), $this->input->get('id_payment')));
    }
    
    public function make_payment_receipt($id)
    {
        $this->payment_receipt_model->validate_payment($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function cancel_payment_receipt()
    {
        $this->payment_receipt_model->cancel_payment_receipt($this->input->post('id_payment'));
        
        return null;
    }
}
?>
