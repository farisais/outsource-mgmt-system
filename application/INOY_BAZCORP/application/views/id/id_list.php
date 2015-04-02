<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>id/get_id_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_number'},
                    { name: 'project_list'},
                    { name: 'date'},
                    { name: 'status'},
                    { name: 'id_internal_delivery'},
                       
                ],
                id: 'id_internal_delivery',
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
                    { text: 'Internal Delivery No.', dataField: 'id_number'},
                    { text: 'Project List Number', dataField: 'project_list'},
                    { text: 'Status', dataField: 'status', width: 100},
                                       
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 108, null, null);
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
        item['paramValue'] = row.id_internal_delivery;
        param.push(item);        
        data_post['id_internal_delivery'] = row.id_internal_delivery;
        load_content_ajax(GetCurrentController(), 109 ,data_post, param);
    }
    else
    {
        alert('Select menu you want to edit first');
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
            data_post['id_internal_delivery'] = row.id_internal_delivery;
            load_content_ajax(GetCurrentController(), 110 ,data_post);
        }
    }
    else
    {
        alert('Select menu you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>