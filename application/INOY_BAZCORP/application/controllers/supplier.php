<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supplier extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "supplier", true);
        $this->load->model('supplier_model');
          
    }
    public function get_supplier_list()
    {
        echo "{\"data\" : " . json_encode($this->supplier_model->get_supplier_all()) . "}";
    }
    
     public function save_supplier()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->supplier_model->edit_supplier($this->input->post());
        }
        else
        {
            $this->supplier_model->add_supplier($this->input->post());
        }
        
        return null;
    }
    
    public function delete_supplier()
    {
        $this->supplier_model->delete_supplier($this->input->post('id_ext_company'));
        
        return null;
    }
    
    public function init_edit_supplier($id)
    {
        $data = array(
            'data_edit' => $this->supplier_model->get_supplier_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
}
?>
