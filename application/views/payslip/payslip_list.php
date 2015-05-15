<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>payslip/get_payslip_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_payslip'},
                    { name: 'employee'},
                    { name: 'full_name'},
                    { name: 'employee_number'},
                    { name: 'date_start', type: 'date'},
                    { name: 'date_finished', type: 'date'},
                    { name: 'structure'},
                    { name: 'structure_name'},
                    { name: 'total_gross' , type: 'float'},
                    { name: 'total_thp', type: 'float'},
                    { name: 'total_overtime', type: 'float'},
                    { name: 'jamsostek', type: 'float'},
                    { name: 'status'},
                    { name: 'pph', type: 'float'},
                    { name: 'work_order'},
                    { name: 'work_order_number'},
                    { name: 'customer'},
                    { name: 'customer_name'},
                    { name: 'payroll_periode'},
                    { name: 'periode_name'},
					{ name: 'payroll_type'},
                ],
            id: 'id_payslip',
            url: url,
            root: 'data'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: '92%',
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: [
                    { text: 'ID', dataField: 'employee_number', width: 50},
                    { text: 'Name', dataField: 'full_name', width: 150},
                    { text: 'Position', dataField: 'structure_name', width: 150},
                    { text: 'Work Order', dataField: 'work_order_number', width: 100},
                    { text: 'Customer', dataField: 'customer_name', width: 150},
                    { text: 'Period', dataField: 'periode_name', width: 100},
					{ text: 'Type', dataField: 'payroll_type', width: 100},
                    { text: 'Gross Salary', dataField: 'total_gross', width: 100, cellsformat: 'd'},
                    { text: 'Net Salary', dataField: 'total_thp', width: 100, cellsformat: 'd'},
                    { text: 'Overtime', dataField: 'total_overtime', width: 100, cellsformat: 'd'},
                    { text: 'Jamsostek', dataField: 'jamsostek', width: 100, cellsformat: 'd'},
                    { text: 'PPH', dataField: 'pph', width: 100, cellsformat: 'd'},
                ]
            });

        $("#jqxgrid").on("bindingcomplete", function (event) {

            var localizationobj = {};
            localizationobj.currencysymbol = "Rp. ";
            $("#jqxgrid").jqxGrid('localizestrings', localizationobj);
        });

    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 58, null, null);
    }

    function EditData()
    {

    }

    function DetailData()
    {
        var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        if(row != null)
        {
            var data_post = {};
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = row.id_payslip;
            param.push(item);

            data_post['id_po'] = row.id_payslip;
            load_content_ajax(GetCurrentController(), 'view_detail_payslip' ,data_post, param);
        }
        else
        {
            alert('Select menu you want to edit first');
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

<div>

</div>