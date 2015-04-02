<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php echo $this->config->item('application_name'); ?> | Welcome</title>
<!-- add your meta tags here -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/jquery-ui-1.10.3.custom.css');?>" />
<link href="<?php echo base_url('/css/welcome_layout.css');?>" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
<link href="<?php echo base_url('/css/patch_welcome.css');?>" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<style>
body.login 
{
	background: #fbfbfb;
	min-width: 0;
}
#login 
{
	width: 320px;
	padding: 50px 0 0;
	margin: auto;
}
.login form
{
	margin-left: 8px;
	padding: 10px 24px 30px;
	font-weight: normal;
	background: #fff;
	border: 1px solid #e5e5e5;
	-moz-box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;
	-webkit-box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;
	box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;
}
#login form p 
{
	margin-bottom: 0;
}
.login label 
{
	color: #777;
	font-size: 14px;
}
.login form .input, .login input[type="text"] {
	color: #555;
	font-weight: 200;
	font-size: 24px;
	line-height: 1;
	width: 100%;
	padding: 3px;
	margin-top: 2px;
	margin-right: 6px;
	margin-bottom: 5px;
	border: 1px solid #e5e5e5;
	background: #fbfbfb;
	outline: 0;
	-moz-box-shadow: inset 1px 1px 2px rgba(200,200,200,0.2);
	-webkit-box-shadow: inset 1px 1px 2px rgba(200,200,200,0.2);
	box-shadow: inset 1px 1px 2px rgba(200,200,200,0.2);
}
.login select
{
	color: gray;
	font-weight: 100;
	font-size: 18px;
	width: 100%;
}
body #login h1 a 
{
	background-image: url(http://www.nobi.co.id/sites/all/themes/nobi/logo.png);
	height: 50px;
	width: auto;
	background-size: auto;
}
.login h1 a 
{
	background-image: url('../images/wordpress-logo.png?ver=20120216');
	background-size: 274px 63px;
	background-position: top center;
	background-repeat: no-repeat;
	width: 326px;
	height: 67px;
	text-indent: -9999px;
	overflow: hidden;
	padding-bottom: 15px;
	display: block;
}
#login-jms
{
	width: 100%;
	height: 35px;
}
</style>
<body class="login">
<div id="login">
	<h1 style="margin-left:20px;"><img src="<?php echo base_url() . $this->config->item('company_logo')?>" width="250"></img></h1>
	<p style="text-align: center;color:navy; opacity: 0.8;font-size: 14px;"><b><?php echo $this->config->item('application_name'); ?></b></p>
	<form name="loginform" id="loginform" action="<?php echo base_url('login/log_me_in');?>" method="post">
		<p><?php echo $login_msg;?></p>

		<p>
			<label for="user_login">Username<br />
			<input type="text" name="username" id="user_login" class="input" value="" size="20" tabindex="10" /></label>
		</p>
		<p>
			<label for="user_pass">Password<br />
			<input type="password" name="password" id="user_pass" class="input" value="" size="20" tabindex="20" /></label>
		</p>
		<p class="submit">
			<input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover" name="submit" id="login-jms" class="button-primary" value="Log In" tabindex="100" />
		</p>
	</form>
</div>

</body>
</html>
