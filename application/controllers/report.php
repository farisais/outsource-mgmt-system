<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('not_authorize', 'report', true);
        $this->load->model('appsetting_model');
	}
    
    public function index()
    {
        
        
    }
    
    public function po_report_template()
    {
        $this->load->model('po_model');
        $po = $this->po_model->get_po_by_id($this->input->get('id'));
        $po_product = $this->po_model->get_po_product_by_id($this->input->get('id'));
        $data = array();
        $data['company'] = $this->appsetting_model->get_app_config_by_name('company_name');
        $data['company_address'] = $this->appsetting_model->get_app_config_by_name('company_address');
        $data['customer_address'] = $po[0]['address'];
        $data['customer_name'] = $po[0]['supplier_name'];
        $data['document_name'] = 'Purchase Order';
        $data['document_number'] = $po[0]['po_number'];
        $data['document_date'] = date('d/m/Y', strtotime($po[0]['date']));
        $data['items'] = $po_product;
        $data['sub_total'] = $po[0]['sub_total'];
        $data['tax'] = $po[0]['tax'];
        $data['total_price'] = $po[0]['total_price'];
        $this->load->view('templates/report/po_template', $data);
    }
    
    public function invoice_report_template()
    {
         $data = array();
        
        $this->load->view('templates/report/invoice_template', $data);
    }
    public function invoice_report_templates()
    {
        $this->load->model('invoice_model');
        $this->load->model('so_model');
        $po = $this->invoice_model->get_invoice_by_id($this->input->get('id'));
        $po_product = $this->so_model->get_so_product_by_id($po[0]['so']);
        $data = array();
        $data['company'] = $this->appsetting_model->get_app_config_by_name('company_name');
        $data['company_address'] = $this->appsetting_model->get_app_config_by_name('company_address');
        $data['customer_address'] = $po[0]['address'];
        $data['customer_name'] = $po[0]['customer_name'];
        $data['document_name'] = 'INVOICE';
        $data['document_number'] = $po[0]['invoice_receipt_number'];
        $data['document_date'] = date('d/m/Y', strtotime($po[0]['invoice_date']));
        $data['items'] = $po_product;
        $data['sub_total'] = $po[0]['sub_total'];
        $data['tax'] = $po[0]['tax'];
        $data['total_price'] = $po[0]['total_price'];
        $this->load->view('templates/report/invoice_template', $data);
    }
    
    public function create_report()
    {
        //create_report?id={}&doc={}&doc_no=
        $url = '?id=' . $this->input->get('id'); 
        switch($this->input->get('doc'))
        {
            case 'po':
                $url = base_url() . 'report/po_report_template' . $url;
            break;
            case 'invoice':
                $url = base_url() . 'report/invoice_report_template' . $url;
            break;
        }
        $filename =  $this->input->get('doc_no') . '.pdf';        
        $filepath = $this->appsetting_model->get_app_config_by_name('report_temp_directory_path') . $filename;
        $cmd = $this->appsetting_model->get_app_config_by_name("wkhtmltopdf_bin_path") . ' '  . $url . ' ' . $filepath . ' 2>&1';  
        $result = exec('C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe D:\pdf.htm D:\ok.pdf');
        $file = $this->appsetting_model->get_app_config_by_name("temp_file_path") . $filename;
        echo $cmd;
        $pdf = file_get_contents($filepath);
        
        header('Content-Type: application/pdf');
        header('Cache-Control: public, must-revalidate, max-age=0'); 
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); 
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Content-Length: '.strlen($pdf));
        header('Content-disposition: attachment;filename=' . basename($file));
        ob_clean(); 
        flush(); 
        echo $pdf;
    }
}
?>