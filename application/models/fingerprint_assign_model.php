<?php
class fingerprint_assign_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_fingerprint_assign_all()
	{
		$this->db->select('fa.*, cs.site_name, wo.work_order_number');
		$this->db->from('fingerprint_assign as fa');
        $this->db->join('work_order as wo', 'wo.id_work_order=fa.work_order', 'INNER');
        $this->db->join('customer_site as cs', 'cs.id_customer_site=fa.site', 'INNER');
                
		return $this->db->get()->result_array();
	}
    
    public function get_fingerprint_assign_all_assgined()
    {
        $this->db->select('fa.*, cs.site_name, wo.work_order_number, fd.id_fingerprint_device, fd.merk, fd.series, fd.serial_number ');
		$this->db->from('fingerprint_assign as fa');
        $this->db->join('fingerprint_assign_detail as fad', 'fad.fingerprint_assign=fa.id_fingerprint_assign', 'INNER');
        $this->db->join('work_order as wo', 'wo.id_work_order=fa.work_order', 'INNER');
        $this->db->join('customer_site as cs', 'cs.id_customer_site=fa.site', 'INNER');
        $this->db->join('fingerprint_device as fd', 'fd.id_fingerprint_device=fad.fingerprint_device');
        
        $this->db->where('fa.status', 'assigned');
                
		return $this->db->get()->result_array();
    }
 
    public function save_fingerprint_assign($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['work_order'] = $data['work_order'];
        $data_input['app_id'] = $this->generateAppID($data['work_order_number'], $data['site']);
        $data_input['site'] = $data['site'];
        $data_input['status'] = 'unassign';
        
        $this->db->insert('fingerprint_assign', $data_input);
        
        $return_id = $this->db->insert_id();
        
        $this->insert_fingerprint_assign_detail($return_id, $data['fingerprint_devices']);
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function save_assign_from_wo($data)
    {
        $this->db->trans_start();
        
        $check_data = $this->get_fingerprint_assign_detail_by_wo($data['work_order']);
        if(count($check_data) != 0)
        {
            foreach($check_data as $cd)
            {
                $this->delete_fingerprint_assign_detail($cd['fingerprint_assign']);
                $this->delete_fingerprint_assign($cd['fingerprint_assign']);
            }
        }
        
        $data_input = array();
        $faid = '';
        for($i=0;$i<count($data['employee_assign']); $i++)
        {
            $data_detail = array();
            
            
            $data_detail['fingerprint_device'] = $data['employee_assign'][$i]['fingerprint_device'];
            $data_detail['ip_local'] = $data['employee_assign'][$i]['ip_local'];
            $data_detail['comm_password'] = $data['employee_assign'][$i]['comm_password'];
            $data_detail['port'] = $data['employee_assign'][$i]['port'];
            $data_detail['fdid'] = $data['employee_assign'][$i]['fdid'];
            
            if($i>0)
            {
                if($data['employee_assign'][$i]['site'] == $data['employee_assign'][$i-1]['site'])
                {
                    $this->insert_fingerprint_assign_detail_single($faid, $data_detail);
                }
                else
                {
                    $data_input['work_order'] = $data['work_order'];
                    $data_input['app_id'] = $this->generateAppID($data['work_order_number'], $data['employee_assign'][$i]['site']);
                    $data_input['site'] = $data['employee_assign'][$i]['site'];
                    $data_input['status'] = 'unassign';
                    
                    $this->db->insert('fingerprint_assign', $data_input);
                    
                    $faid = $this->db->insert_id();
                    
                    $this->insert_fingerprint_assign_detail_single($faid, $data_detail);
                }
            }
            
            if($i==0)
            {
                $data_input['work_order'] = $data['work_order'];
                $data_input['app_id'] = $this->generateAppID($data['work_order_number'], $data['employee_assign'][$i]['site']);
                $data_input['site'] = $data['employee_assign'][$i]['site'];
                $data_input['status'] = 'unassign';
                
                $this->db->insert('fingerprint_assign', $data_input);
                
                $faid = $this->db->insert_id();
                
                $this->insert_fingerprint_assign_detail_single($faid, $data_detail);
            }
            
            
        }
        
        $this->db->trans_complete();
        
        $return_data = $this->get_fingerprint_assign_detail_by_wo($data['work_order']);
        
        return $return_data;
        
    }
    
    public function insert_fingerprint_assign_detail($id, $data)
    {
        foreach($data as $d)
        {
            $data_input = array();
            $data_input['fingerprint_assign'] = $id;
            $data_input['fingerprint_device'] = $d['fingerprint_device'];
            $data_input['ip_local'] = $d['ip_local'];
            $data_input['comm_password'] = $d['comm_password'];
            $data_input['port'] = $d['port'];
            $data_input['fdid'] = $d['fdid'];
            
            $this->db->insert('fingerprint_assign_detail', $data_input);
        }
        
    }
    
    public function insert_fingerprint_assign_detail_single($id, $data)
    {
        $data_input = array();
        $data_input['fingerprint_assign'] = $id;
        $data_input['fingerprint_device'] = $data['fingerprint_device'];
        $data_input['ip_local'] = $data['ip_local'];
        $data_input['comm_password'] = $data['comm_password'];
        $data_input['port'] = $data['port'];
        $data_input['fdid'] = $data['fdid'];
        
        $this->db->insert('fingerprint_assign_detail', $data_input);
    }
    
    
    
    public function delete_fingerprint_assign_detail($id)
    {
        $this->db->where('fingerprint_assign', $id);
        $this->db->delete('fingerprint_assign_detail');
    }
    
    public function change_fingerprint_assign_status($id, $status)
    {
        $this->db->trans_start();
        $this->db->where('id_fingerprint_assign', $id);
        $this->db->update('fingerprint_assign', array("status" => $status));
        $this->db->trans_complete();
    }
    
    public function change_fingerprint_assign_status_from_wo($id, $status)
    {
        $this->db->trans_start();
        $this->db->where('work_order', $id);
        $this->db->update('fingerprint_assign', array("status" => $status));
        $this->db->trans_complete();
    }
    
    public function edit_fingerprint_assign($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['work_order'] = $data['work_order'];
        $data_input['app_id'] = $this->generateAppID($data['work_order_number'], $data['site']);
        $data_input['site'] = $data['site'];
        $data_input['status'] = 'unassign';
        
        $this->db->where('id_fingerprint_assign', $data['id_fingerprint_assign']);
        $this->db->update('fingerprint_assign', $data_input);
        
        $return_id = $data['id_fingerprint_assign'];
        
        $this->delete_fingerprint_assign_detail($return_id);
        $this->insert_fingerprint_assign_detail($return_id, $data['fingerprint_devices']);
        
        $this->db->trans_complete();
        
        return $return_id;
    }
    
    public function delete_fingerprint_assign($id)
    {
        $this->db->trans_start();
        $this->db->where('id_fingerprint_assign', $id);
        
        $this->db->delete('fingerprint_assign');
        
        $this->db->trans_complete();
    }
    
    public function get_fingerprint_assign_by_id($id)
    {
        $this->db->select('fa.*,wo.work_order_number, wo.customer, cs.site_name');
		$this->db->from('fingerprint_assign as fa');
        $this->db->join('work_order as wo', 'wo.id_work_order=fa.work_order', 'INNER');
        $this->db->join('customer_site as cs', 'cs.id_customer_site=fa.site', 'INNER');
        $this->db->where('id_fingerprint_assign', $id);
                
		return $this->db->get()->result_array();
    }
    
    public function get_fingerprint_assign_detail($id)
    {
        $query = "select fad.*, fd.serial_number from 
        fingerprint_assign_detail as fad 
        inner join fingerprint_device as fd on fd.id_fingerprint_device=fad.fingerprint_device 
        where fad.fingerprint_assign=" . $id;
        
        $result = $this->db->query($query);
        
        return $result->result_array();
    }
    
    public function get_fingerprint_assign_detail_by_wo($id)
    {
        $query = "select fad.*, fd.serial_number, fd.merk, fd.series, cs.site_name, fa.* 
        from fingerprint_assign_detail as fad inner join fingerprint_device as fd on fd.id_fingerprint_device=fad.fingerprint_device 
        inner join fingerprint_assign as fa on fa.id_fingerprint_assign=fad.fingerprint_assign 
        inner join customer_site as cs on cs.id_customer_site=fa.site 
        where fa.work_order=" . $id;
        
        $result = $this->db->query($query);
        
        return $result->result_array();
    }
    
    public function get_fingerprint_assign_detail_by_wo_site($wo, $site)
    {
        $query = "select fad.*, fd.serial_number, fd.merk, fd.series, cs.site_name, fa.* from fingerprint_assign_detail as fad inner join fingerprint_device as fd on fd.id_fingerprint_device=fad.fingerprint_device 
        inner join fingerprint_assign as fa on fa.id_fingerprint_assign=fad.fingerprint_assign inner join customer_site as cs on cs.id_customer_site=fa.site 
        where fa.work_order=" . $wo . ' and fa.site=' . $site;
        
        $result = $this->db->query($query);
        
        return $result->result_array();
    }
    
    public function generateAppID($wo, $site)
    {
        $wo = substr($wo, 2);
        return 'APPID' . $wo . $site;
    }
}