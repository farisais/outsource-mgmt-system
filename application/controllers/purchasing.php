<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchasing extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'purchasing');
        
        $this->data['top_menu'] = 'purchasing';
	}
    
    function index()
    {
        $this->data['title'] = 'Purchasing | ' . $this->config->item('application_name');
        $this->data['content'] =  $this->content_view; 
        $this->template->load('default', 'purchasing/index', $this->data);
    }
    
    public function purchase_order()
    {
        echo $this->load->view('purchasing/purchase_order', null, true);
    }
}
?>