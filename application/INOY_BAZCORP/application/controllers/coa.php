<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Coa extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "coa", true);
        $this->load->model('coa_model');
    }

    public function get_coa_list()
    {
        echo "{\"data\" : " . json_encode($this->coa_model->get_coa_all()) . "}";
    }

    public function init_create_coa()
    {
        $parents = array();
        foreach ($this->coa_model->get_coa_all() as $data) {
            $parents[$data['id_chart_of_account']] = $data['account_number'] . ' - ' .  $data['name'];
        }
        return array(
            'parent' => $parents
        );
    }

    public function init_edit_coa($id)
    {
        $parents = array();
        foreach ($this->coa_model->get_coa_all() as $data) {
            $parents[$data['id_chart_of_account']] = $data['account_number'] . ' - ' .  $data['name'];
        }
        return array(
            'parent' => $parents,
            'is_edit' => 'true',
            'data_edit' => $this->coa_model->get_coa_by_id($id)
        );
    }

    public function save_coa()
    {
        if($this->input->post('is_edit') == 'false')
        {
            $this->coa_model->insert_coa($this->input->post());
        }
        else
        {
            $this->coa_model->edit_coa($this->input->post());
        }

        return null;
    }

    public function delete_coa()
    {
        $this->coa_model->delete_coa($this->input->post('id_chart_of_account'));

        return null;
    }
}