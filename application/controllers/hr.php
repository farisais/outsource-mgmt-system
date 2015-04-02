<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hr extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'hr');
        
        $this->data['top_menu'] = 'HR';
	}
    
    function index()
    {
        $this->data['title'] = 'HR | ' . $this->config->item('application_name');
        $this->data['content'] =  $this->content_view; 
        $this->template->load('default', 'hr/index', $this->data);
    }
    
}
?>