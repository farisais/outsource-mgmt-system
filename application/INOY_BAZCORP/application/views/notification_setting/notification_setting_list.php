<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>notification_setting/get_notification_setting_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_notification_setting'}, 
                    { name: 'name'},
                    { name: 'description'},
                ],
                id: 'id',
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
                    { text: 'Name', dataField: 'name'},
                    { text: 'Description', dataField: 'description'},
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 'create_notification_setting', null, null);
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
        item['paramValue'] = row.id_notification_setting;
        param.push(item);        
        data_post['id_notification_setting'] = row.id_notification_setting;
        load_content_ajax(GetCurrentController(), 'edit_notification_setting' ,data_post, param);
    }
    else
    {
        alert('Select data you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete notification_setting : " + row.name))
        {
            var data_post = {};
            data_post['id_notification_setting'] = row.id_notification_setting;
            load_content_ajax(GetCurrentController(), 'delete_notification_setting' ,data_post);
        }
    }
    else
    {
        alert('Select data you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>