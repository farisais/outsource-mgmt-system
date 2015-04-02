<script>
$(document).ready(function(){
        $("#barcode-number").focus();
        $(window).unbind('keypress');
        $(window).bind('keypress', keypress_handler);
        
    var urlHistory = "";
    
    var sourceHistory =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_po'},
            { name: 'po_number'},
            { name: 'qty', type: 'number'},
            { name: 'date', type: 'date'},
            { name: 'qty_received', type: 'number'},
            { name: 'unit_name'},
            { name: 'unit_price', type: 'number'},
            { name: 'total_price', type: 'number'}
        ],
        id: 'id_po',
        url: urlHistory ,
        root: 'data'
    };
    var dataAdapterHistory = new $.jqx.dataAdapter(sourceHistory);
    
     $("#po-history-grid").on("bindingcomplete", function(event){
        var culture = {};
        culture.currencysymbol = "Rp. ";
        $("#po-history-grid").jqxGrid('localizestrings', culture);
    });
    
    $("#po-history-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 100,
        selectionmode : 'singlerow',
        source: dataAdapterHistory,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'PO Number', dataField: 'po_number'},
            { text: 'Date', dataField: 'date', cellsformat: 'dd/MM/yyyy', width: 150}, 
            { text: 'Qty Purchase', dataField: 'qty'},
            { text: 'Qty Received', dataField: 'qty_received'},
            { text: 'Unit Purchase', dataField: 'unit_name'},
            { text: 'Unit Price', dataField: 'unit_price', cellsformat: 'c2'},
            { text: 'Total Price', dataField: 'total_price', cellsformat: 'c2'},
        ]
    });
    
    var culture = {};
    culture.currencysymbol = "Rp. ";
    $("#po-history-grid").jqxGrid('localizestrings', culture);

});

function keypress_handler()
{
    if(event.keyCode != 13)
    {
        var val = $("#barcode-number").val();
        $("#barcode-number").val(val + String.fromCharCode(event.keyCode));
    }
    else
    {
        //alert($("#barcode-number").val());
        $("#product-code").val('');
        $("#product-name").val('');
        $("#product-unit").val('');
        $("#product-category").val('');
        $("#product-merk").val('');
        $("#product-type").val('');
        $("#product-description").val('');
        $("#po-history-grid").jqxGrid('clear');        
        var data_post = {};
        data_post['barcode'] = $("#barcode-number").val();
        $.ajax({
		url: "<?php echo base_url() ?>product_barcode/get_product_from_barcode",
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
                
                var data_input = {};
                data_input['id_po'] = obj['data'][0].id_po;
                data_input['po_number'] = obj['data'][0].po_number;
                data_input['date'] = obj['data'][0].date;
                data_input['qty'] = obj['data'][0].qty;
                data_input['qty_received'] = obj['data'][0].qty_received;
                data_input['unit_name'] = obj['data'][0].unit_name;
                data_input['unit_price'] = parseInt(obj['data'][0].unit_price);
                data_input['total_price'] = parseInt(obj['data'][0].total_price);
                var commit0 = $("#po-history-grid").jqxGrid('addrow', null, data_input);
                var culture = {};
                culture.currencysymbol = "Rp. ";
                $("#po-history-grid").jqxGrid('localizestrings', culture);
                
                //$("#po-history-grid").jqxGrid({source: dataAdapterHistory});

                $("#product-code").val(obj['data'][0].product_code);
                $("#product-name").val(obj['data'][0].product_name);
                $("#product-unit").val(obj['data'][0].unit_name_product);
                $("#product-category").val(obj['data'][0].category);
                $("#product-merk").val(obj['data'][0].merk_name);
                $("#product-type").val(obj['data'][0].type_material);
                $("#product-description").val(obj['data'][0].description);
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


function SaveData()
{
    var data_post = {};
    
    data_post['product_name'] = $("#product-name").val();
    data_post['unit'] = $("#product-unit").val();
    data_post['product_category'] = $("#product-category").val();
    data_post['merk'] = $("#product-merk").val();
    data_post['type_material'] = $("#product-type").val();
    data_post['description'] = $('#product-description').val();
    data_post['is_active'] = false;
    data_post['is_service'] = false;
    if($("#is-active").is(':checked'))
    {
        data_post['is_active'] = true;
    }
    
    if($("#service-type").is(':checked'))
    {
        data_post['is_service'] = true;
    }
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_product'] = $("#id_product").val();
    alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 25, data_post);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 21 , null);
}

</script>
<style>

.second-column
{
    padding-left: 30px;
}

.image-field
{
    border: 1px solid #c8c8d3;
    -moz-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    -webkit-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);  
    padding: 10px;  
    cursor: pointer;
}

#clear-image
{
    width: 30px;
    height: 30px;
    background: darkgray;
    /* float: left; */
    position: relative;
    top: -152px;
    left: 120px;
    display: -webkit-inline-box;
    z-index: 100;
}
#clear-image span
{
    font-weight: bold;
    font-size: 12pt;
    color: white;
}


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_product" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_product'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <table class="table-form">
                <tr>
                    <td colspan="4">
                        <input type="text" id="barcode-number" style="height: 40px;width: 95%;font-size: 20pt;" placeholder="Enter Barcode Number" value="" readonly="true"/>
                    </td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td colspan="4">                       
                         <div class="row-color" style="width: 100%; padding: 3px;">
                            <div style="display: inline;"><span>PO History</span></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%" colspan="4">
                        <div id="po-history-grid"></div>
                    </td>
                </tr>
                <tr></tr>
                <tr>
                    <td rowspan="4">
                        <div>
                            <img class="image-field" src="<?php echo base_url() . 'images/product-default.png' ?>" alt="product-default"/>
                        </div>
                    </td>
                     <td class="label">
                        Product Code
                    </td>
                    <td>
                        <input disabled="true" style="display: inline;" class="field" type="text" id="product-code" value="" />
                    </td>
                    <td>
                        <input style="display: inline" type="checkbox" id="service-type" value="true" />Service
                        <input style="display: inline" type="checkbox" id="is-active" value="true" />Is Active
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Product Name
                    </td>
                    <td colspan="3">
                        <input class="field" style="width: 92%;" type="text" id="product-name" readonly="true" value="" />
                        
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Unit
                    </td>
                    <td colspan="3">
                        <input type="text" class="field" id="product-unit" style="width: 95%;" readonly="true"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 120px;">
                        Product Category
                    </td>
                    <td colspan="3">
                        <input type="text" class="field" id="product-category" style="width: 95%;" readonly="true"/>
                    </td>
                </tr>
                
                <!-- /////////////////////////////////////////////////////////////// -->
                <tr>
                    <td colspan="4">                       
                         <div class="row-color" style="width: 100%;height: 20px">
                            
                        </div>
                    </td>
                </tr>
                <tr>
                   <td class="label">
                        Merk
                    </td>
                    <td>
                        <input type="text" class="field" id="product-merk" readonly="true"/>
                    </td>
                    <td class="label second-column">
                        Type Material
                    </td>
                    <td>
                        <input type="text" class="field" id="product-type" readonly="true" />
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Description
                    </td>
                    <td colspan="4">
                        <textarea readonly="true" class="field" cols="20" rows="5" id="product-description" style="width: 95%;height: 80px;"></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>