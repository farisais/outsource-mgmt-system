<?php
class Incident_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_incident_report_all()
    {
        return $this->db->query("select a.*,b.full_name from incident_report a inner join employee b on a.employee_id=b.id_employee order by a.id desc")->result_array();
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
        return $this->db->query("select a.*,b.employee_number,full_name,c.structure_name
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
        $data_input = array(
            "employee_id" => $data['emloyee_id'],
            "location" => $data['location'],
            "chronology" => $data['chronology'],
            "effect_caused"=>$data['efect_cause'],
            "action_taken"=>$data['action_taken'],
            "recomendation"=>$data['recomendation'],
            "incident_time"=>$data['datetime_incident']
        );
        
        $this->db->insert('incident_report', $data_input);
        
        $id=mysql_insert_id();
        
        $temp=$this->db->query("select * from incident_report_thirdparty_temp")->result();
        foreach($temp as $tempx){
            $data=array('incident_id'=>$id,'employee_id'=>$tempx->employee_id);
            $this->db->insert('incident_report_thirdparty',$data);
        }
        
        $this->db->query('truncate table incident_report_thirdparty_temp');
        
        $this->db->trans_complete();
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
