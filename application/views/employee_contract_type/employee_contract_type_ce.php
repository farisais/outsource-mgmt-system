<script>
$(document).ready(function(){
    
});

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    data_post['abv'] = $("#abv").val();
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_employee_contract_type'] = $("#id_employee_contract_type").val(); 
    
    load_content_ajax(GetCurrentController(), 240, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 236 , null);
}

</script>
<style>
.table-form
{
    margin: 30px;
    width: 100%;
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
    height: 25px;
    width: calc(80% + 8px); 
    
}
 
.field:focus 
{ 
    outline: none; 
    border: 1px solid #7bc1f7; 
} 

.label
{
    font-size: 11pt;
    width: 160px;
    padding-right: 20px;
    font: -webkit-small-control;
}

.column-input
{

}


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_employee_contract_type" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_employee_contract_type'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div>
            <table class="table-form">
                <tr>
                    <td class="label">
                        Contract Type Name
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Abbreviation
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="abv" name="abbreviation" value="<?php echo (isset($is_edit) ? $data_edit[0]['abv'] : '') ?>"/>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>