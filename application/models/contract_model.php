<?php
class Contract_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_contract_by_filename($filename)
    {
		$this->db->select('*');
		$this->db->from('contract');
        $this->db->where('filename', $filename);

		return $this->db->get()->result_array();
    }
}