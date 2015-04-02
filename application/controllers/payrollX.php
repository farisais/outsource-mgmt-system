<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payroll extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "payroll", true);
        $this->load->model('payroll_model');
    }

    function get_payroll_list()
    {
        echo "{\"data\" : " . json_encode($this->payroll_model->get_payroll_all()) . "}";
    }

    function init_create_payroll()
    {
        return null;
    }


}
