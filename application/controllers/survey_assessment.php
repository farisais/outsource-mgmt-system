<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey_assessment extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "survey_assessment", true);
        $this->load->model('survey_assessment_model');
    }
    
    public function download_file($filename)
    {
        $this->load->helper('download');
        $path = './documents/survey';
        $data = $this->survey_assessment_model->get_survey_assessment_by_filename($filename);
        if ($data) {
            $file_content = file_get_contents("{$path}/{$filename}");
            force_download($data[0]['filename_ori'], $file_content);
        } else {
            echo "NO FILE";
        }
    }
}    