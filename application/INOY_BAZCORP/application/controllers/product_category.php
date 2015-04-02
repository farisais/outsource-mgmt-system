<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_category extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "product_category", true);
        $this->load->model('product_model');
          
    }
    public function get_product_category_list()
    {
        echo "{\"data\":" .json_encode($this->product_model->get_product_category_all()). "}";
    }
    
    public function save_product_category()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->product_model->edit_product_category($this->input->post());
        }
        else
        {
            $this->product_model->add_product_category($this->input->post());
        }
        
        return null;
    }
    
    public function delete_product_category()
    {
        $this->product_model->delete_product_category($this->input->post('id_product_category'));
        
        return null;
    }
    
    public function init_edit_product_category($id)
    {
        $data = array(
            'data_edit' => $this->product_model->get_product_category_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
}
?>
