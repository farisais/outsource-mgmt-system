<?php
class So_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_so_all()
	{
		$this->db->select('so.*, ext_company.name AS customer_name, quotation.quote_number');
		$this->db->from('so');
        $this->db->join('quotation', 'quotation.id_quotation = so.quotation', 'LEFT');
        $this->db->join('ext_company', 'ext_company.id_ext_company = so.customer');
        $this->db->order_by('so.id_so', 'DESC');

		return $this->db->get()->result_array();
	}
    
    public function get_so_by_id($id)
    {
		$this->db->select('so.*, ext_company.name AS customer_name, quotation.quote_number');
		$this->db->from('so');
        $this->db->join('quotation', 'quotation.id_quotation = so.quotation', 'LEFT');
        $this->db->join('ext_company', 'ext_company.id_ext_company = so.customer');
        $this->db->where('id_so', $id);
		return $this->db->get()->result_array();
    }
    
    public function get_so_product($id)
    {
		$this->db->select('so_product.*, product.id_product, product.product_code, product.product_name, unit_measure.name as unit_name, unit_measure.id_unit_measure AS unit');
		$this->db->from('so_product');
		$this->db->join('product', 'product.id_product = so_product.product');
		$this->db->join('unit_measure', 'unit_measure.id_unit_measure = product.unit');
		$this->db->where('so_product.so', $id);

		return $this->db->get()->result_array();
    }

    public function get_so_survey($id)
    {
		$this->db->select('so_survey.*, survey_assessment.*, customer_site.id_customer_site, customer_site.site_name');
		$this->db->from('so_survey');
		$this->db->join('survey_assessment', 'survey_assessment.id_survey_assessment = so_survey.survey_assessment');
        $this->db->join('customer_site', 'customer_site.id_customer_site = survey_assessment.site');
		$this->db->where('so_survey.so', $id);

		return $this->db->get()->result_array();
    }
    
    public function get_so_schedule($id)
    {        
        $query_get_schedule = $this->db->get_where('so_schedule', array('so' => $id));
        if ($query_get_schedule->num_rows()) {
            $data_schedule = $query_get_schedule->result_array();
            
            $this->db->select('detail_work_schedule.*, detail_work_schedule.shift AS shift_no, customer_site.id_customer_site, customer_site.site_name, organisation_structure.structure_name');
            $this->db->from('detail_work_schedule');
            $this->db->join('customer_site', 'customer_site.id_customer_site=detail_work_schedule.site', 'LEFT');
            $this->db->join('organisation_structure', 'organisation_structure.id_organisation_structure=detail_work_schedule.structure', 'LEFT');
            $this->db->where('detail_work_schedule.work_schedule', $data_schedule[0]['work_schedule']);
            return $this->db->get()->result_array();
        } else {
            return array();
        }
    }
    
    public function get_so_contract($id)
    {
        $this->db->select('so_contract.*, contract.*');
        $this->db->from('so_contract');
        $this->db->join('contract', 'contract.id_contract = so_contract.contract');
        $this->db->where('so_contract.so', $id);

		return $this->db->get()->result_array();
    }
    
    public function add_so($data)
    {
        $this->db->trans_start();
        
		$data_input = array(
            'so_number' => $this->generate_so_number(),
			'date' => date('Y-m-d'),
            'date_delivery' => $data['date_delivery'],
			'quotation' => $data['quotation'],
            'customer' => $data['customer'],
			'notes' => $data['notes'],
			'invoice_period' => $data['invoice_period'],
            'status' => 'draft'
		);
		$this->db->insert('so', $data_input);
		$last_id = $this->db->insert_id();
        
        // insert product & survey
		$this->add_so_product($last_id, $data['quotation']);
        $this->add_so_survey($last_id, $data['quotation']);
        $this->add_so_contract($last_id, $data['contracts']);
        $this->add_so_schedule($last_id, $data['quotation']);

        $this->db->trans_complete();
    }
    
    public function edit_so($data_post)
    {
        $this->db->trans_start();
        
        /*
        $data = array(
            'so' => $data_post['so'],
            'name' => $data_post['so']
        );
        
        $this->db->where('id_po', $data_post['id_po']);
        $this->db->update('po', $data);
         * 
         */
        
        $this->db->trans_complete();
    }
    
    public function add_so_product($id, $id_quotation)
    {
		$this->db->select('quotation_product.*, product.id_product, product.product_code, product.product_name');
		$this->db->from('quotation_product');
		$this->db->join('product', 'product.id_product = quotation_product.product');
		$this->db->where('quotation', $id_quotation);
		$rows = $this->db->get()->result_array();
        
        foreach($rows as $row)
		{
			$data_input = array(
				'product' => $row['id_product'],
				'qty' => $row['qty'],
				'price' => $row['price'],
				'so' => $id
			);
			$this->db->insert('so_product', $data_input);
        }
    }

    public function add_so_survey($id, $id_quotation)
    {
        $this->db->select('quotation_survey.*, survey_assessment.*');
        $this->db->from('quotation_survey');
        $this->db->join('survey_assessment', 'survey_assessment.id_survey_assessment = quotation_survey.survey_assessment');
        $this->db->where('quotation_survey.quotation', $id_quotation);
		$rows = $this->db->get()->result_array();
        
        foreach ($rows as $row) {
			$data_input = array (
                'survey_assessment' => $row['id_survey_assessment'],
				'so' => $id
			);
			$this->db->insert('so_survey', $data_input);
        }
    }
    
    public function add_so_schedule($id, $id_quotation)
    {
        $this->db->select('id_work_schedule');
		$this->db->from('work_schedule');
        $this->db->where('quotation', $id_quotation);
        $data = $this->db->get()->result_array();
        
        $data_input = array (
            'work_schedule' => $data[0]['id_work_schedule'],
            'so' => $id
        );
        $this->db->insert('so_schedule', $data_input);
    }
    
    public function add_so_contract($id, $data_post)
    {
        foreach($data_post as $data)
		{
            $query_get_contract = $this->db->get_where('contract', array('filename' => $data['filename']));
            if ($query_get_contract->num_rows()) {
                $data_contract = $query_get_contract->result_array();
                
                $this->db->set('startdate', $data['startdate']);
                $this->db->set('expdate', $data['expdate']);
                $this->db->set('invoice_term', $data['invoice_term']);
				$this->db->set('contract_number', $data['contract_number']);
				$this->db->set('po_number', $data['po_number']);
                $this->db->set('status', $data['status']);
                $this->db->where("id_contract", $data_contract[0]['id_contract']);
                $this->db->update('contract');
                
                $this->db->insert('so_contract', array(
                    'contract' => $data_contract[0]['id_contract'],
                    'so' => $id
                ));                
            }
        }
    }
    
    public function add_so_contract_file($data)
    {
        $filename = $this->generate_contract_number();
        $data_input = array(
            'filename' => $filename,
            'filename_ori' => $data['file_name'],
            'filename_type' => $data['file_type'],
            'startdate' => null,
            'expdate' => null,
            'invoice_term' => null,
            'status' => null
        );
        $this->db->insert('contract', $data_input);
        $insert_id = $this->db->insert_id();
		$return = array('filename' => $filename, 'id_contract' => $insert_id);
        return $return;
    }
    
    public function generate_so_number()
    {
        $this->db->select('id_so');
        $this->db->from('so');
        $this->db->where('YEAR(date)', date('Y'));
        $this->db->order_by('id_so DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $countResult = 1;
        if ($query->num_rows() > 0) {
            $result = $query->row(0);
            $countResult = $result->id_so + 1;
        }
        
        $zeroCount = '';
        for ($i=0; $i<4 - strlen($countResult);$i++) {
            $zeroCount .= '0';
        }
        
        return "SO" . date('y') . $zeroCount . $countResult;
    }
    
    public function generate_work_order_number()
    {
        $this->db->select('id_work_order');
        $this->db->from('work_order');
        $this->db->where('YEAR(date)', date('Y'));
        $this->db->order_by('id_work_order DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $countResult = 1;
        if ($query->num_rows() > 0) {
            $result = $query->row(0);
            $countResult = $result->id_work_order + 1;
        }
        
        $zeroCount = '';
        for ($i=0; $i<4 - strlen($countResult);$i++) {
            $zeroCount .= '0';
        }
        
        return "WO" . date('y') . $zeroCount . $countResult;
    }
    
    public function generate_contract_number()
    {
        $this->db->select('id_contract');
        $this->db->from('contract');
        $this->db->where('YEAR(startdate)', date('Y'));
        $this->db->order_by('id_contract DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $countResult = 1;
        if ($query->num_rows() > 0) {
            $result = $query->row(0);
            $countResult = $result->id_contract + 1;
        }
        
        $zeroCount = '';
        for ($i=0; $i<4 - strlen($countResult);$i++) {
            $zeroCount .= '0';
        }
        
        return "C" . date('y') . $zeroCount . $countResult;
    }
    
    public function delete_so($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id_so', $id);
        $this->db->delete('so');
        
        $this->db->trans_complete();
    }
    
    public function validate_so($id)
    {
        $this->db->select('quotation');
		$this->db->from('so');
        $this->db->where('id_so', $id);
        $data = $this->db->get()->result_array();
        $quotation = $data[0]['quotation'];
        
        $this->db->trans_start();
        
        $this->db->where('id_so', $id);
        $this->db->update('so', array('status' => 'open'));
        
        // update inquiry status
        $this->db->where('id_quotation', $quotation);
        $this->db->update('quotation', array('status' => 'close'));
         
        $this->db->trans_complete();

        return array('id_so' => $id, 'status' => 'open');
    }
    function select_salary($id_quotation){
        $query=$this->db->query("SELECT * FROM quotation_cost_element 
        RIGHT JOIN quotation_cost_element_detail ON quotation_cost_element.id=quotation_cost_element_detail.quotation_cost_element_id
        WHERE 
        quotation_cost_element.quotation_id=$id_quotation AND quotation_cost_element_detail.recipient='Employee'");
        return $query->result_array();
    }
    function select_cost_element($id_quotation){
        $query=$this->db->query("SELECT * FROM quotation_cost_element 
        RIGHT JOIN quotation_cost_element_detail ON quotation_cost_element.id=quotation_cost_element_detail.quotation_cost_element_id
        WHERE 
        quotation_cost_element.quotation_id=$id_quotation AND quotation_cost_element_detail.recipient='Employee'");
        return $query->result_array();
    }
    public function confirm_so($id)
    {
        $this->db->trans_start();
        
        $data = $this->get_so_by_id($id);
		$data_input = array(
            'work_order_number' => $this->generate_work_order_number(),
			'date' => $data[0]['date'],
            'date_delivery' => $data[0]['date_delivery'],
			'so' => $id,
            'customer' => $data[0]['customer'],
			'notes' => $data[0]['notes'],
            'contract_number' => $data[0]['contract_number'],
            'contract_startdate' => $data[0]['contract_startdate'],
            'contract_expdate' => $data[0]['contract_expdate'],
			'invoice_period' => $data[0]['invoice_period'],
            'status' => 'draft'
		);
		$this->db->insert('work_order', $data_input);
		$last_id = $this->db->insert_id();
        
        $salary=$this->select_salary($data[0]['quotation']);
        // var_dump($salary);
        //die();
        foreach($salary as $value){
            $data_input = array(
            'structure_org_id' => $value['structure_org_id'],
            'level_employee_id' => $value['level_employee_id'],
          'base_value' => $value['nominal'],
          'salary_type_id' => $value['salary_type_id'],
          'occurence' => 'Per Bulan',
          'work_order_id'=>$last_id
          
        );
        $this->db->insert('wo_salary_setting', $data_input);
        }
        
        
        $data_products = $this->get_so_product($id);
        foreach ($data_products as $data_product) {
			$data_input = array(
				'product' => $data_product['id_product'],
				'qty' => $data_product['qty'],
				'price' => $data_product['price'],
				'work_order' => $last_id
			);
			$this->db->insert('work_order_product', $data_input);
        }
        
        $data_contracts = $this->get_so_contract($id);
        foreach ($data_contracts as $data_contract) { 
			$data_input = array(
				'contract' => $data_contract['contract'],
				'work_order' => $last_id
			);
            $this->db->insert('work_order_contract', $data_input);
        }
        
        $data_surveys = $this->get_so_survey($id);
        foreach ($data_surveys as $data_survey) { 
			$data_input = array(
				'survey_assessment' => $data_survey['survey_assessment'],
				'work_order' => $last_id
			);
            $this->db->insert('work_order_survey', $data_input);
        }
        
        $data_schedules = $this->get_so_schedule($id);
        foreach ($data_schedules as $data_schedule) { 
			$data_input = array(
                'work_schedule' => $data_schedule['work_schedule'],
				'work_order' => $last_id
			);
            $this->db->insert('work_order_schedule', $data_input);
            
        }
        
        $data_distinct_sch = $this->get_distinct_shift_wo_schedule($id);
        foreach($data_distinct_sch as $dd)
        {
            $dat = array();
            $dat['kode_schedule'] = $dd['kode_jadwal'];
            $dat['nama_schedule'] = $dd['nama_jadwal'];
            $dat['schedule_type'] = $dd['tipe_jadwal'];
            $dat['work_order_id'] = $last_id;
            
            $this->db->insert('wo_time_schedule', $dat);
        }

        //add wo cost element
        $data_ce_quotation = $this->get_quote_ce($data[0]['quotation']);
        foreach($data_ce_quotation as $ce)
        {
            $d = array();
            $d['work_order'] = $last_id;
            $d['cost_element'] = $ce['cost_element'];
            $d['structure'] = $ce['structure'];

            $this->db->insert('wo_ce_assign', $d);
        }
        
        $this->db->where('id_so', $id);
        $this->db->update('so', array('status' => 'close'));
        
        $this->db->trans_complete();
        
        return array('id_so' => $id, 'id_work_order' => $last_id, 'status' => 'close');
    }
    
    public function get_distinct_shift_wo_schedule($id)
    {
        $query = "select distinct if(dws.shift <> 'off',CONCAT('S', dws.shift,'(',dws.working_hour,')'), 'L') as kode_jadwal, if(dws.shift <> 'off', CONCAT('Shift ', dws.shift,'(',dws.working_hour,')') ,'Libur') as nama_jadwal, if(dws.shift<>'off','on','off') as tipe_jadwal from so_schedule as ss 
        inner join work_schedule as ws on ws.id_work_schedule=ss.work_schedule 
        inner join detail_work_schedule as dws on dws.work_schedule=ws.id_work_schedule 
        where ss.so = " . $id;

        $result = $this->db->query($query);
        
        return $result->result_array();
        
                    
    }


    public function get_quote_ce($quote)
    {
        $this->db->select('*');
        $this->db->from('quotation_ce_assign');
        $this->db->where('quotation', $quote);

        return $this->db->get()->result_array();
    }
}