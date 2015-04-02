<script>
$(document).ready(function(){
    var sourceData = [
    {name: 'String', value: 'string'},
    {name: 'Password', value: 'password'},
    {name: 'Number', value: 'number'},
    {name: 'Boolean', value: 'bool'},
    {name: 'JSON', value: 'json'},
    ];
    
    $('#datatype-select').jqxDropDownList({
        filterable: true, selectedIndex: 0, source: sourceData, displayMember: "name", valueMember: "value", width: 200, height: 25, 
        <?php if(isset($is_edit) && $data_edit[0]['data_type'] == 'password')
        {?>
        disabled: true
        <?php 
        }
        ?>
    });  
    <?php
    if(isset($is_edit))
    {?>
     $('#datatype-select').jqxDropDownList('val', '<?php echo $data_edit[0]['data_type']?>');
        if($('#datatype-select').val() == 'password')
        {
            $("#value").attr('type', 'password');
        }
        else
        {
            $("#value").attr('type', 'text');
        }
    <?php
    }
    ?>
    
    $('#datatype-select').on('change', function(){
       if($(this).val() == 'password')
       {
            $("#value").attr('type', 'password');
       }
       else
       {
            $("#value").attr('type', 'text');
       }
    });
    
});

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    data_post['data_type'] = $("#datatype-select").val();
    data_post['value'] = $("#value").val();
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_config'] = $("#id_config").val(); 
    
    load_content_ajax(GetCurrentController(), 'save_edit_configuration_parameter', data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 'view_configuration_parameter' , null);
}

</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_config" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_config'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">App Config / <span><?php echo (isset($is_edit) ? $data_edit[0]['id_config'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td class="label">
                        Name
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Data Type
                    </td>
                    <td class="column-input">
                        <div id="datatype-select"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Value
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="value" name="function_exec" value="<?php echo (isset($is_edit) ? $data_edit[0]['value'] : '') ?>"/>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>