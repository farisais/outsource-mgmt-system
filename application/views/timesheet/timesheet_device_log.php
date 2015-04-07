<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>timesheet/get_timesheet_device_log";
    var source =
    {
        
        datatype: "json",
        datafields:
        [
            { name: 'id_timesheet_device_log'},
            { name: 'time'},
            { name: 'source'},
            { name: 'employee'},
            { name: 'app_id'},
            { name: 'serial_number'},
            { name: 'work_order'},
            { name: 'wo_number'},
            { name: 'date', type: 'date'},
            { name: 'employee_number', type: 'int'},
            { name: 'full_name', type: 'string'},
            { name: 'structure_name'},
            { name: 'serial_number'},
            { name: 'app_id'},
            { name: 'project_name'}
        ],
        id: 'id_timesheet_device_log',
        url: url,
        root: 'data'
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
        showfilterrow: true,
        autoshowloadelement: false,                                                                                
        filterable: true,
        filtermode: 'excel',
        sortable: true,
        columns: [
            { width: 150, text: 'Employee No.',dataField: 'employee_number'},
            { width: 150, text: 'Name',dataField: 'full_name', displayfield: 'full_name'},
            { width: 150, text: 'Date',dataField: 'date', cellsformat: 'dd/MM/yyyy', filtertype: 'date'},
            { width: 150, text: 'Position',dataField: 'structure_name'},
            { width: 150, text: 'WO',dataField: 'wo_number'},
            { width: 150, text: 'Project',dataField: 'project_name'},
            { width: 150, text: 'Time',dataField: 'time'},
            { width: 150, text: 'SN Device',dataField: 'serial_number'},
            { width: 150, text: 'APPID',dataField: 'app_id'},
        ]
    })               
 });  
</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>