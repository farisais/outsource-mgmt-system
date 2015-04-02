<script>
function buttonclick(){
    
    var id = event.target.id;
    var data = $('#jqxgrid').jqxGrid('getrowdata', id);
    var data_post = {};
    data_post['id_work_order'] = data.id_work_order;
    data_post['date_start'] = data.date_start;
    data_post['date_finished'] = data.date_finish;
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
                    { name: 'contract_startdate'},
                    { name: 'contract_expdate'},
                    { name: 'total_amount_salary'},
                    {name:'id_payroll_wo'},
                    {name:'date_start'},
                    {name:'date_finish'}
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
                    { text: 'Start Period', dataField: 'date_start'},
                    { text: 'End Period', dataField: 'date_finish'},
                    { text: 'Start Project', dataField: 'contract_startdate'},
                    { text: 'End Project', dataField: 'contract_expdate'},
                    { text: 'Amount', dataField: 'total_amount_salary',cellsformat: 'd',width:122},
                    { text: 'Detail',width:58,cellsalign:'center', dataField: 'id_work_order', cellsrenderer: cellsrenderer }]
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