<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>log_error/get_log_error_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id'},
                    { name: 'log_error'},
                    { name: 'date'},
                    { name: 'pelapor'},
                    { name: 'handle_by'},
                    { name: 'kategori'},
                    { name: 'waktu_pengerjaan'},
                    { name: 'status_pekerjaan'}
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
                    { text: 'ID', dataField: 'id'},
                    { text: 'Log Error', dataField: 'log_error'},
                    { text: 'Date Report', dataField: 'date'},
                    { text: 'Pelapor', datafield: 'pelapor'},
                    { text: 'Handle By', datafield: 'handle_by'},
                    { text: 'Kategori', datafield: 'kategori'},
                    { text: 'Waktu Pengerjaan', datafield: 'waktu_pengerjaan'},
                    { text: 'Status Pekerjaan', datafield: 'status_pekerjaan'}
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 282, null, null);
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
        item['paramValue'] = row.id;
        param.push(item);        
        data_post['id'] = row.id;
        load_content_ajax(GetCurrentController(), 284 ,data_post, param);
    }
    else
    {
        alert('Select Log Error you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete customer : " + row.log_error))
        {
            var data_post = {};
            data_post['id'] = row.id;
            load_content_ajax(GetCurrentController(), 285 ,data_post);
        }
    }
    else
    {
        alert('Select Log Error you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>