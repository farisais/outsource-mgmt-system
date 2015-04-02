<?php if(!defined('BASEPATH')) exit('No direct script access is allowed');
Class Template
{
	var $ci;
	var $navmenu;
	var $nav_view_path;
	function __construct()
	{
		$this->ci =& get_instance();
	}
	
	function load($tpl_view, $body_view = null, $data = null)
	{
		if(is_null($this->navmenu) || $this->navmenu == '')
		{	
			$navmenu = 'Navigation menu view is missing';
		}
		
		if(! is_null($body_view))
		{
			if(file_exists(APPPATH . 'views/' . $tpl_view . '/' . $body_view))
			{
				$body_view_path = $tpl_view . '/' . $body_view;
			}
			else if(file_exists(APPPATH . 'views/' . $tpl_view . '/' . $body_view . '.php'))
			{
				$body_view_path = $tpl_view . '/' . $body_view . '.php'; 
			}
			else if(file_exists(APPPATH . 'views/' . $body_view))
			{
				$body_view_path = $body_view;
			}
			else if(file_exists(APPPATH . 'views/' . $body_view . '.php'))
			{
				$body_view_path = $body_view . '.php';
			}
			else
			{
				show_error('Unable to load the requested file: ' . $tpl_name . '/' . $view_name . '.php');
			}
			$body = $this->ci->load->view($body_view_path, $data, TRUE);
			
			if(!is_null($this->nav_view_path))
			{
				$this->navmenu = $this->ci->load->view($this->nav_view_path, $data, TRUE);
			}
			
			if(is_null($data))
			{
				$data = array('body' => $body, 'navmenu' => $this->navmenu);
			}
			else if(is_array($data))
			{
				$data['body'] = $body;
				$data['navmenu'] = $this->navmenu;
			}
			else if(is_object($data))
			{
				$data->body = $body;
				$data->navmenu = $this->navmenu;
			}
		}
		$this->ci->load->view('templates/' . $tpl_view, $data);
	}
	
	function setNav($nav_base_path, $nav_view = null)
	{
		if(! is_null($nav_view))
		{
			if(file_exists(APPPATH . 'views/' . $nav_base_path . '/' . $nav_view))
			{
				$this->nav_view_path = $nav_base_path . '/' . $nav_view;
			}
			else if(file_exists(APPPATH . 'views/' .$nav_base_path . '/' . $nav_view . '.php'))
			{
				$this->nav_view_path = $nav_base_path . '/' . $nav_view . '.php'; 
			}
			else if(file_exists(APPPATH . 'views/' . $nav_view))
			{
				$this->nav_view_path = $nav_view;
			}
			else if(file_exists(APPPATH . 'views/' . $nav_view . '.php'))
			{
				$this->nav_view_path = $nav_view . '.php';
			}
			else
			{
				show_error('Unable to load the requested file: ' . $nav_base_path . '/' . $nav_view . '.php');
			}
		}
	}
}
?>