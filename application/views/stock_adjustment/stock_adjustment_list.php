<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>stock_adjustment/get_stock_adjustment_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_stock_adjustment'},
                    { name: 'date'},
                    { name: 'description'},
                    { name: 'status'},
                    
                ],
                id: 'id_stock_adjustment',
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
                    { text: 'Description', dataField: 'description'},
                    { text: 'Date', dataField: 'date', cellsformat: 'dd/MM/yyyy',filtertype: 'date', width: 100},
                    { text: 'Status', dataField: 'status', width: 100},
                ]
            });
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 132, null, null);
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
        item['paramValue'] = row.id_stock_adjustment;
        param.push(item);        
        data_post['id_stock_adjustment'] = row.id_stock_adjustment;
        load_content_ajax(GetCurrentController(), 133 ,data_post, param);
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
            //load_content_ajax(GetCurrentController(), 134 ,data_post);
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