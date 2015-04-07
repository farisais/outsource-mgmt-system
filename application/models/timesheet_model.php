<?php
class Timesheet_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_timesheet_all()
	{
		$query =$this->db->query("SELECT t.*,w.project_name
                            FROM timesheet_group t
                            JOIN work_order w ON w.id_work_order=t.work_order_id ORDER BY t.id DESC");
                
		return $query->result_array();
	}
    public function get_list_work_order()
	{
		$query =$this->db->query("SELECT id_work_order,project_name
                            FROM work_order
                            WHERE status='running'
                            ORDER BY project_name DESC");
                
		return $query->result_array();
	}
    
	public function get_timesheet_by_date($date,$work_order_id)
	{
		$query =$this->db->query("SELECT * FROM timesheet_group WHERE date='$date' AND work_order_id=$work_order_id");
        if($query->num_rows() > 0){
            return false;
        }else{
            return true;
        }
	}
    public function get_timesheet_detail_all()
	{
		$query =$this->db->query("SELECT t.*,e.full_name,ee.full_name as nama_supervisor
                            FROM timesheet t
                            LEFT JOIN employee e ON e.employee_number=t.employee_number
                            LEFT JOIN employee ee ON ee.employee_number=t.supervisor_id");
                
		return $query->result_array();
	}
    public function get_work_order_all(){
        $this->db->select('*');
        $this->db->from('work_order');
        
        return $this->db->get()->result_array();
    }
    public function get_employee($id){
        $this->db->select('employee.id_employee,employee.full_name');
        $this->db->from('so_assignment');
        $this->db->join('employee','employee.id_employee=so_assignment.so_assignment_number');
        $this->db->where('so_assignment.work_order_id',$id);
        return $this->db->get()->result_array();
    }
    //==
    public function save_timesheet($data)
    {
        $this->db->trans_start();
        if($data['is_edit'] != 'true')
        {
            $data_input = array();
            $data_input["date"]         =   $data["input-date"];
            $tg = $this->get_timesheet_group($data['input-date'], $data['project_name']);
            if(count($tg) > 0)
            {
               exit("Timesheet date already exist");                          
            }    
            $data_input['work_order_id']   =   $data['project_name'];
            $data_input['input_method']   =   'manual';
            $this->db->insert('timesheet_group', $data_input);
            $timesheet_id = $this->db->insert_id();
        }
        else
        {
            $data_input = array();
            $data_input["date"]         =   $data["input-date"];
            $data_input['work_order_id']   =   $data['project_name'];
            $timesheet_id = $this->input->post('id_timesheet_group');
            $this->db->where('id', $timesheet_id);
            $this->db->update('timesheet_group', $data_input);
        }
        if(isset($data['employee_detail']))
        {
            $this->save_employee_detail($timesheet_id, $data);
        }
        if($data['is_edit'] == 'true')
        {
            $this->delete_detail_timesheet($timesheet_id, 'timesheet');
        }
        
        
        $this->db->trans_complete();
    }
    
    public function delete_detail_timesheet($id, $table)
    {
        $this->db->where('timesheet_group_id', $id);
        $this->db->delete($table);
    }
    
    
    public function save_employee_detail($id, $data)
    {
        if($data['employee_detail'] != null)
        {
            $data['input-date'] = strtotime($data['input-date']);
            foreach($data['employee_detail'] as $d)
            {
                if($d['id_employee'] != '')
                {
                    $shift_code = $this->get_shift_code(date('Y', $data['input-date']), date('n', $data['input-date']), date('d', $data['input-date']), $data['project_name'], $d['id_employee']);
                    $ts = $this->get_time_schedule_shift($shift_code[0]['id']);
                    $time_in = null;
                    $time_out = null;
                    
                    if(count($ts) > 0)
                    {
                        $time_in = strtotime($ts[0]['from_time'] . ' + ' . $ts[0]['late_in_tolerance'] . ' minute');
                        $time_out = strtotime($ts[0]['to_time'] . ' - ' . $ts[0]['early_out_tolerance'] . ' minute');
                    }
                    
                    $data_input = array();
                    $data_input['timesheet_group_id'] = $id;
                    $data_input['employee_number'] = $d['id_employee'];
                    $data_input['in']= ($d['in'] == null || $d['in'] == '' ? null : $d['in']);
                    $data_input['out'] = ($d['out'] == null || $d['out'] == '' ? null : $d['out']);
                    
                    if($d['in'] != null && $d['in'] != '')
                    {
                        if($time_in != null)
                        {
                            $actual_time = strtotime($d['in']);
                            if($time_in < $actual_time)
                            {
                                $data_input['late_in'] = ($actual_time - $time_in)/60;
                            }
                            else
                            {
                                $data_input['late_in'] = null;
                            }
                        }
                    }
                    
                    if($d['out'] != null && $d['out'] != '')
                    {
                        if($time_out != null)
                        {
                            $actual_time = strtotime($d['out']);
                            if($time_out > $actual_time)
                            {
                                $data_input['early_out'] = ($time_out - $actual_time)/60;
                            }
                            else
                            {
                                $data_input['early_out'] = null;
                            }
                        }
                    }
                    
                    $this->db->insert('timesheet', $data_input);
                }
            }
        }
    }
    
    public function get_timesheet_by_id($id)
    {
        $query=$this->db->query('SELECT t.*,e.full_name,ee.full_name as nama_supervisor
                            FROM timesheet t
                            LEFT JOIN employee e ON e.employee_number=t.employee_number
                            LEFT JOIN employee ee ON ee.employee_number=t.supervisor_id'); 
        return $query->result_array();
    }
    public function get_timesheet_group_by_id($id)
    {
        $query=$this->db->query("SELECT t.*,w.project_name
                            FROM timesheet_group t
                            JOIN work_order w ON w.id_work_order=t.work_order_id
                            WHERE t.id=$id"); 
        return $query->result_array();
    }
    public function get_detail_employee_on_edit($id)
    {
   	    $query =$this->db->query("SELECT t.*,
        e.id_employee,
        e.full_name,ee.full_name as nama_supervisor, if((t.in is not NULL) and (t.out is not NULL), if((TIME_TO_SEC(TIMEDIFF(t.out, t.in)) / 3600) < 0 , 24 + (TIME_TO_SEC(TIMEDIFF(t.out, t.in)) / 3600) , (TIME_TO_SEC(TIMEDIFF(t.out, t.in)) / 3600)), NULL) as working_hour 
        FROM timesheet t
        JOIN employee e ON e.id_employee=t.employee_number
        LEFT JOIN employee ee ON ee.employee_number=t.supervisor_id
        WHERE t.timesheet_group_id=$id");
                
		return $query->result_array();
    }
    public function edit_timesheet($data)
    {
        //var_dump($data['employee_detail']);
        //die();
        $this->db->trans_start();
        //$this->delete_detail_timesheet($data['id_timesheet_group'], 'timesheet');
       if($data != null)
        {
            $data['input-date'] = strtotime($data['input-date']);
            foreach($data['employee_detail'] as $d)
            {
                if($d['id_employee'] != '')
                {
                    
                    $shift_code = $this->get_shift_code(date('Y', $data['input-date']), date('n', $data['input-date']), date('d', $data['input-date']), $data['project_name'], $d['id_employee']);
                    $ts = $this->get_time_schedule_shift($shift_code[0]['id']);
                    $time_in = null;
                    $time_out = null;
                    
                    if(count($ts) > 0)
                    {
                        $time_in = strtotime($ts[0]['from_time'] . ' + ' . $ts[0]['late_in_tolerance'] . ' minute');
                        $time_out = strtotime($ts[0]['to_time'] . ' - ' . $ts[0]['early_out_tolerance'] . ' minute');
                    }
                    
                    $data_input = array();
                    //$data_input['timesheet_group_id'] = $id;
                    //$data_input['employee_number'] = $d['id_employee'];
                   $data_input['in']= ($d['in'] == null || $d['in'] == '' ? null : $d['in']);
                   $data_input['out'] = ($d['out'] == null || $d['out'] == '' ? null : $d['out']);
                    
                    if($d['in'] != null && $d['in'] != '')
                    {
                        if($time_in != null)
                        {
                            $actual_time = strtotime($d['in']);
                            if($time_in < $actual_time)
                            {
                                $data_input['late_in'] = ($actual_time - $time_in)/60;
                            }
                            else
                            {
                                $data_input['late_in'] = null;
                            }
                        }
                    }
                    
                    if($d['out'] != null && $d['out'] != '')
                    {
                        if($time_out != null)
                        {
                            $actual_time = strtotime($d['out']);
                            if($time_out > $actual_time)
                            {
                                $data_input['early_out'] = ($time_out - $actual_time)/60;
                            }
                            else
                            {
                                $data_input['early_out'] = null;
                            }
                        }
                    }
                    
                    $this->db->where('id', $d['id']);
                    $this->db->update('timesheet', $data_input);
                    //die();
                }
            }
        }
        $this->db->trans_complete();
    }
    
    public function entry_timesheet($data, $source)
    {
        $ci =& get_instance();
        $ci->load->model('employee_model');   
        switch($source)
        {
            case "fingerprint_sch":
                foreach($data[0]['transaction'] as $tr)
                {
                    $data_input = array();
                    $id = $ci->employee_model->get_employee_id_by_number($tr['employee_number']);
                    $timesheet = $this->get_timesheet_entry($id[0]['id_employee'], $tr['date']);
                    if(count($id) > 0)
                    {
                        if(count($timesheet) == 0)
                        {
                            
                                $data_input['employee'] = $id[0]['id_employee'];
                                $data_input['date'] = $tr['date'];
                                if($tr['in_out_mode'] == 0)
                                {
                                    $data_input['in_time'] = $tr['time'];
                                }
                                else
                                {
                                    $data_input['out_time'] = $tr['time'];
                                }
                                
                                $data_input['source'] = 'fingerprint_sch';
                                $data_input['type'] = 'regular';
                                $data_input['status'] = 'unverified';
                                
                                $this->db->insert('timsheet', $data_input);
                            
                        }
                        else
                        {
                            if($tr['in_out_mode'] == 0)
                            {
                                if($timesheet[0]['in_time'] == null)
                                {
                                    $data_input['in_time'] = $tr['time'];
                                    $this->db->where('employee', $id[0]['id_employee']);
                                    $this->db->where('date', $tr['date']);
                                    $this->db->update('timsheet', $data_input);                                    
                                }
                            }
                            else
                            {
                                if($timesheet[0]['out_time'] == null)
                                {
                                    $data_input['out_time'] = $tr['time'];
                                    $this->db->where('employee', $id[0]['id_employee']);
                                    $this->db->where('date', $tr['date']);
                                    $this->db->update('timsheet', $data_input);
                                }
                            }
                            
                            if($timesheet[0]['out_time'] != null && $timesheet[0]['in_time'] != null)
                            {
                                //calculate working hour
                                $sql = 'update timsheet set total_working_hour = TIMEDIFF(out_time, in_time) where employee = ? and date = ?';
                                $this->db->query($sql, array($id[0]['id_employee'], $tr['date']));
                            }
                        }
                    }
                }
            break;
        }
    }
    
    public function entry_timesheet_raw($data, $source)
    {
        
        $ci =& get_instance();
        $ci->load->model('employee_model');  
        
        $id = $ci->employee_model->get_employee_id_by_number($data['employee_number']);
        
        $so_assign = $this->get_so_assignment_from_employee($id[0]['id_employee']);
        
        $fp_date = strtotime($data['date']);
        $fp_time = strtotime($data['time']);
        
        $wo_search = (count($so_assign) > 0 ? $so_assign[0]['work_order_id'] : -1);
        $shift_code = $this->get_shift_code(date('Y', $fp_date), date('n', $fp_date), date('d', $fp_date), $wo_search, $id[0]['id_employee']);
        
        $inout = 'undefined';
        
        if(count($shift_code) > 0)
        {
            if($shift_code[0]['schedule_type'] == 'on')
            {
                echo "Cek Check In";
                $begin_cin = strtotime($shift_code[0]['begin_cin']);
                $end_cin = strtotime($shift_code[0]['end_cin']);
                
                if(($begin_cin <= $fp_time) && ($fp_time <= $end_cin))
                {
                    //echo $begin_cin .  ">=" . $fp_time . " && " . $fp_time . "<=" . $end_cin;
                    $inout = 'in';
                }
                
                //Cek Checkout
                if($inout == 'undefined')
                {
                    $begin_cout = strtotime($shift_code[0]['begin_cout']);
                    $end_cout = strtotime($shift_code[0]['end_cout']);
                    echo $begin_cout .  ">=" . $fp_time . " && " . $fp_time . "<=" . $end_cout;
                    if(($begin_cout <= $fp_time) && ($fp_time <= $end_cout))
                    {
                        
                        $inout = 'out';
                    }
                }
                
                if($inout == 'undefined')
                {
                    $inout = 'out_of_rule';
                }
            }
            else
            {
                $inout = 'off';
            }
            
        }
        
        $this->db->trans_start();
        $data_input = array();
        $data_input['date'] = $data['date'];
        $data_input['time'] = $data['time'];
        $data_input['in_out_mode'] = $data['in_out_mode'];
        $data_input['source'] = $source;
        $data_input['employee'] = $id[0]['id_employee'];
        $data_input['app_id'] = $data['AppID'];
        $data_input['serial_number'] = $data['serial_number'];
        $data_input['work_order'] = (count($so_assign) > 0 ? $so_assign[0]['work_order_id'] : null);
        $data_input['shift_id'] = (count($shift_code) > 0 ? $shift_code[0]['id'] : null);
        $data_input['in_or_out'] = $inout;
        
        $this->db->insert('timesheet_raw', $data_input);
        $this->db->trans_complete();
        
        return $data_input;
    }
    
    public function entry_timesheet_data_fp($data)
    {
        $this->db->trans_start();
        echo "cek apakah timesheet group untuk work order dan tanggal ybs sudah ada";
        
        $tg = $this->get_timesheet_group($data['date'], $data['work_order']);
        
        $ts = $this->get_time_schedule_shift($data['shift_id']);
        $time_in = null;
        $time_out = null;
        
        if(count($ts) > 0)
        {
            $time_in = strtotime($ts[0]['from_time'] . ' + ' . $ts[0]['late_in_tolerance'] . ' minute');
            $time_out = strtotime($ts[0]['to_time'] . ' - ' . $ts[0]['early_out_tolerance'] . ' minute');
            
            echo "time in is " . $time_in;
            echo "time out is " . $time_out;
        }
        
        if(count($tg) > 0)
        {
            echo "update current timesheet child detail";
            $td = $this->get_timesheet_detail_from_employee($tg[0]['id'], $data['employee']);
            if(count($td > 0))
            {
                if($data['in_or_out'] == 'in' || $data['in_or_out'] == 'out')
                {
                    $this->db->where('timesheet_group_id', $tg[0]['id']);
                    $this->db->where('employee_number', $data['employee']);
                    
                    
                    $data_detail = array();
                    
                    if($data['in_or_out'] == 'in')
                    {
                        $data_detail['in']= $data['time'];
                        $data_detail['input_by'] = 'ff';
                        
                        echo 'check late tolerance';
                        if($time_in != null)
                        {
                            $actual_time = strtotime($data['time']);
                            if($time_in < $actual_time)
                            {
                                $data_detail['late_in'] = ($actual_time - $time_in)/60;
                            }
                            else
                            {
                                $data_detail['late_in'] = null;
                            }
                        }
                        
                        $this->db->update('timesheet', $data_detail);
                    }
                    else if($data['in_or_out'] == 'out')
                    {
                        $prev_out = ($td[0]['out'] == null || $td[0]['out'] == '' ? null : strtotime($td[0]['out']));

                        if(($prev_out == null) || ($prev_out != null && $prev_out > strtotime($data['time'])))
                        {
                            
                            $data_detail['out'] = $data['time'];
                            $data_detail['output_by'] = 'ff';
                            
                            echo 'check early tolerance ';
                            if($time_out != null)
                            {
                                $actual_time = strtotime($data['time']);
                                if($time_out > $actual_time)
                                {
                                    $data_detail['early_out'] = ($time_out - $actual_time)/60;
                                }
                                else
                                {
                                    $data_detail['early_out'] = null;
                                }
                            }
                            
                            $this->db->update('timesheet', $data_detail);
                        }
                        
                        echo " check overtime ";
                    }
                   
                }
            }
            else
            {
                $so_wo = $this->get_employee($data['work_order']);
            
                foreach($so_wo as $so)
                {
                    $data_input = array();
                    $data_input['timesheet_group_id'] = $timesheet_id;
                    $data_input['employee_number'] = $so['id_employee'];
                
                    
                    if($so['id_employee'] == $data['employee'])
                    {
                        if($data['in_or_out'] == 'in')
                        {
                            $data_input['in']= $data['time'];
                            $data_input['input_by'] = 'ff';
                            
                            echo 'check late tolerance';
                            if($time_in != null)
                            {
                                $actual_time = strtotime($data['time']);
                                if($time_in < $actual_time)
                                {
                                    $data_input['late_in'] = ($actual_time - $time_in)/60;
                                }
                                else
                                {
                                     $data_input['late_in'] = null;
                                }
                            }
                        }
                        else if($data['in_or_out'] == 'out')
                        {
                            $data_input['out'] = $data['time'];
                            $data_input['output_by'] = 'ff';
                            
                            echo 'check early tolerance';
                            if($time_out != null)
                            {
                                $actual_time = strtotime($data['time']);
                                if($time_out > $actual_time)
                                {
                                    $data_input['early_out'] = ($time_out - $actual_time)/60;
                                }
                                else
                                {
                                    $data_input['early_out'] = null;
                                }
                            }
                        }
                    }
                    
                    $this->db->insert('timesheet', $data_input);
                }
            }
        }
        else
        {
            echo "Create timesheet group and it's child";
            $data_tg = array();
            $data_tg["date"] =   $data["date"];
            $data_tg['work_order_id'] = $data['work_order'];
            $data_tg['input_method'] = 'machine';
            $this->db->insert('timesheet_group', $data_tg);
            $timesheet_id = $this->db->insert_id();
            
            echo "Insert Detail";
            $so_wo = $this->get_employee($data['work_order']);
            
            foreach($so_wo as $so)
            {
                $data_input = array();
                $data_input['timesheet_group_id'] = $timesheet_id;
                $data_input['employee_number'] = $so['id_employee'];
                
                if($so['id_employee'] == $data['employee'])
                {
                    if($data['in_or_out'] == 'in')
                    {
                        $data_input['in']= $data['time'];
                        $data_input['input_by'] = 'ff';
                        
                        echo 'check late tolerance';
                        if($time_in != null)
                        {
                            $actual_time = strtotime($data['time']);
                            if($time_in < $actual_time)
                            {
                                $data_input['late_in'] = date('H:i:s', $actual_time - $time_in);
                            }
                        }
                    }
                    else if($data['in_or_out'] == 'out')
                    {
                        $data_input['out'] = $data['time'];
                        $data_input['output_by'] = 'ff';
                        
                        echo 'check early tolerance';
                        if($time_out != null)
                        {
                            $actual_time = strtotime($data['time']);
                            if($time_out > $actual_time)
                            {
                                $data_input['early_out'] = date('H:i:s', $time_out - $actual_time);
                            }
                        }
                    }
                }
                
                $this->db->insert('timesheet', $data_input);
            }
        }
        
        $this->db->trans_complete();
    }
    
    public function get_timesheet_detail_from_employee($tg, $employee)
    {
        $this->db->select('*');
        $this->db->from('timesheet');
        $this->db->where('timesheet_group_id', $tg);
        $this->db->where('employee_number', $employee);
        
        return $this->db->get()->result_array();
    }
    
    public function get_timesheet_group($date, $wo)
    {
        $query = "select * from timesheet_group where date = '" . $date . "' and work_order_id = " . $wo;
        $result = $this->db->query($query);
        return $result->result_array();
    }   
     
    public function get_timesheet_entry($employee, $date)
    {
        $this->db->select('*');
        $this->db->from('timsheet');
        $this->db->where('employee', $employee);
        $this->db->where('date', $date);
        
        return $this->db->get()->result_array();
    }
    
    public function get_so_assignment_from_employee($id)
    {
        $query = "select sa.* from so_assignment as sa where so_assignment_number = " . $id;
        $result = $this->db->query($query);
        return $result->result_array();
    }
    
    public function get_shift_code($tahun, $bulan, $hari ,$wo, $emp)
    {
        $query = "select wts.* from shift_rotation as wts where tahun = " . $tahun . " and bulan = " . $bulan . " and work_order_id = " . $wo . " and employee_id = " . $emp;
        $result = $this->db->query($query);
        $shift_data = $result->result_array();
        //echo "query ==> " . $query;
        //echo "shift data ===> " . json_encode($shift_data);
        $shift_id = '-1';
        $shift_result = null;
        if(count($shift_data) > 0)
        {
            foreach($shift_data[0] as $key => $value)
            {
                if (strpos($key, 'd') !== false)
                {
                    str_replace('d', '', $key);
                }
                
                if($key == $hari)
                {
                    $shift_id = $value;
                    break;
                }
            }
            
            $query = "select wts.* from wo_time_schedule as wts where wts.id = " . $shift_id . " and wts.work_order_id = " . $wo;
            $shift_result = $this->db->query($query)->result_array();
        }
        return $shift_result;
    }
    
    public function get_time_schedule_shift($id)
    {
        $query = "select wts.* from wo_time_schedule as wts where wts.id = " . $id;
        $shift_result = $this->db->query($query)->result_array();
        
        return $shift_result;
    }
    
    public function view_monitoring_timesheet()
    {
        $query = "select t.*, tg.date, tg.work_order_id,e.employee_number, e.id_employee, e.full_name, os.structure_name, wo.work_order_number, wo.project_name,
        if((t.in is not NULL) and (t.out is not NULL), if((TIME_TO_SEC(TIMEDIFF(t.out, t.in)) / 3600) < 0 , 24 + (TIME_TO_SEC(TIMEDIFF(t.out, t.in)) / 3600) , (TIME_TO_SEC(TIMEDIFF(t.out, t.in)) / 3600)), NULL) as working_hour 
        from timesheet as t 
        inner join employee as e on e.id_employee = t.employee_number 
        inner join timesheet_group as tg on t.timesheet_group_id=tg.id 
        inner join work_order as wo on wo.id_work_order=tg.work_order_id 
        inner join organisation_structure as os on os.id_organisation_structure=e.organisation_structure_id";
        
        $ts = $this->db->query($query)->result_array();
        
        for($i=0;$i<count($ts);$i++)
        {
            $date = strtotime($ts[$i]['date']);
            $shift_code = $this->get_shift_code(date('Y', $date), date('n', $date), date('d', $date), $ts[$i]['work_order_id'], $ts[$i]['id_employee']);
            if(count($shift_code) > 0)
            {
                $ts[$i]['shift_id'] = $shift_code[0]['id'];
                $ts[$i]['shift_code'] = $shift_code[0]['kode_schedule'];
                $ts[$i]['nama_shift'] = $shift_code[0]['nama_schedule'];
                $ts[$i]['shift_start'] = $shift_code[0]['from_time'];
                $ts[$i]['shift_end'] = $shift_code[0]['to_time'];
            }
            else
            {
                $ts[$i]['shift_id'] = '';
                $ts[$i]['shift_code'] = '';
                $ts[$i]['nama_shift'] = '';
                $ts[$i]['shift_start'] = '';
                $ts[$i]['shift_end'] = '';
            }
        }
        
        return $ts;
        
    }
    
}
	