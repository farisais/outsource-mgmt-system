<?php
class Shift_change_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_shift_change_all()
    {
        $this->db->select('*');
        $this->db->from('shift_change');

        return $this->db->get()->result_array();
    }

}
