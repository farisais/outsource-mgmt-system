<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_contract_type extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "employee_contract_type", true);
        $this->load->model('employee_contract_type_model');
          
    }
    public function get_employee_contract_type_list()
    {
        echo "{\"data\":" .json_encode($this->employee_contract_type_model->get_employee_contract_type_all()). "}";
    }
    
    public function save_employee_contract_type()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->employee_contract_type_model->edit_employee_contract_type($this->input->post());
        }
        else
        {
            $this->employee_contract_type_model->save_employee_contract_type($this->input->post());
        }
        
        return null;
    }
    
    public function delete_employee_contract_type()
    {
        $this->employee_contract_type_model->delete_employee_contract_type($this->input->post('id_employee_contract_type'));
        
        return null;
    }
    
    public function init_edit_employee_contract_type($id)
    {
        $data = array(
            'data_edit' => $this->employee_contract_type_model->get_employee_contract_type_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_employee_contract_type()
    {
        return null;
    }
}
?>
