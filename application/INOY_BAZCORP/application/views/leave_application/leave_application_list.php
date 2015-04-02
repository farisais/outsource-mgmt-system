<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>leave_application/get_leave_application_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_leave_application'},
                    { name: 'employee'},
                    { name: 'leave_date_from', type: 'date'},
                    { name: 'leave_date_to', type: 'date'},
                    { name: 'days_of_leave'},
                    { name: 'type'},
                    { name: 'status'},
                    { name: 'reason'}
                ],
            id: 'id_leave_application',
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
                    { text: 'Date From', dataField: 'leave_date_from', width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Date To', dataField: 'leave_date_to', width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Type', dataField: 'type', width: 100},
                    { text: 'Reason', dataField: 'reason'},
                    { text: 'Status', dataField: 'status', width: 100}
                ]
            });

    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 160, null, null);
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