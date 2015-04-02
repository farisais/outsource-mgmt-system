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
