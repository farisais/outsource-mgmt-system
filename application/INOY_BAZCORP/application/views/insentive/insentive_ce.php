<script>
$(document).ready(function(){
    //Combo Salary Type
     var salarytype = [
        <?php
        foreach($salarytype as $at)
        {
            echo '{ value: "'. $at['id'] .'", label: "'. $at['salary_type'] .'"},';
        }
        ?>
    ];
    
     //Combo Employee    
    $("#select_salary_type").jqxComboBox({ source: salarytype, displayMember: 'label', valueMember: 'value'});
    
    var employees = [
        <?php
        foreach($employees as $at)
        {
            echo '{ value: "'. $at['id_employee'] .'", label: "'. $at['full_name'] .'"},';
        }
        ?>
    ];
        
    $("#select_employee").jqxComboBox({ source: employees, displayMember: 'label', valueMember: 'value'});
    
     //Combo Payroll Periode    
    var payroll_periodes = [
        <?php
        foreach($payroll_periodes as $at)
        {
            echo '{ value: "'. $at['id_payroll_periode'] .'", label: "'. $at['periode_name'] .'"},';
        }
        ?>
    ];
        
    $("#select_payroll_periode").jqxComboBox({ source: payroll_periodes, displayMember: 'label', valueMember: 'value'});
});
function SaveData()
{
    var data_post = {};
    
    data_post['id'] = $("#id_insentive").val();
    data_post['select_salary_type'] = $("#select_salary_type").val();
    data_post['select_employee'] = $("#select_employee").val();
    data_post['select_payroll_periode'] = $("#select_payroll_periode").val();
    data_post['nominal'] = $("#nominal").val();
    data_post['description'] = $("#description").val();
    
    data_post['id_insentive'] = $("#id_insentive").val();
    data_post['is_edit'] = $("#is_edit").val(); 
     
    load_content_ajax(GetCurrentController(), 311, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 308 , null);
}

</script>

<style>
.table-form .label
{
    width: 80px;
}

.table-form .field
{
    width: 90%;
}
</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_insentive" value="<?php echo (isset($is_edit) ? $data_edit[0]['id'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Insentive <span><?php echo (isset($is_edit) ? $data_edit[0]['id'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td class="label">
                        Salary Type
                    </td>
                    <td colspan="2">
                        <div id="select_salary_type"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Employee
                    </td>
                    <td colspan="2">
                        <div id="select_employee"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Payroll Periode
                    </td>
                    <td colspan="2">
                        <div id="select_payroll_periode"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Nominal
                    </td>
                    <td colspan="2">
                        <input class="field" style="width: 92%;" type="text" id="nominal" value="<?php echo (isset($is_edit) ? $data_edit[0]['nominal'] : '' ) ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Description
                    </td>
                    <td colspan="2">
                        <input class="field" style="width: 92%;" type="text" id="description" value="<?php echo (isset($is_edit) ? $data_edit[0]['nominal'] : '' ) ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>