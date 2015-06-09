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
    //   SO Input
    //
    //=================================================================================
    
    var urlSupplier = "<?php echo base_url() ;?>so/get_so_idr_list";
    var sourceSupplier =
    {
        datatype: "json",
        datafields:
        [
                    { name: 'so_number'},
                    { name: 'id_so'},
                    { name: 'project_list_number'},
                    { name: 'id_project_list'},
                    { name: 'id_number'},
                    { name: 'id_internal_delivery'},
        ],
        id: 'id_so',
        url: urlSupplier ,
        root: 'data'
    };
    var dataAdapterSupplier = new $.jqx.dataAdapter(sourceSupplier);
    
    
    $("#so-no").jqxInput({ source: dataAdapterSupplier, displayMember: "so_number", valueMember: "id_so", height: 23, disabled: true});
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#so-no").jqxInput('val', {label: '<?php echo $data_edit[0]['so_number'] ?>', value: '<?php echo $data_edit[0]['so']?>'});
    <?php 
    }
    ?>
    $("#select-so-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-so-grid").jqxGrid(
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
            { text: 'SO Number', dataField: 'so_number', width: 150},
            { text: 'Project List Number', dataField: 'project_list_number'},
            { text: 'Internal Delivery Number', dataField: 'id_number', width: 150}                                      
        ]
    });
    
    $("#so-select").click(function(){
        <?php if(!isset($is_view))
        {?>
        $("#select-so-popup").jqxWindow('open');
        <?php    
        }?>
    });
    
    $('#select-so-grid').on('rowdoubleclick', function (event) 
    {
        <?php 
        if(!isset($is_edit))
        {?>
        var args = event.args;
        var data = $('#select-so-grid').jqxGrid('getrowdata', args.rowindex);
        $('#so-no').jqxInput('val', {label: data.so_number, value: data.id_so});
        var urlHistory = "<?php echo base_url()?>idr/get_idr_history_list?so=" + data.id_so;
        
        var sourceHistory =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_internal_delivery_return'},
                { name: 'id_number'},
                { name: 'so'},
                { name: 'so_number'},
                { name: 'project_list'},
                { name: 'project_list_number'},
            ],
            id: 'id_internal_delivery_return',
            url: urlHistory ,
            root: 'data'
        };
        var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
        $("#idr-history-grid").jqxGrid({source: dataAdapterHistory});
        
        $("#select-so-popup").jqxWindow('close');
        
        var url_select_product = "<?php echo base_url() ;?>product/get_product_final_list?so=" + data.id_so;
        var source_select_product =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_product'},
                { name: 'product_category'},
                { name: 'merk'},
                { name: 'merk_name'},
                { name: 'product_code'},
                { name: 'product_name'},
                { name: 'unit_name'},
                { name: 'unit'},            
                { name: 'category_name'},
                { name: 'qty_request', type: 'number'},
            ],
            id: 'id_product',
            url: url_select_product ,
            root: 'data'
        };
        var dataAdapter_select_product = new $.jqx.dataAdapter(source_select_product);
        $("#select-product-grid").jqxGrid({source: dataAdapter_select_product});

        <?php    
        }
        ?>
    });
   
    <?php 
    if(isset($is_edit))
    {?>
    
        $('#so-no').jqxInput('val', {label: '<?php echo $data_edit[0]['so_number'] ?>', value: '<?php echo $data_edit[0]['so'] ?>'});
            
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
    //   Internal Delivery History Grid
    //
    //=================================================================================
    
    $("#idr-history-grid").on("bindingcomplete", function(event){
        var culture = {};
        $("#idr-history-grid").jqxGrid('localizestrings', culture);
    });
    
    var urlHistory = "";
    <?php 
    if(isset($is_edit))
    {?>
        urlHistory = "<?php echo base_url()?>idr/get_idr_history?id_so=<?php echo $data_edit[0]['so']; ?>" + "&id_internal_delivery_return=<?php echo $data_edit[0]['id_internal_delivery_return']; ?>";
    <?php    
    }
    ?>
    
    <?php 
    if(isset($from_id))
    {?>
        urlHistory = "<?php echo base_url()?>idr/get_idr_history?id_so=<?php echo $so[0]['id_so']; ?>";
    <?php    
    }
    ?>
    
    var sourceHistory =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_internal_delivery'},
            { name: 'internal_delivery_number'},
            { name: 'so'},
            { name: 'so_number'},
            { name: 'project_list'},
            { name: 'project_list_number'},

        ],
        id: 'id_internal_delivery',
        url: urlHistory ,
        root: 'data'
    };
    var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
    $("#idr-history-grid").jqxGrid(
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
            { text: 'Internal Delivery Number', dataField: 'id_number'},
            { text: 'Project List Number', dataField: 'project_list_number'},
            { text: 'Sales Order Number', dataField: 'so_number'}
        ]
    });
    
    
    
    $("#jqxExpander").jqxExpander({ width: '100%', expanded: false});
    
    //=================================================================================
    //
    //   Internal Delivery Return Product Grid
    //
    //=================================================================================
    $("#idr-product-grid").on("bindingcomplete", function(event){
        var culture = {};
        culture.currencysymbol = "Rp. ";
        $("#idr-product-grid").jqxGrid('localizestrings', culture);
        
        var rows = $("#idr-product-grid").jqxGrid('getrows');

    });
    
    var url = "";
    <?php 
    if(isset($is_edit))
    {?>
        url = "<?php echo base_url()?>idr/get_idr_product_list?id=<?php echo $data_edit[0]['id_internal_delivery_return']; ?>";
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
    
    $("#idr-product-grid").on('cellvaluechanged', function (event) 
    {
        var args = event.args;
        var datafield = args.datafield;
        //alert('ha');
        if(datafield == 'qty')
        {
            var datarows = $('#select-product-grid').jqxGrid('getrows');
            for(i=0;i<datarows.length;i++)
            {
                //alert(JSON.stringify(datarows));
                if(datarows[i]['id_product'] == $(this).jqxGrid('getrowdata', args.rowindex)['id_product'])
                {
                    
                    if(datarows[i]['qty_request'] < args.newvalue)
                    {
                        alert('Qty cannot be greater than that defined on project list / SO');
                        $(this).jqxGrid('setcellvalue', args.rowindex, "qty", 0);
                    }
                }
            }
        }
        
    });
    
    $("#idr-product-grid").jqxGrid(
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
                var selectedrowindex = $("#idr-product-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#idr-product-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#idr-product-grid").jqxGrid('deleterow', id);
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
            { text: 'Quantity', dataField: 'qty'},
  
            
        ]
    });
    $("#idr-product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#idr-product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    $("#idr-product-grid").jqxGrid('setcolumnproperty', 'qty_available', 'editable', false);
    
    
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
            { name: 'merk_name'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'unit_name'},
            { name: 'unit'},            
            { name: 'category_name'},
            { name: 'qty_request', type: 'number'},
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
            { text: 'Merk', dataField: 'merk', displayfield: 'merk_name', width: 100},
            { text: 'Qty', dataField: 'qty_request', width: 100}                                             
        ]
    });
    
    $('#select-product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-product-grid').jqxGrid('getrowdata', args.rowindex);
        data['qty'] = 0;

        var commit0 = $("#idr-product-grid").jqxGrid('addrow', null, data);
        $("#select-product-popup").jqxWindow('close');
    });
    
     $('#idr-product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#idr-product-grid').jqxGrid('getrowdata', args.rowindex);

        //alert(JSON.stringify(data));
    });
    
            
    //=================================================================================
    //
    //   ID Validate
    //
    //=================================================================================
    $("#id-validate").click(function(){  
        var data_post = {};
        <?php 
        if(isset($is_edit))
        {?>
                    
            //data_input['warehouse'] = $("#destination-select").val().value;
            
            var products = [];
            var productGrid = $('#idr-product-grid').jqxGrid('getrows');
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
            data_post['product_detail'] = products;
            data_post['so'] = $('#so-no').val().value;
            //alert(JSON.stringify(data_post));
                        
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit[0]['id_internal_delivery_return'] ?>;
            param.push(item);
        
        data_post['is_close_pl'] = 0;
        
        if($("#is-close-pl").is(':checked'))
        {
            data_post['is_close_pl'] = 1;
        }
        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_internal_delivery_return'] = $("#id_internal_delivery_return").val();
        load_content_ajax(GetCurrentController(), 188, data_post, param);
        <?php 
        }
        else
        {?>
        data_post['action_condition_identifier'] = 'validate';
        load_content_ajax(GetCurrentController(), 186, data_post);
        <?php
        }
        ?>
    });
    
});

function SaveData()
{
    var data_post = {};
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] != 'void' || !isset($is_edit))
    {?>
    data_post['date'] = $("#id-date").val('date').format('yyyy-mm-dd');
    data_post['note'] = $("#notes").html();
    data_post['from'] = $("#from").val();
    data_post['to'] = $("#to").val();
    data_post['so'] = $("#so-no").val().value;
    data_post['product_detail'] = $('#idr-product-grid').jqxGrid('getrows');
    <?php 
    if(isset($is_edit))
    {?>
        data_post['id_internal_delivery_return'] = $("#id_internal_delivery_return").val();
    <?php    
    }
    ?>
    <?php   
    }
    ?>
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_internal_delivery'] = $("#id_internal_delivery_return").val(); 
    //alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 186, data_post);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 184 , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_internal_delivery_return" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_internal_delivery_return'] : '') ?>" />
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
    
        <div><h1 style="font-size: 18pt; font-weight: bold;">Internal Delivery Return / <span><?php echo (isset($is_edit) ? $data_edit[0]['idr_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
        <tbody>
      <tr>
        <td style="vertical-align: top; width: 150px;">IDR date: <br></td>
        <td style="vertical-align: top; width: 870px;">
            <div class="column-input" colspan="2">
                <div style="display: inline-block" id="id-date"></div>
                <div style="display: inline-block"><input <?php if(isset($is_view)){ echo 'disabled="true"';} ?> type="checkbox" id="is-close-pl" value="1" />Close PL</div>
            </div>
          
          </td>
      </tr>
      <tr>
        <td style="vertical-align: top;">SO Number :<br></td>
        <td style="vertical-align: top;"><input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="so-no" name="name" value=""/>
                            <button id="so-select">...</button></td>
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
                    <td colspan="2">                       
                         <div class="row-color" style="width: 100%; padding: 3px;">
                            <div style="display: inline;"><span>Internal Delivery History</span></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%" colspan="2">
                        <div id='jqxExpander'>
                            <div>
                                Internal Delivery History
                            </div>
                            <div>
                        <div id="idr-history-grid"></div>
                            </div>
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
                    <td style="width: 80%" colspan="2">
                        
                            <div>
                                Product Detail
                            </div>
                            <div>
                                <div id="idr-product-grid"></div>
                            </div>
                    </td>
                </tr>
                
                
                <tr>
                    <td style="width: 80%;padding-top: 20px;" colspan="2">
                        <div class="label">
                            Notes
                        </div>
                        <textarea <?php if(isset($is_view)){ echo 'disabled=disabled';} ?> class="field" id="notes" cols="10" rows="20" style="height: 50px;"></textarea>
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

<div id="select-so-popup">
    <div>Select Sales Order</div>
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
