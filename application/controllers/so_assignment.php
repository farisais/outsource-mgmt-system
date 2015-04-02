<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class So_assignment extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "so_assignment", true);
        $this->load->model('so_assignment_model');
        $this->load->model('work_order_model');          
    }
    
    public function get_so_assignment_list()
    {
        echo "{\"data\" : " . json_encode($this->so_assignment_model->get_so_assignment_all()) . "}";
    }
    
    public function get_so_assignment_employee_list()
    {
        echo "{\"data\" : " . json_encode($this->so_assignment_model->get_so_assignment_employee($this->input->get('id'))) . "}";
    }
    
    public function save_so_assignment()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->so_assignment_model->edit_so_assignment($this->input->post());
        }
        else
        {
            $this->so_assignment_model->save_so_assignment($this->input->post());
        }
        
        return null;
    }
    
    public function delete_so_assignment()
    {
        $this->so_assignment_model->delete_so_assignment($this->input->post('id_so_assignment'));
        
        return null;
    }
    
    public function init_edit_so_assignment($id)
    {
        $data = array(
            'data_edit' => $this->so_assignment_model->get_so_assignment_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_so_assignment()
    {
        $data = array(
            'make_work_order' => null
        );
        
        if ($this->input->post('id_work_schedule')) {
            $this->db->select('work_schedule.*, quotation.quote_number');
            $this->db->from('work_schedule');
            $this->db->join('quotation', 'quotation.id_quotation=work_schedule.quotation', 'LEFT');
            $this->db->where('work_schedule.id_work_schedule', $this->input->post('id_work_schedule'));
            $rows = $this->db->get()->result_array();
            
            $data = array(
                'make_work_order' => $rows
            );
        }
        // var_dump($data); die();
        return $data;
    }
    
    public function change_fp_assign_status_bulk()
    {
        $data = $this->input->post();
        
        //echo print_r($data['employee_result']);
        $this->so_assignment_model->change_status_fp_assign_bulk($data['employee_result']);
        
        
        echo 'success';
    }
}
?>
