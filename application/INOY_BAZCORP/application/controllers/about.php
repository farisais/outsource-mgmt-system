<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class About extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->data['title'] = 'JMS | About';
		$this->data['subtitle'] = 'About JMS Web V.1.0';
		//$this->data['content'] = 'JMS Web V.1.0';
		$this->template->load('default', 'about/index', $this->data);
	}
}
?>