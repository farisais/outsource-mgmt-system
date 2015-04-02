<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cash_register extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "cash_register", true);
        $this->load->model('cash_register_model');
    }

    function get_cash_register_list()
    {
        echo "{\"data\" : " . json_encode($this->cash_register_model->get_cash_register_all()) . "}";
    }
    
    function init_create_cash_register()
    {
        return null;
    }

    function init_edit_cash_register($id)
    {
        return array(
            'is_edit' => 'true',
            'data_edit' => $this->cash_register_model->get_cash_register_by_id($id)
        );
    }

    public function save_cash_register()
    {
        if($this->input->post('is_edit') == 'false')
        {
            $this->cash_register_model->insert_cash_register($this->input->post());
        }
        else
        {
            $this->cash_register_model->edit_cash_register($this->input->post());
        }
        return null;
    }

    public function delete_cash_register()
    {
        $this->cash_register_model->delete_cash_register($this->input->post('id_cash_register'));

        return null;
    }
}
