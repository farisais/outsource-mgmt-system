<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
var linkrenderer = function (row, column, value) {
    return '<div style="margin: 4px;" class="jqx-left-align"><a href="' + '<?php echo base_url() ?>survey_assessment/download_file/' + value + '" target="_blank" style="padding: 2px">' + value + '</a></div>';
};
function view_tab_cost_element(){
    /*var url = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>quotation/get_cost_element/<?=$data_edit[0]['id_quotation']?><?php endif; ?>";
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
                    columnsresize: true,
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
                
            ],
            rendertoolbar: function (toolbar) {
            $("#add_cost_element").click(function(){
                var param = [];
                var item = {};
                item['paramName'] = 'id_quote';
                item['paramValue'] = $("#id_quotation").val();
                param.push(item);        
                load_content_ajax(GetCurrentController(), 'view_cost_element', dataPost(), param);
            });
            
            }
        });
        */
    //=================================================================================
    //
    //   CE Assign Grid
    //
    //=================================================================================

    var celink = function (row, column, value) {
        return '<div style="margin: 4px;" class="jqx-left-align"><a href="#" style="padding: 2px">' + value + '</a></div>';
    };

    var url_ce = "<?php if(isset($is_edit)){?><?php echo base_url() ;?>quotation/get_structure_ws_from_quote/<?php echo $data_edit[0]['id_quotation'] ?><?php } ?>";
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

    $("#save-ce-assign").click(function(){
        var data = $("#ce-assign-grid").jqxGrid("getrows");
        if(data.length > 0)
        {
            var data_post = {};
            data_post['id_quotation'] = $("#id_quotation").val();
            data_post['ce_assign'] = $("#ce-assign-grid").jqxGrid('getrows');
            //alert(JSON.stringify(data_post));
            loadAjaxGif();
            $.ajax({
                url: '<?php echo base_url() ?>quotation/save_ce_assign',
                type: "POST",
                data: data_post,
                dataType:'json',
                success:function(result){
                    unloadAjaxGif();
                    //alert(result);
                    var obj = result;

                    if(obj.status == 'success')
                    {
                        alert('Transaction Success!');
                        var calculation = obj.calculation;
                        var data = $("#quotation-grid").jqxGrid('getrows');
                        alert(JSON.stringify(obj));
                        for(i=0;i<data.length;i++)
                        {
                            for(j=0;j<calculation.length;j++)
                            {
                                if(calculation[j]['product'] == data[i]['id_product'])
                                {
                                    $("#quotation-grid").jqxGrid('setcellvalue', i, "price", calculation[j]['total']);
                                    break;
                                }
                            }
                        }
                    }
                    else
                    {
                        alert('Transaction Failed!');
                    }

                    unloadAjaxGif();

                },
                error: function( jqXhr )
                {

                    if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON( jqXhr.responseText );
                        alert(json);
                    }
                    $("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
                    $("#error-notification-default").jqxWindow("open");

                    unloadAjaxGif();
                }
            });
        }
        else
        {
            alert('No data to save');
        }
    });


    //=================================================================================
    //
    //   CE Existing
    //
    //=================================================================================

    var url_existing = "<?php echo base_url()?>cost_element/get_cost_element_list";
    var source_existing =
    {
        datatype: "json",
        datafields:
            [
                { name: 'id_cost_element'},
                { name: 'name'},
                { name: 'description'},
                { name: 'date_create', type: 'date'}
            ],
        id: 'id_cost_element',
        url: url_existing,
        root: 'data'
    };
    var dataAdapterExisting = new $.jqx.dataAdapter(source_existing);
    $("#ce-existing-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: '100%',
            source: dataAdapterExisting,
            groupable: true,
            columnsresize: true,
            autoshowloadelement: false,
            filterable: true,
            showfilterrow: true,
            sortable: true,
            autoshowfiltericon: true,
            columns: [
                { text: 'Name', dataField: 'name'},
                { text: 'Description', dataField: 'description'},
                { text: 'Date Create', dataField: 'date_create', cellsformat: 'dd/MM/yyyy', width: 100},
            ]
        });

    $("#ce-existing-grid").on('rowdoubleclick', function(event){
        $("#ce-existing-popup2").jqxWindow('close');
        var args = event.args;
        var rowindex = args.rowindex;
        var data_copy = $(this).jqxGrid('getrowdata', rowindex);

        var cerowindex = $("#ce-temp-rowindex").val();
        //alert(cerowindex);
        $("#ce-assign-grid").jqxGrid('setcellvalue', cerowindex, 'cost_element', data_copy['id_cost_element']);
        $("#ce-assign-grid").jqxGrid('setcellvalue', cerowindex, 'cost_element_name', data_copy['name']);
    });

    $("#ce-existing-popup2").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
    });

    $("#select-ce").click(function(){
        var selectedrowindex = $("#ce-assign-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            //alert('open');
            $("#ce-existing-popup2").jqxWindow('open');
            $("#ce-temp-rowindex").val(selectedrowindex);
            //var id = $("#work-schedule-grid").jqxGrid('getrowid', selectedrowindex);
            //var commit1 = $("#work-schedule-grid").jqxGrid('deleterow', id);
        }
        else
        {
            alert('No data to assign');
        }
    });

}    
function dataPost()
{
    var data_post = {};
    data_post['id_quotation'] = $("#id_quotation").val();    
    
    return data_post;
}
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
        <?php if(isset($is_view)){ echo 'disabled: true,';} ?>
        selectionmode : 'singlerow',
        source: dataAdapter,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add-product").click(function(){
                <?php if(isset($is_view)){ echo 'return;';} ?>
                var offset = $("#remove-product").offset();
                $("#select-product-popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-product").width() + 20, y: parseInt(offset.top)} });
                $("#select-product-popup").jqxWindow('open');
            });
            $("#remove-product").click(function(){
                <?php if(isset($is_view)){ echo 'return;';} ?>
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

    $("#quotation-grid").on('rowdoubleclick', function(event){
        var args = event.args;
        alert(JSON.stringify($(this).jqxGrid('getrowdata', args.rowindex)));
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

    var currentSite = null;
    $('#select-inquiry-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-inquiry-grid').jqxGrid('getrowdata', args.rowindex);
        $('#inquiry-name').jqxInput('val', {label: data.inquiry_number, value: data.id_inquiry});
        $('#customer-name').val(data.customer_name);
        $("#select-inquiry-popup").jqxWindow('close');
        var dataAdapterSites = getSites(data.customer);
        currentSite = dataAdapterSites;
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
        {label: '3', value: '3'},
        {label: 'off', value: 'off'}
    ];
    var hours = [
        {label: '8 Hours', value: '8'},
        {label: '12 Hours', value: '12'},
        {label: '24 Hours', value: '24'}
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
        data_post['detail_product'] = $("#quotation-grid").jqxGrid('getrows');
        load_content_ajax(GetCurrentController(), 265, data_post, param);
        e.preventDefault();
    });
    <?php endif; ?>
    
    view_tab_cost_element();
});

function SaveData()
{
    load_content_ajax(GetCurrentController(), 'save_edit_quotation', dataPost());
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 119, null);
}

function EditData()
{
    <?php if(isset($is_view)){?>
    var data_post = {};
    var param = [];
    var item = {};
    item['paramName'] = 'id';
    item['paramValue'] = <?php echo $data_edit[0]['id_quotation'] ?>;
    param.push(item);        
    data_post['id_quotation'] = <?php echo $data_edit[0]['id_quotation'] ?>;
    load_content_ajax(GetCurrentController(), 'edit_quotation',data_post, param);
    <?php }?>
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
            if(isset($is_edit) || isset($is_view) )
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
                            <button id="inquiry-select" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>>...</button>
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
                                    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft' && !$data_edit[0]['id_work_schedule']): ?><button id="make-working-schedule" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>>+</button><?php endif; ?>
                                    <span>Make Working Schedule</span>
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
                                    <!--<?php if (isset($is_edit)): ?> <button style="width: 40px;" id="add_cost_element">+</button><?php endif; ?>-->
                                    <button id="select-ce">...</button>
                                    <button id="save-ce-assign">Save</button>
                                    <span>Detail Cost Element</span>
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
                                 <div class="row-color" style="width: 100%;">
                                    <button style="width: 30px;" id="add-survey" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>>+</button>
                                    <button style="width: 30px;" id="remove-survey" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>>-</button>
                                    <div style="display: inline;"><span>Add / Remove Survey</span></div>
                                    <form id="contract-form" method="post" enctype="multipart/form-data" action="<?php echo base_url() ;?>quotation/upload_survey">
                                        <input type="file" name="survey_file"  style="display:none;" id="survey-file" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>>
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
                                <select class="field" id="invoice_period" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>>
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
                                        <td style="padding-right: 10px;"><!--<div id="tax-select"></div>--></td>
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
                                <textarea class="field" cols="10" rows="20" style="height: 50px;" id="notes" name="notes" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>></textarea>
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
<input type="hidden" id="ce-temp-rowindex" value=""/>
<div id="ce-existing-popup2">
    <div>Select Existing Cost Element</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="ce-existing-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>