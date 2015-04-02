<?php
class Unit_measure_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    
    public function get_unit_measure_all()
    {
        $this->db->select('unit_measure.*, unit_of_measure_category.name AS uom_category_name');
        $this->db->from('unit_measure');
        $this->db->join('unit_of_measure_category', 'unit_measure.unit_of_measure_category=unit_of_measure_category.id_unit_of_measure_category', 'LEFT');
        return $this->db->get()->result_array();   
    }
    
    public function save_unit_measure($data)
    {
        try
        {
            $this->db->trans_start();
            $data_input = array(
                "name" => $data['name'],
                "unit_of_measure_category" => $data['unit_of_measure_category']
            );
            
            $this->db->insert('unit_measure', $data_input);
            $unit_id = $this->db->insert_id();
            
            $this->insert_unit_conversion($unit_id, $data);
            
            $this->db->trans_complete();
        }
        catch(Exception $e)
        {
            Throw new Exception($e->message);
        }
        
    }
    
    public function insert_unit_conversion($id, $data)
    {
        if($data['convertion'] != null && ($data['convertion']) > 0)
        {
            foreach($data['convertion'] as $unit)
            {
                 $data_input = array(
                    "unit_measure_from" => $id,
                    "unit_measure_to" => $unit['id_unit_measure'],
                    "multiplier" => floatval($unit['multiplier_fix']),
                    "multiplier_reverse" => 1 / floatval($unit['multiplier_fix'])
                );
                
                $this->db->insert('unit_convertion', $data_input);
            }
            
            //for($i=0;$i < count($data['convertion']) - 1;$i++)
//            {
//                $unit = $data['convertion'][$i];
//                for($j=$i+1;$j<count($data['convertion']);$j++)
//                {
//                    $unit_to = $data['convertion'][$j];
//                    $multiplier = floatval($unit_to['multiplier_fix']) / floatval($unit['multiplier_fix']);
//                    $data_input = array(
//                        "unit_measure_from" => $unit['unit_measure_to'],
//                        "unit_measure_to" => $unit_to['unit_measure_to'],
//                        "multiplier" => $multiplier,
//                        "multiplier_reverse" => 1 / $multiplier
//                    );
//                
//                    $this->db->insert('unit_convertion', $data_input);
//                }
//            }
            
            //check other unit convertion
            
        }
        
    }
    
    public function get_unit_measure_by_id($id)
    {
        $this->db->select('unit_measure.*, unit_of_measure_category.name AS uom_category_name');
        $this->db->from('unit_measure');
        $this->db->join('unit_of_measure_category', 'unit_measure.unit_of_measure_category=unit_of_measure_category.id_unit_of_measure_category', 'LEFT');
        $this->db->where('unit_measure.id_unit_measure', $id);
        
        return $this->db->get()->result_array();   
    }
    
    public function get_unit_convertion_by_unit($unit)
    {
        $this->db->select('unit_convertion.*, um_from.name AS from_name, um_to.name AS to_name');
        $this->db->from('unit_convertion');
        
        $this->db->join('unit_measure AS um_from', 'um_from.id_unit_measure=unit_convertion.unit_measure_from', 'INNER');
        $this->db->join('unit_measure AS um_to', 'um_to.id_unit_measure=unit_convertion.unit_measure_to', 'INNER');
        $this->db->where('unit_convertion.unit_measure_from', $unit);
        $this->db->or_where('unit_convertion.unit_measure_to', $unit);
        
        $result = $this->db->get()->result_array();
        $result_multi = array();
        foreach($result as $con)
        {
            array_push($result_multi, $con);
            if($unit == $con['unit_measure_from'])
            {
                $result_multi[count($result_multi) - 1]['multiplier_fix'] = $con['multiplier'];
                $result_multi[count($result_multi) - 1]['unit_name'] = $con['to_name'];
                $result_multi[count($result_multi) - 1]['id_unit_measure'] = $con['unit_measure_to'];
            }
            else
            {
                $result_multi[count($result_multi) - 1]['multiplier_fix'] = $con['multiplier_reverse'];
                $result_multi[count($result_multi) - 1]['unit_name'] = $con['from_name'];
                $result_multi[count($result_multi) - 1]['id_unit_measure'] = $con['unit_measure_to'];
                
            }
        }
        
        return $result_multi;   
        
    }
    
    public function edit_unit_measure($data)
    {
        $this->db->trans_start();
        $data_input = array(
            "name" => $data['name'],
            "unit_of_measure_category" => $data['unit_of_measure_category']
        );
        
        $this->db->where('id_unit_measure', $data['id_unit_measure']);
        $this->db->update('unit_measure', $data_input);
        
        $this->delete_unit_convertion_by_unit($data['id_unit_measure']);
        
        $this->insert_unit_conversion($data['id_unit_measure'], $data);
        
        $this->db->trans_complete();
    }
    
    public function delete_unit_convertion_by_unit($id)
    {
        $this->db->where('unit_measure_from', $id);
        $this->db->delete('unit_convertion');
    }
    
    public function delete_unit_measure($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id_unit_measure', $id);
        $this->db->delete('unit_measure');
        
        $this->db->trans_complete();
    }
    
    public function get_uom_category_all()
    {
        $this->db->select('*');
        $this->db->from('unit_of_measure_category');
        return $this->db->get()->result_array();   
    }
    
    public function get_unit_measure_by_category($name)
    {
        $this->db->select('unit_measure.*, uomc.name AS uom_category_name');
        $this->db->from('unit_measure');
        $this->db->join('unit_of_measure_category AS uomc', 'unit_measure.unit_of_measure_category=uomc.id_unit_of_measure_category', 'LEFT');
        $this->db->where('uomc.name', $name);
        return $this->db->get()->result_array();   
    }

}