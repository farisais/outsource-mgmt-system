<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_definition extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "product_definition", true);
        $this->load->model('product_model');
        $this->load->model('organisation_structure_model');
        $this->load->model('position_level_model');                
    }
    public function get_product_definition_list()
    {
        echo "{\"data\" : " . json_encode($this->product_model->get_product_definition_all()) . "}";
    }
    
    public function init_create_product_definition()
    {
        $data = array();                
        $data['position_level'] = $this->position_level_model->get_position_level_all();                        
        return $data;
    }
    
    public function save_product_definition()
    {
        $param = null;                        
        if($this->input->post('is_edit') == 'false')
        {
            $param = $this->product_model->save_product_definition($this->input->post());
        }
        else
        {
            $param = $this->product_model->edit_product_definition($this->input->post());
        }
        
        return array("log_param" => $param);                        
    }
    
    public function delete_product_definition()
    {
        $param = $this->product_model->get_product_definition_by_id($this->input->post('id_product_definition'));                
        $this->product_model->delete_product_definition($this->input->post('id_product_definition'));
        
         return array("log_param" => $param);                                
    }
    
    public function init_edit_product_definition($id)
    {
        $data = array(
            "data_edit" => $this->product_model->get_product_definition_by_id($id),
            "position_level" => $this->position_level_model->get_position_level_all(),
            "is_edit" => 'true'
        );
        
        return $data;
    }
    
    public function init_view($id)
    {
        $data = $this->init_edit_product_definition($id);
        $data['is_view'] = true;
        
        return $data;
    }
}
?>
