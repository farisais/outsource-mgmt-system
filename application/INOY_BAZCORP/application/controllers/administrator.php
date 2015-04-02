<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends MY_Controller
{
    public function __construct()
	{
		parent::__construct('authorize', 'administrator');   

        $this->load->model('appsetting_model');
        $this->load->model('master_model');
	}
    
    public function index()
	{
        $this->data['title'] = 'Administrator Setting | ' . $this->config->item('application_name');
	    $this->data['content'] = $this->content_view;        
        $this->template->load('default', 'administrator/index', $this->data);
	}       
    
  
    
    public function get_child_from_parent()
    {
        $result = array();
        $this->appsetting_model->get_child_menu_from_parent($this->input->get('parent'), $result);
        
        echo json_encode($result);
    }
    
    
    public function get_parent_menu_all()
    {
        echo json_encode($this->appsetting_model->get_parent_menu_all());
    }
    
    public function get_division_list()
    {
        echo "\"data\":" . json_encode($this->appsetting_model->get_division_all());
    }
    

}
?>
