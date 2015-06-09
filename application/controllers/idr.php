<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Idr extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "internal_delivery_return", true);
        $this->load->model('idr_model');
        $this->load->model('so_model');
        $this->load->model('id_model');
        $this->load->model('stock_transaction_model');
        $this->load->model('project_list_model');

          
    }
    public function get_idr_list()
    {
        echo "{\"data\" : " . json_encode($this->idr_model->get_idr_all()) . "}";
    }
    
     public function save_idr()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->idr_model->edit_idr($this->input->post());
        }
        else
        {
            $this->idr_model->add_idr($this->input->post());
        }
        
        return null;
    }
     public function validate_idr($id)
    {
        $data = $this->input->post();
        $in = $this->idr_model->get_idr_by_id($id);
        $pl = $this->project_list_model->get_pl_by_id_so($in[0]['so']);
        $this->stock_transaction_model->automatic_stock_transaction($in[0]['idr_number'], 'internal_delivery', date('Y-m-d H:i:s'), $this->idr_model->get_virtual_location(), $data['product_detail']);
        if($data['is_close_pl'] == 1)
        {
            foreach($pl as $p)
            {
                $this->project_list_model->change_pl_status($p['id_project_list'], 'close');
            }
            
        }
        
        $this->idr_model->change_idr_status($id, 'close');
        //$this->id_model->change_id_status($data[internal_delivery], 'close');
    }
    public function delete_idr()
    {
        $this->idr_model->change_idr_status($this->input->post('id_internal_delivery_return'), 'void');
    }
    
    public function init_edit_idr($id)
    {
        $data = array(

            'data_edit' => $this->idr_model->get_idr_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function view_idr_detail($id)
    {
        $data = array(

            'data_edit' => $this->idr_model->get_idr_by_id($id),
            'is_edit' => true,
            'is_view' => true
        );
        
        return $data;
    }
    
    public function get_idr_history_list()
    {
        echo "{\"data\" : " . json_encode($this->idr_model->get_idr_history($this->input->get('so'), $this->input->get('idr'))) . "}";
    }
    
    public function get_idr_product_list()
    {
        echo "{\"data\" : " . json_encode($this->idr_model->get_idr_product_by_id($this->input->get('id'))) . "}";
    }
    
    
}
