<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>work_order/get_work_order_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_work_order'},
            { name: 'work_order_number'},
            { name: 'date', type: 'date'},
            { name: 'so_number'},
            { name: 'so'},
            { name: 'customer_name'},
            { name: 'status'},
            { name: 'project_name'}
        ],
        id: 'id_work_order',
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
            { text: 'WO Number', dataField: 'work_order_number', width: 200},
            { text: 'Date', dataField: 'date', width: 200, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
            { text: 'SO Number', dataField: 'so_number'},
            { text: 'Customer Name', dataField: 'customer_name'},
            { text: 'Project Name', dataField: 'project_name'},
            { text: 'Status', dataField: 'status', width: 100, cellclassname: cellclass}                   
        ]
    })               
 });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 130, null, null);
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
        item['paramValue'] = row.id_work_order;
        param.push(item);        
        data_post['id_work_order'] = row.id_work_order;
        load_content_ajax(GetCurrentController(), 131 ,data_post, param);
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
            data_post['id_work_order'] = row.id_work_order;
            //load_content_ajax(GetCurrentController(), 4 ,data_post);
        }
    }
    else
    {
        alert('Select data you want to delete first');
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