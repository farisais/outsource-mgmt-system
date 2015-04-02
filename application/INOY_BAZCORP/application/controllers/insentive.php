<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Insentive extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "insentive", true);
        $this->load->model('insentive_model');      
    }
    public function get_insentive_list()
    {
        echo "{\"data\" : " . json_encode($this->insentive_model->get_insentive_all()) . "}";
    }
    
    
     public function save_insentive()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->insentive_model->edit_insentive($this->input->post());
        }
        else
        {
            $this->insentive_model->add_insentive($this->input->post());
        }
        
        return null;
    }
    
    public function delete_insentive()
    {
        $this->insentive_model->delete_insentive($this->input->post('id'));
        
        return null;
    }
    
    public function init_edit_insentive($id)
    {
        $data = array(
            'data_edit' => $this->insentive_model->get_insentive_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    public function init_create_intensive()
    {
        $data['salarytype'] = $this->insentive_model->get_combo_salary_type();
        $data['employees'] = $this->insentive_model->get_combo_employees();
        $data['payroll_periodes'] = $this->insentive_model->get_combo_payroll_periodes();
        
        return $data;
    }    
}
?>
