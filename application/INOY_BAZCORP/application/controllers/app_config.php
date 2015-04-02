<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_config extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'app_config', true);
        $this->load->model('appsetting_model');
	}
    
    public function get_app_config_list()
    {
        echo "{\"data\":" .json_encode($this->appsetting_model->get_app_config_all()). "}";
    }
    
    
    public function save_app_config()
    {
        $param = null;
        if($this->input->post('is_edit') == 'true')
        {
            $param = $this->appsetting_model->edit_app_config($this->input->post());
        }
        else
        {
            $param = $this->appsetting_model->save_app_config($this->input->post());
        }
        
        return array("log_param" => $param);
    }
    
    public function init_create_app_config()
    {
        return null;
    }
    
    public function init_edit_app_config($id)
    {
        $data = array();
        $data['is_edit'] = 'true';
        $data['data_edit'] = $this->appsetting_model->get_app_config_by_id($id);
        
        return $data;
    }
    
    public function delete_app_config()
    {
        $param = $this->appsetting_model->delete_app_config($this->input->post('id_config'));
    }
}
?>