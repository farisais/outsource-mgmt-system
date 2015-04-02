<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    $("#period-start-date").jqxDateTimeInput({width: '250px', height: '25px'});
    $("#period-end-date").jqxDateTimeInput({width: '250px', height: '25px', value: null}); 
    <?php if (isset($is_edit)) :?>
    $("#period-start-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['period_start'])) . "'" ?>);
    $("#period-end-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['period_end'])) . "'" ?>);
    <?php endif; ?>

    $("#clear-period-end-date").click(function(){
        $("#period-end-date").val(<?php echo (isset($is_edit)) ? "'" . date( 'd/m/Y' , strtotime($data_edit[0]['period_end'])) . "'" : 'null' ?>);
    });
    
    $("#select-quotation-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#copy-schedule-popup").jqxWindow({
        width: 250, height: 150, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#qty-copy").jqxNumberInput({ width: '100px', height: '25px', inputMode: 'simple', spinButtons: true });
    
    $("#copy-schedule").click(function(){
        var selectedrowindex = $("#work-schedule-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            $("#copy-schedule-popup").jqxWindow('open');
        }
        else
        {
            alert('Please select row you want to copy');
        }
    });
    
    
    
    //=================================================================================
    //
    //   Unit Measure Data
    //
    //=================================================================================
    
    var url_unit = "<?php echo base_url() ;?>unit_measure/get_unit_measure_list";
    var unitSource =
    {
         datatype: "json",
         datafields: [
             { name: 'id_unit_measure'},
             { name: 'name'}
         ],
        id: 'id_unit_measure',
        url: url_unit ,
        root: 'data'
    };
    
    var unitAdapter = new $.jqx.dataAdapter(unitSource, {
        autoBind: true
    });
    
    
    //=================================================================================
    //
    //   quotation Grid
    //
    //=================================================================================
    
    var urlquotation = "<?php echo base_url() ;?>quotation/get_quotation_list?status=draft";
    var sourcequotation =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_quotation'},
            { name: 'quote_date', type: 'date'},
            { name: 'quote_number'},
            { name: 'status'},
            { name: 'customer_name'},
            { name: 'customer'}
        ],
        id: 'id_quotation',
        url: urlquotation ,
        root: 'data'
    };
    var dataAdapterquotation = new $.jqx.dataAdapter(sourcequotation);    

    $("#select-quotation-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });

    $("#select-quotation-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 450,
        source: dataAdapterquotation,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        filterable: true,
        showfilterrow: true,
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Quotation No.', dataField: 'quote_number', width: 200},
            { text: 'Date', dataField: 'quote_date', cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
            { text: 'Customer', dataField: 'customer_name'},
            { text: 'Status', dataField: 'status', width: 100}
        ]
    });
    
    $("#quotation-select").click(function(){
        $("#select-quotation-popup").jqxWindow('open');
    });

    $("#quote-number").jqxInput({ source: dataAdapterquotation, displayMember: "name", valueMember: "id_quotation", height: 23});
    <?php if (isset($is_edit)): ?>
    $("#quote-number").jqxInput('val', {label: '<?php echo $data_edit[0]['quote_number'] ?>', value: '<?php echo $data_edit[0]['quotation']?>'});
    <?php endif; ?>
    <?php if ($make_quotation) :?>
    $("#quote-number").jqxInput('val', {label: '<?=$make_quotation[0]['quote_number'] ?>', value: '<?=$make_quotation[0]['id_quotation']?>'});
    <?php endif; ?>        
    $("#quote-number").change(function(){
        var id = $(this).val().value;
    });

    $('#select-quotation-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-quotation-grid').jqxGrid('getrowdata', args.rowindex);
        $('#quote-number').jqxInput('val', {label: data.quote_number, value: data.id_quotation});
        $("#select-quotation-popup").jqxWindow('close');
        var dataAdapterSites = getSites(data.customer);
        $("#work-schedule-grid").jqxGrid({
            columns: setWorkScheduleColumn(dataAdapterSites)
        });        
    });

    
    //=================================================================================
    //
    //   work schedule Grid
    //
    //=================================================================================
    var shifts = [
        {label: '1', value: '1'},
        {label: '2', value: '2'},
        {label: '3', value: '3'}        
    ];
    var shiftsSource = {
        datatype: "array",
        datafields: [
            { name: 'label', type: 'string' },
            { name: 'value', type: 'string' }
        ],
        localdata: shifts
    };
    var shiftsAdapter = new $.jqx.dataAdapter(shiftsSource, {
        autoBind: true
    });
    var hours = [
        {label: '8 Hours', value: '8'},
        {label: '12 Hours', value: '12'}
    ];
    var hoursSource = {
        datatype: "array",
        datafields: [
            { name: 'label', type: 'string' },
            { name: 'value', type: 'string' }
        ],
        localdata: hours
    };
    var hoursAdapter = new $.jqx.dataAdapter(hoursSource, {
        autoBind: true
    });
    
    var urlStructures = "<?php echo base_url() ;?>organisation_structure/get_organisation_structure_service";
    var structuresSource = {
        datatype: "json",
        datafields:
        [
            { name: 'id_organisation_structure'},
            { name: 'structure_name'}
        ],
        id: 'id_organisation_structure',
        url: urlStructures
    };
    var structuresAdapter = new $.jqx.dataAdapter(structuresSource);
    structuresAdapter.dataBind();
    $("#add-schedule").click(function(){
        var row = {};
        row['site'] = null;
        row['area'] = null;
        row['shift1'] = null;
        row['working_hour_type'] = null;
        row['remark'] = null;
        var commit0 = $("#work-schedule-grid").jqxGrid('addrow', null, row);
    });
    
    $("#remove-schedule").click(function(){
        var selectedrowindex = $("#work-schedule-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#work-schedule-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#work-schedule-grid").jqxGrid('deleterow', id);
        }
    });
    var url = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_schedule/get_work_schedule_detail_list/<?=$data_edit[0]['id_work_schedule']?><?php endif; ?>";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_detail_work_schedule'},
            { name: 'area'},
            { name: 'id_customer_site'},
            { name: 'site'},
            { name: 'site_name'},
            { name: 'shift_no'},
            { name: 'shift_name', value: 'shift_no', values: { source: shiftsAdapter.records, value: 'value', name: 'label' }},
            { name: 'qty', type: 'number'},
            { name: 'working_hour'},
            { name: 'working_hour_name', value: 'working_hour', values: { source: hoursAdapter.records, value: 'value', name: 'label' }},
            { name: 'structure'},
            { name: 'structure_name'}
        ],
        id: 'id_detail_work_schedule',
        url: url,
        root: 'data'
    };
    
    <?php if ($make_quotation) :?>
    var dataAdapterSites = getSites(<?=$make_quotation[0]['customer']?>);
    <?php else: ?>
        <?php if ($is_edit) :?>
        var dataAdapterSites = getSites(<?=$data_edit[0]['customer']?>);
        <?php else: ?>
        var dataAdapterSites = null;
        <?php endif; ?>
    <?php endif; ?>

    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#work-schedule-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapter,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        columns: setWorkScheduleColumn(dataAdapterSites)
    });
    
    $("#work-schedule-grid").on('cellvaluechanged', function (event) 
    {
        
    });
    
    $('#work-schedule-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#work-schedule-grid').jqxGrid('getrowdata', args.rowindex);
        //alert(JSON.stringify(data));
    });
    
    $("#apply-copy").click(function(){
        var rowdata = null;
        var selectedrowindex = $("#work-schedule-grid").jqxGrid('getselectedrowindex');
 
        rowdata = $("#work-schedule-grid").jqxGrid('getrowdata', selectedrowindex);
        var qty = $("#qty-copy").val();
        var i;
        for(i=0;i<qty;i++)
        {
            var commit0 = $("#work-schedule-grid").jqxGrid('addrow', null, rowdata);
        }
        
        $("#copy-schedule-popup").jqxWindow('close');
    });
    
    function getSites(id)
    {
        var site_url = '<?php echo base_url() ?>';
        var urlSites = site_url + "customer/get_customer_site_list/" + id;
        var sourceSites =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_customer_site'},
                { name: 'site_name'},
                { name: 'address'},
                { name: 'city'},
                { name: 'city_name'}
            ],
            id: 'id_customer_site',
            url: urlSites ,
            root: 'data'
        };
        
         var dataAdapterSites = new $.jqx.dataAdapter(sourceSites);
         return dataAdapterSites;
    }
    
    function setWorkScheduleColumn(adapter)
    {
        return [
            { text: 'Site', dataField: 'id_customer_site', displayfield: 'site_name', columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: adapter, displayMember: 'site_name', valueMember: 'id_customer_site' });
                }
            },
            { text: 'Area', dataField: 'area'},
            { text: 'Shift', dataField: 'shift_no', columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: shiftsAdapter, displayMember: 'shift_no', valueMember: 'value' });
                }
            },
            { text: 'Working Hour', datafield: 'working_hour', displayfield: 'working_hour_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: hoursAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: 'Qty', datafield: 'qty', width: 75},
            { text: 'Title', datafield: 'structure', displayfield: 'structure_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: structuresAdapter, displayMember: 'structure_name', valueMember: 'id_organisation_structure' });
                }
            }
        ];
    }
});

function SaveData()
{
    var data_post = {};
    
    data_post['is_edit'] = $("#is_edit").val();
    data_post['id_work_schedule'] = $("#id_work_schedule").val();
    data_post['quotation'] = $("#quote-number").val().value;
    data_post['period-start-date'] = $("#period-start-date").val('date').format('yyyy-mm-dd');
    data_post['period-end-date'] = $("#period-end-date").val('date').format('yyyy-mm-dd');
    data_post['notes'] = $("#notes").val();
    data_post['schedules'] = $('#work-schedule-grid').jqxGrid('getrows');
    
    load_content_ajax(GetCurrentController(), 148, data_post);
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 144, null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_work_schedule" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_work_schedule'] : '') ?>" />
<div class="document-action">
    <button id="po-validate">Validate</button>
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
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'open' ? 'class="status-active"' : '') ?>>
            <span class="label">In Quote</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'close' ? 'class="status-active"' : '') ?>>
            <span class="label">Running</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'close' ? 'class="status-active"' : '') ?>>
            <span class="label">Close</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;">Work Schedule / <span><?php echo (isset($is_edit) ? $data_edit[0]['po_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
            <tr>
                <td>
                    <div class="label">
                        Quotation Order
                    </div>
                    <div class="column-input">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="quote-number" name="quote_number" value="" readonly="readonly"/>
                        <?php if (!isset($is_edit) && !$make_quotation): ?> <button id="quotation-select">...</button> <?php endif; ?>
                    </div>
                </td>
                <td></td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Period Start
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="period-start-date" style="display: inline-block;"></div><!--<button style="top: -10px;margin-left: 5px;display: inline-block;position: relative;" id="clear-period-start-date">C</button> -->
                        </div>
                    </td>
                    <td>
                        <div class="label">
                           Period End  
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="period-end-date" style="display: inline-block;"></div><button style="top: -10px;margin-left: 5px;display: inline-block;position: relative;" id="clear-period-end-date">C</button>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td colspan="2">                       
                         <div class="row-color" style="width: 100%;">
                            <button style="width: 30px;" id="add-schedule">+</button>
                            <button style="width: 30px;" id="remove-schedule">-</button>
                            <div style="display: inline;"><span>Add / Remove Schedule</span></div>
                            <button style="width: 30px;float: right;" id="copy-schedule">...</button>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td colspan="2"> 
                        <div id="work-schedule-grid"></div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 80%;padding-top: 20px;" colspan="2">
                        <div class="label">
                            Notes
                        </div>
                        <textarea class="field" id="notes" name="notes" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['notes'] : '') ?></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div id="select-quotation-popup">
    <div>Select Quotation Order</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-quotation-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="copy-schedule-popup">
    <div>Copy Schedule</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%">
                    Number Copy
                </td>
                <td style="width: 80%">
                    <div id="qty-copy" /></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button id="apply-copy" style="width: 100px;">Copy</button>
                </td>
            </tr>
        </table>
    </div>
</div>