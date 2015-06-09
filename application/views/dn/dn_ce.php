<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', value: null <?php if(isset($is_view)){ echo ',disabled: true';} ?>}); 
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-product-barcode-popup").jqxWindow({
        width: 400, height: 300, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'm/d/Y' , strtotime($data_edit[0]['date'])) . "'" ?>); 
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
				{ name: 'product'},
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
        $("#so-product-grid").jqxGrid({source: dataAdapter});
       
        
        $("#select-mr-popup").jqxWindow('close');
        $('#mr').jqxInput('val', {label: data.mr_number, value: data.id_mr});        
        
		$("#wo_no").val(data.work_order_number);
        $("#id_wo").val(data.work_order);
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
    //   Get Qty from Warehouse
    //
    //=================================================================================
    
    function get_qty_warehouse(product, warehouse, section, rowid)
    {
        //alert(product + ' ' + warehouse + ' ' + rowid);
        var ajaxUrl = '<?php echo base_url() ?>stock/get_stock_from_warehouse?prod=' + product + '&wh=' + warehouse;
        var data_post = {};
        $.ajax({
            url: ajaxUrl,
    		type: "POST",
    		data: data_post,
    		success: function(output)
            {	
                //alert(output);
                try
                {
                    obj = JSON.parse(output);
                }
                catch(err)
                {
                    alert('Fatal error is happening with message : ' + output + '=====> Please contact your system administrator.');
                }
                
                if(section == 'grid')
                {
                    var total = 0;
                    if(obj.length != 0)
                    {
                        total = obj[0].total_qty;
                    }
                    //alert(total);
                    //var data = $('#so-product-grid').jqxGrid('getrowdata', rowid);
                    //data['qty_available'] = total;
                    $("#so-product-grid").jqxGrid('setcellvalue', rowid, "qty_available", total);
                    //var value = $('#so-product-grid').jqxGrid('updaterow', rowid, data);
                }
                else
                {
                    
                    if(obj.length == 0)
                    {
                        $("#qty_available").val(0);
                    }
                    else
                    {
                        $("#qty_available").val(obj[0].total_qty);
                    }
                }
    		},
            error: function( jqXhr ) 
            {
               if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                    var json = $.parseJSON( jqXhr.responseText );
                    alert(json);
                }
                $("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
                $("#error-notification-default").jqxWindow("open");
            }
        });
    
    }
    
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
		<?php if(isset($is_edit))
		{?>
			for(var i=0;i<rows.length;i++)
			{
				get_qty_warehouse(rows[i].product, rows[i].source_location, "grid", i);
			}
		<?php
		}
		?>
		
        <?php if((isset($is_edit) && $data_edit[0]['status_dn'] != 'draft') || !isset($is_edit))
       {?>
		
        $('#so-product-grid').jqxGrid('hidecolumn', 'barcode');
        <?php
       } 
       ?>

    });
    
    var url = "";
    <?php 
    if(isset($is_edit))
    {?>
        url = "<?php echo base_url()?>dn/get_dn_product_list?id=<?php echo $data_edit[0]['id_dn']; ?>";
    <?php    
    }
    ?>
    
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_product'},
            { name: 'source_location'},
            { name: 'warehouse_name'},
            { name: 'product'},
            { name: 'product_category'},
            { name: 'merk'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'name'},
            { name: 'unit_name'},
            { name: 'unit'},            
            { name: 'category_name'},
            { name: 'qty', type: 'number'},
            { name: 'qty_available', type: 'number'},
            { name: 'unit_price', type: 'number'},
            { name: 'total_price', type: 'number'},
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    
    $("#so-product-grid").on('cellvaluechanged', function (event) 
    {
        var args = event.args;
        var datafield = event.args.datafield;
        if(datafield == 'source_location')
        {
            var rowid = args.rowindex;
            var product = $('#so-product-grid').jqxGrid('getrowdata', rowid).product;
            get_qty_warehouse(product, args.newvalue.value, "grid",rowid);
        }

    });
    
    $("#so-product-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        <?php if(isset($is_view)){ echo 'disabled: true,';} ?>
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
            { text: 'Warehouse', dataField: 'source_location', displayfield: 'warehouse_name', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: dataAdapter_select_warehouse, displayMember: 'name', valueMember: 'id_warehouse' });
                }},
            {text: 'Stock', dataField: 'qty_available', displayfield: 'qty_available'},
            { text: 'Quantity', dataField: 'qty'},
            { text: 'Barcode', datafield: 'barcode'}
        ]
    });
    $("#so-product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#so-product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    //$("#so-product-grid").jqxGrid('setcolumnproperty', 'qty_available', 'editable', false);
    
    $("#so-product-grid").on('rowdoubleclick', function(event){
        var args = event.args;
        var data = $('#so-product-grid').jqxGrid('getrowdata', args.rowindex);
        //alert(JSON.stringify(data));
    });
   
   <?php if((isset($is_edit) && $data_edit[0]['status_dn'] != 'draft') || !isset($is_edit))
   {?>
    $('#so-product-grid').jqxGrid('hidecolumn', 'barcode');
    <?php
   } 
   ?>
    
    
    
    //=================================================================================
    //
    //   Warehouse Data
    //
    //=================================================================================
    
    var url_select_warehouse = "<?php echo base_url() ;?>gudang/get_gudang_not_virtual_list"
    var source_select_warehouse =
    {
         datatype: "json",
         datafields: [
             { name: 'id_warehouse'},
             { name: 'name'},
             { name: 'is_virtual'}
         ],
        id: 'id_warehose',
        url: url_select_warehouse ,
        root: 'data'
    };
    
    var dataAdapter_select_warehouse = new $.jqx.dataAdapter(source_select_warehouse, {
        autoBind: true
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
    //   DN Validate
    //
    //================================================================================= 
    $("#dn-validate").click(function(){  
        <?php 
        if(isset($is_edit))
        {?>
            var data = $('#so-product-grid').jqxGrid('getrows');
            var allVerified = true;
            /*for(i=0;i<data.length;i++)
            {
                if(data[i]['barcode'] != 'verified')
                {
                    allVerified = false;
                    break;
                }
            }*/
            
            if(allVerified == true)
            {
                var data_input = {};
                //data_input['warehouse'] = $("#destination-select").val().value;
                
                var products = [];
                var productGrid = $('#so-product-grid').jqxGrid('getrows');
                var i=0;
                for(i=0;i<productGrid.length;i++)
                {
                    var row = {};
                    row['product'] = productGrid[i].id_product;
                    row['uom'] = productGrid[i].unit;
                    row['qty'] = productGrid[i].qty;
                    row['warehouse'] = productGrid[i].source_location;
                    products.push(row);
                }
                data_input['is_edit'] = $("#is_edit").val(); 
                data_input['id_dn'] = $("#id_dn").val(); 
				data_input['date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
                data_input['products'] = products;
                data_input['mr'] = $('#mr').val().value;
				
				data_input['action_condition_identifier'] = 'make_payment';
                //alert(JSON.stringify(data_input));
                
                var param = [];
                var item = {};
                item['paramName'] = 'id';
                item['paramValue'] = <?php echo $data_edit[0]['id_dn'] ?>;
                param.push(item);    
                //alert(JSON.stringify(data_input));    
                load_content_ajax(GetCurrentController(), 'validate_dn', data_input, param); 
            }
            else
            {
                alert('Please verified barcode for all product');
            }
        <?php 
        }
        else
        {?>
        load_content_ajax(GetCurrentController(), 83, data_post);
        <?php
        }
        ?>
    });
    
    $("#dn-return").click(function(){  
        var data_post = {};
        <?php 
        if(isset($is_edit))
        {?>
        var data_input = {};
            //data_input['warehouse'] = $("#destination-select").val().value;
            
            var products = [];
            var productGrid = $('#so-product-grid').jqxGrid('getrows');
            var i=0;
            for(i=0;i<productGrid.length;i++)
            {
                if(productGrid[i].qty_received > productGrid[i].qty_available)
                {
                    alert('Cannot save data. Qty request greater than stock available');
                    throw '';
                }
                var row = {};
                row['product'] = productGrid[i].id_product;
                row['uom'] = productGrid[i].unit;
                row['qty'] = productGrid[i].qty_received;
                row['warehouse'] = productGrid[i].source_location;
                products.push(row);
            }
            
            data_input['products'] = products;
            data_post['mr'] = $('#mr').val().value;
            //alert(JSON.stringify(data_input));
            
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit[0]['id_dn'] ?>;
            param.push(item);    
            //alert(JSON.stringify(data_input));    
            load_content_ajax(GetCurrentController(), 157, data_input, param);
        <?php
        }
        ?>
    });
    
    $("#scan-barcode").click(function(){
        $(window).unbind('keypress');
        $(window).bind('keypress', keypress_handler);
        $("#barcode-number").focus();
        $("#select-product-barcode-popup").jqxWindow('open');
            
    });
    
    $("#select-product-barcode-popup").on('close', function(event){
        $("#barcode-number").val(null);
        $(window).unbind('keypress');
    });
    
});
    
function SaveData()
{
    var data_post = {};
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] != 'void' || !isset($is_edit))
    {?>
    data_post['date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
    data_post['note'] = $("#notes").html();
	data_post['mr'] = $('#mr').val().value;
    data_post['product_detail'] = $('#so-product-grid').jqxGrid('getrows');
    
    for(i=0;i<data_post['product_detail'].length;i++)
    {
        if(data_post['product_detail'][i]['qty'] > data_post['product_detail'][i]['qty_available'])
        {
            alert('Cannot save data. Qty request greater than stock available');
            throw '';
        }
    }
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_dn'] = $("#id_dn").val();
    //alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 'save_edit_delivery_note', data_post);
    <?php   
    }
    ?>
}
function DiscardData()
{
    load_content_ajax('administrator', 83 , null);
}

function printDocument()
{
    <?php 
    if(isset($is_edit))
    {?>
        window.location = "<?php echo base_url() ?>report/create_report?id=<?php echo $data_edit[0]['id_dn'] ?>&doc=dn&doc_no=<?php echo $data_edit[0]['no_dn']?>";
    <?php
    }
    else
    {?>
        alert('Cannot generate report of unposted document');
    <?php  
    }
    ?>
    
}

function keypress_handler()
{
    //alert(keyCode);
    if(event.keyCode != 13)
    {
        var val = $("#barcode-number").val();
        $("#barcode-number").val(val + String.fromCharCode(event.keyCode));
    }
    else
    {  
        //alert('haha');
        var url_barcode = '<?php echo base_url() ?>product_barcode/get_product_from_barcode';
        var data_post = {};
        data_post['barcode'] = $("#barcode-number").val();
        //alert(JSON.stringify(data_post));
        $.ajax({
    		url: url_barcode,
    		type: "POST",
    		data: data_post,
    		success: function(output)
            {	
                try
                {
                    obj = JSON.parse(output);
                }
                catch(err)
                {
                    alert('Fatal error is happening with message : ' + output + '=====> Please contact your system administrator.');
                }
                
                //alert(JSON.stringify(obj));
                
                if(obj['data'].length > 0)
                {
                    var data = $("#so-product-grid").jqxGrid('getrows');
                    var check = false;
                    for(i=0;i<data.length;i++)
                    {
                        if(obj['data'][0].id_product == data[i].product)
                        {
                            //alert('product match');
                            $("#so-product-grid").jqxGrid('setcellvalue', i, "barcode", "verified");
                            check = true;
                            $("#select-product-barcode-popup").jqxWindow('close');
                            break;
                            
                        }
                    }
                    
                    if(check == false)
                    {
                        alert('Product not match');
                    }
                }
                else
                {
                    alert('Data cannot be found');
                }
                 $("#barcode-number").val(null);
    		},
            error: function( jqXhr ) 
            {
                if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                    var json = $.parseJSON( jqXhr.responseText );
                    alert(json);
                }
            }
   	    });
    }
}
</script>
<script>
$(document).ready(function(){
     
});
</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_dn" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_dn'] : '') ?>" />
<div class="document-action">
    <?php 
    if(isset($is_edit) && $data_edit[0]['status_dn'] == 'draft')
    {
        if($data_edit[0]['status'] != 'void')
        {?>
        <button style="margin-left: 20px;" id="dn-validate">Validate</button>
        <?php    
        }
    }
    ?>
    
    <?php 
    if(isset($is_edit) && $data_edit[0]['status_dn'] == 'open')
    {
        if($data_edit[0]['status'] != 'void')
        {?>
        <button style="margin-left: 20px;" id="dn-return">Delivery completed</button>
        <?php  
        }
    }
    ?>
    
    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_dn'] == 'draft' ? 'class="status-active"' : '') ?> >
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_dn'] == 'open' ? 'class="status-active"' : '') ?>>
            <span class="label">Open</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_dn'] == 'close' ? 'class="status-active"' : '') ?>>
            <span class="label">Close</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Delivery Note / <span><?php echo (isset($is_edit) ? $data_edit[0]['no_dn'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            MR Ref.
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%" class="field" type="text" id="mr" name="name" value=""/>
                            <button id="mr-select">...</button>
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
                            WO No.
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="wo_no" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['work_order_number'] : '') ?>"/>
							 <input type="hidden" id="id_wo" value=""/>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Customer
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer" name="name" value=""/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                            <div style="float: left; margin-right: 5px;">
                            <button style="width: 30px;" id="remove-product">-</button>
                            <div style="display: inline;"><span>Remove Product</span></div>
                            </div>
                    </td>    
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row-color" style="width: 100%; padding: 3px;">
                            <!--<button style="width: 100px; float:right" id="scan-barcode">Scan Barcode</button>-->
                            <div style="display: inline;"><span>Product List</span></div>
                            <div style="clear:both"></div>
                        </div>
                        <div id="so-product-grid"></div>
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

<div id="select-product-barcode-popup">
    <div>Barcode Scan</div>
    <div>
        <div>Scan Barcode for Product: <span id="product-code-barcode"></span></div>
        <input type="hidden" id="id-product-barcode" value="" />
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <input type="text" id="barcode-number" style="height: 40px;width: 95%;font-size: 20pt;" placeholder="Enter Barcode Number" value="" readonly="true"/>
                </td>
            </tr>
        </table>
    </div>
</div>