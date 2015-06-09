<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
    $(document).ready(function(){
        $("#leave-date-from").jqxDateTimeInput({width: '250px', height: '25px', readonly: true, formatString: 'yyyy-MM-dd'});
        $("#leave-date-to").jqxDateTimeInput({width: '250px', height: '25px', readonly: true, formatString: 'yyyy-MM-dd'});

        $("#get_emp_code").on('click', function(e) { //button for employee master pop up 
            $("#select-employee-popup").jqxWindow('open');
        });
		
		$("#leave-date-form").on('change', function(){
			if($("#leave-date-to").val() == null || $("#leave-date-to").val() == '')
			{
				$("#leave-day").val(0);
			}
			else
			{
				var date_from = new Date($(this).val());
				var date_to = new Date($("#leave-date-to").val());
				var days = parseInt((date_to.getTime() - date_from.getTime()) / (24*3600*1000));
				$("#leave-day").val(days + 1);
			}
		});
		
		$("#leave-date-to").on('change', function(){
			if($("#leave-date-from").val() == null || $("#leave-date-from").val() == '')
			{
				$("#leave-day").val(0);
			}
			else
			{
				var date_to = new Date($(this).val());
				var date_from = new Date($("#leave-date-from").val());
				var days = parseInt((date_to.getTime() - date_from.getTime()) / (24*3600*1000));
				$("#leave-day").val(days + 1);
			}
		});
		
		$("#leave-validate").click(function(){
			var id = $("#id_leave_application").val();
			if(confirm('Are You Sure To Validate This Data ?')){
				$.ajax({
				url:"<?=base_url();?>leave_application/leave_validate",
				type:"post",
				datatype:"json",
				data: {id:id},
				success: function(e){
					console.log(e);  
					window.location.replace('<?php echo base_url();?>ops?menu=124&action=159');
				},
				error: function(e){
					alert(e);
				}
				});
			}
		});
		
        <?php 
            if(isset($is_edit)){
        ?>
            var sisa= "<?=($leave_caculation['leave_duration'] - $leave_count['jumlah_hari']);?>";
            $("#sisa-cuti").val(sisa);
            $("#leave-date-from").val('<?php echo $data_edit->start_date; ?>');   
            $("#leave-date-to").val('<?php echo $data_edit->end_date; ?>');   
        <?php 
        }
        ?>
        
        init_days($("#leave-date-from").val(), $("#leave-date-to").val());
		
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
                
            ///// end source master table employee/////
            
        $('#select-employee-grid').on('rowdoubleclick', function (event){
            var args = event.args;
            var data = $('#select-employee-grid').jqxGrid('getrowdata', args.rowindex);
            //console.log(data);
            //return false;
            $('#employee_id').val(data.id_employee);
            $('#employee_number').val(data.employee_number);
            $('#fullname').val(data.full_name);
            $("#employment_type").val(data.name);
                cek_cuti(data.id_employee);            
            //$('#id_security').jqxInput('val', {label: data.name, value: data.id_ext_company});
            $("#select-employee-popup").jqxWindow('close');
        });
    });
	
	function init_days(t1,t2)
	{
		var date_to = new Date(t2);
		var date_from = new Date(t1);
		var days = parseInt((date_to.getTime() - date_from.getTime()) / (24*3600*1000));
		$("#leave-day").val(days + 1);
	}
    
    function cek_cuti(id){
        $.ajax({
            url:"<?=base_url();?>leave_application/cek_cuti",
            type:"post",
            datatype:"json",
            data: {id_employee:id},
            success: function(e){
                console.log(e);
                var result=e.split('|');        
                console.log(result[0]);   
                $("#leave-duration").text(result[1]);    
                $("#jumlah-hari").text(result[0]);    
                $("#sisa-cuti").text(result[2]);    
            },
            error: function(e){
                alert(e);
            }
        });
    }
    
    function SaveData()
    {
            var sisa_cuti=eval($("#sisa-cuti").val());
            var leave_day=eval($("#leave-day").val());
            if(leave_day >= sisa_cuti){
                alert($("#sisa-cuti").val()+"-"+$("#leave-day").val());
            }else{
            var data_post = {};
            data_post['is_edit']=$("#is_edit").val();
            data_post['emloyee_id'] = $("#employee_id").val();
            data_post['leave_type'] = $("#leave-type").val();
            data_post['leave_date_from'] = $("#leave-date-from").val();
            data_post['leave_date_to'] = $("#leave-date-to").val();
            data_post['leave_day'] = $("#leave-day").val();
            data_post['notes'] = $("#notes").val();
            data_post['id'] = $("#id_leave_application").val();

			load_content_ajax(GetCurrentController(), 'save_edit_leave_application', data_post);
        }

    }
    function DiscardData()
    {
        load_content_ajax(GetCurrentController(), 159, null);
    }

</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_leave_application" value="<?php echo (isset($is_edit) ? $data_edit->id : '') ?>" />
<div class="document-action">
	<?php 
	if(isset($is_edit))
	{?>
    <button id="leave-validate">Approve Leave</button>
	<?php
	}
	?>
    <ul class="document-status">
        <li class="<?php echo ($data_edit->approval=="0" ? "status-active" : "");?>">
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li class="<?php echo ($data_edit->approval=="1" ? "status-active" : "");?>">
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
                        Employee Number<?php
						//print_r($data_edit);
						?>
                    </td>
                    <td colspan="2">
                        <input type="hidden" id="employee_id"  value="<?php echo (isset($is_edit) ? $data_employee[0]['id_employee'] : '') ?>"/>
                        <input style="display: inline; width: 83%" class="field" type="text" id="employee_number" value="<?php echo (isset($is_edit) ? $data_employee[0]['employee_number'] : '') ?>" /><button style="margin-left: 2px;" id="get_emp_code">...</button>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Full Name
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="fullname"  value="<?php echo (isset($is_edit) ? $data_employee[0]['full_name'] : '') ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Employment Type
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="employment_type"  value="<?php echo (isset($is_edit) ? $data_employee[0]['name'] : '') ?>" />
                    </td>
                </tr>
            </table>
            &nbsp;
            <table class="table-form">
                <tbody>
                <tr>
                    <td>
                        <div class="label">Type</div>
                        <div class="column-input">
                            <select id="leave-type" class="field">
                            <?php	
								
                                if(isset($is_edit)){
									switch($data_edit->leave_type){
										case "Vacation":
											$vacation="selected";
											$sick="";
											$maternity="";
										break;
										case "Sick Leave":
											$sick="selected";
											$vacation="";
											$maternity="";
										break;
										case "Maternity":
											$maternity="selected";
											$vacation="";
											$sick="";
										break;
									}
                                }else{
                                    $vacation="";
                                    $sick="";
                                    $maternity="";
                                }
                            ?>
                                <option value="Vacation" <?php echo $vacation;?> >Vacation</option>
                                <option value="Sick Leave" <?php echo $sick;?>>Sick Leave</option>
                                <option value="Maternity" <?php echo $maternity;?>>Maternity</option>
                            </ select>
                        </div>
                    </td>
					<!--
                    <td rowspan="4">
                        <div class="label">&nbsp;</div>
                        <table style="border: 1px solid #000000; width: 100%">
                            <tr style="background-color: #f5f5f5; text-align: center">
                                <td>Entitlement</td>
                                <td>B/F <?=date('Y')?></td>
                                <td>Balance Leave <?=date('Y')?></td>
                            </tr>
                            <tr style="text-align: center">
                                <td id="leave-duration"><?=(isset($is_edit) ? $leave_caculation['leave_duration'] : '');?></td>
                                <td id="jumlah-hari"><?=(isset($is_edit) ? $leave_count['jumlah_hari'] : '0');?></td>
                                <td id="sisa-cuti">
                                    <?=(isset($is_edit) ? ($leave_caculation['leave_duration'] - $leave_count['jumlah_hari']) : '0');?>
                                    <input type="hidden" id="sisa-cuti"/>
                                </td>
                            </tr>
                        </table>
                    </td>-->
                </tr>
                <tr>
                    <td>
                        <div class="label">Leave Applied From Date</div>
                        <div class="column-input">
                            <div id="leave-date-from"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Leave Applied To Date</div>
                        <div class="column-input">
                            <div id="leave-date-to"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">No. of Days Applied</div>
                        <div class="column-input">
                            <input class="field" id="leave-day" name="leave_day" type="text" value="<?php echo (isset($is_edit) ? $data_edit->total_day : '') ?>">
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="label">
                Reason
            </div>
            <textarea class="field" id="notes" cols="10" rows="20" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit->reason : '') ?></textarea>
        </div>
    </div>
</div>

<div id="select-employee-popup">
    <div>Select Employee</div>
    <div id="select-employee-grid"></div>
</div>
