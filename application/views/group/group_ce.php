<script>
$(document).ready(function(){
         var url = "<?php echo base_url() ;?>user/get_user_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_user', type: 'int'}, 
                    { name: 'user_name'},
                    { name: 'full_name'}
                ],
                id: 'id',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            
            $('#administrator-select').jqxDropDownList({
                filterable: true, selectedIndex: 0, source: dataAdapter, displayMember: "full_name", valueMember: "id_user", width: 200, height: 25
            });  
             $("#administrator-select").on('bindingComplete', function (event) { 
                <?php
                if(isset($is_edit))
                {
                    if($data_edit[0]['administrator'] != '' && $data_edit[0]['administrator'] != null)
                    {
                ?>
                        $("#administrator-select").jqxDropDownList('val', <?php echo $data_edit[0]['administrator'] ?>);
                <?php
                    }
                }
                ?>
            });  
            
            $("#user-list-grid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: 450,
                source: dataAdapter,
                selectionmode : 'singlerow',
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                rendertoolbar: function (toolbar) {
                    $("#group-assign").click(function(){
                        var selectedrowindex = $("#user-list-grid").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var id = $("#user-list-grid").jqxGrid('getrowid', selectedrowindex);
                            var row = $("#user-list-grid").jqxGrid('getrowdata', selectedrowindex);
                            var commit0 = $("#user-assigned-grid").jqxGrid('addrow', null, row);
                            var commit1 = $("#user-list-grid").jqxGrid('deleterow', id);
                        }
                    });
            
                    
                },
                columns: [
                    { text: 'ID', dataField: 'id_user', width: 60},
                    { text: 'Name', dataField: 'full_name'}
                ]
            });
            
            <?php 
            if(isset($is_edit))
            {?>
            var url_assign = "<?php echo base_url() ;?>group/get_group_member?id=<?php echo  $data_edit[0]['id_group'] ?>";
            var source_assign =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_user', type: 'int'}, 
                    { name: 'user_name'}, 
                    { name: 'full_name'}
                ],
                id: 'id',
                url: url_assign,
                root: 'data'
            };
            var dataAdapter_assign = new $.jqx.dataAdapter(source_assign);
            
            <?php    
            }
            ?>
            
            
            $("#user-assigned-grid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: 450,
                columnsresize: true,
                <?php echo (isset($is_edit) ? 'source: dataAdapter_assign,' : '') ?>
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                ready: function()
                {
                    var rows = $('#user-assigned-grid').jqxGrid('getrows');
                    for(j=0;j<rows.length;j++)
                    {
                        var row = rows[j];
                        var rowlist = $("#user-list-grid").jqxGrid("getrows");
                        for(i=rowlist.length - 1;i>=0;i--)
                        {
                            if(row.id_user == rowlist[i].id_user)
                            {
                                //alert(JSON.stringify(rowlist[i]));
                                $("#user-list-grid").jqxGrid("deleterow", rowlist[i].uid);
                            }
                        }
                    }
                },
                rendertoolbar: function(toolbar){
                    $("#group-unassign").click(function(){
                        var selectedrowindex = $("#user-assigned-grid").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var id = $("#user-assigned-grid").jqxGrid('getrowid', selectedrowindex);
                            var row = $("#user-assigned-grid").jqxGrid('getrowdata', selectedrowindex);
                            var commit0 = $("#user-list-grid").jqxGrid('addrow', null, row);
                            var commit1 = $("#user-assigned-grid").jqxGrid('deleterow', id);
                        }
                        $('#user-list-grid').jqxGrid('sortby', 'id_user', 'asc');
                    });  
                },
                columns: [
                    { text: 'ID', dataField: 'id_user', width: 60},
                    { text: 'Name', dataField: 'full_name'}
                ]
            });  

});

function getListGridId(action)
{
    var rows = $("#user-list-grid").jqxGrid("getrows");
    for(i=rows.length - 1;i>=0;i--)
    {
        alert(rows[i].id_user + " : " + action);
        if(action == rows[i].id_user)
        {
            alert(JSON.stringify(rows[i]));
            //$("#user-list-grid").jqxGrid("deleterow", rows[i].uid);
        }
    }
}

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    data_post['description'] = $('#description').val();
    
    data_post['administrator'] = $("#administrator-select").val();
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_group'] = $("#id_group").val(); 
    
    data_post['group_member'] = $("#user-assigned-grid").jqxGrid('getrows');
    
    load_content_ajax(GetCurrentController(), 'save_edit_group', data_post);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 'view_group' , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_group" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_group'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Name
                        </div>
                        <div class="column-input" colspan="2">
                            <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '') ?>"/>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="label">
                            Description
                        </div>
                        <div class="column-input" colspan="2">
                            <input class="field" type="text" id="description" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['description'] : '') ?>"/>
                        </div>
                    </td>
                   
                    
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="label">
                            Administrator
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="administrator-select"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        User List
                    </td>
                    <td>
                    
                    </td>
                    <td>
                        Member User
                    </td>
                </tr>
                 <tr>
                    <td style="width: 40%;">
                        <div id="user-list-grid"></div>
                    </td>
                    <td style="width: 10%; text-align: center; padding: 5px;font-size: 10pt;">
                        <button id="group-assign"style="width:100%; margin-top: 5px;">>></button>
                        <button id="group-unassign" style="width:100%; margin-top: 5px;"><<</button>
                    </td>
                    <td style="width: 40%;">
                        <div id="user-assigned-grid"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>