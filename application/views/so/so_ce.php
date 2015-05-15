<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
var linkrenderer_survey = function (row, column, value) {
    return '<div style="margin: 4px;" class="jqx-left-align"><a href="' + '<?php echo base_url() ?>survey_assessment/download_file/' + value + '" target="_blank" style="padding: 2px">' + value + '</a></div>';
};
var linkrenderer_contract = function (row, column, value) {
    return '<div style="margin: 4px;" class="jqx-left-align"><a href="' + '<?php echo base_url() ?>contract/download_file/' + value + '" target="_blank" style="padding: 2px">' + value + '</a></div>';
};
function view_tab_cost_element(id)
{
    //alert(id);
    /*var url = "<?php echo base_url() ;?>quotation/get_cost_element/"+id;
    var source =
        {
            datatype: "json",
            datafields:
            [
                { name: 'quotation_cost_element_id'},
                { name: 'structure_name'},
                { name: 'name'},
                { name: 'description'},
                { name: 'notes'},
                { name:'total'}
                
            ],
            id: 'quotation_cost_element_id',
            url: url,
            root: 'data'
        };
        
        var urlDetail = "<?php echo base_url() ;?>quotation/get_cost_element_detail";
        var sourceDetail =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id'},
                { name: 'quotation_cost_element_id'},
                { name: 'item'},
                { name: 'nominal'},
                { name: 'persentase'},
                { name: 'recipient'},
                { name: 'remarks'}
            ],
            url: urlDetail,
            root: 'data',
            async: false
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        var dataDetailAdapter = new $.jqx.dataAdapter(sourceDetail, {autoBind: true});
        var orders = dataDetailAdapter.records;
        //alert(JSON.stringify(orders.toString()));
        var nestedGrids = new Array();
        var initrowdetails = function(index, parentElement, gridElement, record)
        {
            var id = record.uid.toString();
            var grid = $($(parentElement).children()[0]);
            nestedGrids[index] = grid;
            var filtergroup = new $.jqx.filter();
            var filter_or_operator = 1;
            var filtervalue = id;
            var filtercondition = 'equal';
            var filter = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
            // fill the orders depending on the id.
            var ordersbyid = [];
            for (var m = 0; m < orders.length; m++) 
            {
                //alert(JSON.stringify(orders[m]));
                var result = filter.evaluate(orders[m]["quotation_cost_element_id"]);
                if (result)
                {
                    ordersbyid.push(orders[m]);
                }
            }
            var orderssource = {
                datafields:
                [
                    { name: 'id'},
                    { name: 'quotation_cost_element_id'},
                    { name: 'item'},
                    { name: 'nominal'},
                    { name: 'persentase'},
                    { name: 'recipient'},
                    { name: 'remarks'}
                ],
                id: 'id',
                localdata: ordersbyid
            }
            var nestedGridAdapter = new $.jqx.dataAdapter(orderssource);
            if (grid != null) {
                grid.jqxGrid({
                    theme: $("#theme").val(),
                    source: nestedGridAdapter, width: '90%', height: 150,
                    columns: [
                      { text: 'Item', datafield: 'item'},
                      { text: 'Nominal', datafield: 'nominal', width: 150},
                      { text: 'Persentase', datafield: 'persentase', width: 150},
                      { text: 'Recipient', datafield: 'recipient' },
                      { text: 'Remarks', datafield: 'remarks'},
                   ]
                });
            }
        }
        
        $("#cost_element_grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: '100%',
            source: dataAdapter,
            rowdetails: true,
            groupable: true,
            columnsresize: true,
            autoshowloadelement: false,                                                                                
            filterable: true,
            showfilterrow: true,
            sortable: true,
            autoshowfiltericon: true,
            initrowdetails: initrowdetails,
            rowdetailstemplate: { rowdetails: "<div id='grid' style='margin: 10px;'></div>", rowdetailsheight: 200, rowdetailshidden: true },
            ready: function () {
               
            },
            columns: [
                { text: 'Struktur Name', dataField: 'structure_name', width: 150},
                { text: 'Level', dataField: 'name'},
                { text: 'Description', dataField: 'description'}, 
                { text: 'total', dataField: 'total'},
                
            ],
            rendertoolbar: function (toolbar) {
            $("#add_cost_element").click(function(){
                load_content_ajax(GetCurrentController(), 401, dataPost());
            });
            
            }
        });*/
    //=================================================================================
    //
    //   CE Assign Grid
    //
    //=================================================================================

    var celink = function (row, column, value) {
        return '<div style="margin: 4px;" class="jqx-left-align"><a href="#" style="padding: 2px">' + value + '</a></div>';
    };

    var url_ce = "<?php if(isset($is_edit)){?><?php echo base_url() ;?>quotation/get_structure_ws_from_quote/<?php echo $data_edit[0]['quotation'] ?><?php } ?>";
    var source_ce =
    {
        datatype: "json",
        datafields:
            [
                { name: 'structure'},
                { name: 'structure_name'},
                { name: 'cost_element'},
                { name: 'cost_element_name'}
            ],
        id: 'structure',
        url: url_ce,
        root: 'data'
    };

    var dataAdapterCE = new $.jqx.dataAdapter(source_ce);

    $("#ce-assign-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 200,
            source: dataAdapterCE,
            columnsresize: true,
            autoshowloadelement: false,
            sortable: true,
            columns: [
                { text: 'Position', dataField: 'structure', displayfield: 'structure_name', width: 150},
                { text: 'Cost Element', dataField: 'cost_element', displayfield: 'cost_element_name', cellsrenderer: celink}
            ]
        });

    $("#ce-assign-grid").on('cellclick', function(event){
        var args = event.args;
        if(args.value != null && args.datafield == 'cost_element')
        {
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = args.value;
            param.push(item);
            load_content_ajax(GetCurrentController(), 'view_detail_cost_element' , {}, param, true);
        }
        //alert(args.value);
    });
}  
$(document).ready(function(){
    
    $('#so-tabs').jqxTabs({ width: '100%', position: 'top', scrollPosition: 'right'});
    $("#so-date").jqxDateTimeInput({width: '250px', height: '25px'}); 
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', value: null}); 
    <?php if(isset($is_edit)) :?>
    $("#so-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date'])) . "'" ?>);
    $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date_delivery'])) . "'" ?>);
    <?php endif; ?>
    
    $("#clear-delivery-date").click(function(){
        <?php if(!isset($is_edit)) :?> $("#delivery-date").val(null);
        <?php else: ?> $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date_delivery'])) . "'" ?>); <?php endif; ?>
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
        url: url_unit,
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
    
    $("#so-grid").on("bindingcomplete", function(event){
        var culture = {};
        culture.currencysymbol = "Rp. ";
        $("#so-grid").jqxGrid('localizestrings', culture);
        
        var rows = $("#so-grid").jqxGrid('getrows');
        var amount = 0;
        for(var i=0;i<rows.length;i++)
        {
            amount += rows[i].price * rows[i].qty;
        }
        var culture = {};
        culture.currencysymbol = "Rp. ";
        culture.currencysymbolposition = "before";
        culture.decimalseparator = '.';
        culture.thousandsseparator = ',';
        $("#untaxed-amount").html(dataAdapter.formatNumber(amount, "c2", culture));
        var tax = 0;
        if($("#use-tax").is(":checked"))
        {
            tax = amount * 0.1;
        }
        $("#tax-amount").html(dataAdapter.formatNumber(tax, "c2", culture));
        $("#total-amount").html(dataAdapter.formatNumber((tax + amount), "c2", culture));
        
        $("#subtotal-value").val(amount);
        $("#tax-value").val(tax);
        $("#total-value").val((tax + amount));
    });

    var url = "<?php if (isset($is_edit)):?><?php echo base_url()?>so/get_so_product_list?id=<?php echo $data_edit[0]['id_so']; ?> <?php endif; ?>";
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
            { name: 'qty', type: 'number'},
            { name: 'price', type: 'number'},
            { name: 'total_price', type: 'number'}
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#so-grid").jqxGrid(
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
        columns: [
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Unit', dataField: 'unit', displayfield: 'unit_name'},
            { text: 'Quantity', dataField: 'qty', cellsformat: 'd2'}, 
            { text: 'Unit Price', dataField: 'price',cellsformat: 'c2'},
            { text: 'Total Price', dataField: 'total_price', 
                cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                    var total = parseFloat(rowdata.price) * parseFloat(rowdata.qty);
                    var culture = {};
                    culture.currencysymbol = "Rp. ";
                    culture.currencysymbolposition = "before";
                    culture.decimalseparator = '.';
                    culture.thousandsseparator = ',';
                    return "<div style='margin: 4px;' class='jqx-right-align'>" + dataAdapter.formatNumber(total, "c2", culture) + "</div>";
                }
            }
        ]
    });

    $("#so-grid").on('rowdoubleclick', function(event){
        var args = event.args;
        alert(JSON.stringify($(this).jqxGrid('getrowdata', args.rowindex)));
    });
    
    $("#so-grid").on('cellvaluechanged', function (event) 
    {
        var rows = $("#so-grid").jqxGrid('getrows');
        var amount = 0;
        for(var i=0;i<rows.length;i++)
        {
            amount += rows[i].price * rows[i].qty;
        }
        var culture = {};
        culture.currencysymbol = "Rp. ";
        culture.currencysymbolposition = "before";
        culture.decimalseparator = '.';
        culture.thousandsseparator = ',';
        $("#untaxed-amount").html(dataAdapter.formatNumber(amount, "c2", culture));
        var tax = 0;
        if($("#use-tax").is(":checked"))
        {
            tax = amount * 0.1;
        }
        
        $("#tax-amount").html(dataAdapter.formatNumber(tax, "c2", culture));
        $("#total-amount").html(dataAdapter.formatNumber((tax + amount), "c2", culture));
        
        $("#subtotal-value").val(amount);
        $("#tax-value").val(tax);
        $("#total-value").val((tax + amount));
    });
    
    $("#use-tax").click(function(){
        var rows = $("#so-grid").jqxGrid('getrows');
        var amount = 0;
        for(var i=0;i<rows.length;i++)
        {
            amount += rows[i].price * rows[i].qty;
        }
        var culture = {};
        culture.currencysymbol = "Rp. ";
        culture.currencysymbolposition = "before";
        culture.decimalseparator = '.';
        culture.thousandsseparator = ',';
        $("#untaxed-amount").html(dataAdapter.formatNumber(amount, "c2", culture));
        var tax = 0;
        if($("#use-tax").is(":checked"))
        {
            tax = amount * 0.1;
        }
        $("#tax-amount").html(dataAdapter.formatNumber(tax, "c2", culture));
        $("#total-amount").html(dataAdapter.formatNumber((tax + amount), "c2", culture));
        
        $("#subtotal-value").val(amount);
        $("#tax-value").val(tax);
        $("#total-value").val((tax + amount));
    });

    $("#so-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#so-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    $("#so-grid").jqxGrid('setcolumnproperty', 'total_price', 'editable', false);
    
    //=================================================================================
    //
    //   Survey Grid
    //
    //=================================================================================
    <?php if (isset($is_edit)): ?>
    id_quot="<?=$data_edit[0]['quotation'];?>";
    view_tab_cost_element(id_quot);
    var urlSurvey = "<?=base_url()?>so/get_so_survey_list?id=<?=$data_edit[0]['id_so']?>";
    var sourceSurvey =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_so_survey'},
            { name: 'site'},
            { name: 'site_name'},
            { name: 'filename'},
            { name: 'remark'}
        ],
        id: 'id_so_survey',
        url: urlSurvey,
        root: 'data'
    };
    var dataAdapterSurvey = new $.jqx.dataAdapter(sourceSurvey);
    <?php endif; ?>
    
    $("#survey-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        <?php if (isset($is_edit)): ?>source: dataAdapterSurvey,<?php endif; ?>
        selectionmode : 'singlerow',
        editable: false,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Number', datafield: 'filename', cellsrenderer: linkrenderer_survey},
            { text: 'Site', datafield: 'site', displayfield: 'site_name'},
            { text: 'Remark', datafield: 'remark'}
        ]
    });
    
    //=================================================================================
    //
    //   Contract Grid
    //
    //=================================================================================
    terms = [
        {label: 'Monthly', value: 'Monthly'}, 
        {label: 'Every 3 Months', value: 'Every 3 Months'},
        {label: 'Every 6 Months', value: 'Every 6 Months'},
        {label: 'Yearly', value: 'Yearly'}
    ];
    termsSource = {
        datatype: "array",
        datafields: [
            { name: 'label', type: 'string' },
            { name: 'value', type: 'string' }
        ],
        localdata: terms
    };
    termsAdapter = new $.jqx.dataAdapter(termsSource, {
        autoBind: true
    });
    ctstatus = [
        {label: 'Draft', value: 'draft'}, 
        {label: 'Active', value: 'active'},
        {label: 'Terminated', value: 'terminated'}
    ];
    ctstatusSource = {
        datatype: "array",
        datafields: [
            { name: 'label', type: 'string' },
            { name: 'value', type: 'string' }
        ],
        localdata: ctstatus
    };
    ctstatusAdapter = new $.jqx.dataAdapter(ctstatusSource, {
        autoBind: true
    });
    
    $("#add-contract").on('click', function(e) {
        $('#contract-file').trigger('click');
        e.preventDefault();
    });
    
    $('#contract-file').on('change', function(e) {
        $("#contract-form").ajaxForm({
            success: function (output) {
                $('#contract-file').val("");
				output = JSON.parse(output);
				alert(output.filename);
				var data = {};
				data['id_contract'] = output['id_contract'];
                data['filename'] = output['filename'];
                data['startdate'] = '';
                data['expdate'] = '';
                data['invoice_term'] = '';
                var commit0 = $("#contract-grid").jqxGrid('addrow', null, data);
            },
            complete: function (xhr) {
               
            }
        }).submit();
        e.preventDefault();
    });
    
    var urlContract = "<?php if (isset($is_edit)):?><?php echo base_url()?>so/get_so_contract_list?id=<?php echo $data_edit[0]['id_so']; ?> <?php endif; ?>";
    var sourceContract =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_contract'},
            { name: 'filename'},
            { name: 'startdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'expdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'invoice_term'},
            { name: 'invoice_term_name', value: 'invoice_term', values: { source: termsAdapter.records, value: 'value', name: 'label' }},
			{ name: 'po_number'},
			{ name: 'contract_number'},
            { name: 'status'},
            { name: 'status_name', value: 'status', values: { source: ctstatusAdapter.records, value: 'value', name: 'label' }},
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
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Number', datafield: 'filename', editable: false, cellsrenderer: linkrenderer_contract, width: 110},
            { text: 'Start Date', datafield: 'startdate', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'Expire Date', datafield: 'expdate', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'Invoice Term', datafield: 'invoice_term', displayfield: 'invoice_term_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ 
                        source: termsAdapter, 
                        displayMember: 'label', 
                        valueMember: 'value'
                    });
                }
            },
			{ text: 'Contract Number', datafield: 'contract_number', width: 110}, 
			{ text: 'PO Number', datafield: 'po_number', width: 110},
            { text: 'Status', datafield: 'status', displayfield: 'status_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ 
                        source: ctstatusAdapter, 
                        displayMember: 'label', 
                        valueMember: 'value'
                    });
                }
            }
        ]
    });
	
	$("#save-contract").click(function(){
		var data_post = {};
		data_post['id_so'] = $("#id_so").val();
		data_post['contracts'] = $("#contract-grid").jqxGrid('getrows');
		 for (var i = 0; i < data_post['contracts'].length; i++) {
			data_post['contracts'][i].startdate = (data_post['contracts'][i].startdate == null ? null : data_post['contracts'][i].startdate.format('yyyy-mm-dd'));
			data_post['contracts'][i].expdate = (data_post['contracts'][i].expdate == null ? null : data_post['contracts'][i].expdate.format('yyyy-mm-dd'));
		}
		$.ajax({
			url: '<?php base_url() ?>so/save_so_contract',
			type: "POST",
			data: data_post,
			success: function(output)
			{		  
				alert('Transaction success');
			},
			error: function( jqXhr ) 
			{
				$(".table-right-bar").unblock();
				if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
					var json = $.parseJSON( jqXhr.responseText );
					alert(json);
				}
				$("#error-content").html(jqXhr.responseText);
				$("#error-notification-default").jqxWindow("open");
			}
		});
	});
    
    //=================================================================================
    //
    //   Working Schedule Assignment Grid
    //
    //=================================================================================
    var shifts = [
        {label: '1', value: '1'},
        {label: '2', value: '2'},
        {label: '3', value: '3'}        
    ];
    var hours = [
        {label: '8 Hours', value: '8'},
        {label: '12 Hours', value: '12'}
    ];
    
    var urlWS = "<?php if (isset($is_edit)):?><?php echo base_url()?>so/get_so_schedule_list?id=<?php echo $data_edit[0]['id_so']; ?> <?php endif; ?>";
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
            { name: 'shift_name', value: 'shift_no', values: { source: shifts, value: 'value', name: 'label' }},
            { name: 'qty', type: 'number'},
            { name: 'working_hour'},
            { name: 'working_hour_name', value: 'working_hour', values: { source: hours, value: 'value', name: 'label' }},
            { name: 'structure'},
            { name: 'structure_name'}
        ],
        id: 'id_detail_work_schedule',
        url: urlWS,
        root: 'data'
    };
    var dataAdapterWS = new $.jqx.dataAdapter(sourceWS);
    $("#working-schedule-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        source: dataAdapterWS,
        selectionmode : 'singlerow',
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Site', dataField: 'site', displayfield: 'site_name', width: 100},
            { text: 'Area', dataField: 'area', width: 100},
            { text: 'Shift', dataField: 'shift_no', width: 100},
            { text: 'Working Hour', datafield: 'working_hour', displayfield: 'working_hour_name', width: 100},
            { text: 'Qty', dataField: 'qty', width: 100},
            { text: 'Title', dataField: 'structure', displayfield: 'structure_name', width: 200}
        ]
    });
    
    //=================================================================================
    //
    //   Quotation Input
    //
    //=================================================================================
    
    var urlquotation = "<?php echo base_url() ;?>quotation/get_quotation_list?status=open";
    var sourcequotation =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_quotation'},
            { name: 'quote_number'},
            { name: 'quote_date', type: "date"},
            { name: 'customer_name'},
            { name: 'customer'}
        ],
        id: 'id_quotation',
        url: urlquotation ,
        root: 'data'
    };
    var dataAdapterquotation = new $.jqx.dataAdapter(sourcequotation);
    
    
    $("#quote-number").jqxInput({ source: dataAdapterquotation, displayMember: "name", valueMember: "id_quotation", height: 23});
    
    $("#quote-number").change(function(){
        var id = $(this).val().value;
    });
    
    <?php if(isset($is_edit)): ?>
    $("#quote-number").jqxInput('val', {label: '<?php echo $data_edit[0]['quote_number'] ?>', value: '<?php echo $data_edit[0]['quotation']?>'});
    $('#customer-name').val("<?=$data_edit[0]['customer_name']?>");
    $('#customer-id').val("<?=$data_edit[0]['customer']?>");
    <?php endif;?>
    $("#select-quotation-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
        
    $("#select-quotation-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapterquotation,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Number', dataField: 'quote_number', width: 150},
            { text: 'Date', dataField: 'quote_date', width: 150, cellsformat: 'dd/MM/yyyy', filtertype: 'date'},
            { text: 'Customer', dataField: 'customer_name'}
        ]
    });
    
    $("#quotation-select").click(function(){
        $("#select-quotation-popup").jqxWindow('open');
    });
    
    $('#select-quotation-grid').on('rowdoubleclick', function (event) 
    {
        
        var args = event.args;
        var data = $('#select-quotation-grid').jqxGrid('getrowdata', args.rowindex);
        view_tab_cost_element(data.id_quotation);
        $('#quote-number').jqxInput('val', {label: data.quote_number, value: data.id_quotation});
        $('#customer-name').val(data.customer_name);
        $('#customer-id').val(data.customer);
        $("#select-quotation-popup").jqxWindow('close');
        //$('#jqxGrid').jqxGrid('refresh');
        var urlQuoProduct = "<?php echo base_url()?>quotation/get_quotation_product_list?id=" + data.id_quotation;
        var sourceQuoProduct =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_product'},
                { name: 'product_code'},
                { name: 'product_name'},
                { name: 'unit_name'},
                { name: 'unit'},
                { name: 'qty_request'},
                { name: 'qty_deliver'},
                { name: 'remark'},
                { name: 'qty', type: 'number'},
                { name: 'price', type: 'number'},
                { name: 'total_price', type: 'number'}                
            ],
            id: 'id_product',
            url: urlQuoProduct,
            root: 'data'
        };
        var dataAdapterQuoProduct = new $.jqx.dataAdapter(sourceQuoProduct);
        $("#so-grid").jqxGrid({source: dataAdapterQuoProduct});
        
        var urlSurvey = "<?php echo base_url()?>quotation/get_quotation_survey_list?id=" + data.id_quotation;
        var sourceSurvey =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_quotation_survey'},
                { name: 'site'},
                { name: 'site_name'},
                { name: 'filename'},
                { name: 'remark'}
            ],
            id: 'id_quotation_survey',
            url: urlSurvey,
            root: 'data'
        };
        var dataAdapterSurvey = new $.jqx.dataAdapter(sourceSurvey);
        $("#survey-grid").jqxGrid({source: dataAdapterSurvey});

        var urlWS = "<?php echo base_url() ;?>work_schedule/get_quotation_schedule_detail_list/" + data.id_quotation;
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
                { name: 'shift_name', value: 'shift_no', values: { source: shifts, value: 'value', name: 'label' }},
                { name: 'qty', type: 'number'},
                { name: 'working_hour'},
                { name: 'working_hour_name', value: 'working_hour', values: { source: hours, value: 'value', name: 'label' }},
                { name: 'structure'},
                { name: 'structure_name'}
            ],
            id: 'id_detail_work_schedule',
            url: urlWS ,
            root: 'data'
        };
        var dataAdapterWS = new $.jqx.dataAdapter(sourceWS);
        $("#working-schedule-grid").jqxGrid({source: dataAdapterWS});

        //Assign CE Grid
        url_ce = "<?php echo base_url() ;?>quotation/get_structure_ws_from_quote/" + data.id_quotation;
        source_ce =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'structure'},
                    { name: 'structure_name'},
                    { name: 'cost_element'},
                    { name: 'cost_element_name'}
                ],
            id: 'structure',
            url: url_ce,
            root: 'data'
        };

        dataAdapterCE = new $.jqx.dataAdapter(source_ce);
        dataAdapterCE.dataBind();
        $("#ce-assign-grid").jqxGrid({source: dataAdapterCE});
        $("#ce-assign-grid").jqxGrid('refreshdata');
    });
});

function SaveData()
{
    var data_post = {};
    
    data_post['is_edit'] = $("#is_edit").val();
    data_post['id_so'] = $("#id_quotation").val();
    data_post['date'] = $("#so-date").val('date').format('yyyy-mm-dd');
    data_post['date_delivery'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
    data_post['products'] = $('#so-grid').jqxGrid('getrows');
    data_post['quotation'] = $("#quote-number").val().value;
    data_post['customer'] = $("#customer-id").val();
    data_post['notes'] = $("#notes").val();
    data_post['surveys'] = $('#survey-grid').jqxGrid('getrows');
    data_post['contracts'] = $('#contract-grid').jqxGrid('getrows');
    for (var i = 0; i < data_post['contracts'].length; i++) {
        data_post['contracts'][i].startdate = (data_post['contracts'][i].startdate == null ? null : data_post['contracts'][i].startdate.format('yyyy-mm-dd'));
        data_post['contracts'][i].expdate = (data_post['contracts'][i].expdate == null ? null : data_post['contracts'][i].expdate.format('yyyy-mm-dd'));
    }

    load_content_ajax(GetCurrentController(), 76, data_post);
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 72, null);
}

</script>
<?php if (isset($is_edit)): ?> 
<script>
$(document).ready(function(){
    <?php if ($data_edit[0]['status'] == 'draft'): ?>
    //=================================================================================
    //
    //   Quotation Validate
    //
    //=================================================================================    
    $("#so-validate").on('click', function(e) {  
        var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_so'] ?>;
        param.push(item);        
        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_so'] = $("#id_so").val();
        load_content_ajax(GetCurrentController(), 266, data_post, param);
        e.preventDefault();
    });    
    <?php endif; ?>

    <?php if ($data_edit[0]['status'] == 'open'): ?>
    //=================================================================================
    //
    //   Quotation Validate
    //
    //=================================================================================    
    $("#so-confirm").on('click', function(e) {  
        var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_so'] ?>;
        param.push(item);        
        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_so'] = $("#id_so").val();
        load_content_ajax(GetCurrentController(), 'confirm_sales_order', data_post, param);
        e.preventDefault();
    });    
    <?php endif; ?>
});
</script>
<?php endif; ?>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_so" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_so'] : '') ?>" />
<div class="document-action">
    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft'): ?><button id="so-validate">Validate</button><?php endif; ?>
    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'open'): ?><button id="so-confirm">Confirm</button><?php endif; ?>
    <ul class="document-status">
        <li 
        <?php 
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
        ?>
        >
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
        <div><h1 style="font-size: 18pt; font-weight: bold;">Sales Order / <span><?php echo (isset($is_edit) ? $data_edit[0]['so_number'] : ''); ?></span></h1></div>
        <div>
        <?php
            //var_dump($data_edit);
        ?>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="so-date" style="display: inline-block;"></div><button style="top: -10px;margin-left: 5px;display: inline-block;position: relative;" id="clear-delivery-date">C</button>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Delivery Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="delivery-date" style="display: inline-block;"></div><button style="top: -10px;margin-left: 5px;display: inline-block;position: relative;" id="clear-delivery-date">C</button>
                        </div>
                    </td>
                <tr>
                    <td>
                        <div class="label">
                            Quotation
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="quote-number" name="quote_number" value="" readonly="readonly"/>
                            <?php if (!isset($is_edit)): ?><button id="quotation-select">...</button><?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Customer
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-name" name="customer_name" value="" readonly="readonly" />
                            <input type="hidden" id="customer-id" name="customer_id" value=""  />
                        </div>
                    </td>
                    <td></td>
                </tr>                
            </table>
            <div id='so-tabs' style="margin-top: 20px;">
                <ul>
                    <li>Working Schedule</li>
                    <li>Cost Element</li>
                    <li>Survey / Assessment</li>
                    <li>Payment Info</li>
                    <li>Product & Services</li>
                </ul>
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
                    </table>
                </div>
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div class="row-color" style="width: 100%;">
                                    <span>Cost Element</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="ce-assign-grid"></div>
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
                                 <div class="row-color" style="width: 100%;">
                                    <button style="width: 30px;" id="add-contract">+</button>
                                    <button style="width: 30px;" id="remove-contract">-</button>
									<button style="width: 60px;" id="save-contract">Save</button>
                                    <div style="display: inline;"><span>Add / Remove Contract</span></div>
                                    <form id="contract-form" method="post" enctype="multipart/form-data" action="<?php echo base_url() ;?>so/upload_contract">
                                        <input type="file" name="contract_file" style="display:none;" id="contract-file">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="contract-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <?php /*
                        <tr>
                            <td colspan="2">
                                 <div class="row-color" style="width: 100%;">
                                    <button style="width: 30px;" id="add-product">+</button>
                                    <button style="width: 30px;" id="remove-product">-</button>
                                    <div style="display: inline;"><span>Add / Remove Product</span></div>
                                </div>
                            </td>
                        </tr>
                         *
                         */ ?>
                        <tr>
                            <td colspan="2">
                                <div id="so-grid"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 80%;padding-top: 20px;" colspan="2">
                                <div class="label">
                                    Notes
                                </div>
                                <textarea id="notes" class="field" cols="10" rows="20" style="height: 50px;"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="select-quotation-popup">
    <div>Select Quotation</div>
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