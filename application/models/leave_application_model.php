<?php
class Leave_application_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_leave_application_all()
    {
        return $this->db->query("SELECT a.*,b.full_name,(CASE WHEN (a.approval='0') THEN 'No Approval' ELSE 'Approval' END) as validasi,
                                 DATE_ADD(from_date, INTERVAL 1 DAY) as start_date,
                                 DATE_ADD(to_date, INTERVAL 1 DAY) as end_date
                                 from leave_application a inner join employee b on a.employee_id=b.id_employee 
                                 order by a.id desc")->result_array();
    }
    
    public function get_employee_list (){
        return $this->db->query("select a.id_employee,employee_number,full_name, 
                                 b.name from employee a 
                                 left join employment_type b on a.employment_type=b.id_employment_type
                                 where a.employee_status='1' order by a.full_name asc")->result_array();
    }
    
    public function get_employee_by_id($id){
        $get_id=$this->db->query("select employee_id from leave_application where id='$id'")->row('employee_id');
        return $this->db->query("select a.*,b.name from employee a inner join employment_type b on a.employment_type=b.id_employment_type where a.id_employee='$get_id'")->result_array();
    }
    
    public function get_leave_calculation($id){
        $get_id=$this->db->query("select employee_id from leave_application where id='$id'")->row('employee_id');
        $get_leave_status=$this->db->query("select organisation_structure_id from employee where id_employee='$get_id'")->row('organisation_structure_id');
        return $this->db->query("select * from leave_duration where organisation_structure_id='$get_leave_status'")->row_array();
    }
    
    public function get_leave_count($id){
        $year=date('Y');
        $get_id=$this->db->query("select employee_id from leave_application where id='$id'")->row('employee_id');
        return $this->db->query("select sum(total_day) as jumlah_hari from leave_application where employee_id='$get_id' and YEAR(to_date)='$year'")->row_array(); 
    }
    
    public function get_leave_application_by_id($id){
       $query = $this->db->query("select *,DATE_ADD(from_date, INTERVAL 1 DAY) as start_date,DATE_ADD(to_date, INTERVAL 1 DAY) as end_date from leave_application where id='$id'");
	   if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data=$row;
			}
			return $data;
	   }else{
		return false;
	   }
		//$this->db->from('leave_application');
        //$this->db->where('id', $id);

		//return $this->db->get()->result_array();        
    }
    
    public function delete_leave_application($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete('leave_application');
        $this->db->trans_complete();
    }
    
    public function add_leave_application($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "employee_id" => $data['emloyee_id'],
            "leave_type" => $data['leave_type'],
            "from_date" => $data['leave_date_from'],
            "to_date"=>$data['leave_date_to'],
            "total_day"=>$data['leave_day'],
            "reason"=>$data['notes'],
			"approval" => "waiting_approval"
        );
        
        $this->db->insert('leave_application', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function edit_leave_application($data){
        $this->db->trans_start();
        $data_input = array(
            "employee_id" => $data['emloyee_id'],
            "leave_type" => $data['leave_type'],
            "from_date" => $data['leave_date_from'],
            "to_date"=>$data['leave_date_to'],
            "total_day"=>$data['leave_day'],
            "reason"=>$data['notes'],
			"approval" => "waiting_approval"
        );
        
        $this->db->where('id', $data['id']);
        $this->db->update('leave_application', $data_input);
        
        $this->db->trans_complete();
    }

}
