<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_invoice extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "customer_invoice", true);
        $this->load->model('customer_invoice_model');
          
    }
    public function get_customer_invoice_list()
    {
        echo "{\"data\" : " . json_encode($this->customer_invoice_model->get_customer_invoice_all()) . "}";
    }
    
    
    public function save_customer_invoice()
    {
        $id_customer_invoice = null;
        if($this->input->post('is_edit') == 'false')
        {
            $id_customer_invoice = $this->customer_invoice_model->save_customer_invoice($this->input->post());
        }
        else
        {
            $this->customer_invoice_model->edit_customer_invoice($this->input->post());
            $id_customer_invoice = $this->input->post('id_customer_invoice');
        }
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_customer_invoice);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function validate_customer_invoice($id)
    {
        $param = null;
        $param = $this->customer_invoice_model->validate_customer_invoice($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function init_edit_customer_invoice($id)
    {
        $data = array(
            "data_edit" => $this->customer_invoice_model->get_customer_invoice_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;
    }
    
    public function get_customer_invoice_product_list()
    {
        echo "{\"data\" : " . json_encode($this->customer_invoice_model->get_customer_invoice_product_by_id($this->input->get('id'))) . "}";
    }
    
    public function get_customer_invoice_open_list()
    {
        echo "{\"data\" : " . json_encode($this->customer_invoice_model->get_customer_invoice_open()) . "}";
    }
    
    public function init_create_customer_invoice()
    {
        return null;
    }
    
    public function post_customer_invoice($id)
    {
        $this->customer_invoice_model->change_customer_invoice_status($id, 'post');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function unpost_customer_invoice($id)
    {
        $this->customer_invoice_model->change_customer_invoice_status($id, 'unpost');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
}
?>
