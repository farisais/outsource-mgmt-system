<script>
function render_grid_employee(value){
    var url = "<?php echo base_url() ;?>timesheet/get_employee/"+value;    
     var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id'},
            { name: 'employee_number'},
            { name: 'id_employee'},
            { name: 'date'},
            { name: 'in'},
            { name: 'out'},
            { name: 'time_input'},
            { name: 'input_by'},
            { name: 'status_absen'},
            { name: 'overtime'},
            { name: 'full_name'},
            { name: 'nama_supervisor'}
        ],
        id: 'id',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#employee-so-grid").jqxGrid(
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
        
        columns: [
            { text: 'Employee Number', dataField: 'id_employee', width: 140},
            { text: 'Full Name', dataField: 'full_name'},
            { text: 'In', dataField: 'in', cellsformat: 't', width: 100}, 
            { text: 'Out', dataField: 'out',cellsformat: 't', width: 100},
          
        ]
    });
    
}
$(document).ready(function(){
     // Popup modal
    $("#jqxNotification").jqxNotification({ width: 300, position: "bottom-left",
        opacity: 0.9, autoOpen: false, autoClose: true, template: "warning"
    });
    
    //Inisiasi Datetime Input
    $("#input-date").jqxDateTimeInput({width: '250px', height: '25px'}); 
      
    //GET PROJECT NAME From Table Work Order
     var workorders = [
        <?php
        foreach($work_orders as $at)
        {
            echo '{ value: "'. $at['id_work_order'] .'", label: "'. $at['project_name'] .'"},';
        }
        ?>
    ];
        
    $("#select-workorder").jqxComboBox({ source: workorders, displayMember: 'label', valueMember: 'value'<?php if(isset($is_edit)){echo ',disabled:true';} ?>});
   
        
    
    <?php if(isset($is_edit)){?>       
    var url = "<?php echo base_url()?>timesheet/get_detail_employee_on_edit?id=<?php echo $data_edit[0]['id']; ?>"; 
    $("#select-workorder").jqxComboBox('val', '<?php echo $data_edit[0]['work_order_id']; ?>');
    $("#input-date").jqxDateTimeInput('val', <?php echo "'" . date('m/d/Y', strtotime($data_edit[0]['date'])) . "'"; ?>);
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id'},
            { name: 'employee_number'},
            { name: 'id_employee'},
            { name: 'date'},
            { name: 'in'},
            { name: 'out'},
            { name: 'time_input'},
            { name: 'input_by'},
            { name: 'status_absen'},
            { name: 'overtime'},
            { name: 'full_name'},
            { name: 'nama_supervisor'},
            { name: 'timesheet_group_id'},
            { name: 'input_by'},
            { name: 'output_by'},
            { name: 'input_by'},
            { name: 'late_in' },
            { name: 'early_out' }
        ],
        id: 'id',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#employee-so-grid").jqxGrid(
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
        
        columns: [
            { text: 'Employee Number', dataField: 'id_employee', width: 140},
            { text: 'Full Name', dataField: 'full_name'},
            { text: 'In', dataField: 'in', cellsformat: 't', width: 100}, 
            { text: 'Out', dataField: 'out',cellsformat: 't', width: 100},
            
        ]
    });
     $("#employee-so-grid").jqxGrid('setcolumnproperty', 'id_employee', 'editable', false);
    $("#employee-so-grid").jqxGrid('setcolumnproperty', 'full_name', 'editable', false);
    <?php 
        }else{
    ?>       
     var url='';
     $('#select-workorder').on('select', function (event) {
       var args = event.args;
       if (args) {
            
           // index represents the item's index.                          
           var index = args.index;
           var item = args.item;
           // get item's label and value.
           //var label = item.label;
           var value = item.value;
           render_grid_employee(value);
           //alert("label: " + value);
       }
   }); 
   $("#employee-so-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 250,
        selectionmode : 'singlerow',
      
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        
        columns: [
            { text: 'Employee Number', dataField: 'id_employee', width: 140},
            { text: 'Full Name', dataField: 'full_name'},
            { text: 'In', dataField: 'in', cellsformat: 't', width: 100}, 
            { text: 'Out', dataField: 'out',cellsformat: 't', width: 100},

            
        ]
    });
    $("#employee-so-grid").jqxGrid('setcolumnproperty', 'id_employee', 'editable', false);
    $("#employee-so-grid").jqxGrid('setcolumnproperty', 'full_name', 'editable', false);
    <?php         
        }
    ?>
    
});

function SaveData()
{   
    var data_post = {};
    data_post['employee_detail'] = $('#employee-so-grid').jqxGrid('getrows');
    data_post['input-date'] = $("#input-date").val('date').format('yyyy-mm-dd');
    data_post['project_name'] = $("#select-workorder").val();
    data_post['id_timesheet_group'] = $("#id_timesheet_group").val();
    data_post['is_edit'] = $("#is_edit").val();
    //alert(JSON.stringify(data_post));
    //console.log(data_post);
    //return false;
     <?php if(!isset($is_edit)){?>       
       
   
    $.ajax({
		url: 'timesheet/cek_master_timesheet',
		type: "POST",
		data: 'date='+data_post['input-date']+'&work_order='+data_post['project_name'],
        dataType:'json',
		success:function(result){
               	if (result.success==true){
            	    load_content_ajax(GetCurrentController(), 355, data_post);
                }else{
                    $("#jqxNotification").jqxNotification('open');
                    return false;
                }
                
		}
   	});
    
     <?php 
        }
    ?>  
    load_content_ajax(GetCurrentController(), 355, data_post);  
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 164 , null);
}

</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_timesheet_group" value="<?php echo (isset($is_edit) ? $data_edit[0]['id'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;"><?php echo (isset($is_edit) ? 'Timesheet <span>'.$data_edit[0]['date'] : ''); ?></span></h1></div>
        <div>
           <table class="table-form">
                <tr>
                    <!--<td>
                        <div class="label">
                           
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="quote-date" style="display: inline-block;"></div>
                        </div>
                    </td>-->
                    <td>
                        <div class="label">
                            Project Name
                        </div>
                        <div class="column-input" colspan="2">
                            
                            <div id="select-workorder"></div>
                            
                        </div>
                    </td>
                </tr>
                <tr>
                    <!--<td>

                    </td>-->
                    <td>
                        <div class="label">
                            Date Input
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="input-date" style="display: inline-block;"></div>
                        </div>                        
                    </td>
                </tr>                
            </table>
            
            <table class="table-form" style="width: 90%;">
                <tr>
                    <td colspan="3">                       
                         <div class="row-color" style="width: 100%;padding-top:4px;padding-left: 5px;height: 20px;">
                            <span>Detail Timesheet</span>
                        </div>
                    </td>
                </tr>
                        <tr>
                            <td colspan="2">
                                <div id="employee-so-grid"></div>
                            </td>
                        </tr>
                        <tr>
                    <td>
                    </td>
                    <td>
                      
                    </td>
                </tr>
                                         
                    </table>
        </div>
    </div>
</div>

<div id="jqxNotification">
        Data Date Exist!
</div>
