<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "customer", true);
        $this->load->model('customer_model');
        $this->load->model('master_model');
          
    }
    public function get_customer_list()
    {
        echo "{\"data\" : " . json_encode($this->customer_model->get_customer_all()) . "}";
    }
    
    public function get_customer_site_list($id)
    {
        echo "{\"data\" : " . json_encode($this->customer_model->get_customer_site($id)) . "}";
    }
    
     public function save_customer()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->customer_model->edit_customer($this->input->post());
        }
        else
        {
            $this->customer_model->add_customer($this->input->post());
        }
        
        return null;
    }
    
    public function delete_customer()
    {
        $this->customer_model->delete_customer($this->input->post('id_ext_company'));
        
        return null;
    }
    
    public function init_edit_customer($id)
    {
        $data = array(
            'data_edit' => $this->customer_model->get_customer_by_id($id),
            'cities' => $this->master_model->get_city_all(),
            'sites' => $this->customer_model->get_customer_site($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_view($id)
    {
        $data = $this->init_edit_customer($id);
        $data['is_view'] = true;
        
        return $data;
    }
    
    public function init_create_customer()
    {
        $data = array(
            'cities' => $this->master_model->get_city_all(),
        );
        
        return $data;
    }
}
?>
