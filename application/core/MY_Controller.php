<?php if(!defined('BASEPATH')) exit('No direct script access is allowed');
class MY_Controller extends CI_Controller
{
	var $GlobalUserURL;
	var $DialogForms;
	var $data;
    var $content_view;
	function __construct($mode = null, $controller, $is_action_controller = false)
	{
		parent::__construct();
		$this->load->library('email');
        $this->load->model('menu_model');
        $this->load->model('appsetting_model');
		$this->setNavigationMenu();
		$this->DialogForms = $this->AttachDialogFormMenu($this->session->userdata('app_role'));
		$this->data = null;
		$this->data['dialogforms'] = $this->DialogForms;   
        $this->data['topmenu'] = $this->appsetting_model->get_top_menu();
        
        if($mode == 'authorize')
        {
            $this->authorize_user();
        }
        
        //Check the menu
        if($this->input->get('menu'))
        {
            $this->data['top_menu'] = $this->appsetting_model->get_top_menu_from_id($this->input->get('menu'));
            $smenu = array();
            $this->appsetting_model->get_child_menu_from_parent($this->data['top_menu'], $smenu);
            if(count($smenu) > 0)
            {
                $this->data['menu_selected'] = $this->input->get('menu');
            }
            else
            {
                $this->data['menu_selected'] = '';
            }
            
        }
        else
        {
            $this->data['top_menu'] = $this->appsetting_model->get_top_menu_from_controller($controller);
            $smenu = array();
            $this->appsetting_model->get_child_menu_from_parent($this->data['top_menu'], $smenu);
            if(count($smenu) > 0)
            {
                $this->data['menu_selected'] = $smenu[0]['id_application_menu'];
            }
            else
            {
                $this->data['menu_selected'] = '';
            }
        }
              
        $this->data['controller'] = $controller;
        
        if($mode != null && !$this->input->get('method'))
        {
            if($is_action_controller == false)
            {
                $this->content_view = $this->routing_page($controller);
            }
            
        }

        $this->data['class'] = $this;
        
        if($this->input->get('action'))
        {
            if($this->appsetting_model->check_action_authorization($this->input->get('action')))
            {
                $this->data['action'] = $this->menu_model->get_detail_action($this->input->get('action'));
            }
        }
        
         $this->data['side_nav'] = $this->load->view('navigation/side_menu', $this->data, true);
	}
    
    public function get_child_menu_from_id($id)
    {
        $result = array();
        $this->appsetting_model->get_structure_menu_from_top_menu($id, $result);
        return $result;
    }
    
    public function routing_page($controller)
    {
        $result = $this->load->view($controller . '/index', null, true);
        if($this->input->get('action'))
        {
            $result = $this->get_action($this->input->get('action'));
        }
        return $result;
    }
	
	function setNavigationMenu()
	{
		if($this->session->userdata('app_username'))
		{
            $this->template->setNav('navigation','adminnav');
			//switch($this->session->userdata('app_role'))
//			{
//				case 'administrator':
//					$this->template->setNav('navigation','adminnav');
//					break;
//				case 'divadministrator':
//					$this->template->setNav('navigation','divadminnav');
//					break;
//				case 'standard':
//					$this->template->setNav('navigation','standardnav');
//					break;
//			}
		}
	}
	
	public function redirectUserLogin() //tidak perlu
	{
        redirect(base_url(). 'dashboard/index');    
	}
	
	public function AllowedUserRole($roles)
	{
		$result = false;
		if($this->session->userdata('app_username'))
		{
			foreach($roles as &$role)
			{
				if($role == 'all')
				{
					$result = true;
					break;	
				}
								
				if($role == $this->session->userdata('app_role'))
				{
					$result = true;
					break;
				}
			}
		}
		else
		{
			redirect(site_url('welcome'));
		}
		
		if(!$result)
		{
			redirect('errors/access');
		}
	}
	
	public function getUserRole()
	{
		if($this->session->userdata('app_username'))
		{
			return $this->session->userdata('app_role');
		}
		else
		{
			return '';
		}
	}

	
	public function AttachDialogFormMenu($role)
	{
		
		$dialogforms = array();
		switch($role)
		{
			case 'administrator':

				break;
			case 'divadminsitrator':

				break;
			case 'standard':
				
				break;
		}
		return $dialogforms;
	}
	
	
	public function authorize_general_user()
	{
		if(!$this->session->userdata('app_userid'))
		{
			return false;
		}
		return true;
	}
	
	public function authorize_division_user($div)
	{
		if($div == $this->session->userdata('app_div_id'))
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function authorize_admin_user()
	{
		if('1' == $this->session->userdata('app_role_id'))
		{
			return true;
			
		}
		else
		{
			return false;
		}
	}
    
    public function authorize_user()
    {
        if(!$this->session->userdata('app_userid'))
        {
            redirect(base_url());
        }
    }
	
	public function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
		/*
		 $interval can be:
		yyyy - Number of full years
		q - Number of full quarters
		m - Number of full months
		y - Difference between day numbers
		(eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
		d - Number of full days
		w - Number of full weekdays
		ww - Number of full weeks
		h - Number of full hours
		n - Number of full minutes
		s - Number of full seconds (default)
		*/
	
		if (!$using_timestamps) {
			$datefrom = strtotime($datefrom, 0);
			$dateto = strtotime($dateto, 0);
		}
		$difference = $dateto - $datefrom; // Difference in seconds
		 
		switch($interval) {
			 
			case 'yyyy': // Number of full years
				$years_difference = floor($difference / 31536000);
				if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
					$years_difference--;
				}
				if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
					$years_difference++;
				}
				$datediff = $years_difference;
				break;
			case "q": // Number of full quarters
				$quarters_difference = floor($difference / 8035200);
				while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
					$months_difference++;
				}
				$quarters_difference--;
				$datediff = $quarters_difference;
				break;
			case "m": // Number of full months
				$months_difference = floor($difference / 2678400);
				while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
					$months_difference++;
				}
				$months_difference--;
				$datediff = $months_difference;
				break;
			case 'y': // Difference between day numbers
				$datediff = date("z", $dateto) - date("z", $datefrom);
				break;
			case "d": // Number of full days
				$datediff = floor($difference / 86400);
				break;
			case "w": // Number of full weekdays
				$days_difference = floor($difference / 86400);
				$weeks_difference = floor($days_difference / 7); // Complete weeks
				$first_day = date("w", $datefrom);
				$days_remainder = floor($days_difference % 7);
				$odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
				if ($odd_days > 7) { // Sunday
					$days_remainder--;
				}
				if ($odd_days > 6) { // Saturday
					$days_remainder--;
				}
				$datediff = ($weeks_difference * 5) + $days_remainder;
				break;
			case "ww": // Number of full weeks
				$datediff = floor($difference / 604800);
				break;
			case "h": // Number of full hours
				$datediff = floor($difference / 3600);
				break;
			case "n": // Number of full minutes
				$datediff = floor($difference / 60);
				break;
			default: // Number of full seconds (default)
				$datediff = $difference;
				break;
		}
		return $datediff;
	}
    
    
    public function get_side_menu_views($val = null)
    {
        $views = $this->menu_model->get_side_menu_view_by_value($val);
        return $views;
    }

    public function get_content()
    {
        echo $this->load->view($this->data['controller'] . '/' . $this->input->post('val') . '/function', null, true);
        echo $this->load->view($this->data['controller'] . "/" . $this->input->post('views'), null, true);
    }
    
    
    public function get_action_ajax()
    {
        $param = null;                                                
        if($this->input->post('param'))
        {
            $param = array();                                        
            foreach($this->input->post('param') as $p)
            {
                array_push($param, $p['paramValue']);               
            }         
        }
        $result = $this->execute_action($this->input->get('action'), $param);
        echo json_encode($result);
    }
    
    public function execute_action($action, $interfunction_param = null)
    {
        $action_array = $this->menu_model->get_detail_action($action);
        $result_execute = 'failed';
        $action_button = '';
        $content_title = '';  
        $data_view = null;
        $ajax_message = '';
        $action_id = (count($action_array) > 0 ? $action_array[0]['id_application_action'] : -1);
        if($this->appsetting_model->check_action_authorization($action_id))
        {       
            if(count($action_array) > 0)
            {
                $data_view = null;
                $param = null;
                if($interfunction_param != null)
                {
                    $param = $interfunction_param;
                }
                
                if($action_array[0]['function_exec'] != null || $action_array[0]['function_exec'] != '')
                {
                    $this->load->library('../controllers/' . $action_array[0]['controller']);
                    $initClass = substr_replace($action_array[0]['controller'], strtoupper(substr($action_array[0]['controller'], 0, 1)), 0, 1); 
                    $controller = new $initClass;
                                           
                    if($param != null)
                    {      
                        $data_view = call_user_func_array(array($controller, $action_array[0]['function_exec']), $param);                                                               
                    } 
                    else
                    {
                        $data_view = call_user_func(array($controller, $action_array[0]['function_exec']));
                    }                                                             
                }
                
                if($action_array[0]['use_log'] == 1 || $action_array[0]['use_log'] == true)
                {
                    $this->appsetting_model->add_log($action_array[0], $data_view);
                }
                
                if($this->appsetting_model->check_action_notify($action))
                {
                    $email_content = $this->create_email_content($action_array, $data_view);
                    $this->insert_email_queue($action, $email_content);
                }
                
                if($this->input->post('action_condition_identifier'))
                {
                    $action_condition = $this->appsetting_model->get_action_condition_by_action_and_identifier($action_array[0]['id_application_action'], $this->input->post('action_condition_identifier'));
                    if(count($action_condition) > 0)
                    {
    
                        $target = $action_condition[0]['target_action'];
                        //$action_array = $this->menu_model->get_detail_action($target);
                        if(isset($data_view['interfunction_param']))
                        {
                            $param = array(); 
                            foreach($data_view['interfunction_param'] as $p)
                            {
                                 array_push($param, $p['paramValue']); 
                            }
                        }
                        return $this->execute_action($target, $param); 
                    }
                }
                
                if($action_array[0]['target_action'] != null || $action_array[0]['target_action'] != '')
                {
                    if(isset($data_view['interfunction_param']))
                    {
                        $param = array(); 
                        foreach($data_view['interfunction_param'] as $p)
                        {
                             array_push($param, $p['paramValue']); 
                        }
                    }
                    return $this->execute_action($action_array[0]['target_action'], $param);                                                
                }
                $data_view['class'] = $this;
                $result_execute = 'success';
                $content_title = $action_array[0]['name'];
                $controller = $action_array[0]['controller'];
                $content = $this->load->view($action_array[0]['controller'] . ($action_array[0]['prefix'] != null && $action_array[0]['prefix'] != '' ? '/' . $action_array[0]['prefix'] : '' ) . '/' . $action_array[0]['view_file'], $data_view, true);
                $action_button = $this->load->view('templates/button/' . $action_array[0]['action_button'], null, true);   

            }
            else
            {
                $controller = '';
                $result_execute = 'failed';
                $content = $this->load->view('error/content_not_found', null, true);
            }
        }
        else
        {
            $controller = '';
            $result_execute = 'permission_denied';
            $content = $this->load->view('error/permission_denied', null, true);
            
            $ajax_message = 'Permission Denied to Action : {id: '. $action .', name: '. $action_array[0]['name'] .'}. Please contact your system administrator.';
        }
        
        $result = array(
            'content' => $content,           
            'result' => $result_execute,
            'button' => $action_button,
            'content_title' => $content_title,
            'param' => $this->input->post('param'),
            'ajax_message' => $ajax_message
        );
        
        if(count($action_array) > 0)
        {
            $result = array_merge($result, $action_array[0]);
        }  
        
        return $result;
    }            
    
    public function get_action($action)
    {
        $action_array = $this->menu_model->get_detail_action($action);
        $result = $this->load->view('error/content_not_found', null, true);
        $data_view = null;
        $apperror = false;
        if($this->appsetting_model->check_action_authorization($action))
        {
            if(count($action_array) > 0)
            {

                if($action_array[0]['function_exec'] != null || $action_array[0]['function_exec'] != '')
                {
                    $check = $this->check_action_function_args($action);
                    $this->load->library('../controllers/' . $action_array[0]['controller']);
                    $initClass = substr_replace($action_array[0]['controller'], strtoupper(substr($action_array[0]['controller'], 0, 1)), 0, 1); 
                    $controller = new $initClass;
                    if($check['result'] == 'args_complete')
                    {
                        $param = $check['param'];
                        $paramValue = array();                                        
                        foreach($param as $p)
                        {
                            array_push($paramValue, $this->input->get($p));               
                        }     
                        
                        $data_view = call_user_func_array(array($controller, $action_array[0]['function_exec']), $paramValue);   
                    }
                    else if($check['result'] == 'no_args')
                    {
                        $data_view = call_user_func(array($controller, $action_array[0]['function_exec']));
                    }
                    else
                    {
                        $apperror = true;
                        $data_view = array(
                            'message' => 'Cannot find one or more parameter in action : ' . $action_array[0]['name'] . '. Please checkk your application setting or contact your System Administrator'
                        );
                    }
                    
                }
                
                if($action_array[0]['use_log'] == 1 || $action_array[0]['use_log'] == true)
                {
                    $this->appsetting_model->add_log($action_array[0], $data_view);
                }
                
                if($this->appsetting_model->check_action_notify($action))
                {
                    $email_content = $this->create_email_content($action_array, $data_view);
                    $this->insert_email_queue($action, $email_content);
                }
                
                if($apperror == false)
                {
                    $data_view['class'] = $this;
                    $result = $this->load->view($action_array[0]['controller'] . ($action_array[0]['prefix'] != null && $action_array[0]['prefix'] != '' ? '/' . $action_array[0]['prefix'] : '' ) . '/' . $action_array[0]['view_file'], $data_view, true);
                }
                else
                {
                    $result = $this->load->view('error/application_error', $data_view, true);
                }
            }
        }
        else
        {
            $result = $this->load->view('error/permission_denied', $data_view, true);
        }
        return $result;
    }
    
    public function check_action_function_args($id_action)
    {
        $this->load->model('appsetting_model');
        $action = $this->appsetting_model->get_action_by_id($id_action);
        $args = array();
        $result = 'no_args';
        $param = array();
        if($action[0]['function_args'] != null && $action[0]['function_args'] != '')
        {
            if (strpos($action[0]['function_args'] ,',') !== false) 
            {
                $args = explode(',', $action[0]['function_args']);
            }
            else
            {
                array_push($args, $action[0]['function_args']);
            }
            
            $check = true;
            foreach($args as $a)
            {
                if(!$this->input->get($a))
                {
                    $check = false; 
                    break;
                }
                else
                {
                    array_push($param, $a);
                }
            }
            if($check)
            {
                $result = 'args_complete';
            }
            else
            {
                $result = 'args_not_complete';
            }
        }
        
        $result_json = array(
            'result' => $result,
            'param' => $param
        );
        
        return $result_json;
    }
    
    public function send_email_notification_to_group($subject, $message)
    {
        $email_to = $this->group_model->get_group_member_email($this->session->userdata('app_userid'));
    }
    
    public function get_app_config_value($param)
    {
        $result = $this->appsetting_model->get_app_config_by_name($param);
        
        return $result;
    }
    
    public function send_automatic_notification_email()
    {
        $emails = $this->appsetting_model->get_all_email_queue_not_sent();
        foreach($emails as $e)
        {
            $this->send_notification_email($e['to'], $e['cc'], $e['bcc'], $e['subject'], $e['content']);
            $this->appsetting_model->change_email_queue_status($e['id_send_email_temp'], 'sent');
        }
    }
    
    public function insert_email_queue($action, $message)
    {
        $email_1 = $this->appsetting_model->get_user_from_group_and_action_with_exclude($action, $this->session->userdata('app_userid'));
        $email_2 = $this->appsetting_model->get_administrator_group_for_email($action, $this->session->userdata('app_userid'));
        $action_data = $this->appsetting_model->get_action_by_id($action);
        array_merge($email_1, $email_2);
        $email_1 = json_encode($email_1);
        $this->appsetting_model->insert_email_queue($email_1, null, null,$this->get_app_config_value('default_email_subject') . $action_data[0]['name'], json_encode($message));
    }
    
    public function send_notification_email($to, $cc, $bcc, $subject, $body)
	{
		$this->initialize_email();
		$array_to = array();
        $to = json_decode($to, true);
		foreach($to as $t)
		{
			$array_to[] = $t['email'];
		}
		$this->email->to($array_to); 
		//$this->email->cc($cc);
		//$this->email->bcc($bcc);

		$this->email->subject($subject);
		$data['message'] = json_decode($body, true);
        $data['company_name'] = $this->get_app_config_value('company_name');
        $data['company_address'] = $this->get_app_config_value('company_address');
		$content = $this->load->view('templates/email/default',$data, true);
		$this->email->message($content);	
	     
		//exit($this->email->print_debugger());
                	
		return $this->email->send();
	
	}
	
	public function initialize_email()
	{
		
		$config['protocol'] = 'smtp';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';

        

        $config['smtp_host'] = 'ssl://' . $this->get_app_config_value('outgoing_mail_server');
      
		
		$config['smtp_user'] = $this->get_app_config_value('application_email');
		$config['smtp_pass'] = $this->get_app_config_value('application_email_password');
		$config['smtp_port'] = $this->get_app_config_value('outgoing_mail_server_port');

		$this->email->initialize($config);
		$this->email->from($this->get_app_config_value('application_email'), $this->get_app_config_value('application_email_name'));
	}
    
    public function create_email_content($action_array, $data_view)
    {
        $email_header = $this->get_app_config_value('default_email_notification_header') . $this->session->userdata('app_fullname') . '</br></br>';
        $email_data = (isset($data_view['log_param']) ? json_encode($data_view['log_param']) : $action_array[0]['name']);
        $email_footer = '<a href="'. base_url() . $action_array[0]['controller'] . '/?' . 'action=' . $action_array[0]['target_action']  . '">link to data</a>';
        $email_content = array("header" => $email_header, "data" => $email_data, "footer" => $email_footer);
        return $email_content;
    }
    
    public function has_access_to_action($action)
    {
        $result = $this->appsetting_model->get_role_access_to_action($this->session->userdata('app_role_id'), $action);
        if(count($result) > 0)
        {
            return true;
        }
        
        return false;
    }
}
?>