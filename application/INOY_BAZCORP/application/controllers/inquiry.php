<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inquiry extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "inquiry", true);
        $this->load->model('inquiry_model');
    }
    
    public function get_inquiry_list()
    {
        echo "{\"data\" : " . json_encode($this->inquiry_model->get_inquiry_all($this->input->get('status'))) . "}";
    }
    
    public function get_inquiry_product_list()
    {
        echo "{\"data\" : " . json_encode($this->inquiry_model->get_inquiry_product($this->input->get('id'))) . "}";
    }
    
    public function save_inquiry()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->inquiry_model->edit_inquiry($this->input->post());
        }
        else
        {
            $this->inquiry_model->add_inquiry($this->input->post());
        }
        
        return null;
    }
    
    public function delete_inquiry()
    {
        $this->inquiry_model->delete_inquiry($this->input->post('id_inquiry'));
        
        return null;
    }
    
    public function init_edit_inquiry($id)
    {
        $data = array(
            'data_edit' => $this->inquiry_model->get_inquiry_by_id($id),
            'inquiry_products' => $this->inquiry_model->get_inquiry_product($id),
            'is_edit' => true
        );

        // var_dump($data); die();
        return $data;
    }
    
    public function init_create_inquiry()
    {
        return null;
    }
    
    public function validate_inquiry($id)
    {
        $param = $this->inquiry_model->validate_inquiry($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
}
?>
