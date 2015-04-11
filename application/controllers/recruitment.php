<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recruitment extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "customer", true);
        $this->load->model('recruitment_model');
        $this->load->model('master_model');
          
    }
    public function get_recruitment_list()
    {
        echo "{\"data\" : " . json_encode($this->recruitment_model->get_recruitment_all()) . "}";
    }
    
    public function get_recruitment_site_list($id)
    {
        echo "{\"data\" : " . json_encode($this->recruitment_model->get_recruitment_site($id)) . "}";
    }
    
    public function init_get_data_view(){
        $data = array(
            'employment_type' => $this->recruitment_model->get_list_employment_type(),
            'employment_level' => $this->recruitment_model->get_list_employment_level(),
            'organisation_structure' => $this->recruitment_model->get_list_organisation_structure(),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function set_employee(){
        
        $id_employee=$this->input->post('id_employee');
        $type_employee=$this->input->post('type_employee');
        $level_employee=$this->input->post('level_employee');
        $structure_employee=$this->input->post('structure_employee');
        
        //$cek_validasi=$this->dh->query("select * from recruitment where id=".$id_employee."")->row('validation');
        
       
        
        $recruitment=$this->db->query("select * from recruitment where id='$id_employee'")->row();
        if($recruitment->religion=="Islam"){
            $agama='1';
        }
        if($recruitment->religion=="Protestan"){
            $agama='2';
        }
        if($recruitment->religion=="Khatolik"){
            $agama='3';
        }
        if($recruitment->religion=="Hindu"){
            $agama='4';
        }
        if($recruitment->religion=="Budha"){
            $agama='5';
        }
        if($recruitment->religion=="Konghucu"){
            $agama='6';
        }
        if($recruitment->religion=="Lainnya"){
            $agama='7';
        }
        
        $data_insert_to_employee = array(
            'employment_type'=>$type_employee,
            'position_level'=>$level_employee,
            'organisation_structure_id'=>$structure_employee,
            'full_name'=>$recruitment->nama,
            'religion'=>$agama,
            'gender'=>$recruitment->gender,
            'birth_date'=>$recruitment->birt_date,
            'blood_type'=>$recruitment->blood_type,
            'employment_type'=>$type_employee,
            'position_level'=>$level_employee,
            'organisation_structure_id'=>$structure_employee,
            'employee_status'=>'1',
            'employee_contract_type'=>'1',
            'birth_city'=>'1'
        );
        
        $this->db->insert("employee",$data_insert_to_employee);
        
        $this->db->query("UPDATE recruitment set validation='1' where id='$id_employee'");
        echo "oke";
       
    }
    
     public function save_recruitment()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->recruitment_model->edit_recruitment($this->input->post());
        }
        else
        {
            $this->recruitment_model->add_recruitment($this->input->post());
        }
        
        return null;
    }
    
    
    
    public function delete_recruitment()
    {
        $this->recruitment_model->delete_recruitment($this->input->post('id_ext_company'));
        
        return null;
    }
    
    public function init_edit_recruitment($id)
    {
        $data = array(
            'data_edit' => $this->recruitment_model->get_recruitment_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_recruitment()
    {
        $data = array(
            'cities' => $this->master_model->get_city_all(),
        );
        
        return $data;
    }
}
?>
