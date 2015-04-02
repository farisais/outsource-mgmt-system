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

}
