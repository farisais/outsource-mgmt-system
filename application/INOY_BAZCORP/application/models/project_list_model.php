<?php
class Project_list_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_pl_all()
	{
		$this->db->select('project_list.*, so.so_number , customer.name');
		$this->db->from('project_list');
        $this->db->join('so', 'project_list.so=so.id_so', 'INNER');
        $this->db->join('customer', 'so.customer=customer.id_customer', 'INNER');
                
		return $this->db->get()->result_array();
	}
        
        
                public function get_pl_submit()
	{
		$this->db->select('project_list.*, so.*');
                $this->db->join('so', 'project_list.so=so.id_so', 'INNER');
		$this->db->from('project_list');
        
       
        $this->db->where('project_list.status =', 'submit');
                
		return $this->db->get()->result_array();
	}
    
    public function get_pl_by_id($id)
    {
        $this->db->select('project_list.*, so.so_number');
        $this->db->from('project_list');
        $this->db->join('so', 'project_list.so=so.id_so', 'INNER');
               
        $this->db->where('project_list.id_project_list', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function get_bom_from_so($id)
    {
        $query = 'select dbom.product_code, dbom.prod as product, dbom.bpname as product_name, sum(dbom.qty_bom * sfp.qty) as total_qty, dbom.uom, um.name as unit_name from so_finish_product as sfp inner join (select bom.product as bp, detail_bom.product as prod, detail_bom.uom as uom, detail_bom.qty as qty_bom, product.product_code, product.product_name as bpname
        from bom inner join detail_bom on detail_bom.bom=bom.id_bom 
        inner join product on product.id_product=detail_bom.product) as dbom on dbom.bp=sfp.product inner join unit_measure as um on um.id_unit_measure=dbom.uom 
        where sfp.so = '. $id .' group by dbom.prod';

        $result = $this->db->query($query);
        return $result->result_array();
    }
    
    public function save_project_list($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['so'] = $data['so'];
        $data_input['project_list_number'] = $this->generate_pl_number();
        $data_input['user_create'] = $this->session->userdata('app_userid');
        $data_input['date_create'] = date('Y-m-d H:i:s');
        $data_input['status'] = 'draft';
        
        $this->db->insert('project_list', $data_input);
        
        $return_id = $this->db->insert_id();
        
        $this->insert_pl_product($return_id, $data['product_detail']);
        
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function insert_pl_product($id, $data)
    {
        foreach($data as $d)
        {
            $data_input = array();
            $data_input['project_list'] = $id;
            $data_input['product'] = $d['id_product'];
            $data_input['qty'] = $d['qty'];
            $data_input['uom'] = $d['unit'];
            
            $this->db->insert('project_list_product', $data_input);
        }
    }
    
    public function generate_pl_number()
    {
        $this->db->select('*');
        $this->db->from('project_list');
        $this->db->where('YEAR(date_create)', date('Y'));
        
        $result = $this->db->get()->result_array();
        $countResult = count($result) + 1;
        $zeroCount = '';
        
        for($i=0; $i<4 - strlen($countResult);$i++)
        {
            $zeroCount .= '0';
        }
        
        return ("PL" . date('y') . $zeroCount . $countResult);
    }
    
    public function delete_pl($id)
    {
        $this->db->trans_start();
        $this->delete_pl_product($id);
        $this->db->where('id_project_list', $id);
        
        $this->db->delete('project_list');
        
        
        $this->db->trans_complete();
    }
    
    public function delete_pl_product($id)
    {
        $this->db->trans_start();
        $this->db->where('project_list', $id);
        $this->db->delete('project_list_product');
    }
    
    public function edit_project_list($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['so'] = $data['so'];
        $data_input['project_list_number'] = $data['project_list_number'];
        $data_input['date_create'] = date('Y-m-d');
        $data_input['status'] = 'draft';
        
        $this->db->where('id_project_list', $data['id_project_list']);
        $this->db->update('project_list', $data_input);
        
        $this->delete_pl_product($data['id_project_list']);
        $this->insert_pl_product($data['id_project_list'], $data['product_detail']);
        
        $return_id = $data['id_project_list'];
        
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function validate_pl($id)
    {
        $this->db->where('id_project_list', $id);
        $this->db->update('project_list', array("status" => "submit"));
    }
    
    public function get_pl_product_list($id)
    {
        $this->db->select('project_list_product.*, project_list_product.qty as total_qty,product.product_code,product.product_name,um.name as unit_name');
        $this->db->from('project_list_product');
        $this->db->join('product', 'product.id_product=project_list_product.product', 'INNER');
        $this->db->join('unit_measure as um', 'um.id_unit_measure=project_list_product.uom', 'INNER');
        $this->db->where('project_list_product.project_list', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function get_pl_product_for_mr($id)
    {
        $this->db->select('project_list_product.*, project_list_product.qty as qty_require, project_list_product.product as id_product ,product.product_code,product.product_name,um.name as unit_name');
        $this->db->from('project_list_product');
        $this->db->join('product', 'product.id_product=project_list_product.product', 'INNER');
        $this->db->join('unit_measure as um', 'um.id_unit_measure=project_list_product.uom', 'INNER');
        $this->db->where('project_list_product.project_list', $id);
        
        return $this->db->get()->result_array();
    }

}