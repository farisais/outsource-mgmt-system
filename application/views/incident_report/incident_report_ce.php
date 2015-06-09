<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
    $(document).ready(function(){
        $("#datetime-incident").jqxDateTimeInput({ width: '300px', height: '25px',  formatString: 'yyyy-MM-dd HH:mm:ss' });
        $("#show_emloyee").click(function() { //button for employee master pop up 
            $("#select-employee-popup").jqxWindow('open');
        });
        $("#get_emp_code").click(function() { //button for employee master pop up 
            $("#select-employee-popup2").jqxWindow('open');
        });
        ///// source master table employee/////
        var urlsecurity = "<?php echo base_url(); ?>leave_application/get_employee_list";
        var sourcesecurity =
            {
                datatype: "json",
                datafields:
                        [
                            {name: 'id_employee'},
                            {name: 'employee_number'},
                            {name: 'full_name'},
                            {name: 'name'}
                        ],
                id: 'id_employee',
                url: urlsecurity,
                root: 'data'
            };
        var dataAdaptersecurity = new $.jqx.dataAdapter(sourcesecurity);

        $("#select-employee-popup").jqxWindow({
            width: 600, height: 500, resizable: false, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
        });
        $("#select-employee-popup2").jqxWindow({
            width: 600, height: 500, resizable: false, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
        });

        $("#select-employee-grid").jqxGrid(
                {
                    theme: $("#theme").val(),
                    width: '100%',
                    height: 400,
                    selectionmode: 'singlerow',
                    source: dataAdaptersecurity,
                    columnsresize: true,
                    autoshowloadelement: false,
                    sortable: true,
                    filterable: true,
                    showfilterrow: true,
                    autoshowfiltericon: true,
                    columns: [
                        {text: 'Employee Number', dataField: 'employee_number', width: 150},
                        {text: 'Name', dataField: 'full_name'},
                        {text: 'Employment Type', dataField: 'name'}
                    ]
                });
                
                $("#select-employee-grid2").jqxGrid(
                {
                    theme: $("#theme").val(),
                    width: '100%',
                    height: 400,
                    selectionmode: 'singlerow',
                    source: dataAdaptersecurity,
                    columnsresize: true,
                    autoshowloadelement: false,
                    sortable: true,
                    filterable: true,
                    showfilterrow: true,
                    autoshowfiltericon: true,
                    columns: [
                        {text: 'Employee Number', dataField: 'employee_number', width: 150},
                        {text: 'Name', dataField: 'full_name'},
                        {text: 'Employment Type', dataField: 'name'}
                    ]
                });
                $('#select-employee-grid2').on('rowdoubleclick', function (event){
                    var args = event.args;
                    var data = $('#select-employee-grid').jqxGrid('getrowdata', args.rowindex);
                    //console.log(data);
                    //return false;
                    $('#employee_id').val(data.id_employee);
                    $('#employee_number').val(data.employee_number);
                    $('#fullname').val(data.full_name);
                    $("#employment_type").val(data.name);     
                    //$('#id_security').jqxInput('val', {label: data.name, value: data.id_ext_company});
                    $("#select-employee-popup2").jqxWindow('close');
                });
            ///// end source master table employee/////
  
        <?php if(isset($is_edit)){?>
            $("#datetime-incident").val('<?php echo $data_edit[0]['incident_time'];?>');
            var url = "<?php echo base_url() ;?>incident_report/get_incident_report_thirdparty/<?=$data_edit[0]['id'];?>";
        <?php 
		}
		else
		{ 
		?>
            var url = "";
		<?php 
		} ?>
		var source =
			{
				datatype: "json",
				datafields:
					[
						{ name: 'id_employee'},
						{ name: 'employee_number'},
						{ name: 'full_name'},
						{ name: 'name'}
					],
				id: 'id_employee',
				url: url,
				root: 'data'
			};
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#jqxgrid").jqxGrid(
			{
				theme: $("#theme").val(),
				width: '100%',
				height: 450,
				source: dataAdapter,
				groupable: true,
				columnsresize: true,
				autoshowloadelement: false,
				filterable: true,
				showfilterrow: true,
				sortable: true,
				autoshowfiltericon: true,
				columns: [
					{ text: 'Employee Number', dataField: 'employee_number', width: 150},
					{ text: 'Employee Name', dataField: 'full_name'},
					{ text: 'Level', dataField: 'name'}
				]
			});
			
		$('#select-employee-grid').on('rowdoubleclick', function (event){
			var args = event.args;
			var data = $('#select-employee-grid').jqxGrid('getrowdata', args.rowindex);
			data['structure_name'] = data['name'];
			$("#jqxgrid").jqxGrid('addrow', null, data);
			$("#select-employee-popup").jqxWindow('close');
		});
		
		$("#delete_emloyee").click(function(){
			var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
				if(row != null){
					if(confirm("Are you sure you want to delete recruitment : " + row.full_name)){
						$.ajax({
						url:"<?=base_url();?>incident_report/delete_temp",
						type:"post",
						datatype:"json",
						data: {id_employee:row.id},
						success: function(e){
							console.log(e);
							$("#jqxgrid").jqxGrid('updatebounddata');
							$("#select-employee-popup").jqxWindow('close'); 
						},
						error: function(e){
							alert(e);
						}
					});
					}
				}
				else
				{
					alert('Select recruitment you want to delete first');
				}         
		});                        
    });
    
    function SaveData()
    {
            
            var data_post = {};
            data_post['is_edit']=$("#is_edit").val();
            data_post['id']=$("#id_incident").val();
            data_post['emloyee_id'] = $("#employee_id").val();
            data_post['location'] = $("#location").val();
            data_post['datetime_incident'] = $("#datetime-incident").val();
            data_post['chronology'] = $("#chronology").val();
            data_post['efect_cause'] = $("#efect-cause").val();
            data_post['action_taken'] = $("#action-taken").val();
            data_post['recomendation'] = $("#recomendation").val();
			data_post['third_party'] = $("#jqxgrid").jqxGrid('getrows');
			alert(JSON.stringify(data_post));
        load_content_ajax(GetCurrentController(), 178, data_post);


    }
    function DiscardData()
    {
        load_content_ajax(GetCurrentController(), 174, null);
    }

</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_incident" value="<?php echo (isset($is_edit) ? $data_edit[0]['id'] : '') ?>" />
<div class="document-action">
    <ul class="document-status">
        <li class="status-active">
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li>
            <span class="label">Approved</span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <table class="table-form">
                <tr>
                    <td rowspan="4">
                        <div>
                            <img class="image-field" style="width: 100px;" src="<?php echo base_url() . 'images/user-icon.png' ?>" alt="product-default"/>
                        </div>
                    </td>
                    <td class="label">
                        Employee Number
                    </td>
                    <td colspan="2">
                        <input type="hidden" id="employee_id"   value="<?php echo (isset($is_edit) ? $data_edit[0]['employee_id'] : '') ?>"/>
                        <input readonly="true" style="display: inline; width: 83%" class="field" type="text" id="employee_number"  value="<?php echo (isset($is_edit) ? $data_edit[0]['employee_number'] : '') ?>" /><button style="margin-left: 2px;" id="get_emp_code">...</button>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Full Name
                    </td>
                    <td colspan="2">
                        <input readonly="true" style="display: inline;" class="field" type="text" id="fullname"  value="<?php echo (isset($is_edit) ? $data_edit[0]['full_name'] : '') ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Employment Type
                    </td>
                    <td colspan="2">
                        <input readonly="true" style="display: inline;" class="field" type="text" id="employment_type"  value="<?php echo (isset($is_edit) ? $data_edit[0]['employement_name'] : '') ?>" />
                    </td>
                </tr>
            </table>
            &nbsp;
            <table class="table-form">
                <tbody>
                <tr>
                    <td>
                        <div class="label">Location</div>
                        <div class="column-input">
                            <input class="field" id="location" name="location" type="text" value="<?php echo (isset($is_edit) ? $data_edit[0]['location'] : '') ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Date Time Incident</div>
                        <div class="column-input">
                            <div id="datetime-incident"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Chronology</div>
                        <div class="column-input">
                            <textarea class="field" id="chronology" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['chronology'] : '') ?></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Efect Cause</div>
                        <div class="column-input">
                            <textarea class="field" id="efect-cause" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['effect_caused'] : '') ?></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Action Taken</div>
                        <div class="column-input">
                            <textarea class="field" id="action-taken" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['action_taken'] : '') ?></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Recomendation</div>
                        <div class="column-input">
                            <textarea class="field" id="recomendation" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['recomendation'] : '') ?></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Related Party</div>
                        <div style="margin: 5px;"><button id="show_emloyee">Add</button> <button id="delete_emloyee">Delete</button></div>                        
                        <div id="jqxgrid"></div>
                    </td>
                </tr> 
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="select-employee-popup">
    <div>Select Employee</div>
    <div id="select-employee-grid"></div>
</div>
<div id="select-employee-popup2">
    <div>Select Employee</div>
    <div id="select-employee-grid2"></div>
</div>
