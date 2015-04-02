<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bank extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "bank", true);
        $this->load->model('bank_model');
    }

    public function get_bank_list()
    {
        echo "{\"data\" : " . json_encode($this->bank_model->get_bank_all()) . "}";
    }

    public function init_create_bank()
    {
        return null;
    }

    public function init_edit_bank($id)
    {
        return array(
            'is_edit' => 'true',
            'data_edit' => $this->bank_model->get_bank_by_id($id)
        );
    }

    public function save_bank()
    {
        if($this->input->post('is_edit') == 'false')
        {
            $this->bank_model->insert_bank($this->input->post());
        }
        else
        {
            $this->bank_model->edit_bank($this->input->post());
        }

        return null;
    }

    public function delete_bank()
    {
        $this->bank_model->delete_bank($this->input->post('id_bank'));

        return null;
    }
}