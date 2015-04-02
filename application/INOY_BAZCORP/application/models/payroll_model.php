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
        
        $query=$this->db->query("SELECT work_order.*,so.so_number,ext_company.name AS customer_name,
        payroll_wo.id as id_payroll_wo,
        payroll_periode.periode_name,payroll_periode.date_start,payroll_periode.date_finish
        FROM work_order
        JOIN payroll_wo ON payroll_wo.work_order_id=work_order.id_work_order
        JOIN payroll_periode ON payroll_periode.id_payroll_periode=payroll_wo.payroll_periode_id
        LEFT JOIN so ON so.id_so=work_order.so JOIN ext_company ON ext_company.id_ext_company = work_order.customer
        AND work_order.`status`='running'
        "); 
        $result = $query->result_array();
        
        $base_salary_overtime=0;
        $total_overtime=0;
        $total_salary_overtime=0;
        $salary=0;
        
        foreach($result as $key=>$value)
        {   
            $total_salary=0;
            $total_amount_salary=$this->get_detail_salary_per_employee($value['id_work_order']);
            
            foreach($total_amount_salary as $values){
                $total_salary+=($values['base_salary_overtime'] * $values['total_overtime']) + $values['total_salary'];
            }
            $result[$key]['total_amount_salary']=$total_salary;
        }       
      return $result;
    }
    function get_detail_salary_per_employee($id_wo){
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
        
        ) as total_overtime
       
        FROM so_assignment
        JOIN work_order ON work_order.id_work_order=so_assignment.work_order_id
        Join employee ON employee.id_employee=so_assignment.so_assignment_number
        WHERE work_order.id_work_order=$id_wo
        ");
        return $query->result_array();
    }

}
