<script>
$(document).ready(function(){
     $("#error-notification").jqxNotification({
        width: 250, position: "top-right", opacity: 0.9,
        autoOpen: false, animationOpenDelay: 800, autoClose: true, autoCloseDelay: 3000, template: "error"
    });
});

function SaveData()
{
    var data_post = {};
    data_post['user_name'] = $("#user_name").val();
    data_post['full_name'] = $("#full_name").val();
    data_post['email'] = $("#email").val();
    data_post['role'] = $("#role").val();
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_user'] = $("#id_user").val();
    
    if($("#is_edit").val() == 'true')
    {
        load_content_ajax(GetCurrentController(), 66, data_post);
    }
    else
    {
         if($("#password").val() == $("#password-confirmation").val() && $("#password").val() != '' && $("#password").val() != null)
        {
            data_post['password'] = $("#password").val();
            load_content_ajax(GetCurrentController(), 66, data_post);
        }
         else
        {
            $("#error-notification").html("Password is not match");
            $("#error-notification").jqxNotification("open");
        }
    }
   
   
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 62 , null);
}

</script>
<script>
$(document).ready(function(){
     
});
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
<input type="hidden" id="id_user" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_user'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div>
            <form>
                <table class="table-form">
                    <tr>
                        <td class="label">
                            User Name
                        </td>
                        <td class="column-input">
                            <input class="field" type="text" id="user_name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['user_name'] : '') ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                            Full Name
                        </td>
                        <td class="column-input">
                            <input class="field" type="text" id="full_name" name="full_name" value="<?php echo (isset($is_edit) ? $data_edit[0]['full_name'] : '') ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                            Email
                        </td>
                        <td class="column-input">
                            <input class="field" type="text" id="email" name="email" value="<?php echo (isset($is_edit) ? $data_edit[0]['email'] : '') ?>"/>
                        </td>
                    </tr>
                     <?php 
                    if(!isset($is_edit))
                    {
                    ?>
                    <tr>
                        <td class="label">
                            Password
                        </td>
                        <td class="column-input">
                            <input class="field" type="password" id="password" name="full_name" value="<?php echo (isset($is_edit) ? $data_edit[0]['password'] : '') ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                            Confirm Password
                        </td>
                        <td class="column-input">
                            <input class="field" type="password" id="password-confirmation" name="full_name" value="<?php echo (isset($is_edit) ? $data_edit[0]['password'] : '') ?>"/>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td class="label">
                            Role
                        </td>
                        <td class="column-input">
                            <select class="field" id="role">
                                <option value=""></option>
                                <?php
                                foreach($role_list as $role)
                                {?>
                                <option value="<?php echo $role['id_role'] ?>"  <?php echo (isset($is_edit) && $data_edit[0]['role'] == $role['id_role'] ? "selected='selected'" : ""); ?>><?php echo $role['name'] ?></option>    
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div id="error-notification" style="margin-top: 40px;">
    <div>
       
    </div>
</div>