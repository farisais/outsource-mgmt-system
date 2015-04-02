<script src="http://103.247.10.194:3000/socket.io/socket.io.js"></script>
<script>
try
{
  var socket = io.connect('http://103.247.10.194:3000');
  socket.on('welcome', function(data){
        alert(data.message);
  });
  
  socket.on('fdCommandRespons', function(data){
    ConsoleWriteLine(JSON.stringify(data));
  });
  
  socket.on('fdCommandInProcMaster', function(data){
    ConsoleWriteLine(data.message);
  });
  
  socket.on('time', function(data){
        ConsoleWriteLine(data.time);
  });
  
  /*socket.on('listenRte', function(data){
    if(data.AppID != null)
    {
        ConsoleWriteLine('APPID[' + data.AppID + '] send an RTEvent')
    }
    
    ConsoleWriteLine(data.eventName);
	for(i=0;i<data.eventArgs.length;i++)
	{
		for(var key in data.eventArgs[i])
		{
			ConsoleWriteLine(key + " => " + data.eventArgs[i][key]);
		}
	}
    
  });*/
  
  socket.on('listenRte', function(data){
        ConsoleWriteLine('Receive RTE from APPID[' + data.AppID + ']');
        ConsoleWriteLine(data.eventName);
		for(i=0;i<data.eventArgs.length;i++)
		{
			for(var key in data.eventArgs[i])
			{
				ConsoleWriteLine(key + " => " + data.eventArgs[i][key]);
			}
		}
  });
  
  socket.on('sendBroadcast', function(data){
        ConsoleWriteLine(data.message);
  });
}
catch(err)
{
    alert(err.message);
    ConsoleWriteLine(err.message)
}

  $(document).ready(function(){
    $("#command-enter").click(function(){
        emitCommand();
    });
  });
  
  function emitCommand()
  {
    var data_post = {};
    data_post['command'] = $("#command-text").val();
    var ajaxUrl = '<?php echo base_url() ?>fingerprint/register_command';
    $.ajax({
		url: ajaxUrl,
		type: "POST",
		data: data_post,
		success: function(output)
        {	
            try
            {
                obj = JSON.parse(output);
            }
            catch(err)
            {
                alert('Fatal error is happening with message : ' + output + '=====> Please contact your system administrator.' + err);
            }
            
            var commandJson = {appID: 'APP15030001', devID: $("#serial-number").val(), commandID: obj.commandID,command: $("#command-text").val(), parameter: $("#parameter").val() };
            ConsoleWriteLine("Emitting Command : " + JSON.stringify(commandJson));
            socket.emit('fdCommand', commandJson);
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
  function ConsoleWriteLine(message)
  {
    $('#console').val($('#console').val() + message + '\n');
  }
</script>
<script>
$(document).ready(function(){
    
    $("#activate").click(function(){
        var data_post = {};
        <?php 
        if(isset($is_edit))
        {?>
        
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_fingerprint_device'] ?>;
        param.push(item);
        load_content_ajax(GetCurrentController(), 273 ,data_post, param);
        <?php 
        }
        else
        {?>
        data_post['merk'] = $("#merk").val();
        data_post['series'] = $("#series").val();
        data_post['serial_number'] = $("#serial-number").val();
        data_post['ip_local_setting'] = $("#ip-local-setting").val();
        data_post['comm_password'] = $("#comm-password").val();
        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_fingerprint_device'] = $("#id_fingerprint_device").val(); 
        
        data_post['action_condition_identifier'] = 'activate';
        load_content_ajax(GetCurrentController(), 272, data_post);
        <?php    
        }
        ?>
        
    });
    
    $("#deactivate").click(function(){
        var data_post = {};
        <?php 
        if(isset($is_edit))
        {?>
        
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_fingerprint_device'] ?>;
        param.push(item);
        load_content_ajax(GetCurrentController(), 274 ,data_post, param);
        <?php 
        }
        ?>
        
        
        
    });
});

function SaveData()
{
    var data_post = {};
    
    data_post['merk'] = $("#merk").val();
    data_post['series'] = $("#series").val();
    data_post['serial_number'] = $("#serial-number").val();
    data_post['ip_local_setting'] = $("#ip-local-setting").val();
    data_post['comm_password'] = $("#comm-password").val();
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_fingerprint_device'] = $("#id_fingerprint_device").val(); 
    
    load_content_ajax(GetCurrentController(), 272, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 268 , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_fingerprint_device" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_fingerprint_device'] : '') ?>" />
<div class="document-action">
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] == 'inactive' || !isset($is_edit))
    {?>
    <button style="margin-left: 20px;" id="activate">Activate</button>
    <?php    
    }
    ?>
    
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] == 'active')
    {?>
    <button style="margin-left: 20px;" id="deactivate">Deactivate</button>
    <?php    
    }
    ?>

    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'inactive' ? 'class="status-active"' : '') ?> >
            <span class="label">Inactive</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'active' ? 'class="status-active"' : '') ?>>
            <span class="label">Active</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;padding-bottom: 50px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;">Fingerprint / <span><?php echo (isset($is_edit) ? $data_edit[0]['serial_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td class="label">
                        Merk
                    </td>
                    <td colspan="2">
                        <input class="field" type="text" id="merk" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['merk'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Series
                    </td>
                    <td colspan="2">
                        <input class="field" type="text" id="series" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['series'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Serial No.
                    </td>
                    <td colspan="2">
                        <input class="field" type="text" id="serial-number" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['serial_number'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        IP Local
                    </td>
                    <td colspan="2">
                        <input class="field" type="text" id="ip-local-setting" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['ip_local_setting'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Comm. Password
                    </td>
                    <td colspan="2">
                        <input class="field" type="text" id="comm-password" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['comm_password'] : '') ?>"/>
                    </td>
                </tr>
            </table>
            <table class="table-form">
                <tr>
                    <td colspan="3">                       
                         <div class="row-color" style="width: 88%;height: 17px;padding-top: 3px;">
                            <div style="display: inline; margin-top:2px;"><span>Console Command</span></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Enter Command
                    </td>
                    <td>
                        <input class="field" type="text" id="command-text" name="name" value="" placeholder="Enter Command"/>
                    </td>
                    <td>
                        <button style="width: 70px;" id="command-enter">Enter</button>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Command Paramter
                    </td>
                    <td colspan="2">
                        <input class="field" type="text" id="parameter" name="name" value="" placeholder="Enter Parameter"/>
                    </td>
                </tr>
                <tr>
                    <td class="label" colspan="3">
                        <textarea id="console" rows="20" cols="10" style="width: 90%;"></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>