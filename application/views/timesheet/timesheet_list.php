<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>timesheet/get_timesheet_list";
    var source =
    {
        
        datatype: "json",
        datafields:
        [
            { name: 'id'},
            { name: 'date'},
            { name: 'create_time'},
            { name: 'project_name'},
            { name: 'input_method'}
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
            { text: 'Project Name', dataField: 'project_name'},
            { text: 'Date', dataField: 'date', width: 170},
            { text: 'Create Time', dataField: 'create_time', width: 170},
            { text: 'Input Method', dataField: 'input_method', width: 170},
        ]
    })               
 });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 352, null, null);
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
        data_post['id_timesheet'] = row.id;
        load_content_ajax(GetCurrentController(), 374 ,data_post, param);
    }
    else
    {
        alert('Select data you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete data : " + row.date))
        {
            var data_post = {};
            data_post['id_timesheet'] = row.id_timesheet;
            load_content_ajax(GetCurrentController(), 167 ,data_post);
        }
    }
    else
    {
        alert('Select data you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>