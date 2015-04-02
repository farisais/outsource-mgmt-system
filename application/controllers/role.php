<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Role extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'role', true);
        
        $this->load->model('appsetting_model');
	}
    
    function index()
    {
        
    }
    
    public function get_role_list()
    {
        echo "{\"data\":" . json_encode($this->appsetting_model->get_role_all()) . "}"; 
    }
    
    public function get_action_list()
    {
         echo "{\"data\":" .json_encode($this->appsetting_model->get_action_all()). "}";
    }
    
    public function init_create_role()
    {
        $action_list = $this->appsetting_model->get_action_all();
        
        $data = array(
            "action_list" => $action_list
        );
        
        return $data;
    }
    
    public function save_role()
    {
        $param = null;
        if($this->input->post('is_edit') == 'true')
        {
            $param = $this->appsetting_model->edit_role($this->input->post());
        }
        else
        {
             $param = $this->appsetting_model->save_role($this->input->post());
        }
       
        
        return array('log_param' => $param);
    }
    
    public function init_edit_role($id)
    {
        $role = $this->appsetting_model->get_role_by_id($id);
        
        $data = array(
            'role_edit' => $role,
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function get_action_assigned()
    {
        echo "{\"data\":" . json_encode($this->appsetting_model->get_detail_role_by_id_role($this->input->get('id'))) . "}";
    }
    
    public function delete_role()
    {
        $param = $this->appsetting_model->delete_role();
        
        return array('log_param' => $param);
    }
}
?>