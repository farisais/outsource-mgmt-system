<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shift_change extends MY_Controller
{
    function __construct()
    {
        parent::__construct("authorize", "shift_change", true);
        $this->load->model('shift_change_model');
    }

    function get_shift_change_list()
    {
        echo "{\"data\" : " . json_encode($this->shift_change_model->get_shift_change_all()) . "}";
    }

    function init_create_shift_change()
    {
        return null;
    }


}
