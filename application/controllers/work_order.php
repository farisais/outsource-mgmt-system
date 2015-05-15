<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Work_order extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "work_order", true);
        $this->load->model('work_order_model');      
    }
    public function get_work_order_salary_setting()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_salary_setting($this->input->get('id'))) . "}";
    }
    public function get_work_order_list()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_all()) . "}";
    }
    
    public function get_work_order_product_list()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_product($this->input->get('id'))) . "}";
    }

    public function get_work_order_survey_list()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_survey($this->input->get('id'))) . "}";
    }
    
    public function get_work_order_contract_list()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_contract($this->input->get('id'))) . "}";
    }
    
    public function get_work_order_schedule_list()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_schedule($this->input->get('id'))) . "}";
    }
    
    public function get_work_order_proc_list()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_proc($this->input->get('id'))) . "}";
    }    
    public function get_work_order_so_assignment_fp()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_so_assignment_fp($this->input->get('id'))) . "}";
    }
    public function get_work_order_list_open()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_list_open()) . "}";
    }
    
    public function save_work_order()
    {
        $data = $this->input->post();
        if($data['contract_startdate'] != null & $data['contract_expdate'] != null && $data['project_name'] != null && $data['project_name'] != '')
        {
            if ($this->input->post('is_edit') == 'true')
            {
                $this->work_order_model->edit_work_order($this->input->post());
            } else
            {
                $this->work_order_model->save_work_order($this->input->post());
            }
        }
        else
        {
            return array("has_error" => true, "error_message" => "Please fill project contract start date, contract end date, and project name");
        }
        
        return null;
    }
    
    public function delete_work_order()
    {
        $this->work_order_model->delete_work_order($this->input->post('id_work_order'));
        
        return null;
    }
    
    public function init_edit_work_order($id)
    {
        $data = array(
            'data_edit' => $this->work_order_model->get_work_order_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_view($id)
    {
        $data = $this->init_edit_work_order($id);
        $data['is_view'] = true;
        
        return $data;
    }
    
    public function init_create_work_order()
    {
        return null;
    }
    
    public function make_so_assignment()
    {
        $id = $this->input->post('id_work_schedule');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "work_schedule", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
     public function get_level_list()
    {
        echo json_encode($this->work_order_model->get_level_list());
    }
    public function get_level_listX()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_level_list()) . "}";
    }
     public function get_salary_type()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_salary_type()) . "}";
    }
    public function save_wo_salary_setting(){
        $this->work_order_model->save_wo_salary_setting($this->input->post());
    }
     public function save_wo_so_assignment(){
        $this->work_order_model->save_wo_so_assignment($this->input->post());
    }
     public function save_wo_time_schedulling(){
        $this->work_order_model->save_wo_time_schedulling($this->input->post());
        echo "success";
    }
    public function get_time_schedule()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_time_schedule($this->input->get('id'))) . "}";
    }
    public function save_wo_shift_rotation(){
        $this->work_order_model->save_wo_shift_rotation($this->input->post());
    }
    function validate_work_order(){
        $data = $this->input->post();
        if($data['contract_startdate'] != null & $data['contract_expdate'] != null && $data['project_name'] != null && $data['project_name'] != '')
        {
            $this->work_order_model->validate_work_order($data);

            return null;
        }
        else
        {
            return array("has_error" => true, "error_message" => "Please fill project contract start date, contract end date, and project name");
        }
    }
    public function get_employee_grid()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_employee_grid($this->uri->segment(3))) . "}";
    }
	public function get_work_order_so_assignment()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_so_assignment($this->input->get('id'))) . "}";
    }
	public function get_shift_rotation()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_shift_rotation($this->input->get('id'))) . "}";
    }
    public function get_work_order_so_assignment_popup()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_so_assignment_popup($this->input->get('id'))) . "}";
    }
    public function get_work_order_time_schedulling()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_time_schedulling($this->input->get('id'))) . "}";
    }
    public function get_area_rotation()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_area_rotation($this->input->get('id'))) . "}";
    }
    public function save_wo_area_rotation(){
        $this->work_order_model->save_wo_area_rotation($this->input->post());
    }
     public function get_work_order_area_schedulling()
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_area_schedulling($this->input->get('id'))) . "}";
    }
    
    function init_get_customer_site() {
        $result = $this->work_order_model->get_customer_site();
        echo "{\"data\" : " . json_encode($result) . "}";
    }
    
    public function unassign_so_assignment()
    {
        $this->work_order_model->unassign_so_assignment($this->input->post('so_assignment_number'), $this->input->post('wo'));
        
        echo 'success';
    }

    public function get_structure_ws_from_wo($id)
    {
        echo "{\"data\" : " . json_encode($this->work_order_model->get_structure_ws_from_wo($id)) . "}";
    }
    
}
?>
