<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quotation extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "quotation", true);
        $this->load->model('quotation_model');      
    }
    
    public function get_quotation_list()
    {
        echo "{\"data\" : " . json_encode($this->quotation_model->get_quotation_all($this->input->get('status'))) . "}";
    }
    
    public function get_quotation_product_list()
    {
        echo "{\"data\" : " . json_encode($this->quotation_model->get_quotation_product($this->input->get('id'))) . "}";
    }
    
    public function get_quotation_survey_list()
    {
        echo "{\"data\" : " . json_encode($this->quotation_model->get_quotation_survey($this->input->get('id'))) . "}";
    }
    
    public function get_quotation_working_schedule_list()
    {
        echo "{\"data\" : " . json_encode($this->quotation_model->get_quotation_working_schedule($this->input->get('id'))) . "}";
    }
    
    public function save_quotation()
    {
         // var_dump($this->input->post()); die();
        if($this->input->post('is_edit') == 'true')
        {
            $this->quotation_model->edit_quotation($this->input->post());
        }
        else
        {
            $this->quotation_model->add_quotation($this->input->post());
        }
        
        return null;
    }
    
    public function delete_quotation()
    {
        $this->quotation_model->delete_quotation($this->input->post('id_quotation'));
        
        return null;
    }
    
    public function init_edit_quotation($id)
    {
        $data = array(
            'data_edit' => $this->quotation_model->get_quotation_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_quotation()
    {
        return null;
    }
    
    public function make_working_schedule()
    {
        $id = $this->input->post('id_quotation');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "quotation", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function validate_quotation($id)
    {
        $param = $this->quotation_model->validate_quotation($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function upload_survey()
    {
        $this->load->library('upload');

        $config['upload_path'] = './documents/survey';
        $config['overwrite'] = true;
        $config['allowed_types'] = '*';
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('survey_file')) {
            $uploaded = $this->upload->data();
            $filename = $this->quotation_model->add_quotation_survey_file($uploaded);
            rename($uploaded['full_path'], $config['upload_path'] . '/' . $filename);
            echo $filename;
        }

        echo $this->upload->display_errors();
    }
    
    
}
?>
