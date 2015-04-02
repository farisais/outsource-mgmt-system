<?php
class Survey_assessment_model extends CI_Model
{
	public function __construct()
	{
        // die('OK');
		parent::__construct();
	}
    
    public function get_survey_assessment_by_filename($filename)
    {
		$this->db->select('*');
		$this->db->from('survey_assessment');
        $this->db->where('filename', $filename);

		return $this->db->get()->result_array();
    }
}