<!DOCTYPE html>
<html>
<head>
<title><?php echo $title?></title>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/default_layout.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/navigation_styles.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/jquery-ui-1.10.3.custom.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('/fancybox/jquery.fancybox.css');?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url('/fancybox/jquery.fancybox-thumbs.css');?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url()?>jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>jqwidgets/styles/jqx.bootstrap.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>css/form.css" type="text/css" />

<script type='text/javascript' src="<?php echo base_url('/js/jquery-1.9.1.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>jqwidgets/jqxcore.js"></script>
<script type='text/javascript' src="<?php echo base_url('/js/jquery-ui.js');?>"></script>
<script type='text/javascript' src='<?php echo base_url("/js/jquery.blockUI.js");?>'></script>
<script type='text/javascript' src='<?php echo base_url("/js/jquery.knob.js");?>'></script>
<script type='text/javascript' src='<?php echo base_url("/js/jquery.form.js");?>'></script>
<script type="text/javascript" src='<?php echo base_url("/fancybox/jquery.fancybox.js"); ?>'></script>
<script type="text/javascript" src='<?php echo base_url("/fancybox/jquery.fancybox-thumb.js"); ?>'></script>
<script type="text/javascript" src="<?php echo base_url()?>jqwidgets/jqx-all.js"></script>
<script>
$(document).ready(function(){
        $(document).ready(jqUpdateSize);    // When the page first loads
        $(window).resize(jqUpdateSize);
        
        selectNavMenu();
        $(".sub-menu").click(function(e){
            e.preventDefault();
            confirmation_interruption();
            var data_post = {};
            var val = $(this).find("input").val();
            $("#action").val(val);
            var newMenu = $(this).attr('id').split('-')[1];
            selectSideMenu($("#menu-selected").val(), newMenu);
            $("#menu-selected").val(newMenu);
            var controller = $("#controller").val();            
       	    load_content_ajax(controller, val, data_post);
        });
        $("#error-notification-default").jqxWindow({
            width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
        });
        
        $("#export-grid").click(function(e){
            e.preventDefault();
            if($("#jqxgrid").length == 0)
            {
                
            }
            else
            {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'jqxGrid');
            }
            
        });
        
        $("#print-grid").click(function(e){
           e.preventDefault();
           if($("#jqxgrid").length == 0)
            {
                printDocument();
            }
            else
            {
                var gridContent = $("#jqxgrid").jqxGrid('exportdata', 'html');
                var newWindow = window.open('', '', 'width=800, height=500'),
                document = newWindow.document.open(),
                pageContent =
                    '<!DOCTYPE html>\n' +
                    '<html>\n' +
                    '<head>\n' +
                    '<meta charset="utf-8" />\n' +
                    '<title>Data Export</title>\n' +
                    '</head>\n' +
                    '<body>\n' + gridContent + '\n</body>\n</html>';
                document.write(pageContent);
                document.close();
                newWindow.print(); 
            }
        });
    });
</script>
<script>
function printArea(area)
{
        alert('haha');
        var headElements = '<meta charset="utf-8" />,<meta http-equiv="X-UA-Compatible" content="IE=edge"/>';

        var options = { mode : "popup", popClose : true, retainAttr : ['id', 'style', 'class'], extraHead : headElements };

        $( area ).printArea( options );
  
}
function getUrlParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}    
        
function searchParamExist(sParam)
{
    var result = false;
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return true;
        }
    }
}     

function loadAjaxGif()
{
    $(".table-right-bar").block({
                message: '<img style="margin-top: 10px" src="<?php echo base_url() . 'images/ajax-loader.gif' ?>"></img><p>Loading Page</p>',
                css : {border: 'none', width: 'auto','-webkit-border-radius': '5px',
                        '-moz-border-radius': '5px'}
    })     
}

function unloadAjaxGif()
{
    $(".table-right-bar").unblock();
}

function load_content_ajax(controller, action, data_post, param)
{
    $("#wrapper").nextAll('div').not("#error-notification-default").not(".jqx-menu-popup").remove();
    if(param != null)
    {
        data_post['param'] = param;
    }
    
    loadAjaxGif();
    var ajaxUrl = "<?php echo base_url();?>" + controller + "/get_action_ajax?action=" + action + '&method=ajax'; 
              
    $.ajax({
		url: ajaxUrl,
		type: "POST",
		data: data_post,
		success: function(output)
        {		  
            $(".table-right-bar").unblock();
            
            try
            {
                obj = JSON.parse(output);
            }
            catch(err)
            {
                alert('Fatal error is happening with message : ' + output + '=====> Please contact your system administrator.');
            }
            
            
            $("#content").html(obj.content);
            $("#button-wrapper").html(obj.button);
            $("#content-title").html(obj.content_title);
            
			if(obj.result == "success")                                                                                                                
			{
                var paramText = '';
                if(obj.param != null)
                {
                    var i = 0;
                    for(i=0;i<obj.param.length;i++)
                    {
                         paramText += '&';
                         paramText += obj.param[i].paramName + '=' + obj.param[i].paramValue;
                    }                    
                }
                window.history.pushState("test", "Title", "<?php echo base_url() ?>" + $("#controller").val() + "?menu="+ $("#menu-selected").val() +"&action=" + obj.id_application_action + paramText);
			}
			else
			{
                if(obj.result == null)
                {
                    alert(output);
                }
                else if(obj.result == 'failed')
                {
                    alert('Failed to load data');
                }
                else if(obj.result == 'permission_denied')
                {
                    alert(obj.ajax_message);
                }
			}
            jqUpdateSize();
		},
        error: function( jqXhr ) 
        {
            $(".table-right-bar").unblock();
            if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                var json = $.parseJSON( jqXhr.responseText );
                alert(json);
            }
            $("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
            $("#error-notification-default").jqxWindow("open");
        }
   	});
}

function jqUpdateSize(){
    // Get the dimensions of the viewport
    var width = $(window).width();
    var height = $(window).height();

    if (($("#content").find('.form-center').length > 0)) 
    {
        $("#contentliquid").css('height', 'auto');
        $("#content").css('height', 'auto');
        $("#content").css('overflow', '');
        //alert('haha');
    }
    else
    {
        $("#contentliquid").css('height', height - 40 - 40 - 30);
        $("#content").css('height', height - 40 - 40 - 30 - 111);
        $("#content").css('overflow', 'overlay');
    }
    
}   

function selectNavMenu()
{
    $(".nav-menu li").each(function(){
    
        if($(this).find('span').html().toLowerCase() == '<?php echo $top_menu ?>')
        {
            $(this).addClass('selected-nav');
        }
    });
    
    $("#smenu-<?php echo $menu_selected ?>").addClass("selected");
}

function selectSideMenu(oldMenu, newMenu)
{
    $("#smenu-" + oldMenu).removeClass("selected");
    $("#smenu-" + newMenu).addClass("selected");
}      

function GetCurrentAction()
{
    return $("#action").val();
}

function GetCurrentController()
{
    return $("#controller").val();
}

function confirmation_interruption()
{
    if($("#prevent-interruption").val() == 'true')
    {
        if(confirm('Are you sure you want to move from this form?') == false)
        {
            throw '';
        }
    }
}
</script>
<script>
var dateFormat = function () {
	var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
		timezoneClip = /[^-+\dA-Z]/g,
		pad = function (val, len) {
			val = String(val);
			len = len || 2;
			while (val.length < len) val = "0" + val;
			return val;
		};

	// Regexes and supporting functions are cached through closure
	return function (date, mask, utc) {
		var dF = dateFormat;

		// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
		if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
			mask = date;
			date = undefined;
		}

		// Passing date through Date applies Date.parse, if necessary
		date = date ? new Date(date) : new Date;
		if (isNaN(date)) throw SyntaxError("invalid date");

		mask = String(dF.masks[mask] || mask || dF.masks["default"]);

		// Allow setting the utc argument via the mask
		if (mask.slice(0, 4) == "UTC:") {
			mask = mask.slice(4);
			utc = true;
		}

		var	_ = utc ? "getUTC" : "get",
			d = date[_ + "Date"](),
			D = date[_ + "Day"](),
			m = date[_ + "Month"](),
			y = date[_ + "FullYear"](),
			H = date[_ + "Hours"](),
			M = date[_ + "Minutes"](),
			s = date[_ + "Seconds"](),
			L = date[_ + "Milliseconds"](),
			o = utc ? 0 : date.getTimezoneOffset(),
			flags = {
				d:    d,
				dd:   pad(d),
				ddd:  dF.i18n.dayNames[D],
				dddd: dF.i18n.dayNames[D + 7],
				m:    m + 1,
				mm:   pad(m + 1),
				mmm:  dF.i18n.monthNames[m],
				mmmm: dF.i18n.monthNames[m + 12],
				yy:   String(y).slice(2),
				yyyy: y,
				h:    H % 12 || 12,
				hh:   pad(H % 12 || 12),
				H:    H,
				HH:   pad(H),
				M:    M,
				MM:   pad(M),
				s:    s,
				ss:   pad(s),
				l:    pad(L, 3),
				L:    pad(L > 99 ? Math.round(L / 10) : L),
				t:    H < 12 ? "a"  : "p",
				tt:   H < 12 ? "am" : "pm",
				T:    H < 12 ? "A"  : "P",
				TT:   H < 12 ? "AM" : "PM",
				Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
				o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
				S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
			};

		return mask.replace(token, function ($0) {
			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
		});
	};
}();

// Some common format strings
dateFormat.masks = {
	"default":      "ddd mmm dd yyyy HH:MM:ss",
	shortDate:      "m/d/yy",
	mediumDate:     "mmm d, yyyy",
	longDate:       "mmmm d, yyyy",
	fullDate:       "dddd, mmmm d, yyyy",
	shortTime:      "h:MM TT",
	mediumTime:     "h:MM:ss TT",
	longTime:       "h:MM:ss TT Z",
	isoDate:        "yyyy-mm-dd",
	isoTime:        "HH:MM:ss",
	isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
	dayNames: [
		"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
		"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
	],
	monthNames: [
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
	return dateFormat(this, mask, utc);
};
</script>
<style>
  body { font-size: 62.5%; }
  label, input { display:block; }
  input.text { margin-bottom:12px; width:95%; padding: .4em; }
  fieldset { padding:0; border:0; margin-top:25px; }
  h1 { font-size: 1.2em; margin: .6em 0; }
  div#users-contain { width: 350px; margin: 20px 0; }
  div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
  div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
  .ui-dialog .ui-state-error { padding: .3em; }
  .validateTips { border: 1px solid transparent; padding: 0.3em; }
  div.demo{text-align: center; width: 280px; float: left}
  div.demo > p{font-size: 20px}
  #link-ct{float:left;}
  #link-p{float:left; }
  #link-el{float:left;}
  #link img:hover
  {
  	opacity: 0.5;
  }

     
</style>

</head>
<body>
    <input type="hidden" id="top-menu" value="<?php echo $top_menu ?>" />
    <input type="hidden" id="menu-selected" value="<?php echo $menu_selected ?>" />
    <input type="hidden" id="controller" value="<?php echo $controller ?>" />
    <input type="hidden" id="theme" value="bootstrap" />
    <input type="hidden" id="action" value="<?php echo (!isset($action) || $action == null ? null : $action[0]['id_application_action'])?>" />
    <div id="error-notification-default" style="margin-top: 40px;">
        <div>Application Error</div>
        <div id="error-content">
       
        </div>
    </div>
	<div id="wrapper">
        <div id="navigation">
        	<div id='cssmenu'>
            	<?php echo $navmenu;?>
            	<ul style="padding-top:8px;text-align:right;padding-right:50px;color: white;text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.36);font-size: 12px;">
            		<?php 
            		if($this->session->userdata('app_username'))
            		{
            			echo 'Welcome, ' . $this->session->userdata('app_fullname');
            		}
            		else
            		{
            			echo 'Your are not login. Login ';
            			?>
            			<a id="login-link" href="#" style="color: white;">Here</a>
            			<?php 
            		}
            		?>
            	</ul>
            </div>
        </div>
        <div id="contentliquid" class="fade">
            <table id="center-layout">
                <tbody>
                    <tr>
                        <td class="table-left-bar">
                            <div id="left-navigation">
                                <div id="logo">
                                    <span><a href='/'><img src=<?php echo base_url() . $this->config->item('company_logo');?> style="margin-top:10px;margin-left:20px;width: 150px;" /></a></span>	
                                </div>
                                <div id="content-side-menu">
                                <?php
                                    if(isset($side_nav))
                                    {
                                        echo $side_nav;
                                    }
                                ?>
                                </div>
                            </div>
                        </td>
                        <td class="table-right-bar">
                            <div id="content-wrapper" >
                                <div id="content-header">
                                    <h1 id="content-title"><?php echo (!isset($action) || $action == null ? null : $action[0]['name'])?></h1>
                                    <div id="button-wrapper">
                                        <?php 
                                        if(isset($action))
                                        {
                                            $this->load->view('templates/button/' . $action[0]['action_button'], null);
                                        }
                                        ?>
                                    </div>
                                    <div id="content-head-wrapper">
                                         <?php 
                                            $this->load->view('navigation/form_menu', null);                                        
                                         ?>   
                                    </div>
                                </div>
                                <div id="content">
                                    <?php 
                                        if(isset($content))
                                        {
                                            echo $content;
                                        } 
                                    ?>    
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
		<div style="clear:both;margin-left:auto;margin-right:auto;width:70%;text-align:center;padding:10px 0 10px 0;">
    		<a href="<?php echo site_url('about/index');?>">About</a>
    		<?php 
    		if($this->session->userdata('app_username'))
    		{    		
    		?>
    		<a>|</a> 
    		<a href="<?php echo site_url('login/log_me_out')?>">
    			logout
    		</a>
    		<?php } ?>
    	</div>
        <div id="footer" style="text-align: center;">
            <div style="padding-top: 15px;"><a><?php echo $this->config->item('company_name'); ?></a> &copy 2013</div>
        </div>
  </div>
	
 <?php
 
 if(!$this->session->userdata('app_username'))
 {?>
 <script>
 $(document).ready(function() {
   var name = $( "#username" ),
     password = $( "#password" ),
     allFields = $( [] ).add( name ).add( password );
	
   $( "#dialog-form" ).dialog({
     autoOpen: false,
     height: 250,
     width: 350,
     modal: true,
     buttons: {
       "Login": function() {
       	var data_post = {};
   		data_post['username'] = $("#username").val();
   		data_post['password'] = $("#password").val();
       	$.ajax({
				url: "<?php echo site_url('login/log_me_in');?>",
				type: "POST",
				data: data_post,
				success: function(output){
					if(output == "failed")
						{
							$("#login-result").html(output);
						}
						else
						{
							window.location.href="<?php echo site_url();?>" + "dashboard/" + output;
						}
					}
           	});
       },
       Cancel: function() {
         $( this ).dialog( "close" );
       }
     },
     close: function() {
       allFields.val( "" ).removeClass( "ui-state-error" );
     }
   });

   $( "#login-link" ).click(function() {
       $( "#dialog-form" ).dialog( "open" );
     });
 });
 </script>  
 <div id="dialog-form" title="User Login" style="z-index: 500;">
 <p class="validateTips">All form fields are required.</p>
 <div id="login-result" style="color: red;"></div>
 <fieldset>
   <label for="name">Username</label>
   <input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
   <label for="password">Password</label>
   <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
 </fieldset>
</div>
<?php 
 }
?>
</body>
</html>