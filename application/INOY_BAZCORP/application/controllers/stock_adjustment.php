<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class stock_adjustment extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "stock_adjustment", true);
        $this->load->model('stock_adjustment_model');
          
    }
    public function get_stock_adjustment_list()
    {
        echo "{\"data\" : " . json_encode($this->stock_adjustment_model->get_stock_adjustment_all()) . "}";
    }
    
    
    public function save_stock_adjustment()
    {
        $id_stock_adjustment = null;
        if($this->input->post('is_edit') == 'false')
        {
            $id_stock_adjustment = $this->stock_adjustment_model->save_stock_adjustment($this->input->post());
        }
        else
        {
            $this->stock_adjustment_model->edit_stock_adjustment($this->input->post());
            $id_stock_adjustment = $this->input->post('id_stock_adjustment');
        }
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_stock_adjustment);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function validate_stock_adjustment($id)
    {
        $param = null;
        $param = $this->stock_adjustment_model->validate_stock_adjustment($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function init_edit_stock_adjustment($id)
    {
        $data = array(
            "data_edit" => $this->stock_adjustment_model->get_stock_adjustment_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;
    }
    
    public function get_stock_adjustment_product_list()
    {
        echo "{\"data\" : " . json_encode($this->stock_adjustment_model->get_stock_adjustment_product_by_id($this->input->get('id'))) . "}";
    }
    
    public function get_stock_adjustment_open_list()
    {
        echo "{\"data\" : " . json_encode($this->stock_adjustment_model->get_stock_adjustment_open()) . "}";
    }
    
    public function init_create_stock_adjustment()
    {
        return null;
    }
    
    public function post_stock_adjustment($id)
    {
        $this->stock_adjustment_model->change_stock_adjustment_status($id, 'post');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function unpost_stock_adjustment($id)
    {
        $this->stock_adjustment_model->change_stock_adjustment_status($id, 'unpost');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
}
?>
