<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Division extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'division');
         $this->load->model('appsetting_model');
	}
    
    public function index()
    {
        
    }
    
    public function save_division()
    {
        
    }
    
    public function init_edit_division()
    {
        
    }
    
    public function get_division_list()
    {
        echo "{\"data\":" . json_encode($this->appsetting_model->get_division_all()) . "}";
    }
    
    public function delete_division()
    {
        
    }
    
    public function division_show()
    {
        echo $this->load->view('division/division_list', null, true);
    }
}
?>