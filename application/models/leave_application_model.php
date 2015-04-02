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

}
