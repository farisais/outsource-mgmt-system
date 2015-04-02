<?php
class Recruitment_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_recruitment_all()
	{                
		return $this->db->get('recruitment')->result_array();
	}
    
    public function add_recruitment($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "nama" => $data['nama'],
            "alamat" => $data['alamat'],
            "telepon" => $data['telepon'],
            "email"=>$data['email'],
            "birt_date"=>$data['birt_date'],
            "religion"=>$data['religion'],
            "gender"=>$data['gender'],
            "blood_type"=>$data['blood_type']
        );
        
        $this->db->insert('recruitment', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function edit_recruitment($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "nama" => $data['nama'],
            "alamat" => $data['alamat'],
            "telepon" => $data['telepon'],
            "email"=>$data['email'],
            "birt_date"=>$data['birt_date'],
            "religion"=>$data['religion'],
            "gender"=>$data['gender'],
            "blood_type"=>$data['blood_type']
        );
        
        $this->db->where('id', $data['id']);
        $this->db->update('recruitment', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function delete_recruitment($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete('recruitment');
        $this->db->trans_complete();
    }
    
    //s==========================================================================================
    public function get_recruitment_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('recruitment');
        $this->db->where('id', $id);

		return $this->db->get()->result_array();        
    }
    
    public function get_recruitment_product($id)
    {
		$this->db->select('recruitment_product.*, product.id_product, product.product_code, product.product_name, unit_measure.name as unit_name, unit_measure.id_unit_measure AS unit');
		$this->db->from('recruitment_product');
		$this->db->join('product', 'product.id_product = recruitment_product.product');
		$this->db->join('unit_measure', 'unit_measure.id_unit_measure = product.unit');
		$this->db->where('recruitment_product.recruitment', $id);

		return $this->db->get()->result_array();
    }
    public function get_recruitment_shift_rotation($id)
    {
		$query=$this->db->query("SELECT
employee.id_employee,        
employee.full_name,
shift_rotation.tahun,
shift_rotation.*,
shift_rotation.bulan,
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.01) as 'd01',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.02) as 'd02',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.03) as 'd03',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.04) as 'd04',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.05) as 'd05',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.06) as 'd06',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.07) as 'd07',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.08) as 'd08',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.09) as 'd09',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d10) as 'dd10',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d11) as 'dd11',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d12) as 'dd12',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d13) as 'dd13',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d14) as 'dd14',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d15) as 'dd15',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d16) as 'dd16',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d17) as 'dd17',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d18) as 'dd18',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d19) as 'dd19',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d20) as 'dd20',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d21) as 'dd21',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d22) as 'dd22',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d23) as 'dd23',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d24) as 'dd24',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d25) as 'dd25',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d26) as 'dd26',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d27) as 'dd27',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d28) as 'dd28',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d29) as 'dd29',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d30) as 'dd30',
(select kode_schedule from wo_time_schedule where wo_time_schedule.id=shift_rotation.d31) as 'dd31'
FROM shift_rotation
LEFT JOIN employee ON employee.id_employee=shift_rotation.employee_id
WHERE shift_rotation.recruitment_id=$id");
	
	//	$this->db->where('recruitment_product.recruitment', $id);

		return $query->result();
    }
    
    public function get_recruitment_survey($id)
    {
		$this->db->select('recruitment_survey.*, survey_assessment.*, customer_site.site_name');
		$this->db->from('recruitment_survey');
		$this->db->join('survey_assessment', 'survey_assessment.id_survey_assessment = recruitment_survey.survey_assessment');
        $this->db->join('customer_site', 'customer_site.id_customer_site = survey_assessment.site');
		$this->db->where('recruitment_survey.recruitment', $id);

		return $this->db->get()->result_array();
    }
    
    public function get_recruitment_contract($id)
    {
        $this->db->select('recruitment_contract.*, contract.*');
        $this->db->from('recruitment_contract');
        $this->db->join('contract', 'contract.id_contract = recruitment_contract.contract');
        $this->db->where('recruitment_contract.recruitment', $id);

		return $this->db->get()->result_array();
    }
    
    public function get_recruitment_schedule($id)
    {
		$this->db->select('recruitment_schedule.*, work_schedule.*');
		$this->db->from('recruitment_schedule');
		$this->db->join('work_schedule', 'work_schedule.id_work_schedule = recruitment_schedule.work_schedule');
		$this->db->where('recruitment_schedule.recruitment', $id);
    }
    public function get_recruitment_salary_setting($id)
    {
		
        $this->db->select('wss.*,
    os.structure_name,
    mst.salary_type,
    pl.name as level_name');
		$this->db->from('wo_salary_setting as wss');
		$this->db->join('organisation_structure as os', 'os.id_organisation_structure=wss.structure_org_id');
        $this->db->join('master_salary_type as mst', 'mst.id=wss.salary_type_id');
        $this->db->join('position_level as pl', 'pl.id_position_level=wss.level_employee_id');
		$this->db->where('wss.recruitment_id', $id);
        return $this->db->get()->result_array();        
    }
      public function get_recruitment_so_assignment($id)
    {
        $this->db->select('so_assignment.*, employee.full_name,organisation_structure.structure_name
,position_level.name as level_posisi');
		$this->db->from('so_assignment');
		$this->db->join('employee', 'employee.id_employee=so_assignment.so_assignment_number');
        $this->db->join('organisation_structure', 'organisation_structure.id_organisation_structure=employee.organisation_structure_id');
 	    $this->db->join('position_level', 'position_level.id_position_level=employee.position_level');
		$this->db->where('so_assignment.recruitment_id', $id);
        return $this->db->get()->result_array();        
    }
    public function get_recruitment_so_assignment_popup()
    {
        $this->db->select('employee.*,organisation_structure.structure_name
,position_level.name as level_posisi,employee.id_employee as so_assignment_number');
		$this->db->from('employee');
		$this->db->join('organisation_structure', 'organisation_structure.id_organisation_structure=employee.organisation_structure_id');
 	    $this->db->join('position_level', 'position_level.id_position_level=employee.position_level');
		return $this->db->get()->result_array();        
    }
    public function get_recruitment_time_schedulling($id)
    {
       	$this->db->where('recruitment_id', $id);
        return $this->db->get('wo_time_schedule')->result_array();        
    }
    
    public function get_recruitment_list_open()
    {
        $this->db->select('recruitment.*, so.so_number, ext_company.name AS customer_name');
		$this->db->from('recruitment');
        $this->db->join('so', 'so.id_so=recruitment.so', 'LEFT');
        $this->db->join('ext_company', 'ext_company.id_ext_company = recruitment.customer');
        
        $this->db->where('recruitment.status', 'open');

		return $this->db->get()->result_array();
    }
    
    public function get_salary_setting_detail_list()
    {
        $this->db->select('recruitment.*, so.so_number, ext_company.name AS customer_name');
		$this->db->from('recruitment');
        $this->db->join('so', 'so.id_so=recruitment.so', 'LEFT');
        $this->db->join('ext_company', 'ext_company.id_ext_company = recruitment.customer');
        
        $this->db->where('recruitment.status', 'open');

		return $this->db->get()->result_array();
    }
    public function get_level_list(){
        return $this->db->get('position_level')->result_array();  
    }
    public function get_employee_grid($id)
    {
        $this->db->select('employee.id_employee,employee.full_name');
		$this->db->from('so_assignment');
        $this->db->join('employee', 'employee.id_employee=so_assignment.so_assignment_number');
         
        $this->db->where('so_assignment.recruitment_id', $id);

		return $this->db->get()->result_array();
    }
   


    public function get_time_schedule($id){
        $this->db->where('recruitment_id', $id);
        return $this->db->get('wo_time_schedule')->result_array();  
    }
    public function get_salary_type(){
        return $this->db->get('master_salary_type')->result_array();  
    }
    public function save_wo_salary_setting($data){
        $data_input["id"] = $data["id"];
        $this->delete_detail_wo_salary_setting($data_input["id"], 'wo_salary_setting');
        $this->save_detail_wo_salary_setting($data_input["id"], $data['salary_setting']);
    }
    public function delete_detail_wo_salary_setting($id,$table){
       $this->db->where('recruitment_id', $id);
       $this->db->delete($table);
    }
    public function save_detail_wo_salary_setting($id, $data)
    {
        foreach($data as $d)
        {
            if($d['value'] != '')
            {
                $data_input = array();
                $data_input['recruitment_id'] = $id;
                $data_input['value'] = $d['value'];
                $data_input['structure_org_id'] = $d['structure_org_id'];
                $data_input['salary_type_id'] = $d['salary_type_id'];
                $data_input['level_employee_id'] = $d['level_employee_id'];
                $data_input['occurence'] = $d['occurence'];
               
                $this->db->insert('wo_salary_setting', $data_input);
            }
        }
    }
    
    public function save_wo_so_assignment($data){
        $data_input["id"] = $data["id"];
        $this->delete_detail_wo_so_assignment($data_input["id"], 'so_assignment');
        $this->save_detail_wo_so_assignment($data_input["id"], $data['so_assignment']);
    }
    public function delete_detail_wo_so_assignment($id,$table){
       $this->db->where('recruitment_id', $id);
       $this->db->delete($table);
    }
    public function save_detail_wo_so_assignment($id, $data)
    {
        foreach($data as $d)
        {
            if($d['so_assignment_number'] != '')
            {
                $data_input = array();
                $data_input['recruitment_id'] = $id;
                $data_input['so_assignment_number'] = $d['so_assignment_number'];
                $this->db->insert('so_assignment', $data_input);
            }
        }
    }
    public function save_wo_time_schedulling($data){
        $data_input["id"] = $data["id"];
        $this->delete_detail_wo_time_schedulling($data_input["id"], 'wo_time_schedule');
        $this->save_detail_wo_time_schedulling($data_input["id"], $data['time_schedulling']);
    }
    public function delete_detail_wo_time_schedulling($id,$table){
       $this->db->where('recruitment_id', $id);
       $this->db->delete($table);
    }
    public function save_detail_wo_time_schedulling($id, $data)
    {
        foreach($data as $d)
        {
            if($d['kode_schedule'] != '')
            {
                $data_input = array();
                $data_input['recruitment_id'] = $id;
                $data_input['kode_schedule'] = $d['kode_schedule'];
                $data_input['nama_schedule'] = $d['nama_schedule'];
                $data_input['from_time'] = $d['from_time'];
                $data_input['to_time'] = $d['to_time'];
                $data_input['late_in_tolerance']=$d['late_in_tolerance'];
                $data_input['early_out_tolerance']=$d['early_out_tolerance'];
                
                
                $this->db->insert('wo_time_schedule', $data_input);
            }
        }
    }
    public function save_wo_shift_rotation($data){
        //var_dump($data);die();
        $data_input["id"] = $data["id"];
        $this->delete_detail_wo_shift_rotation($data_input["id"], 'shift_rotation');
        $this->save_detail_wo_shift_rotation($data_input["id"], $data['shift_rotation']);
    }
    public function delete_detail_wo_shift_rotation($id,$table){
       $this->db->where('recruitment_id', $id);
       $this->db->delete($table);
    }
    public function save_detail_wo_shift_rotation($id, $data)
    {
        foreach($data as $d)
        {
            if($d['employee_id'] != '')
            {
                $data_input = array();
                $data_input['recruitment_id'] = $id;
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
                
                $this->db->insert('shift_rotation', $data_input);
            }
        }
    }
    
    public function validate_recruitment($data){
        //die();
        $this->db->trans_start();
        
        $data_input = array(
            'status' => 'running'
        );

        $this->db->where('id_recruitment', $data['id_recruitment']);
        $this->db->update('recruitment', $data_input);

        $this->db->trans_complete();
    }
    
}