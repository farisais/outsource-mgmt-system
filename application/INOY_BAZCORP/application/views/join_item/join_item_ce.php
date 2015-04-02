<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){  
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#join-item-date").jqxDateTimeInput({width: '250px', height: '25px'});
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#join-item-date").jqxDateTimeInput('val', <?php echo $data_edit[0]['date'] ?>);
    <?php 
    }
    ?>
    $("#bom-select").click(function(){
        $("#select-product-popup").jqxWindow('open');
        $("#product-state").val('parent');
    });
    
    $('#activity-select').jqxDropDownList({
        filterable: true, selectedIndex: 0, source: [{label: 'Join', value: 'join'}, {label: 'Dis-Join', value: 'disjoin'}], displayMember: "label", valueMember: "value", width: 200, height: 25
    });
    
    <?php
    if(isset($is_edit))
    {?>
    $('#activity-select').jqxDropDownList('val', '<?php echo $data_edit[0]['activity'] ?>');
    $("#bom-name").val('<?php echo $data_edit[0]['bom_name'] ?>');
    $("#bom-select-val").val(<?php echo $data_edit[0]['bom'] ?>);
    $("#product-select").val('<?php echo $data_edit[0]['product_name'] ?>');
    $("#product-val").val('<?php echo $data_edit[0]['product'] ?>');
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
    //   Warehouse Data
    //
    //=================================================================================
    
    var url_gudang = "<?php echo base_url() ;?>gudang/get_gudang_not_virtual_list"
    var gudangSource =
    {
         datatype: "json",
         datafields: [
             { name: 'id_warehouse'},
             { name: 'name'},
             { name: 'is_virtual'}
         ],
        id: 'id_warehose',
        url: url_gudang ,
        root: 'data'
    };
    
    var gudangAdapter = new $.jqx.dataAdapter(gudangSource, {
        autoBind: true
    });
    
    $('#warehouse-select').jqxDropDownList({
        filterable: true, selectedIndex: 0, source: gudangAdapter, displayMember: "name", valueMember: "id_warehouse", width: 200, height: 25
    });
    
    $('#warehouse-select').on('bindingComplete', function(){
         <?php
        if(isset($is_edit))
        {?>
        $('#warehouse-select').jqxDropDownList('val', <?php echo $data_edit[0]['gudang'] ?>);
        <?php 
        }
        ?>
    });
    
    $("#warehouse-select").on('change', function(){
        get_qty_warehouse($("#product-val").val(),$(this).val(), 'warehouse', null);
    });
   
    
    //=================================================================================
    //
    //   Project List Product Grid
    //
    //=================================================================================
    
    var url = "<?php if(isset($is_edit)){?><?php echo base_url()?>join_item/get_join_item_product_list?id=<?php echo $data_edit[0]['id_join_item']; ?> <?php }?>";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'product'},
            { name: 'product_category'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'unit_name', value: 'unit', values: { source: unitAdapter.records, value: 'id_unit_measure', name: 'name' } },
            { name: 'unit'},            
            { name: 'qty', type: 'number'},
            { name: 'qty_available', type: 'number'},
            { name: 'qty_transfer', type: 'number'},
            { name: 'warehouse'},
            { name: 'warehouse_name'}
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    
    $("#join-item-product-grid").on('cellvaluechanged', function (event) 
    {
        var args = event.args;
        var datafield = event.args.datafield;
        if(datafield == 'warehouse')
        {
            var rowid = args.rowindex;
            product = $('#join-item-product-grid').jqxGrid('getrowdata', rowid).product;
            get_qty_warehouse(product, args.newvalue.value, "grid",rowid);
        }

    });
        
    $("#join-item-product-grid").jqxGrid(
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
            { text: 'Product', displayField: 'product_name', dataField: 'product'},
            { text: 'Unit', dataField: 'unit', displayfield: 'unit_name', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: unitAdapter, displayMember: 'name', valueMember: 'id_unit_measure' });
                }
            },
            { text: 'Qty BOM', dataField: 'qty', cellsformat: 'd2'},
            { text: 'Warehouse', dataField: 'warehouse', displayfield: 'warehouse_name', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: gudangAdapter, displayMember: 'name', valueMember: 'id_warehouse' });
            }},
            { text: 'Qty Available', dataField: 'qty_available', cellsformat: 'd2'},
            { text: 'Qty Transfer', dataField: 'qty_transfer', cellsformat: 'd2'}
        ]
    });

    $("#join-item-product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#join-item-product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    $("#join-item-product-grid").jqxGrid('setcolumnproperty', 'qty_available', 'editable', false);
    $("#join-item-product-grid").jqxGrid('setcolumnproperty', 'unit', 'editable', false);
    $("#join-item-product-grid").jqxGrid('setcolumnproperty', 'qty', 'editable', false);
    $("#join-item-product-grid").jqxGrid('setcolumnproperty', 'qty_transfer', 'editable', false);
    
    //=================================================================================
    //
    //   Select Product Grid
    //
    //=================================================================================
    
    var url_select_bom = "<?php echo base_url() ;?>bom/get_bom_open_list";
    var source_select_bom =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_product'},
            { name: 'product'},
            { name: 'id_bom'},
            { name: 'product_category'},
            { name: 'merk'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'bom_name'}
        ],
        id: 'id_product',
        url: url_select_bom ,
        root: 'data'
    };
    var dataAdapter_select_bom = new $.jqx.dataAdapter(source_select_bom);
    
    $("#select-bom-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_bom,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'BOM', dataField: 'id_bom', displayField: 'bom_name', width: 150},
            { text: 'Product Code', dataField: 'product_code', width: 150},
            { text: 'Name', dataField: 'product_name'},                                       
        ]
    });
    
    $('#select-bom-grid').on('rowdoubleclick', function (event) 
    {
        
        var args = event.args;
        var data = $('#select-bom-grid').jqxGrid('getrowdata', args.rowindex);
        
        var urlBomProduct = "<?php echo base_url() ;?>join_item/get_bom_product_list?id=" + data.id_bom;
        var sourceBomProduct =
        {
            datatype: "json",
            datafields:
            [
                { name: 'product'},
                { name: 'id_bom'},
                { name: 'product_category'},
                { name: 'product_code'},
                { name: 'product_name'},
                { name: 'unit_name', value: 'unit', values: { source: unitAdapter.records, value: 'id_unit_measure', name: 'name' } },
                { name: 'unit'},            
                { name: 'qty', type: 'number'},
                { name: 'qty_available', type: 'number'},
                { name: 'qty_transfer', type: 'number'},
                { name: 'warehouse'},
                { name: 'warehouse_name'}
            ],
            id: 'id_bom',
            url: urlBomProduct ,
            root: 'data'
        };
        var dataAdapterBomProduct = new $.jqx.dataAdapter(sourceBomProduct);
        $("#join-item-product-grid").jqxGrid({source: dataAdapterBomProduct});
        
        
        //var commit0 = $("#join_item-product-grid").jqxGrid('addrow', null, data);
        //alert(JSON.stringify(data));
        $("#bom-name").val(data.bom_name);
        $("#bom-select-val").val(data.id_bom);
        $("#product-select").val(data.product_name);
        $("#product-val").val(data.product);
        $("#select-product-popup").jqxWindow('close');
        
        if($("#warehouse-select").val() != '' && $("#warehouse-select").val() != null )
        {
            get_qty_warehouse(data.product, $("#warehouse-select").val(), "warehouse",null);
        }
        
        
    });
    
     $('#join-item-product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#join-item-product-grid').jqxGrid('getrowdata', args.rowindex);

        //alert(JSON.stringify(data));
    });
    
    //=================================================================================
    //
    //   Project List Validate
    //
    //=================================================================================
    
    $("#qty-product").change(function(){
        
        if($(this).val() !=null && $(this).val() != '')
        {
            var rows = $("#join-item-product-grid").jqxGrid('getrows');
            for(i=0;i<rows.length;i++)
            {
                rows[i].qty_transfer = rows[i].qty * $(this).val();
            }
            $("#join-item-product-grid").jqxGrid('refreshdata');;
        }
        
    });
    
    $("#join-item-transfer").click(function(){
        var data_post = {};
        <?php
        if(isset($is_edit) && $data_edit[0]['status_join'] == 'open')
        {?>
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit[0]['id_join_item'] ?>;
            param.push(item);        
            load_content_ajax(GetCurrentController(), 165, data_post, param);
        <?php 
        }
        else
        {?>
          
    
            data_post['date'] = $('#join-item-date').val('date').format('yyyy-mm-dd');
            data_post['activity'] = $("#activity-select").val();
            data_post['qty'] = $('#qty-product').val();
            data_post['bom'] = $("#bom-select-val").val();
            data_post['gudang'] = $("#warehouse-select").val();
            data_post['join_item_product'] = $("#join-item-product-grid").jqxGrid('getrows');
            
            data_post['is_edit'] = $("#is_edit").val(); 
            data_post['id_join_item'] = $("#id_join_item").val(); 
            data_post['action_condition_identifier'] = 'transfer_join_item';
            //alert(JSON.stringify(data_input));
            load_content_ajax(GetCurrentController(), 164, data_post);
        <?php
        }
        ?>
    });
                
   
});

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
                var data = $('#join-item-product-grid').jqxGrid('getrowdata', rowid);
                data['qty_available'] = total;
                var value = $('#join-item-product-grid').jqxGrid('updaterow', rowid, data);
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

function SaveData()
{
    var data_post = {};
    
    <?php
    if(!isset($is_edit) || (isset($is_edit) && $data_edit[0]['status_join'] != 'transfer'))
    {?>
    data_post['date'] = $('#join-item-date').val('date').format('yyyy-mm-dd');
    data_post['activity'] = $("#activity-select").val();
    data_post['qty'] = $('#qty-product').val();
    data_post['bom'] = $("#bom-select-val").val();
    data_post['gudang'] = $("#warehouse-select").val();
    data_post['join_item_product'] = $("#join-item-product-grid").jqxGrid('getrows');
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_join_item'] = $("#id_join_item").val(); 
    alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 164, data_post);
    <?php
    }
    else
    {?>
        load_content_ajax('administrator', 160 , null);
    <?php
    }
    ?>
    
    
}
function DiscardData()
{
    load_content_ajax('administrator', 160 , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_join_item" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_join_item'] : '') ?>" />
<div class="document-action">
    <?php 
    if(!isset($is_edit) || isset($is_edit) && $data_edit[0]['status_join'] != 'transfer')
    {?>
    <button style="margin-left: 20px;" id="join-item-transfer">Transfer</button>
    <?php    
    }
    ?>

    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_join'] == 'open' ? 'class="status-active"' : '') ?> >
            <span class="label">Open</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_join'] == 'transfer' ? 'class="status-active"' : '') ?>>
            <span class="label">Transfer</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">

    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Join Item / <span><?php echo (isset($is_edit) ? $data_edit[0]['join_item_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="join-item-date"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            BOM Select
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%" class="field" type="text" id="bom-name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['product_code'] . ' - ' . $data_edit[0]['product_name'] : '')?>"/>
                            <input type="hidden" id="bom-select-val" value="<?php echo (isset($is_edit) ? $data_edit[0]['product'] : '')?>" />
                            <button id="bom-select">...</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Product
                        </div>
                        <div class="column-input" colspan="2">
                            <input type="text" id="product-select" class="field" value="" />
                            <input type="hidden" id="product-val" value="" />
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Activity
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="activity-select" style="font-family: Arial;">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Qty Product
                        </div>
                        <div class="column-input" colspan="2">
                            <input type="text" id="qty-product" class="field" value="<?php echo (isset($is_edit) ? $data_edit[0]['qty'] : 1) ?>" />
                        </div>
                    </td>
                    <td>
                        <div class="label warehouse">
                           Warehouse to take / store
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="warehouse-select"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td>
                        <div class="label">
                            Qty Available
                        </div>
                        <div class="column-input" colspan="2">
                            <input type="text" id="qty-available" class="field" value="" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">                       
                         <div class="row-color" style="width: 100%;">
                            <div style="display: inline;"><span>Component Detail</span></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%;" colspan="2">
                        <div id="join-item-product-grid"></div>
                    </td>
                </tr>
                
                <tr>
                    <td style="width: 80%;padding-top: 20px;" colspan="2">
                        <div class="label">
                            Notes
                        </div>
                        <textarea class="field" id="notes" cols="10" rows="20" style="height: 50px;"></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div id="select-product-popup">
    <div>Select BOM</div>
    <div>
        <input type="hidden" id="product-state" value="" />
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-bom-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>