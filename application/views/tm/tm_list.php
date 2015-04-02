<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>tm/get_tm_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_type_material'},
                    { name: 'type_material'},
                    { name: 'abbreviation'}
                ],
                id: 'id_type_material',
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
                    { text: 'Type Material', dataField: 'type_material'},
                    { text: 'Alias', dataField: 'abbreviation', width: 150}
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 'create_type_material', null, null);
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
        item['paramValue'] = row.id_type_material;
        param.push(item);        
        data_post['id_type_material'] = row.id_type_material;
        load_content_ajax(GetCurrentController(), 'edit_type_material' ,data_post, param);
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
       if(confirm("Are you sure you want to delete merk : " + row.type_material))
        {
            var data_post = {};
            data_post['id_type_material'] = row.id_merk;
            load_content_ajax(GetCurrentController(), 'delete_type_material' ,data_post);
        }
    }
    else
    {
        alert('Select merk you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>