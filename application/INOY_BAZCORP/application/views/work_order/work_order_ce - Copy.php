<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    $('#work-order-tabs').jqxTabs({ width: '100%', autoHeight: false,position: 'top', scrollPosition: 'right'});
    $("#work-order-date").jqxDateTimeInput({width: '250px', height: '25px'}); 
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', value: null}); 
    
    <?php if(isset($is_edit)) :?>
    $("#work-order-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date'])) . "'" ?>);
    $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date_delivery'])) . "'" ?>);
    <?php endif; ?>
        
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
        url: url_unit,
        root: 'data'
    };
    
    var unitAdapter = new $.jqx.dataAdapter(unitSource, {
        autoBind: true
    });
    
    //=================================================================================
    //
    //   work_order Grid
    //
    //=================================================================================
    
    var url = "<?php if (isset($is_edit)):?><?php echo base_url()?>work_order/get_work_order_product_list?id=<?php echo $data_edit[0]['id_work_order']; ?> <?php endif; ?>";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_product'},
            { name: 'product_category'},
            { name: 'merk'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'name'},
            { name: 'unit_name', value: 'unit', values: { source: unitAdapter.records, value: 'id_unit_measure', name: 'name' } },
            { name: 'unit'},            
            { name: 'category_name'},
            { name: 'qty', type: 'number'}
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#work-order-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapter,
        editable: false,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Unit', dataField: 'unit_name'},
            { text: 'Qty Request', dataField: 'qty', cellsformat: 'd2', width: 100}
        ]
    });
    
    //=================================================================================
    //
    //   Survey Grid
    //
    //=================================================================================
    
    var urlSurvey = "<?php if (isset($is_edit)):?><?php echo base_url()?>work_order/get_work_order_survey_list?id=<?php echo $data_edit[0]['id_work_order']; ?> <?php endif; ?>";
    var sourceSurvey =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_work_order_survey'},
            { name: 'site_name'},
            { name: 'filename'},
            { name: 'remark'}
        ],
        id: 'id_work_order_survey',
        url: urlSurvey,
        root: 'data'
    };
    var dataAdapterSurvey = new $.jqx.dataAdapter(sourceSurvey);
    $("#survey-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        source: dataAdapterSurvey,
        selectionmode : 'singlerow',
        editable: false,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Filename', dataField: 'filename'},
            { text: 'Site', dataField: 'site_name'},
            { text: 'Remark', dataField: 'remark'}
        ]
    });
    
    //=================================================================================
    //
    //   Survey Grid
    //
    //=================================================================================
    
    var urlContract = "<?php if (isset($is_edit)):?><?php echo base_url()?>work_order/get_work_order_contract_list?id=<?php echo $data_edit[0]['id_work_order']; ?> <?php endif; ?>";
    var sourceContract =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_contract'},
            { name: 'filename'},
            { name: 'startdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'expdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'invoice_term'}
        ],
        id: 'id_contract',
        url: urlContract,
        root: 'data'
    };
    var dataAdapterContract = new $.jqx.dataAdapter(sourceContract);
    $("#contract-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        source: dataAdapterContract,
        selectionmode : 'singlerow',
        editable: false,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Filename', dataField: 'filename'},
            { text: 'Start Date', dataField: 'startdate', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'Expire Date', dataField: 'expdate', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'Invoice Term', dataField: 'invoice_term'}
        ]
    });

    
    //=================================================================================
    //
    //   procurement Grid
    //
    //=================================================================================
    
    var urlProc = "";
    var sourceProc =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_product'},
            { name: 'product_category'},
            { name: 'merk'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'name'},
            { name: 'unit_name', value: 'unit', values: { source: unitAdapter.records, value: 'id_unit_measure', name: 'name' } },
            { name: 'unit'},            
            { name: 'category_name'},
            { name: 'qty_request', type: 'number'},
            { name: 'qty_deliver', type: 'number'},
            { name: 'remark', type: 'string'},
            { name: 'status'}
        ],
        id: 'id_product',
        url: urlProc ,
        root: 'data'
    };
    
    var dataAdapterProc = new $.jqx.dataAdapter(sourceProc);
    $("#procurement-requirement-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterProc,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Unit', dataField: 'unit', displayfield: 'unit_name'},
            { text: 'Qty Request', dataField: 'qty_request', cellsformat: 'd2', width: 100}, 
            { text: 'Qty Deliver', dataField: 'qty_deliver', cellsformat: 'd2', width: 100},
            { text: 'Remark', dataField: 'remark'},
            { text: 'Status', dataField: 'status'}
        ]
    });
    
    //=================================================================================
    //
    //   Working Schedule Assignment Grid
    //
    //=================================================================================
    
    var urlWS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_schedule/get_work_schedule_detail_list/<?=$data_edit[0]['work_schedule']?><?php endif; ?>";
    var sourceWS =
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
            { name: 'qty_so', type: 'number'},
            { name: 'working_hour_type'},
            { name: 'working_hour_type_name', type: 'string'}
        ],
        id: 'id_employee',
        url: urlWS ,
        root: 'data'
    };
    var dataAdapterWS = new $.jqx.dataAdapter(sourceWS);
    $("#working-schedule-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterWS,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Site', dataField: 'site', displayfield: 'site_name', width: 100},
            { text: 'Area', dataField: 'area', width: 100},
            { text: 'Shift', dataField: 'shift_no', width: 100},
            { text: 'Working Hour', datafield: 'working_hour', width: 100},
            { text: 'Qty', dataField: 'qty', cellsformat: 'd2', width: 100},
            { text: 'Title', dataField: 'structure', width: 200}
        ]
    });
    
    $("#working-assignment-schedule-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Employee No.', dataField: 'employee_number', width: 100},
            { text: 'Name', dataField: 'full_name', width: 200},
            { text: 'Position', dataField: 'position', displayfield: 'position_name', width: 100},
            { text: 'Position Level', dataField: 'position_level', displayfield: 'position_level_name', width: 100},
            { text: 'Shift', dataField: 'shift1', width: 100},
            { text: 'Status', dataField: 'status', width: 100},
            { text: 'Remark', dataField: 'remark', width: 200}
        ]
    });
    
    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft'): ?>
    $("#make-so-assignment").on('click', function(e){
        var data_post = {};
        data_post['id_work_schedule'] = $("#id_work_schedule").val();
        load_content_ajax(GetCurrentController(), 268, data_post);
        e.preventDefault();
    });
    <?php endif; ?>
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
    load_content_ajax(GetCurrentController(), 129, null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_work_order" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_work_order'] : '') ?>" />
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
            <span class="label">Open</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'withdrawn' ? 'class="status-active"' : '') ?>>
            <span class="label">Withdrawn</span>
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
    <div><h1 style="font-size: 18pt; font-weight: bold;">Work Order / <span><?php echo (isset($is_edit) ? $data_edit[0]['work_order_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="work-order-date" style="display: inline-block;"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                           Expected Delivery Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="delivery-date" style="display: inline-block;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            SO Ref.
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="so-number" name="so_number" value="<?php echo (isset($is_edit) ? $data_edit[0]['so_number'] : '') ?>" readonly="readonly"/>
                            <input name="so" type="hidden" value="<?php echo (isset($is_edit) ? $data_edit[0]['so'] : '') ?>"/>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Customer
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-name" name="customer_name" value="<?php echo (isset($is_edit) ? $data_edit[0]['customer_name'] : '') ?>" readonly="readonly"/>
                            <input name="customer" type="hidden" value="<?php echo (isset($is_edit) ? $data_edit[0]['customer'] : '') ?>"/>
                        </div>
                    </td>
                </tr>                
            </table>
            <div id='work-order-tabs' style="margin-top: 20px;">
                <ul>
                    <li>Product & Services</li>
                    <li>Survey / Assessment</li>
                    <li>Contract</li>
                    <li>Purchase Requirement</li>    
                    <li>Working Schedule</li>                                         
                </ul>
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div id="work-order-grid"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 80%;padding-top: 20px;" colspan="2">
                                <div class="label">
                                    Notes
                                </div>
                                <textarea class="field" cols="10" rows="20" style="height: 50px;"></textarea>
                            </td>
                        </tr>                        
                    </table>
                </div>
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div id="survey-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div id="contract-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div> 
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div id="procurement-requirement-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>  
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">                       
                                 <div class="row-color" style="width: 100%;">
                                    <span>Working Schedule</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="working-schedule-grid"></div>
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2">                       
                                 <div class="row-color" style="width: 100%;">
                                    <span>SO Assignment</span>
                                    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft'): ?>
                                    <input id="id_work_schedule" value="<?=$data_edit[0]['work_schedule']?>" type="hidden">
                                    <button id="make-so-assignment">Make SO Assignment</button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="working-assignment-schedule-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>                             
            </div>
        </div>
    </div>
</div>
