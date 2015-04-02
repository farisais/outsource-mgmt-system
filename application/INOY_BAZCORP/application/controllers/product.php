<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "product", true);
        $this->load->model('product_model');
        $this->load->model('unit_measure_model');
    }
    public function get_product_list()
    {
        echo "{\"data\" : " . json_encode($this->product_model->get_product_all()) . "}";
    }
    
    public function init_create_product()
    {
        $data = array(
            "unit_measure" => $this->unit_measure_model->get_unit_measure_all(),
            "product_category" => $this->product_model->get_product_category_all(),
            "merk" => $this->product_model->get_merk_all(),
            "type_material" => $this->product_model->get_tm_all(),
        );
        
        return $data;
    }
    
    public function save_product()
    {
        if($this->input->post('is_edit') == 'false')
        {
            $this->product_model->save_product($this->input->post());
        }
        else
        {
            $this->product_model->edit_product($this->input->post());
        }
    }
    
    public function delete_product()
    {
        $this->product_model->delete_product($this->input->post('id_product'));
    }
    
    public function init_edit_product($id)
    {
        $data = array(
            "unit_measure" => $this->unit_measure_model->get_unit_measure_all(),
            "product_category" => $this->product_model->get_product_category_all(),
            "merk" => $this->product_model->get_merk_all(),
            "type_material" => $this->product_model->get_tm_all(),
            "data_edit" => $this->product_model->get_product_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;
    }
}
?>
