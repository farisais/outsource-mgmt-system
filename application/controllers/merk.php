<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Merk extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "merk", true);
        $this->load->model('product_model');
          
    }
    public function get_merk_list()
    {
        echo "{\"data\":" .json_encode($this->product_model->get_merk_all()). "}";
    }
    
    public function save_merk()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->product_model->edit_merk($this->input->post());
        }
        else
        {
            $this->product_model->add_merk($this->input->post());
        }
        
        return null;
    }
    
    public function delete_merk()
    {
        $this->product_model->delete_merk($this->input->post('id_merk'));
        
        return null;
    }
    
    public function init_edit_merk($id)
    {
        $data = array(
            'data_edit' => $this->product_model->get_merk_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function view_merk_detail($id)
    {
        $data = array(
            'data_edit' => $this->product_model->get_merk_by_id($id),
            'is_edit' => true,
            'is_view' => true
        );
        
        return $data;
    }
    
}
?>
