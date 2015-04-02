<?php
class Announcement_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_announcement($index)
	{
	   $this->db->select('activity_log.*, user.full_name AS user_name');
       $this->db->from('activity_log');
       $this->db->join('user', 'user.id_user=activity_log.user', 'INNER');
       $this->db->order_by('date_create', 'desc');
       $this->db->limit(10, ($index - 1) * 10);
	   return $this->db->get()->result_array();
	}
    
    public function count_announcement()
    {
        $result = $this->db->count_all_results('activity_log');
        
        return ceil($result / 10);
    }
}