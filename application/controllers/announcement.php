<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announcement extends MY_Controller
{
	function __construct()
	{
		parent::__construct('authorize', 'announcement', true);
        $this->load->model('announcement_model');
	}
    
    public function init_view_announcement()
    {
        $data = array(
            'activity_list' => $this->announcement_model->get_announcement(1),
            'count_nav' => $this->announcement_model->count_announcement()
        );
        return $data;
    }
    
    public function redirect()
    {
        $data = array(
            'activity_list' => $this->announcement_model->get_announcement($this->input->post('index')),
            'count_nav' => $this->announcement_model->count_announcement()
        );
        echo json_encode(array("content" => $this->load->view('announcement/announcement_content', $data, true), "index" => $this->input->post('index')));
    }
}
?>