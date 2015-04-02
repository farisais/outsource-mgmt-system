<?php
class Bank_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_bank_all()
    {
        $this->db->select('*');
        $this->db->from('bank');

        return $this->db->get()->result_array();
    }

    public function get_bank_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->where('id_bank', $id);

        return $this->db->get()->result_array();
    }

    public function insert_bank($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "name" => $data['name'],
            "branch" => $data['branch'],
            "address" => $data['address'],
            "contact" => $data['contact']
        );

        $this->db->insert('bank', $data_input);
        $this->db->trans_complete();
    }

    public function edit_bank($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "name" => $data['name'],
            "branch" => $data['branch'],
            "address" => $data['address'],
            "contact" => $data['contact']
        );

        $this->db->where('id_bank', $data['id_bank']);
        $this->db->update('bank', $data_input);
        $this->db->trans_complete();
    }

    public function delete_bank($id)
    {
        $this->db->trans_start();

        $this->db->where('id_bank', $id);
        $this->db->delete('bank');

        $this->db->trans_complete();
    }
}
