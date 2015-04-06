<?php
class Leave_application_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_leave_application_all()
    {
        $this->db->select('*');
        $this->db->from('leave_application');

        return $this->db->get()->result_array();
    }
    
    public function get_employee_list (){
        return $this->db->query("select a.id_employee,employee_number,full_name, 
                                 b.name from employee a 
                                 left join employment_type b on a.employment_type=b.id_employment_type
                                 where a.employee_status='1' order by a.full_name asc")->result_array();
    }

}
