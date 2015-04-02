<script>
$(document).ready(function(){
    $("#parent").change(function(){
        if($(this).val() != '')
        {
            $("#division").val($(this).val().split('-')[1]);
            $("#division").attr('disabled', 'disabled');
        }
        else
        {
            $("#division").removeAttr('disabled');
        }
    });
    
    
    
    var url = "<?php echo base_url() ;?>action/get_action_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_application_action'}, 
            { name: 'name'}
        ],
        id: 'id',
        url: url,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    
    $("#add-condition").click(function(){
        var data = {};
        data['identifier'] = null;
        data['target_action'] = null;
        data['target_action_name'] = null;
        var commit0 = $("#condition-grid").jqxGrid('addrow', null, data);
    });
    $("#remove-condition").click(function(){
        var selectedrowindex = $("#condition-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#condition-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#condition-grid").jqxGrid('deleterow', id);
        }
    });
    
    $("#condition-grid").on('rowdoubleclick', function(event){
         var args = event.args;
         alert(JSON.stringify($("#condition-grid").jqxGrid('getrowdata', event.args.rowsindex)));
    });
    
    <?php 
    if(isset($is_edit))
    {?>
    
    var condition = [
    <?php
        foreach($action_condition as $condition)
        {
            echo '{identifier: "' . $condition['identifier'] . '", target_action: "'. $condition['target_action'] .'", target_action_name: "'. $condition['target_action_name'] .'" },';    
        }
    ?>
    ];
    
    var sourceCondition =
    {
        datatype: "array",
        datafields:
        [
            { name: 'identifier'}, 
            { name: 'target_action_name'},
            { name: 'target_action'}
        ],
        localdata: condition
    };
    var dataAdapterCondition = new $.jqx.dataAdapter(sourceCondition);
    
    <?php
    }
    ?>
    
    $("#condition-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '90%',
        height: 150,
        selectionmode : 'singlerow',
        <?php echo (isset($is_edit) ? 'source: dataAdapterCondition,' : ''); ?>
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Identifier', dataField: 'identifier'},
            { text: 'Action Name', dataField: 'target_action', displayField : 'target_action_name', width: 300, columntype: 'dropdownlist', 
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: dataAdapter, displayMember: 'name', valueMember: 'id_application_action',filterable: true  });
                }
            },
        ]
    });
    
    
    
    
    
    
});

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    data_post['uname'] = $("#uname").val();
    data_post['controller'] = $("#controller-input").val();
    data_post['function_exec'] = $("#function_exec").val();
    data_post['function_args'] = $("#function_args").val();
    data_post['view_type'] = $("#view_type").val();
    data_post['view_file'] = $("#view_file").val();
    data_post['prefix'] = $("#prefix").val();
    data_post['action_type'] = $("#action_type").val();
    data_post['action_button'] = $("#action_button").val();
    data_post['target_action'] = $("#target_action").val();
    data_post['action_condition'] = $('#condition-grid').jqxGrid('getrows');
    if($("#use-log").is(":checked"))
    {
        data_post['use_log'] = 1;
    }
    else
    {
        data_post['use_log'] = 0;
    }
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_edit'] = $("#id_action").val(); 
    
    load_content_ajax(GetCurrentController(), 10, data_post);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 1 , null);
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

.row-color
{
    background: #D7C7FF;
}

.row-color span
{
    font-weight: bold;
    font-family: Arial;
}

</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_action" value="<?php echo (isset($is_edit) ? $action_edit[0]['id_application_action'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div>
            <table class="table-form">
                <tr>
                    <td class="label">
                        Name
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $action_edit[0]['name'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Uname
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="uname" name="uname" value="<?php echo (isset($is_edit) ? $action_edit[0]['uname'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Controller
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="controller-input" name="controller-input" value="<?php echo (isset($is_edit) ? $action_edit[0]['controller'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Function Execute
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="function_exec" name="function_exec" value="<?php echo (isset($is_edit) ? $action_edit[0]['function_exec'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Function Argument (Use ',' to seperate)
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="function_args" name="function_args" value="<?php echo (isset($is_edit) ? $action_edit[0]['function_args'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        View Type
                    </td>
                    <td class="column-input">
                        <select class="field" id="view_type">
                            <option value="no_view" <?php echo (isset($is_edit) && $action_edit[0]['view_type'] == 'no_view' ? "selected='selected'" : ""); ?>>No View</option>
                            <option value="form" <?php echo (isset($is_edit) && $action_edit[0]['view_type'] == 'form' ? "selected='selected'" : ""); ?>>Form</option>
                            <option value="gridview" <?php echo (isset($is_edit) && $action_edit[0]['view_type'] == 'gridview' ? "selected='selected'" : ""); ?>>Grid View</option>
                            <option value="treeview" <?php echo (isset($is_edit) && $action_edit[0]['view_type'] == 'treeview' ? "selected='selected'" : ""); ?>>Tree View</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        View File
                    </td>
                    <td class="column-input">
                       <input class="field" type="text" id="view_file" name="view_file" value="<?php echo (isset($is_edit) ? $action_edit[0]['view_file'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Prefix
                    </td>
                    <td class="column-input">
                        <input class="field" id="prefix" name="prefix" type="text" value="<?php echo (isset($is_edit) ? $action_edit[0]['prefix'] : '') ?>" />
                    </td>
                </tr>
                 <tr>
                    <td class="label">
                        Action Type
                    </td>
                    <td class="column-input">
                        <select class="field" id="action_type">
                            <option value="view" <?php echo (isset($is_edit) && $action_edit[0]['action_type'] == 'view' ? "selected='selected'" : ""); ?>>View</option>
                            <option value="create" <?php echo (isset($is_edit) && $action_edit[0]['action_type'] == 'create' ? "selected='selected'" : ""); ?>>Create</option>
                            <option value="update" <?php echo (isset($is_edit) && $action_edit[0]['action_type'] == 'update' ? "selected='selected'" : ""); ?>>Update</option>
                            <option value="delete" <?php echo (isset($is_edit) && $action_edit[0]['action_type'] == 'delete' ? "selected='selected'" : ""); ?>>Delete</option>
                        </select>
                    </td>
                </tr>
                 <tr>
                    <td class="label">
                        Action Button
                    </td>
                    <td class="column-input">
                        <select class="field" id="action_button">
                            <option value="no_button" <?php echo (isset($is_edit) && $action_edit[0]['action_button'] == 'no_button' ? "selected='selected'" : ""); ?>>No Button</option>
                            <option value="view_detail" <?php echo (isset($is_edit) && $action_edit[0]['action_button'] == 'view_detail' ? "selected='selected'" : ""); ?>>View Detail</option>
                            <option value="crud" <?php echo (isset($is_edit) && $action_edit[0]['action_button'] == 'crud' ? "selected='selected'" : ""); ?>>CRUD</option>
                            <option value="save_discard" <?php echo (isset($is_edit) && $action_edit[0]['action_button'] == 'save_discard' ? "selected='selected'" : ""); ?>>Save & Discrad</option>
                            <option value="approve_discard" <?php echo (isset($is_edit) && $action_edit[0]['action_button'] == 'approve_discard' ? "selected='selected'" : ""); ?>>Approve & Discard</option>
                            <option value="crud_import" <?php echo (isset($is_edit) && $action_edit[0]['action_button'] == 'crud_import' ? "selected='selected'" : ""); ?>>Crud & Import</option>
                        </select>
                    </td>
                </tr>
                 <tr>
                    <td class="label">
                        Target Action
                    </td>
                    <td class="column-input">
                        <select class="field" id="target_action">
                            <option value=""></option>
                            <?php
                            foreach($target_action as $act)
                            {?>
                            <option value="<?php echo $act['id_application_action'] ?>"  <?php echo (isset($is_edit) && $action_edit[0]['target_action'] == $act['id_application_action'] ? "selected='selected'" : ""); ?>><?php echo $act['name'] ?></option>    
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Use Log
                    </td>
                    <td class="column-input">
                        <input type="checkbox" id="use-log" <?php echo (isset($is_edit) && $action_edit[0]['use_log'] == 1 ? 'checked=checked' : ''); ?> />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row-color" style="width: 90%;">
                            <button id="add-condition">+</button>
                            <button id="remove-condition">-</button>
                            <span>Add Action Redirect Condition</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="condition-grid"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>