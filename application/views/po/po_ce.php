<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){  
    $("#po-date").jqxDateTimeInput({width: '250px', height: '25px'<?php if(isset($is_view)){ echo ',disabled: true';} ?>});
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', value: null<?php if(isset($is_view)){ echo ',disabled: true';} ?>}); 
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01<?php if(isset($is_view)){ echo ',disabled: true';} ?>           
    });
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['delivery_date'])) . "'" ?>);   
    $("#po-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date'])) . "'" ?>); 
    <?php 
    }
    ?>
    $("#clear-delivery-date").click(function(){
        <?php 
        if(!isset($is_view))
        {?>
        $("#delivery-date").val(null);
        <?php
        }
        ?>
    });
    
    
    //=================================================================================
    //
    //   PO History Grid
    //
    //=================================================================================
    var culture = {};
    culture.currencysymbol = "Rp. ";
    $("#po-history-grid").on("bindingcomplete", function(event){
        $("#po-history-grid").jqxGrid('localizestrings', culture);
    });
    
    var urlHistory = "";
    <?php 
    if(isset($is_edit))
    {?>
        urlHistory = "<?php echo base_url()?>po/get_po_history?id_mr=<?php echo $data_edit[0]['mr']; ?>" + "&id_po=<?php echo $data_edit[0]['id_po']; ?>";
    <?php    
    }
    ?>
    
    <?php 
    if(isset($from_mr))
    {?>
        urlHistory = "<?php echo base_url()?>po/get_po_history?id_mr=<?php echo $mr[0]['id_mr']; ?>";
    <?php    
    }
    ?>
    
    var sourceHistory =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_product'},
            { name: 'id_po'},
            { name: 'po_number'},
            { name: 'supplier'},
            { name: 'supplier_name'},
            { name: 'date', type: 'date'},
            { name: 'mr'},
            { name: 'mr_number'},
            { name: 'status'},
            { name: 'product'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'uom'},
            { name: 'unit_name'},
            { name: 'qty'}
        ],
        id: 'id_product',
        url: urlHistory ,
        root: 'data'
    };
    var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
    $("#po-history-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        <?php if(isset($is_view)){ echo 'disabled: true,';} ?>
        width: '100%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapterHistory,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'PO Number', dataField: 'po_number'},
            { text: 'Date', dataField: 'date', cellsformat: 'dd/MM/yyyy'},
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product Name', dataField: 'product_name'},
            { text: 'Unit', dataField: 'unit_name'},
            { text: 'Qty', dataField: 'qty',cellsformat: 'd2'},
        ]
    });
    
    
    
    $("#jqxExpander").jqxExpander({ width: '100%', expanded: false});

    //=================================================================================
    //
    //   Supplier Input
    //
    //=================================================================================
    
    var urlSupplier = "<?php echo base_url() ;?>supplier/get_supplier_list";
    var sourceSupplier =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_ext_company'},
            { name: 'name'},
            { name: 'company_code'},
            { name: 'contact'}
        ],
        id: 'id_ext_company',
        url: urlSupplier ,
        root: 'data'
    };
    var dataAdapterSupplier = new $.jqx.dataAdapter(sourceSupplier);
    
    
    $("#supplier-name").jqxInput({ source: dataAdapterSupplier, displayMember: "name", valueMember: "id_ext_company", height: 23});
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#supplier-name").jqxInput('val', {label: '<?php echo $data_edit[0]['supplier_name'] ?>', value: '<?php echo $data_edit[0]['supplier']?>'});
    <?php 
    }
    ?>
    $("#select-supplier-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-supplier-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapterSupplier,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Code', dataField: 'company_code', width: 150},
            { text: 'Name', dataField: 'name'},
            { text: 'Contact', dataField: 'contact', width: 150}                                      
        ]
    });
    
    $("#supplier-select").click(function(){
        <?php if(!isset($is_view))
        {?>
            $("#select-supplier-popup").jqxWindow('open');
        <?php
        }
        ?>
    });
    
    $('#select-supplier-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-supplier-grid').jqxGrid('getrowdata', args.rowindex);
        $('#supplier-name').jqxInput('val', {label: data.name, value: data.id_ext_company});
        $("#select-supplier-popup").jqxWindow('close');
    });
    
       
    //=================================================================================
    //
    //   MR Input
    //
    //=================================================================================
    
    var urlMr = "<?php echo base_url() ;?>mr/get_mr_list_open";
    var sourceMr =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_mr'},
            { name: 'work_order'},
            { name: 'work_order_number'},
            { name: 'date', type: 'date'},
            { name: 'mr_number'},
            { name: 'status_mr'},
                    
        ],
        id: 'id_mr',
        url: urlMr ,
        root: 'data'
    };
    var dataAdapterMr = new $.jqx.dataAdapter(sourceMr);
    
    
    $("#mr").jqxInput({ source: dataAdapterMr, displayMember: "mr_number", valueMember: "id_mr", height: 23<?php if(isset($is_view)){ echo ',disabled: true';} ?>});
    
    
    $("#select-mr-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-mr-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapterMr,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'MR Number', dataField: 'mr_number', width: 150},
            { text: 'WO Number', dataField: 'work_order_number'},
            { text: 'Date', dataField: 'date', width: 150, cellsformat: 'dd/MM/yyyy'}                                      
        ]
    });
    
    $("#mr-select").click(function(){
        <?php if(!isset($is_view))
        {?>
           $("#select-mr-popup").jqxWindow('open');
        <?php    
        }?>
        
    });
    
    $('#select-mr-grid').on('rowdoubleclick', function (event) 
    {
        <?php 
        if(!isset($is_edit))
        {?>
        var args = event.args;
        var data = $('#select-mr-grid').jqxGrid('getrowdata', args.rowindex);
        var url = "<?php echo base_url()?>mr/get_mr_product_list_open?id=" + data.id_mr;
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
                { name: 'unit_name'},
                { name: 'unit'},            
                { name: 'category_name'},
                { name: 'qty', type: 'number'},
                { name: 'unit_price', type: 'number'},
                { name: 'total_price', type: 'number'}
            ],
            id: 'product',
            url: url ,
            root: 'data',
        };
        source['unit_price'] = 0;
        source['total_price'] = 0;
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#po-product-grid").jqxGrid({source: dataAdapter});
       
        
        $("#select-mr-popup").jqxWindow('close');
        $('#mr').jqxInput('val', {label: data.mr_number, value: data.id_mr});        
        
        var urlHistory = "<?php echo base_url() ?>po/get_po_history?id_mr=" + data.id_mr ;
        var sourceHistory =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_product'},
                { name: 'id_po'},
                { name: 'po_number'},
                { name: 'supplier'},
                { name: 'supplier_name'},
                { name: 'date', type: 'date'},
                { name: 'mr'},
                { name: 'mr_number'},
                { name: 'status'},
                { name: 'product'},
                { name: 'product_code'},
                { name: 'product_name'},
                { name: 'uom'},
                { name: 'unit_name'},
                { name: 'qty'}
            ],
            id: 'id_product',
            url: urlHistory ,
            root: 'data'
        };
        var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
        //alert(JSON.stringify(dataAdapterHistory.records));
        $("#po-history-grid").jqxGrid({source: dataAdapterHistory});
               
        
        <?php    
        }
        ?>
    });
    
    
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#mr").jqxInput('val', {label: '<?php echo $data_edit[0]['mr_number'] ?>', value: '<?php echo $data_edit[0]['mr']?>'});
    <?php 
    }
    ?>
    
    //=================================================================================
    //
    //   Unit Measure Data
    //
    //=================================================================================
    
    var url_unit = "<?php echo base_url() ;?>unit_measure/get_unit_measure_list"
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
    //   PO Product Grid
    //
    //=================================================================================
    $("#po-product-grid").on("bindingcomplete", function(event){
        recalculateValue(dataAdapter);
    });
    
    var url = "";
    <?php 
    if(isset($is_edit))
    {?>
        url = "<?php echo base_url()?>po/get_po_product_list?id=<?php echo $data_edit[0]['id_po']; ?>";
    <?php    
    }
    ?>
    
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
            { name: 'unit_price', type: 'number'},
            { name: 'total_price', type: 'number'}
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#po-product-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapter,
        editable: <?php if(isset($is_view)){ echo 'false';}else{ echo 'true';} ?>,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add-product").click(function(){
                <?php if(!isset($is_view))
                {?>
                var offset = $("#remove-product").offset();
                $("#select-product-popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-product").width() + 20, y: parseInt(offset.top)} });
                $("#select-product-popup").jqxWindow('open');
                <?php
                }
                ?>
            });
            $("#remove-product").click(function(){
                <?php if(!isset($is_view))
                {?>
                var selectedrowindex = $("#po-product-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#po-product-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#po-product-grid").jqxGrid('deleterow', id);
                }
                <?php
                }
                ?>
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
            { text: 'Unit Price', dataField: 'unit_price',cellsformat: 'c2',
                cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
    
                    var culture = {};
                    culture.currencysymbol = "Rp. ";
                    culture.currencysymbolposition = "before";
                    culture.decimalseparator = '.';
                    culture.thousandsseparator = ',';
                    return "<div style='margin: 4px;' class='jqx-right-align'>" + dataAdapter.formatNumber(value, "c2", culture) + "</div>";
                },
                validation: function (cell, value) {
                    if (value < 0) {
                      return { result: false, message: "Price should be greate than 0" };
                    }
                    return true;
                }
            },
            { text: 'Total Price', dataField: 'total_price', 
                cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                    var total = parseFloat(rowdata.unit_price) * parseFloat(rowdata.qty);
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
    
    $("#po-product-grid").on('cellvaluechanged', function (event) 
    {
        recalculateValue(dataAdapter);
    });
    
    $("#use-tax").click(function(){
        recalculateValue(dataAdapter);
    });

    $("#po-product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#po-product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    $("#po-product-grid").jqxGrid('setcolumnproperty', 'total_price', 'editable', false);

    
    //=================================================================================
    //
    //   Select Product Grid
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
            { name: 'qty', type: 'number'},
            { name: 'unit_price', type: 'number'},
            { name: 'total_price', type: 'number'}
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
        data['qty'] = 0;
        data['unit_price'] = 0;
        data['total_price'] = 0;
        var commit0 = $("#po-product-grid").jqxGrid('addrow', null, data);
        $("#select-product-popup").jqxWindow('close');
    });
    
     $('#po-product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#po-product-grid').jqxGrid('getrowdata', args.rowindex);

        //alert(JSON.stringify(data));
    });
    
    //=================================================================================
    //
    //   discount
    //
    //=================================================================================
    
    var source = [
                    {name: "Amount", value: "amount"},
                    {name: "Percentage", value: "percentage"}
		        ];
                // Create a jqxDropDownList
                $("#discount-select").jqxDropDownList({ source: source, valueMember: 'value', displayMember: 'name',selectedIndex: 0, width: '200px', height: '25px'<?php if(isset($is_view)){ echo ',disabled: true';} ?>});
          
                $("#discount-value").jqxNumberInput({ width: '150px', height: '25px'<?php if(isset($is_view)){ echo ',disabled: true';} ?>});
                
                <?php 
                if(isset($is_edit))
                {?>
                    $("#discount-select").jqxDropDownList('val', '<?php echo $data_edit[0]['discount_type'] ?>');
                    $("#discount-value").jqxNumberInput('val', <?php echo $data_edit[0]['discount_value'] ?>);
                    recalculateValue(dataAdapter);
                <?php    
                }
                ?>
                
                $("#discount-value").on('change', function(){
                    recalculateValue(dataAdapter);
                });
                
                $("#discount-select").on('change', function(){
                    if($("#discount-select").val() == 'percentage')
                    {
                        $("#discount-value").jqxNumberInput({digits: 2});
                    }
                    else
                    {
                        $("#discount-value").jqxNumberInput({digits: 8});
                    }
                    $("#discount-value").val(0);
                    recalculateValue(dataAdapter);
                });
                //$('#Events').jqxPanel({  height: '250px', width: '200px' });
                //$('#Events').css('border', 'none');
                // subscribe to 'unselect' and 'select' events.
                /*$('#jqxDropDownList').on('select', function (event) {
                    var args = event.args;
                    var item = $('#jqxDropDownList').jqxDropDownList('getItem', args.index);
                    if (item != null) {
                        $('#discount').jqxPanel('prepend', '<div style="margin-top: 5px;">Selected: ' + item.label + '</div>');
                    }
                });
                $('#jqxDropDownList').on('unselect', function (event) {
                    var args = event.args;
                    var item = $('#jqxDropDownList').jqxDropDownList('getItem', args.index);
                    if (item != null) {
                        $('#Discont').jqxPanel('prepend', '<div style="margin-top: 5px;">Unselected: ' + item.label + '</div>');
                    }
                });*/
    
    
    //=================================================================================
    //
    //   PO Validate
    //
    //=================================================================================
    $("#po-validate").click(function(){  
        var data_post = {};
        <?php 
        if(isset($is_edit))
        {?>
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_po'] ?>;
        param.push(item);        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_po'] = $("#id_po").val();
        load_content_ajax(GetCurrentController(), 99, data_post, param);
        <?php 
        }
        else
        {?>
        data_post['date'] = $("#po-date").val('date').format('yyyy-mm-dd');
        data_post['note'] = $("#notes").html();
        data_post['po_number'] = $("#po-number").val();
        data_post['delivery_date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
        data_post['supplier'] = $('#supplier-name').val().value;
        data_post['mr'] = $("#mr").val().value;
        data_post['sub_total'] = $("#subtotal-value").val();
        data_post['discount_type'] = $("#discount-select").val();
        data_post['discount_value'] = $("#discount-value").val();
        data_post['total_price'] = $("#total-value").val();
        data_post['tax'] = $("#tax-value").val();
        data_post['product_detail'] = $('#po-product-grid').jqxGrid('getrows');
        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_po'] = $("#id_po").val(); 
        data_post['action_condition_identifier'] = 'validate';
        load_content_ajax(GetCurrentController(), 61, data_post);
        <?php
        }
        ?>
    });
    
    $("#receive-goods").click(function(){
        var data_post = {};
        data_post['id_po'] = $("#id_po").val();
        load_content_ajax('warehouse', 68, data_post);
    });
    
    $("#receive-payment").click(function(){
        var data_post = {};
        data_post['id_po'] = $("#id_po").val();
        load_content_ajax('warehouse', 'create_payment_receipt', data_post);
    });

                
   
});

function recalculateValue(dataAdapter)
{
    var rows = $("#po-product-grid").jqxGrid('getrows');
    var amount = 0;
    for(var i=0;i<rows.length;i++)
    {
        amount += rows[i].unit_price * rows[i].qty;
    }
    var culture = {};
    culture.currencysymbol = "Rp. ";
    culture.currencysymbolposition = "before";
    culture.decimalseparator = '.';
    culture.thousandsseparator = ',';
    $("#untaxed-amount").html(dataAdapter.formatNumber(amount, "c2", culture));
    if($("#discount-select").val() == 'amount')
    {
        //alert("amount");
        amount = amount - $("#discount-value").val();
    }
    else
    {
         amount = amount * (1 - ($("#discount-value").val() / 100));
    }
    
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
}
    
function SaveData()
{
    var data_post = {};
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] != 'void' || !isset($is_edit) )
    {
        if((isset($is_edit) && $data_edit[0]['status'] == 'draft' ) || !isset($is_edit) )
            {?>
        data_post['date'] = $("#po-date").val('date').format('yyyy-mm-dd');
        data_post['note'] = $("#notes").html();
        data_post['po_number'] = $("#po-number").val();
        data_post['delivery_date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
        data_post['supplier'] = $('#supplier-name').val().value;
        data_post['mr'] = $("#mr").val().value;
        data_post['sub_total'] = $("#subtotal-value").val();
        data_post['total_price'] = $("#total-value").val();
        data_post['tax'] = $("#tax-value").val();
        data_post['use_tax'] = false;
        if($("#use_tax").is(':checked'))
        {
        data_post['use_tax'] = true;
        }
        data_post['discount_type'] = $("#discount-select").val();
        data_post['discount_value'] = $("#discount-value").val();
        data_post['product_detail'] = $('#po-product-grid').jqxGrid('getrows');
        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_po'] = $("#id_po").val(); 
        //alert(JSON.stringify(data_post));
        load_content_ajax(GetCurrentController(), 61, data_post);
        <?php
           }
    }

    ?>
    
}
function DiscardData()
{
    load_content_ajax('administrator', 16 , null);
}

function EditData()
{
    <?php 
    if(isset($is_view))
    {?>
        var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_po']?>;
        param.push(item);        
        data_post['id_po'] = <?php echo $data_edit[0]['id_po']?>;
        load_content_ajax(GetCurrentController(), 59 ,data_post, param);
   
    <?php    
    }
    ?>
}

function printDocument()
{
    <?php 
    if(isset($is_edit))
    {?>
        window.location = "<?php echo base_url() ?>report/create_report?id=<?php echo $data_edit[0]['id_po'] ?>&doc=po&doc_no=<?php echo $data_edit[0]['po_number']?>";
    <?php
    }
    else
    {?>
        alert('Cannot generate report of unposted document');
    <?php  
    }
    ?>
    
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_po" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_po'] : '') ?>" />
<div class="document-action">
    <?php 
    if(!isset($is_view) && isset($is_edit) && $data_edit[0]['status'] == 'draft' || !isset($is_edit))
    {?>
    <button style="margin-left: 20px;" id="po-validate">Validate</button>
    <?php    
    }
    ?>
    
    <?php 
    if(!isset($is_view) && isset($is_edit))
    {
        if($data_edit[0]['status'] != 'draft')
        {
            if($data_edit[0]['status'] != 'good_received')
            {
                if($data_edit[0]['status'] != 'close')
                {
                    if($data_edit[0]['status'] != 'void')
                    {?>
                        <button id="receive-goods">Receive Goods</button>
                    <?php    
                    }
                }
            }
        }
    }
    ?>
    
    
    <?php 
    if(!isset($is_view) && isset($is_edit))
    {
        if($data_edit[0]['status'] != 'draft')
        {
            if($data_edit[0]['status'] != 'payment_received')
            {
                if($data_edit[0]['status'] != 'close')
                {
                    if($data_edit[0]['status'] != 'void')
                    {?>
                        <button id="receive-payment">Payment Receipt</button>
                    <?php    
                    }
                }
            }
        }
    }
    ?>
    
    
    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'draft' ? 'class="status-active"' : '') ?> >
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
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'good_received' ? 'class="status-active"' : '') ?>>
            <span class="label">Good Received</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'payment_received' ? 'class="status-active"' : '') ?>>
            <span class="label">Payment Received</span>
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
        <div><h1 style="font-size: 18pt; font-weight: bold;">Purchase Order / <span><?php echo (isset($is_edit) ? $data_edit[0]['po_number'] : ''); ?></span></h1></div>
        <input type="hidden" id="po-number" value="<?php echo (isset($is_edit) ? $data_edit[0]['po_number'] : ''); ?>" />
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            PO Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="po-date"></div>
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
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Supplier
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="supplier-name" name="name" value=""/>
                            <button id="supplier-select">...</button>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            MR Ref.
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%" class="field" type="text" id="mr" name="name" value=""/>
                            <button id="mr-select">...</button>
                        </div>
                    </td>
                </tr>
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
                    <td style="width: 80%;" colspan="2">
                        <div id="po-product-grid"></div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 80%" colspan="2">
                        <div id='jqxExpander'>
                            <div>
                                Purchase Order History
                            </div>
                            <div>
                                <div id="po-history-grid"></div>
                            </div>
                        </div>
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
                                <td><div id="discount-select"></div></td>
                                <td>Discount : </td>
                                <td style="width: 150px;"><div id="discount-value"></div><input type="hidden" id="discount" value="<?php echo (isset($is_edit) ? $data_edit[0]['sub_total'] : '0') ?>"/></td>
                            </tr>                   
                            <tr>
                                <td style="padding-right: 10px;"><!--<div id="tax-select">--></td>
                                <td><input type="checkbox" id="use-tax" style="display: inline-block;" <?php echo (isset($is_edit) && ($data_edit[0]['tax'] != null || $data_edit[0]['tax'] > 0) ? 'checked=true' : '') ?> <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>/>Taxes (10%) : </td>
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
                        <textarea <?php if(isset($is_view)){ echo 'disabled=disabled';} ?> class="field" id="notes" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['note'] : '') ?></textarea>
                    </td>
                </tr>
            </table>
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

<div id="select-supplier-popup">
    <div>Select Supplier</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-supplier-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="select-mr-popup">
    <div>Select Material Request</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-mr-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>