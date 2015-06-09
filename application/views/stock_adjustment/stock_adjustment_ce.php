<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){  
    $("#stock_adjustment-date").jqxDateTimeInput({width: '250px', height: '25px'});
    $("#select-product-stock_adjustmentpup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#stock_adjustment-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date'])) . "'" ?>); 
    <?php 
    }
    ?>
    

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
            { name: 'id_supplier'},
            { name: 'name'},
            { name: 'supplier_code'},
            { name: 'contact'}
        ],
        id: 'id_supplier',
        url: urlSupplier ,
        root: 'data'
    };
    var dataAdapterSupplier = new $.jqx.dataAdapter(sourceSupplier);
    
    
    $("#supplier-name").jqxInput({ source: dataAdapterSupplier, displayMember: "name", valueMember: "id_supplier", height: 23});
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#supplier-name").jqxInput('val', {label: '<?php echo $data_edit[0]['supplier_name'] ?>', value: '<?php echo $data_edit[0]['supplier']?>'});
    <?php 
    }
    ?>
    $("#select-supplier-stock_adjustmentpup").jqxWindow({
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
            { text: 'Code', dataField: 'supplier_code', width: 150},
            { text: 'Name', dataField: 'name'},
            { text: 'Contact', dataField: 'contact', width: 150}                                      
        ]
    });
    
    $("#supplier-select").click(function(){
        $("#select-supplier-stock_adjustmentpup").jqxWindow('open');
    });
    
    $('#select-supplier-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-supplier-grid').jqxGrid('getrowdata', args.rowindex);
        $('#supplier-name').jqxInput('val', {label: data.name, value: data.id_supplier});
        $("#select-supplier-stock_adjustmentpup").jqxWindow('close');
    });
    
    $("#mr-select").click(function(){
        alert(JSON.stringify($('#supplier-name').jqxInput('val')));
        alert($('#supplier-name').val().value);
    });
    
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
    //   stock_adjustment Product Grid
    //
    //=================================================================================
    $("#stock_adjustment-product-grid").on("bindingcomplete", function(event){
        var culture = {};
        culture.currencysymbol = "Rp. ";
        $("#stock_adjustment-product-grid").jqxGrid('localizestrings', culture);
        
        var rows = $("#stock_adjustment-product-grid").jqxGrid('getrows');
        var amount = 0;
        for(var i=0;i<rows.length;i++)
        {
            amount += rows[i].unit_price * rows[i].qty;
        }
        var culture = {};
        culture.currencysymbol = "Rp. ";
        culture.currencysymbolstock_adjustmentsition = "before";
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
    
    var url = "<?php if(isset($is_edit)){?><?php echo base_url()?>stock_adjustment/get_stock_adjustment_product_list?id=<?php echo $data_edit[0]['id_stock_adjustment']; ?> <?php }?>";
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
    $("#stock_adjustment-product-grid").jqxGrid(
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
                $("#select-product-stock_adjustmentpup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-product").width() + 20, y: parseInt(offset.top)} });
                $("#select-product-stock_adjustmentpup").jqxWindow('open');
            });
            $("#remove-product").click(function(){
                var selectedrowindex = $("#stock_adjustment-product-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#stock_adjustment-product-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#stock_adjustment-product-grid").jqxGrid('deleterow', id);
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
            { text: 'Unit Price', dataField: 'unit_price',cellsformat: 'c2',
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
                    culture.currencysymbolstock_adjustmentsition = "before";
                    culture.decimalseparator = '.';
                    culture.thousandsseparator = ',';
                    return "<div style='margin: 4px;' class='jqx-right-align'>" + dataAdapter.formatNumber(total, "c2", culture) + "</div>";
                }
            }
        ]
    });
    
    $("#stock_adjustment-product-grid").on('cellvaluechanged', function (event) 
    {
        var rows = $("#stock_adjustment-product-grid").jqxGrid('getrows');
        var amount = 0;
        for(var i=0;i<rows.length;i++)
        {
            amount += rows[i].unit_price * rows[i].qty;
        }
        var culture = {};
        culture.currencysymbol = "Rp. ";
        culture.currencysymbolstock_adjustmentsition = "before";
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
        var rows = $("#stock_adjustment-product-grid").jqxGrid('getrows');
        var amount = 0;
        for(var i=0;i<rows.length;i++)
        {
            amount += rows[i].unit_price * rows[i].qty;
        }
        var culture = {};
        culture.currencysymbol = "Rp. ";
        culture.currencysymbolstock_adjustmentsition = "before";
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

    $("#stock_adjustment-product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#stock_adjustment-product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    $("#stock_adjustment-product-grid").jqxGrid('setcolumnproperty', 'total_price', 'editable', false);
    
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
        var commit0 = $("#stock_adjustment-product-grid").jqxGrid('addrow', null, data);
        $("#select-product-stock_adjustmentpup").jqxWindow('close');
    });
    
     $('#stock_adjustment-product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#stock_adjustment-product-grid').jqxGrid('getrowdata', args.rowindex);

        //alert(JSON.stringify(data));
    });
    
    //=================================================================================
    //
    //   stock_adjustment Validate
    //
    //=================================================================================
    $("#stock_adjustment-validate").click(function(){  
        var data_stock_adjustmentst = {};
        <?php 
        if(isset($is_edit))
        {?>
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_stock_adjustment'] ?>;
        param.push(item);        
        data_stock_adjustmentst['is_edit'] = $("#is_edit").val(); 
        data_stock_adjustmentst['id_stock_adjustment'] = $("#id_stock_adjustment").val();
        load_content_ajax(GetCurrentController(), 99, data_stock_adjustmentst, param);
        <?php 
        }
        else
        {?>
        data_stock_adjustmentst['action_condition_identifier'] = 'validate';
        load_content_ajax(GetCurrentController(), 61, data_stock_adjustmentst);
        <?php
        }
        ?>
    });
    
    $("#receive-goods").click(function(){
        var data_stock_adjustmentst = {};
        data_stock_adjustmentst['id_stock_adjustment'] = $("#id_stock_adjustment").val();
        load_content_ajax('warehouse', 68, data_stock_adjustmentst);
    });
    
    $("#receive-payment").click(function(){
        var data_stock_adjustmentst = {};
        data_stock_adjustmentst['id_stock_adjustment'] = $("#id_stock_adjustment").val();
        load_content_ajax('warehouse', 101, data_stock_adjustmentst);
    });
                
   
});

function SaveData()
{
    var data_stock_adjustmentst = {};
    
    data_stock_adjustmentst['date'] = $("#stock_adjustment-date").val('date').format('yyyy-mm-dd');
    data_stock_adjustmentst['note'] = $("#notes").html();
    data_stock_adjustmentst['delivery_date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
    data_stock_adjustmentst['supplier'] = $('#supplier-name').val().value;
    data_stock_adjustmentst['mr'] = $("#mr").val();
    data_stock_adjustmentst['sub_total'] = $("#subtotal-value").val();
    data_stock_adjustmentst['total_price'] = $("#total-value").val();
    data_stock_adjustmentst['tax'] = $("#tax-value").val();
    data_stock_adjustmentst['product_detail'] = $('#stock_adjustment-product-grid').jqxGrid('getrows');
    
    data_stock_adjustmentst['is_edit'] = $("#is_edit").val(); 
    data_stock_adjustmentst['id_stock_adjustment'] = $("#id_stock_adjustment").val(); 
    //alert(JSON.stringify(data_stock_adjustmentst));
    load_content_ajax(GetCurrentController(), 61, data_stock_adjustmentst);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 16 , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_stock_adjustment" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_stock_adjustment'] : '') ?>" />
<div class="document-action">
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] == 'draft')
    {?>
    <button style="margin-left: 20px;" id="stock_adjustment-validate">Validate</button>
    <?php    
    }
    ?>
    
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] != 'good_received' && $data_edit[0]['status'] != 'close')
    {?>
    <button id="receive-goods">Receive Goods</button>
    <?php    
    }
    ?>
    
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] != 'payment_received' && $data_edit[0]['status'] != 'close')
    {?>
    <button id="receive-payment">Receive Payment</button>
    <?php    
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
        <div><h1 style="font-size: 18pt; font-weight: bold;">Stock Adjustment / <span><?php echo (isset($is_edit) ? $data_edit[0]['stock_adjustment_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td colspan="2">
                        <div class="label">
                            Description
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 80%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="supplier-name" name="name" value=""/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Adjustment Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="stock_adjustment-date"></div>
                        </div>
                    </td>
                    <td>
                    
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
                        <div id="stock_adjustment-product-grid"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div id="select-product-stock_adjustmentpup">
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

<div id="select-supplier-stock_adjustmentpup">
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
