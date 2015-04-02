<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of import_xls_model
 *
 * @author Sapta
 */
class Import_xls_model extends CI_Model {

    //put your code here

    public function get_temp_import($kue_aktif) {
        $this->db->where("kode_upload", $kue_aktif);
        $this->db->where("status_action", 0);
        $this->db->from('customer_site_temp');
        return $this->db->get()->result_array();
    }

    function delete_temp_excel_data($dataArr) {
        $this->db->where_in("id_customer_site", $dataArr);
        $query = $this->db->delete("customer_site_temp");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function get_data_temp_excel($kue_aktif) {
        $this->db->select("customer,site_name,address,city",false);
        $this->db->where("kode_upload", $kue_aktif);
        $query = $this->db->get("customer_site_temp");
        return $query->result_array();
    }

    function send_data($data_kue) {
        $query = $this->db->insert_batch("customer_site", $data_kue);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function update_data_customer_site($kue_aktif) {
        $data['status_action'] = 1;
        $this->db->where("kode_upload", $kue_aktif);
        $query = $this->db->update("customer_site_temp", $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

}
