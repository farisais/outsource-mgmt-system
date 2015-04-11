<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Monitoring_timesheet extends MY_Controller
{
    function __construct() {
        parent::__construct("authorize", "timesheet", true);
        $this->load->model('monitoring_timesheet_model');
          
    }
    public function get_monitoring_timesheet_list()
    {
        echo '{"data" : ' . json_encode($this->monitoring_timesheet_model->get_timesheet_all()) . '}';
    }
    
    
    

}
?>
