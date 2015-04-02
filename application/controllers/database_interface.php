<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Database_interface extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "database_interface", true);
        $this->load->model('appsetting_model');
          
    }
    public function get_database_table_list()
    {
        echo "{\"data\" : " . json_encode($this->appsetting_model->get_database_table_all()) . "}";
    }
    
    public function get_database_interface_list()
    {
        echo "{\"data\" : " . json_encode($this->appsetting_model->get_database_interface_all()) . "}";
    }
    
    public function init_database_interface()
    {
        return null;
    }
}
?>
