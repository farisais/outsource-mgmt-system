<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
function formatDate(date) {
    var foo = date;
    var arr = foo.split("/");
    return arr[2]+'-'+arr[1]+'-'+arr[0];
}
function view_detail_invoice(id, payroll_periode){

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
                { name: 'total_price', type: 'number'},
				{ name: 'ppn', type: 'number'},
				{ name: 'profit', type: 'number'},
            ],
            id: 'id_product',
            url:url_detail,
            root: 'data'
        };
        var dataAdapter_product = new $.jqx.dataAdapter(source);
       
		$("#detail_invoice_grid").jqxGrid({source: dataAdapter_product});
		$("#detail_invoice_grid").jqxGrid("refreshdata");
        $("#detail_invoice_grid").on('bindingcomplete', function() {
			var records = dataAdapter_product.records;
			var management_fee = 0;
			var management_fee_tax = 0;
			for(i=0;i<records.length;i++)
			{
				management_fee += records[i]['profit'];
				management_fee_tax += records[i]['ppn'];
			}
			
			var element_profit = {};
			element_profit['element'] = "Management Fee";
			element_profit['value'] = management_fee;
			$("#profit-grid").jqxGrid("clear");
			$("#profit-grid").jqxGrid("addrow", null, element_profit);
			
			var element_tax = {};
			element_tax['element'] = "PPN";
			element_tax['value'] = management_fee_tax;
			$("#tax-grid").jqxGrid("clear");
			$("#tax-grid").jqxGrid("addrow", null, element_tax);
			
			calculate_amount(dataAdapter_product);
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
			alert('test');
            var args = event.args;
            var data = $('#select_product_grid').jqxGrid('getrowdata', args.rowindex);
			data['ppn'] = 0;
			data['price'] = 0;
			data['qty'] = 1;
            var commit0 = $("#detail_invoice_grid").jqxGrid('addrow', null, data);
            $("#select_product_popup").jqxWindow('close');
        });        
}
$(document).ready(function () {
		
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
		url: url_unit,
		root: 'data'
	};

	var unitAdapter = new $.jqx.dataAdapter(unitSource, {
		autoBind: true
	});

	var url = '';
	<?php
	if(isset($is_edit))
	{?>
		url = '<?php echo base_url() ?>invoice/get_detail_invoice?id=<?php echo $data_edit[0]['id_invoice']?>';
	<?php
	}
	?>
	var source =
	{
		datatype: "json",
		datafields:
		[
			{ name: 'id'},
			{ name: 'id_product'},
			{ name: 'product_category'},
			{ name: 'merk'},
			{ name: 'merk_name'},
			{ name: 'product_code'},
			{ name: 'product_name'},
			{ name: 'unit_name', value: 'unit', values: { source: unitAdapter.records, value: 'id_unit_measure', name: 'name' }},
			{ name: 'unit'}, 
			{ name: 'category_name'},
			{ name: 'qty', type: 'number'},
			{ name: 'price', type: 'number'},
			{ name: 'total_price', type: 'number'},
			{ name: 'ppn', type: 'number' }
		],
		id: 'id',
		url: url,
		root: 'data'
	};
	var dataAdapter_product = new $.jqx.dataAdapter(source);
	
	//=================================================================================
	//
	//   Detail Invoice Grid
	//
	//=================================================================================
	
	

	$("#detail_invoice_grid").jqxGrid(
	{
		theme: $("#theme").val(),
		width: '97%',
		height: 200,
		selectionmode : 'singlerow',
		columnsresize: true,
		autoshowloadelement: false,
		source: dataAdapter_product,
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
			{ text: 'Element', dataField: 'product', displayfield: 'product_name', width: 200, editable: false},
			{ text: 'Unit', dataField: 'unit', displayfield: 'unit_name' ,width: 50, columntype: 'dropdownlist',
				createeditor: function (row, value, editor) {
				editor.jqxDropDownList({ source: unitAdapter, displayMember: 'name', valueMember: 'id_unit_measure' });
				}
			},
			{ text: 'Description', dataField: 'description', width: 120},
			{ text: 'Quantity', dataField: 'qty', width: 100}, 
			{ text: 'Unit Price', dataField: 'price',cellsformat: 'c2', width: 150},
			{ text: 'Total Price', dataField: 'total_price', editable: false, width: 150,
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
		
	$("#detail_invoice_grid").on('cellvaluechanged', function (event) 
	{
		calculate_amount(dataAdapter_product);
	});
		
	//=================================================================================
	//
	//   Calculate Tax
	//
	//=================================================================================

		
	$("#detail_invoice_grid").on('rowdoubleclick', function(e){
		//alert(JSON.stringify($(this).jqxGrid("getrowdata", e.args.rowindex)));
	});
	
	//=================================================================================
	//
	//   Element Cost from Payroll
	//
	//=================================================================================

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

		$("#select-payroll-popup").jqxWindow('close');
		view_detail_invoice(data.id_work_order, data.id_payroll_periode);
		var args = event.args;
		var data = $('#select-payroll-grid').jqxGrid('getrowdata', args.rowindex);

	})
	
	$("#invoice_date").jqxDateTimeInput({ height: '25px', value: null});

	<?php if (isset($is_edit)) : ?>
				$('.document-action').show();
				$("#invoice_date").jqxDateTimeInput('val', <?php echo "'" . date('m/d/Y', strtotime($data_edit[0]['invoice_date'])) . "'"; ?>);
	<?php endif; ?>
	
	//=================================================================================
	//
	//   Profit & Tax Grid
	//
	//=================================================================================
	
		
	$("#profit-grid").jqxGrid({
		theme: $("#theme").val(),
		width: '97%',
		height: 100,
		selectionmode : 'singlerow',
		columnsresize: true,
		autoshowloadelement: false,                                                                                
		sortable: true,
		editable: true,  
		autoshowfiltericon: true,
		columns: [
			{ text: 'Element', dataField: 'element'},
			{ text: 'Value', dataField: 'value', cellsformat: 'c2', width:202}
		]
	});
	
	var local = {};
	local.currencysymbol = "Rp. ";
	local.currencysymbolposition = "before";
	local.decimalseparator = '.';
	local.thousandsseparator = ',';
	
	$("#profit-grid").jqxGrid('localizestrings', local);
	
	$("#add-profit").click(function(){
		var data = {};
		data['element'] = null;
		data['value'] = null;
		
		$("#profit-grid").jqxGrid("addrow", null, data);
	});
	
	$("#remove-profit").click(function(){
		var selectedrowindex = $("#profit-grid").jqxGrid('getselectedrowindex');
		if (selectedrowindex >= 0) {
			var id = $("#profit-grid").jqxGrid('getrowid', selectedrowindex);
			var commit1 = $("#profit-grid").jqxGrid('deleterow', id);
			calculate_amount(dataAdapter_product);	 
		}
	});
	
	$("#profit-grid").on('cellvaluechanged', function (event) 
	{
		var local = {};
		local.currencysymbol = "Rp. ";
		local.currencysymbolposition = "before";
		local.decimalseparator = '.';
		local.thousandsseparator = ',';
		
		$("#profit-grid").jqxGrid('localizestrings', local);
		calculate_amount(dataAdapter_product);	   
	});
	
	$("#tax-grid").jqxGrid({
		theme: $("#theme").val(),
		width: '97%',
		height: 100,
		selectionmode : 'singlerow',
		columnsresize: true,
		autoshowloadelement: false,                                                                                
		sortable: true,
		editable: true,  
		autoshowfiltericon: true,
		columns: [
			{ text: 'Element', dataField: 'element'},
			{ text: 'Value', dataField: 'value', cellsformat: 'c2', width:202}
		]
	});
	
	$("#tax-grid").jqxGrid('localizestrings', local);
	
	$("#add-tax").click(function(){
		var data = {};
		data['element'] = null;
		data['value'] = null;
		
		$("#tax-grid").jqxGrid("addrow", null, data);
	});
	
	$("#remove-tax").click(function(){
		var selectedrowindex = $("#tax-grid").jqxGrid('getselectedrowindex');
		if (selectedrowindex >= 0) {
			var id = $("#tax-grid").jqxGrid('getrowid', selectedrowindex);
			var commit1 = $("#tax-grid").jqxGrid('deleterow', id);
			calculate_amount(dataAdapter_product);	 
		}
	});
	
	$("#tax-grid").on('cellvaluechanged', function (event) 
	{
		var local = {};
		local.currencysymbol = "Rp. ";
		local.currencysymbolposition = "before";
		local.decimalseparator = '.';
		local.thousandsseparator = ',';
		
		$("#tax-grid").jqxGrid('localizestrings', local);
		calculate_amount(dataAdapter_product);	   
	});
	
	$("#detail_invoice_grid").on('bindingcomplete', function() {
		var local = {};
		local.currencysymbol = "Rp. ";
		local.currencysymbolposition = "before";
		local.decimalseparator = '.';
		local.thousandsseparator = ',';
		
		$("#detail_invoice_grid").jqxGrid('localizestrings', local);
		calculate_amount(dataAdapter_product);	 
	});
	
	//=================================================================================
	//
	//  Document Action
	//
	//=================================================================================
		
	$("#validate").click(function(){
		var data_post = {};

		data_post['payroll_wo_id'] = $("#hidden_id_periode").val();
		data_post['total_invoice'] = $("#total_invoice").val();
		data_post['total_tax'] = $("#total_tax").val();
		data_post['sub-total'] = $("#sub-total").val();
		data_post['invoice_date'] = formatDate($("#invoice_date").val());
		data_post['customer_po'] = $("#customer-po").val();
		data_post['payment_terms'] = $("#payment-terms").val();
		data_post['email'] = $("#email").val();
		
		data_post['detail_invoice'] = $("#detail_invoice_grid").jqxGrid('getrows');

		data_post['is_edit'] = $("#is_edit").val();
		data_post['id_invoice'] = $("#id_invoice").val();

		data_post['action_condition_identifier'] = 'validate';
		
		load_content_ajax(GetCurrentController(), 'save_edit_invoice', data_post);
	});
		
	$("#close-invoice").click(function(){
		var data_post = {};
		data_post['id_invoice'] = $("#id_invoice").val();
		load_content_ajax(GetCurrentController(), 'close_invoice', data_post);
	});

});

function calculate_amount(dataAdapter)
{
	var rows = $("#detail_invoice_grid").jqxGrid('getrows');   
	var amount = 0

	for(var i=0;i<rows.length;i++)
	{
		//alert(rows[i].quantity);
		amount += rows[i].price * rows[i].qty ;
	}
	
	
	rows = $("#profit-grid").jqxGrid("getrows");
	for(var i=0;i<rows.length;i++)
	{
		amount += rows[i].value;
	}
	

	var culture = {};
	culture.currencysymbol = "Rp. ";
	culture.currencysymbolposition = "before";
	culture.decimalseparator = '.';
	culture.thousandsseparator = ',';
	
	$("#untaxed-amount").html(dataAdapter.formatNumber(amount, "c2", culture));
	$("#sub-total").val(amount);
	
	calculate_tax(dataAdapter);
}

function calculate_tax(dataAdapter)
{
	var rows = $("#tax-grid").jqxGrid('getrows');   
	var amount = $("#sub-total").val();
	var tax = 0;
	for(var i=0;i<rows.length;i++)
	{
		tax += rows[i].value;
	}

	var culture = {};
	culture.currencysymbol = "Rp. ";
	culture.currencysymbolposition = "before";
	culture.decimalseparator = '.';
	culture.thousandsseparator = ',';

	var total_amount = tax + parseFloat(amount);
	
	$("#tax-amount").html(dataAdapter.formatNumber(tax, "c2", culture));
	$("#total-amount").html(dataAdapter.formatNumber((total_amount), "c2", culture));
	
	$("#sub-total").val(amount);
	$("#total_tax").val(tax);
	$("#total_invoice").val((total_amount));
}

function SaveData() {

	var data_post = {};

	data_post['payroll_wo_id'] = $("#hidden_id_periode").val();
	data_post['total_invoice'] = $("#total_invoice").val();
	data_post['total_tax'] = $("#total_tax").val();
	data_post['sub-total'] = $("#sub-total").val();
	data_post['customer_po'] = $("#customer-po").val();
	data_post['invoice_date'] = formatDate($("#invoice_date").val());

	data_post['payment_terms'] = $("#payment-terms").val();
	data_post['email'] = $("#email").val();
	
	data_post['detail_invoice'] = $("#detail_invoice_grid").jqxGrid('getrows');

	data_post['is_edit'] = $("#is_edit").val();
	data_post['id_invoice'] = $("#id_invoice").val();

	load_content_ajax(GetCurrentController(), 'save_edit_invoice', data_post);
}

function DiscardData()
{
	load_content_ajax('payroll_periode', 'view_invoice', null);
}

function printDocument()
{
	<?php 
	if(isset($is_edit))
	{?>
		window.location = "<?php echo base_url() ?>report/create_report?id=<?php echo $data_edit[0]['id_invoice'] ?>&doc=invoice&doc_no=<?php echo $data_edit[0]['invoice_number']?>";
	<?php
	}
	else
	{?>
		alert('Cannot generate report of unposted document');
	<?php  
	}
	?>	
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
<input type="hidden" id="id_invoice" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_invoice'] : '') ?>" />
<div class="document-action">
    <?php 
    if(!isset($is_view) && isset($is_edit) && $data_edit[0]['status_invoice'] == 'draft' || !isset($is_edit))
    {?>
    <button style="margin-left: 20px;" id="validate">Validate</button>
    <?php    
    }
    ?>
	
	<?php 
    if(!isset($is_view) && isset($is_edit) && $data_edit[0]['status_invoice'] == 'open')
    {?>
    <button style="margin-left: 20px;" id="close-invoice">Close Invoice</button>
    <?php    
    }
    ?>
    
    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_invoice'] == 'draft' ? 'class="status-active"' : '') ?> >
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_invoice'] == 'open' ? 'class="status-active"' : '') ?>>
            <span class="label">Open</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_invoice'] == 'close' ? 'class="status-active"' : '') ?>>
            <span class="label">Close</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div class="form-center" style="padding: 30px;">


    <div><h1 style="font-size: 18pt; font-weight: bold;">Invoice / <span><?php echo (isset($is_edit) ? $data_edit[0]['invoice_number'] : ''); ?></span></h1></div>
    <div>
        <table class="table-form">
            <tr>
                <td>
                    <div class="label">
                        Invoice Date
                    </div>
                    <input id="hidden_id_periode" type="hidden" value="<?php echo (isset($is_edit) ? $data_edit[0]['payroll_wo_id'] : '') ?>"/>
                    <div class="column-input" colspan="2">
                        <div id="invoice_date" name="invoice_date" style="display: inline-block;"></div>
                    </div>
                </td>
                <td>
                    <div class="label">
                        Project Name
                    </div>
                    <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="project-name" name="name" readonly="readonly" value="<?php echo (isset($is_edit) ? $data_edit[0]['project_name'] : '') ?>"/>
                        <button id="inquiry-select">...</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
					<div class="label">
                        Customer PO
                    </div>
                    <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-po" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['customer_po'] : '') ?>"/>
                    </div>
                </td>
                <td>
                    <div class="label">
                        Customer
                    </div>
                    <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['customer_name'] : '') ?>" readonly="readonly"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">
                        Email
                    </div>
                    <div class="column-input" colspan="2">
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="email" name="email" value="<?php echo (isset($is_edit) ? $data_edit[0]['email'] : '') ?>"/>
                    </div>
                </td>
                <td>
                    <div class="label">
                       Payment Terms
                    </div>
                    <div class="column-input" colspan="2">
						<select class="field" id="payment-terms">
							<option value="14">14 Days</option>
							<option value="30">30 Days</option>
							<option value="45">45 Days</option>
						</select>
                        <!--<input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="no_rekening" name="no_rekening" value="<?php echo (isset($is_edit) ? $data_edit[0]['no_rekening'] : '') ?>"/>-->
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row-color" style="width: 97%; margin-bottom: 4px;">
                        <!--<button style="width: 30px;" id="add_product_invoice">+</button>
                        <button style="width: 30px;" id="remove_product_invoice">-</button>-->
                        <button style="width: 100px;" id="show_product_invoice">Show Product</button>

                        <input type="hidden" value="0" id="txt_hidden_product_invoice" />
                    </div>
                    <div id="detail_invoice_grid"></div>
                    
                </td>
            </tr>
			<tr>
                <td colspan="2">
                    <div class="row-color" style="width: 97%; margin-bottom: 4px;">
                        <button style="width: 30px;" id="add-profit">+</button>
                        <button style="width: 30px;" id="remove-profit">-</button>
						<div style="display: inline;"><span>Profit Element</span></div>
                    </div>
                    <div id="profit-grid"></div>
                    
                </td>
            </tr>
			<tr>
                <td colspan="2">
                    <div class="row-color" style="width: 97%; margin-bottom: 4px;">
                        <button style="width: 30px;" id="add-tax">+</button>
                        <button style="width: 30px;" id="remove-tax">-</button>
						<div style="display: inline;"><span>Tax Element</span></div>
                    </div>
                    <div id="tax-grid"></div>
                    
                </td>
            </tr>
			<tr>
				<td colspan="2">
					<table style="float: right; text-align: right;margin-right: 20px;">
						<tr>
							<td></td>
							<td>Untaxed Amount : </td>
							<td style="width: 150px;"><div id="untaxed-amount">Rp. 0</div><input type="hidden" id="subtotal-value" value="<?php echo (isset($is_edit) ? $data_edit[0]['sub_total'] : '0') ?>"/></td>
						</tr>
						<tr>
							<td style="padding-right: 10px;"><!--<div id="tax-select">--></div></td>
							<td><input type="checkbox" id="use-tax" style="display: inline-block;" <?php echo (isset($is_edit) && ($data_edit[0]['total_tax'] != null || $data_edit[0]['total_tax'] > 0) ? 'checked=true' : '') ?> />Taxes (10%) : </td>
							<td><div id="tax-amount">Rp. 0</div><input type="hidden" id="tax-value" value="<?php echo (isset($is_edit) ? $data_edit[0]['total_tax'] : '0') ?>"/></td>
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
    


