<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
var linkrenderer = function (row, column, value) {
    return '<div style="margin: 4px;" class="jqx-left-align"><a href="' + '<?php echo base_url() ?>survey_assessment/download_file/' + value + '" target="_blank" style="padding: 2px">' + value + '</a></div>';
};
    
$(document).ready(function(){
    $('#quotation-tabs').jqxTabs({ width: '100%', position: 'top', scrollPosition: 'right'});
    $("#quote-date").jqxDateTimeInput({width: '250px', height: '25px'}); 
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
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
    
    $("#quotation-grid").on("bindingcomplete", function(event){
        var culture = {};
        culture.currencysymbol = "Rp. ";
        $("#quotation-grid").jqxGrid('localizestrings', culture);
        
        var rows = $("#quotation-grid").jqxGrid('getrows');
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
    
    var url = "<?php if(isset($is_edit)){?><?php echo base_url()?>quotation/get_quotation_product_list?id=<?php echo $data_edit[0]['id_quotation']; ?> <?php }?>";
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
    $("#quotation-grid").jqxGrid(
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
        rendertoolbar: function (toolbar) {
            $("#add-product").click(function(){
                var offset = $("#remove-product").offset();
                $("#select-product-popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-product").width() + 20, y: parseInt(offset.top)} });
                $("#select-product-popup").jqxWindow('open');
            });
            $("#remove-product").click(function(){
                var selectedrowindex = $("#quotation-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#quotation-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#quotation-grid").jqxGrid('deleterow', id);
                }
                
            });
        },
        columns: [
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Unit', dataField: 'unit', displayfield: 'unit_name', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: unitAdapter, displayMember: 'name', valueMember: 'id_unit_measure' });
                }},
            { text: 'Quantity', dataField: 'qty', cellsformat: 'd2'}, 
            { text: 'Unit Price', dataField: 'price',cellsformat: 'c2',
                validation: function (cell, value) {
                    if (value < 0) {
                      return { result: false, message: "Price should be greate than 0" };
                    }
                    return true;
                }
            },
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
    
    $("#quotation-grid").on('cellvaluechanged', function (event) 
    {
        var rows = $("#quotation-grid").jqxGrid('getrows');
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
        var rows = $("#quotation-grid").jqxGrid('getrows');
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

    $("#quotation-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#quotation-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    $("#quotation-grid").jqxGrid('setcolumnproperty', 'total_price', 'editable', false);

    //=================================================================================
    //
    //   inquiry Input
    //
    //=================================================================================
    
    var urlinquiry = "<?php echo base_url() ;?>inquiry/get_inquiry_list?status=open";
    var sourceinquiry =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_inquiry'},
            { name: 'inquiry_number'},
            { name: 'inquiry_date', type: 'date'},
            { name: 'customer_name'},
            { name: 'customer'}
        ],
        id: 'id_inquiry',
        url: urlinquiry ,
        root: 'data'
    };
    var dataAdapterinquiry = new $.jqx.dataAdapter(sourceinquiry);
    
    
    $("#inquiry-name").jqxInput({ source: dataAdapterinquiry, displayMember: "name", valueMember: "id_inquiry", height: 23});
    
    $("#inquiry-name").change(function(){
        var id = $(this).val().value;
    });
    
    <?php if(isset($is_edit)): ?>
    $("#inquiry-name").jqxInput('val', {label: '<?php echo $data_edit[0]['inquiry_number'] ?>', value: '<?php echo $data_edit[0]['inquiry']?>'});
    $('#customer-name').val("<?=$data_edit[0]['customer_name']?>");
    <?php endif;?>
    $("#select-inquiry-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
        
    $("#select-inquiry-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapterinquiry,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Number', dataField: 'inquiry_number', width: 150},
            { text: 'Date', dataField: 'inquiry_date', width: 150, cellsformat: 'dd/MM/yyyy', filtertype: 'date'},
            { text: 'Customer', dataField: 'customer_name'}
        ]
    });
    
    $("#inquiry-select").click(function(){
        $("#select-inquiry-popup").jqxWindow('open');
    });
    
    $('#select-inquiry-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-inquiry-grid').jqxGrid('getrowdata', args.rowindex);
        $('#inquiry-name').jqxInput('val', {label: data.inquiry_number, value: data.id_inquiry});
        $('#customer-name').val(data.customer_name);
        $("#select-inquiry-popup").jqxWindow('close');
        var dataAdapterSites = getSites(data.customer);
        $("#survey-grid").jqxGrid({
            columns: setSurveyColumn(dataAdapterSites)
        });
        //$('#jqxGrid').jqxGrid('refresh');
        var urlInquiryProduct = "<?php echo base_url()?>inquiry/get_inquiry_product_list?id=" + data.id_inquiry;
        var sourceInquiryProduct =
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
            url: urlInquiryProduct,
            root: 'data'
        };
        var dataAdapterInquiryProduct = new $.jqx.dataAdapter(sourceInquiryProduct);
        $("#quotation-grid").jqxGrid({source: dataAdapterInquiryProduct});
    });
    
    //=================================================================================
    //
    //   Select product Grid
    //
    //=================================================================================
    
    var url_select_product = "<?php echo base_url() ;?>product/get_product_list";
    var source_select_product =
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
            { name: 'unit_name'},
            { name: 'unit'},            
            { name: 'category_name'},
            { name: 'qty', type: 'number'}
        ],
        id: 'id_product',
        url: url_select_product ,
        root: 'data'
    };
    var dataAdapter_select_product = new $.jqx.dataAdapter(source_select_product);
    
    $("#select-product-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_product,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Product Code', dataField: 'product_code', width: 150},
            { text: 'Name', dataField: 'product_name'},
            { text: 'Category', dataField: 'category_name', width: 150}, 
            { text: 'Merk', dataField: 'name', width: 100}                                        
        ]
    });
    
    $('#select-product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-product-grid').jqxGrid('getrowdata', args.rowindex);
        data['qty_request'] = 0;
        data['qty_deliver'] = 0;
        data['remark'] = '';
        var commit0 = $("#quotation-grid").jqxGrid('addrow', null, data);
        $("#select-product-popup").jqxWindow('close');
    });
    
    $('#quotation-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#quotation-grid').jqxGrid('getrowdata', args.rowindex);
//        alert(JSON.stringify(data));
    }); 
    
    //=================================================================================
    //
    //   Survey Grid
    //
    //=================================================================================
    
    $("#add-survey").on('click', function(e) {
        $('#survey-file').trigger('click');
        e.preventDefault();
    });    
    
    $('#survey-file').on('change', function(e) {
        $("#contract-form").ajaxForm({
            success: function () {
                $('#survey-file').val("");
            },
            complete: function (xhr) {
                var data = {};
                var format = { target: '"_blank"' };
                data['filename'] = xhr.responseText;
                data['site'] = null;
                data['remark'] = '';
                var commit0 = $("#survey-grid").jqxGrid('addrow', null, data);
            }
        }).submit();
        e.preventDefault();
    });
    $("#remove-survey").on('click', function(e) {
        var selectedrowindex = $("#survey-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#survey-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#survey-grid").jqxGrid('deleterow', id);
        }
        e.preventDefault();
    });
    
    var urlSurvey = "<?php if (isset($is_edit)):?><?php echo base_url()?>quotation/get_quotation_survey_list?id=<?php echo $data_edit[0]['id_quotation']; ?> <?php endif; ?>";
    var sourceSurvey =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_quotation_survey'},
            { name: 'id_customer_site'},
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
    <?php if (isset($is_edit)):?>
    var dataAdapterSites = getSites(<?php echo $data_edit[0]['customer']; ?>);
    <?php else: ?>
    var dataAdapterSites = null;
    <?php endif; ?>
    $("#survey-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        source: dataAdapterSurvey,
        selectionmode : 'singlerow',
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: setSurveyColumn(dataAdapterSites)
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
    
    function setSurveyColumn(adapter)
    {
        columns = [
            { text: 'Number', dataField: 'filename', editable: false, cellsrenderer: linkrenderer},
            { text: 'Site', dataField: 'id_customer_site', displayfield: 'site_name', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({source: adapter, displayMember: 'site_name', valueMember: 'id_customer_site' });
                }},
            { text: 'Remark', dataField: 'remark'}
        ];
        
        return columns;
    }
    
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
    var urlWS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_schedule/get_work_schedule_detail_list/<?=$data_edit[0]['id_work_schedule']?><?php endif; ?>";
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
            { text: 'Working Hour', datafield: 'working_hour', displayfield: 'working_hour_name', width: 100},
            { text: 'Qty', dataField: 'qty', width: 100},
            { text: 'Title', dataField: 'structure', displayfield: 'structure_name', width: 200}
        ]
    });
    
    $("#make-working-schedule").on('click', function(e){
        var data_post = {};
        data_post['id_quotation'] = $("#id_quotation").val();     
        load_content_ajax(GetCurrentController(), 263, data_post);
        e.preventDefault();
    });
    
    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft'): ?> 
    //=================================================================================
    //
    //   Quotation Validate
    //
    //=================================================================================    
    $("#quotation-validate").on('click', function(e){  
        var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_quotation'] ?>;
        param.push(item);        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_quotation'] = $("#id_quotation").val();
        load_content_ajax(GetCurrentController(), 265, data_post, param);
        e.preventDefault();
    });
    <?php endif; ?>
});

function SaveData()
{
    load_content_ajax(GetCurrentController(), 123, dataPost());
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 119, null);
}

function dataPost()
{
    var data_post = {};
    data_post['is_edit'] = $("#is_edit").val();
    data_post['id_quotation'] = $("#id_quotation").val();
    data_post['quote_date'] = $("#quote-date").val('date').format('yyyy-mm-dd');
    data_post['products'] = $('#quotation-grid').jqxGrid('getrows');
    data_post['inquiry'] = $("#inquiry-name").val().value;
    data_post['notes'] = $("#notes").val();
    data_post['surveys'] = $('#survey-grid').jqxGrid('getrows');
    data_post['invoice_period'] = $("#invoice_period").val();    
    
    return data_post;
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_quotation" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_quotation'] : '') ?>" />
<div class="document-action">
    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft'): ?><button id="quotation-validate">Validate</button><?php endif; ?>
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
    <div><h1 style="font-size: 18pt; font-weight: bold;">Quotation / <span><?php echo (isset($is_edit) ? $data_edit[0]['quote_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Quotation Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="quote-date" style="display: inline-block;"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Inquiry
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="inquiry-name" name="name" value=""/>
                            <button id="inquiry-select">...</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        <div class="label">
                            Customer
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-name" name="name" value="" readonly="readonly"/>
                        </div>                        
                    </td>
                </tr>                
            </table>
            <div id='quotation-tabs' style="margin-top: 20px;">
                <ul>
                    <li>Product & Services</li>
                    <li>Survey / Assessment</li>
                    <li>Payment Info</li>     
                    <li>Working Schedule</li>                                      
                </ul>
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">                       
                                 <div class="row-color" style="width: 100%;">
                                    <button style="width: 30px;" id="add-product">+</button>
                                    <button style="width: 30px;" id="remove-product">-</button>
                                    <div style="display: inline;"><span>Add / Remove Product</span></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="quotation-grid"></div>
                            </td>
                        </tr>
                        <tr>
                    <td>
                    </td>
                    <td>
                        <table style="float: right; text-align: right">
                            <tr>
                                <td></td>
                                <td>Untaxed Amount : </td>
                                <td style="width: 150px;"><div id="untaxed-amount">Rp. 0</div><input type="hidden" id="subtotal-value" value="<?php echo (isset($is_edit) ? $data_edit[0]['sub_total'] : '0') ?>"/></td>
                            </tr>
                            <tr>
                                <td style="padding-right: 10px;"><!--<div id="tax-select">--></div></td>
                                <td><input type="checkbox" id="use-tax" style="display: inline-block;" <?php echo (isset($is_edit) && ($data_edit[0]['tax'] != null || $data_edit[0]['tax'] > 0) ? 'checked=true' : '') ?> />Taxes (10%) : </td>
                                <td><div id="tax-amount">Rp. 0</div><input type="hidden" id="tax-value" value="<?php echo (isset($is_edit) ? $data_edit[0]['tax'] : '0') ?>"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="border-top: solid thin black;">Total Amount : </td>
                                <td style="border-top: solid thin black;"><div id="total-amount">Rp. 0</div><input type="hidden" id="total-value" value="<?php echo (isset($is_edit) ? $data_edit[0]['total_price'] : '0') ?>"/></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                        <tr>
                            <td style="width: 80%;padding-top: 20px;" colspan="2">
                                <div class="label">
                                    Notes
                                </div>
                                <textarea class="field" cols="10" rows="20" style="height: 50px;" id="notes" name="notes"></textarea>
                            </td>
                        </tr>                        
                    </table>
                </div>
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">                       
                                 <div class="row-color" style="width: 100%;">
                                    <button style="width: 30px;" id="add-survey">+</button>
                                    <button style="width: 30px;" id="remove-survey">-</button>
                                    <div style="display: inline;"><span>Add / Remove Survey</span></div>
                                    <form id="contract-form" method="post" enctype="multipart/form-data" action="<?php echo base_url() ;?>quotation/upload_survey">
                                        <input type="file" name="survey_file"  style="display:none;" id="survey-file">
                                    </form>
                                </div>
                            </td>
                        </tr>
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
                            <td class="label">                       
                                Invoice Term
                            </td>
                            <td>
                                <select class="field" id="invoice_period">
                                    <option <?= isset($is_edit) && $data_edit[0]['invoice_period'] == 'Monthly' ? 'selected="selected"' : '' ?>>Monthly</option>
                                    <option <?= isset($is_edit) && $data_edit[0]['invoice_period'] == 'Every 3 Month' ? 'selected="selected"' : '' ?>>Every 3 Month</option>
                                    <option <?= isset($is_edit) && $data_edit[0]['invoice_period'] == 'Every 6 Month' ? 'selected="selected"' : '' ?>>Every 6 Month</option>
                                    <option <?= isset($is_edit) && $data_edit[0]['invoice_period'] == 'Yearly' ? 'selected="selected"' : '' ?>>Yearly</option>                                                                        
                                </select>
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
                                    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft' && !$data_edit[0]['id_work_schedule']): ?><button id="make-working-schedule">Make Working Schedule</button><?php endif; ?>
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
            </div>
        </div>
    </div>
</div>

<div id="select-product-popup">
    <div>Select Product</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-product-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="select-inquiry-popup">
    <div>Select Inquiry</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-inquiry-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>