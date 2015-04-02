<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'app');
        
        $this->data['top_menu'] = 'dashboard';
	}
	
	public function index()
	{
        $this->data['title'] = 'Dashboard | ' . $this->config->item('application_name');
        $this->data['content'] = $this->content_view;
        $this->data['side_nav'] = $this->load->view('navigation/sub/dash_menu', null, true);
        $this->template->load('default', 'dashboard/index', $this->data);
	}
}
?>