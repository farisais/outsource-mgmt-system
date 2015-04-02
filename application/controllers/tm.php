<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tm extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "type_material", true);
        $this->load->model('product_model');
          
    }
    public function get_tm_list()
    {
        echo "{\"data\":" .json_encode($this->product_model->get_tm_all()). "}";
    }
    
    public function save_tm()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->product_model->edit_tm($this->input->post());
        }
        else
        {
            $this->product_model->add_tm($this->input->post());
        }
        
        return null;
    }
    
    public function delete_tm()
    {
        $this->product_model->delete_tm($this->input->post('id_type_material'));
        
        return null;
    }
    
    public function init_edit_merk($id)
    {
        $data = array(
            'data_edit' => $this->product_model->get_tm_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
}
?>
