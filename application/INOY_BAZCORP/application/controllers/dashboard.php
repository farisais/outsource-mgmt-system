<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'dashboard');
        
		$this->load->model('division_model');
		$this->load->model('product_model');
        
        $this->session->set_userdata('is_dialog_set', false);
        $this->session->set_userdata('page', 'dahsboard/index');
        
        $this->data['top_menu'] = 'dashboard';
        
	}
	
	public function index()
	{
        $this->data['title'] = 'Dashboard | ' . $this->config->item('application_name');
        $this->data['content'] = $this->content_view;
        //$this->data['side_nav'] = $this->load->view('navigation/sub/dash_menu', null, true);
        $this->template->load('default', 'dashboard/index', $this->data);
	}
}
?>