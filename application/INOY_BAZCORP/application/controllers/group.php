<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Group extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'group', true);
        $this->load->model('group_model');
	}
    
    public function get_group_list()
    {
        echo "{\"data\":" .json_encode($this->group_model->get_group_all()). "}";
    }
    
    public function get_group_member()
    {
        echo "{\"data\":" .json_encode($this->group_model->get_group_member_by_id($this->input->get('id'))). "}";
    }
    
    public function save_group()
    {
        $id_group = null;
        $param = $this->input->post();
        if($this->input->post('is_edit') == 'true')
        {
            $id_group = $this->group_model->edit_group($this->input->post());
        }
        else
        {
            $id_group = $this->group_model->save_group($this->input->post());
        }
        
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_group);
        return array("log_param" => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function init_create_group()
    {
        return null;
    }
    
    public function init_edit_group($id)
    {
        $data = array();
        $data['is_edit'] = 'true';
        $data['data_edit'] = $this->group_model->get_group_by_id($id);
        
        return $data;
    }
    
    public function test_email()
    {
        $this->send_automatic_notification_email(170, 'test_email');
    }
    
    public function delete_group()
    {
        $this->group_model->delete_group($this->input->post('id_group'));
        
        return null;
    }
}
?>