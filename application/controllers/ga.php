<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ga extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'ga');
        
        $this->data['top_menu'] = 'ga';
	}
    
    function index()
    {
        $this->data['title'] = 'Purchasing | ' . $this->config->item('application_name');
        $this->data['content'] =  $this->content_view; 
        $this->template->load('default', 'purchasing/index', $this->data);
    }
    
}
?>