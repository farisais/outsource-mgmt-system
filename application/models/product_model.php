<?php
class Product_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_product_all()
	{
		$this->db->select('product.*, product_category.product_category AS category_name, merk.name, unit_measure.name as unit_name');
		$this->db->from('product');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
		$this->db->join('merk', 'merk.id_merk=product.merk', 'LEFT');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=product.unit', 'LEFT');
                
		return $this->db->get()->result_array();
	}
        
    public function get_product_final_all($so)
	{
	   //Get all product from SO
       $query = 'select sfp.qty as qty_request, p.*, merk.name as merk_name, um.name as unit_name, pc.product_category as category_name from so_finish_product as sfp inner join product as p on p.id_product = sfp.product inner join unit_measure as um 
       on um.id_unit_measure = p.unit inner join merk on merk.id_merk=p.merk inner join product_category as pc on pc.id_product_category=p.product_category 
       where sfp.so=' . $so;
       
       $product_so = $this->db->query($query)->result_array();
       
       //Get all product from project list
       $query = 'select sum(plp.qty) as qty_request, p.*, merk.name as merk_name, um.name as unit_name, pc.product_category as category_name from project_list as pl inner join project_list_product as plp on pl.id_project_list=plp.project_list inner join product as p on p.id_product=plp.product inner join unit_measure as um 
       on um.id_unit_measure = p.unit inner join merk on merk.id_merk=p.merk inner join product_category as pc on pc.id_product_category=p.product_category 
       where pl.so=' . $so . ' group by p.id_product';
       
       $product_pl = $this->db->query($query)->result_array();
       
	   return array_merge($product_so, $product_pl);;
	}
    
    public function save_product($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "product_code" => $this->generate_product_code($data),
            "product_name" => $data['product_name'],
            "unit" => $data['unit'],
            "product_category" => $data['product_category'],
            "merk" => $data['merk'],
            "type" => $data['type_material'],
            "description" => $data['description'],
            "is_service" => ($data['is_service'] == 'true' ? 1 : 0),
            "is_active" => ($data['is_active'] == 'true' ? 1 : 0),
            "is_material_valuation" => $data['is_material_valuation'],
            "cost_price" => $data['cost_price']
        );
        
        $this->db->insert('product', $data_input);
        
        $this->db->trans_complete();
    }
    
    public function generate_product_code($data)
    {
        $query = "select cast(replace(substring(product_code,-4),'0','') as signed) as num from product as p  
        where p.product_category = ". $data['product_category'] ." and p.type = ". $data['type_material'] ." and p.merk = ". $data['merk'] ."
        order by num desc";
        
        $result = $this->db->query($query)->result_array();
        
        $baseNum = (count($result) > 0 ? $result[0]['num'] + 1 : 1);
        
        $seqnumber = $baseNum;
        for($i=0; $i<4 - strlen($baseNum);$i++)
        {
            $seqnumber = '0' . $seqnumber;
        }
        
        $category = $this->get_abbreviation('product_category', $data['product_category'], 'id_product_category');
        $category = (strlen($category) > 3 ? substr($category,0, 3) : $category);
        $merk = $this->get_abbreviation('merk', $data['merk'], 'id_merk');
        $merk = (strlen($merk) > 4 ? substr($merk, 0, 4) : $merk);
        $type_material = $this->get_abbreviation('type_material', $data['type_material'], 'id_type_material');
        $type_material = (strlen($type_material) > 3 ? substr($type_material,0,3) : $type_material);
        
        return (strtoupper($category) . "." . strtoupper($type_material) . "." . strtoupper($merk) . "." .$seqnumber);
    }
    
    public function get_abbreviation($table, $id, $id_string)
    {
        $this->db->select('abbreviation');
        $this->db->from($table);
        $this->db->where($id_string, $id);
        
        $result = $this->db->get()->result_array();
        
        return $result[0]['abbreviation'];
    }
    
    public function delete_product($id)
    {
        $this->db->trans_start();
        $this->db->where('id_product', $id);
        $this->db->delete('product');
        $this->db->trans_complete();
    }
    
    public function get_product_by_id($id)
    {
        $this->db->select('product.*, product_category.product_category AS category_name, merk.name, unit_measure.name as unit_name');
		$this->db->from('product');
        $this->db->join('product_category', 'product_category.id_product_category=product.product_category', 'LEFT');
		$this->db->join('merk', 'merk.id_merk=product.merk', 'LEFT');
        $this->db->join('unit_measure', 'unit_measure.id_unit_measure=product.unit', 'LEFT');
        
        $this->db->where('product.id_product', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function edit_product($data)
    {
        $this->db->trans_start();
        
        $data_input = array(
            "product_code" => $this->generate_product_code($data),
            "product_name" => $data['product_name'],
            "unit" => $data['unit'],
            "product_category" => $data['product_category'],
            "merk" => $data['merk'],
            "type" => $data['type_material'],
            "description" => $data['description'],
            "is_service" => ($data['is_service'] == true ? 1 : 0),
            "is_active" => ($data['is_active'] == true ? 1 : 0),
            "is_material_valuation" => $data['is_material_valuation'],
            "cost_price" => $data['cost_price']
        );
        
        $this->db->where('id_product', $data['id_product']);
        $this->db->update('product', $data_input);
        
        $this->db->trans_complete();
    }
    
    //==========================================================================================
    
    public function get_product_category_all()
    {
        $this->db->select('*');
		$this->db->from('product_category');
		return $this->db->get()->result_array();
    }
    
    public function add_product_category($data_post)
    {
        $this->db->trans_start();
        $data = array(
            'product_category' => $data_post['product_category'],
            'abbreviation' => $data_post['abbreviation']
        );
        
        $this->db->insert('product_category', $data);
        $this->db->trans_complete();
    }
    
    public function edit_product_category($data_post)
    {
        $this->db->trans_start();
        $data = array(
            'product_category' => $data_post['product_category'],
            'abbreviation' => $data_post['abbreviation']
        );
        
        $this->db->where('id_product_category', $data_post['id_product_category']);
        $this->db->update('product_category', $data);
        $this->db->trans_complete();
    }
    
    public function delete_product_category($id)
    {
        $this->db->trans_start();
        $this->db->where('id_product_category', $id);
        $this->db->delete('product_category');
        $this->db->trans_complete();
    }
    
    public function get_product_category_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('product_category');
        $this->db->where('id_product_category', $id);
		return $this->db->get()->result_array();
    }
    
    
    //==========================================================================================
    
    public function get_merk_all()
    {
        $this->db->select('*');
		$this->db->from('merk');
		return $this->db->get()->result_array();
    }
    
    public function add_merk($data_post)
    {
        $this->db->trans_start();
        $data = array(
            'name' => $data_post['name'],
            'abbreviation' => $data_post['abbreviation']
        );
        
        $this->db->insert('merk', $data);
        $this->db->trans_complete();
    }
    
    public function edit_merk($data_post)
    {
        $this->db->trans_start();
        $data = array(
            'name' => $data_post['name'],
            'abbreviation' => $data_post['abbreviation']
        );
        
        $this->db->where('id_merk', $data_post['id_merk']);
        $this->db->update('merk', $data);
        $this->db->trans_complete();
    }
    
    public function delete_merk($id)
    {
        $this->db->trans_start();
        $this->db->where('id_merk', $id);
        $this->db->delete('merk');
        $this->db->trans_complete();
    }
    
    public function get_merk_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('merk');
        $this->db->where('id_merk', $id);
		return $this->db->get()->result_array();
    }
    
    //==========================================================================================
    
    public function get_tm_all()
    {
        $this->db->select('*');
		$this->db->from('type_material');
		return $this->db->get()->result_array();
    }
    
    public function add_tm($data_post)
    {
        $this->db->trans_start();
        $data = array(
            'Type_material' => $data_post['name'],
            'abbreviation' => $data_post['abbreviation']
        );
        
        $this->db->insert('type_material', $data);
        $this->db->trans_complete();
    }
    
    public function edit_tm($data_post)
    {
        $this->db->trans_start();
        $data = array(
            'type_material' => $data_post['name'],
            'abbreviation' => $data_post['abbreviation']
        );
        
        $this->db->where('id_type_material', $data_post['id_type_material']);
        $this->db->update('type_material', $data);
        $this->db->trans_complete();
    }
    
    public function delete_tm($id)
    {
        $this->db->trans_start();
        $this->db->where('id_type_material', $id);
        $this->db->delete('type_material');
        $this->db->trans_complete();
    }
    
    public function get_tm_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('type_material');
        $this->db->where('id_type_material', $id);
		return $this->db->get()->result_array();
    }
    
    public function get_product_with_valuation()
    {
        $ci =& get_instance();
        $ci->load->model('material_valuation_model');
        
        $pl_product = $this->get_product_all();
        for($i=0;$i<count($pl_product);$i++)
        {
            $pl_product[$i]['total_qty'] = 0;
            $pl_product[$i]['unit_cogs'] = 0;
            $pl_product[$i]['total_cogs'] = 0;
            if($pl_product[$i]['is_material_valuation'] == 1)
            {
                $product_valuation = $ci->material_valuation_model->get_material_valuation_by_prod($pl_product[$i]['id_product']);
                if(count($product_valuation) > 0)
                {
                    $pl_product[$i]['unit_cogs'] = $product_valuation[0]['valuation'];
                    $pl_product[$i]['total_cogs'] = $pl_product[$i]['total_qty'] * $product_valuation[0]['valuation'];
                }
            }
            else
            {
                $pl_product[$i]['unit_cogs'] = $pl_product[$i]['cost_price'];
                $pl_product[$i]['total_cogs'] = $pl_product[$i]['total_qty'] * $pl_product[$i]['cost_price'];
            }
            
        }
        
        return $pl_product;
    }
    
    //==========================================================================================
    
    public function get_product_definition_all()
    {
        $query = 'select pd.*, p.*, os.structure_name, pos.name as position_level_name from product_definition as pd inner join product as p on p.id_product=pd.product 
                inner join organisation_structure as os on os.id_organisation_structure=pd.organisation_structure left join position_level as pos on pos.id_position_level=pd.position_level';
                
        $result = $this->db->query($query);
        return $result->result_array();
    }
    
    public function get_product_definition_by_id($id)
    {
         $query = 'select pd.*, p.*, os.structure_name, pos.name as position_level_name from product_definition as pd inner join product as p on p.id_product=pd.product 
                inner join organisation_structure as os on os.id_organisation_structure=pd.organisation_structure left join position_level as pos on pos.id_position_level=pd.position_level 
                where pd.id_product_definition=' . $id;
                
        $result = $this->db->query($query);
        return $result->result_array();
    }
    
    public function save_product_definition($data)
    {
        $data_input = array();
        $data_input['product'] = $data['product'];
        $data_input['organisation_structure'] = $data['position'];
        $data_input['position_level'] = ($data['position_level'] == '' ? null : $data['position_level']);
        
        $this->db->insert('product_definition', $data_input);
        
        return $data_input;
    }
    
    public function edit_product_definition($data)
    {
        $data_input = array();
        $data_input['product'] = $data['product'];
        $data_input['organisation_structure'] = $data['position'];
        $data_input['position_level'] = ($data['position_level'] == '' ? null : $data['position_level']);
        
        $this->db->where('id_product_definition', $data['id_product_definition']);
        $this->db->update('product_definition', $data_input);
        
        return $data_input;
    }
    
    public function delete_product_definition($id)
    {
        $this->db->where('id_product_definition', $id);
        $this->db->delete('product_definition');
        
        return $id;
    }

}