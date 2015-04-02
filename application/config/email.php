<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
| -------------------------------------------------------------------
| EMAIL CONFIG
| -------------------------------------------------------------------
| Konfigurasi email keluar melalui mail server
| */

        $config['protocol']='smtp';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $config['smtp_host']='ssl://smtp.googlemail.com'; 
        $config['smtp_port']='465'; 
        $config['smtp_timeout']='30'; 
        $config['smtp_user']='alfath.helmy@gmail.com'; 
        $config['smtp_pass']='umilatifahdinar'; 
        $config['charset']='utf-8'; 
        $config['newline']="\r\n";
        
/* End of file email.php */ 
/* Location: ./system/application/config/email.php */