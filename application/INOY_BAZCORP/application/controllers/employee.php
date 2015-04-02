<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee extends MY_Controller
{
    function __construct()
    {
        parent::__construct('authorize', 'employee', true);
        $this->load->model('employee_model');
        $this->load->model('master_model');
        $this->load->model('unit_measure_model');
        $this->load->model('organisation_structure_model');
        $this->load->model('position_level_model');
        $this->load->model('employee_contract_type_model');
    }   
    
    public function get_employee_list()
    {
        echo "{\"data\" : " . json_encode($this->employee_model->get_employee_all()) . "}";
    }
    
    public function init_create_employee()
    {
        $data = array();
        $data['cities'] = $this->master_model->get_city_all();
        $data['address_type'] = $this->employee_model->get_address_type_all();
        $data['employment_type'] = $this->employee_model->get_employment_type_all();
        $data['religion'] = $this->employee_model->get_religion_all();
        $data['document_type'] = $this->employee_model->get_document_type_all();
        $data['unit_of_measure'] = $this->unit_measure_model->get_unit_measure_by_category('date');
        $data['language'] = $this->employee_model->get_language_all();
        $data['language_fluency'] = $this->employee_model->get_language_fluency_all();
        $data['position'] = $this->organisation_structure_model->get_organisation_structure_all();
        $data['position_level'] = $this->position_level_model->get_position_level_all();
        $data['contract_type'] = $this->employee_contract_type_model->get_employee_contract_type_all();
        return $data;
    }
    
    public function get_employee_contract_phase_type_list()
    {
        echo "{\"data\" : " . json_encode($this->employee_model->get_employee_contract_phase_type_all()) . "}";
    }
    
    public function get_education_level_list()
    {
        echo "{\"data\" : " . json_encode($this->employee_model->get_education_level_all()) . "}";
    }
    
    public function save_employee()
    {
        $this->employee_model->save_employee($this->input->post());
        return null;
    }
    
    public function init_edit_employee($id)
    {
        $data = array();
        $data['cities'] = $this->master_model->get_city_all();
        $data['address_type'] = $this->employee_model->get_address_type_all();
        $data['employment_type'] = $this->employee_model->get_employment_type_all();
        $data['religion'] = $this->employee_model->get_religion_all();
        $data['document_type'] = $this->employee_model->get_document_type_all();
        $data['unit_of_measure'] = $this->unit_measure_model->get_unit_measure_by_category('date');
        $data['language'] = $this->employee_model->get_language_all();
        $data['language_fluency'] = $this->employee_model->get_language_fluency_all();
        $data['position'] = $this->organisation_structure_model->get_organisation_structure_all();
        $data['position_level'] = $this->position_level_model->get_position_level_all();
        $data['contract_type'] = $this->employee_contract_type_model->get_employee_contract_type_all();
        $data['data_edit'] = $this->employee_model->get_employee_basic_by_id($id);
        $data['employee_address'] = $this->employee_model->get_employee_address_by_employee($id);
        $data['employee_identification'] = $this->employee_model->get_employee_identification_by_employee($id);
        $data['employee_contract'] = $this->employee_model->get_employee_contract_by_employee($id);
        $data['employee_contract_detail'] = $this->employee_model->get_employee_contract_detail_by_employee($id);
        $data['employee_education'] = $this->employee_model->get_employee_education_by_employee($id);
        $data['employee_course'] = $this->employee_model->get_employee_course_by_employee($id);
        $data['employee_language'] = $this->employee_model->get_employee_language_by_employee($id);
        $data['employee_social'] = $this->employee_model->get_employee_social_by_employee($id);
        $data['employee_experience'] = $this->employee_model->get_employee_experience_by_employee($id);
        $data['employee_family'] = $this->employee_model->get_employee_family_by_employee($id);
        $data['employee_marital'] = $this->employee_model->get_employee_marital_by_employee($id);
        $data['employee_contact'] = $this->employee_model->get_employee_emergency_contact_by_employee($id);
        $data['employee_transportation'] = $this->employee_model->get_employee_transportation_by_employee($id);
        $data['is_edit'] = true;
        
        return $data;
    }
    
}
?>