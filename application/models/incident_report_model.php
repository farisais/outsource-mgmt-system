<?php
class Incident_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_incident_report_all()
    {
        return $this->db->query("select a.*,b.full_name from incident_report as a inner join employee b on a.employee_id=b.id_employee order by a.id_incident_report desc")->result_array();
    }
    
    public function get_incident_report_thirdparty_temp()
    {
        return $this->db->query("select a.*,b.employee_number,full_name,c.structure_name
                                 from incident_report_thirdparty_temp a
                                 inner join employee b on a.employee_id=b.id_employee
                                 inner join organisation_structure c on b.organisation_structure_id=c.id_organisation_structure
                                 order by a.id desc
                                ")->result_array();
    }
    
    public function get_incident_report_thirdparty($id)
    {
        return $this->db->query("select a.*,b.id_employee, b.employee_number,full_name,c.structure_name as name
                                 from incident_report_thirdparty a
                                 inner join employee b on a.employee_id=b.id_employee
                                 inner join organisation_structure c on b.organisation_structure_id=c.id_organisation_structure
                                 where a.incident_id='$id'
                                 order by a.id desc
                                ")->result_array();
    }
    
    public function get_incident_report_by_id($id){
       return $this->db->query("select 
                                a.*,
                                b.id_employee,full_name,employee_number,
                                c.name as employement_name
                                from incident_report a
                                inner join employee b on a.employee_id=b.id_employee
                                inner join employment_type c on b.employment_type=c.id_employment_type
                                where a.id='$id'
                                ")->result_array();    
    }
    
    public function delete_incident_report($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete('incident_report');
        $this->db->query("delete from incident_report_thirdparty where incident_id='$id'");
        $this->db->trans_complete();
    }
    
    public function add_incident_report($data)
    {
        $this->db->trans_start();
		$wo = $this->get_wo_from_so($data['emloyee_id']);
        $data_input = array(
            "employee_id" => $data['emloyee_id'],
            "location" => $data['location'],
            "chronology" => $data['chronology'],
            "effect_caused"=>$data['efect_cause'],
            "action_taken"=>$data['action_taken'],
            "recomendation"=>$data['recomendation'],
            "incident_time"=>$data['datetime_incident'],
			"work_order"=> $wo[0]['work_order_id']
        );
        
        $this->db->insert('incident_report', $data_input);
        
        $id=mysql_insert_id();
        
		$this->insert_third_party($id, $data['third_party']);
        
        $this->db->trans_complete();
    }
	
	public function insert_third_party($id, $data)
	{
		foreach($data as $d)
		{
			$di = array();
			$di['employee_id'] = $d['id_employee'];
			$di['incident_id'] = $id;
			
			$this->db->insert('incident_report_thirdparty', $di);
		}
	}
	
	public function delete_third_party($id)
	{
		$this->db->where('id_incident_report', $id);
		$this->db->delete('incident_report_thirdparty');
	}
	
	public function get_wo_from_so($so)
	{
		$query = 'select sa.work_order_id from so_assignment as sa where sa.so_assignment_number = ' . $so;
		return $this->db->query($query)->result_array();
	}
    
    public function edit_incident_report($data){
        $this->db->trans_start();
        $data_input = array(
            "employee_id" => $data['emloyee_id'],
            "location" => $data['location'],
            "chronology" => $data['chronology'],
            "effect_caused"=>$data['efect_cause'],
            "action_taken"=>$data['action_taken'],
            "recomendation"=>$data['recomendation'],
            "incident_time"=>$data['datetime_incident']
        );
        
        $this->db->where('id', $data['id']);
        $this->db->update('incident_report', $data_input);
        
        $this->db->trans_complete();
    }

}
