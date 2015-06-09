<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leave_application extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "leave_application", true);
        $this->load->model('leave_application_model');
    }

    function get_leave_application_list()
    {
        echo "{\"data\" : " . json_encode($this->leave_application_model->get_leave_application_all()) . "}";
    }

    function init_create_leave_application()
    {
        return null;
    }
    
     public function init_edit_leave_application($id)
    {
        $data = array(
            'leave_count' => $this->leave_application_model->get_leave_count($id),
            'data_edit' => $this->leave_application_model->get_leave_application_by_id($id),
            'data_employee' => $this->leave_application_model->get_employee_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }

    function get_employee_list (){
        echo "{\"data\" : " . json_encode($this->leave_application_model->get_employee_list()) . "}";
    }
    
    public function save_leave_application()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->leave_application_model->edit_leave_application($this->input->post());
        }
        else
        {
            $this->leave_application_model->add_leave_application($this->input->post());
        }
        
        return null;
    }
    
    function delete_leave_application(){
        $this->leave_application_model->delete_leave_application($this->input->post('id'));
        
        return null;
    }
    
    function cek_cuti(){
        $year=date('Y');
        $get_id=$this->input->post('id_employee');

        $total_cuti =  $this->db->query("select sum(total_day) as jumlah_hari from leave_application where employee_id='$get_id' and YEAR(to_date)='$year'")->row(); 
        $get_leave_status=$this->db->query("select organisation_structure_id from employee where id_employee='$get_id'")->row('organisation_structure_id');
        $duration =$this->db->query("select * from leave_duration where organisation_structure_id='$get_leave_status'")->row('leave_duration');
        $sisa_cuti= ($duration - $total_cuti->jumlah_hari);
        
        //$data=array('jumlah_cuti'=>($total_cuti->jumlah_hari==null?'0':$total_cuti->jumlah_hari),'durasi'=>$duration,'sisa_cuti'=>$sisa_cuti);
        
        //echo json_encode($data);
        
        echo ($total_cuti->jumlah_hari==""?'0':$total_cuti->jumlah_hari)."|".$duration."|".$sisa_cuti;
    }
	
	function leave_validate(){
		$id=$this->input->post('id');
		$this->db->query("UPDATE leave_application set approval='approve' where id='$id'");
		return true;
	}

}
