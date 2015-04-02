<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>work_schedule/get_work_schedule_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_work_schedule'},
            { name: 'work_schedule_number'},
            { name: 'period_start', type: 'date'},
            { name: 'period_end', type: 'date'},
            { name: 'quote_number'},
            { name: 'customer'},
            { name: 'customer_name'},
            { name: 'status' }
        ],
        id: 'id_work_schedule',
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
            { text: 'Number', dataField: 'work_schedule_number'},
            { text: 'Quotation Number', dataField: 'quote_number'},
            { text: 'Period Start', dataField: 'period_start',  width: 100, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
            { text: 'Period End', dataField: 'period_end', width: 100, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
            { text: 'Status', dataField: 'status', width: 100, cellclassname: cellclass}
        ]
    });
                
    });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 145, null, null);
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
        item['paramValue'] = row.id_work_schedule;
        param.push(item);        
        data_post['id_work_schedule'] = row.id_work_schedule;
        load_content_ajax(GetCurrentController(), 146 ,data_post, param);
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
            data_post['id_work_schedule'] = row.id_work_schedule;
            //load_content_ajax(GetCurrentController(), 147 ,data_post);
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