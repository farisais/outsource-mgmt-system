<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    $("#inquiry-date").jqxDateTimeInput({width: '250px', height: '25px'});
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', value: null});
    <?php if(isset($is_edit)) :?>
    $("#inquiry-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['inquiry_date'])) . "'" ?>);
    $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['expected_delivery'])) . "'" ?>);
    <?php endif; ?>

    $("#select-product-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#clear-delivery-date").click(function(){
        $("#delivery-date").val(null);
    });

    
    //=================================================================================
    //
    //   Unit Measure Data
    //
    //=================================================================================
    
    var url_unit = "<?php echo base_url() ;?>unit_measure/get_unit_measure_list";
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
    //   customer Input
    //
    //=================================================================================
    
    var urlcustomer = "<?php echo base_url() ;?>customer/get_customer_list";
    var sourcecustomer =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_ext_company'},
            { name: 'name'},
            { name: 'company_code'},
            { name: 'contact'}
        ],
        id: 'id_ext_company',
        url: urlcustomer ,
        root: 'data'
    };
    var dataAdaptercustomer = new $.jqx.dataAdapter(sourcecustomer);
    
    
    $("#customer-name").jqxInput({ source: dataAdaptercustomer, displayMember: "name", valueMember: "id_ext_company", height: 23});
    <?php if (isset($is_edit)): ?>
    $("#customer-name").jqxInput('val', {label: '<?php echo $data_edit[0]['customer_name'] ?>', value: '<?php echo $data_edit[0]['customer']?>'});
    <?php endif; ?>

    $("#select-customer-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-customer-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdaptercustomer,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Code', dataField: 'company_code', width: 150},
            { text: 'Name', dataField: 'name'},
            { text: 'Contact', dataField: 'contact', width: 150}                                      
        ]
    });
    
    $("#customer-select").click(function(){
        $("#select-customer-popup").jqxWindow('open');
    });
    
    $('#select-customer-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-customer-grid').jqxGrid('getrowdata', args.rowindex);
        $('#customer-name').jqxInput('val', {label: data.name, value: data.id_ext_company});
        $("#select-customer-popup").jqxWindow('close');
    });
    
    //=================================================================================
    //
    //   Inquiry Grid
    //
    //=================================================================================
    <?php if (isset($is_edit)): ?>
    <?php
    // var_dump(inquiry_products);
 ?>
    var product_lists = [
        <?php foreach ($inquiry_products as $product): ?>
            { id_inquiry_product: "<?=$product['id_inquiry_product']?>",
            product_code: "<?=$product['product_code']?>",
            product_name: "<?=$product['product_name']?>",
            unit_name: "<?=$product['unit_name']?>",
            unit: "<?=$product['unit']?>",
            qty_request: "<?=$product['qty_request']?>",
            qty_deliver: "<?=$product['qty_deliver']?>",
            remark: "<?=$product['remark']?>"
            },
        <?php endforeach; ?>
        ];
        var source =
        {
            datatype: "array",
            datafields:
                [
                    { name: 'product_code'},
                    { name: 'product_name'},
                    { name: 'unit_name'},
                    { name: 'unit'},
                    { name: 'qty_request'},
                    { name: 'qty_deliver'},
                    { name: 'remark'}
                ],
            localdata: product_lists
        };
        var dataAdapter = new $.jqx.dataAdapter(source);

    <?php endif; ?>

    $("#product-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 450,
        selectionmode : 'singlerow',
        <?php echo (isset($is_edit) ? 'source: dataAdapter,' : ''); ?>
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
                var selectedrowindex = $("#product-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#product-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#product-grid").jqxGrid('deleterow', id);
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
            { text: 'Qty Request', dataField: 'qty_request', width: 100}, 
            { text: 'Qty Deliver', dataField: 'qty_deliver', width: 100},
            { text: 'Remark', dataField: 'remark'}
        ]
    });
    
    $("#product-grid").on('cellvaluechanged', function (event) 
    {
        
    });
    
    $("#product-grid").on("rowdoubleclick", function(event){
        var args = event.args;
        
        var data = $(this).jqxGrid('getrowdata', args.rowindex);
        alert(JSON.stringify(data));
    });
    
    var localizationobj = {};
    localizationobj.currencysymbol = "Rp. ";
    $("#product-grid").jqxGrid('localizestrings', localizationobj);
    
    $("#product-grid").jqxGrid('setcolumnproperty', 'product_name', 'editable', false);
    $("#product-grid").jqxGrid('setcolumnproperty', 'product_code', 'editable', false);
    
    //=================================================================================
    //
    //   Select product Grid
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
            { name: 'qty_request', type: 'number'},
            { name: 'qty_deliver', type: 'number'},
            { name: 'remark', type: 'string'}
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
        data['qty_request'] = 0;
        data['qty_deliver'] = 0;
        data['remark'] = '';
        var commit0 = $("#product-grid").jqxGrid('addrow', null, data);
        $("#select-product-popup").jqxWindow('close');
    });
    
    $('#product-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#product-grid').jqxGrid('getrowdata', args.rowindex);
        alert(JSON.stringify(data));
    });
    
    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft'): ?> 
    //=================================================================================
    //
    //   Inquiry Validate
    //
    //=================================================================================    
    $("#inquiry-validate").on('click', function(e){  
        var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_inquiry'] ?>;
        param.push(item);        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_po'] = $("#id_inquiry").val();
        load_content_ajax(GetCurrentController(), 264, data_post, param);
        e.preventDefault();
    });
    <?php endif; ?>
});

function SaveData()
{
    var data_post = {};

    data_post['is_edit'] = $("#is_edit").val();
    data_post['id_inquiry'] = $("#id_inquiry").val();
    data_post['inquiry_date'] = $("#inquiry-date").val('date').format('yyyy-mm-dd');
    data_post['delivery_date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
    data_post['customer'] = $("#customer-name").val().value;
    data_post['notes'] = $("#notes").val();
    data_post['products'] = $('#product-grid').jqxGrid('getrows');
    
    load_content_ajax(GetCurrentController(), 113, data_post);
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 109 , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_inquiry" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_inquiry'] : '') ?>" />
<div class="document-action">
    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft'): ?><button id="inquiry-validate">Validate</button><?php endif; ?>
    <ul class="document-status">
        <li <?php 
            if(isset($is_edit))
            {
                if($data_edit[0]['status'] == 'draft')
                {
                    echo 'class="status-active"';
                }
            }
            else
            {
                echo 'class="status-active"';
            }
        ?> >
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
    <div><h1 style="font-size: 18pt; font-weight: bold;">Inquiry / <span><?php echo (isset($is_edit) ? $data_edit[0]['inquiry_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Inquiry Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="inquiry-date" style="display: inline-block;"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                           Expected Delivery Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="delivery-date" style="display: inline-block;"></div><button style="top: -10px;margin-left: 5px;display: inline-block;position: relative;" id="clear-delivery-date">C</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            Customer
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-name" name="name" value=""/>
                            <button id="customer-select">...</button>
                        </div>
                    </td>
                    <td></td>
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
                    <td colspan="2">
                        <div id="product-grid"></div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 80%;padding-top: 20px;" colspan="2">
                        <div class="label">
                            Notes
                        </div>
                        <textarea id="notes" name="notes" class="field" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['notes'] : '') ?></textarea>
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
<div id="select-customer-popup">
    <div>Select Customer</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-customer-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>