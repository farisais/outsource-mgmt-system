<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of overtime_model
 *
 * @author Sapta
 */
class Overtime_model extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_overtime_all(){
        $this->db->select('o.*,e.full_name,ee.full_name as nama_suvervisor');
        $this->db->from('overtime AS o');
        $this->db->join('employee AS ee', 'ee.id_employee=o.supervisor', 'LEFT');
        $this->db->join('employee AS e', 'e.id_employee=o.id_security', 'LEFT');
        return $this->db->get()->result_array();
    }
    
    public function save_overtime($data){
        $this->db->trans_start();        
        
        $date_overtime = explode("/",$data['date_overtime']);
        $date_overtime = $date_overtime[1]."/".$date_overtime[0]."/".$date_overtime[2];
        
        $data = array(
            'id_security' => $data['id_security'],
            'date_overtime' => date("Y-m-d",strtotime($date_overtime)),
            'from_overtime' => $data['from_overtime'],
            'to_overtime' => $data['to_overtime'],
            'hours_overtime' => $data['hours_overtime'],
            'supervisor' => $data['supervisor'],
            'description' => $data['description']
        );

        $this->db->insert('overtime', $data);
        $this->db->trans_complete();
    }
    
    public function edit_overtime($data){
        $this->db->trans_start();
        
        $date_overtime = explode("/",$data['date_overtime']);
        $date_overtime = $date_overtime[1]."/".$date_overtime[0]."/".$date_overtime[2];
        
        $data_input = array(
            'id_security' => $data['id_security'],
            'date_overtime' => date("Y-m-d",strtotime($date_overtime)),
            'from_overtime' => $data['from_overtime'],
            'to_overtime' => $data['to_overtime'],
            'hours_overtime' => $data['hours_overtime'],
            'supervisor' => $data['supervisor'],
            'description' => $data['description']
        );

        $this->db->where('id_overtime', $data['id_overtime']);
        $this->db->update('overtime', $data_input);

        $this->db->trans_complete();
    }
    public function validate_overtime($data){
        $this->db->trans_start();
        
        $data_input = array(
            'status' => 'validated'
        );

        $this->db->where('id_overtime', $data['id_overtime']);
        $this->db->update('overtime', $data_input);

        $this->db->trans_complete();
    }
    public function get_edit_overtime($id){
        $this->db->select('o.*,e.full_name,ee.full_name as nama_suvervisor');
        $this->db->from('overtime AS o');
        $this->db->join('employee AS ee', 'ee.id_employee=o.supervisor', 'LEFT');
        $this->db->join('employee AS e', 'e.id_employee=o.id_security', 'LEFT');
        $this->db->where("o.id_overtime", $id);
        //$this->db->where("id_payroll_periode", 2);
       // $this->db->from('overtime');
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
    
    public function delete_overtime(){
        $this->db->trans_start();
        $this->db->where('id_overtime', $this->input->post('id_overtime'));
        $this->db->delete('overtime');
        $this->db->trans_complete();
    }
    
    public function get_security_all(){
        $this->db->from('employee');
        return $this->db->get()->result_array();
    }
    
    public function get_timesheet_for_overtime($id)
    {
        $query = "select ot.*, t.*, tg.date as timesheet_date, sa.work_order_id, wo.project_name, if((t.in is not NULL) and (t.out is not NULL), if((TIME_TO_SEC(TIMEDIFF(t.out, t.in)) / 3600) < 0 , 24 + (TIME_TO_SEC(TIMEDIFF(t.out, t.in)) / 3600) , (TIME_TO_SEC(TIMEDIFF(t.out, t.in)) / 3600)), NULL) as working_hour 
        ,if(ABS(TIME_TO_SEC(TIMEDIFF(t.out, ot.to_overtime))) > (10 * 60), 'not_match', 'match') as ot_status, ABS(TIME_TO_SEC(TIMEDIFF(t.out, ot.to_overtime))) as diff 
        from overtime as ot 
        inner join so_assignment as sa on sa.so_assignment_number=ot.id_security 
        inner join work_order as wo on wo.id_work_order=sa.work_order_id 
        inner join timesheet as t on t.employee_number=ot.id_security 
        inner join timesheet_group as tg on tg.id=t.timesheet_group_id 
        where ot.id_overtime = " . $id . " and tg.date = ot.date_overtime";
        
        return $this->db->query($query)->result_array();
    }
}
