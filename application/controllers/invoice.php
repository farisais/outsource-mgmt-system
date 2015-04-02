<?php   

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of invoice
 *
 * @author Sapta
 */
class Invoice extends MY_Controller {

    //put your code here

    function __construct() {
        parent::__construct("authorize", "invoice", true);
        $this->load->model('invoice_model');
        $this->load->model('so_model');
        $this->load->model('bank_model');
        $this->load->model('work_order_model');
        $this->load->model('payroll_model');
    }

    public function get_invoice_list() {
        echo "{\"data\" : " . json_encode($this->invoice_model->get_invoice_all()) . "}";
    }

    public function init_create_invoice() {
        $data['payroll'] = $this->payroll_model->get_wo_list();
        return $data;
    }

    public function save_invoice() {
        $id_invoice = null;
        if ($this->input->post('is_edit') == 'false') {
            $id_invoice = $this->invoice_model->save_invoice($this->input->post());
        } else {
            $this->invoice_model->edit_invoice($this->input->post());
            $id_invoice = $this->input->post('id_invoice');
        }

        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id_invoice);
        return array("interfunction_param" => $interfunction_param);
    }

    public function delete_invoice() {
        $this->invoice_model->delete_invoice($this->input->post('id_invoice'));
        //$this->payment_receipt_product_model->delete_payment_receipt_product->('payment_receipt')

        return null;
    }

    public function init_edit_invoice($id) {
        $data = array(
            "data_edit" => $this->invoice_model->get_invoice_by_id($id),
            "is_edit" => 'true'
        );

        return $data;
    }

    /*
      public function init_edit_invoice($id) {
      $data = array(
      "so" => $this->so_model->get_so_all(),
      "bank" => $this->bank_model->get_bank_all(),
      "invoice" => $this->invoice_model->get_invoice_all(),
      "data_edit" => $this->invoice_model->get_invoice_by_id($id),
      "is_edit" => 'true'
      );

      return $data;
      }
     */

    function kirim_invoice_email() {
        $email = $this->input->post('email');
        $id = $this->input->post('id');

        $dtpesan = "Invoice";

        $subjek = "Invoice For Security";

        $result = $this->send_email($email, $subjek, $dtpesan);
        if ($result == true) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false));
        }
    }

    function send_email($email, $subject, $psn) {

        $this->load->library('email');

        $this->email->from('alfath.helmy@gmail.com', 'Finance Bazcorp');
        $this->email->to($email);

        $this->email->subject($subject);

        $this->email->message($psn);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
        //echo $this->email->print_debugger();
    }

    function cetak_invoice() {
        error_reporting(E_ALL);

        $id = $this->input->post('id');
        
        $data['data_asesi'] = $this->mcom_lsp->get_data_asesi($idasesi);
        $data['idlsp'] = $this->idlsp;

        $data['data_asesi_detail'] = $this->mcom_lsp->get_data_detail_asesi($idasesi);

        $data['data_skema'] = $this->mcom_lsp->get_data_skema($data['data_asesi']->skema_id, $this->idlsp);

        $data['idrandom'] = $data['data_asesi']->no_uji_kompetensi;

        $this->load->view('com_lsp/vcetak_pendaftaran_asesi', $data);


        // Get output html
        $html = $this->output->get_output();

        // Load library
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->set_base_path($_SERVER['DOCUMENT_ROOT'] . "lspabi/");
        $this->dompdf->render();
        $this->dompdf->stream("cetak_pendaftaran_asesi.pdf", array('Attachment' => 0));
    }

}
