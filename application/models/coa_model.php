<?php
class Coa_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_coa_all()
    {
        $this->db->select('*');
        $this->db->from('chart_of_account');

        return $this->db->get()->result_array();
    }

    public function get_coa_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('chart_of_account');
        $this->db->where('id_chart_of_account', $id);

        return $this->db->get()->result_array();
    }

    public function insert_coa($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "account_number" => $data['account_number'],
            "name" => $data['name'],
            "parent" => $data['parent'],
            "index" => $data['index'],
            "type" => $data['type']
        );

        $this->db->insert('chart_of_account', $data_input);
        $this->db->trans_complete();
    }

    public function edit_coa($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "account_number" => $data['account_number'],
            "name" => $data['name'],
            "parent" => $data['parent'],
            "index" => $data['index'],
            "type" => $data['type']
        );
        $this->db->where('id_chart_of_account', $data['id_chart_of_account']);
        $this->db->update('chart_of_account', $data_input);
        $this->db->trans_complete();
    }

    public function delete_coa($id)
    {
        $this->db->trans_start();

        $this->db->where('id_chart_of_account', $id);
        $this->db->delete('chart_of_account');

        $this->db->trans_complete();
    }
}
