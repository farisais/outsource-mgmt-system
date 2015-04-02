<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>database_interface/get_database_interface_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_database_interface'},
                    { name: 'table_name'},
                    { name: 'model_name'},
                    { name: 'alias'},
                    { name: 'status_sync'},
                       
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
                height: 450,
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: [
                    { text: 'Database Table', dataField: 'table_name', width: 200},
                    { text: 'Model Name', dataField: 'model_name'},
                    { text: 'Alias', dataField: 'alias'},
                    { text: 'Status Sync', dataField: 'status_sync', width: 100},
                                       
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 100, null, null);
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
        item['paramValue'] = row.id_database_interface;
        param.push(item);        
        data_post['id_database_interface'] = row.id_database_interface;
        load_content_ajax(GetCurrentController(), 101 ,data_post, param);
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
       if(confirm("Are you sure you want to delete data : " + row.name))
        {
            var data_post = {};
            data_post['id_database_interface'] = row.id_database_interface;
            load_content_ajax(GetCurrentController(), 102 ,data_post);
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