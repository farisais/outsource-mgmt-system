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
        $this->load->model('invoice_model');
        $po = $this->invoice_model->get_invoice_by_id($this->input->get('id'));
        $po_product = $this->invoice_model->get_detail_invoice($this->input->get('id'));
        $data = array();
        $data['company'] = $this->appsetting_model->get_app_config_by_name('company_name');
        $data['company_address'] = $this->appsetting_model->get_app_config_by_name('company_address');
        $data['customer_address'] = $po[0]['address'];
        $data['customer_name'] = $po[0]['customer_name'];
        $data['document_name'] = 'INVOICE';
        $data['document_number'] = $po[0]['invoice_number'];
		$data['management_profit'] = $po[0]['profit'];
		$data['management_tax'] = $po[0]['ppn'];
		$data['payment_terms'] = $po[0]['payment_terms'];
        $data['document_date'] = date('d/m/Y', strtotime($po[0]['invoice_date']));
        $data['items'] = $po_product;
        $data['sub_total'] = $po[0]['sub_total'];
        $data['tax'] = $po[0]['total_tax'];
        $data['total'] = $po[0]['total_invoice'];
        $this->load->view('templates/report/invoice_template_1', $data);
    }
	
	public function payslip_report_template()
	{
		$this->load->model('payslip_model');
		$d = $this->input->get();
		$p = $this->payslip_model->get_employee_payslip($d['e'], $d['wo'], $d['id']);
		$p = $p[0];
		$p['company'] = $this->appsetting_model->get_app_config_by_name('company_name');
        $p['company_address'] = $this->appsetting_model->get_app_config_by_name('company_address');
		
        $this->load->view('templates/report/payslip_template', $p);
	}
    
    public function create_report()
    {
        //create_report?id={}&doc={}&doc_no=
        $url = ''; 
		$purl = '';
		$param = '';
        switch($this->input->get('doc'))
        {
            case 'po':
				$url = '?id=' . $this->input->get('id'); 
                $url = base_url() . 'report/po_report_template' . $url;
				$purl = $url;
            break;
            case 'invoice':
				$url = '?id=' . $this->input->get('id'); 
                $url = base_url() . 'report/invoice_report_template' . $url;
				$purl = $url;
			break;
			case 'payslip':
				$this->load->model('payslip_model');
				$detail_payslip = $this->payslip_model->get_detail_payslip($this->input->get('wo'), $this->input->get('id'));
				
				foreach($detail_payslip as $dp)
				{
					$url = '?id=' . $this->input->get('id') . '&wo=' . $this->input->get('wo') . '&e=' . $dp['employee'];
					$purl .= '"' . base_url() . 'report/payslip_report_template' . $url . '" ';
				}
				
				$param = ' --page-size A5 --orientation Landscape ';
            break;
			case 'payslip_single':
				$url = '?id=' . $this->input->get('id') . '&wo=' . $this->input->get('wo') . '&e=' . $this->input->get('e');
				$purl .= '"' . base_url() . 'report/payslip_report_template' . $url . '" ';
				
				$param = ' --page-size A5 --orientation Landscape ';
            break;
        }
        $filename =  $this->input->get('doc_no') . '.pdf'; 
        $filepath = $this->appsetting_model->get_app_config_by_name('report_temp_directory_path') . $filename;
        $cmd = 'wkhtmltopdf.exe ' . $param . $purl . ' ' . $filepath . ' 2>&1';  
        
        //var_dump($cmd);
        //die();       
        $result = exec($cmd);
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