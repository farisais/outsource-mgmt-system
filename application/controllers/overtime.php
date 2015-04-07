<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of overtime
 *
 * @author Sapta
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Overtime extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct('authorize', 'overtime', true);

        //$this->load->model('appsetting_model');
        $this->load->model('overtime_model');
    }
    
    public function get_overtime_list() {
        echo "{\"data\" : " . json_encode($this->overtime_model->get_overtime_all()) . "}";
    }

    public function overtime_show() {
        echo $this->load->view('overtime/overtime_list', null, true);
    }
    
    public function save_overtime() {
        if ($this->input->post('is_edit') == 'true') {
            $this->overtime_model->edit_overtime($this->input->post());
        } else {
            $this->overtime_model->save_overtime($this->input->post());
        }

        return null;
    }

    public function init_edit_overtime($id) {        
        $data = array(
            'data_edit' => $this->overtime_model->get_edit_overtime($id),
            'is_edit' => true
        );
        
        return $data;
    }

    public function delete_overtime() {
        $this->overtime_model->delete_overtime();
        return null;
    }
    
    public function get_security_list()
    {
        echo "{\"data\" : " . json_encode($this->overtime_model->get_security_all()) . "}";
    }
    
    public function validate_overtime()
    {
        $this->overtime_model->validate_overtime($this->input->post());
         return null;
    }
    
    public function get_timesheet_for_overtime($id)
    {
        echo "{\"data\" : " . json_encode($this->overtime_model->get_timesheet_for_overtime($id)) . "}";
    }
}
