<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct(null, 'login');
	}
	
	public function log_me_in()
	{
		$this->load->model('login_model');
		$result = $this->login_model->validate();
		if(!$result)
		{
			$this->session->set_userdata('login_state', 'failed');
			redirect(base_url(''));
			//echo 'failed';
		}
		else
		{
			//echo $this->session->userdata('jms_job_type');
			
			$this->redirectUserLogin();
		}	
	}
	
	function log_me_out()
	{
		if($this->session->userdata('app_username'))
		{
			$this->session->sess_destroy();
		}
		redirect(base_url(''));
	}
}
?>