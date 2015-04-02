<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Side_menu extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'side_menu', true);
        
        $this->data['top_menu'] = 'dashboard';
	}
	
	public function index()
	{

	}
    
      public function get_side_menu()
    {
        echo "{\"data\":" .json_encode($this->menu_model->get_all_side_menu()). "}";
    }
    
    public function init_create_side_menu()
    {
        $parent = $this->appsetting_model->get_parent_menu_all();
        for($i=0;$i<count($parent);$i++)
        {
            if($parent[$i]['type'] == 'group')
            {
                $parent[$i]['alias'] = $parent[$i]['name'] . ' - ' . $parent[$i]['parent_name'];
            }
            else
            {
                $parent[$i]['alias'] = $parent[$i]['name'] . ' - Top Menu' ;
            }
        }
        $this->load->model('master_model');
        $data = array(
            'division' => $this->master_model->get_division_all(),
            'parent' => $parent,
            'action' => $this->appsetting_model->get_action_all()
        );
        
        return $data;
    }
    
     public function save_side_menu()
    {
        if($this->input->post('is_edit') == 'true')
        {
            $this->appsetting_model->edit_side_menu($this->input->post('id_menu'));
        }
        else
        {
            $this->appsetting_model->add_side_menu();
        }
        
        return null;
    }
    
    public function delete_side_menu()
    {
        $this->appsetting_model->delete_side_menu();
        
        return null;
    }
    
     public function get_side_menu_data($id)
    {
        $side_menu_edit = $this->menu_model->get_side_menu_by_id($id);
        $this->load->model('master_model');
        $parent = $this->appsetting_model->get_parent_menu_all();
        for($i=0;$i<count($parent);$i++)
        {
            if($parent[$i]['type'] == 'group')
            {
                $parent[$i]['alias'] = $parent[$i]['name'] . ' - ' . $parent[$i]['parent_name'];
            }
            else
            {
                $parent[$i]['alias'] = $parent[$i]['name'] . ' - Top Menu' ;;
            }
        }
        $data = array(
            'division' => $this->master_model->get_division_all(),
            'parent' => $parent,
            'action' => $this->appsetting_model->get_action_all(),
            'side_menu_edit' => $side_menu_edit,
            'is_edit' => 'true'
        );
        
        return $data;
    }
    
}
?>