<script src="http://103.247.10.194:3000/socket.io/socket.io.js"></script>
<script>
try
{
     var socket = io.connect('http://103.247.10.194:3000');
     socket.on('welcome', function(data){
        ConsoleWriteLine("===== " + data.message + ' on http://103.247.10.194:3000' + " =====");
        ConsoleWriteLine("");
        ConsoleWriteLine("Select the employee you want to enroll, select APPID, then click Start Enroll");
        ConsoleWriteLine("");
     });
     
     socket.on('error', function(){
        ConsoleWriteLine("Unable to connect fingerprint sync server on http://103.247.10.194:3000");
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
                $("#fingerprint-grid").jqxGrid('clear');
                $("#fingerprint-grid").jqxGrid('addrow', null, obj.data);
                
            }
            else
            {
                ConsoleWriteLine('Failed to save fingerprint data EmployeeID('+ data.respons.employee_number +') to database');
            }
            
            $("#id_employee").val('');
            $("#fullname").val('');
            $("#employee-number").val('');
            $("#position").val('');
            $("#position-level").val('');
            $("#AppID").val('');
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
    //ConsoleWriteLine(JSON.stringify(data));
    $("#start-enroll").html("Start Enroll");
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
    alert(err.message);
    ConsoleWriteLine(err.message)
}
 
  
  
  function emitCommand(command, param)
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
            
            var commandJson = {appID: $("#app-id").val(), devID: $("#dev-id").val(), commandID: obj.commandID,command: command, parameter: param };
            //ConsoleWriteLine("Emitting Command : " + JSON.stringify(commandJson));
            ConsoleWriteLine('Sending command('+ obj.commandID +'): '+ command +' to Fingersync Daemon ' + $("#app-id").val());
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
    $('#console').scrollTop($('#console')[0].scrollHeight);
  }
</script>
<script>
$(document).ready(function(){
    
    $("#select-employee-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-appid-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#fingerprint-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '88%',
        height: 150,
        selectionmode : 'singlerow',
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'EmployeeID', dataField: 'employee',width: 100},
            { text: 'Fingerprint Template', dataField: 'fingerprint_tmp'},
            { text: 'FID', dataField: 'fid',width: 100},
            { text: 'Flag', dataField: 'flag', width: 100},
            { text: 'Temp. Length', dataField: 'tmp_length', width: 100},
        ]
    });
    
    
    $("#start-enroll").click(function(){
        if($(this).html() == "Start Enroll")
        {
            $(this).html("Stop Enroll");
            emitCommand("enroll_fingerprint", "{'employee_number': '"+ $("#employee-number").val() +"', 'id_employee' : '"+ $("#id_employee").val() +"', 'full_name' : '"+ $("#fullname").val() +"', 'serial_number' : '"+ $("#dev-id").val() +"'}")
        }
        else
        {
            $(this).html("Start Enroll");
        }
    });
    
    //=================================================================================
    //
    //   Select Employee Grid
    //
    //=================================================================================
    
    var url_select_employee = "<?php echo base_url() ;?>employee/get_employee_list";
    var source_select_employee =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_employee'},
            { name: 'full_name'},
            { name: 'employmment_type'},
            { name: 'employment_type_name'},
            { name: 'employee_number'},
            { name: 'position'},
            { name: 'position_name'},
            { name: 'position_level'},            
            { name: 'position_level_name'},
        ],
        id: 'id_employee',
        url: url_select_employee ,
        root: 'data'
    };
    var dataAdapter_select_employee = new $.jqx.dataAdapter(source_select_employee);
    
    $("#select-employee-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_employee,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Employee ID', dataField: 'id_employee', displayfield: 'employee_number', width: 150},
            { text: 'Name', dataField: 'full_name'},
            { text: 'Position', dataField: 'position', displayfield: 'position_name',width: 150}, 
            { text: 'Level', dataField: 'position_level', displayfield: 'position_level_name', width: 100}                                        
        ]
    });
    
    $('#select-employee-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-employee-grid').jqxGrid('getrowdata', args.rowindex);
        $("#id_employee").val(data['id_employee']);
        $("#fullname").val(data['full_name']);
        $("#employee-number").val(data['employee_number']);
        $("#position").val(data['position_name']);
        $("#position-level").val(data['position_level_name']);
        
        ConsoleWriteLine("Employee with EmployeeID : " + data['employee_number'] + " is selected.")
        $("#select-employee-popup").jqxWindow('close');
    });
    
    $("#select-employee").click(function(){
       $("#select-employee-popup").jqxWindow('open'); 
    });
    
    //=================================================================================
    //
    //   Select AppID Grid
    //
    //=================================================================================
    
    var url_select_appid = "<?php echo base_url() ;?>fingerprint_assign/get_fingerprint_assign_all_assgined";
    var source_select_appid =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_fingerprint_device'},
            { name: 'fingerprint_assign'},
            { name: 'merk'},
            { name: 'series'},
            { name: 'serial_number'},
            { name: 'app_id'},
        ],
        id: 'id_fingerprint_assign',
        url: url_select_appid ,
        root: 'data'
    };
    var dataAdapter_select_appid = new $.jqx.dataAdapter(source_select_appid);
    
    $("#select-appid-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_appid,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Serial Number', dataField: 'id_fingerprint_device', displayfield: 'serial_number', width: 150},
            { text: 'Merk', dataField: 'merk'},
            { text: 'Series', dataField: 'series',width: 150}, 
            { text: 'AppID', dataField: 'app_id', width: 100}                                        
        ]
    });
    
    $('#select-appid-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-appid-grid').jqxGrid('getrowdata', args.rowindex);
        $("#app-id").val(data['app_id']);
        $("#dev-id").val(data['serial_number']);
        $("#AppID").val(data['app_id'] + ' - ' + data['merk'] + ' - ' + data['serial_number']);
        ConsoleWriteLine($("#app-id").val() + " will be used to enroll fingerprint");
        $("#select-appid-popup").jqxWindow('close');
    });
    
    $("#select-appid").click(function(){
       $("#select-appid-popup").jqxWindow('open'); 
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
<style>

.second-column
{
    padding-left: 30px;
}

.image-field
{
    border: 1px solid #c8c8d3;
    -moz-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    -webkit-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);  
    padding: 10px;  
    cursor: pointer;
}

#clear-image
{
    width: 30px;
    height: 30px;
    background: darkgray;
    /* float: left; */
    position: relative;
    top: -152px;
    left: 120px;
    display: -webkit-inline-box;
    z-index: 100;
}
#clear-image span
{
    font-weight: bold;
    font-size: 12pt;
    color: white;
}

textarea#console 
{
    background-color: darkblue;
    color: white;
}
</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_employee" value="" />
<input type="hidden" id="employee_number" value="" />
<input type="hidden" id="app-id" value="" />
<input type="hidden" id="dev-id" value="" />
<div class="document-action">

</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;padding-bottom: 50px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;">Fingerprint Enroll</h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td rowspan="4" style="width: 150px;">
                        <div>
                            <img class="image-field" style="width: 100px;" src="<?php echo base_url() . 'images/user-icon.png' ?>" alt="product-default"/>
                        </div>
                    </td>
                    <td class="label">
                        Employee Number
                    </td>
                    <td colspan="2">
                        <input style="display: inline; width: 73%" class="field" type="text" id="employee-number" value="" /><button style="margin-left: 2px;" id="select-employee">...</button>
                    </td>
                    <td>
                    
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Full Name
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Position
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="position" value="" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Level
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="position-level" value="" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Applicatoin ID
                    </td>
                    <td colspan="2">
                        <input style="display: inline; width: 83%" class="field" type="text" id="AppID" value="" /><button style="margin-left: 2px;" id="select-appid">...</button>
                    </td>
                    <td>
                    
                    </td>
                </tr>
            </table>
            <table class="table-form">
                <tr>
                    <td colspan="3">                       
                         <div class="row-color" style="width: 92%;height: 22px;">
                            <button id="start-enroll" style="">Start Enroll</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label" colspan="3">
                        <textarea id="console" rows="15" cols="10" style="width: 92%;font-family: Consolas;font-size: 8pt;" disabled="disabled"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row-color" style="width: 92%;height: 17px;padding-top: 3px;">
                            <span>Fingerprint Data</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="fingerprint-grid"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div id="select-employee-popup">
    <div>Select Employee</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-employee-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="select-appid-popup">
    <div>Select Device</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-appid-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>