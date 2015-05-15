<script>
function formatDate(date) {
    var foo = date;
    var arr = foo.split("/");
    return arr[2]+'-'+arr[1]+'-'+arr[0];
}
function view_detail_invoice(id, payroll_periode){
    //alert(id);
    //return false;
    $("#detail_invoice_grid").on('bindingcomplete', function() {
        var culture = {};
        culture.currencysymbol = "Rp. ";
        culture.currencysymbolposition = "before";
        culture.decimalseparator = '.';
        culture.thousandsseparator = ',';
        $("#detail_invoice_grid").jqxGrid('localizestrings', culture);

        var rows = $("#detail_invoice_grid").jqxGrid('getrows');
        var amount = 0;


        for(var i=0;i<rows.length;i++)
        {
            amount += rows[i].price * rows[i].qty ;
        }

        $("#untaxed-amount").html(dataAdapter_product.formatNumber(amount, "c2", culture));
        var tax = 0;
        if($("#use-tax").is(":checked"))
        {
            tax = amount * 0.1;
        }


        $("#tax-amount").html(dataAdapter_product.formatNumber(tax, "c2", culture));
        $("#total-amount").html(dataAdapter_product.formatNumber((tax + amount), "c2", culture));

        $("#sub-total").val(amount);
        $("#total_tax").val(tax);
        $("#total_invoice").val((tax + amount));
    });

    $("#use-tax").click(function(){
        var rows = $("#detail_invoice_grid").jqxGrid('getrows');
        var amount = 0;
        for(var i=0;i<rows.length;i++)
        {
            amount += rows[i].price * rows[i].qty ;
        }

        var culture = {};
        culture.currencysymbol = "Rp. ";
        culture.currencysymbolposition = "before";
        culture.decimalseparator = '.';
        culture.thousandsseparator = ',';
        $("#untaxed-amount").html(dataAdapter_product.formatNumber(amount, "c2", culture));
        var tax = 0;
        if($("#use-tax").is(":checked"))
        {
            tax = amount * 0.1;
        }

        alert(tax);
        alert(amount);
        $("#tax-amount").html(dataAdapter_product.formatNumber(tax, "c2", culture));
        $("#total-amount").html(dataAdapter_product.formatNumber((tax + amount), "c2", culture));
        $("#sub-total").val(amount);
        $("#total_tax").val(tax);
        $("#total_invoice").val((tax + amount));

    });


    $("#detail_invoice_grid").on('cellvaluechanged', function (event)
    {
        var rows = $("#detail_invoice_grid").jqxGrid('getrows');
        var amount = 0;


        for(var i=0;i<rows.length;i++)
        {
            amount += rows[i].price * rows[i].qty ;
        }
        var culture = {};
        culture.currencysymbol = "Rp. ";
        culture.currencysymbolposition = "before";
        culture.decimalseparator = '.';
        culture.thousandsseparator = ',';
        $("#untaxed-amount").html(dataAdapter_product.formatNumber(amount, "c2", culture));
        var tax = 0;
        if($("#use-tax").is(":checked"))
        {
            tax = amount * 0.1;
        }


        $("#tax-amount").html(dataAdapter_product.formatNumber(tax, "c2", culture));
        $("#total-amount").html(dataAdapter_product.formatNumber((tax + amount), "c2", culture));

        $("#sub-total").val(amount);
        $("#total_tax").val(tax);
        $("#total_invoice").val((tax + amount));

    });

    var url_detail = "<?php echo base_url() ;?>invoice/detail_invoice/"+id + "/" + payroll_periode;
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
                { name: 'unit'},
                { name: 'unit_name'},
                { name: 'category_name'},
                { name: 'qty', type: 'number'},
                { name: 'price', type: 'number'},
                { name: 'total_price', type: 'number'}
            ],
            id: 'id_product',
            url:url_detail,
            root: 'data'
        };
        var dataAdapter_product = new $.jqx.dataAdapter(source);
        $("#detail_invoice_grid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '97%',
                height: 200,
                source: dataAdapter_product,
                selectionmode : 'singlerow',
                columnsresize: true,
                autoshowloadelement: false,
                groupable: false,
                sortable: true,
                editable: true,    
                autoshowfiltericon: true,
                rendertoolbar: function (toolbar) {
                    $("#add_product_invoice").click(function(){
                        $("#detail_invoice_grid").jqxGrid('addrow', 0, {});
                        //alert('ok');
                    });
                       $("#remove_product_invoice").click(function(){
                        var selectedrowindex = $("#detail_invoice_grid").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var id = $("#detail_invoice_grid").jqxGrid('getrowid', selectedrowindex);
                            var commit1 = $("#detail_invoice_grid").jqxGrid('deleterow', id);
                        }
                    });
                    $("#show_product_invoice").click(function(){
                          detail_grid_product();
                     });
                },
                columns: [
                    { text: 'Product', dataField: 'product_name', width: 300},
                    { text: 'Unit', dataField: 'unit', width: 50, displayfield: 'unit_name'},
                    { text: 'Description', dataField: 'description'},
                    { text: 'Quantity', dataField: 'qty'},
                    { text: 'Unit Price', dataField: 'price',cellsformat: 'c2'},
                    
                    { text: 'Total Price', dataField: 'total_price', 
                    cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                            var total = parseFloat(rowdata.price) * parseFloat(rowdata.qty);
                            var culture = {};
                            culture.currencysymbol = "Rp. ";
                            culture.currencysymbolposition = "before";
                            culture.decimalseparator = '.';
                            culture.thousandsseparator = ',';
                            return "<div style='margin: 4px;' class='jqx-right-align'>" + dataAdapter_product.formatNumber(total, "c2", culture) + "</div>";

                        }
                    }
                ]
            });


            

}
// Fungsi untuk menampilkan detail grid produk
function detail_grid_product(){
    $("#select_product_popup").jqxWindow('open');
    var urlinquiry = "<?php echo base_url() ;?>product/get_product_list";
        var sourceinquiry =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_product'},
                 { name: 'product_code'},
                { name: 'product_name'},
            ],
            id: 'id_payroll',
            url: urlinquiry ,
            root: 'data'
        };
        var dataAdapterinquiry = new $.jqx.dataAdapter(sourceinquiry);
        $("#select_product_grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 499,
            selectionmode : 'singlerow',
            source: dataAdapterinquiry,
            columnsresize: true,
            autoshowloadelement: false,                                                                                
            sortable: true,
            filterable: true,
            showfilterrow: true,
            autoshowfiltericon: true,
            columns: [
                { text: 'Product Code', dataField: 'product_code',width:200},
                { text: 'Product Name', dataField: 'product_name'},
               
            ]
        });
         $('#select_product_grid').on('rowdoubleclick', function (event)         
         {
            var args = event.args;
            var data = $('#select_product_grid').jqxGrid('getrowdata', args.rowindex);
            var commit0 = $("#detail_invoice_grid").jqxGrid('addrow', null, data);
            $("#select_product_popup").jqxWindow('close');
            
        });        
}
    $(document).ready(function () {
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
                { name: 'unit'},            
                { name: 'category_name'},
                { name: 'quantity', type: 'number'},
                { name: 'price', type: 'number'},
                { name: 'total_price', type: 'number'}
            ],
            id: 'id_product',
            root: 'data'
        };
        var dataAdapter_product = new $.jqx.dataAdapter(source);
        $("#detail_invoice_grid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '97%',
                height: 200,
                selectionmode : 'singlerow',
                columnsresize: true,
                autoshowloadelement: false,
                groupable: false,
                sortable: true,
                editable: true,    
                autoshowfiltericon: true,
                rendertoolbar: function (toolbar) {
                    $("#add_product_invoice").click(function(){
                        $("#detail_invoice_grid").jqxGrid('addrow', 0, {});
                        //alert('ok');
                    });
                       $("#remove_product_invoice").click(function(){
                        var selectedrowindex = $("#detail_invoice_grid").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var id = $("#detail_invoice_grid").jqxGrid('getrowid', selectedrowindex);
                            var commit1 = $("#detail_invoice_grid").jqxGrid('deleterow', id);
                        }
                    });
                    $("#show_product_invoice").click(function(){
                          detail_grid_product();
                     });
                },
                columns: [
                    { text: 'Product', dataField: 'product', displayfield: 'product_name',width: 300},
                    { text: 'Unit', dataField: 'unit', width: 50},
                    { text: 'Description', dataField: 'description'},
                    { text: 'Quantity', dataField: 'quantity'}, 
                    { text: 'Unit Price', dataField: 'price',cellsformat: 'c2'},
                    
                    { text: 'Total Price', dataField: 'total_price', 
                    cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                    
                    var total = parseFloat(rowdata.price) * parseFloat(rowdata.quantity);
                    var culture = {};
                    culture.currencysymbol = "Rp. ";
                    culture.currencysymbolposition = "before";
                    culture.decimalseparator = '.';
                    culture.thousandsseparator = ',';
                    //alert(parseFloat(rowdata.quality));
                    //console.log(total);
                   // if(total == isNaN()){
                    //    alert(total);
                   //     return "<div style='margin: 4px;' class='jqx-right-align'>0</div>";
                   // }else{
                        return "<div style='margin: 4px;' class='jqx-right-align'>" + dataAdapter_product.formatNumber(total, "c2", culture) + "</div>";
                    //}
                }
            }
                ]
            });
            $("#detail_invoice_grid").on('cellvaluechanged', function (event) 
            {
                //return false;
                var rows = $("#detail_invoice_grid").jqxGrid('getrows');
                console.log(rows);
               
                var amount = 0;
                
                 
                for(var i=0;i<rows.length;i++)
                {
                    //alert(rows[i].quantity);
                    amount += rows[i].price * rows[i].quantity ;
                }
               // return false;
                var culture = {};
                culture.currencysymbol = "Rp. ";
                culture.currencysymbolposition = "before";
                culture.decimalseparator = '.';
                culture.thousandsseparator = ',';
                $("#untaxed-amount").html(dataAdapter_product.formatNumber(amount, "c2", culture));
                var tax = 0;
                if($("#use-tax").is(":checked"))
                {
                    tax = amount * 0.1;
                }
                
                
                $("#tax-amount").html(dataAdapter_product.formatNumber(tax, "c2", culture));
                $("#total-amount").html(dataAdapter_product.formatNumber((tax + amount), "c2", culture));
                
                $("#sub-total").val(amount);
                $("#total_tax").val(tax);
                $("#total_invoice").val((tax + amount));
               
            });
            
             $("#use-tax").click(function(){
                var rows = $("#detail_invoice_grid").jqxGrid('getrows');
                var amount = 0;
                for(var i=0;i<rows.length;i++)
                {
                    amount += rows[i].price * rows[i].quantity ;
                }
                var culture = {};
                culture.currencysymbol = "Rp. ";
                culture.currencysymbolposition = "before";
                culture.decimalseparator = '.';
                culture.thousandsseparator = ',';
                $("#untaxed-amount").html(dataAdapter_product.formatNumber(amount, "c2", culture));
                var tax = 0;
                if($("#use-tax").is(":checked"))
                {
                    tax = amount * 0.1;
                }
                $("#tax-amount").html(dataAdapter_product.formatNumber(tax, "c2", culture));
                $("#total-amount").html(dataAdapter_product.formatNumber((tax + amount), "c2", culture));
                $("#sub-total").val(amount);
                $("#total_tax").val(tax);
                $("#total_invoice").val((tax + amount));
               
            });
    
        $("#select-payroll-popup,#select_product_popup").jqxWindow({
            width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.5         
        });
        $("#inquiry-select").click(function(){
            $("#select-payroll-popup").jqxWindow('open');
        });
        
        var urlinquiry = "<?php echo base_url() ;?>invoice/get_wo_list_invoice";
        var sourceinquiry =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id'},
                { name: 'id_work_order'},
                { name: 'project_name'},
                { name: 'contract_startdate'},
                { name: 'contract_expdate'},
                { name: 'customer_name'},
                { name: 'periode_name'},
                { name: 'contract_startdate'},
                { name: 'contract_expdate'},
                { name: 'total_invoice'},
                { name: 'id_payroll_wo'},
                { name: 'date_start'},
                { name: 'date_finish'},
				{ name: 'payroll_type'},
				{ name: 'id_payroll_periode'},
            ],
            id: 'id_payroll',
            url: urlinquiry ,
            root: 'data'
        };
        var dataAdapterinquiry = new $.jqx.dataAdapter(sourceinquiry);
        $("#select-payroll-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 400,
            selectionmode : 'singlerow',
            source: dataAdapterinquiry,
            columnsresize: true,
            autoshowloadelement: false,                                                                                
            sortable: true,
            filterable: true,
            showfilterrow: true,
            autoshowfiltericon: true,
            columns: [
                { text: 'Customer Name', dataField: 'customer_name',width:122},
                { text: 'Project Name', dataField: 'project_name',width:122},
                { text: 'Salary Period', dataField: 'periode_name',width:122},
				{ text: 'Type', dataField: 'payroll_type',width:122},
                { text: 'Amount', dataField: 'total_invoice',cellsformat: 'd',width:122},
            ]
        });
        $('#select-payroll-grid').on('rowdoubleclick', function (event) 
        {
            var args = event.args;
            var data = $('#select-payroll-grid').jqxGrid('getrowdata', args.rowindex);
            $('#customer-name').val(data.customer_name);
            $('#project-name').val(data.project_name);
            $('#hidden_id_periode').val(data.id_payroll_wo);
            //alert(data.id_payroll_wo);
            $("#select-payroll-popup").jqxWindow('close');
             view_detail_invoice(data.id_work_order, data.id_payroll_periode);
            return false;
            var args = event.args;
            var data = $('#select-payroll-grid').jqxGrid('getrowdata', args.rowindex);
            //$('#inquiry-name').jqxInput('val', {label: data.inquiry_number, value: data.id_inquiry});
            //$('#customer-name').val(data.customer_name);
           
           
            
        })
        
        $("#invoice_date").jqxDateTimeInput({ height: '25px', value: null});

        <?php if (isset($is_edit)) : ?>
                    $('.document-action').show();
                    $("#invoice_date").jqxDateTimeInput('val', <?php echo "'" . date('m/d/Y', strtotime($data_edit->invoice_date)) . "'"; ?>);
        <?php endif; ?>

    });

    function SaveData() {
        var data_post = {};

        data_post['payroll_wo_id'] = $("#hidden_id_periode").val();
        data_post['total_invoice'] = $("#total_invoice").val();
        data_post['total_tax'] = $("#total_tax").val();
        data_post['sub-total'] = $("#sub-total").val();
        data_post['invoice_date'] = formatDate($("#invoice_date").val());
        //alert($("#invoice_date").val());
        //return false;
        data_post['no_rekening'] = $("#no_rekening").val();
        data_post['email'] = $("#email").val();
        
        data_post['detail_invoice'] = $("#detail_invoice_grid").jqxGrid('getrows');

        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_invoice'] = $("#id_invoice").val();

        alert(JSON.stringify(data_post));
        load_content_ajax(GetCurrentController(), 'save_edit_invoice', data_post);
    }

    function DiscardData()
    {
        load_content_ajax('payroll_periode', 'view_invoice', null);
    }

</script>

<style>
    .table-form
    {
        margin: 30px;
        width: 95%;
    }

    .table-form tr td
    {
    }

    .table-form tr
    {
        height: 35px;
    }

    .field 
    { 
        border: 1px solid #c4c4c4; 
        height: 15px; 
        width: 80%; 
        font-size: 11px; 
        padding: 4px 4px 4px 4px; 
        border-radius: 4px; 

    } 

    select.field
    {
        height: 26px;
    }

    .field:focus 
    { 
        outline: none; 
        border: 1px solid #7bc1f7; 
    } 

    .label
    {
        font-size: 11pt;
        width: 50px;
        padding-right: 20px;
        font: -webkit-small-control;
    }


</style>


<div style="font-size: 12px; font-family: Arial, Helvetica, Tahoma">
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_invoice" value="<?php echo (isset($is_edit) ? $data_edit->id_invoice : '') ?>" />
<div class="form-center" style="padding: 30px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;">Invoice / <span><?php echo (isset($is_edit) ? $data_edit[0]['invoice_number'] : ''); ?></span></h1></div>
    <div>
        <table class="table-form">
            <tr>
                <td>
                    <div class="label">
                        Invoice Date
                    </div>
                    <input id="hidden_id_periode" type="hidden" />
                    <div class="column-input" colspan="2">
                        <div id="invoice_date" name="invoice_date" style="display: inline-block;"></div>
                    </div>
                </td>
                <td>
                    <div class="label">
                        Project Name
                    </div>
                    <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="project-name" name="name" value="" readonly="readonly"/>
                        <button id="inquiry-select">...</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <div class="label">
                        Customer
                    </div>
                    <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-name" name="name" value="" readonly="readonly"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">
                        Email
                    </div>
                    <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="email" name="email"/>
                    </div>
                </td>
                <td>
                    <div class="label">
                        No Rekening
                    </div>
                    <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="no_rekening" name="no_rekening" />
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="row-color" style="width: 97%; margin-bottom: 4px;">
                        <button style="width: 30px;" id="add_product_invoice">+</button>
                        <button style="width: 30px;" id="remove_product_invoice">-</button>
                        <button style="width: 100px;" id="show_product_invoice">Show Product</button>

                        <input type="hidden" value="0" id="txt_hidden_product_invoice" />
                    </div>
                    <div id="detail_invoice_grid"></div>
                    <table style="float: right; text-align: right;margin-right: 20px;">
                        <tr>
                            <td></td>
                            <td>Untaxed Amount : </td>
                            <td style="width: 150px;"><div id="untaxed-amount">Rp. 0</div><input type="hidden" id="subtotal-value" value="<?php echo (isset($is_edit) ? $data_edit[0]['sub_total'] : '0') ?>"/></td>
                        </tr>
                        <tr>
                            <td style="padding-right: 10px;"><!--<div id="tax-select">--></div></td>
                            <td><input type="checkbox" id="use-tax" style="display: inline-block;" <?php echo (isset($is_edit) && ($data_edit[0]['tax'] != null || $data_edit[0]['tax'] > 0) ? 'checked=true' : '') ?> />Taxes (10%) : </td>
                            <td><div id="tax-amount">Rp. 0</div><input type="hidden" id="tax-value" value="<?php echo (isset($is_edit) ? $data_edit[0]['tax'] : '0') ?>"/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="border-top: solid thin black;">Total Amount : </td>
                            <td style="border-top: solid thin black;"><div id="total-amount">Rp. 0</div><input type="hidden" id="total-value" value="<?php echo (isset($is_edit) ? $data_edit[0]['total_price'] : '0') ?>"/></td>
                        </tr>
                    </table>
                    <input id="sub-total" type="hidden" />
                    <input id="total_tax" type="hidden" />'
                    <input id="total_invoice" type="hidden" />
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="select-payroll-popup">
    <div>Select Payroll Approve</div>
    <div id="select-payroll-grid"></div>
</div>
<div id="select_product_popup">
    <div>Select Product</div>
    <div id="select_product_grid"></div>
</div>
    


