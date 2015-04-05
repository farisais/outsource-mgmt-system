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

    public function get_work_schedule_detail_list($id)
    {
        echo "{\"data\" : " . json_encode($this->work_schedule_model->get_work_schedule_detail_all($id)) . "}";
    }
    
    public function get_quotation_schedule_detail_list($id)
    {
        echo "{\"data\" : " . json_encode($this->work_schedule_model->get_work_schedule_detail_by_quotation($id)) . "}";
    }    
    

    
    
}
?>
