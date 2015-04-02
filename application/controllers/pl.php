<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pl extends MY_Controller
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
    
   public function get_pl_product_for_mr()
    {
        echo "{\"data\" : " . json_encode($this->project_list_model->get_pl_product_for_mr($this->input->get('id'))) . "}";
    }
    
    public function get_pl_list_submit()
    {
        echo "{\"data\" : " . json_encode($this->project_list_model->get_pl_submit()) . "}";
    }
    
    public function get_pl_product_list()
    {
        echo "{\"data\" : " . json_encode($this->project_list_model->get_pl_product_list($this->input->get('id'))) . "}";
    }
    
    public function save_pl()
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
    
    public function delete_pl()
    {
        $this->project_list_model->delete_pl($this->input->post('id_project_list'));
        
        return null;
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

