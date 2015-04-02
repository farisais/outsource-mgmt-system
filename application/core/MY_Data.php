<?php if(!defined('BASEPATH')) exit('No direct script access is allowed');
class MY_Data extends MY_Controller
{
    private $object_type = 'data';
    private $table_rel_root;
    public function set_table_root($value)
    {
        $this->table_rel_root = $value;
    }
    
    public function get_table_rel_root()
    {
        return $this->table_rel_root;
    }
    
    
    private $model_file;
    
    public function set_model_file($value)
    {
        $this->model_file = $value;
    }
    
    public function get_model_file()
    {
        return $this->model_file;
    }
    
    function __construct($mode = null, $controller, $is_action_controller = false, $table_rel_root)
	{
	   parent::__construct($mode, $controller, $is_action_controller);
       $this->table_rel_root = $table_rel_root;       
    }
}
?>