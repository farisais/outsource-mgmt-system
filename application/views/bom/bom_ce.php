<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){  
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#product-select").click(function(){
        $("#select-product-popup").jqxWindow('open');
        $("#product-state").val('parent');
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
    //   Project List Product Grid
    //
    //=================================================================================
    
    var url = "<?php if(isset($is_edit)){?><?php echo base_url()?>bom/get_bom_product_list?id=<?php echo $data_edit[0]['id_bom']; ?> <?php }?>";
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
    $("#bom-product-grid").jqxGrid(
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
                $("#product-state").val('child');
            });
            $("#remove-product").click(function(){
                var selectedrowindex = $("#bom-product-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#bom-product-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#bom-product-grid").jqxGrid('deleterow', id);
                }
                
            });
        },
        columns: [
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Unit', dataField: 'unit', displayfield: 'unit_name', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: unitAdapter, displayMember: 'name', valueMember: 'id_unit_measure' });
                }
            },
            { text: 'Quantity', dataField: 'qty', cellsformat: 'd2'}
        ]
    });

    $("#bom-product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#bom-product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    
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
            { name: 'qty', type: 'number'}
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
        if($("#product-state").val() == 'child')
        {
            data['qty'] = 0;
            var commit0 = $("#bom-product-grid").jqxGrid('addrow', null, data);
           
        }
        else
        {
            $("#product-parent").val(data['product_code']  + " - "  + data['product_name']);
            $("#product-parent-val").val(data['id_product']);
        }
         $("#select-product-popup").jqxWindow('close');
        
    });
    
     $('#bom-product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#bom-product-grid').jqxGrid('getrowdata', args.rowindex);

        //alert(JSON.stringify(data));
    });
    
    //=================================================================================
    //
    //   Project List Validate
    //
    //=================================================================================
    
    $("#bom-validate").click(function(){
         var data_post = {};
        <?php
        if(isset($is_edit) && $data_edit[0]['status'] == 'draft')
        {?>
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit[0]['id_bom'] ?>;
            param.push(item);        
            load_content_ajax(GetCurrentController(), 150, data_post, param);
        <?php 
        }
        else
        {?>
            data_post['name'] = $('#name').val();
            data_post['product'] = $("#product-parent-val").val();
            data_post['bom_product'] = $('#bom-product-grid').jqxGrid('getrows');
            
            data_post['is_edit'] = $("#is_edit").val(); 
            data_post['id_bom'] = $("#id_bom").val();
            data_post['action_condition_identifier'] = 'validate_bom'; 
            load_content_ajax(GetCurrentController(), 149, data_post);
        <?php
        }
        ?>
    });
                
   
});

function SaveData()
{
    var data_post = {};
    
    <?php
    if(!isset($is_edit) || (isset($is_edit) && $data_edit[0]['status'] != 'active'))
    {?>
    data_post['name'] = $('#name').val();
    data_post['product'] = $("#product-parent-val").val();
    data_post['bom_product'] = $('#bom-product-grid').jqxGrid('getrows');
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_bom'] = $("#id_bom").val(); 
    alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 'save_edit_bom', data_post);
    <?php
    }
    else
    {?>
        load_content_ajax('administrator', 'view_bom' , null);
    <?php
    }
    ?>
    
    
}
function DiscardData()
{
    load_content_ajax('administrator', 'view_bom' , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_bom" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_bom'] : '') ?>" />
<div class="document-action">
    <?php 
    if(!isset($is_edit) || isset($is_edit) && $data_edit[0]['status'] != 'active')
    {?>
    <button style="margin-left: 20px;" id="bom-validate">Validate</button>
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
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'active' ? 'class="status-active"' : '') ?>>
            <span class="label">Active</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">

    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">BOM / <span><?php echo (isset($is_edit) ? $data_edit[0]['name'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Name
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '')?>"/>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Product
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%" class="field" type="text" id="product-parent" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['product_code'] . ' - ' . $data_edit[0]['product_name'] : '')?>"/>
                            <input type="hidden" id="product-parent-val" value="<?php echo (isset($is_edit) ? $data_edit[0]['product'] : '')?>" />
                            <button id="product-select">...</button>
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
                        <div id="bom-product-grid"></div>
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
    <div>Select Product</div>
    <div>
        <input type="hidden" id="product-state" value="" />
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-product-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>