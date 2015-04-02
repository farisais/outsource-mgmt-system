<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email_send extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('not_authorize', 'email_send', true);
        $this->load->model('appsetting_model');
	}
    
    public function index()
    {
        $this->load->view('templates/report/po_template', null);
    }
    
    public function create_report()
    {
        $filepath = $this->appsetting_model->get_app_config_by_name('report_temp_directory_path') . 'test.pdf';
        $cmd = '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe" ' . base_url() . 'email_send ' . $filepath;  
        exec($cmd);
        echo $cmd;
        echo '<a href="../images/upload" >test</a>';
        $file = "../images/upload/test.pdf";
        $pdf = file_get_contents($filepath);
        
        header('Content-Type: application/pdf');
        header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Content-Length: '.strlen($pdf));
        header('Content-disposition: attachment;filename=' . basename($file));
        ob_clean(); 
        flush(); 
        echo $pdf;
    }
}
?>