<script src="http://103.247.10.194:3000/socket.io/socket.io.js"></script>
<script>
$.wait = function(ms) {
    var defer = $.Deferred();
    setTimeout(function() { defer.resolve(); }, ms);
    return defer;
};
var socket = null;
function init_connect_socket()
{
    try
    {
         socket = io.connect('http://103.247.10.194:3000');
         socket.on('welcome', function(data){
            ClearConsole();
            
            ConsoleWriteLine("===== " + data.message + ' on http://103.247.10.194:3000' + " =====");
            ConsoleWriteLine("");
            ConsoleWriteLine("Waiting for command execution...");
            ConsoleWriteLine("");
            
            InitFunction();
        });
      
      socket.on('fdCommandRespons', function(data){
        ConsoleWriteLine('Receive respond from command('+ data.commandID +') : ' + data.respons.message);
        if(data.command == 'enroll_complete' && data.respons.status == 'success')
        {
            $.ajax({
        		url: 'fingerprint/save_fingerprint_enroll',
        		type: "POST",
        		data: data,
        		success: function(output)
                {	
                    //alert(output);
                    try
                    {
                        obj = JSON.parse(output);
                    }
                    catch(err)
                    {
                        alert('Fatal error is happening with message : ' + output + '=====> Please contact your system administrator.' + err);
                    }
                    
                    //alert(JSON.stringify(obj));
                    if(obj.status == 'success')
                    {
                        ConsoleWriteLine('Fingerprint data EmployeeID('+ data.respons.employee_number +') successfully saved to database');
                        //$("#fingerprint-grid").jqxGrid('clear');
                        //$("#fingerprint-grid").jqxGrid('addrow', null, obj.data);
                        RefreshEmployeeAssignGrid();
                    }
                    else
                    {
                        ConsoleWriteLine('Failed to save fingerprint data EmployeeID('+ data.respons.employee_number +') to database');
                    }
        		},
                error: function( jqXhr ) 
                {
                    $(".table-right-bar").unblock();
                    if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON( jqXhr.responseText );
                        //alert(json);
                    }
                    //$("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
                    //$("#error-notification-default").jqxWindow("open");
                    
                    ConsoleWriteLine('Failed to save fingerprint data EmployeeID('+ data.respons.employee_number +') to database');
                }
       	    });
        }
        else if(data.command == 'register_user_bulk')
        {
            //ConsoleWriteLine(JSON.stringify(data));
            $.ajax({
        		url: 'so_assignment/change_fp_assign_status_bulk',
        		type: "POST",
        		data: data.respons,
        		success: function(output)
                {	
                    if(output == 'success')
                    {
                        ConsoleWriteLine('Successfully change status assign on database');
                        RefreshEmployeeAssignGrid();
                    }
                    else
                    {
                        ConsoleWriteLine('Failed to save fingerprint assign status on database');
                    }
        		},
                error: function( jqXhr ) 
                {
                    if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON( jqXhr.responseText );
                        //alert(json);
                    }
                    //$("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
                    //$("#error-notification-default").jqxWindow("open");
                    
                    ConsoleWriteLine('Failed to change fingerprint status on database');
                }
       	    });
        }
        
      });
      
      socket.on('fdCommandInProcMaster', function(data){
        ConsoleWriteLine(data.message);
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
        //alert(err.message);
        ClearConsole();
        ConsoleWriteLine("Connection error : " + err.message);
        ConsoleWriteLine("");
    }
}

function emitCommand(appid, devid, command, param)
{
    var data_post = {};
    data_post['command'] = command;
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
            
            var commandJson = {appID: appid, devID: devid, commandID: obj.commandID,command: command, parameter: param };
            //ConsoleWriteLine("Emitting Command : " + JSON.stringify(commandJson));
            
            try
            {
                ConsoleWriteLine('Sending command('+ obj.commandID +'): '+ command +' to Fingersync Daemon ' + appid);
                socket.emit('fdCommand', commandJson);
            }
            catch(err)
            {
                ConsoleWriteLine("Error on application : " + err.message);
                ConsoleWriteLine("");
            }
            
            
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
    $('#console').scrollTop($('#console')[0].scrollHeight);
}

function ClearConsole()
{
    $("#console").val("");
}

function ClosingSocket()
{
    socket.disconnect();
}
</script>
<script>
$(document).ready(function(){
    ConsoleWriteLine("Preparing connection...");
    ConsoleWriteLine("Please wait...")
    $.wait(2000).then(init_connect_socket);
    $("#command-popup").jqxWindow({
        width: 600, height: 310, resizable: true, draggable: true ,isModal: false, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01,            
    });
    
    $("#command-popup").on('close', function(){
        ClosingSocket();
        $("#console").val("");
    });
});
</script>
<style>
textarea#console 
{
    background-color: darkblue;
    color: white;
}
</style>
<input type="hidden" id="app-id" value="" />
<input type="hidden" id="dev-id" value="" />
<div id="command-popup">
    <div>Console</div>
    <div>
        <table class="table-form">
            <tr>
                <td class="label" colspan="3">
                    <textarea id="console" rows="20" cols="10" style="width: 100%;font-family: Consolas;font-size: 8pt;" disabled="disabled"></textarea>
                </td>
            </tr>
        </table>
    </div>
</div>
