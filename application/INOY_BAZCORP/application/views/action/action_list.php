<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>action/get_action_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_application_action'}, 
                    { name: 'name'}, 
                    { name: 'uname'}, 
                    { name: 'controller'},
                    { name: 'function_exec'},
                    { name: 'function_args'},
                    { name: 'view_type'},
                    { name: 'view_file'},
                    { name: 'prefix'},
                    { name: 'action_type'},
                    { name: 'action_button'},
                    { name: 'action_name'},
                    { name: 'use_log'}
                ],
                id: 'id',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '99%',
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
                    { text: 'ID', dataField: 'id_application_action', width: 40},
                    { text: 'Name', dataField: 'name', width: 200}, 
                    { text: 'Uname', dataField: 'uname', width: 100}, 
                    { text: 'Controller', dataField: 'controller'},
                    { text: 'Function Execute', dataField: 'function_exec'},
                    { text: 'Function Args', dataField: 'function_args'},
                    { text: 'View Type', dataField: 'view_type'},
                    { text: 'View File', dataField: 'view_file'},
                    { text: 'Prefix', dataField: 'prefix'},
                    { text: 'Action Type', dataField: 'action_type'},
                    { text: 'Action Button', dataField: 'action_button'},
                    { text: 'Target Action', dataField: 'action_name'},
                    { text: 'Use Log', dataField: 'use_log'}
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 2, null, null);
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
        item['paramValue'] = row.id_application_action;
        param.push(item);        
        data_post['id_application_action'] = row.id_application_action;
        load_content_ajax(GetCurrentController(), 3 ,data_post, param);
    }
    else
    {
        alert('Select menu you want to edit first');
    }                            
}
function CopyData(){
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
            var data_post = {};
            data_post['id_application_action'] = row.id_application_action;
            load_content_ajax(GetCurrentController(), 286 ,data_post);
        
    }
    else
    {
        alert('Select menu you want to Copy first');
    }
}
function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete menu : " + row.name))
        {
            var data_post = {};
            data_post['id_application_action'] = row.id_application_action;
            load_content_ajax(GetCurrentController(), 4 ,data_post);
        }
    }
    else
    {
        alert('Select menu you want to delete first');
    }
}

</script>
<input type="button" value="Copy" onclick="CopyData()" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>