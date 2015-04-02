<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>join_item/get_join_item_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_join_item'},
                    { name: 'join_item_number'},
                    { name: 'bom'},
                    { name: 'bom_name'},
                    { name: 'date', type: 'date'},
                    { name: 'product'},
                    { name: 'product_name'},
                    { name: 'activity'},
                    { name: 'status'},
                ],
                id: 'id_join_item',
                url: url,
                root: 'data'
            };
            var cellclass = function (row, columnfield, value) 
            {
                if (value == 'transfer') {
                    return 'green';
                }
            }
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
                    { text: 'Join Item Number', dataField: 'join_item_number', width: 200},
                    { text: 'Date', dataField: 'date', width: 100, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'BOM', dataField: 'bom', displayfield: 'bom_name'},
                    { text: 'Product Name', dataField: 'product', displayfield: 'product_name'},
                    { text: 'Status', dataField: 'status', width: 100, cellclassname: cellclass}
                    
                ]
            });
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 161, null, null);
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
        item['paramValue'] = row.id_join_item;
        param.push(item);        
        data_post['id_join_item'] = row.id_join_item;
        load_content_ajax(GetCurrentController(), 162 ,data_post, param);
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
            //load_content_ajax(GetCurrentController(), 163 ,data_post);
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