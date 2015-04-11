<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quotation extends MY_Controller
{
    function __construct() 
    {
        parent::__construct("authorize", "quotation", true);
        $this->load->model('quotation_model');
        $this->load->model('cost_element_model');
    }
    
    public function get_quotation_list()
    {
        echo "{\"data\" : " . json_encode($this->quotation_model->get_quotation_all($this->input->get('status'))) . "}";
    }
    
    public function get_quotation_product_list()
    {
        $quote_product = $this->quotation_model->get_quotation_product($this->input->get('id'));
        for($i=0;$i<count($quote_product);$i++)
        {
            $pd = $this->quotation_model->get_product_definition_from_product($quote_product[$i]['id_product']);
            $qce = $this->quotation_model->get_ce_assignment_from_quote_str($this->input->get('id'), $pd[0]['organisation_structure']);
            $calc = $this->cost_element_model->calculate_invoice('per_month', $qce[0]['cost_element']);
            $quote_product[$i]['price'] = $calc['total'];
        }
        echo "{\"data\" : " . json_encode($quote_product) . "}";
    }
    
    public function get_quotation_survey_list()
    {
        echo "{\"data\" : " . json_encode($this->quotation_model->get_quotation_survey($this->input->get('id'))) . "}";
    }
    
    public function get_quotation_working_schedule_list()
    {
        echo "{\"data\" : " . json_encode($this->quotation_model->get_quotation_working_schedule($this->input->get('id'))) . "}";
    }
    
    public function save_quotation()
    {
         // var_dump($this->input->post()); die();
        if($this->input->post('is_edit') == 'true')
        {
            $this->quotation_model->edit_quotation($this->input->post());
        }
        else
        {
            $this->quotation_model->add_quotation($this->input->post());
        }
        
        return null;
    }
    
    public function delete_quotation()
    {
        $this->quotation_model->delete_quotation($this->input->post('id_quotation'));
        
        return null;
    }
    
    public function init_edit_quotation($id)
    {
        $data = array(
            'data_edit' => $this->quotation_model->get_quotation_by_id($id),
            'is_edit' => true
        );
        
        return $data;
    }
    
    public function init_create_quotation()
    {
        return null;
    }
    
    public function make_working_schedule()
    {
        $id = $this->input->post('id_quotation');
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "quotation", "paramValue" => $id);
        return array("interfunction_param" => $interfunction_param);
    }
    
    public function validate_quotation($id)
    {
        $param = $this->quotation_model->validate_quotation($id);
        $interfunction_param = array();
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $id);
        return array('log_param' => $param, "interfunction_param" => $interfunction_param);
    }
    
    public function upload_survey()
    {
        $this->load->library('upload');

        $config['upload_path'] = './documents/survey';
        $config['overwrite'] = true;
        $config['allowed_types'] = '*';
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('survey_file')) {
            $uploaded = $this->upload->data();
            $filename = $this->quotation_model->add_quotation_survey_file($uploaded);
            rename($uploaded['full_path'], $config['upload_path'] . '/' . $filename);
            echo $filename;
        }

        echo $this->upload->display_errors();
    }
    
    public function init_view($id)
    {
        $data = $this->init_edit_quotation($id);
        $data['is_view'] = true;
        
        return $data;
    }
    public function get_cost_element()
    {   $id_quotation=$this->uri->segment(3);
        echo "{\"data\" : " . json_encode($this->quotation_model->get_cost_element($id_quotation)) . "}";
    }
    public function get_cost_element_detail()
    {   $id_work_order=$this->uri->segment(3);
        echo "{\"data\" : " . json_encode($this->quotation_model->get_cost_element_detail()) . "}";
    }
    function init_view_cost_element($id_quote) 
    {
        $data = array(
            'data_edit' => $this->quotation_model->get_quotation_by_id($id_quote),
            'is_edit' => true,
            'id_quotation' => $this->input->post('id_quotation')
        );
        return $data;
    }
    function copy_cost_element(){
        $id_template=$this->input->post('id_template');
        $id_quotation=$this->input->post('id_quotation');
        $this->quotation_model->copy_cost_element($id_template,$id_quotation);
        echo 'success';
    }
    public function get_cost_element_template()
    {   
        echo "{\"data\" : " . json_encode($this->quotation_model->get_cost_element_template()) . "}";
    }
    public function get_cost_element_detail_template()
    {   $id_work_order=$this->uri->segment(3);
        echo "{\"data\" : " . json_encode($this->quotation_model->get_cost_element_detail_template()) . "}";
    }
    public function save_cost_element()
    {
        $this->quotation_model->save_cost_element($this->input->post());
        
        $interfunction_param[0] = array("paramKey" => "id", "paramValue" => $this->input->post('id'));
        return array("interfunction_param" => $interfunction_param);
    }

    public function get_structure_ws_from_quote($id)
    {
        echo "{\"data\" : " . json_encode($this->quotation_model->get_structure_ws_from_quote($id)) . "}";
    }

    public function save_ce_assign()
    {
        $this->quotation_model->save_ce_assign($this->input->post());
        $result = array();
        foreach($this->input->post('ce_assign') as $ce)
        {
            $calc = $this->cost_element_model->calculate_invoice('per_month', $ce['cost_element']);
            $pd = $this->quotation_model->get_product_definition_from_structure($ce['structure']);
            $calc['product'] = $pd[0]['product'];
            array_push($result, $calc);
        }
        echo "{ \"status\" : \"success\", \"calculation\" : ". json_encode($result) ." }";
    }

    public function get_calc($ce)
    {
        echo json_encode($this->cost_element_model->calculate_invoice('per_month', $ce));
    }
}
?>
