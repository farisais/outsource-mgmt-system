<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
function component_grid_salary_setting(){    
    // Grid Struktur Organisasi
    var url = "<?php echo base_url() ;?>organisation_structure/get_organisation_structure_list_grid";
    var source =
    {
        datatype: "json",
        datafields: [
            { name:  'structure_org_id' },
            { name: 'structure_name' },
            { name: 'parent_structure' },
            { name: 'parent_name' }                  
        ],
        id: 'structure_org_id',
        url: url,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#select_structure_org_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 500,
        autoShowLoadElement: false,
        filterable: true,
        source: dataAdapter,
        sortable: true,
        filterMode: 'advanced',
        columnsresize: true,
        columns: [
          { text: 'Position Name', dataField: 'structure_name'},     
        ]
    });
    
    // Event On Double click Grid Struktur Organisasi
     $('#select_structure_org_grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select_structure_org_grid').jqxGrid('getrowdata', args.rowindex);
        //data['qty_request'] = 0;
        //data['qty_deliver'] = 0;
        //data['remark'] = '';
        var commit0 = $("#salary-setting-grid").jqxGrid('addrow', null, data);
        $("#select_structure_org_popup").jqxWindow('close');
        //console.log(data);
    });
    $('#txt_hidden_salary_setting').val(1);
}
$(document).ready(function(){
        //validate Work Order
        $("#wo_validate").on('click', function(e) {
            //alert('ok');
            //return false;
            var data_post = {};
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit[0]['id_work_order'] ?>;
            param.push(item);        
            data_post['id_work_order'] = <?php echo $data_edit[0]['id_work_order'] ?>;
            data_post['contract_startdate'] = formatDate($("#contract_startdate").val());
            data_post['contract_expdate'] = formatDate($("#contract_expdate").val());
            data_post['project_name'] = $("#project_name").val();

            load_content_ajax(GetCurrentController(), 'validate_work_order', data_post, param);
            e.preventDefault();
        });   
        
    $('#work-order-tabs').jqxTabs({ width: '100%', autoHeight: false,position: 'top', scrollPosition: 'right'});
    $("#work-order-date").jqxDateTimeInput({width: '250px', height: '25px'}); 
    $("#contract_expdate").jqxDateTimeInput({width: '250px', height: '25px',value: null});
    $("#contract_startdate").jqxDateTimeInput({width: '250px', height: '25px',value: null});
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', value: null}); 
    
    <?php if(isset($is_edit)) :?>
    $("#work-order-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date'])) . "'" ?>);
    $("#contract_expdate").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['contract_expdate'])) . "'" ?>); 
    $("#contract_startdate").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['contract_startdate'])) . "'" ?>);
   
    $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date_delivery'])) . "'" ?>);
    <?php endif; ?>
        
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
    
    //=================================================================================
    //
    //   work_order Grid
    //
    //=================================================================================
    
    var url = "<?php if (isset($is_edit)):?><?php echo base_url()?>work_order/get_work_order_product_list?id=<?php echo $data_edit[0]['id_work_order']; ?> <?php endif; ?>";
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
            { name: 'qty', type: 'number'}
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#work-order-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapter,
        editable: false,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Unit', dataField: 'unit_name'},
            { text: 'Qty Request', dataField: 'qty', cellsformat: 'd2', width: 100}
        ]
    });
    
    //=================================================================================
    //
    //   Survey Grid
    //
    //=================================================================================
    
    var urlSurvey = "<?php if (isset($is_edit)):?><?php echo base_url()?>work_order/get_work_order_survey_list?id=<?php echo $data_edit[0]['id_work_order']; ?> <?php endif; ?>";
    var sourceSurvey =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_work_order_survey'},
            { name: 'site_name'},
            { name: 'filename'},
            { name: 'remark'}
        ],
        id: 'id_work_order_survey',
        url: urlSurvey,
        root: 'data'
    };
    var dataAdapterSurvey = new $.jqx.dataAdapter(sourceSurvey);
    $("#survey-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        source: dataAdapterSurvey,
        selectionmode : 'singlerow',
        editable: false,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Filename', dataField: 'filename'},
            { text: 'Site', dataField: 'site_name'},
            { text: 'Remark', dataField: 'remark'}
        ]
    });
    
    //=================================================================================
    //
    //   Contract Grid
    //
    //=================================================================================
	
	var linkrenderer_contract = function (row, column, value) {
    return '<div style="margin: 4px;" class="jqx-left-align"><a href="' + '<?php echo base_url() ?>contract/download_file/' + value + '" target="_blank" style="padding: 2px">' + value + '</a></div>';
	};

    terms = [
        {label: 'Monthly', value: 'Monthly'}, 
        {label: 'Every 3 Months', value: 'Every 3 Months'},
        {label: 'Every 6 Months', value: 'Every 6 Months'},
        {label: 'Yearly', value: 'Yearly'}
    ];
    termsSource = {
        datatype: "array",
        datafields: [
            { name: 'label', type: 'string' },
            { name: 'value', type: 'string' }
        ],
        localdata: terms
    };
    termsAdapter = new $.jqx.dataAdapter(termsSource, {
        autoBind: true
    });
    ctstatus = [
        {label: 'Draft', value: 'draft'}, 
        {label: 'Active', value: 'active'},
        {label: 'Terminated', value: 'terminated'}
    ];
    ctstatusSource = {
        datatype: "array",
        datafields: [
            { name: 'label', type: 'string' },
            { name: 'value', type: 'string' }
        ],
        localdata: ctstatus
    };
    ctstatusAdapter = new $.jqx.dataAdapter(ctstatusSource, {
        autoBind: true
    });
    
    $("#add-contract").on('click', function(e) {
        $('#contract-file').trigger('click');
        e.preventDefault();
    });
    
	$("#add-contract").on('click', function(e) {
        $('#contract-file').trigger('click');
        e.preventDefault();
    });
    
    $('#contract-file').on('change', function(e) {
        $("#contract-form").ajaxForm({
            success: function (output) {
                $('#contract-file').val("");
				output = JSON.parse(output);
				alert(output.filename);
				var data = {};
				data['id_contract'] = output['id_contract'];
                data['filename'] = output['filename'];
                data['startdate'] = '';
                data['expdate'] = '';
                data['invoice_term'] = '';
                var commit0 = $("#contract-grid").jqxGrid('addrow', null, data);
            },
            complete: function (xhr) {
               
            }
        }).submit();
        e.preventDefault();
    });
	
    var urlContract = "<?php if (isset($is_edit)):?><?php echo base_url()?>work_order/get_work_order_contract_list?id=<?php echo $data_edit[0]['id_work_order']; ?> <?php endif; ?>";
    var sourceContract =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_contract'},
            { name: 'filename'},
            { name: 'startdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'expdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'invoice_term'},
            { name: 'invoice_term_name', value: 'invoice_term', values: { source: termsAdapter.records, value: 'value', name: 'label' }},
			{ name: 'po_number'},
			{ name: 'contract_number'},
            { name: 'status'},
            { name: 'status_name', value: 'status', values: { source: ctstatusAdapter.records, value: 'value', name: 'label' }},
        ],
        id: 'id_contract',
        url: urlContract,
        root: 'data'
    };
    var dataAdapterContract = new $.jqx.dataAdapter(sourceContract);
    $("#contract-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        source: dataAdapterContract,
        selectionmode : 'singlerow',
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Number', datafield: 'filename', editable: false, cellsrenderer: linkrenderer_contract, width: 110},
            { text: 'Start Date', datafield: 'startdate', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'Expire Date', datafield: 'expdate', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'Invoice Term', datafield: 'invoice_term', displayfield: 'invoice_term_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ 
                        source: termsAdapter, 
                        displayMember: 'label', 
                        valueMember: 'value'
                    });
                }
            },
			{ text: 'Contract Number', datafield: 'contract_number', width: 110}, 
			{ text: 'PO Number', datafield: 'po_number', width: 110},
            { text: 'Status', datafield: 'status', displayfield: 'status_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ 
                        source: ctstatusAdapter, 
                        displayMember: 'label', 
                        valueMember: 'value'
                    });
                }
            }
        ]
    });
	
	$("#save-contract").click(function(){
		var data_post = {};
		data_post['id_so'] = $("#id_so").val();
		data_post['contracts'] = $("#contract-grid").jqxGrid('getrows');
		 for (var i = 0; i < data_post['contracts'].length; i++) {
			data_post['contracts'][i].startdate = (data_post['contracts'][i].startdate == null ? null : data_post['contracts'][i].startdate.format('yyyy-mm-dd'));
			data_post['contracts'][i].expdate = (data_post['contracts'][i].expdate == null ? null : data_post['contracts'][i].expdate.format('yyyy-mm-dd'));
		}
		$.ajax({
			url: '<?php base_url() ?>so/save_so_contract',
			type: "POST",
			data: data_post,
			success: function(output)
			{		  
				alert('Transaction success');
				dataAdapterContract.dataBind();
				$("#contract-grid").jqxGrid({source: dataAdapterContract});
				$("#contract-grid").jqxGrid('refreshdata');
			},
			error: function( jqXhr ) 
			{
				$(".table-right-bar").unblock();
				if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
					var json = $.parseJSON( jqXhr.responseText );
					alert(json);
				}
				$("#error-content").html(jqXhr.responseText);
				$("#error-notification-default").jqxWindow("open");
			}
		});
	});

    
    //=================================================================================
    //
    //   procurement Grid
    //
    //=================================================================================
    
    var urlProc = "<?php if (isset($is_edit)):?><?php echo base_url()?>work_order/get_work_order_mr?id=<?=$data_edit[0]['id_work_order']?><?php endif; ?>";
    var sourceProc =
    {
        datatype: "json",
        datafields:
        [
            { name: 'product'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'unit_name', value: 'unit', values: { source: unitAdapter.records, value: 'id_unit_measure', name: 'name' } },
            { name: 'uom'},
            { name: 'qty_request', type: 'number'},
            { name: 'qty_require', type: 'number'},
            { name: 'remark', type: 'string'},
            { name: 'status'}
        ],
        id: 'product',
        url: urlProc,
        root: 'data'
    };
    
    var dataAdapterProc = new $.jqx.dataAdapter(sourceProc);
    $("#procurement-requirement-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterProc,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Unit', dataField: 'unit', displayfield: 'unit_name'},
            { text: 'Qty Request', dataField: 'qty_require', cellsformat: 'd2', width: 100}, 
            { text: 'Qty Deliver', dataField: 'qty_request', cellsformat: 'd2', width: 100},
            { text: 'Remark', dataField: 'remark'},
            { text: 'Status', dataField: 'status'}
        ]
    });
    
    //=================================================================================
    //
    //   Working Schedule Assignment Grid
    //
    //=================================================================================
    var shifts = [
        {label: '1', value: '1'},
        {label: '2', value: '2'},
        {label: '3', value: '3'} ,
        {label: 'off', value: 'off'}        
    ];
    var hours = [
        {label: '8 Hours', value: '8'},
        {label: '12 Hours', value: '12'},
        {label: '24 Hours', value: '24'}
    ];

    var urlWS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_schedule/get_work_schedule_detail_list/<?=$data_edit[0]['work_schedule']?><?php endif; ?>";
    var sourceWS =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_detail_work_schedule'},
            { name: 'area'},
            { name: 'id_customer_site'},
            { name: 'site'},
            { name: 'site_name'},
            { name: 'shift_no'},
            { name: 'shift_name', value: 'shift_no', values: { source: shifts, value: 'value', name: 'label' }},
            { name: 'qty', type: 'number'},
            { name: 'working_hour'},
            { name: 'working_hour_name', value: 'working_hour', values: { source: hours, value: 'value', name: 'label' }},
            { name: 'structure'},
            { name: 'structure_name'}
        ],
        id: 'id_employee',
        url: urlWS ,
        root: 'data'
    };
    var dataAdapterWS = new $.jqx.dataAdapter(sourceWS);
    $("#working-schedule-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        source: dataAdapterWS,
        columnsresize: true,
        autoshowloadelement: false,
        groupable: true,
        rowdetails:true,
        groups: ['site_name','area','structure_name'],
        sortable: true,
        closeablegroups:false,
        autoshowfiltericon: true,
        columns: [
            { text: 'Site', dataField: 'site', displayfield: 'site_name'},
            { text: 'Area', dataField: 'area', width: 100},
            { text: 'Shift', dataField: 'shift_no', width: 100},
            { text: 'Working Hour', datafield: 'working_hour', displayfield: 'working_hour_name', width: 100},
            { text: 'Qty', dataField: 'qty', width: 100},
            { text: 'Position', dataField: 'structure', displayfield: 'structure_name', width: 200}
        ]
    });
    
    
//=================================================================================
    //
    //   Salary Setting Grid
    //
    //=================================================================================
    $("#select_structure_org_popup,#select_employee_popup").jqxWindow({
        width: 500, height: 800, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
     //Source Level
    var url_unit_level = "<?php echo base_url() ;?>work_order/get_level_list";
    var unitSourceLevel =
    {
         datatype: "json",
         datafields: [
             { name: 'id_position_level'},
             { name: 'name'}
         ],
        id: 'id_position_level',
        url: url_unit_level ,
        root: 'data'
    };
    var unitAdapter_level = new $.jqx.dataAdapter(unitSourceLevel, {
        autoBind: true
    });
    
    
    //Source Salary Type
     var url_unit = "<?php echo base_url() ;?>work_order/get_salary_type"
     var unitSource =
     {
         datatype: "json",
         datafields: [
             { name: 'id'},
             { name: 'salary_type'}
         ],
        id: 'id',
        url: url_unit ,
        root: 'data'
     };
    
    var unitAdapter_salary_type = new $.jqx.dataAdapter(unitSource, {
        autoBind: true
    });
     var list = ['Per Tahun', 'Per Bulan', 'Per Minggu',, 'Per Hari', 'Per Jam'];
    
    var urlSS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_work_order_salary_setting?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceSS =
    {
        datatype: "json",
        datafields:
        [


            { name: 'id'},
            { name: 'structure_org_id'},
            { name: 'salary_type_id'},
            { name: 'level_employee_id'},
            { name: 'base_value'},
            { name: 'occurence'},
            { name: 'structure_name'},
            { name: 'salary_type'},
            { name: 'level_name'},

            { name: 'id_contract'},
            { name: 'filename'},
            { name: 'startdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'expdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'invoice_term'},
            { name: 'status'}

        ],
        id: 'id',
        url: urlSS ,
        root: 'data'
    };
    var dataAdapterSS = new $.jqx.dataAdapter(sourceSS);
    /*$("#salary-setting-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        source: dataAdapterSS,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        groupable: true,
        groups: ['structure_name','level_name'],
        editable: true,        
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add_salary_setting").click(function(){
                if($('#txt_hidden_salary_setting').val()==0){
                    component_grid_salary_setting();    
                }
                
                var offset = $("#remove_salary_setting").offset();
                $("#select_structure_org_popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove_salary_setting").width() + 20, y: parseInt(offset.top)} });
                $("#select_structure_org_popup").jqxWindow('open');
            });
            $("#remove_salary_setting").click(function(){
                var selectedrowindex = $("#salary-setting-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#salary-setting-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#salary-setting-grid").jqxGrid('deleterow', id);
                }
            });
            $("#save_salary_setting").click(function(){
                var data_post = {};
                data_post['salary_setting'] = $("#salary-setting-grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
               
            $.ajax({
        		url: 'work_order/save_wo_salary_setting',
        		type: "POST",
        		data: data_post,
                dataType:'json',
        		success:function(result){
                       	//if (result.success==true){
                    	    $('#salary-setting-grid').jqxGrid('updatebounddata');
                            //$("#jqxgrid").jqxGrid('updatebounddata');
                            //$('#salary-setting-grid').trigger("reloadGrid");
                       // }else{
                            //$("#jqxNotification").jqxNotification('open');
                         //   return false;
                        //}
                        
        		},
                complete:function(){
                    location.reload();
                    
                     
                }
           	})
            // setTimeout(function(){ $('#work-order-tabs').jqxTabs('select', 5); }, 3000);
             });
        },        
        columns: [

            { text: 'Structure Organization',displayfield: 'structure_name', dataField: 'structure_org_id'},
            { text: 'Level', dataField: 'level_employee_id', displayfield: 'level_name', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapter_level, displayMember: 'name', valueMember: 'id_position_level' });
            }},
             { text: 'Salary Type', dataField: 'salary_type_id', displayfield: 'salary_type', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapter_salary_type, displayMember: 'salary_type', valueMember: 'id' });
            }},
            { text: 'Value', datafield: 'base_value', width: 100},
             {
                        text: 'Occurence', datafield: 'occurence', width: 150, columntype: 'dropdownlist',
                        createeditor: function (row, column, editor) {
                            // assign a new data source to the dropdownlist.
                           
                            editor.jqxDropDownList({ autoDropDownHeight: true, source: list });
                        }
                    },
            

        ]
    });*/
//   END Salary Setting Grid    

//   Salary SO Assignment Grid
    var urlSO = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_work_order_so_assignment?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceSO =
    {
        datatype: "json",
        datafields:
        [

            { name: 'id_so_assignment'},
             { name: 'so_assignment_number'},
            { name: 'full_name'},
            { name: 'structure_name'},
            { name: 'level_posisi'},
            { name: 'fingerprint_assign_status'},
            { name: 'status'}
        ],
        id: 'id_so_assignmnent',
        url: urlSO ,
        root: 'data'
    };
    var dataAdapterSO = new $.jqx.dataAdapter(sourceSO);
    $("#so-assignment-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterSO,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add_so_assignment").click(function(){
                //component_grid_so_assignment();
                var offset = $("#remove_so_assignment").offset();
                $("#select_employee_popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove_so_assignment").width() + 20, y: parseInt(offset.top)} });
                $("#select_employee_popup").jqxWindow('open');
                //var selectedrowindex = $("#so-assignment-grid").jqxGrid('getselectedrowindex');
                //console.log(selectedrowindex);
            });
            $("#remove_so_assignment").click(function(){
                var selectedrowindex = $("#so-assignment-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#so-assignment-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#so-assignment-grid").jqxGrid('deleterow', id);
                }
            });
            
            $("#save_so_assignment").click(function(){
                var data_post = {};
                data_post['so_assignment'] = $("#so-assignment-grid").jqxGrid('getrows');
                loadAjaxGif();
                data_post['id']=$("#id_work_order").val();
                $.ajax({
            		url: 'work_order/save_wo_so_assignment',
            		type: "POST",
            		data: data_post,
                    dataType:'json',
            		success:function(result){
            		      //unloadAjaxGif();
      		        }
                    /*error:function(jqXhr){
                        if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                            var json = $.parseJSON( jqXhr.responseText );
                            alert(json);
                        }
                        $("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
                        $("#error-notification-default").jqxWindow("open");
                        
                        unloadAjaxGif();
                    }*/
           	    });
               location.reload();
                //$('#so-assignment-grid').jqxGrid('updatebounddata');
             });
             
             $("#unassign_so_assignment").click(function(){
                
                var row = $('#so-assignment-grid').jqxGrid('getrowdata', parseInt($('#so-assignment-grid').jqxGrid('getselectedrowindexes')));
        
                if(row != null)
                {
                   if(confirm("Are you sure you want to unassign employee : " + row.full_name))
                    {
                        var data_post = {};
                        data_post['so_assignment_number'] = row.so_assignment_number;
                        data_post['wo'] = $("#id_work_order").val();
                        loadAjaxGif();
                        $.ajax({
                    		url: 'work_order/unassign_so_assignment',
                    		type: "POST",
                    		data: data_post,
                            dataType:'json',
                    		success:function(result){
                    		      //unloadAjaxGif();
              		        }
                            /*error:function(jqXhr){
                                if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                                    var json = $.parseJSON( jqXhr.responseText );
                                    alert(json);
                                }
                                $("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
                                $("#error-notification-default").jqxWindow("open");
                                
                                unloadAjaxGif();
                            }*/
                   	    });
                        location.reload();
                    }
                }
                else
                {
                    alert('Select employee to unassign');
                }
             });
        },
        columns: [
            { text: 'ID', dataField: 'so_assignment_number', width: 50},
            { text: 'Name', dataField: 'full_name'},
            { text: 'Position', dataField: 'structure_name', width: 150},
            { text: 'Level', dataField: 'level_posisi', width: 150},
            { text: 'status', dataField: 'status'}
        ]
    });
    
    //=================================================================================
    //
    //   End SO Assignment  Grid
    //
    //=================================================================================
    //Source Employee
    // Grid Employee
    var url_employee = "<?php echo base_url() ;?>work_order/get_work_order_so_assignment_popup";
    var source_employee =
    {
        datatype: "json",
        datafields: [
            { name: 'so_assignment_number'},
            { name: 'full_name'},
            { name: 'structure_name'},
            { name: 'level_posisi'}              
        ],
        id: 'so_assignment_number',
        url: url_employee,
        root: 'data'
    };
    var dataAdapter_employee = new $.jqx.dataAdapter(source_employee);
    $("#select_employee_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 500,
        autoShowLoadElement: false,
        filterable: true,
        source: dataAdapter_employee,
        sortable: true,
        filterMode: 'advanced',
        columnsresize: true,
        columns: [
          { text: 'Full Name', dataField: 'full_name'}, 
          { text: 'Position', dataField: 'structure_name'}, 
          { text: 'Level', dataField: 'level_posisi'},     
        ]
    });
    
    // Event On Double click Grid Employee
     $('#select_employee_grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select_employee_grid').jqxGrid('getrowdata', args.rowindex);
        var commit0 = $("#so-assignment-grid").jqxGrid('addrow', null, data);
        $("#select_employee_popup").jqxWindow('close');
        
    });
    
    var url_employee_grid = "<?php echo base_url() ;?>work_order/get_employee_grid/<?php echo $data_edit[0]['id_work_order']; ?>"
    var unitSource_employee_grid =
    {
         datatype: "json",
         datafields: [
             { name: 'full_name'},
             { name: 'id_employee'}
         ],
        id: 'id_employee',
        url: url_employee_grid ,
        root: 'data'
    };
    
    var unitAdapter_employee_grid = new $.jqx.dataAdapter(unitSource_employee_grid, {
        autoBind: true
    });
    
    var shifts = [
        {label: '1', value: '1'},
        {label: '2', value: '2'},
        {label: '3', value: '3'}        
    ];
    var hours = [
        {label: '8 Hours', value: '8'},
        {label: '12 Hours', value: '12'}
    ];
    var structures = [
        {label: 'Security Office', value: '1'}, 
        {label: 'Shift Leader', value: '2'}, 
        {label: 'Security Supervisor', value: '3'}
    ];
    
     //=================================================================================
    //
    //   Time Schedulling Grid
    //
    //=================================================================================
    
    var urlTS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_work_order_time_schedulling?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceTS =
    {
        datatype: "json",
        url: urlTS ,
        datafields:
        [

 
            { name: 'id'},
            { name: 'kode_schedule'},
            { name: 'nama_schedule'},
            { name: 'from_time'},
            { name: 'to_time'},
            { name: 'begin_cin'},
            { name: 'end_cin'},
            { name: 'begin_cout'},
            { name: 'end_cout'},
            { name: 'late_in_tolerance'},
            { name: 'early_out_tolerance'},
            { name: 'schedule_type'}       
        ],
       
        id: 'id_employee',
       

        root: 'data'
    };
    var dataAdapterTS = new $.jqx.dataAdapter(sourceTS);
    $("#time-schedulling-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterTS,
        columnsresize: true,
        editable: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add_time_schedulling").click(function(){
                $("#time-schedulling-grid").jqxGrid('addrow', 5, {});
                //alert('ok');
            });
            $("#remove_time_schedulling").click(function(){
                var selectedrowindex = $("#time-schedulling-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#time-schedulling-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#time-schedulling-grid").jqxGrid('deleterow', id);
                }
            });
            $("#save_time_schedulling").click(function(){
                var data_post = {};
                data_post['time_schedulling'] = $("#time-schedulling-grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
                loadAjaxGif();
                $.ajax({
            		url: 'work_order/save_wo_time_schedulling',
            		type: "POST",
            		data: data_post,
                    dataType:'json',
            		success:function(result){
            		  //alert('Transaction success!');
         		     unloadAjaxGif();
                      dataAdapterTS.dataBind();
                      $("#time-schedulling-grid").jqxGrid({source: dataAdapterTS});
                      $("#time-schedulling-grid").jqxGrid('refresh');
        		  },
                  error: function( jqXhr ) 
                  {
                    //alert('Transaction failed!');
                    if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                        var json = $.parseJSON( jqXhr.responseText );
                        alert(json);
                    }
                    //$("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
                    //$("#error-notification-default").jqxWindow("open");
                        //alert(JSON.stringify(jqXhr));
                        $("#time-schedulling-grid").jqxGrid({source: dataAdapterTS});
                      $("#time-schedulling-grid").jqxGrid('refresh');
                        unloadAjaxGif();
                    }
           	    });
                //location.reload();
             });
        },
        columns: [ 

            
            { text: 'Kode', dataField: 'kode_schedule', width: 100},
            { text: 'Schedule Description', dataField: 'nama_schedule'},
            { text: 'Sch. Type', dataField: 'schedule_type', columntype: 'combobox', 
                createeditor: function (row, value, editor) {
                    editor.jqxComboBox({ source: [{value: 'on', label: 'ON'}, {value: 'off', label: 'OFF'}], displayMember: 'value', valueMember: 'value' });
                }
            }, 
            { text: 'From', dataField: 'from_time', width: 100, cellsformat: 't'},
            { text: 'To', dataField: 'to_time', width: 100, cellsformat: 't'},
            { text: 'Begin CIN', dataField: 'begin_cin', width: 100, cellsformat: 't'},
            { text: 'End CIN', dataField: 'end_cin', width: 100, cellsformat: 't'},
            { text: 'Begin COUT', dataField: 'begin_cout', width: 100, cellsformat: 't'},
            { text: 'End COUT', dataField: 'end_cout', width: 100, cellsformat: 't'},
            { text: 'Late Tolerance (minutes)', dataField: 'late_in_tolerance', width: 100},
            { text: 'Early Tolerance (minutes)', dataField: 'early_out_tolerance', width: 100},
        ]
    });
    
    $("#time-schedulling-grid").on('rowdoubleclick', function(event){
        alert(JSON.stringify($(this).jqxGrid('getrowdata', event.args.rowindex)));
    });
    
    
    //=================================================================================
    //
    //   Shift Rotation Grid
    //
    //=================================================================================
    //Source Kode Schedule
    var urlTS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_time_schedule?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    
    var unitTS =
    {
         datatype: "json",
         datafields: [
             { name: 'id'},
             { name: 'kode_schedule'}
         ],
        id: 'id',
        url: urlTS ,
        root: 'data'
    };
    
    var unitAdapterTS = new $.jqx.dataAdapter(unitTS, {
        autoBind: true
    });
    
     var urlSR = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_shift_rotation?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
   
    var sourceSR=
    {
        datatype: "json",
        url: urlSR ,
        datafields:
        [
            { name: 'employee_id'},
             { name: 'id'},
            { name: 'tahun'},
            { name: 'bulan'},
            { name: 'full_name'},
            { name: '01'},{ name: '02'},{ name: '03'},{ name: '04'},{ name: '05'},
            { name: '06'},{ name: '07'},{ name: '08'},{ name: '09'},{ name: 'd10'},
            { name: 'd11'},{ name: 'd12'},{ name: 'd13'},{ name: 'd14'},{ name: 'd15'},
            { name: 'd16'},{ name: 'd17'},{ name: 'd18'},{ name: 'd19'},{ name: 'd20'},
            { name: 'd21'},{ name: 'd22'},{ name: 'd23'},{ name: 'd24'},{ name: 'd25'},
            { name: 'd26'},{ name: 'd27'},{ name: 'd28'},{ name: 'd29'},{ name: 'd30'},
            { name: 'd31'},
            { name: 'd01'},{ name: 'd02'},{ name: 'd03'},{ name: 'd04'},{ name: 'd05'},
            { name: 'd06'},{ name: 'd07'},{ name: 'd08'},{ name: 'd09'},{ name: 'dd10'},
            { name: 'dd11'},{ name: 'dd12'},{ name: 'dd13'},{ name: 'dd14'},{ name: 'dd15'},
            { name: 'dd16'},{ name: 'dd17'},{ name: 'dd18'},{ name: 'dd19'},{ name: 'dd20'},
            { name: 'dd21'},{ name: 'dd22'},{ name: 'dd23'},{ name: 'dd24'},{ name: 'dd25'},
            { name: 'dd26'},{ name: 'dd27'},{ name: 'dd28'},{ name: 'dd29'},{ name: 'dd30'},
            { name: 'dd31'}
        ],
       id: 'id',
       root: 'data'
    };
    var dataAdapterSR = new $.jqx.dataAdapter(sourceSR);
    $("#shift_rotation_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        source: dataAdapterSR,
        columnsresize: true,
        editable: true,
        filterable: true,
        autoshowloadelement: false,
        sortable: true,
        pageable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add_shift_rotation").click(function(){
                $("#shift_rotation_grid").jqxGrid('addrow', 5, {});
                //alert('ok');
            });
            $("#copy_shift_rotation").click(function(){
               
                var index_rows = $('#shift_rotation_grid').jqxGrid('selectedrowindex');
                var data = $('#shift_rotation_grid').jqxGrid('getrowdata',index_rows);
                $("#shift_rotation_grid").jqxGrid('addrow', 5, data);
              //   var args = event.args;
        
                //alert('ok');
            });
            $("#remove_shift_rotation").click(function(){
                var selectedrowindex = $("#shift_rotation_grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#shift_rotation_grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#shift_rotation_grid").jqxGrid('deleterow', id);
                }
            });
            $("#save_shift_rotation").click(function(){
                var data_post = {};
                data_post['shift_rotation'] = $("#shift_rotation_grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
                $.ajax({
            		url: 'work_order/save_wo_shift_rotation',
            		type: "POST",
            		data: data_post,
                    dataType:'json',
            		success:function(result){
            		  
        		}
           	    })
               location.reload();
             });
        },
        columns: [

            
            { text: 'Employee Name', width: 160,dataField: 'employee_id', displayfield: 'full_name', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapter_employee_grid, displayMember: 'full_name', valueMember: 'id_employee' });
            }},
             { text: 'Tahun', dataField: 'tahun', columntype: 'TextBox',width: 60},
            { text: 'Bulan', dataField: 'bulan', columntype: 'TextBox',width: 60},
            { text: '01', cellsalign: 'center', width: 60,dataField: '01', displayfield: 'd01', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '02', cellsalign: 'center', width: 60,dataField: '02', displayfield: 'd02', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '03', cellsalign: 'center', width: 60,dataField: '03', displayfield: 'd03', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '04', cellsalign: 'center', width: 60,dataField: '04', displayfield: 'd04', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '05', cellsalign: 'center', width: 60,dataField: '05', displayfield: 'd05', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '06', cellsalign: 'center', width: 60,dataField: '06', displayfield: 'd06', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '07', cellsalign: 'center', width: 60,dataField: '07', displayfield: 'd07', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '08', cellsalign: 'center', width: 60,dataField: '08', displayfield: 'd08', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '09', cellsalign: 'center', width: 60,dataField: '09', displayfield: 'd09', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '10', cellsalign: 'center', width: 60,dataField: 'd10', displayfield: 'dd10', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '11', cellsalign: 'center', width: 60,dataField: 'd11', displayfield: 'dd11', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '12', cellsalign: 'center', width: 60,dataField: 'd12', displayfield: 'dd12', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '13', cellsalign: 'center', width: 60,dataField: 'd13', displayfield: 'dd13', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '14', cellsalign: 'center', width: 60,dataField: 'd14', displayfield: 'dd14', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '15', cellsalign: 'center', width: 60,dataField: 'd15', displayfield: 'dd15', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '16', cellsalign: 'center', width: 60,dataField: 'd16', displayfield: 'dd16', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '17', cellsalign: 'center', width: 60,dataField: 'd17', displayfield: 'dd17', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '18', cellsalign: 'center', width: 60,dataField: 'd18', displayfield: 'dd18', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '19', cellsalign: 'center', width: 60,dataField: 'd19', displayfield: 'dd19', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '20', cellsalign: 'center', width: 60,dataField: 'd20', displayfield: 'dd20', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '21', cellsalign: 'center', width: 60,dataField: 'd21', displayfield: 'dd21', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '22', cellsalign: 'center', width: 60,dataField: 'd22', displayfield: 'dd22', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '23', cellsalign: 'center', width: 60,dataField: 'd23', displayfield: 'dd23', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '24', cellsalign: 'center', width: 60,dataField: 'd24', displayfield: 'dd24', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '25', cellsalign: 'center', width: 60,dataField: 'd25', displayfield: 'dd25', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '26', cellsalign: 'center', width: 60,dataField: 'd26', displayfield: 'dd26', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '27', cellsalign: 'center', width: 60,dataField: 'd27', displayfield: 'dd27', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '28', cellsalign: 'center', width: 60,dataField: 'd28', displayfield: 'dd28', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '29', cellsalign: 'center', width: 60,dataField: 'd29', displayfield: 'dd29', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '30', cellsalign: 'center', width: 60,dataField: 'd30', displayfield: 'dd30', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '31', cellsalign: 'center', width: 60,dataField: 'd31', displayfield: 'dd31', columntype: 'combobox',
            createeditor: function (row, value, editor) {
                editor.jqxComboBox({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            

        ]
    });
    
    //=================================================================================
    //
    //   Select Device Grid
    //
    //=================================================================================
    $("#select-device-popup").jqxWindow({
        width: 600, height: 400, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    var urlDevice = "<?php echo base_url()?>fingerprint/get_fingerprint_device_list_active";

    
    var sourceDevice =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_fingerprint_device'},
            { name: 'merk'},
            { name: 'series'},
            { name: 'serial_number'},
        ],
        id: 'id_fingerprint_device',
        url: urlDevice ,
        root: 'data'
    };
    var dataAdapterDevice = new $.jqx.dataAdapter(sourceDevice);
    $("#select-device-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        source: dataAdapterDevice,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Serial Number', dataField: 'serial_number', width: 150},
            { text: 'Merk', dataField: 'merk'},
            { text: 'Series', dataField: 'series', width: 150}                                   
        ]
    });
    
    $("#select-device-grid").on('rowdoubleclick', function(event){
        var args = event.args;
        var data = $('#select-device-grid').jqxGrid('getrowdata', args.rowindex);
        data['fingerprint_device'] = data['id_fingerprint_device'];
        data['ip_local'] = null;
        data['port'] = null;
        data['comm_password'] = null;
        data['fdid'] = null;
        data['site'] = null;
        var commit0 = $("#fingerprint-device-grid").jqxGrid('addrow', null, data);
        $("#fingerprint-device-grid").jqxGrid('setcolumnproperty', 'serial_number', 'editable', false);
        $("#fingerprint-device-grid").jqxGrid('setcolumnproperty', 'status', 'editable', false);
        $("#select-device-popup").jqxWindow('close');
    });
    
    //=================================================================================
    //
    //   Fingerprint Device Grid
    //
    //=================================================================================
    
    var urlFingerprintAssign = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>fingerprint_assign/get_fingerprint_assign_detail_by_wo?wo=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceFingerprintAssign =
    {
        datatype: "json",
        url: urlFingerprintAssign ,
        datafields:
        [
            { name: 'id_fingerprint_assign_detail'},
            { name: 'fingerprint_assign'},
            { name: 'work_order'},
            { name: 'fingerprint_device'},
            { name: 'serial_number'},
            { name: 'merk'},
            { name: 'type'},
            { name: 'ip_local'},
            { name: 'comm_password'},
            { name: 'port'},
            { name: 'fdid'},
            { name: 'site'},      
            { name: 'site_name'},
            { name: 'app_id'},
            { name: 'status'},
        ],
       
        id: 'id_fingerprint_assign_detail',
        root: 'data'
    };
    var dataAdapterFingeprintAssign = new $.jqx.dataAdapter(sourceFingerprintAssign);
    
    var urlSites = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>customer/get_customer_site_list/<?php echo $data_edit[0]['customer']; ?><?php endif; ?>";
    var sourceSites =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_customer_site'},
            { name: 'site'},
            { name: 'site_name'},
            { name: 'address'},
            { name: 'city'},
            { name: 'city_name'}
        ],
        id: 'id_customer_site',
        url: urlSites ,
        root: 'data'
    };
    
     var dataAdapterSites = new $.jqx.dataAdapter(sourceSites);
         
    $("#fingerprint-device-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterFingeprintAssign,
        columnsresize: true,
        editable: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add-fingerprint").click(function(){
                $("#select-device-popup").jqxWindow('open');
                //alert('ok');
            });
            $("#remove-fingerprint").click(function(){
                var selectedrowindex = $("#fingerprint-device-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#fingerprint-device-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#fingerprint-device-grid").jqxGrid('deleterow', id);
                }
            });
            /*$("#save_time_schedulling").click(function(){
                var data_post = {};
                data_post['time_schedulling'] = $("#time-schedulling-grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
                $.ajax({
            		url: 'work_order/save_wo_time_schedulling',
            		type: "POST",
            		data: data_post,
                    dataType:'json',
            		success:function(result){
            		  
        		}
           	    })
             });*/
        },
        columns: [

            { text: 'Fingerprint Serial', dataField: 'fingerprint_device', displayfield: 'serial_number', width: 150},
            { text: 'IP Local', dataField: 'ip_local', width: 150},
            { text: 'Port', dataField: 'port', width: 100},
            { text: 'Comm Password', dataField: 'comm_password',width: 100}, 
            { text: 'Fdid', dataField: 'fdid',width: 100},
            { text: 'Site', dataField: 'site', displayfield: 'site_name', columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({source: dataAdapterSites, displayMember: 'site_name', valueMember: 'site' });
                },
            },
            { text: 'AppID', dataField: 'app_id', width: 150},
            { text: 'Status', dataField: 'status', width: 100},
        ]
    });
    
     $("#fingerprint-device-grid").jqxGrid('setcolumnproperty', 'serial_number', 'editable', false);
     $("#fingerprint-device-grid").jqxGrid('setcolumnproperty', 'status', 'editable', false);
     
     
    //=================================================================================
    //
    //   Fingerprint Device Grid
    //
    //=================================================================================
    
    var urlSOFP = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_work_order_so_assignment_fp?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceSOFP =
    {
        datatype: "json",
        datafields:
        [

            { name: 'id_so_assignment'},
            { name: 'so_assignment_number'},
            { name: 'full_name'},
            { name: 'employee_number'},
            { name: 'fingerprint_template'},
            { name: 'structure_name'},
            { name: 'level_posisi'},
            { name: 'fingerprint_tmp'},
            { name: 'fp_status'},
            { name: 'fingerprint_assign_status'}
        ],
        id: 'id_so_assignmnent',
        url: urlSOFP ,
        root: 'data'
    };
    var dataAdapterSOFP = new $.jqx.dataAdapter(sourceSOFP);
    
    $("#fingerprint-assign-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterSOFP,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'ID', dataField: 'so_assignment_number', width: 50},
            { text: 'Name', dataField: 'full_name'},
            { text: 'Position', dataField: 'structure_name', width: 150},
            { text: 'Level', dataField: 'level_posisi', width: 150},
            { text: 'FP Status', dataField: 'fp_status'},
            { text: 'Assign Status', dataField: 'fingerprint_assign_status', width: 150},
        ]
    });
    
    $("#fingerprint-assign-grid").on('rowdoubleclick', function(event){
        //var data = $(this).jqxGrid('getrowdata', event.args.rowindex);
//        alert(JSON.stringify(data));
    });
    
    //=================================================================================
    //
    //   Fingerprint APPID for Enroll
    //
    //=================================================================================
    
    $("#select-appid-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    var url_select_appid = "<?php echo base_url() ;?>fingerprint_assign/get_fingerprint_assign_all_assgined";
    var source_select_appid =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_fingerprint_device'},
            { name: 'fingerprint_assign'},
            { name: 'merk'},
            { name: 'series'},
            { name: 'serial_number'},
            { name: 'app_id'},
        ],
        id: 'id_fingerprint_assign',
        url: url_select_appid ,
        root: 'data'
    };
    var dataAdapter_select_appid = new $.jqx.dataAdapter(source_select_appid);
    
    $("#select-appid-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_appid,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Serial Number', dataField: 'id_fingerprint_device', displayfield: 'serial_number', width: 150},
            { text: 'Merk', dataField: 'merk'},
            { text: 'Series', dataField: 'series',width: 150}, 
            { text: 'AppID', dataField: 'app_id', width: 100}                                        
        ]
    });
    
    $('#select-appid-grid').on('rowdoubleclick', function (event) 
    {
        $("#console-mode").val("enroll_fingerprint");
        
        var args = event.args;
        var data = $('#select-appid-grid').jqxGrid('getrowdata', args.rowindex);
        $("#appid-enroll").val(data['app_id']);
        $("#devid-enroll").val(data['serial_number']);

        $("#select-appid-popup").jqxWindow('close');
         $("#command-popup").remove();
        loadAjaxGif();
        //$("#command-popup").jqxWindow('open');
        $("#for-console").load('<?php echo base_url() ?>fingerprint/open_console', null, function(result){
            unloadAjaxGif();
            $("#command-popup").jqxWindow('open');
        });
    });
    
    //=================================================================================
    //
    //   Button Action
    //
    //=================================================================================
    
    $("#save-fingerprint").click(function(){
        
        $('#fingerprint-device-grid').jqxGrid('sortby', 'site', 'asc');        
        var data_post = {};
        data_post['work_order'] = <?php echo $data_edit[0]['id_work_order'] ?>;  
        data_post['work_order_number'] = '<?php echo $data_edit[0]['work_order_number'] ?>';
        data_post['employee_assign'] = $("#fingerprint-device-grid").jqxGrid('getrows');
        //alert(JSON.stringify(data_post));
        loadAjaxGif();
        $.ajax({
    		url: '<?php echo base_url() ?>fingerprint_assign/save_fingerprint_assign_from_wo',
    		type: "POST",
    		data: data_post,
            dataType:'json',
    		success:function(result){
                unloadAjaxGif();
                //alert(result);
                var obj = result;
                
                if(obj.status == 'success')
                {
                    alert('Transaction Success!');
                    //$("#error-notification-default").jqxWindow("open");
                    
                    //alert(obj.employee_assign.length);
                    $('#fingerprint-device-grid').jqxGrid('refreshdata');
                    $('#fingerprint-device-grid').jqxGrid('refresh');
                    dataAdapterFingeprintAssign.dataBind();
                    $('#fingerprint-device-grid').jqxGrid({source: dataAdapterFingeprintAssign});
                }
                else
                {
                    alert('Transaction Failed!');
                }
                
                unloadAjaxGif();
                
            },
            error: function( jqXhr ) 
            {
                
                if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                    var json = $.parseJSON( jqXhr.responseText );
                    alert(json);
                }
                $("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
                $("#error-notification-default").jqxWindow("open");
                
                unloadAjaxGif();
            }
        })
        //unloadAjaxGif();
    });
    
    $("#assign-fingerprint").click(function(){
        $('#fingerprint-device-grid').jqxGrid('sortby', 'site', 'asc');        
        var data_post = {};
        data_post['work_order'] = <?php echo $data_edit[0]['id_work_order'] ?>;  
        //alert(JSON.stringify(data_post));
        loadAjaxGif();
        $.ajax({
    		url: '<?php echo base_url() ?>fingerprint_assign/assign_fingerprint_device_from_wo',
    		type: "POST",
    		data: data_post,
            dataType:'json',
    		success:function(result){
                unloadAjaxGif();
                //alert(result);
                var obj = result;
                
                if(obj.status == 'success')
                {
                    alert('Transaction Success!');
                    //$("#error-notification-default").jqxWindow("open");
                    
                    //alert(obj.employee_assign.length);
                    $('#fingerprint-device-grid').jqxGrid('refreshdata');
                    $('#fingerprint-device-grid').jqxGrid('refresh');
                    dataAdapterFingeprintAssign.dataBind();
                    $('#fingerprint-device-grid').jqxGrid({source: dataAdapterFingeprintAssign});
                }
                else
                {
                    alert('Transaction Failed!');
                }
                
                unloadAjaxGif();
                
            },
            error: function( jqXhr ) 
            {
                
                if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                    var json = $.parseJSON( jqXhr.responseText );
                    alert(json);
                }
                $("#error-content").html(JSON.stringify(jqXhr.responseText).replace("\r\n", ""));
                $("#error-notification-default").jqxWindow("open");
                
                unloadAjaxGif();
            }
        })
            
    });    

    
    $("#sync-fingerprint").click(function(){
        $("#console-mode").val("sync_fingerprint");
        $("#command-popup").remove();
        loadAjaxGif();
        //$("#command-popup").jqxWindow('open');
        $("#for-console").load('<?php echo base_url() ?>fingerprint/open_console', null, function(result){
            //emitCommand(appid, devid, command, param);
            unloadAjaxGif();
            $("#command-popup").jqxWindow('open');
        });
    });
    
    $("#enroll-fingerprint").click(function(){
        var row = $('#fingerprint-assign-grid').jqxGrid('getrowdata', parseInt($('#fingerprint-assign-grid').jqxGrid('getselectedrowindexes')));
        
        if(row != null)
        {
            //alert(JSON.stringify(row));
            $("#id-employee-enroll").val(row.so_assignment_number);
            $("#employee-number-enroll").val(row.employee_number);
            $("#employee-name-enroll").val(row.full_name);
            $("#select-appid-popup").jqxWindow('open'); 
        }
        else
        {
            alert('Select employee you want to enroll first');
        }
    });
     //=================================================================================
    //
    //   Ara Rotation Grid
    //
    //=================================================================================
    //Source Kode Schedule
    var area_sites = [
        
        
        {label: 'A1', value: '4'},
        {label: 'A2', value: '5'},
        {label: 'N', value: '6'}
    ];
    
    
    var area_sitesSource = {
        datatype: "array",
        datafields: [
            { name: 'label', type: 'string' },
            { name: 'value', type: 'string' }
        ],
        localdata: area_sites
    };
    var AreaAdapter = new $.jqx.dataAdapter(area_sitesSource, {
        autoBind: true
    });
    
     var urlAR = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_area_rotation?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
   
    var sourceAR=
    {
        datatype: "json",
        url: urlAR ,
        datafields:
        [
            { name: 'employee_id'},
             { name: 'id'},
            { name: 'tahun'},
            { name: 'bulan'},
            { name: 'full_name'},
            { name: 'd01'},{ name: 'd02'},{ name: 'd03'},{ name: 'd04'},{ name: 'd05'},
            { name: 'd06'},{ name: 'd07'},{ name: 'd08'},{ name: 'd09'},{ name: 'dd10'},
            { name: 'dd11'},{ name: 'dd12'},{ name: 'dd13'},{ name: 'dd14'},{ name: 'dd15'},
            { name: 'dd16'},{ name: 'dd17'},{ name: 'dd18'},{ name: 'dd19'},{ name: 'dd20'},
            { name: 'dd21'},{ name: 'dd22'},{ name: 'dd23'},{ name: 'dd24'},{ name: 'dd25'},
            { name: 'dd26'},{ name: 'dd27'},{ name: 'dd28'},{ name: 'dd29'},{ name: 'dd30'},
            { name: 'dd31'},
            { name: '01', value: '01', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: '02', value: '02', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: '03', value: '03', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: '04', value: '04', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: '05', value: '05', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: '06', value: '06', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: '07', value: '07', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: '08', value: '08', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: '09', value: '09', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd10', value: 'd10', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd11', value: 'd11', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd12', value: 'd12', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd13', value: 'd13', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd14', value: 'd14', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd15', value: 'd15', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd16', value: 'd16', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd17', value: 'd17', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd18', value: 'd18', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd19', value: 'd19', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd20', value: 'd20', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd21', value: 'd21', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd22', value: 'd22', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd23', value: 'd23', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd24', value: 'd24', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd25', value: 'd25', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd26', value: 'd26', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd27', value: 'd27', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd28', value: 'd28', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd29', value: 'd29', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd30', value: 'd30', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
            { name: 'd31', value: 'd31', values: { source: AreaAdapter.records, value: 'value', name: 'label' }},
           
        ],
       id: 'id',
       root: 'data'
    };
    var dataAdapterAR = new $.jqx.dataAdapter(sourceAR);
    $("#area_rotation_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        source: dataAdapterAR,
        columnsresize: true,
        editable: true,
        filterable: true,
        autoshowloadelement: false,
        sortable: true,
        pageable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#detail_area_rotation").click(function(){
                //$("#area_rotation_grid").jqxGrid('addrow', 5, {});
                    var data_post = {};
                    var param = [];
                    var item = {};
                    item['paramName'] = 'id';
                    item['paramValue'] = <?php echo $data_edit[0]['id_work_order'] ?>;
                    param.push(item);        
                    data_post['id_work_order'] = <?php echo $data_edit[0]['id_work_order'] ?>;
                    load_content_ajax(GetCurrentController(), 400, data_post, param);
               // alert('ok');
            });
            $("#add_area_rotation").click(function(){
                $("#area_rotation_grid").jqxGrid('addrow', 5, {});
                //alert('ok');
            });
            $("#area_shift_rotation").click(function(){
               
                var index_rows = $('#area_rotation_grid').jqxGrid('selectedrowindex');
                var data = $('#area_rotation_grid').jqxGrid('getrowdata',index_rows);
                $("#area_rotation_grid").jqxGrid('addrow', 5, data);
              //   var args = event.args;
        
                //alert('ok');
            });
            $("#remove_area_rotation").click(function(){
                var selectedrowindex = $("#area_rotation_grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#area_rotation_grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#area_rotation_grid").jqxGrid('deleterow', id);
                }
            });
            $("#save_area_rotation").click(function(){
                var data_post = {};
                data_post['area_rotation'] = $("#area_rotation_grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
                $.ajax({
            		url: 'work_order/save_wo_area_rotation',
            		type: "POST",
            		data: data_post,
                    dataType:'json',
            		success:function(result){
            		  
        		}
           	    })
               location.reload();
             });
        },
        columns: [

            
            { text: 'Employee Name', width: 160,dataField: 'employee_id', displayfield: 'full_name', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapter_employee_grid, displayMember: 'full_name', valueMember: 'id_employee' });
            }},
             { text: 'Tahun', dataField: 'tahun', columntype: 'TextBox',width: 60},
            { text: 'Bulan', dataField: 'bulan', columntype: 'TextBox',width: 60},
            { text: '01', dataField: '01', displayfield: 'd01', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value',autoDropDownHeight:true,autoOpen: true });
                }
            },
            { text: '02', dataField: '02', displayfield: 'd02', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '03', dataField: '03', displayfield: 'd03', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '04', dataField: '04', displayfield: 'd04', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '05', dataField: '05', displayfield: 'd05', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '06', dataField: '06', displayfield: 'd06', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '07', dataField: '07', displayfield: 'd07', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '08', dataField: '08', displayfield: 'd08', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '09', dataField: '09', displayfield: 'd09', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '10', dataField: 'd10', displayfield: 'dd10', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '11', dataField: 'd11', displayfield: 'dd11', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '12', dataField: 'd12', displayfield: 'dd12', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: '13', dataField: 'd13', displayfield: 'dd13', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '14', dataField: 'd14', displayfield: 'dd14', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '15', dataField: 'd15', displayfield: 'dd15', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '16', dataField: 'd16', displayfield: 'dd16', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '17', dataField: 'd17', displayfield: 'dd17', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '18', dataField: 'd18', displayfield: 'dd18', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '19', dataField: 'd19', displayfield: 'dd19', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '20', dataField: 'd20', displayfield: 'dd20', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '21', dataField: 'd21', displayfield: 'dd21', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '22', dataField: 'd22', displayfield: 'dd22', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '23', dataField: 'd23', displayfield: 'dd23', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '24', dataField: 'd24', displayfield: 'dd24', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '25', dataField: 'd25', displayfield: 'dd25', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '26', dataField: 'd26', displayfield: 'dd26', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '27', dataField: 'd27', displayfield: 'dd27', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '28', dataField: 'd28', displayfield: 'dd28', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '29', dataField: 'd29', displayfield: 'dd29', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '30', dataField: 'd30', displayfield: 'dd30', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },{ text: '31', dataField: 'd31', displayfield: 'dd31', columntype: 'dropdownlist', width: 30,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: AreaAdapter, displayMember: 'label', valueMember: 'value' });
                }
            },
            

        ]
    });
    
    
     //=================================================================================
    //
    //   Area Schedulling Grid
    //
    //=================================================================================
    /*
    var customer_sites = [
        {label: 'Gedung A', value: '1'},
        {label: 'Gedung B', value: '2'}
    ];
    */
    
    var customer_sitesSource = {
        datatype: "json",
        datafields: [
            { name: 'site_name' },
            { name: 'id_customer_site'}
        ],        
        url:"<?=base_url();?>work_order/init_get_customer_site",
        root: 'data'
    };
    var CustomerAdapter = new $.jqx.dataAdapter(customer_sitesSource, {
        autoBind: true
    });
    
    
    
    var urlAS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_work_order_area_schedulling?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceAS =
    {
        datatype: "json",
        url: urlAS ,
        datafields:
        [

 
            { name: 'id'},
            { name: 'kode_schedule'},
            { name: 'nama_schedule'},
            { name: 'customer_site_id'},
            { name: 'site_name', value: 'customer_site_id', values: { source: CustomerAdapter, displayMember: 'site_name', valueMember: 'id_customer_site' }},
            
            { name: 'description'},
        ],
       
        id: 'id_employee',
       

        root: 'data'
    };
    var dataAdapterAS = new $.jqx.dataAdapter(sourceAS);
    $("#area-schedulling-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterAS,
        columnsresize: true,
        editable: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add_area_schedulling").click(function(){
                $("#area-schedulling-grid").jqxGrid('addrow', 5, {});
                //alert('ok');
            });
            $("#remove_area_schedulling").click(function(){
                var selectedrowindex = $("#area-schedulling-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#area-schedulling-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#area-schedulling-grid").jqxGrid('deleterow', id);
                }
            });
            $("#save_area_schedulling").click(function(){
                var data_post = {};
                data_post['area_schedulling'] = $("#area-schedulling-grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
                $.ajax({
            		url: 'work_order/save_wo_area_schedulling',
            		type: "POST",
            		data: data_post,
                    dataType:'json',
            		success:function(result){
            		  
        		}
           	    })
                location.reload();
             });
        },
        columns: [ 

            { text: 'Kode', dataField: 'kode_schedule', width: 100},
            { text: 'Area Name', dataField: 'nama_schedule'},
            { text: 'Customer Site', dataField: 'customer_site_id', displayfield: 'site_name', columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) {
                    editor.jqxDropDownList({ source: CustomerAdapter, displayMember: 'site_name', valueMember: 'id_customer_site' });
                }
            },
            { text: 'Description', dataField: 'description'},
        ]
    });
    
    //=================================================================================
    //
    //   Area Schedulling  Grid
    //
    //=================================================================================

    //=================================================================================
    //
    //   CE Assign Grid
    //
    //=================================================================================

    var celink = function (row, column, value) {
        return '<div style="margin: 4px;" class="jqx-left-align"><a href="#" style="padding: 2px">' + value + '</a></div>';
    };

    var url_ce = "<?php if(isset($is_edit)){?><?php echo base_url() ;?>work_order/get_structure_ws_from_wo/<?php echo $data_edit[0]['id_work_order'] ?><?php } ?>";
    var source_ce =
    {
        datatype: "json",
        datafields:
            [
                { name: 'structure'},
                { name: 'structure_name'},
                { name: 'cost_element'},
                { name: 'cost_element_name'}
            ],
        id: 'structure',
        url: url_ce,
        root: 'data'
    };

    var dataAdapterCE = new $.jqx.dataAdapter(source_ce);

    $("#ce-assign-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 200,
            source: dataAdapterCE,
            columnsresize: true,
            autoshowloadelement: false,
            sortable: true,
            columns: [
                { text: 'Position', dataField: 'structure', displayfield: 'structure_name', width: 150},
                { text: 'Cost Element', dataField: 'cost_element', displayfield: 'cost_element_name', cellsrenderer: celink}
            ]
        });

    $("#ce-assign-grid").on('cellclick', function(event){
        var args = event.args;
        if(args.value != null && args.datafield == 'cost_element')
        {
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = args.value;
            param.push(item);
            load_content_ajax(GetCurrentController(), 'view_detail_cost_element' , {}, param, true);
        }
        //alert(args.value);
    });


    
});
function ValidateData(){
    
    //alert('ok');
    //return false;
    var data_post = {};
    var param = [];
    var item = {};
    item['paramName'] = 'id';
    item['paramValue'] = <?php echo $data_edit[0]['id_work_order'] ?>;
    param.push(item);        
    data_post['id_work_order'] = <?php echo $data_edit[0]['id_work_order'] ?>;
    load_content_ajax(GetCurrentController(), 399, data_post, param);
    e.preventDefault();
       
}
function SaveData()
{
    var data_post = {};
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_work_order'] = $("#id_work_order").val();
    data_post['contract_startdate'] = formatDate($("#contract_startdate").val());
    data_post['contract_expdate'] = formatDate($("#contract_expdate").val());
    data_post['project_name'] = $("#project_name").val();
    
    load_content_ajax(GetCurrentController(), 'save_edit_work_order', data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 'view_work_order', null);
}
function InitFunction()
{
    var mode = $("#console-mode").val();
    if(mode == "sync_fingerprint")
    {
        var i=0;
        var dataSO = $("#fingerprint-assign-grid").jqxGrid('getrows');
        var param = {};
        param['employee_assign'] = dataSO;
        //ConsoleWriteLine(JSON.stringify(dataSO));
        var dataDevice = $("#fingerprint-device-grid").jqxGrid('getrows');
        for(i=0;i<dataDevice.length;i++)
        {
            //ConsoleWriteLine(JSON.stringify(dataDevice[i]));
            param["serial_number"] = dataDevice[i].serial_number;
            emitCommand(dataDevice[i].app_id, dataDevice[i].serial_number, 'register_user_bulk', param);
            //ConsoleWriteLine("");
        }
    }
    else if(mode == "enroll_fingerprint")
    {
        ConsoleWriteLine($("#appid-enroll").val() + " will be used to enroll fingerprint on device " + $("#devid-enroll").val());
        emitCommand($("#appid-enroll").val(),$("#devid-enroll").val(),"enroll_fingerprint", "{'employee_number': '"+ $("#employee-number-enroll").val() +"', 'id_employee' : '"+ $("#id-employee-enroll").val() +"', 'full_name' : '"+ $("#employee-name-enroll").val() +"', 'serial_number' : '"+ $("#devid-enroll").val() +"'}");
    }
}

function init_dataadapter_sofp()
{
    var urlSOFP = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_work_order_so_assignment_fp?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceSOFP =
    {
        datatype: "json",
        datafields:
        [

            { name: 'id_so_assignment'},
            { name: 'so_assignment_number'},
            { name: 'full_name'},
            { name: 'employee_number'},
            { name: 'fingerprint_template'},
            { name: 'structure_name'},
            { name: 'level_posisi'},
            { name: 'fingerprint_tmp'},
            { name: 'fp_status'},
            { name: 'fingerprint_assign_status'}
        ],
        id: 'id_so_assignmnent',
        url: urlSOFP ,
        root: 'data'
    };
    var dataAdapterSOFP = new $.jqx.dataAdapter(sourceSOFP);
    
    return dataAdapterSOFP;
}

function RefreshEmployeeAssignGrid()
{
    $('#fingerprint-assign-grid').jqxGrid('refreshdata');
    $('#fingerprint-assign-grid').jqxGrid('refresh');
    var dataAdapter = init_dataadapter_sofp();
    $('#fingerprint-assign-grid').jqxGrid({source: dataAdapter});
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_work_order" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_work_order'] : '') ?>" />
<input type="hidden" id="appid-enroll" value="" />
<input type="hidden" id="devid-enroll" value="" />
<input type="hidden" id="employee-number-enroll" value="" />
<input type="hidden" id="id-employee-enroll" value="" />
<input type="hidden" id="employee-name-enroll" value="" />
<div class="document-action">
<input type="hidden" id="console-mode" value="" />
    <button id="wo_validate">Validate</button>
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
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'running' ? 'class="status-active"' : '') ?>>
            <span class="label">Running</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'withdrawn' ? 'class="status-active"' : '') ?>>
            <span class="label">Withdrawn</span>
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
    <div><h1 style="font-size: 18pt; font-weight: bold;">Work Order / <span><?php echo (isset($is_edit) ? $data_edit[0]['work_order_number'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="work-order-date" style="display: inline-block;"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                           Expected Delivery Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="delivery-date" style="display: inline-block;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            SO Ref.
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="so-number" name="so_number" value="<?php echo (isset($is_edit) ? $data_edit[0]['so_number'] : '') ?>" readonly="readonly"/>
                            <input name="so" type="hidden" value="<?php echo (isset($is_edit) ? $data_edit[0]['so'] : '') ?>"/>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Customer
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-name" name="customer_name" value="<?php echo (isset($is_edit) ? $data_edit[0]['customer_name'] : '') ?>" readonly="readonly"/>
                            <input name="customer" type="hidden" value="<?php echo (isset($is_edit) ? $data_edit[0]['customer'] : '') ?>"/>
                        </div>
                    </td>
                </tr>                
            </table>
            <div id='work-order-tabs' style="margin-top: 20px;">
                <ul>
                    <li>Product & Services</li>
                    <li>Survey / Assessment</li>
                    <li>Contract</li>
                    <li>Purchase Requirement</li>    
                    <li>Working Schedule</li>
                    <!--<li>Salary Setting</li>-->
                    <li>Cost Element</li>
                    <li>SO Assignment</li>
                    <li>Time Schedulling</li>
                    <li>Shift Rotation</li>
                    <li>Fingerprint Device</li>                    
                    <li>List Area</li>
                    <li>Area Rotation</li>
                </ul>
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                        <td>Project Name
                        </td>
                            <td colspan="3">
                            
                                 <input style="display:inline; width: 95%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="project_name" name="project_name" value="<?php echo (isset($is_edit) ? $data_edit[0]['project_name'] : '') ?>"/>
                             </td>
                            
                        </tr>
                        <tr>
                        <td>Start Project
                        </td>
                            <td>
                            <div id="contract_startdate" style="display: inline-block;"></div>
                                 
                             </td>
                             <td>
                               End Project
                             </td>
                             <td >
                             <div id="contract_expdate" style="display: inline-block;"></div>
                            </td>
                        </tr>
                         <tr>
                            <td colspan="4">
                                <div id="work-order-grid"></div>
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
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div id="survey-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
					<div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add-contract">+</button>
                        <button style="width: 30px;" id="remove-contract">-</button>
                        <button style="width: 60px;" id="save-contract">Save</button>
                    </div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="contract-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div> 
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div id="procurement-requirement-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>  
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">                       
                                 <div class="row-color" style="width: 100%;">
                                    <span>Working Schedule</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="working-schedule-grid"></div>
                            </td>
                        </tr>
                        
                    </table>
                </div> 
                <!--<div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_salary_setting">+</button>
                        <button style="width: 30px;" id="remove_salary_setting">-</button>
                        <button style="width: 60px;" id="save_salary_setting">save</button>
                        <input type="hidden" value="0" id="txt_hidden_salary_setting" />
                    </div>
                                 
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="salary-setting-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>-->
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div class="row-color" style="width: 100%;">
                                    <span>Detail Cost Element</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="ce-assign-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                 <div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_so_assignment">+</button>
                        <button style="width: 30px;" id="remove_so_assignment">-</button>
                        <button style="width: 60px;" id="save_so_assignment">Save</button>
                        <button style="width: 70px; float: right; margin-right: 5px;" id="unassign_so_assignment">Unassign</button>
                    </div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="so-assignment-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_time_schedulling">+</button>
                        <button style="width: 30px;" id="remove_time_schedulling">-</button>
                        <button style="width: 60px;" id="save_time_schedulling">save</button>
                    </div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="time-schedulling-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_shift_rotation">+</button>
                        <button style="width: 30px;" id="remove_shift_rotation">-</button>
                        <button style="width: 60px;" id="copy_shift_rotation">copy</button>
                        <button style="width: 60px;" id="save_shift_rotation">save</button>
                    </div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="shift_rotation_grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
		        <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td>
                                <div class="row-color">
                                    <button style="width: 30px;" id="add-fingerprint">+</button>
                                    <button style="width: 30px;" id="remove-fingerprint">-</button>
                                    <button style="width: 80px;" id="save-fingerprint">Save</button>
                                    <button style="width: 80px;" id="assign-fingerprint">Assign</button>
                                    
                                </div>
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="fingerprint-device-grid"></div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <div class="row-color" style="padding: 2px;">
                                    <span>Assign Result</span>
                                    <button style="width: 120px;" id="sync-fingerprint">Sync Data SO</button>
                                    <button style="width: 80px; float: right" id="enroll-fingerprint">Enroll</button>
                                </div>
                            </td> 
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="fingerprint-assign-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div> 
                 <div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_area_schedulling">+</button>
                        <button style="width: 30px;" id="remove_area_schedulling">-</button>
                        <button style="width: 60px;" id="save_area_schedulling">save</button>
                        
                    </div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="area-schedulling-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>   
                <div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_area_rotation">+</button>
                        <button style="width: 30px;" id="remove_area_rotation">-</button>
                        <button style="width: 60px;" id="copy_area_rotation">copy</button>
                        <button style="width: 60px;" id="save_area_rotation">save</button>
                        <button style="width: 60px;" id="detail_area_rotation">detail</button>
                    </div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="area_rotation_grid"></div>
                            </td>
                        </tr>
                    </table>
                </div> 
                                       
            </div>
        </div>
    </div>
</div>

<div id="select_structure_org_popup">
    <div>Select position</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select_structure_org_grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="select_employee_popup">
    <div>Select Employee</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select_employee_grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="select-device-popup">
    <div>Select Device</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-device-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="for-console">

</div>

<div id="select-appid-popup">
    <div>Select Device</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-appid-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>