<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fingerprint_assign extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'fingerprint_assign', true);
        $this->load->model('fingerprint_assign_model');
	}
    
    public function get_fingerprint_assign_list()
    {
        echo "{\"data\":" .json_encode($this->fingerprint_assign_model->get_fingerprint_assign_all()). "}";
    }
    
    public function get_fingerprint_assign_all_assgined()
    {
        echo "{\"data\":" .json_encode($this->fingerprint_assign_model->get_fingerprint_assign_all_assgined()). "}";
    }
    
    public function save_fingerprint_assign()
    {
        $id_fingerprint_assign = null;
        $param = $this->input->post();
        if($this->input->post('is_edit') == 'true')
        {
            $id_fingerprint_assign = $this->fingerprint_assign_model->edit_fingerprint_assign($this->input->post());
        }
        else
        {
            $id_fingerprint_assign = $this->fingerprint_assign_model->save_fingerprint_assign($this->input->post());
        }
        
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_fingerprint_assign);
        return array("log_param" => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function init_create_fingerprint_assign()
    {
        return null;
    }
    
    public function get_fingerprint_assign_detail()
    {
        echo "{\"data\":" .json_encode($this->fingerprint_assign_model->get_fingerprint_assign_detail($this->input->get('id'))). "}";
    }

    public function get_fingerprint_assign_detail_by_wo()
    {
        echo "{\"data\":" .json_encode($this->fingerprint_assign_model->get_fingerprint_assign_detail_by_wo($this->input->get('wo'))). "}";
    }
    
    public function init_edit_fingerprint_assign($id)
    {
        $data = array();
        $data['is_edit'] = 'true';
        $data['data_edit'] = $this->fingerprint_assign_model->get_fingerprint_assign_by_id($id);
        
        return $data;
    }
 
    public function delete_fingerprint_assign()
    {
        $this->fingerprint_assign_model->delete_fingerprint_assign($this->input->post('id_fingerprint_assign'));
        
        return null;
    }
    
    public function save_fingerprint_assign_from_wo()
    {
        $data = $this->input->post();
        //exit(print_r($data['work_order']));
        $return_data = array();
        $return_data['employee_assign'] = $this->fingerprint_assign_model->save_assign_from_wo($data);
        $return_data['status'] = 'success';
        
        echo json_encode($return_data);
    }
    
    public function assign_fingerprint($id)
    {
        $this->fingerprint_assign_model->change_fingerprint_assign_status($id, "assigned");
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function assign_fingerprint_device_from_wo()
    {
        $data = $this->input->post();
        //exit(print_r($data['work_order']));
        $return_data = array();
        $this->fingerprint_assign_model->change_fingerprint_assign_status_from_wo($data['work_order'], 'assigned');
        $return_data['status'] = 'success';
        
        echo json_encode($return_data);
    }
    
    public function unassign_fingerprint($id)
    {
        $this->fingerprint_assign_model->change_fingerprint_assign_status($id, "unassign");
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
}
?>