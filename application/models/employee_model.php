<?php
class Employee_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_employee_all()
	{
        $query = $this->db;
        $query->select('employee.*, employment_type.name AS employment_type_name, employee_status.name AS employee_status_name, 
        employee_contract_type.name AS employee_contract_type_name,religion.name AS religion_name, city.name AS city_address, 
        bank.name AS bank_name, ec.position, ec.position_level, os.structure_name as position_name, pl.name as position_level_name');
        $query->from('employee');
        $query->join('employment_type', 'employment_type.id_employment_type=employee.employment_type', 'INNER');
        $query->join('employee_status', 'employee_status.id_employee_status=employee.employee_status', 'INNER');
        $query->join('employee_contract as ec', 'ec.employee=employee.id_employee', 'LEFT');
        $query->join('employee_contract_type', 'employee_contract_type.id_employee_contract_type=employee.employee_contract_type', 'LEFT');
        $query->join('religion', 'religion.id_religion=employee.religion', 'LEFT');
        $query->join('city', 'city.id_city=employee.birth_city','LEFT');
        $query->join('bank', 'bank.id_bank=employee.bank', 'LEFT');
        $query->join('organisation_structure  as os', 'os.id_organisation_structure=ec.position', 'LEFT');
        $query->join('position_level as pl', 'pl.id_position_level=ec.position_level', 'LEFT');
                
		return $query->get()->result_array();
	}
    
    public function get_employee_contract_phase_type_all()
    {
        $this->db->select('id_employee_contract_phase_type AS contract_phase_type, name AS contract_phase_type_name, abv');
        $this->db->from('employee_contract_phase_type');
        
        return $this->db->get()->result_array();
    }
    
    public function get_education_level_all()
    {
        $this->db->select('*');
        $this->db->from('education_level');
        
        return $this->db->get()->result_array();
    }
    
    public function get_address_type_all()
    {
        $this->db->select('*');
        $this->db->from('address_type');
        
        return $this->db->get()->result_array();
    }
    
    public function get_employment_type_all()
    {
        $this->db->select('*');
        $this->db->from('employment_type');
        
        return $this->db->get()->result_array();
    }
    
    public function get_religion_all()
    {
        $this->db->select('*');
        $this->db->from('religion');
        
        return $this->db->get()->result_array();
    }
    
    public function get_document_type_all()
    {
        $this->db->select('*');
        $this->db->from('employee_document_type');
        
        return $this->db->get()->result_array();
    }
    
    public function get_language_all()
    {
        $this->db->select('*');
        $this->db->from('languages');
        
        return $this->db->get()->result_array();
    }
    
    public function get_language_fluency_all()
    {
        $this->db->select('*');
        $this->db->from('language_fluency');
        
        return $this->db->get()->result_array();
    }
    
    public function get_employee_basic_by_id($id)
    {
        $query = $this->db;
        $query->select('employee.*, employment_type.name AS employment_type_name, employee_status.name AS employee_status_name, 
        employee_contract_type.name AS employee_contract_type_name,religion.name AS religion_name, city.name AS city_address, 
        bank.name AS bank_name');
        $query->from('employee');
        $query->join('employment_type', 'employment_type.id_employment_type=employee.employment_type', 'INNER');
        $query->join('employee_status', 'employee_status.id_employee_status=employee.employee_status', 'INNER');
        $query->join('employee_contract_type', 'employee_contract_type.id_employee_contract_type=employee.employee_contract_type', 'LEFT');
        $query->join('religion', 'religion.id_religion=employee.religion', 'LEFT');
        $query->join('city', 'city.id_city=employee.birth_city','LEFT');
        $query->join('bank', 'bank.id_bank=employee.bank', 'LEFT');
        $query->where('id_employee', $id);
                
		return $query->get()->result_array();
    }
    
    public function get_employee_id_by_number($num)
    {
        $this->db->select('id_employee');
        $this->db->from('employee');
        $this->db->where('employee_number', $num);
        
        $result = $this->db->get()->result_array();
        
        return $result;
    }
    
    public function save_employee($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        
        //insert into employee table
        if($data['is_edit'] != 'true')
        {
            $data_input["employee_number"]   =   $this->generate_employee_number();
        }
        $data_input["full_name"]         =   $data["full_name"];
        $data_input['employment_type']   =   $data['employment_type'];
        $data_input["employee_status"]   =   4;
        $data_input["employee_contract_type"] =   ($data["employee_contract_type"] == '' ? null : $data["employee_contract_type"]);
        $data_input["birth_city"]        =   $data["birth_city"];
        $data_input["birth_date"]        =   ($data["birth_date"] == '' ? null : $data['birth_date']);
        $data_input["religion"]          =   ($data["religion"] == '' ? null : $data["religion"]);
        $data_input["gender"]            =   ($data["gender"] == '' ? null : $data["gender"]);
        $data_input["blood_type"]        =   ($data["blood_type"] == '' ? null : $data["blood_type"]);
        $data_input["height"]            =   $data["height"];
        $data_input["weight"]            =   $data["weight"];
        $data_input["hobbies"]           =   $data["hobbies"];
        $data_input["marital_status"]    =   ($data["marital_status"] == '' ? null : $data["marital_status"]);
        $data_input["marital_date"]      =   ($data["marital_date"] == '' ? null : $data['marital_date']);
        $data_input["native"]            =   $data["native"];
		$data_input["npwp"]				 =	 $data["npwp"];
		$data_input["bpjs"]				 =	 $data["bpjs"];
		$data_input["jamsostek"]		 =	 $data["jamsostek"];
		$data_input["rekening"]		     =	 $data["rekening"];
		$data_input["bank"]				 =	 $data["bank"];
        
        //Save basic info
        if($data['is_edit'] != 'true')
        {
            $this->db->insert('employee', $data_input);
            $employee_id = $this->db->insert_id();
        }
        else
        {
            $employee_id = $this->input->post('id_employee');
            $this->db->where('id_employee', $employee_id);
            $this->db->update('employee', $data_input);
        }
        
        
        //Save employee address
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_address');
        }
        
        if(isset( $data['employee_address']))
        {
            $this->save_employee_address($employee_id, $data['employee_address']);
        }
        
        //Save employee identification
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_document_detail');
        }
        if(isset($data['employee_identification']))
        {
            $this->save_employee_document($employee_id, $data['employee_identification']);
        }
        
        //Save employee contract
        $this->save_employee_contract($employee_id, $data);
        
        //Save employee education
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employe_education');
        }
        if(isset($data['employee_education']))
        {
            $this->save_employee_education($employee_id, $data['employee_education']);
        }
        
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_course');
        }
        if(isset($data['employee_course']))
        {
            $this->save_employee_course($employee_id, $data['employee_course']);
        }
        
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_languages');
        }
        if(isset($data['employee_language']))
        {
            $this->save_employee_languages($employee_id,$data['employee_language']); 
        }
        
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_social');
        }
        if(isset($data['employee_social']))
        {
            $this->save_employee_social($employee_id, $data['employee_social']);
        }
        
        //Save employee experience
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_experience');
        }
        if(isset($data['employee_experience']))
        {
            $this->save_employee_experience($employee_id, $data['employee_experience']);
        }
        
        //Save employee family
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_marital');
        }
        if(isset($data['employee_marital']))
        {
            $this->save_employee_marital($employee_id, $data['employee_marital']);
        }
        
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_family_tree');
        }
        if(isset($data['employee_family']))
        {
            $this->save_employee_family($employee_id, $data['employee_family']);
        }
        
        //Save employee emergency contact
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_emergency_contact');
        }
        if(isset($data['emergency_contact']))
        {
            $this->save_employee_emergency_contact($employee_id, $data['emergency_contact']);
        }
        
        //Save employee transportation
        if($data['is_edit'] == 'true')
        {
            $this->delete_employee_relation_table($employee_id, 'employee_vehicle');
        }
        if(isset($data['employee_vehicle']))
        {
            $this->save_employee_transportation($employee_id, $data['employee_vehicle']);
        }
        $this->db->trans_complete();
    }
    
    public function generate_employee_number()
    {
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->order_by('employee_number', 'DESC');
        
        $result = $this->db->get()->result_array();
        
        $number = 1;
        if(count($result) > 0)
        {
            $number = $result[0]['employee_number'] + 1;
        }
        return ($number);
    }
    
    public function delete_employee_relation_table($id, $table)
    {
        $this->db->where('employee', $id);
        $this->db->delete($table);
    }
    
    public function get_employee_address_by_employee($id)
    {
        $this->db->select('employee_address.*, address_type.name as address_type_name, city.name as city_name');
        $this->db->from('employee_address');
        $this->db->join('address_type', 'address_type.id_address_type=employee_address.address_type', 'LEFT');
        $this->db->join('city', 'city.id_city=employee_address.city', 'INNER');
        $this->db->where('employee_address.employee', $id);
        
        $result = $this->db->get()->result_array();
        
        for($i=0;$i<count($result);$i++)
        {
            switch($result[$i]['housing_owner'])
            {
                case 'private_own':
                    $result[$i]['housing_owner_name'] = 'Private Own';
                    break;
                case 'others':
                    $result[$i]['housing_owner_name'] = 'Others';
                    break;
                default: 
                    $result[$i]['housing_owner_name'] = '';
                    break;
            }
        }
        
        return $result;
    }
    
    public function save_employee_address($id, $data)
    {
        foreach($data as $d)
        {
            if($d['address'] != '')
            {
                $data_input = array();
                $data_input['employee'] = $id;
                $data_input['address'] = $d['address'];
                $data_input['city']= $d['city'];
                $data_input['phone'] = $d['phone'];
                $data_input['address_type'] = $d['address_type'];
                $data_input['housing_owner'] = $d['housing_owner'];
                
                $this->db->insert('employee_address', $data_input);
            }
        }
    }
    
    public function get_employee_document()
    {
        
    }
    
    public function get_employee_identification_by_employee($id)
    {
        $this->db->select('ed.*, edt.name as employee_document_type_name');
        $this->db->from('employee_document_detail as ed');
        $this->db->join('employee_document_type as edt', 'edt.id_employee_document_type=ed.employee_document_type', 'INNER');
        $this->db->where('employee', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function save_employee_document($id, $data)
    {
        foreach($data as $d)
        {
            if($d['number'] != '')
            {
                $data_input = array();
                $data_input['employee'] = $id;
                $data_input['number'] = $d['number'];
                $data_input['employee_document_type']= $d['employee_document_type'];
                $data_input['date_issue'] = ($d['date_issue'] == '' ? null : $d['date_issue']);
                $data_input['date_expire'] = ($d['date_expire'] == '' ? null : $d['date_expire']);
                $data_input['attachment_type'] = 'none';
                
                $this->db->insert('employee_document_detail', $data_input);
            }
        }
    }
    
    public function date_grid_normalization($date)
    {
        return date('Y-m-d', strtotime($date));
    }
    
    public function get_employee_contract_by_employee($id)
    {
        $this->db->select('*');
        $this->db->from('employee_contract');
        $this->db->where('employee', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function get_employee_contract_detail_by_employee($id)
    {
        $this->db->select('ecd.*, ec.employee, ecpt.name as contract_phase_type_name');
        $this->db->from('employent_contract_phase_detail as ecd');
        $this->db->join('employee_contract as ec', 'ec.id_employee_contract=ecd.employee_contract', 'INNER');
        $this->db->join('employee_contract_phase_type as ecpt', 'ecpt.id_employee_contract_phase_type=ecd.contract_phase_type', 'INNER');
        $this->db->where('ec.employee', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function save_employee_contract($id, $data)
    {
        $data_input = array();
        if(!$data['is_edit'] != 'true')
        {
            $data_input['employee'] = $id;
        }
        $data_input['contract_number'] = $data['contract_number'];
        $data_input['contract_status'] = 5;
        $data_input['join_date'] = ($data['join_date'] == '' ? null : $data['join_date']);
        $data_input['end_date'] = ($data['end_date'] == '' ? null : $data['end_date']);
        $data_input['position'] = ($data['position'] == '' ? null : $data['position']);
        $data_input['position_level'] = ($data['position_level'] == '' ? null : $data['position_level']);
        $data_input['employee_contract_type'] = ($data['employee_contract_type'] == '' ? null : $data['employee_contract_type']);
		
        if($data['is_edit'] == 'true')
        {
            $this->db->where('employee', $id);
            $this->db->update('employee_contract', $data_input);
            $contract_id = $data['id_employee_contract'];
            $this->db->where('employee_contract', $contract_id);
            $this->db->delete('employent_contract_phase_detail');
        }
        else
        {
            $this->db->insert('employee_contract', $data_input);
            $contract_id = $this->db->insert_id();
            
        }
        
        if(isset($data['contract_phase_detail']))
        {
            foreach($data['contract_phase_detail'] as $phase)
            {
                $data_detail = array();
                $data_detail['employee_contract'] = $contract_id;
                $data_detail['contract_phase_type'] = $phase['contract_phase_type'];
                $data_detail['start_date'] = ($phase['start_date'] == '' ? null : $phase['start_date']);
                $data_detail['end_date'] = ($phase['end_date'] == '' ? null : $phase['end_date']);
                $data_detail['status'] = 'on_going';
                
                $this->db->insert('employent_contract_phase_detail', $data_detail);
            }
        }
        
    }
    
    public function get_employee_marital_by_employee($id)
    {
        $this->db->select('ef.*, ef.last_education as last_education_level, el.level_name as last_education_level_name, city.name as birth_place_name');
        $this->db->from('employee_marital as ef');
        $this->db->join('education_level as el', 'el.id_education_level=ef.last_education', 'LEFT');
        $this->db->join('city', 'city.id_city=ef.birth_place', 'LEFT');
        $this->db->where('ef.employee', $id);
        
        $result = $this->db->get()->result_array();
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['relation_name'] = ucfirst($result[$i]['relation']);
            $result[$i]['gender_name'] = ucfirst($result[$i]['gender']);
            $result[$i]['blood_type_name'] = strtoupper($result[$i]['blood_type']);
        }
        
        return $result;
    }
    
    public function save_employee_marital($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                if($d['name'] != '' && $d['name'] != null)
                {   
                    $data_input = array();
                    $data_input['employee'] = $id;
                    $data_input['relation']=$d['relation'];
                    $data_input['name']=$d['name'];
                    $data_input['gender']=$d['gender'];
                    $data_input['birth_place']=$d['birth_place'];
                    $data_input['birth_date']= ($d['birth_date'] == '' ? null : $d['birth_date']);
                    $data_input['blood_type']=$d['blood_type'];
                    $data_input['last_education']=$d['last_education_level'];
                    $data_input['last_employment_position']=$d['last_employment_position'];
                    $data_input['last_employment_position']=$d['last_employment_position'];
                    
                    $this->db->insert('employee_marital', $data_input);
                }
            }
        }
    }
    
    public function get_employee_family_by_employee($id)
    {
        $this->db->select('ef.*, ef.last_education as last_education_level,el.level_name as last_education_level_name, city.name as birth_place_name');
        $this->db->from('employee_family_tree as ef');
        $this->db->join('education_level as el', 'el.id_education_level=ef.last_education', 'LEFT');
        $this->db->join('city', 'city.id_city=ef.birth_place', 'LEFT');
        $this->db->where('ef.employee', $id);
        
        $result = $this->db->get()->result_array();
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['relation_name'] = ucfirst($result[$i]['relation']);
        }
        
        return $result;
    }
    
    public function save_employee_family($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                if($d['name'] != '' && $d['name'] != null)
                {
                    $data_input = array();
                    $data_input['employee'] = $id;
                    $data_input['relation'] = $d['relation'];
                    $data_input['birth_place']=$d['birth_place'];
                    $data_input['birth_date']= ($d['birth_date'] == '' ? null : $d['birth_date']);
                    $data_input['gender'] = (($d['relation'] == 'brother' || $d['relation'] == 'father') ? 'male' : 'female');
                    $data_input['name'] = $d['name'];
                    $data_input['last_education'] = $d['last_education_level'];
                    $data_input['last_employment_company'] = $d['last_employment_company'];
                    $data_input['last_employment_position'] = $d['last_employment_position'];
                    
                    $this->db->insert('employee_family_tree', $data_input);
                }
            }
        }
    }
    
    public function get_employee_education_by_employee($id)
    {
        $this->db->select('ed.*, city.name as city_name, el.level_name');
        $this->db->from('employe_education as ed');
        $this->db->join('city', 'city.id_city=ed.city', 'LEFT');
        $this->db->join('education_level as el', 'el.id_education_level=ed.education_level', 'LEFT');
        
        $this->db->where('ed.employee', $id);
        
        $result = $this->db->get()->result_array();
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['graduated_name'] = 'No';
            if($result[$i]['graduated'] == 1)
            {
                $result[$i]['graduated_name'] = 'Yes';
            }
        }
        
        return $result;
    }
    
    public function save_employee_education($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                if($d['institution_name'] != '')
                {
                    $data_input = array();
                    $data_input['employee'] = $id;
                    $data_input['institution_name'] = $d['institution_name'];
                    $data_input['education_level'] = $d['education_level'];
                    $data_input['from_year']= $d['from_year'];
                    $data_input['to_year'] = $d['to_year'];
                    $data_input['graduated'] = ($d['graduated'] == 'Yes' ? 1 : 0 );
                    $data_input['city'] = $d['city'];
                    
                    $this->db->insert('employe_education', $data_input);
                }
            }
        }
    }
    
    public function get_employee_course_by_employee($id)
    {
        $this->db->select('ec.*, uom.name as duration_uom_name, city.name as city_name');
        $this->db->from('employee_course as ec');
        $this->db->join('unit_measure as uom', 'uom.id_unit_measure=ec.duration_uom', 'LEFT');
        $this->db->join('city', 'city.id_city=ec.city', 'LEFT');
        $this->db->where('ec.employee', $id);
        
        $result = $this->db->get()->result_array();
        
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['supported_by_name'] = ucfirst($result[$i]['supported_by']);
        }
        
        return $result;
    }
    
    public function save_employee_course($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                if($d['name'] != '')
                {
                    $data_input = array();
                    $data_input['employee'] = $id;
                    $data_input['name'] = $d['name'];
                    $data_input['field'] = $d['field'];
                    $data_input['provider']= $d['provider'];
                    $data_input['duration_uom'] = $d['duration_uom'];
                    $data_input['duration'] = $d['duration'];
                    $data_input['year'] = $d['year'];
                    $data_input['supported_by'] = $d['supported_by'];
                    $data_input['city'] = $d['city'];
                    $data_input['remarks'] = $d['remarks'];
                    $this->db->insert('employee_course', $data_input);
                }
            }
        }
    }
    
    public function get_employee_language_by_employee($id)
    {
        $this->db->select('el.languages as language, el.*, l.name as language_name, lf_r.name as reading_name, lf_h.name as hearing_name, lf_w.name as writing_name, lf_s.name as speaking_name');
        $this->db->from('employee_languages as el');
        $this->db->join('languages as l', 'l.id_languages=el.languages', 'INNER');
        $this->db->join('language_fluency as lf_r', 'lf_r.id_language_fluency=el.reading', 'INNER');
        $this->db->join('language_fluency as lf_h', 'lf_h.id_language_fluency=el.hearing', 'INNER');
        $this->db->join('language_fluency as lf_w', 'lf_w.id_language_fluency=el.writing', 'INNER');
        $this->db->join('language_fluency as lf_s', 'lf_s.id_language_fluency=el.speaking', 'INNER');
        
        $this->db->where('el.employee', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function save_employee_languages($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                if($d['language'] != '')
                {
                    $data_input = array();
                    $data_input['employee'] = $id;
                    $data_input['languages'] = $d['language'];
                    $data_input['reading']= $d['reading'];
                    $data_input['writing'] = $d['writing'];
                    $data_input['hearing'] = $d['hearing'];
                    $data_input['speaking'] = $d['speaking'];
                    
                    $this->db->insert('employee_languages', $data_input);
                }
            }
        }
    }
    
    public function get_employee_social_by_employee($id)
    {
        $this->db->select('*');
        $this->db->from('employee_social');
        $this->db->where('employee', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function save_employee_social($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                if($d['organisation'] != '')
                {
                    $data_input = array();
                    $data_input['employee'] = $id;
                    $data_input['organisation'] = $d['organisation'];
                    $data_input['activities'] = $d['activities'];
                    $data_input['position']= $d['position'];
                    $data_input['year'] = $d['year'];
                    $this->db->insert('employee_social', $data_input);
                }
            }
        }
    }
    
    public function get_employee_experience_by_employee($id)
    {
        $this->db->select('ee.*, city.name as city_name');
        $this->db->from('employee_experience as ee');
        $this->db->join('city', 'city.id_city=ee.city', 'INNER');
        $this->db->where('ee.employee', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function save_employee_experience($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                if($d['company_name'] != '')
                {
                    $data_input = array();
                    $data_input['company_name']=$d['company_name'];
                    $data_input['company_address']=$d['company_address'];
                    $data_input['city']= $d['city'];
                    $data_input['company_phone']=$d['company_phone'];
                    $data_input['from_month']=$d['from_month'];
                    $data_input['to_month']=$d['to_month'];
                    $data_input['from_year']=$d['from_year'];
                    $data_input['to_year']=$d['to_year'];
                    $data_input['entry_position']=$d['entry_position'];
                    $data_input['last_position']=$d['last_position'];
                    $data_input['total_employees']=$d['total_employees'];
                    $data_input['director_name']=$d['director_name'];
                    $data_input['type_of_business']=$d['type_of_business'];
                    $data_input['supervisor']=$d['supervisor'];
                    $data_input['responsibilities']=$d['responsibilities'];
                    $data_input['reason_for_leaving']=$d['reason_for_leaving'];
                    $data_input['last_salary']=$d['last_salary'];
                    $data_input['facilities']=$d['facilities'];
                    $data_input['supervisor_phone']=$d['supervisor_phone'];
                    $data_input['supervisor_can_be_contacted']= ($d['supervisor_can_be_contacted'] == 'on' ? 1 : 0);
                    $data_input['employee']=$id;
                    $this->db->insert('employee_experience', $data_input);
                }
            }
        }
    }
    
    public function get_employee_emergency_contact_by_employee($id)
    {
        $this->db->select('ee.*, ee.relationship as relation, city.name as city_name');
        $this->db->from('employee_emergency_contact as ee');
        $this->db->join('city', 'city.id_city=ee.city', 'INNER');
        $this->db->where('ee.employee', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function save_employee_emergency_contact($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                $data = array();
                $data_input['employee'] = $id;
                $data_input['relationship'] = $d['relation'];
                $data_input['name'] = $d['name'];
                $data_input['phone'] = $d['phone'];
                $data_input['address'] = $d['address'];
                $data_input['city'] = $d['city'];
                $data_input['profession'] = $d['profession'];
                
                $this->db->insert('employee_emergency_contact', $data_input);
            }
        }
    }
    
    public function get_employee_transportation_by_employee($id)
    {
        $this->db->select('ee.*');
        $this->db->from('employee_vehicle as ee');
        $this->db->where('ee.employee', $id);
        
        $result = $this->db->get()->result_array();
        
        for($i=0;$i<count($result);$i++)
        {
            $result[$i]['vehicle_type_name'] = ucfirst($result[$i]['vehicle_type']);
            $result[$i]['owner_name'] = ucwords(str_replace("_", " ", $result[$i]['owner']));
        }
        
        return $result;
    }
    
    public function save_employee_transportation($id, $data)
    {
        if($data != null)
        {
            foreach($data as $d)
            {
                $data_input = array();
                $data_input['employee'] = $id;
                $data_input['vehicle_type'] = $d['vehicle_type'];
                $data_input['merk'] = $d['merk'];
                $data_input['year'] = $d['year'];
                $data_input['owner'] = $d['owner'];
                
                $this->db->insert('employee_vehicle', $data_input);
            }
        }
    }
}