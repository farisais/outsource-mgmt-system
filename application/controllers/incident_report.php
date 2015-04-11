<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Incident_report extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "incident_report", true);
        $this->load->model('incident_report_model');
    }

    function get_incident_report_list()
    {
        echo "{\"data\" : " . json_encode($this->incident_report_model->get_incident_report_all()) . "}";
    }

    function init_create_incident_report()
    {
        return null;
    }
    
     public function init_edit_incident_report($id)
    {
        $data = array(
            'data_edit' => $this->incident_report_model->get_incident_report_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function save_incident_report()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->incident_report_model->edit_incident_report($this->input->post());
        }
        else
        {
            $this->incident_report_model->add_incident_report($this->input->post());
        }
        
        return null;
    }
    
    function delete_incident_report(){
        $this->incident_report_model->delete_incident_report($this->input->post('id'));
        
        return null;
    }
    
    public function get_incident_report_thirdparty_temp(){
        echo "{\"data\" : " . json_encode($this->incident_report_model->get_incident_report_thirdparty_temp()) . "}";
    }
    
    public function get_incident_report_thirdparty($id){
        echo "{\"data\" : " . json_encode($this->incident_report_model->get_incident_report_thirdparty($id)) . "}";
    }
    
    function save_temp(){
        $id=$this->input->post('id_employee');
        $data=array('employee_id'=>$id);
        $this->db->insert('incident_report_thirdparty_temp',$data);
        return true;
    }
    
    function save_incident_bottom(){
        $id_employee=$this->input->post('id_employee');
        $id_incident=$this->input->post('id_incident');
        $data=array('employee_id'=>$id_employee,'incident_id'=>$id_incident);
        $this->db->insert('incident_report_thirdparty',$data);
        return true;
    }
    
    function delete_temp(){
        $id=$this->input->post('id_employee');
        $this->db->where('id',$id);
        $this->db->delete('incident_report_thirdparty_temp');
        return true;
    }
    
    function delete_incident_bottom(){
        $id=$this->input->post('id_employee');
        $this->db->where('id',$id);
        $this->db->delete('incident_report_thirdparty');
        return true;
    }

}
