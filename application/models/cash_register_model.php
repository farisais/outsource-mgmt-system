<?php
class Cash_register_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_cash_register_all()
    {
        $this->db->select('*');
        $this->db->from('cash_register');

        return $this->db->get()->result_array();
    }

    public function get_cash_register_by_id($id)
    {
        $this->db->select('cash_register.*, chart_of_account.account_number, chart_of_account.name AS account_name');
        $this->db->from('cash_register');
        $this->db->join('chart_of_account', 'chart_of_account.id_chart_of_account=cash_register.account', 'left');
        $this->db->where('cash_register.id_cash_register', $id);

        return $this->db->get()->result_array();
    }

    public function insert_cash_register($data)
    {
        $this->db->trans_start();
        $data_input = array(
            'date' => $data['date'],
            'account' => $data['account'],
            'amount' => $data['amount'],
            'status' => $data['type'],
            'description' => $data['description']
        );
        $this->db->insert('cash_register', $data_input);
        $this->db->trans_complete();
    }

    public function edit_cash_register($data)
    {
        $this->db->trans_start();
        $data_input = array(
            'date' => $data['date'],
            'account' => $data['account'],
            'amount' => $data['amount'],
            'status' => $data['type'],
            'description' => $data['description']
        );
        $this->db->where('id_cash_register', $data['id_cash_register']);
        $this->db->update('cash_register', $data_input);
        $this->db->trans_complete();
    }

    public function delete_cash_register($id)
    {
        $this->db->trans_start();

        $this->db->where('id_cash_register', $id);
        $this->db->delete('cash_register');

        $this->db->trans_complete();
    }
}
