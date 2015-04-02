<?php
class Quotation_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_quotation_all($status = null)
	{
		$this->db->select('quotation.*, inquiry.customer, inquiry.inquiry_number, ext_company.name AS customer_name');
		$this->db->from('quotation');
        $this->db->join('inquiry', 'inquiry.id_inquiry=quotation.inquiry', 'LEFT');
        $this->db->join('ext_company', 'ext_company.id_ext_company = inquiry.customer');
        if ($status)
            $this->db->where('quotation.status', $status);

		return $this->db->get()->result_array();
	}
    
    public function get_quotation_by_id($id)
    {
		$this->db->select('quotation.*, inquiry.customer, inquiry.inquiry_number, ext_company.name AS customer_name, work_schedule.id_work_schedule');
		$this->db->from('quotation');
        $this->db->join('inquiry', 'inquiry.id_inquiry=quotation.inquiry', 'LEFT');
        $this->db->join('ext_company', 'ext_company.id_ext_company = inquiry.customer');
        $this->db->join('work_schedule', 'work_schedule.quotation=quotation.id_quotation', 'LEFT');
        $this->db->where('quotation.id_quotation', $id);

		return $this->db->get()->result_array();
    }
    
    public function get_quotation_product($id)
    {
		$this->db->select('quotation_product.*, product.id_product, product.product_code, product.product_name, unit_measure.name as unit_name, unit_measure.id_unit_measure AS unit');
		$this->db->from('quotation_product');
		$this->db->join('product', 'product.id_product = quotation_product.product');
		$this->db->join('unit_measure', 'unit_measure.id_unit_measure = product.unit');
		$this->db->where('quotation', $id);

		return $this->db->get()->result_array();
    }
    
    public function get_quotation_survey($id)
    {
        $this->db->select('quotation_survey.*, survey_assessment.*, customer_site.id_customer_site, customer_site.site_name');
        $this->db->from('quotation_survey');
        $this->db->join('survey_assessment', 'survey_assessment.id_survey_assessment = quotation_survey.survey_assessment');
        $this->db->join('customer_site', 'customer_site.id_customer_site = survey_assessment.site');
        $this->db->where('quotation_survey.quotation', $id);

		return $this->db->get()->result_array();
    }
    
    public function get_quotation_work_schedule($id)
    {
        return array();
    }
    
    public function add_quotation($data)
    {
		$this->db->trans_start();
        
		$data_input = array(
            'quote_number' => $this->generate_quotation_number(),
			'quote_date' => $data['quote_date'],
			'inquiry' => $data['inquiry'],
			'notes' => $data['notes'],
			'invoice_period' => $data['invoice_period'],
            'status' => 'draft'
		);
		$this->db->insert('quotation', $data_input);
		$last_id = $this->db->insert_id();
        // insert product & survey
		$this->add_quotation_product($last_id, $data['products']);
        $this->add_quotation_survey($last_id, $data['surveys']);
        
		$this->db->trans_complete();
        
        return $last_id;
    }
    
    public function add_quotation_product($id, $data_post)
    {
        foreach($data_post as $data)
		{
			$data_input = array(
				'product' => $data['id_product'],
				'qty' => $data['qty'],
				'price' => $data['price'],
				'quotation' => $id
			);
			$this->db->insert('quotation_product', $data_input);
        }
    }

    public function add_quotation_survey($id, $data_post)
    {
        
        foreach($data_post as $data)
		{
			$data_input = array(
				'filename' => $data['filename'],
				'site' => $data['id_customer_site'],
                'remark' => $data['remark'],
			);
			$this->db->insert('survey_assessment', $data_input);
            $last_id = $this->db->insert_id();
			$data_input_survey = array(
                'survey_assessment' => $last_id,
				'quotation' => $id
			);
			$this->db->insert('quotation_survey', $data_input_survey);
        }
    }

    public function edit_quotation($data)
    {
        
    }
    
    public function delete_quotation($id)
    {
        
    }
    
    public function generate_quotation_number()
    {
        $this->db->select('id_quotation');
        $this->db->from('quotation');
        $this->db->where('YEAR(quote_date)', date('Y'));
        $this->db->order_by('id_quotation DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $countResult = 1;
        if ($query->num_rows() > 0) {
            $result = $query->row(0);
            $countResult = $result->id_quotation + 1;
        }
        
        $zeroCount = '';
        for ($i=0; $i<4 - strlen($countResult);$i++) {
            $zeroCount .= '0';
        }
        
        return "Q" . date('y') . $zeroCount . $countResult;
    }
    
    public function make_working_schedule($id)
    {
        $this->load->model('work_schedule_model');
		$this->db->trans_start();
		$data_input = array(
            'work_schedule_number' => $this->work_schedule_model->generate_number(),
			'quotation' => $id,
			'period_start' => date('Y-m-d'),
            'period_end' => date('Y-m-d'),
			'notes' => '',
		);
		$this->db->insert('work_schedule', $data_input);
        $last_id = $this->db->insert_id();
		$this->db->trans_complete();
        
        return $last_id;
    }
    
    public function validate_quotation($id) 
    {
        $this->db->select('inquiry');
		$this->db->from('quotation');
        $this->db->where('id_quotation', $id);
        $data = $this->db->get()->result_array();
        $inquiry = $data[0]['inquiry'];
        
        $this->db->trans_start();
        
        $this->db->where('id_quotation', $id);
        $this->db->update('quotation', array('status' => 'open'));
        
        $this->db->where('quotation', $id);
        $this->db->update('work_schedule', array('status' => 'open'));
        
        // update inquiry status
        $this->db->where('id_inquiry', $inquiry);
        $this->db->update('inquiry', array('status' => 'close'));
        
        $this->db->trans_complete();
        
        return array('id_quotation' => $id, 'status' => 'open');
    }
}