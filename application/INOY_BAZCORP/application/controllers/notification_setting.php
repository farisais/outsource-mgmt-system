<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notification_setting extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'notification_setting', true);
        $this->load->model('appsetting_model');
	}
    
    public function get_notification_setting_list()
    {
        echo "{\"data\":" .json_encode($this->appsetting_model->get_notification_setting_all()). "}";
    }
    
    
    public function save_notification_setting()
    {
        $param = null;
        if($this->input->post('is_edit') == 'true')
        {
            $param = $this->appsetting_model->edit_notification_setting($this->input->post());
        }
        else
        {
            $param = $this->appsetting_model->save_notification_setting($this->input->post());
        }
        
        return array("log_param" => $param);
    }
    
    public function init_create_notification_setting()
    {
        return null;
    }
    
    public function init_edit_notification_setting($id)
    {
        $data = array();
        $data['is_edit'] = 'true';
        $data['data_edit'] = $this->appsetting_model->get_notification_setting_by_id($id);
        
        return $data;
    }
    
    public function delete_notification_setting()
    {
        $param = $this->appsetting_model->delete_notification_setting($this->input->post('id_notification_setting'));
        
        return array("log_param" => $param);
    }
    
    public function get_notification_action_list()
    {
        echo "{\"data\":" .json_encode($this->appsetting_model->get_notification_setting_action($this->input->get('id'))). "}";
    }
    
    public function get_notification_group_list()
    {
        echo "{\"data\":" .json_encode($this->appsetting_model->get_notification_setting_group($this->input->get('id'))). "}";
    }
}
?>