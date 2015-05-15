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
        $this->db->order_by('quotation.id_quotation','DESC');

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
		/*$this->db->select('quotation_product.*, if(quotation_product.price is NULL, 0, quotation_product.price) as price,product.id_product, product.product_code, product.product_name, unit_measure.name as unit_name, unit_measure.id_unit_measure AS unit');
		$this->db->from('quotation_product');
		$this->db->join('product', 'product.id_product = quotation_product.product');
		$this->db->join('unit_measure', 'unit_measure.id_unit_measure = product.unit');
		$this->db->where('quotation', $id);*/
        $query = "select qp.*, if(qp.price is NULL, 0, qp.price) as price,p.id_product, p.product_code, p.product_name, unit_measure.name as unit_name, unit_measure.id_unit_measure AS unit from quotation_product as qp
                  inner join product as p on p.id_product = qp.product
                  inner join unit_measure on unit_measure.id_unit_measure = p.unit
                  where quotation = " . $id;
		return $this->db->query($query)->result_array();
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
            $query_get_survey = $this->db->get_where('survey_assessment', array('filename' => $data['filename']));
            if ($query_get_survey->num_rows()) {
                $data_survey = $query_get_survey->result_array();
                
                $this->db->set('site', $data['id_customer_site']);
                $this->db->set('remark', $data['remark']);
                $this->db->where("id_survey_assessment", $data_survey[0]['id_survey_assessment']);
                $this->db->update('survey_assessment');
                
                $data_input_survey = array(
                    'survey_assessment' => $data_survey[0]['id_survey_assessment'],
                    'quotation' => $id
                );
                $this->db->insert('quotation_survey', $data_input_survey);
            }
        }
    }
    
    public function add_quotation_survey_file($data)
    {
        $filename = $this->generate_quotation_survey_number();
        $data_input = array(
            'filename' => $filename,
            'filename_ori' => $data['file_name'],
            'filename_type' => $data['file_type'],
            'site' => null,
            'remark' => null
        );
        $this->db->insert('survey_assessment', $data_input);
        
        return $filename;
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
    
    public function generate_quotation_survey_number()
    {
        $this->db->select('id_survey_assessment');
        $this->db->from('survey_assessment');
        $this->db->order_by('id_survey_assessment DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $countResult = 1;
        if ($query->num_rows() > 0) {
            $result = $query->row(0);
            $countResult = $result->id_survey_assessment + 1;
        }
        
        $zeroCount = '';
        for ($i=0; $i<4 - strlen($countResult);$i++) {
            $zeroCount .= '0';
        }
        
        return "S" . date('y') . $zeroCount . $countResult;
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

        $data_product = $this->input->post('detail_product');
        foreach($data_product as $product)
        {
            $this->db->where('quotation', $id);
            $this->db->where('product', $product['id_product']);

            $this->db->update('quotation_product', array("price" => $product['price']));
        }
        
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
	public function get_cost_element($id_quotation)
	{
		$this->db->select('quotation_cost_element.*,quotation_cost_element.id as quotation_cost_element_id,organisation_structure.structure_name,position_level.name,
        (SELECT sum(quotation_cost_element_detail.nominal) FROM quotation_cost_element_detail WHERE quotation_cost_element_detail.quotation_cost_element_id=quotation_cost_element.id) as total');
		$this->db->from('quotation_cost_element');
        $this->db->join('organisation_structure', 'organisation_structure.id_organisation_structure=quotation_cost_element.structure_org_id');
        $this->db->join('position_level', 'position_level.id_position_level=quotation_cost_element.level_employee_id');
        $this->db->where('quotation_cost_element.quotation_id',$id_quotation);
        return $this->db->get()->result_array();
	}
    function get_cost_element_detail(){
        return $this->db->get('quotation_cost_element_detail')->result_array();
    }
    
    function copy_cost_element($id_template,$id_quotation){
        $array=explode(',',$id_template);
        $this->db->where_in('quotation_cost_element_template_id',$array);
        $master=$this->db->get('quotation_cost_element_template')->result_array();
        //var_dump($master);
        //die();
        $data_iput=array();
        foreach($master as $value){
            $data_input=array(
                'structure_org_id'=>$value['structure_org_id'],
                'level_employee_id'=>$value['level_employee_id'],
                'description'=>$value['description'],
                'notes'=>$value['notes'],
                'quotation_id'=>$id_quotation
                );
            $this->db->insert('quotation_cost_element',$data_input);
            $last_id=$this->db->insert_id();
            $this->insert_detail_cost_element($last_id,$value['quotation_cost_element_template_id']);    
        }
        
    }
    function insert_detail_cost_element($last_id,$id){
        $this->db->trans_start();
        $this->db->query("INSERT INTO quotation_cost_element_detail(quotation_cost_element_id,item,nominal,persentase,recipient,remarks,salary_type_id)
                          SELECT $last_id,item,nominal,persentase,recipient,remarks,salary_type_id FROM quotation_cost_element_detail_template WHERE
                          quotation_cost_element_template_id=$id
                            ");
        $this->db->trans_complete();
    }
    public function get_cost_element_template()
	{
		$this->db->select('quotation_cost_element_template.*,organisation_structure.structure_name,position_level.name');
		$this->db->from('quotation_cost_element_template');
        $this->db->join('organisation_structure', 'organisation_structure.id_organisation_structure=quotation_cost_element_template.structure_org_id');
        $this->db->join('position_level', 'position_level.id_position_level=quotation_cost_element_template.level_employee_id');
        //$this->db->where_in('quotation_cost_element_template.quotation_cost_element_template_id',$id_quotation);
        return $this->db->get()->result_array();
	}
     function get_cost_element_detail_template(){
        $this->db->select('quotation_cost_element_detail_template.*,master_salary_type.salary_type');
		$this->db->from('quotation_cost_element_detail_template');
        $this->db->join('master_salary_type', 'master_salary_type.id=quotation_cost_element_detail_template.salary_type_id');
       
        return $this->db->get()->result_array();
    }
    public function save_cost_element($data_post){
        $this->db->trans_start();
        $id=array();
        $id_insert=array();
        $jumlah_array=count($data_post['cost_element_grid']);
        //var_dump($data_post['cost_element_grid']);
        //die();
        foreach($data_post['cost_element_grid'] as $key=>$d)
		{   
            if(isset($d['quotation_cost_element_id'])){
                    $data_input = array(
        				'structure_org_id' => $d['structure_org_id'],
        				'level_employee_id' => $d['level_employee_id'],
        				'description' => $d['description'],
                        'notes' => $d['notes']
                      
                    );
                $this->db->where('id',$d['quotation_cost_element_id']);
    			$this->db->update('quotation_cost_element', $data_input);
                array_push($id,$d['quotation_cost_element_id']);
                //if($key==($jumlah_array - 1)){
                 //   $this->delete_detail_schedule($id);
                //}
            }else{
                $data_input = array(
    			         'structure_org_id' => $d['structure_org_id'],
        				'level_employee_id' => $d['level_employee_id'],
        				'description' => $d['description'],
                        //'notes' => $d['notes'],
    				    'quotation_id' => $data_post['id']
    			);
    			$this->db->insert('quotation_cost_element', $data_input);
                $last_id = $this->db->insert_id();
                array_push($id_insert,$last_id);
                //die();
            }
           
        }
        foreach($id_insert as $value){
            array_push($id,$value);
        }
        $this->delete_cost_element($id,$data_post['id']);
        $this->db->trans_complete();
        //$implode=implode(',',$id);
        //$this->delete_detail_schedule($id);
        //var_dump($id);
        //die();
    }
    function delete_cost_element($arrays,$id_quotation){
        //$implode=implode(',',$arrays);
       
        $this->db->trans_start();
        $this->db->where('quotation_id', $id_quotation);
        $this->db->where_not_in('id', $arrays);
        $this->db->delete('quotation_cost_element');
        $this->db->trans_complete();
    }
    public function delete_detail_cost_element($id,$table){
       $this->db->where('work_order_id', $id);
       $this->db->delete($table);
    }
    public function save_detail_wo_shift_rotation($id, $data,$nama_table)
    {
        foreach($data as $d)
        {
            if($d['employee_id'] != '')
            {
                $data_input = array();
                $data_input['work_order_id'] = $id;
                $data_input['employee_id'] = $d['employee_id'];
                $data_input['tahun'] = $d['tahun'];
                $data_input['bulan'] = $d['bulan'];
                $data_input['01'] = $d['01'];
                $data_input['02'] = $d['02'];
                $data_input['03'] = $d['03'];
                $data_input['04'] = $d['04'];
                $data_input['05'] = $d['05'];
                $data_input['06'] = $d['06'];$data_input['07'] = $d['07'];
                $data_input['08'] = $d['08'];$data_input['09'] = $d['09'];
                $data_input['d10'] = $d['d10'];$data_input['d11'] = $d['d11'];
                $data_input['d12'] = $d['d12'];$data_input['d13'] = $d['d13'];
                $data_input['d14'] = $d['d14'];$data_input['d15'] = $d['d15'];
                $data_input['d16'] = $d['d16'];$data_input['d17'] = $d['d17'];
                $data_input['d18'] = $d['d18'];$data_input['d19'] = $d['d19'];
                $data_input['d20'] = $d['d20'];$data_input['d21'] = $d['d21'];
                $data_input['d22'] = $d['d22'];$data_input['d23'] = $d['d23'];
                $data_input['d24'] = $d['d24'];$data_input['d25'] = $d['d25'];
                $data_input['d26'] = $d['d26'];$data_input['d27'] = $d['d27'];
                $data_input['d28'] = $d['d28'];$data_input['d29'] = $d['d29'];
                $data_input['d30'] = $d['d30'];$data_input['d31'] = $d['d31'];
                
                $this->db->insert($nama_table, $data_input);
                //die();                
            }
        }
    }

    public function get_structure_ws_from_quote($id)
    {
        $query = "select qca.*, ce.name as cost_element_name, so_assign.structure_name from quotation_ce_assign as qca
                  inner join
                      (select dws.structure as dws_structure, os.structure_name from detail_work_schedule as dws
                      inner join work_schedule as ws on ws.id_work_schedule = dws.work_schedule
                      inner join organisation_structure as os on os.id_organisation_structure = dws.structure
                      where ws.quotation = " . $id . " group by dws.structure) as so_assign
                  on dws_structure = qca.structure
                  inner join cost_element as ce on ce.id_cost_element = qca.cost_element
                  where qca.quotation = " . $id ;
        $result = $this->db->query($query)->result_array();

        return $result;
    }

    public function get_structure_ws_from_quote_init($id)
    {
        $query = "select dws.structure , os.structure_name from detail_work_schedule as dws
                  inner join work_schedule as ws on ws.id_work_schedule = dws.work_schedule
                  inner join organisation_structure as os on os.id_organisation_structure = dws.structure
                  where ws.quotation = " . $id . " group by dws.structure ";
        $result = $this->db->query($query)->result_array();

        return $result;
    }

    public function save_ce_assign($data)
    {
        $this->db->trans_start();
        $this->delete_ce_assign_quote($data['id_quotation']);
        foreach($data['ce_assign'] as $ce)
        {
            $data_input = array();
            $data_input['quotation'] = $data['id_quotation'];
            $data_input['cost_element'] = $ce['cost_element'];
            $data_input['structure'] = $ce['structure'];

            $this->db->insert('quotation_ce_assign', $data_input);
        }

        $this->db->trans_complete();
    }

    public function delete_ce_assign_quote($quote)
    {
        $this->db->where('quotation', $quote);
        $this->db->delete('quotation_ce_assign');
    }

    public function get_product_definition_from_structure($st)
    {
        $this->db->select('product');
        $this->db->from('product_definition');
        $this->db->where('organisation_structure', $st);

        return $this->db->get()->result_array();
    }

    public function get_product_definition_from_product($p)
    {
        $this->db->select('organisation_structure');
        $this->db->from('product_definition');
        $this->db->where('product', $p);

        return $this->db->get()->result_array();
    }

    public function get_ce_assignment_from_quote_str($q, $s)
    {
        $this->db->select('*');
        $this->db->from('quotation_ce_assign');
        $this->db->where('quotation', $q);
        $this->db->where('structure', $s);

        return $this->db->get()->result_array();
    }


}