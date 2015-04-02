<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>user/get_user_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_user'},
                    { name: 'user_name'},
                    { name: 'full_name'},
                    { name: 'email'},
                    { name: 'name'}
                ],
                id: 'id_user',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: '100%',
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: [
                    { text: 'ID', dataField: 'id_user', width: 60},
                    { text: 'User Name', dataField: 'user_name'},
                    { text: 'Full Name', dataField: 'full_name', width: 150},
                    { text: 'Email', dataField: 'email', width: 150},
                    { text: 'Role', dataField: 'name', width: 150},
                    { text: 'Action', datafield: 'Action', columntype: 'button', cellsrenderer: function () 
                        {
                            return "Change Password";
                        }, 
                        buttonclick: function (row) {
                            editrow = row;
                            var offset = $("#jqxgrid").offset();
                            $("#change-password-popup").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60 } });
                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', editrow);
                            $("#popup-msg").html("Change Password for User : " + dataRecord['user_name']);
                            $("#id-user-change-password").val(dataRecord['id_user']);
                            $("#change-password-popup").jqxWindow('open');
                        }
                    }
                ]
            });
            $("#change-password-popup").jqxWindow({
                width: 350, height: 150, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
            });
            
            $("#Save").click(function(){
                
                if($("#password").val() == $("#password-confirmation").val() && $("#password").val() != '' && $("#password").val() != null)
                {
                    
                    $("#change-password-popup").jqxWindow('close');
                    data_post = {};
                    data_post['password'] = $("#password").val();
                    data_post['id_user'] = $("#id-user-change-password").val();
                    load_content_ajax(GetCurrentController(), 82, data_post);
                }
                 else
                {
                    $("#error-notification").html("Password is not match");
                    $("#error-notification").jqxNotification("open");
                }
                
                $("#password").val(''); 
                $("#password-confirmation").val('');
            });  
             $("#error-notification").jqxNotification({
                width: 250, position: "top-right", opacity: 0.9,
                autoOpen: false, animationOpenDelay: 800, autoClose: true, autoCloseDelay: 3000, template: "error"
            });         
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 63, null, null);
}

function EditData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
    if(row != null)
    {
        var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = row.id_user;
        param.push(item);        
        data_post['id_user'] = row.id_user;
        load_content_ajax(GetCurrentController(), 64 ,data_post, param);
    }
    else
    {
        alert('Select user you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete user : " + row.user_name + "? All data relate to this user will be deleted."))
        {
            var data_post = {};
            data_post['id_user'] = row.id_user;
            load_content_ajax(GetCurrentController(), 65 ,data_post);
        }
    }
    else
    {
        alert('Select user you want to delete first');
    }
}

</script>
<style>
.table-form
{
    margin: 30px;
    width: 100%;
}

.table-form tr td
{
    
}

.table-form tr
{
    height: 35px;
}

.field 
{ 
    border: 1px solid #c4c4c4; 
    height: 15px; 
    width: 80%; 
    font-size: 11px; 
    padding: 4px 4px 4px 4px; 
    border-radius: 4px; 

} 

select.field
{
    height: 25px;
    width: calc(80% + 8px); 
    
}
 
.field:focus 
{ 
    outline: none; 
    border: 1px solid #7bc1f7; 
} 

.label
{
    font-size: 11pt;
    width: 160px;
    padding-right: 20px;
    font: -webkit-small-control;
}

.column-input
{

}

#change-password-popup table tr
{
    height: 20px;
}


</style>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>
<div id="change-password-popup">
    <div>Change Password</div>
    <div>
        <div style="margin-bottom: 10px;"><span id="popup-msg"></span></div>
        <table>
            <tr>
                <td class="label">
                    Password
                </td>
                <td class="column-input">
                    <input class="field" type="password" id="password" name="password" value=""/>
                </td>
            </tr>
            <tr>
                <td class="label">
                    Confirm Password
                </td>
                <td class="column-input">
                    <input class="field" type="password" id="password-confirmation" name="password-confirmation" value=""/>
                </td>
            </tr>
            <tr>
                <td align="right"><input style="margin-right: 5px;" type="button" id="Save" value="Save" /></td>
                <td style="padding-top: 10px;" align="right"><input id="Cancel" type="button" value="Cancel" /></td>
            </tr>
        </table>
    </div>
    <input type="hidden" id="id-user-change-password" value="" />
</div>
<div id="error-notification" style="margin-top: 40px;">
    <div>
       
    </div>
</div>