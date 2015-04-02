<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Po extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "po", true);
        $this->load->model('po_model');
          
    }
    public function get_po_list()
    {
        echo "{\"data\" : " . json_encode($this->po_model->get_po_all()) . "}";
    }
    
    
    public function save_po()
    {
        $param = null;
        if($this->input->post('is_edit') == 'false')
        {
            $param = $this->po_model->save_po($this->input->post());
        }
        else
        {
            $param = $this->po_model->edit_po($this->input->post());
        }
        
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $param['id_po']);
        return array("log_param" => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function validate_po($id)
    {
        $param = null;
        $param = $this->po_model->validate_po($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function init_edit_po($id)
    {
        $data = array(
            "po_product" => $this->po_model->get_po_product_by_id($id),
            "data_edit" => $this->po_model->get_po_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;
    }
    
    public function get_po_product_list()
    {
        echo "{\"data\" : " . json_encode($this->po_model->get_po_product_by_id($this->input->get('id'))) . "}";
    }
    
    public function get_po_open_list()
    {
        echo "{\"data\" : " . json_encode($this->po_model->get_po_open()) . "}";
    }
}
?>
