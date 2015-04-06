<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class fingerprint extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'fingerprint', true);
        $this->load->model('fingerprint_model');
	}
    
    public function get_fingerprint_list()
    {
        echo "{\"data\":" .json_encode($this->fingerprint_model->get_fingerprint_all()). "}";
    }
    
    public function save_fingerprint_device()
    {
        $id_fingerprint = null;
        $param = $this->input->post();
        if($this->input->post('is_edit') == 'true')
        {
            $id_fingerprint = $this->fingerprint_model->edit_fingerprint($this->input->post());
        }
        else
        {
            $id_fingerprint = $this->fingerprint_model->save_fingerprint($this->input->post());
        }
        
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_fingerprint);
        return array("log_param" => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function init_create_fingerprint_device()
    {
        return null;
    }
    
    public function init_edit_fingerprint_device($id)
    {
        $data = array();
        $data['is_edit'] = 'true';
        $data['data_edit'] = $this->fingerprint_model->get_fingerprint_by_id($id);
        
        return $data;
    }
    
    
    public function delete_fingerprint_device()
    {
        $this->fingerprint_model->delete_fingerprint($this->input->post('id_fingerprint'));
        
        return null;
    }
    
    public function activate_fingerprint($id)
    {
        $this->fingerprint_model->change_fingerprint_status($id, 'active');
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function deactivate_fingerprint($id)
    {
        $this->fingerprint_model->change_fingerprint_status($id, 'inactive');
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function register_command()
    {
        echo "{\"commandID\" :  \"" . $this->fingerprint_model->register_command($this->input->post()) . "\" }";
    }
    
    public function get_fingerprint_device_list()
    {
        echo "{\"data\":" .json_encode($this->fingerprint_model->get_fingerprint_all_active()). "}";
    }
    
    public function get_fingerprint_device_list_active()
    {
        echo "{\"data\":" .json_encode($this->fingerprint_model->get_fingerprint_all_active()). "}";
    }
    
    public function save_fingerprint_enroll()
    {
        $detail = $this->fingerprint_model->save_fingerprint_enroll($this->input->post());
        $respond = array();
        $respond['status'] = 'failed';
        if($detail != null)
        {
            $respond['status'] = 'success';
            $respond['data'] = $detail;
        }
         
        echo json_encode($respond);
    }
    
    public function open_console()
    {
        $data = array();
        $data['node_js_server'] = $this->appsetting_model->get_app_config_by_name('node_js_server');
        echo $this->load->view('console/console', $data, true);
    }
    
    public function init_fingerprint_enroll()
    {
        $data = array();
        $data['node_js_server'] = $this->appsetting_model->get_app_config_by_name('node_js_server');
        return $data;
    }
}
?>