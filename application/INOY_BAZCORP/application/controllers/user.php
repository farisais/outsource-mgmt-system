<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'user', true);
        $this->load->model('appsetting_model');
	}
    
    public function get_user_list()
    {
        echo "{\"data\":" .json_encode($this->appsetting_model->get_user_all()). "}";
    }
    
    public function init_create_user()
	{
        $data = array(
            "role_list" => $this->appsetting_model->get_role_all()
        );
        
        return $data;
	}
    
    public function init_edit_user($id)
    {
        $data = array(
            "role_list" => $this->appsetting_model->get_role_all(),
            "data_edit" => $this->appsetting_model->get_user_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;
    }
    
    public function save_user()
    {
        if($this->input->post('is_edit') == 'false')
        {
            $this->appsetting_model->insert_user($this->input->post());
        }
        else
        {
            $this->appsetting_model->edit_user($this->input->post());
        }
        
        return null;
    }
    
    public function get_md5_pass($pass)
    {
        echo md5($this->security->xss_clean($pass));
    }
    
    public function delete_user()
    {
        $this->appsetting_model->delete_user($this->input->post('id_user'));
        
        return null;
    }
    
    public function change_user_password()
    {
        $this->appsetting_model->change_user_password($this->input->post());
        
        return null;
    }
}