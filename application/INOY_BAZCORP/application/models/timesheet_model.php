<?php
class Timesheet_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_timesheet_all()
	{
		$query =$this->db->query("SELECT t.*,w.project_name
                            FROM timesheet_group t
                            JOIN work_order w ON w.id_work_order=t.work_order_id ORDER BY t.id DESC");
                
		return $query->result_array();
	}
    public function get_list_work_order()
	{
		$query =$this->db->query("SELECT id_work_order,project_name
                            FROM work_order
                            WHERE status='running'
                            ORDER BY project_name DESC");
                
		return $query->result_array();
	}
    
	public function get_timesheet_by_date($date,$work_order_id)
	{
		$query =$this->db->query("SELECT * FROM timesheet_group WHERE date='$date' AND work_order_id=$work_order_id");
        if($query->num_rows() > 0){
            return false;
        }else{
            return true;
        }
	}
    public function get_timesheet_detail_all()
	{
		$query =$this->db->query("SELECT t.*,e.full_name,ee.full_name as nama_supervisor
                            FROM timesheet t
                            LEFT JOIN employee e ON e.employee_number=t.employee_number
                            LEFT JOIN employee ee ON ee.employee_number=t.supervisor_id");
                
		return $query->result_array();
	}
    public function get_work_order_all(){
        $this->db->select('*');
        $this->db->from('work_order');
        
        return $this->db->get()->result_array();
    }
    public function get_employee($id){
        $this->db->select('employee.id_employee,employee.full_name');
        $this->db->from('so_assignment');
        $this->db->join('employee','employee.id_employee=so_assignment.so_assignment_number');
        $this->db->where('so_assignment.work_order_id',$id);
        return $this->db->get()->result_array();
    }
    //==
    public function save_timesheet($data)
    {
        $this->db->trans_start();
        if($data['is_edit'] != 'true')
        {
            $data_input = array();
            $data_input["date"]         =   $data["input-date"];
            $data_input['work_order_id']   =   $data['project_name'];
            $data_input['input_method']   =   'manual';
            $this->db->insert('timesheet_group', $data_input);
            $timesheet_id = $this->db->insert_id();
        }
        else
        {
            $data_input = array();
            $data_input["date"]         =   $data["input-date"];
            $data_input['work_order_id']   =   $data['project_name'];
            $timesheet_id = $this->input->post('id_timesheet_group');
            $this->db->where('id', $timesheet_id);
            $this->db->update('timesheet_group', $data_input);
        }
        if(isset($data['employee_detail']))
        {
            $this->save_employee_detail($timesheet_id, $data['employee_detail']);
        }
        if($data['is_edit'] == 'true')
        {
            $this->delete_detail_timesheet($timesheet_id, 'timesheet');
        }
        
        
        $this->db->trans_complete();
    }
    
    public function delete_detail_timesheet($id, $table)
    {
        $this->db->where('timesheet_group_id', $id);
        $this->db->delete($table);
    }
    
    
    public function save_employee_detail($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                if($d['id_employee'] != '')
                {
                    $data_input = array();
                    $data_input['timesheet_group_id'] = $id;
                    $data_input['employee_number'] = $d['id_employee'];
                    $data_input['in']= $d['in'];
                    $data_input['out'] = $d['out'];
                    
                    $this->db->insert('timesheet', $data_input);
                }
            }
        }
    }
    
    public function get_timesheet_by_id($id)
    {
        $query=$this->db->query('SELECT t.*,e.full_name,ee.full_name as nama_supervisor
                            FROM timesheet t
                            LEFT JOIN employee e ON e.employee_number=t.employee_number
                            LEFT JOIN employee ee ON ee.employee_number=t.supervisor_id'); 
        return $query->result_array();
    }
    public function get_timesheet_group_by_id($id)
    {
        $query=$this->db->query("SELECT t.*,w.project_name
                            FROM timesheet_group t
                            JOIN work_order w ON w.id_work_order=t.work_order_id
                            WHERE t.id=$id"); 
        return $query->result_array();
    }
    public function get_detail_employee_on_edit($id)
    {
   	    $query =$this->db->query("SELECT t.*,
                            e.id_employee,
                            e.full_name,ee.full_name as nama_supervisor
                            FROM timesheet t
                            JOIN employee e ON e.id_employee=t.employee_number
                            LEFT JOIN employee ee ON ee.employee_number=t.supervisor_id
                            WHERE t.timesheet_group_id=$id");
                
		return $query->result_array();
    }
    
}
	