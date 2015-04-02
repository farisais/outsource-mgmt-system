<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends MY_Controller
{
    public function __construct()
	{
		parent::__construct('authorize', 'ajax');   
	}
    
    public function index()
    {
        
    }
}
?>
