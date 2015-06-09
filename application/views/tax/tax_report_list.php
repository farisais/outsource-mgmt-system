<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>tax/get_tax_report_all";
        var source =
        {
            datatype: "json",
            datafields:
                [
					{ name: 'id_payslip' },
                    { name: 'employee_number', type: 'int'},
                    { name: 'full_name', type: 'string'},
					{ name: 'periode_name', type: 'string'},
                    { name: 'structure_name'},
                    { name: 'npwp'},
                    { name: 'pph', type: 'number'},
					{ name: 'date_start', type: 'date'},
					{ name: 'date_finished', type: 'date'},
					{ name: 'work_order'},
					{ name: 'work_order_number'}
                ],
            id: 'id_payslip',
            url: url,
            root: 'data'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
		var localizationobj = {};
		localizationobj.currencysymbol = "Rp. ";
		$("#jqxgrid").jqxGrid('localizestrings', localizationobj); 
        $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: '90%',
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,
				showstatusbar: true,
                statusbarheight: 25,
                altrows: true,
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
				showaggregates: true,
                columns: [
                    { text: 'Employee ID', dataField: 'employee_number', width: 100},
                    { text: 'Name', dataField: 'full_name', width: 150},
                    { text: 'Position', dataField: 'structure_name',  width: 150},
                    { text: 'WO', dataField: 'work_order_number', width: 150},
					{ text: 'Periode', dataField: 'periode_name', width: 150},
					{ text: 'NPWP', dataField: 'npwp', width: 150},
					{ text: 'PPH', dataField: 'pph', width: 150, cellsformat: 'c2',aggregates: [
						{ '<b>Total</b>':
							function (aggregatedValue, currentValue, column, record) {
								var total = currentValue;
								return aggregatedValue + total;
							}
						}]
					},
					{ text: 'Date Start', dataField: 'date_start', width: 150, cellsformat: 'dd-MM-yyyy'},
					{ text: 'Date End', dataField: 'date_finished', width: 150, cellsformat: 'dd-MM-yyyy'},
                ]
            });
			
			$("#jqxgrid").on("bindingcomplete", function (event) {
				$("#jqxgrid").jqxGrid('localizestrings', localizationobj); 
			}); 
    });
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