<?php
class Work_schedule_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_work_schedule_all()
	{
		$this->db->select('work_schedule.*, quotation.quote_number');
		$this->db->from('work_schedule');
        $this->db->join('quotation', 'quotation.id_quotation=work_schedule.quotation', 'LEFT');

		return $this->db->get()->result_array();
	}
    
    public function get_work_schedule_detail_all($id)
    {
		$this->db->select('detail_work_schedule.*, detail_work_schedule.shift AS shift_no, customer_site.id_customer_site, customer_site.site_name');
		$this->db->from('detail_work_schedule');
        $this->db->join('customer_site', 'customer_site.id_customer_site=detail_work_schedule.site', 'LEFT');
        $this->db->where('detail_work_schedule.work_schedule', $id);

		return $this->db->get()->result_array();
    }
    
    public function get_work_schedule_detail_by_quotation($id)
    {
		$this->db->select('id_work_schedule');
		$this->db->from('work_schedule');
        $this->db->where('quotation', $id);
		$data = $this->db->get()->result_array();
        
        if ($data)
            return $this->get_work_schedule_detail_all($data[0]['id_work_schedule']);
        else
            return array();        
    }
    
    public function get_work_schedule_by_id($id)
    {
		$this->db->select('work_schedule.*, inquiry.customer, quotation.quote_number');
		$this->db->from('work_schedule');
        $this->db->join('quotation', 'quotation.id_quotation=work_schedule.quotation', 'LEFT');

        $this->db->join('inquiry', 'inquiry.id_inquiry=quotation.inquiry');
        $this->db->where('work_schedule.id_work_schedule', $id);

		return $this->db->get()->result_array();
    }
    
    public function add_work_schedule($data) 
    {
		$this->db->trans_start();
		$data_input = array(
            'work_schedule_number' => $this->generate_number(),
			'quotation' => $data['quotation'],
			'period_start' => $data['period-start-date'],
            'period_end' => $data['period-end-date'],
			'notes' => $data['notes'],
            'status' => 'draft'
		);
		$this->db->insert('work_schedule', $data_input);
		$last_id = $this->db->insert_id();
        // var_dump($data['schedules']); die();
		$this->add_schedules($last_id, $data['schedules']);
		$this->db->trans_complete();
    }
    
    public function add_schedules($id, $data_post)
    {
        foreach($data_post as $data)
		{
            $data_input = array(
				'site' => $data['id_customer_site'],
				'area' => $data['area'],
				'shift' => $data['shift_no'],
                'working_hour' => $data['working_hour'],
                'structure' => $data['structure'],
                'qty' => $data['qty'],
                'remark' => '',
				'work_schedule' => $id
			);
			$this->db->insert('detail_work_schedule', $data_input);
        }
    }
    
    public function generate_number()
    {
        $this->db->select('id_work_schedule');
        $this->db->from('work_schedule');
        $this->db->where('YEAR(period_start)', date('Y'));
        $this->db->order_by('id_work_schedule DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $countResult = 1;
        if ($query->num_rows() > 0) {
            $result = $query->row(0);
            $countResult = $result->id_work_schedule + 1;
        }
        
        $zeroCount = '';
        for ($i=0; $i<4 - strlen($countResult);$i++) {
            $zeroCount .= '0';
        }
        
        return "WS" . date('y') . $zeroCount . $countResult;
    }
}