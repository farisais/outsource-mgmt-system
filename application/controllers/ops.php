<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ops extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'ops');
        
        $this->data['top_menu'] = 'ops';
	}
    
    function index()
    {
        $this->data['title'] = 'OPS | ' . $this->config->item('application_name');
        $this->data['content'] =  $this->content_view; 
        $this->template->load('default', 'ops/index', $this->data);
    }
    
}
?>