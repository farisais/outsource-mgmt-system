<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cost_element extends MY_Controller
{

    function __construct()
    {
        parent::__construct("authorize", "cost_element", true);
        $this->load->model('cost_element_model');
        $this->load->model('quotation_model');
    }

    public function get_cost_element_list()
    {
        echo "{ \"data\" : " . json_encode($this->cost_element_model->get_cost_element_all()) . " }";
    }

    public function get_cost_element() {
        $id_quotation = $this->uri->segment(3);
        echo "{\"data\" : " . json_encode($this->quotation_model->get_cost_element($id_quotation)) . "}";
    }

    public function get_cost_element_detail() {
        $id_work_order = $this->uri->segment(3);
        echo "{\"data\" : " . json_encode($this->quotation_model->get_cost_element_detail()) . "}";
    }

    function init_view_cost_element($id_quote) 
    {
        $data = array(
            'data_edit' => $this->quotation_model->get_quotation_by_id($id_quote),
            'is_edit' => true,
            'id_quotation' => $this->input->post('id_quotation')
        );
        return $data;
    }

    function copy_cost_element() {
        $id_template = $this->input->post('id_template');
        $id_quotation = $this->input->post('id_quotation');
        $this->quotation_model->copy_cost_element($id_template, $id_quotation);
        echo 'success';
    }

    public function get_cost_element_template()
    {
        echo "{\"data\" : " . json_encode($this->cost_element_model->get_cost_element_template()) . "}";
    }

    public function get_cost_element_detail_template()
    {
        $id_work_order = $this->uri->segment(3);
        echo "{\"data\" : " . json_encode($this->cost_element_model->get_cost_element_detail_template()) . "}";
    }

    public function save_cost_element()
    {
        //var_dump($this->input->post());
        //die();
        //$this->quotation_model->save_cost_element($this->input->post());

        if($this->input->post('is_edit') == 'false')
        {
            $this->cost_element_model->save_cost_element($this->input->post());
        }
        else
        {
            $this->cost_element_model->edit_cost_element($this->input->post());
        }

        return null;
    }

    public function init_edit_cost_element($id)
    {
        $data = array();

        $data['data_edit'] = $this->cost_element_model->get_cost_element_by_id($id);
        $data['is_edit'] = true;

        return $data;
    }

    public function init_create_cost_element_template() 
    {
        return null;
    }

    public function edit_cost_element_template() {
        $data = array(
            'data_edit' => $this->cost_element_model->get_so_by_id($id),
            'is_edit' => 'true'
        );
        return $data;
    }

    public function delete_cost_element_template()
    {
        $this->cost_element_model->delete_so($this->input->post('id_so'));
        return null;
    }

    public function get_cost_element_detail_list()
    {
        echo "{\"data\" : " . json_encode($this->cost_element_model->get_cost_element_detail_ce($this->input->get('id'))) . "}";
    }

    public function init_view_detail_cost_element($id)
    {
        $data = array();

        $data['data_edit'] = $this->cost_element_model->get_cost_element_by_id($id);
        $data['is_edit'] = true;
        $data['is_view'] = 'true';

        return $data;
    }

    public function calculate_salary()
    {
        $data = $this->input->post();
        $result = $this->cost_element_model->calculate_salary($data['id_cost_element'], $data, $data['payroll_type']);

        echo json_encode($result);
    }
	
	public function calculate_invoice()
    {
        $data = $this->input->post();
        $result = $this->cost_element_model->calculate_invoice('per_month', $data['id_cost_element'], $data, $data['payroll_type']);

        echo json_encode($result);
    }

}
