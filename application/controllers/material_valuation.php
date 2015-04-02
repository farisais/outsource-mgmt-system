<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Material_valuation extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "material_valuation", true);
        $this->load->model('material_valuation_model');
        $this->load->model('unit_measure_model');
        $this->load->model('product_model');
       
    }
    public function get_material_valuation_list()
    {
        echo "{\"data\" : " . json_encode($this->material_valuation_model->get_material_valuation_all()) . "}";
    }
    
    public function calculate_material_valuation_all()
    {
         echo "{\"data\" : " . json_encode($this->material_valuation_model->get_material_valuation_all()) . "}";
    }
    
    public function get_detail_material_valuation()
    {
        echo "{\"data\" : " . json_encode($this->material_valuation_model->get_detail_material_valuation()) . "}";
    }
}
?>
