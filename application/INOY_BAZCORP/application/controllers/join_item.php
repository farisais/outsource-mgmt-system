<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Join_item extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "join_item", true);
        $this->load->model('join_item_model');
        $this->load->model('bom_model'); 
        $this->load->model('stock_model');
    }
    public function get_join_item_list()
    {
        echo "{\"data\" : " . json_encode($this->join_item_model->get_join_item_all()) . "}";
    }
    
    public function get_join_item_product_list()
    {
        $result = $this->join_item_model->get_join_item_product_by_id($this->input->get('id'));
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['qty'] = $result[$i]['qty_bom'];
            $stock = $this->stock_model->get_stock_from_warehouse($result[0]['product'], $result[0]['warehouse']);
            $result[$i]['qty_available'] = $stock[0]['total_qty'];
        }
        
        echo "{\"data\" : " . json_encode($result) . "}";
    }
    
    public function get_bom_product_list()
    {
        $result = $this->bom_model->get_bom_product_by_id($this->input->get('id'));
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['qty_transfer'] = $result[$i]['qty'];
            $result[$i]['warehouse'] = null;
            $result[$i]['warehouse_name'] = null;
        }
        echo "{\"data\" : " . json_encode($result) . "}";
    }
    
    public function save_join_item()
    {
        $id_join_item = null;
        if($this->input->post('is_edit') == 'false')
        {
            $id_join_item = $this->join_item_model->save_join_item($this->input->post());
        }
        else
        {
            $this->join_item_model->edit_join_item($this->input->post());
            $id_join_item = $this->input->post('id_join_item');
        }
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_join_item);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function validate_join_item($id)
    {
        $param = null;
        $param = $this->join_item_model->validate_join_item($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function init_edit_join_item($id)
    {
        $data = array(
            "data_edit" => $this->join_item_model->get_join_item_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;
    }
    
    public function init_create_join_item()
    {
        return null;
    }
    
    public function transfer_join_item($id)
    {
        $this->join_item_model->transfer_join_item($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function unpost_join_item($id)
    {
        $this->join_item_model->change_join_item_status($id, 'unpost');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
}
?>
