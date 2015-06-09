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
            'date_finish' => date("Y-m-d",strtotime($tglakhir)),
			'payroll_type' => $data['payroll_type']
        );

        $this->db->insert('payroll_periode', $data);
        $this->db->trans_complete();
    }

    public function get_edit_payroll_periode($id)
    {
        $this->db->where("id_payroll_periode", $id);
        $this->db->from('payroll_periode');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data = $row;
            }
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function get_wo_payroll_by_wo($id, $wo)
    {
        $this->db->select('*');
        $this->db->from('payroll_wo');
        $this->db->where('work_order_id', $wo);
        $this->db->where('payroll_periode_id', $id);

        return $this->db->get()->result_array();
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
    
     public function get_wo_list($date_start,$date_finish,$id) {
        $query_list_wo=$this->db->query("
        SELECT work_order.*,so.so_number,ext_company.name AS customer_name,
        payroll_wo.id as id_payroll_wo,payroll_wo.status_po,
        payroll_periode.periode_name
        FROM work_order
        JOIN payroll_wo ON payroll_wo.work_order_id=work_order.id_work_order
        JOIN payroll_periode ON payroll_periode.id_payroll_periode=payroll_wo.payroll_periode_id
        LEFT JOIN so ON so.id_so=work_order.so 
        JOIN ext_company ON ext_company.id_ext_company = work_order.customer
        WHERE '$date_start' BETWEEN work_order.contract_startdate AND work_order.contract_expdate
        AND work_order.status='running'
        AND payroll_wo.payroll_periode_id='$id'
        ");
        $result_list_wo = $query_list_wo->result_array();
        if(count($result_list_wo > 0)){
            foreach($result_list_wo as $key=>$value)
            {
                $total_salary=0;
                $total_salary_all_employee=$this->total_salary_all_employee($value['id_work_order'],$id,$date_start,$date_finish);
                foreach($total_salary_all_employee as $values){
                    $total_salary+=$values['total_salary_each_employee'];
                }
                $result_list_wo[$key]['total_amount_salary']=$total_salary;
            }
        }
        return $result_list_wo;
    }

    public function get_wo_list_invoice()
    {
        $query_list_wo=$this->db->query("
        SELECT 	work_order.project_name,work_order.contract_startdate,work_order.contract_expdate,work_order.id_work_order,
				so.so_number,ext_company.name AS customer_name,
        payroll_wo.id as id_payroll_wo,payroll_wo.status_po,
        payroll_periode.periode_name,payroll_periode.date_start,payroll_periode.date_finish,payroll_periode.id_payroll_periode, payroll_periode.payroll_type 
        FROM work_order
        JOIN payroll_wo ON payroll_wo.work_order_id=work_order.id_work_order
        JOIN payroll_periode ON payroll_periode.id_payroll_periode=payroll_wo.payroll_periode_id
        LEFT JOIN so ON so.id_so=work_order.so
        JOIN ext_company ON ext_company.id_ext_company = work_order.customer
        WHERE payroll_wo.status_po='approve' or payroll_wo.status_po='generated'
        ");
        $result_list_wo = $query_list_wo->result_array();

        if(count($result_list_wo > 0)){
            foreach($result_list_wo as $key=>$value)
            {
                $total_invoice = 0;
                $total_invoice_all_employee = $this->total_invoice_all_employee($value['id_work_order'],$value['id_payroll_periode'],$value['date_start'],$value['date_finish']);
                foreach($total_invoice_all_employee as $values)
                {
                    $total_invoice += $values['total_invoice'];
                }
                $result_list_wo[$key]['total_invoice'] = $total_invoice;
            }
        }
        return $result_list_wo;
    }

    public function get_wo_all()
    {
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
                $total_salary_all_employee=$this->total_salary_all_employee($value['id_work_order'],$value['id_payroll_periode'],$value['date_start'],$value['date_finish']);
                foreach($total_salary_all_employee as $values)
                {
                    $total_salary+=$values['total_salary_each_employee'];
                }
                $result_list_wo[$key]['total_amount_salary']=$total_salary;
            }
        }

        return $result_list_wo;
    }

    public function get_work_order_allX($date_start,$date_finish)
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
    function get_detail_salary_per_employeeX($date_start,$date_finish,$id_wo){
        $query=$this->db->query("SELECT
        work_order.contract_startdate,work_order.contract_expdate,
        employee.id_employee,employee.full_name,employee.organisation_structure_id,employee.position_level,
        (SELECT base_value 
        FROM wo_salary_setting
        WHERE structure_org_id=employee.organisation_structure_id 
        AND level_employee_id=employee.position_level
        AND salary_type_id=1
        AND wo_salary_setting.work_order_id=$id_wo) as total_salary,
        (
        SELECT 
				IF(
				(
				SELECT ISNULL(
				(SELECT base_value 
								FROM wo_salary_setting
								WHERE structure_org_id=employee.organisation_structure_id 
								AND level_employee_id=employee.position_level
								AND salary_type_id=2
								AND wo_salary_setting.work_order_id=$id_wo)
				)
				)
				=1,0,(SELECT base_value 
								FROM wo_salary_setting
								WHERE structure_org_id=employee.organisation_structure_id 
								AND level_employee_id=employee.position_level
								AND salary_type_id=2
								AND wo_salary_setting.work_order_id=$id_wo)
				)
        ) 
				as base_salary_overtime,
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
    function approve_payroll($id_payroll_periode)
    {
        $this->db->trans_start();
        $data_input = array(
            'status_po' => 'approve'
            );

        $this->db->where('payroll_periode_id', $id_payroll_periode);
        $this->db->update('payroll_wo', $data_input);

        $this->db->trans_complete();
    }

    public function get_work_order_all($date_start,$date_finish,$id_payroll_periode){
        //var_dump($id_payroll_periode);
        // mendapatkan list work order beserta jumlah salary yang di keluarkan
       
        $query_list_wo=$this->db->query("
        SELECT work_order.*,so.so_number,ext_company.name AS customer_name
        FROM work_order
        LEFT JOIN so ON so.id_so=work_order.so
        JOIN ext_company ON ext_company.id_ext_company = work_order.customer
        WHERE '$date_start' BETWEEN work_order.contract_startdate AND work_order.contract_expdate
        AND work_order.status='running'
        ");
        $result_list_wo = $query_list_wo->result_array();
        if(count($result_list_wo > 0)){
            foreach($result_list_wo as $key=>$value)
            {
                $total_salary=0;
                $total_salary_all_employee=$this->total_salary_all_employee($value['id_work_order'],$id_payroll_periode,$date_start,$date_finish);
                foreach($total_salary_all_employee as $values)
                {
                    $total_salary+=$values['total_salary_each_employee'];
                }
                $result_list_wo[$key]['total_amount_salary']=$total_salary;
            }
        }
        return $result_list_wo;
    }

    public function total_salary_all_employee($id_work_order, $id_payroll_periode, $date_start,$date_finish)
    {
        // list employe pada satu work order
        $ci =& get_instance();
        $ci->load->model('work_order_model');
		
		$query = "select payroll_type from payroll_periode where id_payroll_periode=$id_payroll_periode";
		$payroll_type = $this->db->query($query)->result_array();

        $query_list_employee=$this->db->query("
        SELECT so_assignment.*
        ,employee.full_name,employee.position_level,employee.organisation_structure_id,employee.id_employee, employee.employee_number
        FROM so_assignment
        JOIN employee ON employee.id_employee=so_assignment.so_assignment_number
        WHERE so_assignment.work_order_id=$id_work_order
        ");
        $result_list_employee = $query_list_employee->result_array();

        if(count($result_list_employee > 0)){
            foreach($result_list_employee as $key=>$value)
            {
                $ce = $ci->work_order_model->get_wo_ce_by_structure($id_work_order, $value['organisation_structure_id']);

                $overtime_hour = $this->total_overtime_each_employee($value['so_assignment_number'],$date_start,$date_finish);
                $overtime_hour = (count($overtime_hour) == 0 ? 0 : $overtime_hour[0]['total_overtime']);
				
                $total_insentive_each_employee = $this->total_insentive_each_employee($value['so_assignment_number'],$id_payroll_periode);

                $salary_list = $this->calculate_salary_each_employee($ce[0]['cost_element'], $overtime_hour, $payroll_type[0]['payroll_type']);
                $elemen_insentive = isset($total_insentive_each_employee[0]['nominal']) != '' ? $total_insentive_each_employee[0]['nominal'] : 0;
                $total_potongan = 0;

                $total_salary= ($elemen_insentive + $salary_list['total']) - $total_potongan;

				
                $result_list_employee[$key]['total_salary_each_employee'] = $total_salary;
                $result_list_employee[$key]['net_salary_each_employee'] = $salary_list['element_category']['thp'];
                $result_list_employee[$key]['overtime'] = $overtime_hour;
                $result_list_employee[$key]['insentive'] = $elemen_insentive;
                $result_list_employee[$key]['jamsostek'] = $salary_list['element_category']['jamsostek'];
                $result_list_employee[$key]['pph'] = $salary_list['element_category']['pph'];
            }
        }
		
		$filter_list_employee = array();
		
		foreach($result_list_employee as $r)
		{
			if($r['total_salary_each_employee'] != 0)
			{
				array_push($filter_list_employee, $r);
			}
		}

        return $filter_list_employee;
    }

    public function total_invoice_all_employee($id_work_order, $id_payroll_periode, $date_start,$date_finish)
    {
        // list employe pada satu work order
        $ci =& get_instance();
        $ci->load->model('work_order_model');
		
		$query = "select payroll_type from payroll_periode where id_payroll_periode=$id_payroll_periode";
		$payroll_type = $this->db->query($query)->result_array();
		
        $query_list_employee=$this->db->query("
        SELECT so_assignment.*
        ,employee.full_name,employee.position_level,employee.organisation_structure_id,employee.id_employee, employee.employee_number
        FROM so_assignment
        JOIN employee ON employee.id_employee=so_assignment.so_assignment_number
        WHERE so_assignment.work_order_id=$id_work_order
        ");
        $result_list_employee = $query_list_employee->result_array();

        if(count($result_list_employee > 0)){
            foreach($result_list_employee as $key=>$value)
            {
                $ce = $ci->work_order_model->get_wo_ce_by_structure($id_work_order, $value['organisation_structure_id']);

                $overtime_hour = $this->total_overtime_each_employee($value['so_assignment_number'],$date_start,$date_finish);
                $overtime_hour = (count($overtime_hour) == 0 ? 0 : $overtime_hour[0]['total_overtime']);
                $invoice_list = $this->calculate_invoice_each_employee($ce[0]['cost_element'], $overtime_hour, $payroll_type[0]['payroll_type']);

                $result_list_employee[$key]['total_invoice'] = $invoice_list['total'];
            }
        }

        return $result_list_employee;
    }

    public function get_invoice_all_employee($id_work_order, $id_payroll_periode)
    {
        // list employe pada satu work order
        $ci =& get_instance();
        $ci->load->model('work_order_model');
		
		$query = "select * from payroll_periode where id_payroll_periode=$id_payroll_periode";
		$payroll_type = $this->db->query($query)->result_array();

        $query_list_employee=$this->db->query("
        SELECT COUNT(organisation_structure_id) as qty, so_assignment.*, os.structure_name, pd.product, p.unit, p.id_product, p.product_name, um.name as unit_name
        ,employee.full_name,employee.position_level,employee.organisation_structure_id,employee.id_employee, employee.employee_number
        FROM so_assignment
        JOIN employee ON employee.id_employee=so_assignment.so_assignment_number
        JOIN organisation_structure AS os ON os.id_organisation_structure=employee.organisation_structure_id
        JOIN product_definition AS pd ON pd.organisation_structure=employee.organisation_structure_id
        JOIN product AS p ON p.id_product=pd.product 
        JOIN unit_measure AS um ON um.id_unit_measure=p.unit
        WHERE so_assignment.work_order_id=$id_work_order GROUP BY organisation_structure_id ORDER BY organisation_structure_id ASC
        ");
        $result_list_employee = $query_list_employee->result_array();

        $employee_invoice = array();
		
        if(count($result_list_employee > 0)){
            foreach($result_list_employee as $key=>$value)
            {
                $ce = $ci->work_order_model->get_wo_ce_by_structure($id_work_order, $value['organisation_structure_id']);
				$overtime_hour = $this->total_overtime_each_employee($value['so_assignment_number'],$payroll_type[0]['date_start'],$payroll_type[0]['date_finish']);
                $overtime_hour = (count($overtime_hour) == 0 ? 0 : $overtime_hour[0]['total_overtime']);
                $invoice_list = $this->calculate_invoice_each_employee($ce[0]['cost_element'], $overtime_hour, $payroll_type[0]['payroll_type']);

                $result_list_employee[$key]['price'] = $invoice_list['cogs'];
				$result_list_employee[$key]['ppn'] = $invoice_list['element_category']['ppn'];
				$result_list_employee[$key]['profit'] = $invoice_list['element_category']['profit'];
            }
        }

        return $result_list_employee;
    }


    public function calculate_salary_each_employee($ce, $total_overtime, $payroll_type)
    {
        $ci =& get_instance();
        $ci->load->model('cost_element_model');
        $data = array();
        $data['overtime'] = $total_overtime;
        $return = $ci->cost_element_model->calculate_salary($ce, $data, $payroll_type);
        return $return;
    }

    public function calculate_invoice_each_employee($ce, $total_overtime, $payroll_type)
    {
        $ci =& get_instance();
        $ci->load->model('cost_element_model');
		$data['overtime'] = $total_overtime;
        $return = $ci->cost_element_model->calculate_invoice('per_month', $ce, $data, $payroll_type);
        return $return;
    }

    //public function total_salary_each_employee($id_work_order,$id_employee,$level,$struktur_org,$id_payroll_periode,$date_start,$date_finish){
    public function total_salary_each_employee($id_employee,$date_start,$date_finish){
        
    }
    public function total_insentive_each_employee($id_employee,$id_periode)
    {
        $query=$this->db->query("
        SELECT SUM(nominal) as nominal FROM insentive WHERE employee_id=$id_employee
        AND insentive.payroll_periode_id=$id_periode
        ");
        return $query->result_array();
    }
    public function total_overtime_each_employee($id_employee,$date_start,$date_finish)
    {
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
    
    public function detail_pop_up_salary($id_employee,$date_start,$date_finish, $struktur, $level, $id_work_order, $id_payroll_periode)
    {
        return $this->get_detail_salary($id_employee,$date_start,$date_finish, $struktur, $level, $id_work_order, $id_payroll_periode);
    }

    public function get_detail_salary($id_employee,$date_start,$date_finish, $struktur, $level, $id_work_order, $id_payroll_periode)
    {
        $ci =& get_instance();
        $ci->load->model('work_order_model');
		
		$query = "select payroll_type from payroll_periode where id_payroll_periode=$id_payroll_periode";
		$payroll_type = $this->db->query($query)->result_array();

        $ce = $ci->work_order_model->get_wo_ce_by_structure($id_work_order, $struktur);

        $overtime_list = $this->total_overtime_each_employee($id_employee,$date_start,$date_finish);
        $overtime_hour = (count($overtime_list) > 0 ? $overtime_list[0]['total_overtime'] : 0);

        $salary_list = $this->calculate_salary_each_employee($ce[0]['cost_element'], $overtime_hour, $payroll_type[0]['payroll_type']);

        $total_insentive_each_employee=$this->total_insentive_each_employee($id_employee,$id_payroll_periode);
        $elemen_insentive = (count($total_insentive_each_employee) > 0 ? $total_insentive_each_employee[0]['nominal'] : 0);

        return $salary_list;
    }
    
}
