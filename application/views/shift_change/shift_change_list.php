<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>shift_change/get_shift_change_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_shift_change'},
                    { name: 'employee'},
                    { name: 'from_work_schedule'},
                    { name: 'to_work_schedule'},
                    { name: 'status'},
                    { name: 'reason'}
                ],
            id: 'id_shift_change',
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
                    { text: 'Employee', dataField: 'employee', width: 150},
                    { text: 'From Work Schedule', dataField: 'from_work_schedule', width: 125, width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'To Work Schedule', dataField: 'to_work_schedule', width: 125, width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Reason', dataField: 'reason'},
                    { text: 'Status', dataField: 'status', width: 100}
                ]
            });
    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 155, null, null);
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

<div></div>