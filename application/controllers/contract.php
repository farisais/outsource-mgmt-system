<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contract extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "contract", true);
        $this->load->model('contract_model');
    }
    
    public function download_file($filename)
    {
        $this->load->helper('download');
        $path = './documents/contract';
        $data = $this->contract_model->get_contract_by_filename($filename);
        if ($data) {
            $file_content = file_get_contents("{$path}/{$filename}");
            force_download($data[0]['filename_ori'], $file_content);
        } else {
            echo "NO FILE";
        }
    }
}