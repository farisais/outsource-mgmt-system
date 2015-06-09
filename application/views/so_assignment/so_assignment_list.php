<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>so_assignment/get_so_assignment_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_so_assignment'},
            { name: 'so_assignment_number'},
            { name: 'work_order_number'},
			{ name: 'full_name'},
			{ name: 'employee_number'},
			{ name: 'work_order_number'},
            { name: 'status'}
        ],
        id: 'id_so_assignment',
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
            { text: 'Employee ID', dataField: 'employee_number', width: 100},
            { text: 'Name', dataField: 'full_name', width: 250},
			{ text: 'WO', dataField: 'work_order_number'},
            { text: 'Status', dataField: 'status', width: 100}
        ]
    });               
 });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 150, null, null);
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
        item['paramValue'] = row.id_so_assignment;
        param.push(item);        
        data_post['id_so_assignment'] = row.id_so_assignment;
        load_content_ajax(GetCurrentController(), 151 ,data_post, param);
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
       if(confirm("Are you sure you want to delete data : " + row.name))
        {
            var data_post = {};
            data_post['id_so_assignment'] = row.id_so_assignment;
            //load_content_ajax(GetCurrentController(), 152 ,data_post);
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