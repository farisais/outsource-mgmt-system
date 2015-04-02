<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Unit_measure extends MY_Controller
{
	public function __construct()
	{
		parent::__construct('authorize', 'unit_measure', true);
        $this->load->model('unit_measure_model');
	}
    
    public function init_edit_unit_measure($id)
    {
        $data = array(
            "data_edit" =>  $this->unit_measure_model->get_unit_measure_by_id($id),
            "unit_convertion" =>  $this->unit_measure_model->get_unit_convertion_by_unit($id),
            "is_edit" => 'true',
            "uom_category" => $this->unit_measure_model->get_uom_category_all()
        );
        
        return $data;
       
    }
    
    public function init_create_unit_measure()
    {
        $data = array();
        $data['uom_category'] = $this->unit_measure_model->get_uom_category_all();
        
        return $data;
    }
    
    public function get_unit_convertion()
    {
        echo "{\"data\":" . json_encode($this->unit_measure_model->get_unit_convertion_by_unit($this->input->get('id'))) . "}";
    }
    
    public function get_unit_measure_list()
    {
        echo "{\"data\" : " . json_encode($this->unit_measure_model->get_unit_measure_all()) . "}";
    }
    
    public function delete_unit_measure()
    {
        $this->unit_measure_model->delete_unit_measure($this->input->post('id_unit_measure'));
    }
    
    public function save_unit_measure()
    {
        $result = null;
        try
        {
            if($this->input->post('is_edit') == 'false')
            {
                $this->unit_measure_model->save_unit_measure($this->input->post());
            }
            else
            {
                $this->unit_measure_model->edit_unit_measure($this->input->post());
            }
        }
        catch(Exception $e)
        {
            exit($e->message .  'hahaha');
        }
        return null;
    }
}