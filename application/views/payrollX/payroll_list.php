<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>payroll/get_payroll_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_payroll'},
                    { name: 'process_date'},
                    { name: 'period_start'},
                    { name: 'period_end'},
                    { name: 'customer'},
                    { name: 'so'},
                    { name: 'overtime'}
                ],
            id: 'id_payroll',
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
                    { text: 'Process Date', dataField: 'process_date', width: 125, width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Period Start', dataField: 'period_start', width: 125, width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Period End', dataField: 'period_end', width: 125, width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Customer Name', dataField: 'salary'},
                    { text: 'Product / Service', dataField: 'so', width: 150}
                ]
            });
    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 180, null, null);
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