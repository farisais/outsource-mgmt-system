<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bom extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "bom", true);
        $this->load->model('bom_model');
          
    }
    public function get_bom_list()
    {
        echo "{\"data\" : " . json_encode($this->bom_model->get_bom_all()) . "}";
    }
    
    
    public function save_bom()
    {
        $id_bom = null;
        if($this->input->post('is_edit') == 'false')
        {
            $id_bom = $this->bom_model->save_bom($this->input->post());
        }
        else
        {
            $this->bom_model->edit_bom($this->input->post());
            $id_bom = $this->input->post('id_bom');
        }
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_bom);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function validate_bom($id)
    {
        $param = null;
        $param = $this->bom_model->validate_bom($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function init_edit_bom($id)
    {
        $data = array(
            "data_edit" => $this->bom_model->get_bom_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;
    }
    
    public function get_bom_product_list()
    {
        echo "{\"data\" : " . json_encode($this->bom_model->get_bom_product_by_id($this->input->get('id'))) . "}";
    }
    
    public function get_bom_open_list()
    {
        echo "{\"data\" : " . json_encode($this->bom_model->get_bom_open()) . "}";
    }
    
    public function init_create_bom()
    {
        return null;
    }
    
    public function post_bom($id)
    {
        $this->bom_model->change_bom_status($id, 'post');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function unpost_bom($id)
    {
        $this->bom_model->change_bom_status($id, 'unpost');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
}
?>
