<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payslip extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "payroll", true);
        $this->load->model('payroll_model');
        $this->load->model('payroll_periode_model');
        $this->load->model('payslip_model');
    }

    function get_payslip_list()
    {
        echo "{\"data\" : " . json_encode($this->payslip_model->get_payslip_all()) . "}";
    }

    function init_view_payslip()
    {
        return null;
    }

    function init_view_detail_payslip($id)
    {
        return null;
    }

    public function generate_payslip()
    {

        $data = $this->input->post();
        return json_encode($this->payslip_model->generate_payslip($data['id_work_order'], $data['id_payroll_periode'], $data['date_start'], $data['date_finished']));

        //return null;
    }

}
