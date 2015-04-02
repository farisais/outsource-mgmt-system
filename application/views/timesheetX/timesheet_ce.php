<script>
$(document).ready(function(){
    $("#assign-so-popup").jqxWindow({
        width: 750, height: 500, resizable: true,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#work-start-hour").jqxNumberInput({ width: '50px', height: '25px', spinButtons: true, decimalDigits: 0, max: 23, digits:2 });
    $("#work-end-hour").jqxNumberInput({ width: '50px', height: '25px', spinButtons: true, decimalDigits: 0, max: 23, digits:2 });
    $("#work-start-minutes").jqxNumberInput({ width: '50px', height: '25px', spinButtons: true, decimalDigits: 0, max: 59, digits:2 });
    $("#work-end-minutes").jqxNumberInput({ width: '50px', height: '25px', spinButtons: true, decimalDigits: 0, max: 59, digits:2 });

    
    
    //=================================================================================
    //
    //   SO Grid
    //
    //=================================================================================
    
    $("#so-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        height: 200,
        selectionmode : 'singlerow',
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
          { text: 'Contract', datafield: 'contract_number', width: 150},
          { text: 'Sales Order', datafield: 'id_so', displayfield: 'so_number', width: 100},
          { text: 'Customer', datafield: 'customer', displayfield: 'customer_name', width: 200},
          { text: 'Period Start', datafield: 'period_start', width: 100},
          { text: 'Period End', datafield: 'period_end', width: 100}
        ]
    });
});

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    data_post['action_detail'] = $('#action-assigned-grid').jqxGrid('getrows');
    
    //load_content_ajax(GetCurrentController(), 20, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 109 , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_work_schedule" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_work_schedule'] : '') ?>" />
<div class="document-action">
    <button id="so-assign-button">Apply</button>
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
            <span class="label">Available</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'open' ? 'class="status-active"' : '') ?>>
            <span class="label">Waiting Assignment</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'close' ? 'class="status-active"' : '') ?>>
            <span class="label">Assigned</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;">Timesheet / <span><?php echo (isset($is_edit) ? $data_edit[0]['po_number'] : date('ymd')); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td rowspan="4">
                        <div>
                            <img class="image-field" style="width: 100px;" src="<?php echo base_url() . 'images/user-icon.png' ?>" alt="product-default"/>
                        </div>
                    </td>
                    <td class="label">
                        Date
                    </td>
                    <td colspan="2">
                        <div id="date"></div>
                    </td>
                    <td>
                    
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Employee ID
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                </tr>
                <tr>
                     <td class="label">
                        Full Name
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Employment Type
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                </tr>
                
                <!-- Unsplitted form-->
                <tr>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row-color" style="width: 100%; padding: 3px;">
                            <span>Personal Detail</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Customer
                    </td>
                     <td colspan="3">
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                </tr>  
                <tr>
                    <td class="label">
                        Site
                    </td>
                     <td>
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                     <td class="label second-column">
                        Area
                    </td>
                     <td >
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                </tr>   
                <tr>
                    <td class="label">
                        Position
                    </td>
                     <td>
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                     <td class="label second-column">
                        Level
                    </td>
                     <td >
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                </tr> 
                <tr>
                    <td colspan="4">
                        <div class="row-color" style="width: 100%; padding: 3px;">
                            <span>Timesheet Detail</span>
                        </div>
                    </td>
                </tr>          
                <tr>
                    <td class="label">
                        Work Start (Hour : Minutes)
                    </td>
                     <td>
                        <div id="work-start-hour" style="display: inline;float:left"></div><div id="work-start-minutes" style="display: inline;float:left;margin-left:10px"></div>
                    </td>
                     <td class="label second-column">
                        Work End (Hour : Minutes)
                    </td>
                     <td>
                        <div id="work-end-hour" style="display: inline;float:left"></div><div id="work-end-minutes" style="display: inline;float:left;margin-left:10px"></div>
                    </td>
                </tr> 
                <tr>
                    <td style="width: 50%;padding-top: 20px;" colspan="4">
                        <div class="label">
                            Notes
                        </div>
                        <textarea class="field" cols="10" rows="20" style="height: 50px;"></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div id="assign-so-popup">
    <div>Assign SO</div>
    <div>
        <table class="table-form">           
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="so-grid">
                    </div>
                </td>
            </tr>
        </table>
    </div>         
</div>