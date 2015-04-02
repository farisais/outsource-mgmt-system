<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_barcode extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "product_barcode", true);
        $this->load->model('po_model');
        $this->load->model('unit_measure_model');
        $this->load->model('product_model');
       
    }
    public function get_product_from_barcode()
    {
        echo "{\"data\" : " . json_encode($this->po_model->get_product_from_barcode($this->input->post('barcode'))) . "}";
    }
    
    public function view_product_barcode()
    {
        return null;
    }
    
    public function get_barcode_list()
    {
        echo "{\"data\" : " . json_encode($this->po_model->get_barcode_list()) . "}";
    }
}
?>
