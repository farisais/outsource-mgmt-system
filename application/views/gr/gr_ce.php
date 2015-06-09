<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px' <?php if(isset($is_view)){ echo ',disabled: true';} ?>}); 
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    <?php 
    if(!isset($is_view))
    {?>
    $("#clear-delivery-date").click(function(){
        $("#delivery-date").val(null);
    });
    <?php 
    }
    ?>
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date'])) . "'" ?>);   
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
    
    var url_gudang = "<?php echo base_url() ;?>gudang/get_gudang_list"
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
    
    //=================================================================================
    //
    //   PO Select
    //
    //=================================================================================
    
    var urlPO = "<?php echo base_url() ;?>po/get_po_open_list";
    var sourcePO =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_po'},
            { name: 'po_number'},
            { name: 'supplier'},
            { name: 'supplier_name'},
            { name: 'date'}
        ],
        id: 'id_po',
        url: urlPO ,
        root: 'data'
    };
    var dataAdapterPO = new $.jqx.dataAdapter(sourcePO);
    
    
    $("#po-no").jqxInput({ source: dataAdapterPO, displayMember: "po_number", valueMember: "id_po", height: 23});
    
    $("#po-no").jqxInput({disabled: true});
    
    $("#select-po-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-po-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        editable: <?php if(isset($is_view)){ echo 'false';}else{ echo 'true';} ?>,
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
            { text: 'PO No.', dataField: 'po_number', width: 150},
            { text: 'Supplier', dataField: 'supplier_name'},
            { text: 'Date', dataField: 'date', width: 150}                                      
        ]
    });
    
    $("#po-select").click(function(){
        <?php if(!isset($is_view))
        {?>
        $("#select-po-popup").jqxWindow('open');
        <?php    
        }
        ?>
    });
    
    $('#select-po-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-po-grid').jqxGrid('getrowdata', args.rowindex);
        $('#po-no').jqxInput('val', {label: data.po_number, value: data.id_po});
        var url = "<?php echo base_url()?>po/get_po_product_list_received?id=" + data.id_po;
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
                { name: 'qty_ordered', type: 'number'},
                { name: 'qty_received', type: 'number'},
                
            ],
            id: 'id_product',
            url: url ,
            root: 'data'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#gr-product-grid").jqxGrid({source: dataAdapter});
        
        
        var urlHistory = "<?php echo base_url()?>gr/get_gr_history_list?po=" + data.id_po;
        
        var sourceHistory =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_gr'},
                { name: 'gr_number'},
                { name: 'product_code'},
                { name: 'product_name'},
                { name: 'gr_date', type: 'date'},
                { name: 'qty_received', type: 'number'},
                { name: 'warehouse'},
                { name: 'name'},
            ],
            id: 'id_gr',
            url: urlHistory ,
            root: 'data'
        };
        var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
        $("#gr-history-grid").jqxGrid({source: dataAdapterHistory});
        
        $("#select-po-popup").jqxWindow('close');
    });
    
    <?php 
    if(isset($from_po) && $from_po == 'true')
    {?>
    
        $('#po-no').jqxInput('val', {label: '<?php echo $po[0]['po_number'] ?>', value: '<?php echo $po[0]['id_po'] ?>'});
		
		var urlHistory = "<?php echo base_url()?>gr/get_gr_history_list?po=" + <?php echo $po[0]['id_po'] ?>;
        
        var sourceHistory =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_gr'},
                { name: 'gr_number'},
                { name: 'product_code'},
                { name: 'product_name'},
                { name: 'gr_date', type: 'date'},
                { name: 'qty_received', type: 'number'},
                { name: 'warehouse'},
                { name: 'name'},
            ],
            id: 'id_gr',
            url: urlHistory ,
            root: 'data'
        };
        var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
        $("#gr-history-grid").jqxGrid({source: dataAdapterHistory});
		
    <?php    
    }
    ?>
    
    <?php 
    if(isset($is_edit))
    {?>
    
        $('#po-no').jqxInput('val', {label: '<?php echo $data_edit[0]['po_number'] ?>', value: '<?php echo $data_edit[0]['po'] ?>'});
    
    <?php    
    }
    ?>
    
    //=================================================================================
    //
    //   GR Product Grid
    //
    //=================================================================================
    
    var url = "";
    <?php 
    if(isset($is_edit))
    {?>
        url = "<?php echo base_url()?>gr/get_gr_product_list?id=<?php echo $data_edit[0]['id_gr']; ?>";
    <?php    
    }
    ?>
    
    <?php 
    if(isset($from_po))
    {?>
        url = "<?php echo base_url()?>po/get_po_product_list_received?id=<?php echo $po[0]['id_po']; ?>";
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
            { name: 'source_location'},
            { name: 'unit_name', value: 'unit', values: { source: unitAdapter.records, value: 'id_unit_measure', name: 'name' } },
            { name: 'unit'},            
            { name: 'category_name'},
            { name: 'qty_ordered', type: 'number'},
            { name: 'qty_received', type: 'number'},
            { name: 'warehouse', value: 'warehouse', values: { source: unitAdapter.records, value: 'id_warehouse', name: 'name' } }
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#gr-product-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        editable: <?php if(isset($is_view)){ echo 'false';}else{ echo 'true';} ?>,
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
                var selectedrowindex = $("#gr-product-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#gr-product-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#gr-product-grid").jqxGrid('deleterow', id);
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
            { text: 'Quantity Ordered', dataField: 'qty_ordered', cellsformat: 'd2'},
            { text: 'Quantity Receive', dataField: 'qty_received', cellsformat: 'd2'},
            { text: 'Warehouse', dataField: 'warehouse', displayfield: 'name', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: gudangAdapter, displayMember: 'name', valueMember: 'id_warehouse' });
            }},
        ]
    });
    
    $("#gr-product-grid").on('cellvaluechanged', function (event) 
    {
        
    });
    
    
    $("#gr-product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#gr-product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    $("#gr-product-grid").jqxGrid('setcolumnproperty', 'qty_ordered', 'editable', false);
    $("#gr-product-grid").jqxGrid('setcolumnproperty', 'unit', 'editable', false);
    
    var urlHistory = "";
    <?php 
    if(isset($is_edit))
    {?>
        urlHistory = "<?php echo base_url()?>gr/get_gr_history_list?po=<?php echo $data_edit[0]['po']; ?>&gr=<?php echo $data_edit[0]['id_gr']; ?>";
    <?php    
    }
    ?>
    
    var sourceHistory =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_gr'},
            { name: 'gr_number'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'gr_date', type: 'date'},
            { name: 'qty_received', type: 'number'},
            { name: 'warehouse'},
            { name: 'name'},
        ],
        id: 'id_gr',
        url: urlHistory ,
        root: 'data'
    };
    var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
    
    $("#gr-history-grid").jqxGrid({
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterHistory,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'GR Number', dataField: 'gr_number'},
            { text: 'Date', dataField: 'gr_date', cellsformat: 'dd/MM/yyyy'},
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Quantity Receive', dataField: 'qty_received', cellsformat: 'd2'},
            { text: 'Store to', dataField: 'warehouse', displayfield: 'name', width: 200},
        ]
    });
    
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
            { name: 'qty_order', type: 'number'},
            { name: 'qty_receive', type: 'number'},

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
        data['qty_order'] = 0;
        data['qty_receive'] = 0;
        var commit0 = $("#gr-product-grid").jqxGrid('addrow', null, data);
        $("#select-product-popup").jqxWindow('close');
    });
    
     $('#gr-product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#gr-product-grid').jqxGrid('getrowdata', args.rowindex);

        //alert(JSON.stringify(data));
    });
    
    
    
    $("#transfer-popup").jqxWindow({
        width: 400, height: 150, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
     $("#select-destination").click(function(){
        $("#select-warehouse-popup").jqxWindow('open');
    });
    
    $("#select-warehouse-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    //=================================================================================
    //
    //   Warehouse Data
    //
    //=================================================================================
    
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
    
    $("#destination-select").jqxInput({ source:dataAdapter_select_warehouse , displayMember: "name", valueMember: "id_warehouse", height: 23});
    
    $('#select-warehouse-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-warehouse-grid').jqxGrid('getrowdata', args.rowindex);

        $("#destination-select").jqxInput('val', {label: data.kode_lokasi + " - " + data.name ,value: data.id_warehouse});
        
        $("#select-warehouse-popup").jqxWindow('close');
    });
    
/**
 *     $("#transfer-goods").click(function(){
 *         $("#transfer-popup").jqxWindow('open');
 *     });
 */
    
    $("#transfer-goods").click(function(){
        <?php
        if(isset($is_edit))
        {?>

            var data_input = {};
            //data_input['warehouse'] = $("#destination-select").val().value;
            var can_save = true;
            var products = [];
            var productGrid = $('#gr-product-grid').jqxGrid('getrows');
            var i=0;
            for(i=0;i<productGrid.length;i++)
            {
                if(productGrid[i].source_location !=null && productGrid[i].source_location != '')
                {
                    var row = {};
                    row['product'] = productGrid[i].id_product;
                    row['uom'] = productGrid[i].unit;
                    row['qty'] = productGrid[i].qty_received;
                    row['warehouse'] = productGrid[i].source_location;
                    products.push(row);
                }
                else
                {
                    can_save = false;
                }
            }
            
            data_input['products'] = products;
            //alert(JSON.stringify(data_input));
            
            if(can_save == true)
            {
                var param = [];
                var item = {};
                item['paramName'] = 'id';
                item['paramValue'] = <?php echo $data_edit[0]['id_gr'] ?>;
                param.push(item);    
                //alert(JSON.stringify(data_input));    
                load_content_ajax(GetCurrentController(), 'transfer_good_receive', data_input, param);   
            }
            else
            {
                alert("Please select warehouse to transfer.");
            }  
        <?php      
        }
        ?>
        
    });
    
    
    //========================================================
    
    
});

function SaveData()
{
    var data_post = {};
    <?php 
    if((isset($is_edit) && ($data_edit[0]['status'] != 'void' || $data_edit[0]['status'] == 'open' )) || !isset($is_edit) )
    {?>
        
        data_post['note'] = $("#notes").html();
        data_post['date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
        data_post['id_po'] = $("#po-no").val().value;
        data_post['do'] = $("#do").val();
        data_post['product_detail'] = $('#gr-product-grid').jqxGrid('getrows');

        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_gr'] = $("#id_gr").val(); 

        //alert(JSON.stringify(data_post))
        load_content_ajax(GetCurrentController(), 71, data_post);
    <?php   
        
    }
    ?>
}

function DiscardData()
{
    load_content_ajax('administrator', 67 , null);
}

</script>
<script>
$(document).ready(function(){
     
});
</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_role" value="<?php echo (isset($is_edit) ? $role_edit[0]['id_role'] : '') ?>" />
<div class="document-action">
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] != 'transfer')
    {
        if($data_edit[0]['status'] != 'void')
        {?>
        <button id="transfer-goods">Transfer</button>
        <?php    
        }
    }
    ?>
    
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] == 'transfer')
    {
        if($data_edit[0]['status'] != 'void')
        {?>
        <button id="cancel-transfer">Cancel Transfer</button>
        <?php    
        }
    }
    ?>
    
    
    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'open' ? 'class="status-active"' : '') ?> >
            <span class="label">Open</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'transfer' ? 'class="status-active"' : '') ?>>
            <span class="label">Transfered</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Good Receive / <span><?php echo (isset($is_edit) ? $data_edit[0]['gr_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            PO No.
                        </div>
                        <div class="column-input" colspan="2">
                            <input <?php if(isset($is_view)){ echo 'disabled="true';} ?> style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="po-no" name="name" value="" disabled="true"/>
                            <button id="po-select">...</button>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Delivery No.
                        </div>
                        <div class="column-input" colspan="2">
                            <input <?php if(isset($is_view)){ echo 'disabled="true';} ?> type="text" class="field" id="do" value="<?php echo (isset($is_edit) ? $data_edit[0]['do'] : '') ?>" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="delivery-date" style="display: inline-block;"></div><button style="top: -10px;margin-left: 5px;display: inline-block;position: relative;" id="clear-delivery-date">C</button>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <!--<tr>
                    <td colspan="2">                       
                         <div  class="row-color" style="width: 100%;">
                            <button style="width: 30px;" id="add-product">+</button>
                            <button style="width: 30px;" id="remove-product">-</button>
                            <div style="display: inline;"><span>Add / Remove Product</span></div>
                        </div>
                    </td>
                </tr>-->
                <tr>
                    <td colspan="2">                       
                         <div class="row-color" style="width: 100%; padding: 3px;">
                            <div style="display: inline;"><span>Product</span></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%" colspan="2">
                        <div id="gr-product-grid"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">                       
                         <div class="row-color" style="width: 100%; padding: 3px;">
                            <div style="display: inline;"><span>GR History</span></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%" colspan="4">
                        <div id="gr-history-grid"></div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 80%;padding-top: 20px;" colspan="2">
                        <div class="label">
                            Notes
                        </div>
                        <textarea <?php if(isset($is_view)){ echo 'disabled=disabled';} ?> class="field" cols="10" rows="20" style="height: 50px;"></textarea>
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

<div id="select-po-popup">
    <div>Select PO</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-po-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="transfer-popup">
    <div>Transfer Good</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%">
                    <div class="label">
                        Destination Warehouse
                    </div>
                    <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%" class="field" type="text" id="destination-select" name="name" value=""/>
                        <button id="select-destination">...</button>
                    </div>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button id="transfer" style="margin-left: 5px;margin-right:5px;width: 100px;">Transfer</button>
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