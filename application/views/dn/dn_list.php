<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>dn/get_dn_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_dn'},
                    { name: 'no_dn'},
					{ name: 'id_mr'},
					{ name: 'mr_number'},
					{ name: 'work_order'},
					{ name: 'work_order_number'},
                    { name: 'note'},
                    { name: 'date', type: 'date'},
                    { name: 'status_dn'},
                       
                ],
                id: 'id_dn',
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
                    { text: 'Delivery Note No.', dataField: 'no_dn', width: 200},
                    { text: 'MR No.', dataField: 'mr_number'},
					{ text: 'WO No.', dataField: 'work_order_number'},
					{ text: 'Date Deliver', dataField: 'date',cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Status', dataField: 'status_dn', width: 100},
                                       
                ]
            });
            
        $("#jqxgrid").on("rowdoubleclick", function(event){
        var row = $('#jqxgrid').jqxGrid('getrowdata', event.args.rowindex);
        
        if(row != null)
        {
            var data_post = {};
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = row.id_dn;
            param.push(item);        
            data_post['id_dn'] = row.id_dn;
            load_content_ajax(GetCurrentController(), 'view_dn' ,data_post, param);
            
        }
       
        });
            
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 84, null, null);
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
        item['paramValue'] = row.id_dn;
        param.push(item);        
        data_post['id_dn'] = row.id_dn;
        load_content_ajax(GetCurrentController(), 85 ,data_post, param);
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
            data_post['id_dn'] = row.id_dn;
            load_content_ajax(GetCurrentController(), 86 ,data_post);
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