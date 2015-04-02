<script>
$(document).ready(function(){

});
function SaveData()
{
    var data_post = {};
    
    data_post['id'] = $("#id_salary_code").val();
    data_post['salary_code'] = $("#salary_code").val();
    data_post['salary_type'] = $("#salary_type").val();
    data_post['is_edit'] = $("#is_edit").val(); 
     
    load_content_ajax(GetCurrentController(), 291, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 289 , null);
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
<input type="hidden" id="id_salary_code" value="<?php echo (isset($is_edit) ? $data_edit[0]['id'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Salary Type <span><?php echo (isset($is_edit) ? $data_edit[0]['id'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                   <tr>
                        <td class="label">
                            Salary Code
                        </td>
                        <td colspan="3">
                            <input class="field" style="width: 92%;" type="text" id="salary_code" value="<?php echo (isset($is_edit) ? $data_edit[0]['salary_code'] : '' ) ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                            Salary Type
                        </td>
                        <td colspan="3">
                            <input class="field" style="width: 92%;" type="text" id="salary_type" value="<?php echo (isset($is_edit) ? $data_edit[0]['salary_type'] : '' ) ?>" />
                        </td>
                </tr>
            </table>
        </div>
    </div>
</div>