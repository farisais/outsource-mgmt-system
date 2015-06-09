<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>gudang/get_gudang_not_virtual_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_warehouse'},
                    { name: 'kode_lokasi'},
                    { name: 'name'},
                    { name: 'address'},
                    { name: 'is_virtual'},
                    { name: 'note'}
                ],
                id: 'id_warehouse',
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
                    { text: 'Address', dataField: 'address', width: 200},
                    { text: 'Note', dataField: 'note', width: 100}
                   
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 48, null, null);
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
        item['paramValue'] = row.id_warehouse;
        param.push(item);        
        data_post['id_warehouse'] = row.id_warehouse;
        load_content_ajax(GetCurrentController(), 49 ,data_post, param);
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
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>