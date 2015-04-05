<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Timesheet extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "timesheet", true);
        $this->load->model('timesheet_model');
          
    }
    public function get_timesheet_list()
    {
        echo '{"data" : ' . json_encode($this->timesheet_model->get_timesheet_all()) . '}';
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
            'data_edit' => $this->timesheet_model->get_timesheet_group_by_id($id),
            'work_orders' =>$this->timesheet_model->get_list_work_order(),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_timesheet()
    {
        $data['work_orders'] = $this->timesheet_model->get_list_work_order();
        
        return $data;
    }
    public function get_employee()
    {   
        $id=$this->uri->segment(3);
        echo "{\"data\" : " . json_encode($this->timesheet_model->get_employee($id)) . "}";
    }
    function success($msg){
            $data['success'] = 'success';
            $data['msg'] = "Data $msg saved";
            echo json_encode($data);	
    }	

    function error($msg){
            $data['msg'] = $msg;
            echo json_encode($data);	
    }	
    function cek_master_timesheet(){
         $date=$this->input->post('date');
         $work_order=$this->input->post('work_order');
         if($this->timesheet_model->get_timesheet_by_date($date,$work_order) == true){
             echo json_encode(array("success"=>true));
         }else{
              echo json_encode(array("success"=>false));
         }
     }
     function get_detail_employee_on_edit(){
        //var_dump($this->timesheet_model->get_detail_employee_on_edit($id));
        $id=$this->input->get('id');
         echo "{\"data\" : " . json_encode($this->timesheet_model->get_detail_employee_on_edit($id)) . "}";
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
