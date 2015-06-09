<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tax extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'tax', true);
        $this->load->model('payslip_model');
	}
	
	public function index()
	{

	}
    
    public function get_tax_report_all()
    {
        echo "{\"data\":" .json_encode($this->payslip_model->get_tax_report_all()). "}";
    }
    
   
}
?>