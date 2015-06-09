<?php
class Payslip_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generate_payslip($wo, $payroll_periode, $date_start, $date_finished)
    {
        $ci =& get_instance();
        $ci->load->model('payroll_periode_model');


        $this->db->trans_start();

        $salary_summary = $ci->payroll_periode_model->total_salary_all_employee($wo, $payroll_periode, $date_start, $date_finished);

        foreach($salary_summary as $ps)
        {
            $data_input = array();
            $data_input['employee'] = $ps['id_employee'];
            $data_input['total_gross'] = $ps['total_salary_each_employee'];
            $data_input['total_thp'] = $ps['net_salary_each_employee'];
            $data_input['total_overtime'] = $ps['overtime'];
            $data_input['pph'] = $ps['pph'];
            $data_input['jamsostek'] = $ps['jamsostek'];
            $data_input['date_start'] = $date_start;
            $data_input['date_finished'] = $date_finished;
            $data_input['work_order'] = $wo;
            $data_input['payroll_periode'] = $payroll_periode;
            $data_input['status'] = 'generated';

            $this->db->insert('payslip', $data_input);
            $insert_id = $this->db->insert_id();

            $this->insert_detail_payslip($insert_id, $ps['id_employee'], $date_start, $date_finished, $wo, $payroll_periode);
        }

        $this->change_wo_payroll_status($wo, $payroll_periode, "generated");

        $this->db->trans_complete();

    }

    public function change_wo_payroll_status($wo, $pp, $status)
    {
        $this->db->where('work_order_id', $wo);
        $this->db->where('payroll_periode_id', $pp);
        $this->db->update('payroll_wo', array("status_po" => $status));
    }

    public function insert_detail_payslip($id, $employee, $date_start, $date_finished, $wo, $payroll_periode)
    {
        $query = "select * from employee where id_employee = " . $employee;
        $emp = $this->db->query($query)->result_array();
        $ci =& get_instance();
        $ci->load->model('payroll_periode_model');
        $detail_salary = $ci->payroll_periode_model->get_detail_salary($employee ,$date_start,$date_finished, $emp[0]['organisation_structure_id'], $emp[0]['position_level'], $wo, $payroll_periode);
        foreach($detail_salary['detail_calculation'] as $d)
        {
            $data = array();
            $data['cost_element'] = $d['remark'];
            $data['ce_name'] = $d['name'];
            $data['qty'] = $d['qty'];
            $data['value'] = $d['calc_value'];
            $data['payslip'] = $id;

            $this->db->insert('detail_payslip', $data);
        }
    }

    public function get_payslip_all()
    {
        $query = "select p.*, e.employee_number, e.full_name, e.organisation_structure_id as structure, os.structure_name, wo.work_order_number, wo.customer,
                  ec.name as customer_name, pp.periode_name, pp.payroll_type from payslip as p
                  inner join employee as e on e.id_employee=p.employee
                  inner join organisation_structure as os on os.id_organisation_structure=e.organisation_structure_id
                  inner join work_order as wo on wo.id_work_order=p.work_order
                  inner join payroll_periode as pp on pp.id_payroll_periode=p.payroll_periode
                  inner join ext_company as ec on ec.id_ext_company=wo.customer";

        return $this->db->query($query)->result_array();
    }
	
	public function get_tax_report_all()
	{	
		$query = 'select p.*, pp.periode_name ,wo.work_order_number, e.employee_number, e.full_name, e.npwp, os.structure_name from payslip as p inner join employee as e on e.id_employee = p.employee 
		inner join organisation_structure as os on os.id_organisation_structure = e.organisation_structure_id 
		inner join work_order as wo on wo.id_work_order = p.work_order 
		inner join payroll_periode as pp on pp.id_payroll_periode = p.payroll_periode';
		return $this->db->query($query)->result_array();
	}


}
