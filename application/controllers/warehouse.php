<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Warehouse extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'warehouse');

        $this->data['top_menu'] = 'warehouse';
	}
	
	public function index()
	{
        $this->data['title'] = 'Warehouse | ' . $this->config->item('application_name');
	    $this->data['content'] = $this->content_view;        
        $this->template->load('default', 'warehouse/index', $this->data);
	}
}
?>