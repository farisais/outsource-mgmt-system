<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gudang extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'gudang', true);
        $this->load->model('warehouse_model');
	}
	
	public function index()
	{
        $this->data['title'] = 'Warehouse | ' . $this->config->item('application_name');
	    $this->data['content'] = $this->content_view;        
        $this->template->load('default', 'warehouse/index', $this->data);
	}
    
    public function save_gudang()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->warehouse_model->edit_warehouse($this->input->post());
        }
        else
        {
             $this->warehouse_model->add_warehouse($this->input->post());
        }
        
        return null;
    }
    
    public function init_edit_gudang($id)
    {
        $data = array();
        $data['is_edit'] = 'true';
        $data['data_edit'] = $this->warehouse_model->get_warehouse_by_id($id);
        
        return $data;
    }
    
    public function get_gudang_list()
    {
        echo "{\"data\":" . json_encode($this->warehouse_model->get_warehouse_all()) . "}"; 
    }
    
    public function get_gudang_not_virtual_list()
    {
        echo "{\"data\":" . json_encode($this->warehouse_model->get_warehouse_not_virtual()) . "}"; 
    }
}
?>