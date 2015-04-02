<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Finance extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'finance');

        $this->data['top_menu'] = 'finance';

	}
	
	public function index()
	{
		$this->data['title'] = 'Finance | ' . $this->config->item('application_name');
	    $this->data['content'] = $this->content_view;        
        $this->template->load('default', 'finance/index', $this->data);
	}
}
?>