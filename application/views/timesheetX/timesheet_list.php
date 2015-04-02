<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>timesheet/get_timesheet_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_timesheet'},
            { name: 'date'},
            { name: 'id_schedule_assignment'},
            { name: 'date'},
            { name: 'so_number'},
            { name: 'so'},
            { name: 'customer'},
            { name: 'customer_name'},
            { name: 'site'},
            { name: 'site_name'},
            { name: 'id_employee'},
            { name: 'full_name'},
            { name: 'employee_number'}
        ],
        id: 'id_timesheet',
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
            { text: 'Employee ID', dataField: 'employee_number', width: 200},
            { text: 'Name', dataField: 'full_name', width: 200},
            { text: 'Date', dataField: 'date'},
            { text: 'Customer', dataField: 'customer_name', displayfield: 'customer'},
            { text: 'Site', dataField: 'site_name', displayfield: 'site', width: 100}
        ]
    })               
 });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 165, null, null);
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
        item['paramValue'] = row.id_timesheet;
        param.push(item);        
        data_post['id_timesheet'] = row.id_timesheet;
        load_content_ajax(GetCurrentController(), 166 ,data_post, param);
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
       if(confirm("Are you sure you want to delete data : " + row.full_name))
        {
            var data_post = {};
            data_post['id_timesheet'] = row.id_timesheet;
            //load_content_ajax(GetCurrentController(), 167 ,data_post);
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