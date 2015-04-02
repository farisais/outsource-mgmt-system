<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sales extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'sales');

         $this->data['top_menu'] = 'sales';

	}
	
	public function index()
	{
		$this->data['title'] = 'Sales | ' . $this->config->item('application_name');
	    $this->data['content'] = $this->content_view;        
        $this->template->load('default', 'sales/index', $this->data);
	}
}
?>