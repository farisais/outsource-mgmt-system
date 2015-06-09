<?php
class Material_valuation_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_material_valuation_all()
	{
        $query = 'select p.*, um.name as unit_name,pc.product_category as category_name, merk.name as merk_name,pp.*,if(p.unit=pp.uom,sum(pp.total_price)/sum(pp.qty),sum(pp.total_price)/(sum(pp.qty)*
                    (
                    select if(uc.unit_measure_from = pp.uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = pp.uom and uc.unit_measure_to = p.unit) or (uc.unit_measure_to = pp.uom and uc.unit_measure_from = p.unit)
                    ))
                  ) as valuation from product as p 
                  left join po_product as pp on pp.product=p.id_product
                  left join po on po.id_po=pp.po
                  inner join product_category as pc on pc.id_product_category=p.product_category
                  inner join merk on merk.id_merk=p.merk
                  inner join unit_measure as um on um.id_unit_measure=p.unit
                  where (po.status = \'close\' or \'payment_received\')
                  group by pp.product';
                  
        $result = $this->db->query($query);
        return $result->result_array();
	}
    
    public function get_material_valuation_by_prod($id)
    {
        $query = 'select p.*, um.name as unit_name,pc.product_category as category_name, merk.name as merk_name,pp.*,if(p.unit=pp.uom,sum(pp.total_price)/sum(pp.qty),sum(pp.total_price)/(sum(pp.qty)*
                    (
                    select if(uc.unit_measure_from = pp.uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = pp.uom and uc.unit_measure_to = p.unit) or (uc.unit_measure_to = pp.uom and uc.unit_measure_from = p.unit)
                    ))
                  ) as valuation from product as p 
                  left join po_product as pp on pp.product=p.id_product
                  left join po on po.id_po=pp.po
                  inner join product_category as pc on pc.id_product_category=p.product_category
                  inner join merk on merk.id_merk=p.merk
                  inner join unit_measure as um on um.id_unit_measure=p.unit
                  where (po.status = \'close\' or \'payment_received\') and p.id_product = '. $id . 
                  ' group by pp.product';
                  
        $result = $this->db->query($query);
        return $result->result_array();
    }
    
    public function get_detail_material_valuation()
    {
        $query = 'select p.*,pc.product_category, pp.*, um.name as unit_name,po.po_number,  po.status as po_status
                from product as p
                left join po_product as pp on pp.product=p.id_product
                left join po on po.id_po=pp.po
                inner join product_category as pc on pc.id_product_category=p.product_category
                inner join unit_measure as um on um.id_unit_measure=pp.uom
                where (po.status = \'close\' or \'payment_received\')';
        $result = $this->db->query($query);
        return $result->result_array();
    }
}
?>