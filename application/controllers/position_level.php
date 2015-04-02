<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Position_level extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "position_level", true);
        $this->load->model('position_level_model');
          
    }
    public function get_position_level_list()
    {
        echo "{\"data\":" .json_encode($this->position_level_model->get_position_level_all()). "}";
    }
    
    public function save_position_level()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->position_level_model->edit_position_level($this->input->post());
        }
        else
        {
            $this->position_level_model->save_position_level($this->input->post());
        }
        
        return null;
    }
    
    public function delete_position_level()
    {
        $this->position_level_model->delete_position_level($this->input->post('id_position_level'));
        
        return null;
    }
    
    public function init_edit_position_level($id)
    {
        $data = array(
            'data_edit' => $this->position_level_model->get_position_level_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_position_level()
    {
        return null;
    }
}
?>
