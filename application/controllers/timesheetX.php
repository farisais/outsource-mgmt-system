<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Timesheet extends MY_Controller
{
    function __construct() {
        parent::__construct("not_authorize", "timesheet", true);
        $this->load->model('timesheet_model');
          
    }
    public function get_timesheet_list()
    {
        echo "{'data' : " . json_encode($this->timesheet_model->get_timesheet_all()) . "}";
    }
    
     public function save_timesheet()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->timesheet_model->edit_timesheet($this->input->post());
        }
        else
        {
            $this->timesheet_model->save_timesheet($this->input->post());
        }
        
        return null;
    }
    
    public function delete_timesheet()
    {
        $this->timesheet_model->delete_timesheet($this->input->post('id_timesheet'));
        
        return null;
    }
    
    public function init_edit_timesheet($id)
    {
        $data = array(
            'data_edit' => $this->timesheet_model->get_timesheet_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_timesheet()
    {
        return null;
    }
    
    public function entry_timesheet_fingeprint_log()
    {
        $data = $this->input->post();
        //echo json_encode($data);
        switch($data['command'])
        {
            case "att_transaction":
                //echo json_encode($data);
                $this->timesheet_model->entry_timesheet_raw($data, 'fingerprint_att_rte');
                echo 'successfully save timesheet raw data';
            break;
            case "request_transaction":
                //echo json_encode($data);
                $this->timesheet_model->entry_timesheet($data['data'],'fingerprint_sch');
                echo 'successfully save timesheet data';
            break;
        }
        
    }
    
    public function entry_timesheet_data()
    {
        $data = $this->input->post();
        $this->timesheet_model->entry_timesheet_raw($data, 'fingerprint_att_rte');
        echo 'successfully save timesheet raw data';
    }
}
?>
