<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bank_statement extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "bank_statement", true);
        $this->load->model('bank_statement_model');
    }

    function get_bank_statement_list()
    {
        echo "{\"data\" : " . json_encode($this->bank_statement_model->get_bank_statement_all()) . "}";
    }

    function init_create_bank_statement()
    {
        return null;
    }

    function init_edit_bank_statement($id)
    {
        return array(
            'is_edit' => 'true',
            'data_edit' => $this->bank_statement_model->get_bank_statement_by_id($id)
        );
    }

    public function save_bank_statement()
    {
        if($this->input->post('is_edit') == 'false')
        {
            $this->bank_statement_model->insert_bank_statement($this->input->post());
        }
        else
        {
            $this->bank_statement_model->edit_bank_statement($this->input->post());
        }
        return null;
    }

    public function delete_bank_statement()
    {
        $this->bank_statement_model->delete_bank_statement($this->input->post('id_bank_statement'));

        return null;
    }
}
