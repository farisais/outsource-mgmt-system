<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>so/get_so_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_so'},
                    { name: 'so_number'},
                    { name: 'customer'},
                    { name: 'customer_name'},
                    { name: 'quote'},
                    { name: 'quote_number'},
                    { name: 'status'}
                ],
                id: 'id_so',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            var cellclass = function (row, columnfield, value){
                if (value === 'draft') {
                    return 'red';
                }
                else if (value === 'close') {
                    return 'green';
                }
            };
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
                    { text: 'Sales Order Number', dataField: 'so_number', width: 200},
                    { text: 'Customer', dataField: 'customer_name'},
                    { text: 'Quote No.', dataField: 'quote_number', width: 200},
                    { text: 'Status', dataField: 'status', width: 200, cellclassname: cellclass}
                ]
            });                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 73, null, null);
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
        item['paramValue'] = row.id_so;
        param.push(item);        
        data_post['id_so'] = row.id_so;
        load_content_ajax(GetCurrentController(), 74, data_post, param);
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
            //load_content_ajax(GetCurrentController(), 4 ,data_post);
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
.red {
    color: red;
}
.blue {
    color: blue;
}
</style>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>