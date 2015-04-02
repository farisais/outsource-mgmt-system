<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class So extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "so", true);
        $this->load->model('so_model');
    }
    
    public function get_so_list()
    {
        echo "{\"data\" : " . json_encode($this->so_model->get_so_all()) . "}";
    }
    
    public function get_so_product_list()
    {
        echo "{\"data\" : " . json_encode($this->so_model->get_so_product($this->input->get('id'))) . "}";
    }
    
    public function get_so_contract_list()
    {
        echo "{\"data\" : " . json_encode($this->so_model->get_so_contract($this->input->get('id'))) . "}";
    }
    
    public function get_so_schedule_list() 
    {
        echo "{\"data\" : " . json_encode($this->so_model->get_so_schedule_detail($this->input->get('id'))) . "}";
    }
    
    public function save_so() 
    {
        // var_dump($this->input->post()); die();
        if ($this->input->post('is_edit') == 'true')
        {
            $this->so_model->edit_so($this->input->post());
        }
        else
        {
            $this->so_model->add_so($this->input->post());
        }
        
        return null;
    }
    
    public function delete_so()
    {
        $this->so_model->delete_so($this->input->post('id_so'));
        
        return null;
    }
    
    public function init_edit_so($id)
    {
        $data = array(
            'data_edit' => $this->so_model->get_so_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_so()
    {
        return null;
    }
    
    public function validate_so($id)
    {
        $param = $this->so_model->validate_so($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function confirm_so($id)
    {
        $param = $this->so_model->confirm_so($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $param['id_work_order']);
        
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function upload_contract()
    {
        $this->load->library('upload');

        $config['upload_path'] = './documents/contract';
        $config['overwrite'] = true;
        $config['allowed_types'] = '*';
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('contract_file')) {
            $uploaded = $this->upload->data();
            echo $uploaded['orig_name'];
        }

        echo $this->upload->display_errors();
    }
}
