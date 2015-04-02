<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Salary_type extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "salary_type", true);
        $this->load->model('salary_type_model');      
    }
    public function get_salary_type_list()
    {
        echo "{\"data\" : " . json_encode($this->salary_type_model->get_salary_type_all()) . "}";
    }
    
    
     public function save_salary_type()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->salary_type_model->edit_salary_type($this->input->post());
        }
        else
        {
            $this->salary_type_model->add_salary_type($this->input->post());
        }
        
        return null;
    }
    
    public function delete_salary_type()
    {
        $this->salary_type_model->delete_salary_type($this->input->post('id'));
        
        return null;
    }
    
    public function init_edit_salary_type($id)
    {
        $data = array(
            'data_edit' => $this->salary_type_model->get_salary_type_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
}
?>
