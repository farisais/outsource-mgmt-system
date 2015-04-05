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
		$this->db->select('detail_work_schedule.*, detail_work_schedule.shift AS shift_no, customer_site.id_customer_site, customer_site.site_name, organisation_structure.structure_name');
		$this->db->from('detail_work_schedule');
        $this->db->join('customer_site', 'customer_site.id_customer_site=detail_work_schedule.site', 'LEFT');
        $this->db->join('organisation_structure', 'organisation_structure.id_organisation_structure=detail_work_schedule.structure', 'LEFT');
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
    
    public function edit_work_schedule($data){
        //var_dump($data['schedules']['id_detail_work_schedule']);
        //die();
        $this->db->trans_start();
        $id=array();
        $id_insert=array();
        $jumlah_array=count($data['schedules']);
        foreach($data['schedules'] as $key=>$d)
		{   
            if($d['id_detail_work_schedule'] != ''){
                    $data_input = array(
        				'site' => $d['id_customer_site'],
        				'area' => $d['area'],
        				'shift' => $d['shift_no'],
                        'working_hour' => $d['working_hour'],
                        'structure' => $d['structure'],
                        'qty' => $d['qty']
                    );
                $this->db->where('id_detail_work_schedule',$d['id_detail_work_schedule']);
    			$this->db->update('detail_work_schedule', $data_input);
                array_push($id,$d['id_detail_work_schedule']);
                //if($key==($jumlah_array - 1)){
                 //   $this->delete_detail_schedule($id);
                //}
            }else{
                $data_input = array(
    				'site' => $d['id_customer_site'],
    				'area' => $d['area'],
    				'shift' => $d['shift_no'],
                    'working_hour' => $d['working_hour'],
                    'structure' => $d['structure'],
                    'qty' => $d['qty'],
                    'remark' => '',
    				'work_schedule' => $data['id_work_schedule']
    			);
    			$this->db->insert('detail_work_schedule', $data_input);
                $last_id = $this->db->insert_id();
                array_push($id_insert,$last_id);
                //die();
            }
           
        }
        foreach($id_insert as $value){
            array_push($id,$value);
        }
        $this->delete_detail_schedule($id,$data['id_work_schedule']);
        $this->db->trans_complete();
        //$implode=implode(',',$id);
        //$this->delete_detail_schedule($id);
        //var_dump($id);
        //die();
        
    }
    function delete_detail_schedule($arrays,$id_work_schedule){
        //$implode=implode(',',$arrays);
       
        $this->db->trans_start();
        $this->db->where('work_schedule', $id_work_schedule);
        $this->db->where_not_in('id_detail_work_schedule', $arrays);
        $this->db->delete('detail_work_schedule');
        $this->db->trans_complete();
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
        $this->add_product_from_schedule($data['quotation'], $data['schedules']);
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
    
    public function add_product_from_schedule($quotation, $data_schedule)
    {
        $stucture = array();
        foreach($data_schedule as $schedule) {
            if (!isset($stucture[$schedule['structure']])) {
                $stucture[$schedule['structure']] = $schedule['qty'];
            } else {
                $stucture[$schedule['structure']] += $schedule['qty'];
            }
        }
        
        foreach($stucture as $structure_id => $structure_qty)
		{
            $query_get_product = $this->db->get_where('product_definition', array('organisation_structure' => $structure_id));
            if ($query_get_product->num_rows()) {
                $data_product = $query_get_product->result_array();
                $data_input = array(
                    'product' => $data_product[0]['product'],
                    'qty' => $structure_qty,
                    'price' => null,
                    'quotation' => $quotation
                );
                $this->db->insert('quotation_product', $data_input);
            }
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