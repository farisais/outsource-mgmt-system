<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    $("#inquiry-date").jqxDateTimeInput({width: '250px', height: '25px'<?php if(isset($is_view)){ echo ',disabled: true';} ?>});
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', value: null<?php if(isset($is_view)){ echo ',disabled: true';} ?>});
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
        data_post['id_inquiry'] = $("#id_inquiry").val();
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
	data_post['sales_person'] = $("#sales-person").val();
    data_post['inquiry_date'] = $("#inquiry-date").val('date').format('yyyy-mm-dd');
    data_post['delivery_date'] = $("#delivery-date").val('date').format('yyyy-mm-dd');
    data_post['customer'] = $("#customer-name").val().value;
    data_post['inquiry_detail'] = $("#inquiry-detail").val();
    
    load_content_ajax(GetCurrentController(), 'save_edit_inquiry', data_post);
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 'view_inquiry' , null);
}

function EditData()
{
    <?php if(isset($is_view)){?>
    var data_post = {};
    var param = [];
    var item = {};
    item['paramName'] = 'id';
    item['paramValue'] = <?php echo $data_edit[0]['id_inquiry'] ?>;
    param.push(item);        
    data_post['id_inquiry'] = <?php echo $data_edit[0]['id_inquiry'] ?>;
    load_content_ajax(GetCurrentController(), 111 ,data_post, param);
    <?php }?>
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_inquiry" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_inquiry'] : '') ?>" />
<div class="document-action">
    <?php if (isset($is_edit) && $data_edit[0]['status'] == 'draft'): ?><button id="inquiry-validate">Validate</button><?php endif; ?>
    <ul class="document-status">
        <li <?php 
            if(isset($is_edit) || isset($is_view) )
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
        <li <?php echo ((isset($is_edit) || isset($is_view)) && $data_edit[0]['status'] == 'open' ? 'class="status-active"' : '') ?>>
            <span class="label">Open</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo ((isset($is_edit) || isset($is_view))  && $data_edit[0]['status'] == 'close' ? 'class="status-active"' : '') ?>>
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
                            <button id="customer-select" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>>...</button>
                        </div>
                    </td>
                    <td>
						<div class="label">
                            Sales Person
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="sales-person" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['sales_person'] : '') ?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 80%;padding-top: 20px;" colspan="2">
                        <div class="label">
                            Inquiry Detail
                        </div>
                        <textarea id="inquiry-detail" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?> name="notes" class="field" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['inquiry_detail'] : '') ?></textarea>
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