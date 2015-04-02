<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Project_list extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "project_list", true);
        $this->load->model('project_list_model');
          
    }
    
    public function get_pl_list()
    {
        echo "{\"data\" : " . json_encode($this->project_list_model->get_pl_all()) . "}";
    }
    
    public function get_pl_product_list()
    {
        echo "{\"data\" : " . json_encode($this->project_list_model->get_pl_all()) . "}";
    }
    
    public function get_so_product_bom()
    {
        echo "{\"data\" : " . json_encode($this->project_list_model->get_bom_from_so($this->input->get('id'))) . "}";
    }
    
    public function save_project_list()
    {
        $id_project_list = null;
        if($this->input->post('is_edit') == 'false')
        {
            $id_project_list = $this->project_list_model->save_project_list($this->input->post());
        }
        else
        {
            $this->project_list_model->edit_project_list($this->input->post());
            $id_project_list = $this->input->post('id_project_list');
        }
        
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_project_list);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function init_edit_pl($id)
    {
        
        $data = array(
            "data_edit" => $this->project_list_model->get_pl_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;
    }
    
    public function validate_pl($id)
    {
        $this->project_list_model->validate_pl($id);
        
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
}
?>
