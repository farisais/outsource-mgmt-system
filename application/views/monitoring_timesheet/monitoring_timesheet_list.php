<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>monitoring_timesheet/get_monitoring_timesheet_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_work_order'},
            { name: 'project_name'},
            { name: 'tahun',type:'int'},
            { name: 'bulan'},
            { name: '01'},
            { name: '02'},
            { name: '03'},
            { name: '04'},
            { name: '05'},
            { name: '06'},
            { name: '07'},
            { name: '08'},
            { name: '09'},
            { name: '10'},
            { name: '11'},
            { name: '12'},
            { name: '13'},
            { name: '14'},
            { name: '15'},
            { name: '16'},
            { name: '17'},
            { name: '18'},
            { name: '19'},
            { name: '20'},
            { name: '21'},
            { name: '22'},
            { name: '23'},
            { name: '24'},
            { name: '25'},
            { name: '26'},
            { name: '27'},
            { name: '28'},
            { name: '29'},
            { name: '30'},
            { name: '31'}
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
            { text: 'ID', dataField: 'id_work_order', width: 50},
            { text: 'Project Name', dataField: 'project_name', width: 300},
            { text: 'Tahun', dataField: 'tahun', width: 50},
            { text: 'Bulan', dataField: 'bulan', width: 40},
            { text: '01', dataField: '01', width: 20, cellsalign: 'center'},
            { text: '02', dataField: '02', width: 20, cellsalign: 'center'},
            { text: '03', dataField: '03', width: 20, cellsalign: 'center'},
            { text: '04', dataField: '04', width: 20, cellsalign: 'center'},
            { text: '05', dataField: '05', width: 20, cellsalign: 'center'},
            { text: '06', dataField: '06', width: 20, cellsalign: 'center'},
            { text: '07', dataField: '07', width: 20, cellsalign: 'center'},
            { text: '08', dataField: '08', width: 20, cellsalign: 'center'},
            { text: '09', dataField: '09', width: 20, cellsalign: 'center'},
            { text: '10', dataField: '10', width: 20, cellsalign: 'center'},
            { text: '11', dataField: '11', width: 20, cellsalign: 'center'},
            { text: '12', dataField: '12', width: 20, cellsalign: 'center'},
            { text: '13', dataField: '13', width: 20, cellsalign: 'center'},
            { text: '14', dataField: '14', width: 20, cellsalign: 'center'},
            { text: '15', dataField: '15', width: 20, cellsalign: 'center'},
            { text: '16', dataField: '16', width: 20, cellsalign: 'center'},
            { text: '17', dataField: '17', width: 20, cellsalign: 'center'},
            { text: '18', dataField: '18', width: 20, cellsalign: 'center'},
            { text: '19', dataField: '19', width: 20, cellsalign: 'center'},
            { text: '20', dataField: '20', width: 20, cellsalign: 'center'},
            { text: '21', dataField: '21', width: 20, cellsalign: 'center'},
            { text: '22', dataField: '22', width: 20, cellsalign: 'center'},
            { text: '23', dataField: '23', width: 20, cellsalign: 'center'},
            { text: '24', dataField: '24', width: 20, cellsalign: 'center'},
            { text: '25', dataField: '25', width: 20, cellsalign: 'center'},
            { text: '26', dataField: '26', width: 20, cellsalign: 'center'},
            { text: '27', dataField: '27', width: 20, cellsalign: 'center'},
            { text: '28', dataField: '28', width: 20, cellsalign: 'center'},
            { text: '29', dataField: '29', width: 20, cellsalign: 'center'},
            { text: '30', dataField: '30', width: 20, cellsalign: 'center'},
            { text: '31', dataField: '31', width: 20, cellsalign: 'center'},
        ]
    })               
 });  
</script>
<script>


</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>