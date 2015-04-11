<?php
class Monitoring_timesheet_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_timesheet_all()
	{
		$query =$this->db->query("SELECT work_order.id_work_order,work_order.project_name,
        YEAR('2015-03-01') as tahun,MONTH('2015-03-01') as bulan,
IF((SELECT timesheet_group.date FROM timesheet_group WHERE timesheet_group.date='2015-03-01' AND work_order_id=work_order.id_work_order) = '2015-03-01','Y','N') as '01',
IF((SELECT timesheet_group.date FROM timesheet_group WHERE timesheet_group.date='2015-03-02' AND work_order_id=work_order.id_work_order) = '2015-03-02','Y','N') as '02',
IF((SELECT timesheet_group.date FROM timesheet_group WHERE timesheet_group.date='2015-03-03' AND work_order_id=work_order.id_work_order) = '2015-03-03','Y','N') as '03',
IF((SELECT timesheet_group.date FROM timesheet_group WHERE timesheet_group.date='2015-03-04' AND work_order_id=work_order.id_work_order) = '2015-03-04','Y','N') as '04'
FROM work_order");
                
		return $query->result_array();
	}

}
	