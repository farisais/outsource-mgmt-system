<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leave_application extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "leave_application", true);
        $this->load->model('leave_application_model');
    }

    function get_leave_application_list()
    {
        echo "{\"data\" : " . json_encode($this->leave_application_model->get_leave_application_all()) . "}";
    }

    function init_create_leave_application()
    {
        return null;
    }


}
