<script>
$(document).ready(function(){
    
    $("#type").change(function(){
        if($(this).val() == 'top-menu')
        {
            $("#parent").parent().parent().css("display", "none");
        }
        else
        {
            $("#parent").parent().parent().css("display", "");
        }                                         
    }); 
    
    var url = "<?php echo base_url();?>action/get_action_list";
    // prepare the data
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_application_action', type : 'int'}, 
            { name: 'name'}
        ],
        id: 'id_application_action',
        url: url,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $('#action-bind').jqxDropDownList({
        filterable: true, selectedIndex: 0, source: dataAdapter, displayMember: "name", valueMember: "id_application_action", width: 200, height: 25
    });    
    
    $("#action-bind").on('bindingComplete', function (event) { 
        <?php
        if(isset($is_edit))
        {
            if($side_menu_edit[0]['action'] != '' && $side_menu_edit[0]['action'] != null)
            {
        ?>
                $("#action-bind").jqxDropDownList('val', <?php echo $side_menu_edit[0]['action'] ?>);
        <?php
            }
        }
        ?>
    });   
});

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    data_post['type'] = $("#type").val();
    if(data_post['type'] != 'top-menu')
    {
        data_post['parent'] = $("#parent").val();
    }
    data_post['division'] = $("#division").val();
    data_post['controller'] = $("#controller-bind").val();
    data_post['action_bind'] = $("#action-bind").val();
    data_post['index'] = $("#index").val();
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_menu'] = $("#id_menu").val(); 
    
    load_content_ajax(GetCurrentController(), 9, data_post);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 5 , null);
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
    height: 26px;
}
 
.field:focus 
{ 
    outline: none; 
    border: 1px solid #7bc1f7; 
} 

.label
{
    font-size: 11pt;
    width: 50px;
    padding-right: 20px;
    font: -webkit-small-control;
}


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_menu" value="<?php echo (isset($is_edit) ? $side_menu_edit[0]['id_application_menu'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div>
            <table class="table-form">
                <tr>
                    <td class="label">
                        Name
                    </td>
                    <td>
                        <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $side_menu_edit[0]['name'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Type
                    </td>
                    <td>
                        <select class="field" id="type" name="type">
                            <option value="child" <?php echo (isset($is_edit) && $side_menu_edit[0]['type'] == 'child' ? "selected='selected'" : ""); ?>>Child</option>                        
                            <option value="top-menu" <?php echo (isset($is_edit) && $side_menu_edit[0]['type'] == 'top-menu' ? "selected='selected'" : ""); ?>>Top Menu</option>                        
                            <option value="group" <?php echo (isset($is_edit) && $side_menu_edit[0]['type'] == 'group' ? "selected='selected'" : ""); ?>>Group</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Parent
                    </td>
                    <td>
                        <select class="field" id="parent">
                            <option value=""></option>
                            <?php
                            foreach($parent as $p)
                            {?>
                            <option value="<?php echo $p['id_application_menu']?>" <?php echo (isset($is_edit) && $side_menu_edit[0]['parent'] == $p['id_application_menu'] ? "selected='selected'" : ""); ?>>
                                <?php echo $p['alias'] ?>
                            </option> 
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Division
                    </td>
                    <td>
                        <select class="field" id="division">
                            <option value=""></option>
                            <?php
                            foreach($division as $div)
                            {?>
                            <option value="<?php echo $div['id_division'] ?>" <?php echo (isset($is_edit) && $side_menu_edit[0]['division'] == $div['id_division'] ? "selected='selected'" : ""); ?>><?php echo $div['name'] ?></option>    
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Controller Bind
                    </td>
                    <td>
                        <input class="field" id="controller-bind" type="text" value="<?php echo (isset($is_edit) ? $side_menu_edit[0]['controller'] : '') ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Action Bind
                    </td>
                    <td>
                        <div id="action-bind" style="font-family: Arial;">
                        </div>
                        <!--<select class="field" id="action-bind">
                            <option value=""></option>
                            <?php
                            foreach($action as $act)
                            {?>
                            <option value="<?php echo $act['id_application_action'] ?>" <?php echo (isset($is_edit) && $side_menu_edit[0]['action'] == $act['id_application_action'] ? "selected='selected'" : ""); ?>><?php echo $act['name'] ?></option>    
                            <?php
                            }
                            ?>
                        </select>-->
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Index
                    </td>
                    <td>
                        <input class="field" id="index" type="text" value="<?php echo (isset($is_edit) ? $side_menu_edit[0]['index'] : '') ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>