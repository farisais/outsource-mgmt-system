<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payroll extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "payroll", true);
        $this->load->model('payroll_model');
        $this->load->model('payroll_periode_model');
    }

    function get_payroll_list()
    {
        echo "{\"data\" : " . json_encode($this->payroll_model->get_payroll_all()) . "}";
    }

    function init_create_payroll()
    {
        return null;
    }
    public function get_wo_list_all()
    {
       echo "{\"data\" : " . json_encode($this->payroll_periode_model->get_wo_all()) . "}";
    }

    function init_view_detail_payroll($id, $wo, $date_start, $date_finished)
    {
        $data = array();
        $data['date_start']= $date_start;
        $data['date_finished'] = $date_finished;
        $data['id_work_order'] = $wo;
        $data['id_payroll_periode'] = $id;

        return $data;
    }

    public function generate_payslip()
    {

    }

}
