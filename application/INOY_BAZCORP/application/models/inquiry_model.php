<?php
class Inquiry_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_inquiry_all($status = null)
	{
		$this->db->select('inquiry.*, ext_company.name AS customer_name');
		$this->db->from('inquiry');
		$this->db->join('ext_company', 'ext_company.id_ext_company = inquiry.customer');
        if ($status)
            $this->db->where('inquiry.status', $status);

		return $this->db->get()->result_array();
	}

	public function get_inquiry_by_id($id)
	{
		$this->db->select('inquiry.*, ext_company.name AS customer_name');
		$this->db->from('inquiry');
		$this->db->join('ext_company', 'ext_company.id_ext_company = inquiry.customer');
		$this->db->where('inquiry.id_inquiry', $id);

		return $this->db->get()->result_array();
	}

	public function get_inquiry_product($id)
	{
		$this->db->select('inquiry_product.*, inquiry_product.qty_request as qty, product.id_product, product.product_code, product.product_name, unit_measure.name as unit_name, unit_measure.id_unit_measure AS unit');
		$this->db->from('inquiry_product');
		$this->db->join('product', 'product.id_product = inquiry_product.product');
		$this->db->join('unit_measure', 'unit_measure.id_unit_measure = inquiry_product.uom');
		$this->db->where('inquiry', $id);

		return $this->db->get()->result_array();
	}

    public function add_inquiry($data)
	{
		$this->db->trans_start();
		$data_input = array(
            'inquiry_number' => $this->generate_inquiry_number(),
			'inquiry_date' => $data['inquiry_date'],
			'customer' => $data['customer'],
			'expected_delivery' => $data['delivery_date'],
			'notes' => $data['notes'],
            'status' => 'draft',
		);
		$this->db->insert('inquiry', $data_input);
		$last_id = $this->db->insert_id();
		$this->add_inquiry_product($last_id, $data['products']);
		$this->db->trans_complete();
	}

	public function add_inquiry_product($id, $data_post)
	{

		foreach($data_post as $data)
		{
            
			$data_input = array(
				'product' => $data['id_product'],
				'uom' => $data['unit'],
				'qty_request' => $data['qty_request'],
				'qty_deliver' => $data['qty_deliver'],
				'remark' => $data['remark'],
				'inquiry' => $id
			);
			$this->db->insert('inquiry_product', $data_input);
		}
	}

    public function generate_inquiry_number()
    {
        $this->db->select('id_inquiry');
        $this->db->from('inquiry');
        $this->db->where('YEAR(inquiry_date)', date('Y'));
        $this->db->order_by('id_inquiry DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $countResult = 1;
        if ($query->num_rows() > 0) {
            $result = $query->row(0);
            $countResult = $result->id_inquiry + 1;
        }
        
        $zeroCount = '';
        for ($i=0; $i<4 - strlen($countResult);$i++) {
            $zeroCount .= '0';
        }
        
        return "INQ" . date('y') . $zeroCount . $countResult;
    }
    
	public function delete_inquiry($id)
	{
		$this->db->trans_start();
        
        // deleting inquiry product
        $this->db->where('inquiry', $id);
        $this->db->delete('inquiry_product');
        // deleting inquiry
		$this->db->where('id_inquiry', $id);
		$this->db->delete('inquiry');
        
		$this->db->trans_complete();
	}
    
    public function validate_inquiry($id) 
    {
        $this->db->where('id_inquiry', $id);
        $this->db->update('inquiry', array('status' => 'open'));
        
        return array('id_inquiry' => $id, 'status' => 'open');
    }
}