<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of import_xls
 *
 * @author Sapta
 */
class Import_xls extends MY_Controller {

    //put your code here

    function __construct() {
        parent::__construct("authorize", "import_xls", true);
        $this->load->model("import_xls_model");
    }

    public function import_show() {

        return null;
        //echo $this->load->view('import_xls/import_xls_ce', null, true);
    }

    function create_import() {
        
    }

    function import_excel() {
        error_reporting(E_ALL);

        $kue = random_string('alnum', 10);
        $dtkue = array("kue_aktif" => $kue);
        $this->session->set_userdata($dtkue);

        $file = explode('.', $_FILES['dt_import']['name']);
        //echo $_FILES['dt_import']['name'];die();
        $length = count($file);

        if ($file[$length - 1] == 'xlsx' || $file[$length - 1] == 'xls') {//jagain barangkali uploadnya selain file excel <img src="http://s0.wp.com/wp-includes/images/smilies/icon_smile.gif?m=1129645325g" alt=":-)" class="wp-smiley">
            $tmp = $_FILES['dt_import']['tmp_name']; //Baca dari tmp folder jadi file ga perlu jadi sampah di server :-p
            $this->load->library('excel'); //Load library excelnya
            $read = PHPExcel_IOFactory::createReaderForFile($tmp);
            $read->setReadDataOnly(true);
            $excel = $read->load($tmp);
            $sheets = $read->listWorksheetNames($tmp); //baca semua sheet yang ada
            foreach ($sheets as $sheet) {
                $_sheet = $excel->setActiveSheetIndexByName($sheet); //Kunci sheetnye biar kagak lepas :-p
                $maxRow = $_sheet->getHighestRow();
                $maxCol = $_sheet->getHighestColumn();
                $field = array();
                $sql = array();
                $maxCol = range('A', $maxCol);
                foreach ($maxCol as $key => $coloumn) {
                    $field[$key] = $_sheet->getCell($coloumn . '1')->getCalculatedValue(); //Kolom pertama sebagai field list pada table
                }
                for ($i = 2; $i <= $maxRow; $i++) {
                    foreach ($maxCol as $k => $coloumn) {
                        $sql[$field[$k]] = $_sheet->getCell($coloumn . $i)->getCalculatedValue();
                    }
                    $sql['kode_upload'] = $this->session->userdata("kue_aktif");
                    $this->db->insert("customer_site_temp", $sql); //ribet banget tinggal insert doank...
                    //$this->db->insert($sheet, $sql); //ribet banget tinggal insert doank...
                }
            }
            redirect($this->input->post('dtUrl') . "hr?menu=164&action=314");
        } else {
            exit('do not allowed to upload'); //pesan error tipe file tidak tepat
        }
    }

    function get_temp_import_excel() {
        $kue_aktif = $this->session->userdata("kue_aktif");
        echo "{\"data\" : " . json_encode($this->import_xls_model->get_temp_import($kue_aktif)) . "}";
    }

    function send_import() {
        $kue_aktif = $this->session->userdata("kue_aktif");
        
        if ($kue_aktif <> "") {
            $query = $this->import_xls_model->get_data_temp_excel($kue_aktif);
            //print_r($query);die();
            $send_kue = $this->import_xls_model->send_data($query);
            if ($send_kue == true) {
                $updateKUE = $this->import_xls_model->update_data_customer_site($kue_aktif);
            }
            if ($updateKUE == true) {
                echo json_encode(array("success" => true));
            } else {
                echo json_encode(array("success" => false));
            }
        } else {
            echo json_encode(array("success" => false));
        }
    }

    function delete_temp_excel_data() {
        $jsonPisah = $this->input->post("jsonPisah");
        if (is_array($jsonPisah)) {
            foreach ($jsonPisah as $dtrow) {
                $hsl[] = $dtrow['id'];
            }
        }
        $delTempExcelData = $this->import_xls_model->delete_temp_excel_data($hsl);
        echo $delTempExcelData;
    }
    
    function import_excel_inoy(){
        $file = explode('.', $_FILES['dt_import']['name']);
        //echo $_FILES['dt_import']['name'];die();
        $length = count($file);

        if ($file[$length - 1] == 'xlsx' || $file[$length - 1] == 'xls') {
            $this->load->library("phpexcel/PHPExcel");
            $this->load->library("phpexcel/PHPExcel/IOFactory");
            
            $fileName = $_FILES['dt_import']['name'];
    
            $config['upload_path']	= "./assets/uploads/files/";
            $config['upload_url']	= base_url().'assets/uploads/files/';
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size']     = '20000';
            $this->load->library('upload');
            $this->upload->initialize($config);
    
            if($this->upload->do_upload('dt_import'))
             {
             $this->upload->data();    
             }
    
            $media = $this->upload->data('import');
            $inputFileName = './assets/uploads/files/'.$media['file_name'];
    
            //  Read your Excel workbook
            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
    
            //  Get worksheet dimensions
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
    
            //  Loop through each row of the worksheet in turn
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                //  Insert row data array into your database of choice here
                $data = array(
                    "nama"=> $rowData[0][0],
                    "alamat"=> $rowData[0][1],
                    "telepon"=> $rowData[0][2],
                    "email"=>$rowData[0][3],
                    "birt_date"=>$rowData[0][4],
                    "religion"=>$rowData[0][5],
                    "gender"=>$rowData[0][6],
                    "blood_type"=>$rowData[0][7]
                );
                $this->db->insert("recruitment_temp",$data);
            }
            echo "oke";
        }else{
            echo "failed";
        }
    }
    
    function save_import(){
        $data_temp=$this->db->query("select * from recruitment_temp order by id")->result();
        foreach($data_temp as $datax){
            $data=array(
                'nama'=>$datax->nama,
                'alamat'=>$datax->alamat,
                'telepon'=>$datax->telepon,
                'email'=>$datax->email,
                'birt_date'=>$datax->birt_date,
                'religion'=>$datax->religion,
                'gender'=>$datax->gender,
                'blood_type'=>$datax->blood_type
            );
            $this->db->insert('recruitment',$data);
        }
        $this->db->query('truncate table recruitment_temp');
        echo "oke";
    }

}
