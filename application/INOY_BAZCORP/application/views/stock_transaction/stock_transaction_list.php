<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>stock_transaction/get_stock_transaction_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_stock_transaction'},
                    { name: 'product'},
                    { name: 'product_name'},
                    { name: 'transaction_date', type: 'date'},
                    { name: 'uom'},
                    { name: 'unit_name'},
                    { name: 'qty', type: 'number'},
                    { name: 'gudang1_name'},
                    { name: 'gudang2_name'},
                    { name: 'status'},
                    { name: 'description'},
                    
                ],
                id: 'id_stock_transaction',
                url: url,
                root: 'data'
            };
            var cellclass = function (row, columnfield, value) 
            {
                if (value == 'post') {
                    return 'green';
                }
            }
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#jqxgrid').jqxGrid(
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
                    { text: 'Description', dataField: 'description', width: 200},
                    { text: 'Product Name', dataField: 'product', displayfield: 'product_name'},
                    { text: 'Date', dataField: 'transaction_date', cellsformat: 'dd/MM/yyyy',filtertype: 'date', width: 100},
                    { text: 'Quantity', dataField: 'qty', width: 100},
                    { text: 'Unit', dataField: 'uom', displayfield: 'unit_name',width: 100},
                    { text: 'Source Loc.', dataField: 'gudang1_name', width: 150},
                    { text: 'Dest. Loc.', dataField: 'gudang2_name', width: 150},
                    { text: 'Status', dataField: 'status', width: 100, cellclassname: cellclass}
                    
                ]
            });
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 255, null, null);
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
        item['paramValue'] = row.id_stock_transaction;
        param.push(item);        
        data_post['id_stock_transaction'] = row.id_stock_transaction;
        load_content_ajax(GetCurrentController(), 256 ,data_post, param);
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
            //load_content_ajax(GetCurrentController(), 122 ,data_post);
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