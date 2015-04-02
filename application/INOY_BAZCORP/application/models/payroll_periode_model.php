<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payroll_periode_model
 *
 * @author Sapta
 */
class Payroll_periode_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function get_payroll_periode_all() {
        $this->db->from('payroll_periode');
        return $this->db->get()->result_array();
    }

    public function save_payroll_periode($data) {
        $this->db->trans_start();        
        
        $tglmulai = explode("/",$data['date_start']);
        $tglmulai = $tglmulai[1]."/".$tglmulai[0]."/".$tglmulai[2];
        $tglakhir = explode("/",$data['date_finish']);
        $tglakhir = $tglakhir[1]."/".$tglakhir[0]."/".$tglakhir[2];
        
        $data = array(
            'periode_name' => $data['periode_name'],
            'date_start' => date("Y-m-d",strtotime($tglmulai)),
            'date_finish' => date("Y-m-d",strtotime($tglakhir))
        );

        $this->db->insert('payroll_periode', $data);
        $this->db->trans_complete();
    }

    public function get_edit_payroll_periode() {
        $this->db->where("id_payroll_periode", $this->input->post("id_payroll_periode"));
        //$this->db->where("id_payroll_periode", 2);
        $this->db->from('payroll_periode');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    public function edit_payroll_periode($data) {
        $this->db->trans_start();
        
        $tglmulai = explode("/",$data['date_start']);
        $tglmulai = $tglmulai[1]."/".$tglmulai[0]."/".$tglmulai[2];
        $tglakhir = explode("/",$data['date_finish']);
        $tglakhir = $tglakhir[1]."/".$tglakhir[0]."/".$tglakhir[2];
        
        $data_input = array(
            'periode_name' => $data['periode_name'],
            'date_start' => date("Y-m-d",strtotime($tglmulai)),
            'date_finish' => date("Y-m-d",strtotime($tglakhir))
        );

        $this->db->where('id_payroll_periode', $data['id_payroll_periode']);
        $this->db->update('payroll_periode', $data_input);

        $this->db->trans_complete();
    }

    public function delete_payroll_periode() {
        $this->db->trans_start();
        $this->db->where('id_payroll_periode', $this->input->post('id_payroll_periode'));
        $this->db->delete('payroll_periode');

        $this->db->trans_complete();
    }
    
     public function get_wo_list($id,$date_start,$date_finish) {
        
        $query=$this->db->query("SELECT work_order.*,so.so_number,ext_company.name AS customer_name,
        payroll_wo.id as id_payroll_wo,
        payroll_periode.periode_name
        FROM work_order
        JOIN payroll_wo ON payroll_wo.work_order_id=work_order.id_work_order
        JOIN payroll_periode ON payroll_periode.id_payroll_periode=payroll_wo.payroll_periode_id
        LEFT JOIN so ON so.id_so=work_order.so JOIN ext_company ON ext_company.id_ext_company = work_order.customer
        WHERE '$date_start' BETWEEN work_order.contract_startdate AND work_order.contract_expdate
        AND work_order.`status`='running'
        AND payroll_wo.payroll_periode_id='$id'"); 
        $result = $query->result_array();
        //var_dump($result);die();
        
        $base_salary_overtime=0;
        $total_overtime=0;
        $total_salary_overtime=0;
        $salary=0;
        
        foreach($result as $key=>$value)
        {   
            $total_salary=0;
            $total_amount_salary=$this->get_detail_salary_per_employee($date_start,$date_finish,$value['id_work_order']);
            
            foreach($total_amount_salary as $values){
                $total_salary+=($values['base_salary_overtime'] * $values['total_overtime']) + $values['total_salary'];
            }
            $result[$key]['total_amount_salary']=$total_salary;
        }       
      return $result;
    }
    public function get_work_order_all($date_start,$date_finish)
    {
        //$query_detail_salary_per_employee=$this->get_detail_salary_per_employee($date_start,$date_finish);
        $query=$this->db->query("SELECT work_order.*,so.so_number,ext_company.name AS customer_name
        FROM work_order
        LEFT JOIN so ON so.id_so=work_order.so JOIN ext_company ON ext_company.id_ext_company = work_order.customer
        WHERE '$date_start' BETWEEN work_order.contract_startdate AND work_order.contract_expdate
        AND work_order.`status`='running'"); 
        $result = $query->result_array();
        //var_dump($result);die();
        
        $base_salary_overtime=0;
        $total_overtime=0;
        $total_salary_overtime=0;
        $salary=0;
        
        foreach($result as $key=>$value)
        {   
            $total_salary=0;
            $total_amount_salary=$this->get_detail_salary_per_employee($date_start,$date_finish,$value['id_work_order']);
            
            foreach($total_amount_salary as $values){
                $total_salary+=($values['base_salary_overtime'] * $values['total_overtime']) + $values['total_salary'];
            }
            $result[$key]['total_amount_salary']=$total_salary;
        }       
      return $result;
	}
    function get_detail_salary_per_employee($date_start,$date_finish,$id_wo){
        $query=$this->db->query("SELECT
        work_order.contract_startdate,work_order.contract_expdate,
        employee.id_employee,employee.full_name,employee.organisation_structure_id,employee.position_level,
        (SELECT value 
        FROM wo_salary_setting
        WHERE structure_org_id=employee.organisation_structure_id 
        AND level_employee_id=employee.position_level
        AND salary_type_id=1
        AND wo_salary_setting.work_order_id=$id_wo) as total_salary,
        (
        SELECT value 
        FROM wo_salary_setting
        WHERE structure_org_id=employee.organisation_structure_id 
        AND level_employee_id=employee.position_level
        AND salary_type_id=2
        AND wo_salary_setting.work_order_id=$id_wo
        ) as base_salary_overtime,
        (
        SELECT IF(SUM(hours_overtime) > 0,SUM(hours_overtime),0) FROM overtime
        WHERE 
        overtime.status='validated'
        AND overtime.id_security=employee.id_employee
        AND date_overtime BETWEEN '$date_start' AND '$date_finish'
        ) as total_overtime
       
        FROM so_assignment
        JOIN work_order ON work_order.id_work_order=so_assignment.work_order_id
        Join employee ON employee.id_employee=so_assignment.so_assignment_number
        WHERE work_order.id_work_order=$id_wo
        ");
        return $query->result_array();
    }
}
