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
    public function get_wo_list_all(){
       echo "{\"data\" : " . json_encode($this->payroll_model->get_wo_list()) . "}";
    }
    function init_view(){

        $data['date_start']=$this->input->post('date_start');
        $data['date_finished']=$this->input->post('date_finished');
        $data['id_work_order']=$this->input->post('id_work_order');
        return $data;
    }

}
