<?php
class Payroll_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_payroll_all()
    {
        $this->db->select('*');
        $this->db->from('payroll');

        return $this->db->get()->result_array();
    }
     public function get_wo_list() {
        
        
        $query_list_wo=$this->db->query("
        SELECT 	work_order.project_name,work_order.contract_startdate,work_order.contract_expdate,work_order.id_work_order,
				so.so_number,ext_company.name AS customer_name,
        payroll_wo.id as id_payroll_wo,payroll_wo.status_po,
        payroll_periode.periode_name,payroll_periode.date_start,payroll_periode.date_finish,payroll_periode.id_payroll_periode
        FROM work_order
        JOIN payroll_wo ON payroll_wo.work_order_id=work_order.id_work_order
        JOIN payroll_periode ON payroll_periode.id_payroll_periode=payroll_wo.payroll_periode_id
        LEFT JOIN so ON so.id_so=work_order.so 
        JOIN ext_company ON ext_company.id_ext_company = work_order.customer
        WHERE payroll_wo.status_po='approve'
        ");
        $result_list_wo = $query_list_wo->result_array();
        if(count($result_list_wo > 0)){
            foreach($result_list_wo as $key=>$value)
            {
                $total_salary=0;
                $total_salary_all_employee=$this->get_detail_salary_per_employee($value['id_work_order'],$value['id_payroll_periode'],$value['date_start'],$value['date_finish']);
                foreach($total_salary_all_employee as $values){
                    $total_salary+=$values['total_salary_each_employee'];
                }
                $result_list_wo[$key]['total_amount_salary']=$total_salary;
            }
        }
        return $result_list_wo;
    }
    function get_detail_salary_per_employee($id_work_order,$id_payroll_periode,$date_start,$date_finish){
        $query_list_employee=$this->db->query("
        SELECT so_assignment.*
        ,employee.full_name,employee.position_level,employee.organisation_structure_id
        FROM so_assignment
        JOIN employee ON employee.id_employee=so_assignment.so_assignment_number
        WHERE so_assignment.work_order_id=$id_work_order
        ");
        $result_list_employee = $query_list_employee->result_array();
        $hasil=array();
        if(count($result_list_employee > 0)){
            foreach($result_list_employee as $key=>$value)
            {
                $total_salary=0;
                //total gaji setiap employee
                $total_salary_each_employee=$this->total_overtime_each_employee($value['so_assignment_number'],$date_start,$date_finish);
                $total_insentive_each_employee=$this->total_insentive_each_employee($value['so_assignment_number'],$id_payroll_periode);
                
                
                $elemen_overtime=isset($total_salary_each_employee[0]['total_overtime'])!='' ? $total_salary_each_employee[0]['total_overtime'] : 0;
                $elemen_insentive=isset($total_insentive_each_employee[0]['nominal']) != '' ? $total_insentive_each_employee[0]['nominal'] : 0;
                $total_potongan=0;
                
               $total_base_salary_each_employee=$this->total_base_salary_each_employee($value['position_level'],$value['organisation_structure_id'],$id_work_order,$elemen_overtime);
                $elemen_base_salary=isset($total_base_salary_each_employee[0]['total_salary'])!=''?$total_base_salary_each_employee[0]['total_salary'] : 0;
                
                $total_salary=($elemen_insentive + $elemen_base_salary)-$total_potongan;
                
                //}
                $result_list_employee[$key]['total_salary_each_employee']=$total_salary;
                //var_dump($result_list_employee);
                //array_push($hasil,$total_salary_each_employee['total_salary']);
            }
        }
        return $result_list_employee;
    }
    function get_combo_payroll(){
        $this->db->select('*');
        $this->db->from('payroll');

        return $this->db->get()->result_array();
    }
    public function total_insentive_each_employee($id_employee,$id_periode){
        $query=$this->db->query("
        SELECT SUM(nominal) as nominal FROM insentive WHERE employee_id=$id_employee
        AND insentive.payroll_periode_id=$id_periode
        ");
        return $query->result_array();
    }
    public function total_overtime_each_employee($id_employee,$date_start,$date_finish){
        $query=$this->db->query("
        SELECT SUM(overtime.hours_overtime) AS total_overtime FROM overtime
        WHERE overtime.id_security=$id_employee
        AND overtime.status='validated'
        AND overtime.date_overtime BETWEEN '$date_start' AND '$date_finish'
        ");
        return $query->result_array();
    }
    public function total_base_salary_each_employee($level,$struktur,$id_work_order,$var_total_perjam=0){
        $query=$this->db->query("
        SELECT SUM(
        CASE
            WHEN occurence='Per Bulan' THEN (base_value * 1)
            WHEN occurence='Per Jam' THEN (base_value * $var_total_perjam)
    		ELSE 0
            END) as total_salary 
        
        FROM wo_salary_setting 
        WHERE wo_salary_setting.level_employee_id=$level AND wo_salary_setting.structure_org_id=$struktur
        AND wo_salary_setting.work_order_id=$id_work_order
        ");
        return $query->result_array();
    }    
}
