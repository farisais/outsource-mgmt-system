<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){  
    $("#transaction-date").jqxDateTimeInput({width: '300px', height: '25px'});
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-unit-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-warehouse-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-product").click(function(){
        $("#select-product-popup").jqxWindow('open');
    });
    
    $("#select-uom").click(function(){
        $("#select-unit-popup").jqxWindow('open');
    });
    
    $("#qty").jqxNumberInput({ width: '250px', height: '25px', inputMode: 'simple', spinButtons: true });
    
    
     
    var pickingList = [
        {label: 'Good Receipt', value: 'good_receipt'},
        {label: 'Internal Delivery', value: 'internal_delivery'},
        {label: 'Stock Adjustment', value: 'adjustment'},
        {label: 'Delivery Note', value: 'delivery_note'},
    ];
    

    $('#picking-list').jqxDropDownList({
        filterable: true, selectedIndex: 0, source: pickingList, displayMember: "label", valueMember: "value", width: '80%', height: 25
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
    
    $("#select-unit-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: unitAdapter,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Unit ID', dataField: 'id_unit_measure', width: 150},
            { text: 'Name', dataField: 'name'}                                     
        ]
    });
    
    $("#select-unit-grid").on('rowdoubleclick', function(){
        var args = event.args;
        var data = $('#select-unit-grid').jqxGrid('getrowdata', args.rowindex);
        $("#uom-select").jqxInput('val', {label: data.name, value: data.id_unit_measure});
        $("#select-unit-popup").jqxWindow('close');
    });
    
    $("#uom-select").jqxInput({ source: unitAdapter ,displayMember: "name", valueMember: "id_unit_measure", height: 23});
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
    
    $("#product-select").jqxInput({ displayMember: "label", valueMember: "value", height: 23});
    
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
        $("#product-select").jqxInput('val', {label: data.product_code + " - " + data.product_name ,value: data.id_product});
        $("#uom-select").jqxInput('val', {label: data.unit_name, value: data.unit});
        $("#select-product-popup").jqxWindow('close');
    });
    
    
    //=================================================================================
    //
    //   Select Source Location Grid
    //
    //=================================================================================
    
    $("#select-source").click(function(){
        $("#warehouse-select-id").val('source');
        $("#select-warehouse-popup").jqxWindow('open');
    });
    
    $("#select-destination").click(function(){
        $("#warehouse-select-id").val('destination');
        $("#select-warehouse-popup").jqxWindow('open');
    });
    
    var url_select_warehouse = "<?php echo base_url() ;?>gudang/get_gudang_list";
    var source_select_warehouse =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_warehouse'},
            { name: 'name'},
            { name: 'address'},
            { name: 'kode_lokasi'},
            { name: 'is_virtual'},
        ],
        id: 'id_warehouse',
        url: url_select_warehouse ,
        root: 'data'
    };
    var dataAdapter_select_warehouse = new $.jqx.dataAdapter(source_select_warehouse);
    
    $("#source-select").jqxInput({ source:dataAdapter_select_warehouse , displayMember: "name", valueMember: "id_warehouse", height: 23});
    $("#destination-select").jqxInput({ source:dataAdapter_select_warehouse , displayMember: "name", valueMember: "id_warehouse", height: 23});
    
    $("#select-warehouse-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_warehouse,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Code', dataField: 'kode_lokasi', width: 150},
            { text: 'Name', dataField: 'name'},
            { text: 'Address', dataField: 'address', width: 150}, 
            { text: 'Virtual', dataField: 'is_virtual', width: 100}                                        
        ]
    });
    
    $('#select-warehouse-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-warehouse-grid').jqxGrid('getrowdata', args.rowindex);
        if($("#warehouse-select-id").val() == 'source')
        {
            $("#source-select").jqxInput('val', {label: data.kode_lokasi + " - " + data.name ,value: data.id_warehouse});
        }
        else
        {
            $("#destination-select").jqxInput('val', {label: data.kode_lokasi + " - " + data.name ,value: data.id_warehouse});
        }
        $("#select-warehouse-popup").jqxWindow('close');
    });
    
    <?php 
    if(isset($is_edit))
    {?>
        $("#transaction-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['transaction_date'])) . "'" ?>); 
        $("#picking-list").jqxDropDownList('val', '<?php echo $data_edit[0]['picking_type'] ?>');
        $("#product-select").jqxInput('val', {label: '<?php echo $data_edit[0]['product_code'] ?>' + ' - ' + '<?php echo $data_edit[0]['product_name'] ?>', value: '<?php echo $data_edit[0]['product'] ?>'});
        $("#uom-select").jqxInput('val', {label: '<?php echo $data_edit[0]['unit_name'] ?>', value: '<?php echo $data_edit[0]['uom'] ?>'});
        $("#source-select").jqxInput('val', {label: '<?php echo $data_edit[0]['gudang1_code'] ?>' + ' - ' + '<?php echo $data_edit[0]['gudang1_name'] ?>', value: '<?php echo $data_edit[0]['source_location'] ?>'});
        $("#destination-select").jqxInput('val', {label: '<?php echo $data_edit[0]['gudang2_code'] ?>' + ' - ' + '<?php echo $data_edit[0]['gudang2_name'] ?>', value: '<?php echo $data_edit[0]['destination_location'] ?>'});
        $("#qty").val(<?php echo $data_edit[0]['qty'] ?>);
    <?php 
    }
    ?>
    
    $("#post").click(function(){
        var data_input = {};
        <?php
        if(isset($is_edit) && $data_edit[0]['status'] == 'unpost')
        {?>
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit[0]['id_stock_transaction'] ?>;
            param.push(item);        
            load_content_ajax(GetCurrentController(), 259, data_input, param);
        <?php 
        }
        else
        {?>
          
    
            data_input['description'] = $("#description").val();
            data_input['product'] = $("#product-select").val().value;
            data_input['uom'] = $("#uom-select").val().value;
            data_input['qty'] = $("#qty").val();
            data_input['picking_type'] = $("#picking-list").val();
            data_input['transaction_date'] = $("#transaction-date").val('date').format('yyyy-mm-dd');
            data_input['source_location'] = $("#source-select").val().value;
            data_input['destination_location'] = $("#destination-select").val().value;
            
            data_input['is_edit'] = $("#is_edit").val(); 
            data_input['id_stock_transaction'] = $("#id_stock_transaction").val();
            data_input['action_condition_identifier'] = 'post_stock';
            //alert(JSON.stringify(data_input));
            load_content_ajax(GetCurrentController(), 258, data_input);
        <?php
        }
        ?>
    });
    
    $("#unpost").click(function(){
        var data_input = {};
        <?php
        if(isset($is_edit) && $data_edit[0]['status'] == 'post')
        {?>
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit[0]['id_stock_transaction'] ?>;
            param.push(item);        
            load_content_ajax(GetCurrentController(), 260, data_input, param);
        <?php 
        }
        ?>
    });
   
});

function SaveData()
{
    <?php
    if(!isset($is_edit) || (isset($is_edit) && $data_edit[0]['status'] == 'unpost'))
    {?>
    var data_input = {};
    
    data_input['description'] = $("#description").val();
    data_input['product'] = $("#product-select").val().value;
    data_input['uom'] = $("#uom-select").val().value;
    data_input['qty'] = $("#qty").val();
    data_input['picking_type'] = $("#picking-list").val();
    data_input['transaction_date'] = $("#transaction-date").val('date').format('yyyy-mm-dd');
    data_input['source_location'] = $("#source-select").val().value;
    data_input['destination_location'] = $("#destination-select").val().value;
    
    data_input['is_edit'] = $("#is_edit").val(); 
    data_input['id_stock_transaction'] = $("#id_stock_transaction").val(); 
    //alert(JSON.stringify(data_input));
    load_content_ajax(GetCurrentController(), 258, data_input);
    <?php 
    }
    else
    {?>
    load_content_ajax(GetCurrentController(), 254 , null);
    <?php
    }
    ?>
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 254 , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_stock_transaction" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_stock_transaction'] : '') ?>" />
<input type="hidden" id="warehouse-select-id" value="" />
<div class="document-action">
    <?php 
    if((!isset($is_edit)) || (isset($is_edit) && $data_edit[0]['status'] == 'unpost'))
    {?>
    <button style="margin-left: 20px;width: 80px;" id="post">Post</button>
    <?php    
    }
    ?>
    
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] == 'post')
    {?>
    <button id="unpost">Unpost</button>
    <?php    
    }
    ?>
    
    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'unpost' ? 'class="status-active"' : '') ?>>
            <span class="label">Unposted</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'post' ? 'class="status-active"' : '') ?>>
            <span class="label">Posted</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">

    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Stock Transaction / <span><?php echo (isset($is_edit) ? $data_edit[0]['id_stock_transaction'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td colspan="2">
                        <div class="label">
                            Description
                        </div>
                        <div class="column-input" colspan="2">
                            <input type="text" class="field" id="description" style="width: 90%;" value="<?php echo (isset($is_edit) ? $data_edit[0]['description'] : ''); ?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Transaction Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="transaction-date"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Picking Type
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="picking-list"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Product
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="product-select" name="name" value=""/>
                            <button id="select-product">...</button>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Unit Measure
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%" class="field" type="text" id="uom-select" name="name" value=""/>
                            <button id="select-uom">...</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Source Warehouse
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="source-select" name="name" value=""/>
                            <button id="select-source">...</button>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Destination Warehouse
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%" class="field" type="text" id="destination-select" name="name" value=""/>
                            <button id="select-destination">...</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Quantity
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="qty"></div>
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
                        <textarea class="field" id="notes" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? '' : '') ?></textarea>
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

<div id="select-unit-popup">
    <div>Select Unit</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-unit-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="select-warehouse-popup">
    <div>Select Warehouse</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-warehouse-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>