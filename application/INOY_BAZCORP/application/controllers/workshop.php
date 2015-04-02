<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Workshop extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'workshop');

         $this->data['top_menu'] = 'workshop';
	}
	
	public function index()
	{
		$this->data['title'] = 'Workshop | ' . $this->config->item('application_name');
	    $this->data['content'] = $this->content_view;        
        $this->template->load('default', 'workshop/index', $this->data);
	}
}
?>