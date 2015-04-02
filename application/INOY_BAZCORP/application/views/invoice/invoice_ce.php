<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', readonly: true}); 
    
    $("#clear-delivery-date").click(function(){
        $("#delivery-date").val(null);
    
    });
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['invoice_date'])) . "'" ?>);   
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
    //   Bank Input
    //
    //=================================================================================
    
    var urlSupplier = "<?php echo base_url() ;?>bank/get_bank_list";
    var sourceSupplier =
    {
        datatype: "json",
        datafields:
        [
                    { name: 'id_bank'},
                    { name: 'bank_name'},
                    { name: 'bank_account'},
                    { name: 'bank_user'},
                    
        ],
        id: 'id_bank',
        url: urlSupplier ,
        root: 'data'
    };
    var dataAdapterSupplier = new $.jqx.dataAdapter(sourceSupplier);
    
    
    $("#rekening").jqxInput({ source: dataAdapterSupplier, displayMember: "bank_account", valueMember: "id_bank", height: 23});
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#rekening").jqxInput('val', {label: '<?php echo $data_edit[0]['bank_account'] ?>', value: '<?php echo $data_edit[0]['rekening']?>'});
    <?php 
    }
    ?>
    $("#select-bank-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-bank-grid").jqxGrid(
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
            { text: 'Bank User', dataField: 'bank_user', width: 150},
            { text: 'Bank Account', dataField: 'bank_account'},
            { text: 'Bank Name', dataField: 'bank_name', width: 150}                                      
        ]
    });
    
    $("#bank-select").click(function(){
        $("#select-bank-popup").jqxWindow('open');
    });
    
    $('#select-bank-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-bank-grid').jqxGrid('getrowdata', args.rowindex);
        $('#rekening').jqxInput('val', {label: data.bank_account, value: data.id_bank});
        $("#select-bank-popup").jqxWindow('close');
    });
    
    
    //=================================================================================
    //
    //   SO Select
    //
    //=================================================================================
    
    var urlPO = "<?php echo base_url() ;?>so/get_so_delivery_list";
    var sourcePO =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_so'},
            { name: 'so_number'},
            { name: 'customer'},
            { name: 'customer_name'},
            { name: 'po_customer'},
            { name: 'date'},
            { name: 'sub_total'},
            { name: 'tax'},
            { name: 'total_price'}
        ],
        id: 'id_so',
        url: urlPO ,
        root: 'data'
    };
    var dataAdapterPO = new $.jqx.dataAdapter(sourcePO);
    
    
    $("#so-no").jqxInput({ source: dataAdapterPO, displayMember: "so_number", valueMember: "id_so", height: 23});
    
    $("#so-no").jqxInput({disabled: true});
    
    $("#select-so-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-so-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapterPO,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'SO No.', dataField: 'so_number', width: 150},
            { text: 'Customer', dataField: 'customer_name'},
            { text: 'Date', dataField: 'date', width: 150}                                   
        ]
    });
    
    $("#so-select").click(function(){
        $("#select-so-popup").jqxWindow('open');
    });
    
    $('#select-so-grid').on('rowdoubleclick', function (event) 
    {
        <?php 
        if(!isset($is_edit))
        {?>
        var args = event.args;
        var data = $('#select-so-grid').jqxGrid('getrowdata', args.rowindex);
        $('#so-no').jqxInput('val', {label: data.so_number, value: data.id_so});
        var url = "<?php echo base_url()?>so/get_so_product_list?id=" + data.id_so;
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
        $("#so-product-grid").jqxGrid({source: dataAdapter});
        $("#select-so-popup").jqxWindow('close');
        $("#subtotal").jqxNumberInput('val', data.sub_total);
        $("#tax").jqxNumberInput('val', data.tax);
        $("#total").jqxNumberInput('val', data.total_price);
        
        var urlHistory = "<?php echo base_url() ?>invoice/get_invoice_history?id_so=" + data.id_so ;
        var sourceHistory =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_invoice'},
                { name: 'invoice_date', type: 'date'},
                { name: 'total_invoice'},
                { name: 'invoice_number'}
            ],
            id: 'id_invoice',
            url: urlHistory ,
            root: 'data'
        };
        var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
        $("#invoice-history-grid").jqxGrid({source: dataAdapterHistory});
        <?php    
        }
        ?>
        
        get_invoice_left(data.id_so, null);
        
    });
    
    <?php 
    if(isset($from_so) && $from_so == 'true')
    {?>
    
        $('#so-no').jqxInput('val', {label: '<?php echo $so[0]['so_number'] ?>', value: '<?php echo $so[0]['id_so'] ?>'});
    
    <?php    
    }
    ?>
    
    <?php 
    if(isset($is_edit))
    {?>
    
        $('#so-no').jqxInput('val', {label: '<?php echo $so[0]['so_number'] ?>', value: '<?php echo $data_edit[0]['so'] ?>'});
    
    <?php    
    }
    ?>
    
    //=================================================================================
    //
    //   SO Product Grid
    //
    //=================================================================================
    $("#so-product-grid").on("bindingcomplete", function(event){
        var culture = {};
        culture.currencysymbol = "Rp. ";
        $("#so-product-grid").jqxGrid('localizestrings', culture);
        
        var rows = $("#so-product-grid").jqxGrid('getrows');
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
    
    var url = "";
    <?php 
    if(isset($is_edit))
    {?>
        url = "<?php echo base_url()?>so/get_so_product_list?id=<?php echo $data_edit[0]['so']; ?>";
    <?php    
    }
    ?>
    
    <?php 
    if(isset($from_so))
    {?>
        url = "<?php echo base_url()?>so/get_so_product_list?id=<?php echo $so[0]['id_so']; ?>";
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
    $("#so-product-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapter,
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
                var selectedrowindex = $("#so-product-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#so-product-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#so-product-grid").jqxGrid('deleterow', id);
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
                    culture.currencysymbolposition = "before";
                    culture.decimalseparator = '.';
                    culture.thousandsseparator = ',';
                    return "<div style='margin: 4px;' class='jqx-right-align'>" + dataAdapter.formatNumber(total, "c2", culture) + "</div>";
                }
            }
        ]
    });
    
    $("#subtotal").jqxNumberInput({ width: '80%', height: '25px', symbol: 'Rp. ',  spinButtons: false, readOnly: true, promptChar: "", digits: 9 , disabled: true});
    $("#subtotal").jqxNumberInput('val', 0);
    
    
    $("#tax").jqxNumberInput({ width: '80%', height: '25px', symbol: 'Rp. ',  spinButtons: false, readOnly: true, promptChar: "", digits: 9 , disabled: true});
    $("#tax").jqxNumberInput('val', 0);
  
    $("#total").jqxNumberInput({ width: '90%', height: '25px', symbol: 'Rp. ',  spinButtons: false, readOnly: true, promptChar: "", digits: 9 , disabled: true});

    $("#total").jqxNumberInput('val', 0);
    
    
    $("#invoice").jqxNumberInput({ width: '80%', height: '25px', symbol: 'Rp. ',  spinButtons: false, readOnly: false, digits: 9, min: 0});
    $("#invoice").jqxNumberInput('val', 0);
    
    $("#invoice-left").jqxNumberInput({ width: '80%', height: '25px', symbol: 'Rp. ',  spinButtons: false, readOnly: true, promptChar: "", digits: 9 , disabled: true});
    $("#invoice-left").jqxNumberInput('val', 0);
    
    
    <?php
    if(isset($from_so))
    {?>
        $("#subtotal").jqxNumberInput('val', <?php echo $so[0]['sub_total'] ?>);
        $("#tax").jqxNumberInput('val', <?php echo $so[0]['tax'] ?>);
        $("#total").jqxNumberInput('val', <?php echo $so[0]['total_price'] ?>);
        $("#invoice-left").jqxNumberInput('val', <?php echo $so[0]['total_price'] ?>);
    <?php    
    }
    ?>
    
        
    
    
    $("#invoice").on('valueChanged', function (event){
        var value = event.args.value;
        $("#difference").jqxNumberInput('val',$("#invoice-left").jqxNumberInput('val') - value);
    });
    
    $("#difference").jqxNumberInput({ width: '80%', height: '25px', symbol: 'Rp. ',  spinButtons: false, readOnly: false, promptChar: "" ,disabled: true});
    $("#difference").jqxNumberInput('val', 0);
    
    
    //=================================================================================
    //
    //   Edit Mode
    //
    //=================================================================================
    <?php
    if(isset($is_edit))
    {?>
    $("#subtotal").jqxNumberInput('val', <?php echo $data_edit[0]['sub_total'] ?>);
    $("#tax").jqxNumberInput('val', <?php echo $data_edit[0]['tax'] ?>);
    $("#total").jqxNumberInput('val', <?php echo $data_edit[0]['total_price'] ?>);
    $("#invoice").jqxNumberInput('val', <?php echo $data_edit[0]['total_payment'] ?>);
    $("#difference").jqxNumberInput('val',$("#invoice-left").jqxNumberInput('val') - $("#invoice").jqxNumberInput('val'));
    <?php
    }
    ?>
    
    $("#payment_receipt").click(function(){
        var data_post = {};
        
        data_post['note'] = $("#notes").html();
        data_post['date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
        data_post['id_so'] = $("#so-no").val().value;
        data_post['total_payment'] = $("#invoice").val();
        data_post['difference'] = $("#difference").val();
        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_invoice'] = $("#id_invoice").val(); 
        var invoice_method = $("input[name='invoice']:checked").val();
        data_post['invoice_method'] = invoice_method;
        data_post['rekening'] = $("#rekening").val().value;
        data_post['action_condition_identifier'] = 'payment_receipt';
        
        load_content_ajax(GetCurrentController(), 140, data_post);
    });
    
     $("#cancel-invoice").click(function(){
        var data_post = {};
        data_post['id_invoice'] = $("#id_invoice").val();
        load_content_ajax(GetCurrentController(), 143, data_post);
    });
    
    //=================================================================================
    //
    //   invoice History Grid
    //
    //=================================================================================
    
    $("#invoice-history-grid").on("bindingcomplete", function(event){
        var culture = {};
        culture.currencysymbol = "Rp. ";
        $("#invoice-history-grid").jqxGrid('localizestrings', culture);
    });
    
    var urlHistory = "";
    <?php 
    if(isset($is_edit))
    {?>
        urlHistory = "<?php echo base_url()?>invoice/get_invoice_history?id_so=<?php echo $data_edit[0]['so']; ?>" + "&id_invoice=<?php echo $data_edit[0]['id_invoice']; ?>";
    <?php    
    }
    ?>
    
    <?php 
    if(isset($from_so))
    {?>
        urlHistory = "<?php echo base_url()?>invoice/get_invoice_history?id_so=<?php echo $so[0]['id_so']; ?>";
    <?php    
    }
    ?>
    
    var sourceHistory =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_invoice'},
            { name: 'invoice_date', type: 'date'},
            { name: 'total_payment', type: 'number'},
            { name: 'invoice_receipt_number'},

        ],
        id: 'id_invoice',
        url: urlHistory ,
        root: 'data'
    };
    var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
    $("#invoice-history-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapterHistory,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'invoice Number', dataField: 'invoice_receipt_number'},
            { text: 'Invoice Date', dataField: 'invoice_date', cellsformat: 'dd/MM/yyyy'},
            { text: 'Total Invoice', dataField: 'total_payment', cellsformat: 'c2'}
        ]
    });
    
    
    
    $("#jqxExpander").jqxExpander({ width: '100%', expanded: false});
    
    function get_invoice_left(id_so, id_invoice)
    {
        var invoice = "";
        if(id_invoice !== null)
        {
            invoice = "&id_invoice=" + id_invoice;
        }
        
        var urlAjax = "<?php echo base_url() ?>invoice/get_invoice_left?id_so=" + id_so + invoice;
        var data_post = {};
        $.ajax({
            url: urlAjax,
    		type: "POST",
    		data: data_post,
    		success: function(output){
                try
                {
                    obj = JSON.parse(output);
                }
                catch(err)
                {
                    alert('Fatal error is happening with message : ' + output + '=====> Please contact your system administrator.');
                }
                $("#invoice-left").jqxNumberInput('val', JSON.stringify(obj));
                $("#difference").jqxNumberInput('val',$("#invoice-left").jqxNumberInput('val') - $("#invoice").jqxNumberInput('val'));
                $(window).scrollTop(0);
    		},
            error: function( jqXhr ) 
            {

            }
        });
    }
    

    $("#invoice-transfer").prop('checked', true);
    
    <?php
    if(isset($is_edit))
    {
        if($data_edit[0]['invoice_method'] == 'transfer')
        {?>                        
            $("#invoice-transfer").prop('checked', true);
        <?php
        }
        else if($data_edit[0]['invoice_method'] == 'cash')
        {
        ?>
            $("#invoice-cash").prop('checked', true);
        <?php       
        }           
        ?>
    
    <?php    
    } 
    ?>            
                
    $("#invoice-cash").change(function(){
        $("#rekening-tr").css('display', 'none');
    });
    
    $("#invoice-transfer").change(function(){
        $("#rekening-tr").css('display', 'block');
    });
    
    <?php
    if(isset($is_edit))
    {?>                       
        get_invoice_left(<?php echo $data_edit[0]['so'] ?>, <?php echo $data_edit[0]['id_invoice'] ?>);
    <?php    
    } 
    ?> 
    
    <?php
    if(isset($from_so))
    {?>                   
        get_invoice_left(<?php echo $so[0]['id_so'] ?>, null);
    <?php    
    } 
    ?> 

});

function SaveData()
{
    var data_post = {};
    <?php
    if(!isset($is_edit) || (isset($is_edit) && $data_edit[0]['status'] == 'open'))
    {?>
        data_post['note'] = $("#notes").html();
        data_post['date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
        data_post['id_so'] = $("#so-no").val().value;
        data_post['total_payment'] = $("#invoice").val();
        data_post['difference'] = $("#difference").val();
        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_invoice'] = $("#id_invoice").val(); 
        var invoice_method = $("input[name='invoice']:checked").val();
        data_post['invoice_method'] = invoice_method;
        data_post['rekening'] = $("#rekening").val();
        load_content_ajax(GetCurrentController(), 140, data_post);
    <?php 
    }
    else
    {
        if($data_edit[0]['status'] == 'close' || $data_edit[0]['status'] == 'cancel')
        {?>
        load_content_ajax('administrator', 136 , null);
        <?php    
        }
    }
    ?>
    
    
    
    
}
function DiscardData()
{
    load_content_ajax('administrator', 136 , null);
}

function printDocument()
{
    <?php 
    if(isset($is_edit))
    {?>
        window.location = "<?php echo base_url() ?>report/create_report?id=<?php echo $data_edit[0]['id_invoice'] ?>&doc=invoice&doc_no=<?php echo $data_edit[0]['invoice_receipt_number']?>";
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
<input type="hidden" id="id_invoice" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_invoice'] : '') ?>" />
<div class="document-action">
    <?php 
    if(!isset($is_edit) || (isset($is_edit) && ($data_edit[0]['status'] != 'close' && $data_edit[0]['status'] != 'cancel')))
    {?>
    <button id="payment_receipt">payment Receipt</button>
    <?php    
    }
    ?>
    
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] == 'close')
    {?>
    <button id="cancel-invoice">Cancel Invoice</button>
    <?php    
    }
    ?>
    
    
    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'open' ? 'class="status-active"' : '') ?> >
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
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'cancel' ? 'class="status-active"' : '') ?>>
            <span class="label">Cancel</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Invoice / <span><?php echo (isset($is_edit) ? $data_edit[0]['invoice_receipt_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            SO No.
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="so-no" name="name" value="" disabled="true"/>
                            <?php if(!isset($is_edit)){?><button id="so-select">...</button><?php } ?>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="delivery-date" style="display: inline-block;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Subtotal
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="subtotal" style="display: inline-block;"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Tax
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="tax" style="display: inline-block;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="label">
                            Total
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="total" style="display: inline-block;"></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%" colspan="2">
                        <div id='jqxExpander'>
                            <div>
                                Product Detail
                            </div>
                            <div>
                                <div id="so-product-grid"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">                       
                         <div class="row-color" style="width: 100%; padding: 3px;">
                            <div style="display: inline;"><span>Invoice History</span></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%" colspan="2">
                        <div id="invoice-history-grid"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 90%;">
                        <div class="label">
                            invoice Left
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="invoice-left" style="display: inline-block;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Invoice
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="invoice" style="display: inline-block;"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Difference
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="difference" style="display: inline-block;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">                       
                         <div class="row-color" style="width: 100%; padding: 3px;">
                            <div style="display: inline;"><span>Invoice Method</span></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Transfer
                        </div>
                        <div class="column-input" colspan="2">
                            <input type="radio" name="invoice" value="transfer" id="invoice-transfer" /> 
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Cash
                        </div>
                        <div class="column-input" colspan="2">
                            <input type="radio" name="invoice" value="cash" id="invoice-cash"/> 
                        </div>
                    </td>
                </tr>
                <tr id="rekening-tr">
                    <td>
                        <div class="label">
                            Rekening                                       
                        </div>
                        <div class="column-input" colspan="2" style="width: 100%;">
                            <input class="field" type="text" id="rekening" value="<?php echo (isset($is_edit) ? $data_edit[0]['rekening'] : '') ?>" />
                            <?php if(!isset($is_edit)){?><button id="bank-select">...</button><?php } ?>
                        </div>
                    </td>
                    <td>
                       
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
    </div>
</div>

<div id="select-so-popup">
    <div>Select SO</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-so-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="select-bank-popup">
    <div>Select bank</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-bank-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>