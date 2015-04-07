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
            { name: 'date', type: 'date'},
            { name: 'employee_number', type: 'int'},
            { name: 'full_name', type: 'string'},
            { name: 'structure_name'},
            { name: 'work_order_number'},
            { name: 'project_name'},
            { name: 'shift_id'},
            { name: 'shift_code'},
            { name: 'nama_shift'},
            { name: 'shift_start'},
            { name: 'shift_end'},
            { name: 'working_hour'},
        ],
        id: 'id',
        url: url,
        root: 'data'
    };
    var cellclass = function (row, columnfield, value) 
    {
        var data = $("#jqxgrid").jqxGrid('getrowdata',row);
        if(data.working_hour == null)
        {
            return 'red-mark';
        }
    };
    var cellclass2 = function (row, columnfield, value) 
    {
        var data = $("#jqxgrid").jqxGrid('getrowdata',row);
        var css = '';
        if(data.working_hour == null)
        {
            css = 'red-mark';
        }
        
        if(value > 0)
        {
            css += ' red';
        }
        
        return css;
    };
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
        filtermode: 'excel',
        sortable: true,
        columns: [
            { width: 150, text: 'Employee No.',dataField: 'employee_number',cellclassname: cellclass},
            { width: 150, text: 'Name',dataField: 'full_name', displayfield: 'full_name', cellclassname: cellclass},
            { width: 150, text: 'Position',dataField: 'structure_name',cellclassname: cellclass},
            { width: 150, text: 'WO',dataField: 'work_order_number',cellclassname: cellclass},
            { width: 150, text: 'Project',dataField: 'project_name',cellclassname: cellclass},
            { width: 150, text: 'Time In',dataField: 'in',cellclassname: cellclass},
            { width: 150, text: 'Time Out',dataField: 'out',cellclassname: cellclass},
            { width: 150, text: 'Working Hour (Hr)',dataField: 'working_hour',cellclassname: cellclass},
            { width: 150, text: 'Src. In',dataField: 'input_by',cellclassname: cellclass},
            { width: 150, text: 'Src. Out',dataField: 'output_by',cellclassname: cellclass},
            { width: 150, text: 'OT',dataField: 'overtime',cellclassname: cellclass},
            { width: 150, text: 'Late In (Mins)',dataField: 'late_in',cellclassname: cellclass2},
            { width: 150, text: 'Early Out (Mins)',dataField: 'early_out',cellclassname: cellclass2},
            { width: 150, text: 'Date',dataField: 'date', cellsformat: 'dd/MM/yyyy',cellclassname: cellclass},
            { width: 150, text: 'Shift ID',dataField: 'shift_id', displayfield: 'shift_code',cellclassname: cellclass},
            { width: 150, text: 'Shift',dataField: 'nama_shift',cellclassname: cellclass},
            { width: 150, text: 'Shift Start',dataField: 'shift_start',cellclassname: cellclass},
            { width: 150, text: 'Shift End',dataField: 'shift_end',cellclassname: cellclass}
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
.red-mark
{
    background-color: #FFEBEF;
}
</style>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>