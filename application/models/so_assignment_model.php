<?php
class So_assignment_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_so_assignment_all()
	{
		$this->db->select('so_assignment.*, work_schedule.*');
		$this->db->from('so_assignment');
        $this->db->join('work_schedule', 'so_assignment.work_schedule=work_schedule.id_work_schedule', 'LEFT');

		return $this->db->get()->result_array();
	}
    
    public function get_so_assignment_employee()
    {
/*
                { text: 'Number', dataField: 'employee_number', width: 150},
                { text: 'Full name', dataField: 'full_name'},
                { text: 'Type', dataField: 'employee_type', width: 150}
 */        
        return array(
            array(
                'id_detail_so_assignment' => 1,
                'so_assignment' => 2,
                'detail_work_schedule' => 2,
                'employee' => 1,
                'employee_number' => '1234',
                'full_name' => 'Abraham Samad',
                'employee_type' => 'Security Officer'
            ),
            array(
                'id_detail_so_assignment' => 2,
                'so_assignment' => 6,
                'detail_work_schedule' => 2,
                'employee' => 2,
                'employee_number' => '4567',
                'full_name' => 'Abraham Lunggana',
                'employee_type' => 'Security Officer'
            ),
            array(
                'id_detail_so_assignment' => 3,
                'so_assignment' => 6,
                'detail_work_schedule' => 8,
                'employee' => 1,
                'employee_number' => '1234',
                'full_name' => 'Abraham Samad',
                'employee_type' => 'Security Officer'
            )
        );
    }
    
    public function change_status_fp_assign_bulk($data)
    {
        $this->db->trans_start();
        
        foreach($data as $d)
        {
            $this->db->where('so_assignment_number', $d['id_employee']);
            $this->db->update('so_assignment', array("fingerprint_assign_status" => $d['fp_assign_status']));
        }
        
        $this->db->trans_complete();
    }
    
}