<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Log_error extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "log_error", true);
        $this->load->model('log_error_model');      
    }
    public function get_log_error_list()
    {
        echo "{\"data\" : " . json_encode($this->log_error_model->get_log_error_all()) . "}";
    }
    
    public function get_customer_site_list($id)
    {
        echo "{\"data\" : " . json_encode($this->customer_model->get_customer_site($id)) . "}";
    }
    
     public function save_log_error()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->log_error_model->edit_log_error($this->input->post());
        }
        else
        {
            $this->log_error_model->add_log_error($this->input->post());
        }
        
        return null;
    }
    
    public function delete_log_error()
    {
        $this->log_error_model->delete_log_error($this->input->post('id'));
        
        return null;
    }
    
    public function init_edit_log_error($id)
    {
        $data = array(
            'data_edit' => $this->log_error_model->get_log_error_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
}
?>
