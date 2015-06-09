<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gr extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "gr", true);
        $this->load->model('gr_model');
        $this->load->model('po_model');
        $this->load->model('stock_transaction_model');
          
    }
    public function get_gr_list()
    {
        echo "{\"data\" : " . json_encode($this->gr_model->get_gr_all()) . "}";
    }
    
    public function get_gr_history_list()
    {
        echo "{\"data\" : " . json_encode($this->gr_model->get_gr_history($this->input->get('po'), $this->input->get('gr'))) . "}";
    }
    
     public function init_gr_product()
    {
        $data = array(
            "po" => $this->po_model->get_po_all(),
            "gr" => $this->gr_model->get_gr_all(),
            
        );
        
        return $data;
    }
    
    public function init_create_gr()
    {
        $data = array();
        if($this->input->post('id_po'))
        {
            $data['from_po'] = 'true';
            $data['po'] = $this->po_model->get_po_by_id($this->input->post('id_po'));
        }
        
        return $data;
    }
     
    public function save_gr()
    {
        if($this->input->post('is_edit') == 'false')
        {
            $this->gr_model->save_gr($this->input->post());
        }
        else
        {
            $this->gr_model->edit_product($this->input->post());
        }
    }
    
    public function delete_gr()
    {
        $dataGR = $this->gr_model->get_gr_by_id($id);
        
        $this->gr_model->change_gr_status($this->input->post('id_gr'), 'void');
        if($dataRG[0]['status'] == 'transfered')
        {
            $gr = $this->gr_model->get_gr_by_id($id);
            $data = $this->gr_model->get_gr_product_by_id($id);
            $this->stock_transaction_model->automatic_stock_transaction_out('void ' + $gr[0]['gr_number'], 'good_receive', date('Y-m-d H:i:s'), $this->gr_model->get_virtual_location(), $data['product']);
        }
    }
    
    public function init_edit_gr($id)
    {
        $data = array(
            "po" => $this->po_model->get_po_all(),
            "gr" => $this->gr_model->get_gr_all(),
            "data_edit" => $this->gr_model->get_gr_by_id($id),
            "is_edit" => 'true'
        );
        
        return $data;   
    }
    
    public function view_gr_detail($id)
    {
        $data = array(
            "po" => $this->po_model->get_po_all(),
            "gr" => $this->gr_model->get_gr_all(),
            "data_edit" => $this->gr_model->get_gr_by_id($id),
            "is_edit" => 'true',
            "is_view" => 'true'
        );
        
        return $data;   
    }
    
    public function get_gr_product_list()
    {
        echo "{\"data\" : " . json_encode($this->gr_model->get_gr_product_by_id($this->input->get('id'))) . "}";
    }
    
    public function transfer_gr($id)
    {
        $data = $this->input->post();
        $gr = $this->gr_model->get_gr_by_id($id);
        $this->stock_transaction_model->automatic_stock_transaction($gr[0]['gr_number'], 'good_receive', date('Y-m-d H:i:s'), $this->gr_model->get_virtual_location(), $data['products']);
        $this->gr_model->change_gr_status($id, 'transfer');
        
        return null;
    }
}
?>
