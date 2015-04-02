<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Action extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'action', true);
        $this->load->model('appsetting_model');
	}
	
	public function index()
	{

	}
    
    public function get_action_list()
    {
        echo "{\"data\":" .json_encode($this->appsetting_model->get_action_all()). "}";
    }
    
    public function insert_action()
    {
        $param = null;
        if($this->input->post('is_edit') == 'true')
        {
            $param = $this->appsetting_model->edit_action($this->input->post('id_edit'));
        }
        else
        {
            $param = $this->appsetting_model->add_action();
        }
        
        return array("log_param" => $param);
    }
    
    public function delete_application_action()
    {
        $this->appsetting_model->delete_action();
        
        $param = $this->appsetting_model->get_action_by_id($this->input->post('id_application_action'));
        return array("log_param" => $param);
    }
    
    public function get_action_data($id)
    {
        $action_edit = $this->appsetting_model->get_action_by_id($id);
        $action_condition = $this->appsetting_model->get_action_condition_by_action($id);
        $target_action = $this->appsetting_model->get_action_all();
        
        $data = array(
            'action_edit' => $action_edit,
            'is_edit' => 'true',
            'target_action' => $target_action,
            'action_condition' => $action_condition            
        );
        
        return $data;
    }
    
    public function init_create_action()
    {
        $target_action = $this->appsetting_model->get_action_all();
        
        $data = array(
            'target_action' => $target_action
        );
        
        return $data;
    }
}
?>