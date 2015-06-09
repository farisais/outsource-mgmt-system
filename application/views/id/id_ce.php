<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){  
    $("#id-date").jqxDateTimeInput({width: '250px', height: '25px' <?php if(isset($is_view)){ echo ',disabled: true';} ?>});
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#id-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date'])) . "'" ?>); 
    <?php 
    }
    ?>
    $("#clear-delivery-date").click(function(){
        $("#delivery-date").val(null);
    });

    //=================================================================================
    //
    //   Project List Input
    //
    //=================================================================================
    
    var urlSupplier = "<?php echo base_url() ;?>pl/get_pl_list_submit";
    var sourceSupplier =
    {
        datatype: "json",
        datafields:
        [
                    { name: 'project_list_number'},
                    { name: 'so'},
                    { name: 'so_number'},
                    { name: 'status'},
                    { name: 'note'},
                    { name: 'id_project_list'},
                    
        ],
        id: 'id_project_list',
        url: urlSupplier ,
        root: 'data'
    };
    var dataAdapterSupplier = new $.jqx.dataAdapter(sourceSupplier);
    
    
    $("#pl-no").jqxInput({ source: dataAdapterSupplier, displayMember: "Project List Number", valueMember: "id_project_list", height: 23});
    $("#pl-no").jqxInput({disabled: true});
    
    $("#select-pl-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-pl-grid").jqxGrid(
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
            { text: 'Project List Number', dataField: 'project_list_number', width: 150},
            { text: 'Sales Order', dataField: 'so_number'},
            { text: 'note', dataField: 'note', width: 150}                                      
        ]
    });
    
   $("#pl-select").click(function(){
        <?php 
        if(!isset($is_view))
        {?>
        $("#select-pl-popup").jqxWindow('open');
        <?php    
        }
        ?>
    });
    
    $('#select-pl-grid').on('rowdoubleclick', function (event) 
    {
        <?php 
        if(!isset($is_edit))
        {?>
        var args = event.args;
        var data = $('#select-pl-grid').jqxGrid('getrowdata', args.rowindex);
        $('#pl-no').jqxInput('val', {label: data.project_list_number, value: data.id_project_list});
        var url = "<?php echo base_url()?>pl/get_pl_product_list?id=" + data.id_project_list;
        var source =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_product'},
                { name: 'product'},
                { name: 'uom'},
                { name: 'product_category'},
                { name: 'merk'},
                { name: 'product_code'},
                { name: 'product_name'},
                { name: 'name'},
                { name: 'unit_name'}, 
                { name: 'unit'},            
                { name: 'category_name'},
                { name: 'qty', type: 'number'},

            ],
            id: 'id_product',
            url: url ,
            root: 'data'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#id-product-grid").jqxGrid({source: dataAdapter});
        $("#select-pl-popup").jqxWindow('close');
        $('#pl-no').jqxInput('val', {label: data.project_list_numebr, value: id_project_list});
        
        <?php    
        }
        ?>
                    
       
    });
    
                 
    <?php 
    if(isset($from_pr) && $from_pr == 'true')
    {?>
    
        $('#pl-no').jqxInput('val', {label: '<?php echo $pl[0]['project_list_number'] ?>', value: '<?php echo $pl[0]['id_project_list'] ?>'});
            
    <?php    
    }
    ?>
    
    <?php 
    if(isset($is_edit))
    {?>
    
        $('#pl-no').jqxInput('val', {label: '<?php echo $data_edit[0]['project_list'] ?>', value: '<?php echo $data_edit[0]['project_list'] ?>'});
        
    
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
                var data = $('#id-product-grid').jqxGrid('getrowdata', rowid);
                data['qty_available'] = total;
                var value = $('#id-product-grid').jqxGrid('updaterow', rowid, data);
            }
            else
            {
                
                if(obj.length == 0)
                {
                    $("#qty-available").val(0);
                }
                else
                {
                    $("#qty-available").val(obj[0].total_qty);
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
    //   Internal Delivery Product Grid
    //
    //=================================================================================
    $("#id-product-grid").on("bindingcomplete", function(event){
        var culture = {};
        culture.currencysymbol = "Rp. ";
        $("#id-product-grid").jqxGrid('localizestrings', culture);
        
        var rows = $("#id-product-grid").jqxGrid('getrows');

    });
    
    var url = "";
    <?php 
    if(isset($is_edit))
    {?>
        url = "<?php echo base_url()?>id/get_id_product_list?id=<?php echo $data_edit[0]['id_internal_delivery']; ?>";
    <?php    
    }
    ?>
    
    <?php 
    if(isset($from_pr))
    {?>
        url = "<?php echo base_url()?>pr/get_pr_product_list?id=<?php echo $so[0]['id_pr']; ?>";
    <?php    
    }
    ?>
    
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
            { name: 'uom'},
            { name: 'warehouse_name'},
            { name: 'category_name'},
            { name: 'source_location'},
            { name: 'qty', type: 'number'},
            { name: 'unit_price', type: 'number'},
            { name: 'total_price', type: 'number'}
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    
    $("#id-product-grid").on('cellvaluechanged', function (event) 
    {
        var args = event.args;
        var datafield = event.args.datafield;
        if(datafield == 'source_location')
        {
            var rowid = args.rowindex;
            product = $('#id-product-grid').jqxGrid('getrowdata', rowid).product;
            get_qty_warehouse(product, args.newvalue.value, "grid",rowid);
        }

    });
    
    $("#id-product-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        <?php if(isset($is_view)){ echo 'disabled: true,';} ?>
        width: '100%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapter,
        columnsresize: true,
        editable: true,
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
                var selectedrowindex = $("#id-product-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#id-product-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#id-product-grid").jqxGrid('deleterow', id);
                }
                
            });
        },
        columns: [
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Unit', dataField: 'uom', displayfield: 'unit_name', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: unitAdapter, displayMember: 'name', valueMember: 'id_unit_measure' });
                }},
            { text: 'Warehouse', dataField: 'source_location', displayfield: 'warehouse_name', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: dataAdapter_select_warehouse, displayMember: 'name', valueMember: 'id_warehouse' });
                }},
            <?php 
            if(!isset($is_edit))
            {?>
                {text: 'Stock', dataField: 'qty_available'},
            <?php    
            }
            ?> 
            { text: 'Quantity', dataField: 'qty'},
  
            
        ]
    });
    $("#id-product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#id-product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    $("#id-product-grid").jqxGrid('setcolumnproperty', 'qty_available', 'editable', false);
    $("#id-product-grid").on('rowdoubleclick', function(event){
        var args = event.args;
        var data = $('#id-product-grid').jqxGrid('getrowdata', args.rowindex);

        //alert(JSON.stringify(data));
    });
            
    //=================================================================================
    //
    //   ID Validate
    //
    //=================================================================================
    $("#id-validate").click(function(){  
        
        <?php 
        if(isset($is_edit))
        {?>
            var data_input = {};
            //data_input['warehouse'] = $("#destination-select").val().value;
            
            var products = [];
            var productGrid = $('#id-product-grid').jqxGrid('getrows');
            for(i=0;i<productGrid.length;i++)
            {
                if(productGrid[i]['qty'] > productGrid[i]['qty_available'])
                {
                    alert('Cannot save data. Qty request greater than stock available');
                    throw '';
                }
                
            }
            var i=0;
            for(i=0;i<productGrid.length;i++)
            {
                var row = {};
                row['product'] = productGrid[i].id_product;
                row['uom'] = productGrid[i].uom;
                row['qty'] = productGrid[i].qty;
                row['warehouse'] = productGrid[i].source_location;
                products.push(row);
            }
            
            data_input['is_edit'] = $("#is_edit").val(); 
            data_input['id_internal_delivery'] = $("#id_internal_delivery").val(); 
            data_input['products'] = products;
            //alert(JSON.stringify(data_input));
            
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit[0]['id_internal_delivery'] ?>;
            param.push(item);    
            //alert(JSON.stringify(data_input));    
            load_content_ajax(GetCurrentController(), 183, data_input, param); 
        <?php 
        }
        else
        {?>
        load_content_ajax(GetCurrentController(), 107, data_post);
        <?php
        }
        ?>
    });
    
});

function SaveData()
{
    var data_post = {};
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] != 'void' || !isset($is_edit) )
    {?>
    data_post['date'] = $("#id-date").val('date').format('yyyy-mm-dd');
    data_post['note'] = $("#notes").html();
    data_post['from'] = $("#from").val();
    data_post['to'] = $("#to").val();
    data_post['project_list'] = $("#pl-no").val().value;
    data_post['product_detail'] = $('#id-product-grid').jqxGrid('getrows');
    
    for(i=0;i<data_post['product_detail'].length;i++)
    {
        if(data_post['product_detail'][i]['qty'] > data_post['product_detail'][i]['qty_available'])
        {
            alert('Cannot save data. Qty request greater than stock available');
            throw '';
        }
        
    }
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_internal_delivery'] = $("#id_internal_delivery").val(); 
    //alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 111, data_post);
    <?php   
    }
    ?>
}
function DiscardData()
{
    load_content_ajax('administrator', 107 , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_internal_delivery" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_internal_delivery'] : '') ?>" />
<div class="document-action">
    <?php 
    if(!isset($is_view))
    {
        if(isset($is_edit) && $data_edit[0]['status'] == 'draft')
        {
            if($data_edit[0]['status'] != 'void')
            {?>
            <button style="margin-left: 20px;" id="id-validate">Validate</button>
            <?php    
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
        <div><h1 style="font-size: 18pt; font-weight: bold;">Internal Delivery / <span><?php echo (isset($is_edit) ? $data_edit[0]['id_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
        <tbody>
      <tr>
        <td style="vertical-align: top; width: 150px;">Internal Delivery date: <br></td>
        <td style="vertical-align: top; width: 870px;"><div class="column-input" colspan="2">
                            <div id="id-date"></div>
                        </div>
          <br></td>
      </tr>
      <tr>
        <td style="vertical-align: top;">Project List Number :<br></td>
        <td style="vertical-align: top;"><input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="pl-no" name="name" value=""/>
                            <button id="pl-select">...</button></td>
      </tr>
      <tr>
        <td style="vertical-align: top;">From:<br></td>
        <td style="vertical-align: top;"><input <?php if(isset($is_view)){ echo 'disabled="true"';} ?> style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="from" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['from'] : '') ?>"/></td>
      </tr>
      <tr>
        <td style="vertical-align: top;">To:<br></td>
        <td style="vertical-align: top;"><input <?php if(isset($is_view)){ echo 'disabled="true"';} ?> style="display:inline; width: 70%" class="field" type="text" id="to" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['to'] : '') ?>"/></td>
      </tr>
    </tbody>
            
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
                            <div style="display: inline;"><span>Product List</span></div>
                        </div>
                        <div id="so-product-grid"></div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%;" colspan="2">
                        <div id="id-product-grid"></div>
                    </td>
                </tr>
                                   
                <tr>
                    <td style="width: 80%;padding-top: 20px;" colspan="2">
                        <div class="label">
                            Notes
                        </div>
                        <textarea class="field" id="notes" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['note'] : '') ?></textarea>
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

<div id="select-pl-popup">
    <div>Select Project List</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-pl-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>