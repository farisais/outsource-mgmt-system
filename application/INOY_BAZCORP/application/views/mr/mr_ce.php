<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', value: null}); 
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#clear-delivery-date").click(function(){
        $("#delivery-date").val(null);
    });
    
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
    //   Project List Select
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
        $("#select-pl-popup").jqxWindow('open');
    });
    
    $('#select-pl-grid').on('rowdoubleclick', function (event) 
    {
        <?php 
        if(!isset($is_edit))
        {?>
        var args = event.args;
        var data = $('#select-pl-grid').jqxGrid('getrowdata', args.rowindex);
        $('#pl-no').jqxInput('val', {label: data.project_list_number, value: data.id_project_list});
        var url = "<?php echo base_url()?>pl/get_pl_product_for_mr?id=" + data.id_project_list;
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
                { name: 'qty_require', type: 'number'},

            ],
            id: 'id_product',
            url: url ,
            root: 'data'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#pl-product-grid").jqxGrid({source: dataAdapter});
        $("#select-pl-popup").jqxWindow('close');
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
    
        $('#pl-no').jqxInput('val', {label: '<?php echo $data_edit[0]['project_list_number'] ?>', value: '<?php echo $data_edit[0]['project_list'] ?>'});
        
    
    <?php    
    }
    ?>
   
    
    
    //=================================================================================
    //
    //   Project List Product Grid
    //
    //=================================================================================
    $("#pl-product-grid").on("bindingcomplete", function(event){
        
    var rows = $("#pl-product-grid").jqxGrid('getrows');

    });
    
    var url = "";
       
    <?php 
    if(isset($from_pl))
    {?>
        url = "<?php echo base_url()?>pl/get_pl_product_for_mr?id=<?php echo $pr[0]['id_project_list']; ?>";
    <?php    
    }
    ?>
            
    <?php 
    if(isset($is_edit))
    {?>
        url = "<?php echo (isset($is_edit) ? base_url() . 'mr/get_mr_product_list/?id=' . $data_edit[0]['id_mr'] : '') ?>";
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
            { name: 'category_name'},
            { name: 'qty_require', type: 'number'},
            { name: 'qty_request', type: 'number'},
            { name: 'unit_price', type: 'number'},
            { name: 'total_price', type: 'number'}
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#pl-product-grid").jqxGrid(
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
                $("#select-product-popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-product").width() + 20, y: parseInt(offset.top)} });
                $("#select-product-popup").jqxWindow('open');
            });
            $("#remove-product").click(function(){
                var selectedrowindex = $("#pl-product-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#pl-product-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#pl-product-grid").jqxGrid('deleterow', id);
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
            { text: 'Quantity Require', dataField: 'qty_require', cellsformat: 'd2'},
            { text: 'Quantity Request', dataField: 'qty_request'}
        ]
    });
    
    $("#pl-product-grid").on('cellvaluechanged', function (event) 
    {
        
    });
    
    var localizationobj = {};
    localizationobj.currencysymbol = "Rp. ";
    $("#pl-product-grid").jqxGrid('localizestrings', localizationobj);
    
    $("#pl-product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#pl-product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    $("#pl-product-grid").jqxGrid('setcolumnproperty', 'qty_require', 'editable', false);
       
     
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
            { name: 'qty_require', type: 'number'},
            { name: 'qty_request', type: 'number'}
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
        data['qty_require'] = 0;
        data['qty_request'] = 0;
        var commit0 = $("#pl-product-grid").jqxGrid('addrow', null, data);
        $("#select-product-popup").jqxWindow('close');
    });
    
     $('#pl-product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#pl-product-grid').jqxGrid('getrowdata', args.rowindex);

        alert(JSON.stringify(data));
    });
    
    //=================================================================================
    //
    //   MR Validate
    //
    //=================================================================================
    $("#mr-validate").click(function(){  
        var data_post = {};
        <?php 
        if(isset($is_edit))
        {?>
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_mr'] ?>;
        param.push(item);        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_mr'] = $("#id_mr").val();
        
        load_content_ajax(GetCurrentController(), 106, data_post, param);
        <?php 
        }
        else
        {?>
        data_post['date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
        data_post['project_list'] = $("#pl-no").val().value;
        data_post['product_detail'] = $('#pl-product-grid').jqxGrid('getrows');
        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_mr'] = $("#id_mr").val(); 
        data_post['action_condition_identifier'] = 'validate';
        load_content_ajax(GetCurrentController(), 77, data_post);
        <?php
        }
        ?>
        
    });
    
});

function SaveData()
{
    var data_post = {};
    
    data_post['date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
    data_post['project_list'] = $("#pl-no").val().value;
    data_post['product_detail'] = $('#pl-product-grid').jqxGrid('getrows');
    
    alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 81, data_post);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 77 , null);
}

</script>
<script>
$(document).ready(function(){
     
});
</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_mr" value="<?php echo (isset($is_edit) ? $role_edit[0]['id_mr'] : '') ?>" />
<div class="document-action">
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] == 'draft')
    {?>
    <button style="margin-left: 20px;" id="mr-validate">Validate</button>
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
        <div><h1 style="font-size: 18pt; font-weight: bold;">Material Request / <span><?php echo (isset($is_edit) ? $data_edit[0]['mr_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Project List No.
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="pl-no" name="name" value=""/>
                            <button id="pl-select">...</button>
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
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>                       
                        <div style="float: left; margin-right: 5px;">
                             <div id="select-unit"></div>
                        </div>
                        <div style="float: left; margin-right: 5px;">
                            <div id="multiplier-input"></div>
                        </div>
                         <div style="float: left; margin-right: 5px;">
                            <button style="width: 30px;" id="add-product">+</button>
                            <button style="width: 30px;" id="remove-product">-</button>
                            <div style="display: inline;"><span>Add / Remove Product</span></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%;padding-top: 20px;" colspan="2">
                        <div class="row-color" style="width: 100%; padding: 3px;">
                            <div style="display: inline;"><span>Product List</span></div>
                        </div>
                        <div id="pl-product-grid"></div>
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