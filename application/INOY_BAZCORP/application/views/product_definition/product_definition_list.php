<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>product_definition/get_product_definition_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_product_definition'},
                    { name: 'product'},
                    { name: 'product_name'},
                    { name: 'organisation_structure'},
                    { name: 'structure_name'},
                    { name: 'position'},
                    { name: 'position_level_name'},
                    
                ],
                id: 'id_product_definition',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#jqxgrid').jqxGrid(
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
                    { text: 'Product Name', dataField: 'product', displayfield: 'product_name'},
                    { text: 'Position', dataField: 'organisation_structure', displayfield: 'structure_name'},
                    { text: 'Level', dataField: 'position',  displayfield: 'position_level_name' ,width: 100}
                    
                ]
            });
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 'create_product_definition', null, null);
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
        item['paramValue'] = row.id_product_definition;
        param.push(item);        
        data_post['id_product_definition'] = row.id_product_definition;
        load_content_ajax(GetCurrentController(), 'edit_product_definition' ,data_post, param);
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
       if(confirm("Are you sure you want to delete menu : " + row.producct_name))
        {
            var data_post = {};
            data_post['id_product_definition'] = row.id_product_definition;
            //load_content_ajax(GetCurrentController(), 'delete_product_definition' ,data_post);
        }
    }
    else
    {
        alert('Select menu you want to delete first');
    }
}

</script>
<style>
.green {
    color: green;
}
</style>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>