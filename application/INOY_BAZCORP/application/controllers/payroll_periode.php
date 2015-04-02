<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payroll_periode
 *
 * @author Sapta
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payroll_periode extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct('authorize', 'payroll_periode', true);

        //$this->load->model('appsetting_model');
        $this->load->model('payroll_periode_model');
    }

    public function get_payroll_periode_list() {
        echo "{\"data\" : " . json_encode($this->payroll_periode_model->get_payroll_periode_all()) . "}";
    }

    public function payroll_periode_show() {
        echo $this->load->view('payroll_periode/payroll_periode_list', null, true);
    }

    public function index() {
        
    }

    public function create_payroll_periode() {
        
    }

    public function save_payroll_periode() {
        if ($this->input->post('is_edit') == 'true') {
            $this->payroll_periode_model->edit_payroll_periode($this->input->post());
        } else {
            $this->payroll_periode_model->save_payroll_periode($this->input->post());
        }

        return null;
    }

   

    public function delete_payroll_periode() {
        $this->payroll_periode_model->delete_payroll_periode();
        return null;
    }
     public function init_edit_payroll_periode() {        
        $data = array(
            'data_edit' => $this->payroll_periode_model->get_edit_payroll_periode(),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function update_payroll_po(){
        $id_wo=explode(",",$this->input->post('id_wo'));
        $idpayrollperiode=$this->input->post('idpayrollperiode');
        for($i=0;$i<count($id_wo);$i++){
        $data=array(
            'payroll_periode_id'=>$idpayrollperiode,
            'work_order_id'=>$id_wo[$i]
        );
        $this->db->insert('payroll_wo',$data);
        }
        echo $idpayrollperiode;
    }
    
    public function get_wo_list(){
        $date_start=$this->uri->segment(3);
        $date_finish=$this->uri->segment(4);
        $id_periode=$this->uri->segment(5);
       echo "{\"data\" : " . json_encode($this->payroll_periode_model->get_wo_list($id_periode,$date_start,$date_finish)) . "}";
    }
    
    public function delete_payroll_po(){
        $id_wo=$this->input->post('id_wo');
        $idpayrollperiode=$this->input->post('idpayrollperiode');
        $this->db->query("delete from payroll_wo where id in ($id_wo)");
    
        echo $idpayrollperiode;
    }
    public function get_work_order_list()
    {
        $date_start=$this->uri->segment(3);
        $date_finish=$this->uri->segment(4);
        echo "{\"data\" : " . json_encode($this->payroll_periode_model->get_work_order_all($date_start,$date_finish)) . "}";
    }
    function init_view(){

        $data['date_start']=$this->input->post('date_start');
        $data['date_finished']=$this->input->post('date_finished');
        $data['id_work_order']=$this->input->post('id_work_order');
        //$total_amount_salary=$this->payroll_periode_model->get_detail_salary_per_employee($date_start,$date_finish,$id_work_order);
        //$data['total_amount_salary']= "{\"data\" : " . json_encode($this->payroll_periode_model->get_detail_salary_per_employee($date_start,$date_finish,$id_work_order)) . "}";    
        return $data;
    }
    function view_detail_wo(){
        $date_start=$this->uri->segment(3);
        $date_finished=$this->uri->segment(4);
        $id_work_order=$this->uri->segment(5);
        //$total_amount_salary=$this->payroll_periode_model->get_detail_salary_per_employee($date_start,$date_finish,$id_work_order);
        echo "{\"data\" : " . json_encode($this->payroll_periode_model->get_detail_salary_per_employee($date_start,$date_finished,$id_work_order)) . "}";    
        //return $data;
    }

}
