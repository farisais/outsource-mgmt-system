<?php
class Bank_statement_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_bank_statement_all()
    {
        $this->db->select('*');
        $this->db->from('bank_statement');

        return $this->db->get()->result_array();
    }

    public function get_bank_statement_by_id($id)
    {
        $this->db->select('bank_statement.*, chart_of_account.account_number, chart_of_account.name AS account_name');
        $this->db->from('bank_statement');
        $this->db->join('chart_of_account', 'chart_of_account.id_chart_of_account=bank_statement.account', 'left');
        $this->db->where('bank_statement.id_bank_statement', $id);

        return $this->db->get()->result_array();
    }

    public function insert_bank_statement($data)
    {
        $this->db->trans_start();
        $data_input = array(
            'date' => $data['date'],
            'account' => $data['account'],
            'amount' => $data['amount'],
            'status' => $data['type'],
            'description' => $data['description'],
            'recipient' => $data['recipient']
        );
        $this->db->insert('bank_statement', $data_input);
        $this->db->trans_complete();
    }

    public function edit_bank_statement($data)
    {
        $this->db->trans_start();
        $data_input = array(
            'date' => $data['date'],
            'account' => $data['account'],
            'amount' => $data['amount'],
            'status' => $data['type'],
            'description' => $data['description'],
            'recipient' => $data['recipient']
        );
        $this->db->where('id_bank_statement', $data['id_bank_statement']);
        $this->db->update('bank_statement', $data_input);
        $this->db->trans_complete();
    }

    public function delete_bank_statement($id)
    {
        $this->db->trans_start();

        $this->db->where('id_bank_statement', $id);
        $this->db->delete('bank_statement');

        $this->db->trans_complete();
    }
}
