<script>
$(document).ready(function(){
    // Popup modal
    $("#jqxNotification").jqxNotification({ width: 300, position: "bottom-left",
        opacity: 0.9, autoOpen: false, autoClose: true, template: "warning"
    });
    // Inisiasi Grid Employee
    var url_employee = "<?php echo base_url() ;?>timesheet/get_employee";
    var source_select_employee =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_employee'},
            { name: 'full_name'}
        ],
        id: 'id_employee',
        url: url_employee ,
        root: 'data'
    };
    var dataAdapter_select_employee = new $.jqx.dataAdapter(source_select_employee);
    
    $("#select-employee-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_employee,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Employee Number', dataField: 'id_employee', width: 150},
            { text: 'Name', dataField: 'full_name', width: 250}                              
        ]
    });
    
    //Inisiasi Form untuk input employee
    $("#select-employee-popup").jqxWindow({
        width: 600, height: 300, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
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
        
    $("#select-workorder").jqxComboBox({ source: workorders, displayMember: 'label', valueMember: 'value'});
    
    <?php if(isset($is_edit)){?>       
    var url = "<?php echo base_url()?>timesheet/get_detail_employee_on_edit?id=<?php echo $data_edit[0]['id']; ?>"; 
    $("#select-workorder").jqxComboBox('val', '<?php echo $data_edit[0]['work_order_id']; ?>');
    $("#input-date").jqxDateTimeInput('val', <?php echo "'" . date('m/d/Y', strtotime($data_edit[0]['date'])) . "'"; ?>);
        
    <?php 
        }else{
    ?>       
     var url='';
    <?php         
        }
    ?>
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
        rendertoolbar: function (toolbar) {
            $("#add-employee").click(function(){
                var offset = $("#remove-employee").offset();
                $("#select-employee-popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-employee").width() + 20, y: parseInt(offset.top)} });
                $("#select-employee-popup").jqxWindow('open');
            });
            $("#remove-employee").click(function(){
                var selectedrowindex = $("#employee-so-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#employee-so-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#employee-so-grid").jqxGrid('deleterow', id);
                }
            });
        },
        columns: [
            { text: 'Employee Number', dataField: 'id_employee', width: 140},
            { text: 'Full Name', dataField: 'full_name'},
            { text: 'In', dataField: 'in', cellsformat: 't', width: 100}, 
            { text: 'Out', dataField: 'out',cellsformat: 't', width: 100},
          
        ]
    });
    $('#select-employee-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-employee-grid').jqxGrid('getrowdata', args.rowindex);
        //data['qty_request'] = 0;
        //data['qty_deliver'] = 0;
        //data['remark'] = '';
        var commit0 = $("#employee-so-grid").jqxGrid('addrow', null, data);
        $("#select-employee-popup").jqxWindow('close');
    });
});

function SaveData()
{   
    var data_post = {};
    data_post['employee_detail'] = $('#employee-so-grid').jqxGrid('getrows');
    data_post['input-date'] = $("#input-date").val('date').format('yyyy-mm-dd');
    data_post['project_name'] = $("#select-workorder").val();
    data_post['id_timesheet_group'] = $("#id_timesheet_group").val();
    data_post['is_edit'] = $("#is_edit").val();
    
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
            	    load_content_ajax(GetCurrentController(), 296, data_post);
                }else{
                    $("#jqxNotification").jqxNotification('open');
                    return false;
                }
                
		}
   	});
    
     <?php 
        }
    ?>    
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
                    <td>
                        <div class="label">
                           
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="quote-date" style="display: inline-block;"></div>
                        </div>
                    </td>
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
                    <td>

                    </td>
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
            
            <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">                       
                                 <div class="row-color" style="width: 100%;">
                                    <button style="width: 30px;" id="add-employee">+</button>
                                    <button style="width: 30px;" id="remove-employee">-</button>
                                    <div style="display: inline;"><span>Add / Remove Employee</span></div>
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

<div id="select-employee-popup">
    <div>Select Employee</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-employee-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="jqxNotification">
        Data Date Exist!
</div>
