<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "stock", true);
        $this->load->model('stock_model');
        $this->load->model('unit_measure_model');
        $this->load->model('product_model');
       
    }
    public function get_stock_list()
    {
        echo "{\"data\" : " . json_encode($this->stock_model->get_stock_all()) . "}";
    }
    
    public function calculate_stock_all()
    {
         echo "{\"data\" : " . json_encode($this->stock_model->get_stock_all()) . "}";
    }
    
    public function get_stock_gudang()
    {
        echo "{\"data\" : " . json_encode($this->stock_model->get_detail_stock()) . "}";
    }
    
    public function get_stock_from_warehouse()
    {
        $product = $this->input->get('prod');
        $warehouse = $this->input->get('wh');
        $data = $this->stock_model->get_stock_from_warehouse($product, $warehouse);
        echo json_encode($data);
    }
}
?>
