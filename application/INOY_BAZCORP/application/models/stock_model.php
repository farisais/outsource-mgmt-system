<?php
class Stock_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_stock_all()
	{
        $query = 'select p.*, sum(if(p.unit=st.uom,IF(if(g2.is_virtual=1,st.qty * -1,st.qty) IS NULL, \'0\' ,if(g2.is_virtual=1,st.qty * -1,st.qty)),IF(if(g2.is_virtual=1,st.qty*-1,st.qty) IS NULL, \'0\' ,if(g2.is_virtual = 1,st.qty*-1,st.qty) * (
                select if(uc.unit_measure_from = st.uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = st.uom and uc.unit_measure_to = p.unit) or (uc.unit_measure_to = st.uom and uc.unit_measure_from = p.unit)
                ))
                )) as total_qty ,g1.*,g2.*, pm.product_category as category_name, um.name as unit_name, m.name as merk_name 
                from product as p 
                left join stock_transaction as st on p.id_product=st.product 
                left join gudang as g1 on g1.id_warehouse=st.source_location 
                left join gudang as g2 on g2.id_warehouse=st.destination_location 
                inner join unit_measure as um on um.id_unit_measure=p.unit 
                inner join product_category as pm on pm.id_product_category=p.product_category 
                inner join merk as m on m.id_merk=p.merk 
                where (g1.is_virtual = 1 OR g2.is_virtual = 1 AND g2.name IS NOT NULL AND st.status = \'post\') OR (g2.name IS NULL) 
                group by st.product';
        $result = $this->db->query($query);
        return $result->result_array();
	}
    
    public function get_detail_stock()
    {
        $ci =& get_instance();
        $ci->load->model('gudang_model');
        $gudang = $ci->gudang_model->get_real_gudang_all();
        
        $result = array();
        $i = 0;
        foreach($gudang as $g)
        {
            $query = 'select p.*, \''. $g['id_warehouse'] .'\' as id_warehouse, \''. $g['kode_lokasi'] .'\' as kode_lokasi, \''. $g['name'] .'\' as warehouse_name,um.name as unit_name, sum(if(p.unit = st.uom, if(g1.id_warehouse = '. $g['id_warehouse'] .',qty * -1, qty), if(g1.id_warehouse = '. $g['id_warehouse'] .',qty * -1 * (
                    select if(uc.unit_measure_from = st.uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = st.uom and uc.unit_measure_to = p.unit) or (uc.unit_measure_to = st.uom and uc.unit_measure_from = p.unit)
                    ), qty * (
                    select if(uc.unit_measure_from = st.uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = st.uom and uc.unit_measure_to = p.unit) or (uc.unit_measure_to = st.uom and uc.unit_measure_from = p.unit)
                    )))) as total_qty
                    from stock_transaction as st
                    inner join product as p on p.id_product = st.product
                    inner join gudang as g1 on g1.id_warehouse = st.source_location
                    inner join gudang as g2 on g2.id_warehouse = st.destination_location
                    inner join unit_measure as um on um.id_unit_measure = p.unit 
                    where g1.id_warehouse = '. $g['id_warehouse'] .' OR g2.id_warehouse = '. $g['id_warehouse'] . 
                    ' AND st.status = \'post\' group by st.product';
            $temp_result = $this->db->query($query)->result_array();
            
            if(count($temp_result) > 0)
            {
                foreach($temp_result as $res)
                {
                    array_push($result, $res);
                }
                //array_push();
            }
            $i++;
        }
        return $result;
    }
    
    public function get_stock_from_warehouse($product, $warehouse)
    {
        $ci =& get_instance();
        $ci->load->model('gudang_model');
        $gudang = $ci->gudang_model->get_gudang_by_id($warehouse);
        
        $result = array();
        $i = 0;
        foreach($gudang as $g)
        {
            $query = 'select p.*, \''. $g['id_warehouse'] .'\' as id_warehouse, \''. $g['kode_lokasi'] .'\' as kode_lokasi, \''. $g['name'] .'\' as warehouse_name,um.name as unit_name, sum(if(p.unit = st.uom, if(g1.id_warehouse = '. $g['id_warehouse'] .',qty * -1, qty), if(g1.id_warehouse = '. $g['id_warehouse'] .',qty * -1 * (
                    select if(uc.unit_measure_from = st.uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = st.uom and uc.unit_measure_to = p.unit) or (uc.unit_measure_to = st.uom and uc.unit_measure_from = p.unit)
                    ), qty * (
                    select if(uc.unit_measure_from = st.uom, uc.multiplier, uc.multiplier_reverse) from unit_convertion as uc where (uc.unit_measure_from = st.uom and uc.unit_measure_to = p.unit) or (uc.unit_measure_to = st.uom and uc.unit_measure_from = p.unit)
                    )))) as total_qty
                    from stock_transaction as st
                    inner join product as p on p.id_product = st.product
                    inner join gudang as g1 on g1.id_warehouse = st.source_location
                    inner join gudang as g2 on g2.id_warehouse = st.destination_location
                    inner join unit_measure as um on um.id_unit_measure = p.unit 
                    where (g1.id_warehouse = '. $g['id_warehouse'] .' OR g2.id_warehouse = '. $g['id_warehouse'] . 
                    ') AND st.product = '. $product .' group by st.product';
            $temp_result = $this->db->query($query)->result_array();
            
            if(count($temp_result) > 0)
            {
                foreach($temp_result as $res)
                {
                    array_push($result, $res);
                }
                //array_push();
            }
            $i++;
        }
        return $result;
    }
}
?>