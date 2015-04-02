<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    var shifts = [
        {label: '1', value: '1'},
        {label: '2', value: '2'},
        {label: '3', value: '3'}        
    ];
    var hours = [
        {label: '8 Hours', value: '8'},
        {label: '12 Hours', value: '12'}
    ];
    var structures = [
        {label: 'Security Office', value: '1'}, 
        {label: 'Shift Leader', value: '2'}, 
        {label: 'Security Supervisor', value: '3'}
    ];
    
    var detailFields = 
        [
            { name: 'id_detail_work_schedule'},
            { name: 'area'},
            { name: 'id_customer_site'},
            { name: 'site'},
            { name: 'site_name'},
            { name: 'shift_no'},
            { name: 'shift_name', value: 'shift_no', values: { source: shifts, value: 'value', name: 'label' }},
            { name: 'qty', type: 'number'},
            { name: 'working_hour'},
            { name: 'working_hour_name', value: 'working_hour', values: { source: hours, value: 'value', name: 'label' }},
            { name: 'structure'},
            { name: 'structure_name', value: 'structure', values: { source: structures, value: 'value', name: 'label' }}
        ];
    
    $("#select-work-schedule-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
    });    
    
    $("#work-schedule-select").click(function(){
        $("#select-work-schedule-popup").jqxWindow('open');
    });
    
    $("#select-employee-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    var urlWorkSchedule = "<?php echo base_url() ;?>work_schedule/get_work_schedule_list";
    var sourceWorkSchedule =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_work_schedule'},
            { name: 'work_schedule_number'},
            { name: 'period_start', type: 'date'},
            { name: 'period_end', type: 'date'},
            { name: 'quote_number'},
            { name: 'customer'},
            { name: 'customer_name'},
            { name: 'status' }
        ],
        id: 'id_work_schedule',
        url: urlWorkSchedule,
        root: 'data'
    };
    var dataAdapterWorkSchedule = new $.jqx.dataAdapter(sourceWorkSchedule);
    
    $("#work-schedule").jqxInput({ source: dataAdapterWorkSchedule, displayMember: "work_schedule_number", valueMember: "id_work_schedule", height: 23});
    <?php if ($make_work_order) :?>
    $("#work-schedule").jqxInput('val', {label: '<?=$make_work_order[0]['work_schedule_number'] ?>', value: '<?=$make_work_order[0]['id_work_schedule']?>'});
    $('#period-start').val("<?=$make_work_order[0]['period_start']?>");
    $('#period-end').val("<?=$make_work_order[0]['period_end']?>");    
    <?php endif; ?>
    $("#select-work-schedule-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapterWorkSchedule,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Number', dataField: 'work_schedule_number'},
            { text: 'Period Start', dataField: 'period_start',  width: 150, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
            { text: 'Period End', dataField: 'period_end', width: 150, cellsformat: 'dd/MM/yyyy',filtertype: 'date'}
        ]
    });
    
    $('#select-work-schedule-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-work-schedule-grid').jqxGrid('getrowdata', args.rowindex);
        $('#work-schedule').jqxInput('val', {label: data.work_schedule_number, value: data.id_work_schedule});
        $('#period-start').val(data.period_start.format('dd/mm/yyyy'));
        $('#period-end').val(data.period_end.format('dd/mm/yyyy'));
        $("#select-work-schedule-popup").jqxWindow('close');
    });    
    
    //=================================================================================
    //
    //   Working Schedule Detail Grid
    //
    //=================================================================================
    var urlDetail = "<?php echo base_url() ;?>work_schedule/get_work_schedule_detail_list/2";
    // var urlDetail = "";
    var sourceDetail =
    {
        datatype: "json",
        datafields: detailFields,
        id: 'id_detail_work_schedule',
        url: urlDetail
    };
    var dataAdapterDetail = new $.jqx.dataAdapter(sourceDetail);
    dataAdapterDetail.dataBind();
    $("#working-schedule-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterDetail,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Site', dataField: 'site', displayfield: 'site_name', width: 100},
            { text: 'Area', dataField: 'area'},
            { text: 'Shift', dataField: 'shift_no', width: 100},
            { text: 'Working Hour', datafield: 'working_hour', displayfield: 'working_hour_name', width: 100},
            { text: 'Qty', dataField: 'qty', width: 100},
            { text: 'Title', dataField: 'structure', displayfield: 'structure_name', width: 200}
        ]
    });
    
    //=================================================================================
    //
    //   Employee Grid
    //
    //=================================================================================
    var urlEmployee = "<?php echo base_url() ;?>so_assignment/get_so_assignment_employee_list";
    var sourceEmployee =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_detail_so_assignment'},
            { name: 'so_assignment'},
            { name: 'detail_work_schedule'},
            { name: 'employee'},
            { name: 'employee_number'},
            { name: 'full_name'},
            { name: 'employee_type'}
        ],
        id: 'id_detail_so_assignment',
        url: urlEmployee,
        root: 'data'
    };
    var dataAdapterEmployee = new $.jqx.dataAdapter(sourceEmployee);
    dataAdapterEmployee.dataBind();
    
    $('#working-schedule-grid').on('rowclick', function (event) 
    {
        var args = event.args;
        var data = $('#working-schedule-grid').jqxGrid('getrowdata', args.rowindex);
        
        // alert(data.id_detail_work_schedule);
        var records = new Array();
        var length = dataAdapterEmployee.records.length;        
        for (var i = 0; i < length; i++) {
            var record = dataAdapterEmployee.records[i];
            if (record.detail_work_schedule == data.id_detail_work_schedule) {
                records[records.length] = record;
            }
        }
        // alert(JSON.stringify(records));
        var dataSource = {
            datafields: 
            [
                { name: 'id_detail_so_assignment'},
                { name: 'so_assignment'},
                { name: 'detail_work_schedule'},
                { name: 'employee'},
                { name: 'employee_number'},
                { name: 'full_name'},
                { name: 'employee_type'}
            ],
            localdata: records
        };
        var adapter = new $.jqx.dataAdapter(dataSource);
        // update data source.
        $("#employee-grid").jqxGrid({ source: adapter });
    });
    /*
    $("#working-schedule-grid").on('rowselect', function (event) {
        
        var args = event.args;
        var data = $('#select-work-schedule-grid').jqxGrid('getrowdata', args.rowindex);
        alert(JSON.stringify(event.args));
        var detailWSID = data.id_detail_work_schedule;
        var records = new Array();
        var length = dataAdapterEmployee.records.length;
        for (var i = 0; i < length; i++) {
            var record = dataAdapterEmployee.records[i];
            if (record.detail_work_schedule === detailWSID) {
                records[records.length] = record;
            }
            var dataSource = {
                datafields: 
                [
                    { name: 'id_detail_so_assignment'},
                    { name: 'so_assignment'},
                    { name: 'detail_work_schedule'},
                    { name: 'employee'},
                    { name: 'employee_number'},
                    { name: 'full_name'},
                    { name: 'employee_type'}
                ],
                localdata: records
            };
            var adapter = new $.jqx.dataAdapter(dataSource);
            // update data source.
            $("#employee-grid").jqxGrid({ source: adapter });
        }
    });
    */
    
    $("#employee-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        /* source: dataAdapterEmployee, */
        selectionmode : 'singlerow',
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        keyboardnavigation: false,
        filterable: true,
        showfilterrow: true,
        rendertoolbar: function (toolbar) {
            $("#add-employee").click(function(){
                var offset = $("#remove-employee").offset();
                $("#select-employee-popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-employee").width() + 20, y: parseInt(offset.top)} });
                $("#select-employee-popup").jqxWindow('open');
            });
            $("#remove-employee").click(function(){
                var selectedrowindex = $("#employee-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#employee-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#employee-grid").jqxGrid('deleterow', id);
                }
                
            });
        },
        columns: [
            { text: 'Number', dataField: 'employee_number', width: 150},
            { text: 'Full name', dataField: 'full_name'},
            { text: 'Type', dataField: 'employee_type', width: 150}
        ]
    });
    // $("#working-schedule-grid").jqxGrid('selectrow', 0);

    //=================================================================================
    //
    //   Select employee Grid
    //
    //=================================================================================
    var url_select_employee = "<?php echo base_url() ;?>employee/get_employee_list";
    var source_select_employee =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_employee'},
            { name: 'employee_number'},
            { name: 'full_name'},
            { name: 'employment_type'},
            { name: 'employment_type_name'},
            { name: 'employee_status'},
            { name: 'employee_status_name'},
            { name: 'employee_contract_type'},
            { name: 'employee_contract_type_name'}
        ],
        id: 'id_employee',
        url: url_select_employee ,
        root: 'data'
    };
    var dataAdapter_select_employee = new $.jqx.dataAdapter(source_select_employee);
    
    $("#select-employee-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_employee,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Employee ID', dataField: 'employee_number', width: 200},
            { text: 'Full Name', dataField: 'full_name'},
            { text: 'Type', dataField: 'employment_type_name', width: 200}
        ]
    });
});

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    data_post['action_detail'] = $('#action-assigned-grid').jqxGrid('getrows');
    
    //load_content_ajax(GetCurrentController(), 20, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 109 , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_work_schedule" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_so_assignment'] : '') ?>" />
<div class="document-action">
    <button id="so-assign-button">Assign</button>
    <button id="po-validate">Unassign</button>
    <ul class="document-status">
        <li <?php 
            if(isset($is_edit))
            {
                if($data_edit[0]['status'] == 'draft')
                {
                    echo 'class="status-active"';
                }
            }
            else
            {
                echo 'class="status-active"';
            }
        ?> >
            <span class="label">Available</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'open' ? 'class="status-active"' : '') ?>>
            <span class="label">Waiting Assignment</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'close' ? 'class="status-active"' : '') ?>>
            <span class="label">Assigned</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;">SO Assignment / <span><?php echo (isset($is_edit) ? $data_edit[0]['po_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Work Schedule
                        </div>
                        <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="work-schedule" name="work_schedule" value="" readonly="readonly"/>
                        <?php if (!isset($is_edit) && !$make_work_order): ?> <button id="work-schedule-select">...</button> <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Period Start
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="period-start" name="period_start" value="<?php echo (isset($is_edit) ? $data_edit[0]['period_start'] : '') ?>" readonly="readonly"/>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Period End
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="period-end" name="period_end" value="<?php echo (isset($is_edit) ? $data_edit[0]['period_end'] : '') ?>" readonly="readonly"/>
                        </div>
                    </td>
                </tr>                
            </table>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="row-color" style="width: 100%; padding: 3px;">
                            <span>Working Schedule</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="working-schedule-grid"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                         <div class="row-color" style="width: 100%; padding: 3px;">
                            <button style="width: 30px;" id="add-employee">+</button>
                            <button style="width: 30px;" id="remove-employee">-</button>                             
                            <span>Employee</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="employee-grid"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div id="select-work-schedule-popup">
    <div>Select Inquiry</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-work-schedule-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="select-employee-popup">
    <div>Select Employee</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-employee-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
