<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Work_schedule extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "work_schedule", true);
        $this->load->model('work_schedule_model');
        $this->load->model('work_order_model');
          
    }
    public function get_work_schedule_list()
    {
        echo "{\"data\" : " . json_encode($this->work_schedule_model->get_work_schedule_all()) . "}";
    }

    public function get_work_schedule_detail_list()
    {
        echo "{\"data\" : " . json_encode($this->work_schedule_model->get_work_schedule_detail_all($this->input->get('id'))) . "}";
        //echo "{\"data\" : " . json_encode($this->work_order_model->get_work_order_salary_setting($id)) . "}";
    }
    
    public function get_quotation_schedule_detail_list($id)
    {
        echo "{\"data\" : " . json_encode($this->work_schedule_model->get_work_schedule_detail_by_quotation($id)) . "}";
    }    
    
    public function save_work_schedule()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->work_schedule_model->edit_work_schedule($this->input->post());
        }
        else
        {
            $this->work_schedule_model->add_work_schedule($this->input->post());
        }
        
        return null;
    }
    
    public function delete_work_schedule()
    {
        $this->work_schedule_model->delete_work_schedule($this->input->post('id_work_schedule'));
        
        return null;
    }
    
    public function init_edit_work_schedule($id)
    {
        $data = array(
            'data_edit' => $this->work_schedule_model->get_work_schedule_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_work_schedule()
    {
        $data = array(
            'make_quotation' => null
        );

        if ($this->input->post('id_quotation')) {
            $this->db->select('quotation.*, inquiry.customer, inquiry.inquiry_number, ext_company.name AS customer_name');
            $this->db->from('quotation');
            $this->db->join('inquiry', 'inquiry.id_inquiry=quotation.inquiry', 'LEFT');
            $this->db->join('ext_company', 'ext_company.id_ext_company = inquiry.customer');            
            $this->db->where('quotation.id_quotation', $this->input->post('id_quotation'));
            $rows = $this->db->get()->result_array();
            
            $data = array(
                'make_quotation' => $rows
            );
        }
        
        return $data;
    }
}
?>
