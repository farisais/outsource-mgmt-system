<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Organisation_structure extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "organisation_structure", true);
        $this->load->model('organisation_structure_model');
    }
    
    public function get_organisation_structure_list()
    {
        echo "{\"data\":" .json_encode($this->organisation_structure_model->get_organisation_structure_all()). "}";
    }
    
    public function get_organisation_structure_service()
    {
        echo "{\"data\":" .json_encode($this->organisation_structure_model->get_organisation_structure_service()). "}";
    }
    
    public function save_organisation_structure()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->organisation_structure_model->edit_organisation_structure($this->input->post());
        }
        else
        {
            $this->organisation_structure_model->save_organisation_structure($this->input->post());
        }
        
        return null;
    }
    
    public function delete_organisation_structure()
    {
        $this->organisation_structure_model->delete_organisation_structure($this->input->post('id_organisation_structure'));
        
        return null;
    }
    
    public function init_edit_organisation_structure($id)
    {
        $data = array(
            'data_edit' => $this->organisation_structure_model->get_organisation_structure_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_organisation_structure()
    {
        $data = array(
            "parent" => $this->organisation_structure_model->get_organisation_structure_all(),
            "employment_types" => $this->organisation_structure_model->get_employment_types()
        );
        
        return $data;
    }
    public function get_organisation_structure_list_grid()
    {
        echo "{\"data\":" .json_encode($this->organisation_structure_model->get_organisation_structure_all_grid()). "}";
    }
}
?>
