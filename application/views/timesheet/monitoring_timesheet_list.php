<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>timesheet/get_monitoring_timesheet_data";
    var source =
    {
        
        datatype: "json",
        datafields:
        [
            { name: 'id'},
            { name: 'in'},
            { name: 'out'},
            { name: 'input_by'},
            { name: 'output_by'},
            { name: 'overtime'},
            { name: 'late_in'},
            { name: 'early_out'},
            { name: 'timesheet_group_id'},
            { name: 'date'},
            { name: 'employee_number'},
            { name: 'full_name'},
            { name: 'structure_name'},
            { name: 'work_order_number'},
            { name: 'project_name'},
            { name: 'shift_id'},
            { name: 'shift_code'},
            { name: 'nama_shift'},
            { name: 'shift_start'},
            { name: 'shift_end'},
        ],
        id: 'id',
        url: url,
        root: 'data'
    };
    var cellclass = function (row, columnfield, value) 
    {
        if (value > 0) {
            return 'red';
        }
    }
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#jqxgrid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: '98%',
        source: dataAdapter,
        groupable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        filterable: true,
        showfilterrow: true,
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { width: 150, text: 'Employee No.',dataField: 'employee_number'},
            { width: 150, text: 'Name',dataField: 'full_name'},
            { width: 150, text: 'Position',dataField: 'structure_name'},
            { width: 150, text: 'WO',dataField: 'work_order_number'},
            { width: 150, text: 'Project',dataField: 'project_name'},
            { width: 150, text: 'Time In',dataField: 'in'},
            { width: 150, text: 'Time Out',dataField: 'out'},
            { width: 150, text: 'Src. In',dataField: 'input_by'},
            { width: 150, text: 'Src. Out',dataField: 'output_by'},
            { width: 150, text: 'OT',dataField: 'overtime'},
            { width: 150, text: 'Late In',dataField: 'late_in', cellclassname: cellclass},
            { width: 150, text: 'Early Out',dataField: 'early_out', cellclassname: cellclass},
            { width: 150, text: 'Date',dataField: 'date', type: 'date'},
            { width: 150, text: 'Shift ID',dataField: 'shift_id', displayfield: 'shift_code'},
            { width: 150, text: 'Shift',dataField: 'nama_shift'},
            { width: 150, text: 'Shift Start',dataField: 'shift_start'},
            { width: 150, text: 'Shift End',dataField: 'shift_end'},
        ]
    })               
 });  
</script>
<script>
function CreateData()
{
    
}

function EditData()
{
                     
}

function DeleteData()
{
    
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