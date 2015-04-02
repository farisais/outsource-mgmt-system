<?php
class Appsetting_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
    
    public function get_parent_menu_all()
    {
        $this->db->select('application_side_menu.*, division.name AS division_name, asm.name AS parent_name');
        $this->db->from('application_side_menu');
        $this->db->join('division', 'division.id_division=application_side_menu.division', 'LEFT');
        $this->db->join('application_side_menu AS asm', 'application_side_menu.parent=asm.id_application_menu', 'LEFT');
        $this->db->where('application_side_menu.type','group');
        $this->db->or_where('application_side_menu.type', 'top-menu');
        
        return $this->db->get()->result_array();
    }
    
    public function get_action_all()
    {
        $this->db->select('application_action.*,ac.name AS action_name');
        $this->db->from('application_action AS application_action');
        $this->db->join('application_action AS ac','ac.id_application_action=application_action.target_action', 'LEFT');
        $this->db->order_by('application_action.id_application_action','DESC'); 
        return $this->db->get()->result_array();
    }
    
    public function add_side_menu()
    {
        $this->db->trans_start();
        $data = array(
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'parent' => ($this->input->post('type') == 'top-menu' ? null : ($this->input->post('parent') == '' ? null : $this->input->post('parent'))) ,
            'action' => ($this->input->post('action_bind') == '' ? null : $this->input->post('action_bind')),
            'controller' => ($this->input->post('controller') == '' ? null : $this->input->post('controller')),
            'division' => ($this->input->post('division') == '' ? null : $this->input->post('division')),
            'index' => $this->input->post('index')
        );
        
        $this->db->insert('application_side_menu', $data);
        $this->db->trans_complete();
    }
    
    public function edit_side_menu($id)
    {
        $this->db->trans_start();
        $data = array(
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'parent' => ($this->input->post('parent') == '' ? null : $this->input->post('parent')) ,
            'controller' => ($this->input->post('controller') == '' ? null : $this->input->post('controller')),
            'action' => ($this->input->post('action_bind') == '' ? null : $this->input->post('action_bind')),
            'division' => ($this->input->post('division') == '' ? null : $this->input->post('division')),
            'index' => $this->input->post('index')
        );
        
        $this->db->where('id_application_menu', $id);
        $this->db->update('application_side_menu', $data);
        $this->db->trans_complete();
    }
    
    public function delete_side_menu()
    {
        $this->db->trans_start();
        
        $this->db->where('id_application_menu', $this->input->post('id_application_menu'));
        $this->db->delete('application_side_menu');
        $this->db->trans_complete();
    }
    
    public function add_action()
    {
        $this->db->trans_start();
        $data = array(
            'name' => $this->input->post('name'),
            'uname' => $this->input->post('uname'),
            'controller' => $this->input->post('controller'),
            'function_exec' => $this->input->post('function_exec'),
            'function_args' => $this->input->post('function_args'),
            'view_type' => $this->input->post('view_type'),
            'view_file' => $this->input->post('view_file'),
            'prefix' => $this->input->post('prefix'),
            'action_type' => $this->input->post('action_type'),
            'action_button' => $this->input->post('action_button'),
            'target_action' => ($this->input->post('target_action') == '' ? null : $this->input->post('target_action')),
            'use_log' => $this->input->post('use_log')
        );
        
        $this->db->insert('application_action', $data);
        $last_id = $this->db->insert_id();
        $this->add_action_condition($last_id);
        
        $this->db->trans_complete();
        $data_post = $this->input->post();
        array_merge($data_post, array("id_application_action" => $last_id));
        return $data_post;
    }
    
    public function edit_action($id)
    {
        $this->db->trans_start();
        $data = array(
            'name' => $this->input->post('name'),
            'uname' => $this->input->post('uname'),
            'controller' => $this->input->post('controller'),
            'function_exec' => $this->input->post('function_exec'),
            'function_args' => $this->input->post('function_args'),
            'view_type' => $this->input->post('view_type'),
            'view_file' => $this->input->post('view_file'),
            'prefix' => $this->input->post('prefix'),
            'action_type' => $this->input->post('action_type'),
            'action_button' => $this->input->post('action_button'),
            'target_action' => ($this->input->post('target_action') == '' ? null : $this->input->post('target_action')),
            'use_log' => $this->input->post('use_log')
        );
        
        $this->db->where('id_application_action', $id);
        $this->db->update('application_action', $data);
        
        $this->delete_action_condition($id);
        $this->add_action_condition($id);
        
        $this->db->trans_complete();
        
        $data_post = $this->input->post();
        array_merge($data_post, array("id_application_action" => $id));
        return $data_post;
    }
    
    public function add_action_condition($id)
    {
        if($this->input->post('action_condition') != null)
        {
            foreach($this->input->post('action_condition') as $condition)
            {
                $data = array(
                    'identifier' => $condition['identifier'],
                    'target_action' => $condition['target_action'],
                    'action' => $id
                );
                
                $this->db->insert('application_action_conditioner', $data);
            }
        }  
    }
    
    public function delete_action_condition($id)
    {
        $this->db->where('action', $id);
        $this->db->delete('application_action_conditioner');
    }            
    
    public function delete_action()
    {
        $this->db->trans_start();
        
        $this->db->where('id_application_action', $this->input->post('id_application_action'));
        $this->db->delete('application_action');
        
        $this->db->trans_complete();
    }
    
    public function get_action_by_id($id)
    {
        $this->db->select('application_action.*,ac.name AS action_name');
        $this->db->from('application_action AS application_action');
        $this->db->join('application_action AS ac','ac.id_application_action=application_action.target_action', 'LEFT');
        $this->db->where('application_action.id_application_action', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function get_action_condition_by_action($id)
    {
        $this->db->select('application_action_conditioner.*, application_action.name as target_action_name');
        $this->db->from('application_action_conditioner');
        $this->db->join('application_action', 'application_action_conditioner.target_action=application_action.id_application_action', 'INNER');
        $this->db->where('application_action_conditioner.action', $id);
        
        return $this->db->get()->result_array();    
    }
    
    public function get_action_condition_by_action_and_identifier($id, $identifier)
    {
        $this->db->select('application_action_conditioner.*, application_action.name as target_action_name');
        $this->db->from('application_action_conditioner');
        $this->db->join('application_action', 'application_action_conditioner.target_action=application_action.id_application_action', 'INNER');
        $this->db->where('application_action_conditioner.action', $id);
        $this->db->where('application_action_conditioner.identifier', $identifier);
        
        return $this->db->get()->result_array();    
    }
    
    public function get_division_all()
    {
        $this->db->select('*');
        $this->db->from('division');
        
        return $this->db->get()->result_array();
    }
    
    public function get_top_menu()
    {
        $this->db->select('*');
        $this->db->from('application_side_menu');
        $this->db->where('type', 'top-menu');
        $this->db->order_by('index', 'ASC');
        
        return $this->db->get()->result_array();
    }
    
    public function get_menu_by_parent($parent)
    {
        $this->db->select('*');
        $this->db->from('application_side_menu');
        $this->db->where('parent', $parent);
        $this->db->order_by('index', 'ASC');
        
        return $this->db->get()->result_array();
    }
    
    public function get_top_menu_from_id($id)
    {
        $this->db->select('*');
        $this->db->from('application_side_menu');
        $this->db->where('id_application_menu', $id);
        
        $result = $this->db->get()->result_array();
        if(count($result) > 0 )
        {
            if($result[0]['type'] == 'top-menu')
            {
                return $result[0]['id_application_menu'];
            }
            else
            {
                if($result[0]['parent'] != null)
                {
                    return $this->get_top_menu_from_id($result[0]['parent']);
                }
                else
                {
                    return 'not_found';
                }
                
            }
        }
        else
        {
            return 'not_found';
        }
    }
    
    public function get_default_menu_selected($topmenu)
    {
        $this->db->select('*');
        $this->db->from('application_side_menu');
        $this->db->where('parent', $topmenu);
        $this->db->order_by('index', 'ASC');
        
        $result = $this->db->get()->result_array();
        if(count($result) > 0)
        {
            
        }
        return $this->db->get()->result_array();
    }
    
    public function get_child_menu_from_parent($id, &$result)
    {
        $this->db->select('*');
        $this->db->from('application_side_menu');
        $this->db->where('parent', $id);
        $this->db->order_by('index', 'ASC');
        
        foreach($this->db->get()->result_array() as $child)
        {
            if($child['type'] == 'child')
            {
                array_push($result, $child);
            }
            else
            {
                $this->get_child_menu_from_parent($child['id_application_menu'], $result);
            }
        }
    }
    
    public function get_top_menu_from_controller($controller)
    {
        $this->db->select('*');
        $this->db->from('application_side_menu');
        $this->db->where('controller', $controller);
        $result = $this->db->get()->result_array();
        if(count($result) > 0)
        {
            return $result [0]['id_application_menu'];
        }
        else
        {
            return '';
        }
        
    }
    
    public function get_structure_menu_from_top_menu($tm, &$result)
    {
        $this->db->select('*');
        $this->db->from('application_side_menu');
        $this->db->where('parent', $tm);
        $this->db->order_by('index', 'ASC');
        
        foreach($this->db->get()->result_array() as $child)
        {
            if($child['type'] == 'child')
            {
                if(count($this->get_role_access_to_action($this->session->userdata('app_role_id'), $child['action'])) > 0)
                {
                    array_push($result, $child);
                }
            }
            if($child['type'] == 'group')
            {
                array_push($result, $child);
                $this->get_structure_menu_from_top_menu($child['id_application_menu'], $result);
            }
        }
    }
    
    public function get_role_access_to_action($rid, $action)
    {
        $this->db->select('*');
        $this->db->from('detail_role');
        $this->db->where('role', $rid);
        $this->db->where('action', $action);
        
        return $this->db->get()->result_array();
    }
    
    public function get_role_all()
    {
        $this->db->select('*');
        $this->db->from('role');
        
        return $this->db->get()->result_array();
    }
    
    public function save_role($data_post)
    {
        $this->db->trans_start();
        
        $data = array(
            "name" => $data_post['name']
        );
        
        $this->db->insert('role', $data);
        $last_id = $this->db->insert_id();
        
        $this->save_detail_role($last_id, $data_post['action_detail']);
        
        $this->db->trans_complete();
        
        $data_post['id_role'] = $last_id;
        return $data_post;
    }
    
    public function save_detail_role($id_role, $data_detail)
    {
        foreach($data_detail as $d)
        {
            $data = array(
                'role' => $id_role,
                'action' => $d['id_application_action']
            );
            
            $this->db->insert('detail_role', $data);
        }
    }
    
    public function get_role_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('role');
        $this->db->where('id_role', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function get_detail_role_by_id_role($id)
    {
        $this->db->select('detail_role.*, application_action.id_application_action, application_action.name');
        $this->db->from('detail_role');
        $this->db->join('application_action', 'application_action.id_application_action=detail_role.action', 'INNER');
        $this->db->where('detail_role.role', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function delete_role()
    {
        $this->db->trans_start();
        
        $data_delete = $this->get_role_by_id($this->input->post('id_role'));
        $this->db->where('id_role', $this->input->post('id_role'));
        $this->db->delete('role');
    
        $this->db->trans_complete();

        return $data_delete;
    }
    
    public function edit_role($data_post)
    {
        $this->db->trans_start();
        
        $data = array(
            "name" => $data_post['name']
        );
        
        $this->db->where('id_role', $data_post['id_role']);
        $this->db->update('role', $data);
        
        $this->delete_detail_role_by_id_role($data_post['id_role']);
        
        $this->save_detail_role($data_post['id_role'], $data_post['action_detail']);
        
        $this->db->trans_complete();
        
        return $data_post;
    }
    
    public function delete_detail_role_by_id_role($id)
    {
        $this->db->where('role', $id);
        $this->db->delete('detail_role');
    }
    
    //================================================================================
    //
    //    USER MODEL
    //
    //================================================================================
    
    public function get_user_all()
    {
        $this->db->select('user.*, role.name');
        $this->db->from('user');
        $this->db->join('role', 'role.id_role=user.role', 'LEFT');
        if($this->session->userdata('app_userid') <> '2')
        {
            $this->db->where('user.id_user <>', '2');
        }
        
        return $this->db->get()->result_array();
    }
    
    public function insert_user($data)
    {
        $this->db->trans_start();
        $user = $data['user_name'];
        $email = $this->security->xss_clean($data['email']);
        $password = md5($this->security->xss_clean($data['password']));
        
        $data_input = array(
            "user_name" => $user,
            "full_name" => $data['full_name'],
            "email" => $email,
            "password" => $password,
            "role" => ($data['role'] == '' ? null : $data['role'])
        );
        
        $this->db->insert('user', $data_input);
        $this->db->trans_complete();
    }
    
    public function edit_user($data)
    {
        $this->db->trans_start();
        $user = $data['user_name'];
        $email = $this->security->xss_clean($data['email']);
        
        $data_input = array(
            "user_name" => $user,
            "full_name" => $data['full_name'],
            "email" => $email,
            "role" => ($data['role'] == '' ? null : $data['role'])
        );
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('user', $data_input);
        $this->db->trans_complete();
    }
    
    public function get_user_by_id($id)
    {
        $this->db->select('user.*, role.name');
        $this->db->from('user');
        $this->db->join('role', 'role.id_role=user.role', 'LEFT');
        
        $this->db->where('user.id_user', $id);
        return $this->db->get()->result_array();
    }
    
    public function delete_user($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id_user', $id);
        $this->db->delete('user');
        
        $this->db->trans_complete();
    }
    
    public function change_user_password($data)
    {
        $this->db->trans_start();
        
        $password = md5($this->security->xss_clean($data['password']));
        $data_input = array(
            "password" => $password
        );
        
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('user', $data_input);
        
        $this->db->trans_complete();
    }
    
    //================================================================================
    //
    //    ACTIVITY LOG
    //
    //================================================================================
    
    public function add_log($action, $data)
    {
        $this->db->trans_start();
        
        $is_param = false;
        $paramString = '{}';
        if(isset($data['log_param']) && count($data['log_param']) > 0 )
        {

            $paramString = json_encode($data['log_param']);

        }

        $data = array(
            'activity' => $action['name'],
            'object' => $action['controller'],
            'object_id' => (isset($data['id_log']) ? $data['id_log'] : null),
            'user' => $this->session->userdata('app_userid'),
            'description' => $action['name'],
            'action' => $action['id_application_action'],
            'field_data' => $paramString,
            'date_create' => date("Y-m-d H:i:s")
        );
        
        $this->db->insert('activity_log', $data);
        
        $this->db->trans_complete();
    }
    
    public function check_action_authorization($action_id)
    {
        $this->db->select('*');
        $this->db->from('detail_role');
        $this->db->where('action', $action_id);
        $this->db->where('role', $this->session->userdata('app_role_id'));
        
        return (count($this->db->get()->result_array()) > 0 ? true : false);
        
    }
    
    //================================================================================
    //
    //    APPCONFIG MODEL
    //
    //================================================================================
    
    public function get_app_config_all()
    {
        $this->db->select('*');
        $this->db->from('application_config');
        
        return $this->db->get()->result_array();
    }
    
    public function save_app_config($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['name'] = $data['name'];
        $data_input['data_type'] = $data['data_type'];
        $data_input['value'] = $data['value'];
        
        $this->db->insert('application_config', $data_input);
        
        $this->db->trans_complete();
        
        return $data_input;
    }
    
    public function edit_app_config($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['name'] = $data['name'];
        $data_input['data_type'] = $data['data_type'];
        $data_input['value'] = $data['value'];
        
        $this->db->where('id_config', $data['id_config']);
        $this->db->update('application_config', $data_input);
        
        $this->db->trans_complete();
        
        return $data_input;
    }
    
    public function delete_app_config($id)
    {
        $this->db->trans_start();
        

        $this->db->where('id_config', $id);
        $this->db->delete('application_config');
        
        $this->db->trans_complete();
        
        return array("id_config" => $id);
    }
    
    public function get_app_config_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('application_config');
        $this->db->where('id_config', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function get_app_config_by_name($name)
    {
        $this->db->select('*');
        $this->db->from('application_config');
        $this->db->where('name', $name);
        
        $result = $this->db->get()->result_array();
        if(count($result) > 0)
        {
            return $result[0]['value'];
        }
        else
        {
            return false;
        }
    }
    
    //================================================================================
    //
    //    NOTIFICATION SETTING MODEL
    //
    //================================================================================
    
    public function get_notification_setting_all()
    {
        $this->db->select('*');
        $this->db->from('notification_setting');
        
        return $this->db->get()->result_array();
    }
    
    public function save_notification_setting($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['name'] = $data['name'];
        $data_input['description'] = $data['description'];
        $data_input['email_template_header'] = $data['email_template_header'];
        
        $this->db->insert('notification_setting', $data_input);
        
        $return_id = $this->db->insert_id();
        
        $this->insert_notification_setting_action($return_id, $data['action_list']);
        
        $this->insert_notification_setting_group($return_id, $data['group_list']);
        
        $this->db->trans_complete();
        
        return $data_input;
    }
    
    public function edit_notification_setting($data)
    {
        $this->db->trans_start();
        
        $data_input = array();
        $data_input['name'] = $data['name'];
        $data_input['description'] = $data['description'];
        $data_input['email_template_header'] = $data['email_template_header'];
        
        $return_id = $data['id_notification_setting'];
        
        $this->db->where('id_notification_setting', $return_id);
        $this->db->update('notification_setting', $data_input);
        
        $this->delete_notification_setting_action($return_id);
        $this->insert_notification_setting_action($return_id, $data['action_list']);
        
        $this->delete_notification_setting_group($return_id);
        $this->insert_notification_setting_group($return_id, $data['group_list']);
        
        $this->db->trans_complete();
        
        return $data_input;
    }
    
    public function insert_notification_setting_action($id, $data)
    {
        foreach($data as $d)
        {
            $data_input['notification_setting'] = $id;
            $data_input['action'] = $d['action'];
            
            $this->db->insert('notification_setting_action', $data_input);
        }
    }
    
    public function delete_notification_setting_action($id)
    {
        $this->db->where('notification_setting', $id);
        $this->db->delete('notification_setting_action');
    }
    
    public function insert_notification_setting_group($id, $data)
    {
        foreach($data as $d)
        {
            $data_input['notification_setting'] = $id;
            $data_input['group'] = $d['id_group'];
            
            $this->db->insert('notification_setting_group', $data_input);
        }
    }
    
    public function delete_notification_setting_group($id)
    {
        $this->db->where('notification_setting', $id);
        $this->db->delete('notification_setting_group');
    }
    
    public function delete_notification_setting($id)
    {
        $this->db->trans_start();
        
        $this->delete_notification_setting_action($id);
        $this->delete_notification_setting_group($id);

        $this->db->where('id_notification_setting', $id);
        $this->db->delete('notification_setting');
        
        $this->db->trans_complete();
        
        return array("id_notification_setting" => $id);
    }
    
    public function get_notification_setting_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('notification_setting');
        $this->db->where('id_notification_setting', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function get_notification_setting_group($id)
    {
        $this->db->select('ng.*,g.name as group_name, g.id_group');
        $this->db->from('notification_setting_group as ng');
        $this->db->join('group as g', 'g.id_group=ng.group', 'INNER');
        $this->db->where('ng.notification_setting', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function get_notification_setting_action($id)
    {
        $this->db->select('na.*, ac.name as action_name');
        $this->db->from('notification_setting_action as na');
        $this->db->join('application_action as ac', 'ac.id_application_action=na.action', 'INNER');
        $this->db->where('na.notification_setting', $id);
        
        return $this->db->get()->result_array();
    }
    
    public function get_user_from_group_and_action_with_exclude($action, $user_exclude)
    {
        $query = 'select u1.email from group_member as g1 inner join user as u1 on u1.id_user = g1.user_member
        inner join notification_setting_group as ng on ng.group = g1.group
        inner join notification_setting_action as na on na.notification_setting = ng.notification_setting
        where na.action = '. $action .' and u1.id_user <> ' . $user_exclude;
        
        $result = $this->db->query($query);
        return $result->result_array();
    }
    
    public function get_administrator_group_for_email($action, $user_exclude)
    { 
        $query = 'select u1.email from `group` as g1
        inner join notification_setting_group as ng on ng.group = g1.id_group
        inner join notification_setting_action as na on na.notification_setting = ng.notification_setting
        inner join user as u1 on u1.id_user=g1.administrator
        where action = '. $action .' and u1.id_user <> '. $user_exclude; 
        
        $result = $this->db->query($query);
        return $result->result_array();
    }
    
    public function check_action_notify($action)
    {
        $this->db->select('*');
        $this->db->from('notification_setting_action');
        $this->db->where('action', $action);
        
        $result = count($this->db->get()->result_array());
        return ($result > 0 ? true : false);
    }
    
    //================================================================================
    //
    //    EMAIL QUEUE
    //
    //================================================================================
    
    public function insert_email_queue($to, $cc, $bcc, $subject, $body)
    {
        $data = array();
        $data['to'] = $to;
        $data['cc'] = $cc;
        $data['bcc'] = $bcc;
        $data['subject'] = $subject;
        $data['content'] = $body;
        $data['sending_status'] = 'not_sent';
        
        $this->db->insert('send_email_temp', $data);
        
    }
    
    public function change_email_queue_status($id, $status)
    {
        $data = array();
        $data['sending_status'] = $status;
        $this->db->where('id_send_email_temp', $id);
        $this->db->update('send_email_temp', $data);
    }
    
    public function get_all_email_queue_not_sent()
    {
        $this->db->select('*');
        $this->db->from('send_email_temp');
        $this->db->where('sending_status', 'not_sent');
        
        return $this->db->get()->result_array();
    }
    public function copy_action($id)
    {
        $this->db->query('INSERT INTO 
        application_action(name,uname,controller,function_exec,function_args,view_type,view_file,prefix,action_type,action_button,target_action,use_log) 
        SELECT name,uname,controller,function_exec,function_args,view_type,view_file,prefix,action_type,action_button,target_action,use_log 
        FROM  application_action WHERE id_application_action='.$id);
        $last_id = $this->db->insert_id();
        $this->add_detail_role($last_id);
    }
    public function add_detail_role($last_id){
        $data = array();
        $data['role'] = 1;
        $data['action'] = $last_id;
        $this->db->insert('detail_role', $data);
    }
}
?>