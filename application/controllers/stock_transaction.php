<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock_transaction extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "stock_transaction", true);
        $this->load->model('stock_transaction_model');
          
    }
    public function get_stock_transaction_list()
    {
        echo "{\"data\" : " . json_encode($this->stock_transaction_model->get_stock_transaction_all()) . "}";
    }
    
    
    public function save_stock_transaction()
    {
        $id_stock_transaction = null;
        if($this->input->post('is_edit') == 'false')
        {
            $id_stock_transaction = $this->stock_transaction_model->save_stock_transaction($this->input->post());
        }
        else
        {
            $this->stock_transaction_model->edit_stock_transaction($this->input->post());
            $id_stock_transaction = $this->input->post('id_stock_transaction');
        }
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_stock_transaction);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function validate_stock_transaction($id)
    {
        $param = null;
        $param = $this->stock_transaction_model->validate_stock_transaction($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function init_edit_stock_transaction($id)
    {
        $data = array(
            "data_edit" => $this->stock_transaction_model->get_stock_transaction_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;
    }
    
    public function get_stock_transaction_product_list()
    {
        echo "{\"data\" : " . json_encode($this->stock_transaction_model->get_stock_transaction_product_by_id($this->input->get('id'))) . "}";
    }
    
    public function get_stock_transaction_open_list()
    {
        echo "{\"data\" : " . json_encode($this->stock_transaction_model->get_stock_transaction_open()) . "}";
    }
    
    public function init_create_stock_transaction()
    {
        return null;
    }
    
    public function post_stock_transaction($id)
    {
        $this->stock_transaction_model->change_stock_transaction_status($id, 'post');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function unpost_stock_transaction($id)
    {
        $this->stock_transaction_model->change_stock_transaction_status($id, 'unpost');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
}
?>
