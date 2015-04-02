<?php
class Division_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all()
	{
		$this->db->select('*');
		$this->db->from('division');
		
		return $result = $this->db->get()->result_array();
		//exit(print_r($result));
	}
	
	public function get_detail_jo($idj, $division)
	{
		$this->db->select('detail_jo_activity.*, division_activity.*, jo.type AS jo_type');
		$this->db->from('detail_jo_activity');
		$this->db->join('division_activity', 'division_activity.id_division_activity=detail_jo_activity.division_activity', 'INNER');
        $this->db->join('jo', 'detail_jo_activity.jo_no=jo.jo_no', 'INNER');
		$this->db->where('detail_jo_activity.jo_no', $idj);
		$this->db->where('division_activity.division', $division);
		
		$result = $this->db->get()->result_array();
		return $result;
	}
	
	public function get_activity($division)
	{
		$this->db->select('*');
		$this->db->from('division_activity');
		$this->db->where('division', $division);
		
		return $this->db->get()->result_array();
	}
    
    public function get_latest_seq($jo)
    {
        $this->db->select('detail_jo_activity.*,division_activity.seq');
        $this->db->from('detail_jo_activity');
        $this->db->join('division_activity', 'division_activity.id_division_activity=detail_jo_activity.division_activity', 'INNER');
        $this->db->where('detail_jo_activity.jo_no', $jo);
        $this->db->where('detail_jo_activity.actual !=', 'NULL');
        $this->db->order_by('division_activity.seq', 'DESC');
        
        return $this->db->get()->result_array();
    }
    
    public function get_initial_seq()
    {
        $this->db->select('*');
        $this->db->from('division_activity');
        $this->db->order_by('seq', 'ASC');
        
        $result = $this->db->get()->result_array();
        return $result[0]['seq'];
    }
    
    public function get_next_seq($jo, $latest_seq)
    {
        $this->db->select('detail_jo_activity.*,division_activity.seq');
        $this->db->from('detail_jo_activity');
        $this->db->join('division_activity', 'division_activity.id_division_activity=detail_jo_activity.division_activity', 'INNER');
        $this->db->where('detail_jo_activity.jo_no', $jo);
        $this->db->where('division_activity.seq >', $latest_seq);
        $this->db->order_by('division_activity.seq', 'ASC');
        
        return $this->db->get()->result_array();
    }
}
?>