<script>
function formatDate(date)
{
    var foo = date;
    var arr = foo.split("/");
    return arr[2]+'-'+arr[1]+'-'+arr[0];
}
function buttonclick(){
    
    var id = event.target.id;
    var data = $('#jqxgrid').jqxGrid('getrowdata', id);
    var data_post = {};
    data_post['id_work_order'] = data.id_work_order;
    data_post['date_start'] = data.date_start;
    data_post['date_finished'] = data.date_finish;
    data_post['id_payroll_periode'] = data.id_payroll_periode;

    load_content_ajax(GetCurrentController(), 393, data_post);
}
    $(document).ready(function () {
        var url = "<?php echo base_url()."payroll/get_wo_list_all/"; ?>";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id'},
                    {name:'id_work_order'},
                    { name: 'project_name'},
                    { name: 'contract_startdate'},
                    { name: 'contract_expdate'},
                    { name: 'customer_name'},
                    { name: 'periode_name'},
                    { name: 'contract_startdate', type: 'date'},
                    { name: 'contract_expdate', type: 'date'},
                    { name: 'total_amount_salary'},
                    { name: 'id_payroll_wo'},
                    { name: 'id_payroll_periode'},
                    { name: 'date_start', type: 'date'},
                    { name: 'date_finish' , type: 'date'},
                    { name: 'status_po'}
                ],
            id: 'id_payroll',
            url: url,
            root: 'data'
        };
        var cellsrenderer = function (id) {
        	return '<input type="button" onClick="buttonclick(event)" class="gridButton" id="' + id + '" value="Detail"/>'
        }
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
                    { text: 'Customer Name', dataField: 'customer_name'},
                    { text: 'Project Name', dataField: 'project_name'},
                    { text: 'Salary Period', dataField: 'periode_name'},
                    { text: 'Start Period', dataField: 'date_start', cellsformat: 'dd/MM/yyyy'},
                    { text: 'End Period', dataField: 'date_finish', cellsformat: 'dd/MM/yyyy'},
                    { text: 'Start Project', dataField: 'contract_startdate', cellsformat: 'dd/MM/yyyy'},
                    { text: 'End Project', dataField: 'contract_expdate', cellsformat: 'dd/MM/yyyy'},
                    { text: 'Amount', dataField: 'total_amount_salary',cellsformat: 'd',width:122},
                    { text: 'Status', dataField: 'status_po' },
                    { text: 'Detail', datafield: 'id_work_order', columntype: 'button', cellsrenderer: function () {
                        return "Detail";

                        },
                        buttonclick: function (row)
                            {
                             // open the popup window when the user clicks a button.
                                var editrow = row
                                var data = $('#jqxgrid').jqxGrid('getrowdata', editrow);

                                var data_post = {};

                                var date_start = data.date_start;
                                var date_finished = data.date_finish;

                                var param = [];
                                var item = {};

                                item['paramName'] = 'id';
                                item['paramValue'] = data.id_payroll_periode;
                                param.push(item);

                                item = {};
                                item['paramName'] = 'wo';
                                item['paramValue'] = data.id_work_order;
                                param.push(item);

                                item = {};
                                item['paramName'] = 'date_start';
                                item['paramValue'] = date_start.format('yyyy-mm-dd');
                                param.push(item);

                                item = {};
                                item['paramName'] = 'date_finished';
                                item['paramValue'] = date_finished.format('yyyy-mm-dd');
                                param.push(item);

                                load_content_ajax(GetCurrentController(), 'view_detail_payroll_period', data_post, param);
                            }
                    }
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