<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Idr extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "internal_delivery_return", true);
        $this->load->model('idr_model');
          
    }
    public function get_idr_list()
    {
        echo "{\"data\" : " . json_encode($this->idr_model->get_idr_all()) . "}";
    }
    
     public function save_id()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->id_model->edit_id($this->input->post());
        }
        else
        {
            $this->id_model->add_id($this->input->post());
        }
        
        return null;
    }
     public function validate_id($id)
    {
        $data = $this->input->post();
        $in = $this->id_model->get_id_by_id($id);
        $this->stock_transaction_model->automatic_stock_transaction_out($in[0]['id_number'], 'internal_delivery', date('Y-m-d H:i:s'), $this->id_model->get_virtual_location(), $data['products']);
        $this->id_model->change_id_status($id, 'open');
    }
    public function delete_id()
    {
        $this->id_model->delete_id($this->input->post('id_internal_delivery'));
        
        return null;
    }
    
    public function edit_id($id)
    {
        $data = array(
            'data_edit' => $this->id_model->get_id_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    public function get_id_product_list()
    {
        echo "{\"data\" : " . json_encode($this->id_model->get_id_product_by_id($this->input->get('id'))) . "}";
    }
    
    
}
