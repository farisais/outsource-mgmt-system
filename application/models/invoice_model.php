<?php
class Invoice_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_invoice_all() {
        $this->db->select('invoice.*,work_order.project_name,ext_company.name');
		$this->db->from('invoice');
		$this->db->join('payroll_wo', 'payroll_wo.id=invoice.payroll_wo_id');
		$this->db->join('work_order', 'work_order.id_work_order=payroll_wo.work_order_id');
		$this->db->join('ext_company', 'ext_company.id_ext_company=work_order.customer');
		
        return $this->db->get()->result_array();
        
       
        //$this->db->from('invoice');
       // $this->db->join('so', 'so.id_so=invoice.so', 'LEFT');
        //$this->db->join('bank', 'bank.id_bank=invoice.rekening', 'LEFT');

        //return $query->result_array();
    }

    /*
      public function save_invoice($data) {
      $this->db->trans_start();
      $ci = & get_instance();

      $ci->load->model('so_model');

      $so = $ci->so_model->get_so_by_id($data['id_so']);

      $data_input = array(
      "so" => $data['id_so'],
      "invoice_date" => $data['date'],
      "sub_total" => $so[0]['sub_total'],
      "tax" => $so[0]['tax'],
      "total_price" => $so[0]['total_price'],
      "total_payment" => $data['total_payment'],
      "invoice_receipt_number" => $this->generate_invoice_number(),
      "invoice_method" => $data['invoice_method'],
      "rekening" => ($data['rekening'] == '' ? null : $data['rekening']),
      "status" => 'open',
      );

      $this->db->insert('invoice', $data_input);
      $return_id = $this->db->insert_id();
      $this->db->trans_complete();

      return $return_id;
      }
     */

    public function save_invoice($data,$invoice_number) {
        $this->db->trans_start();
       // var_dump($data);
        //die();
        //$tglinvoice = explode("/", $data['invoice_date']);
        //$tglinvoice = $tglinvoice[2] . "-" . $tglinvoice[1] . "-" . $tglinvoice[0];

        $data_input = array(
            "payroll_wo_id" => $data['payroll_wo_id'],
            "total_invoice" => $data['total_invoice'],
            "total_tax" => $data['total_tax'],
            "sub_total" => $data['sub-total'],
            "no_rekening" => $data['no_rekening'],
            "invoice_date" => $data['invoice_date'],
			"customer_po" => $data['customer_po'],
            "email" => $data['email'],
            "invoice_number" => $invoice_number
        );

        $this->db->insert('invoice', $data_input);
        $invoice_id = $this->db->insert_id();
        $this->save_detail_invoice($invoice_id, $data['detail_invoice']);
        $this->db->trans_complete();

        return $invoice_id;
    }

    public function generate_invoice_number() {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('YEAR(invoice_date)', date('Y'));

        $result = $this->db->get()->result_array();
        $countResult = count($result) + 1;
        $zeroCount = '';

        for ($i = 0; $i < 4 - strlen($countResult); $i++) {
            $zeroCount .= '0';
        }

        return ("INV" . date('y') . $zeroCount . $countResult);
    }

    public function delete_invoice($id) {
        $this->db->trans_start();
        $this->db->where('id_invoice', $id);
        $this->db->delete('invoice');
        $this->db->trans_complete();
    }

    public function get_invoice_by_id($id) {
		$query = 'select i.*, wo.work_order_number, wo.id_work_order, wo.project_name, pp.periode_name, c.name as customer_name, ec.address from invoice as i inner join payroll_wo as pw on pw.id=i.payroll_wo_id 
		inner join work_order as wo on wo.id_work_order = pw.work_order_id 
		inner join ext_company as ec on ec.id_ext_company = wo.customer 
		inner join payroll_periode as pp on pp.id_payroll_periode=pw.payroll_periode_id 
		inner join ext_company as c on c.id_ext_company=wo.customer 
		where i.id_invoice = ' . $id;
		
		$result = $this->db->query($query);
        
        return $result->result_array();
    }

    /*
      public function get_invoice_by_id($id) {
      $this->db->select('invoice.*, so.so_number, bank.bank_account, customer.name as customer_name, customer.adress as address');
      $this->db->from('invoice');
      $this->db->join('so', 'invoice.so=so.id_so', 'LEFT');
      $this->db->join('customer', 'customer.id_customer=so.customer', 'LEFT');
      $this->db->join('bank', 'invoice.rekening=bank.id_bank', 'LEFT');
      $this->db->where('invoice.id_invoice', $id);

      return $this->db->get()->result_array();
      }
     */

    public function edit_invoice($data) {
        $this->db->trans_start();
		
        $data_input = array(
            "payroll_wo_id" => $data['payroll_wo_id'],
            "total_invoice" => $data['total_invoice'],
            "total_tax" => $data['total_tax'],
            "sub_total" => $data['sub-total'],
            "no_rekening" => $data['no_rekening'],
            "invoice_date" => $data['invoice_date'],
			"customer_po" => $data['customer_po'],
            "email" => $data['email']
        );
        $this->db->where('id_invoice', $data['id_invoice']);
        $this->db->update('invoice', $data_input);
		$this->delete_detail_invoice($data['id_invoice']);
		$this->save_detail_invoice($data['id_invoice'], $data['detail_invoice']);

		
        $this->db->trans_complete();
    }
	
	public function validate_invoice($id)
	{
		$this->change_invoice_status($id, 'open');
		$invoice = $this->get_invoice_by_id($id);
		return $invoice[0];
	}
	
	 public function close_invoice($id) {
		$this->change_invoice_status($id, 'close');
		$invoice = $this->get_invoice_by_id($id);
		return $invoice[0];
    }
	
	public function delete_detail_invoice($id)
	{
		$this->db->where('invoice_id', $id);
		$this->db->delete('invoice_detail');
	}

    /*
      public function edit_invoice($data) {
      $this->db->trans_start();
      $ci = & get_instance();
      $ci->load->model('so_model');

      $so = $ci->so_model->get_so_by_id($data['id_so']);

      $data_input = array(
      "so" => $data['id_so'],
      "invoice_date" => $data['date'],
      "sub_total" => $so[0]['sub_total'],
      "tax" => $so[0]['tax'],
      "total_price" => $so[0]['total_price'],
      "total_payment" => $data['total_payment'],
      "invoice_method" => $data['invoice_method'],
      "rekening" => ($data['rekening'] == '' ? null : $data['rekening']),
      "status" => 'open',
      );
      $this->db->where('id_invoice', $data['id_invoice']);
      $this->db->update('invoice', $data_input);
      $this->db->trans_complete();
      }
     */
    /*
      public function get_invoice_product_by_id($id) {
      $ci = & get_instance();
      $ci->load->model('so_model');

      $this->db->select('invoice_product.*, invoice_product.qty AS qty_send, invoice_product.uom as unit, unit_measure.name as unit_name, product.*');
      $this->db->from('invoice_product');
      $this->db->join('product', 'product.id_product=invoice_product.product', 'INNER');
      $this->db->join('unit_measure', 'unit_measure.id_unit_measure=invoice_product.uom', 'INNER');
      $this->db->where('invoice_receipt', $id);

      $result = $this->db->get()->result_array();

      for ($i = 0; $i < count($result); $i++) {
      $so_product = $ci->so_model->get_so_product_by_id($this->get_id_so_from_invoice($id)[0]['so']);

      for ($j = 0; $j < count($so_product); $j++) {
      if ($so_product[$j]['product'] == $result[$i]['product']) {
      $result[$i]['qty_ordered'] = $so_product[$j]['qty'];
      }
      }
      }
      return $result;
      }
     */

    public function get_id_so_from_invoice($id_invoice) {
        $this->db->select('so');
        $this->db->from('invoice');
        $this->db->where('id_invoice', $id_invoice);

        return $this->db->get()->result_array();
    }

    public function change_invoice_status($id, $status) {
        $this->db->where('id_invoice', $id);
        $this->db->update('invoice', array("status_invoice" => $status));
    }

    public function get_invoice_history($id_so, $exclude_id = null)
    {
        $inv = null;
        if ($exclude_id != null)
        {
            $inv = $this->get_invoice_by_id($exclude_id);
        }

        $this->db->select('invoice.*, so.so_number');
        $this->db->from('invoice');
        $this->db->join('so', 'so.id_so=invoice.so', 'LEFT');

        $this->db->where('invoice.so', $id_so);
        $this->db->where('invoice.status', 'close');
        if ($exclude_id != null) {
            $this->db->where('invoice.id_invoice !=', $exclude_id);
            $this->db->where('DATE(invoice.invoice_date) <= DATE(\'' . $inv[0]['invoice_date'] . '\')', null, false);
            $this->db->where('invoice.id_invoice <', $inv[0]['id_invoice']);
        }

        return $this->db->get()->result_array();
    }

    public function get_invoice_left($id_so, $exclude_id = null)
    {
        $inv = null;
        if ($exclude_id != null) {
            $inv = $this->get_invoice_by_id($exclude_id);
        }

        $this->db->select('invoice.*, so.so_number');
        $this->db->from('invoice');
        $this->db->join('so', 'so.id_so=invoice.so', 'LEFT');
        $this->db->where('invoice.so', $id_so);
        $this->db->where('invoice.status', 'close');
        if ($exclude_id != null) {
            $this->db->where('invoice.id_invoice !=', $exclude_id);
            $this->db->where('DATE(invoice.invoice_date) <= DATE(\'' . $inv[0]['invoice_date'] . '\')', null, false);
            $this->db->where('invoice.id_invoice <', $inv[0]['id_invoice']);
        }

        $inv = $this->db->get()->result_array();
        $total = 0;
        foreach ($inv as $p) {
            $total += $p['total_payment'];
        }

        $ci = & get_instance();
        $ci->load->model('so_model');

        $so = $ci->so_model->get_so_by_id($id_so);

        return $so[0]['total_price'] - $total;
    }
	
	

   /* public function validate_invoice($id_invoice)
    {
        $inv = $this->get_invoice_by_id($id_invoice);
        $this->db->trans_start();

        $this->db->where('id_invoice', $id_invoice);
        $this->db->update('invoice', array('status' => 'close'));



        if ($this->get_invoice_left($inv[0]['so']) == 0) {
            //close SO
            $ci = & get_instance();
            $ci->load->model('so_model');

            $so = $ci->so_model->get_so_by_id($inv[0]['so']);
            if ($so[0]['status'] == 'deliver') {
                $ci->so_model->change_so_status($inv[0]['so'], 'close');
            }
        }

        $this->db->trans_complete();
    }*/

   
     public function save_detail_invoice($id, $data)
     {
         foreach ($data as $d) {
             if ($d['product_name'] != '') {
                 $data_input = array();
                 $data_input['product'] = $d['id_product'];
                 $data_input['unit'] = $d['unit'];
                 $data_input['description'] = $d['description'];
                 $data_input['quantity'] = $d['qty'];
                 $data_input['price'] = $d['price'];
                 $data_input['invoice_id'] = $id;
				 $data_input['ppn'] = $d['ppn'];
                 $this->db->insert('invoice_detail', $data_input);
             }
         }
     }


    function invoice_detail($id_payroll_wo){
        $ci =& get_instance();
        $ci->load->model('cost_element_model');
        $query=$this->db->query("SELECT so.id_so,quotation.id_quotation,payroll_wo.work_order_id
FROM payroll_wo
JOIN work_order ON work_order.id_work_order=payroll_wo.work_order_id
JOIN so ON so.id_so=work_order.so
JOIN quotation ON quotation.id_quotation=so.quotation
WHERE payroll_wo.id=$id_payroll_wo");
        $array=$query->result_array();
        $hasil=$this->get_cost_element($array[0]['id_quotation'],$array[0]['work_order_id']);
        return $hasil;
    }

    public function get_cost_element($id_quotation,$id_work_order)
	{
		$this->db->select('quotation_cost_element.*,quotation_cost_element.id as quotation_cost_element_id,organisation_structure.structure_name,position_level.name
        ,organisation_structure.structure_name as product_name,
        (SELECT sum(quotation_cost_element_detail.nominal) FROM quotation_cost_element_detail WHERE quotation_cost_element_detail.quotation_cost_element_id=quotation_cost_element.id) as price,
        (SELECT COUNT(*) FROM work_order
                JOIN so_assignment ON so_assignment.work_order_id=work_order.id_work_order
                JOIN employee ON employee.id_employee=so_assignment.so_assignment_number
                WHERE employee.organisation_structure_id=quotation_cost_element.structure_org_id AND
                id_work_order='.$id_work_order.') as quantity');
		$this->db->from('quotation_cost_element');
        $this->db->join('organisation_structure', 'organisation_structure.id_organisation_structure=quotation_cost_element.structure_org_id');
        $this->db->join('position_level', 'position_level.id_position_level=quotation_cost_element.level_employee_id');
        $this->db->where('quotation_cost_element.quotation_id',$id_quotation);
        return $this->db->get()->result_array();
	}
    
    function get_quantity(){
        $query=$this->db->query("SELECT employee.position_level,employee.organisation_structure_id FROM work_order
                JOIN so_assignment ON so_assignment.work_order_id=work_order.id_work_order
                JOIN employee ON employee.id_employee=so_assignment.so_assignment_number
                WHERE id_work_order=17");
    }
	
	public function get_detail_invoice($id)
	{
		$query = 'select di.*, di.quantity as qty, p.id_product, p.product_name, p.product_code, p.product_category, pc.product_category as cateogry_name ,um.name as unit_name, m.name as merk_name from invoice_detail as di 
		inner join product as p on p.id_product = di.product 
		inner join product_category as pc on pc.id_product_category = p.product_category 
		left join merk as m on m.id_merk=p.merk 
		inner join unit_measure as um on um.id_unit_measure=di.unit 
		where invoice_id = ' . $id;
		$result = $this->db->query($query);
		
		return $result->result_array();
	}
    

}
