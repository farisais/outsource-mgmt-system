<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){  
    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#product-select").click(function(){
        $("#select-product-popup").jqxWindow('open');
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
        $("#product-name").val(data.product_name);
        $("#product-val").val(data.id_product);
        $("#select-product-popup").jqxWindow('close');
        
    });
    
    //=================================================================================
    //
    //   Position
    //
    //=================================================================================
    var urlPosition = '<?php echo base_url() ?>organisation_structure/get_organisation_structure_list';
    var sourcePosition =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_organisation_structure', type : 'int'}, 
            { name: 'structure_name'}
        ],
        id: 'id_organisation_structure',
        url: urlPosition,
        root: 'data'
    };
    var dataAdapterPosition = new $.jqx.dataAdapter(sourcePosition);
    
    $('#position-bind').jqxDropDownList({
        filterable: true, selectedIndex: 0, source: dataAdapterPosition, displayMember: "structure_name", valueMember: "id_organisation_structure", width: 200, height: 25
    }); 
    
    $("#position-bind").on('bindingComplete', function (event) { 
        <?php
        if(isset($is_edit))
        {
            if($data_edit[0]['organisation_structure'] != '' && $data_edit[0]['organisation_structure'] != null)
            {
        ?>
                $("#position-bind").jqxDropDownList('val', <?php echo $data_edit[0]['organisation_structure'] ?>);
        <?php
            }
        }
        ?>
    });   
    
    //=================================================================================
    //
    //   Position Level
    //
    //=================================================================================
    
    var sourcePositionLevel = [
    { name: 'Any', id_position_level: null },
    <?php 
    foreach($position_level as $pl)
    {
        echo '{ name : \''. $pl['name'] .'\', id_position_level : \''. $pl['id_position_level'] .'\'},';
    }
    ?>
    ];
    $('#position-level-bind').jqxDropDownList({
        filterable: true, selectedIndex: 0, source: sourcePositionLevel, displayMember: "name", valueMember: "id_position_level", width: 200, height: 25
    });      
    $("#position-level-bind").jqxDropDownList('val', <?php echo ($data_edit[0]['position_level'] == null ? 'null' : $data_edit[0]['position_level'] ) ?>); 
   
});

function SaveData()
{
    var data_post = {};
    
    data_post['product'] = $("#product-val").val();
    data_post['position'] = $('#position-bind').val();
    data_post['position_level'] = $('#position-level-bind').val();
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_product_definition'] = $("#id_product_definition").val(); 
    //alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 'save_edit_product_definition', data_post);
    
    
}
function DiscardData()
{
    load_content_ajax('administrator', 'view_product_definition' , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_product_definition" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_product_definition'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">

    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Product Definition / <span><?php echo (isset($is_edit) ? $data_edit[0]['id_product_definition'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Select Product to Define
                        </div>
                    </td>
                    <td>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%" class="field" type="text" id="product-name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['product_name'] : '')?>"/>
                            <input type="hidden" id="product-val" value="<?php echo (isset($is_edit) ? $data_edit[0]['product'] : '')?>" />
                            <button id="product-select">...</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Position to Bind
                    </td>
                    <td>
                        <div id="position-bind" style="font-family: Arial;">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Position Level to Bind
                    </td>
                    <td>
                        <div id="position-level-bind" style="font-family: Arial;">
                        </div>
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