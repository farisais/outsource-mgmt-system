<script>
$(document).ready(function(){
         var url = "<?php echo base_url() ;?>role/get_action_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_application_action', type: 'int'}, 
                    { name: 'name'}
                ],
                id: 'id',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#action-list-grid").jqxGrid(
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
                    $("#role-assign").click(function(){
                        var selectedrowindex = $("#action-list-grid").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var id = $("#action-list-grid").jqxGrid('getrowid', selectedrowindex);
                            var row = $("#action-list-grid").jqxGrid('getrowdata', selectedrowindex);
                            var commit0 = $("#action-assigned-grid").jqxGrid('addrow', null, row);
                            var commit1 = $("#action-list-grid").jqxGrid('deleterow', id);
                        }
                    });
            
                    
                },
                columns: [
                    { text: 'ID', dataField: 'id_application_action', width: 60},
                    { text: 'Name', dataField: 'name'}
                ]
            });
            
            <?php 
            if(isset($is_edit))
            {?>
            var url_assign = "<?php echo base_url() ;?>role/get_action_assigned?id=<?php echo  $role_edit[0]['id_role'] ?>";
            var source_assign =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_application_action', type: 'int'}, 
                    { name: 'action', type: 'int'}, 
                    { name: 'name'}
                ],
                id: 'id',
                url: url_assign,
                root: 'data'
            };
            var dataAdapter_assign = new $.jqx.dataAdapter(source_assign);
            
            <?php    
            }
            ?>
            
            
            $("#action-assigned-grid").jqxGrid(
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
                    var rows = $('#action-assigned-grid').jqxGrid('getrows');
                    for(j=0;j<rows.length;j++)
                    {
                        var row = rows[j];
                        var rowlist = $("#action-list-grid").jqxGrid("getrows");
                        for(i=rowlist.length - 1;i>=0;i--)
                        {
                            if(row.action == rowlist[i].id_application_action)
                            {
                                //alert(JSON.stringify(rowlist[i]));
                                $("#action-list-grid").jqxGrid("deleterow", rowlist[i].uid);
                            }
                        }
                    }
                },
                rendertoolbar: function(toolbar){
                    $("#role-unassign").click(function(){
                        var selectedrowindex = $("#action-assigned-grid").jqxGrid('getselectedrowindex');
                        if (selectedrowindex >= 0) {
                            var id = $("#action-assigned-grid").jqxGrid('getrowid', selectedrowindex);
                            var row = $("#action-assigned-grid").jqxGrid('getrowdata', selectedrowindex);
                            var commit0 = $("#action-list-grid").jqxGrid('addrow', null, row);
                            var commit1 = $("#action-assigned-grid").jqxGrid('deleterow', id);
                        }
                        $('#action-list-grid').jqxGrid('sortby', 'id_application_action', 'asc');
                    });  
                },
                columns: [
                    { text: 'ID', dataField: 'id_application_action', width: 60},
                    { text: 'Name', dataField: 'name'}
                ]
            });  

});

function getListGridId(action)
{
    var rows = $("#action-list-grid").jqxGrid("getrows");
    for(i=rows.length - 1;i>=0;i--)
    {
        alert(rows[i].id_application_action + " : " + action);
        if(action == rows[i].id_application_action)
        {
            alert(JSON.stringify(rows[i]));
            //$("#action-list-grid").jqxGrid("deleterow", rows[i].uid);
        }
    }
}

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    data_post['action_detail'] = $('#action-assigned-grid').jqxGrid('getrows');
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_role'] = $("#id_role").val(); 
    
    load_content_ajax(GetCurrentController(), 20, data_post);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 16 , null);
}

</script>
<script>
$(document).ready(function(){
     
});
</script>
<style>
.table-form
{
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
<input type="hidden" id="id_role" value="<?php echo (isset($is_edit) ? $role_edit[0]['id_role'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <table class="table-form">
                <tr>
                    <td colspan="3">
                        <div class="label">
                            Name
                        </div>
                        <div class="column-input" colspan="2">
                            <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $role_edit[0]['name'] : '') ?>"/>
                        </div>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        Action List
                    </td>
                    <td>
                    
                    </td>
                    <td>
                        Assigned Action
                    </td>
                </tr>
                 <tr>
                    <td style="width: 40%;">
                        <div id="action-list-grid"></div>
                    </td>
                    <td style="width: 10%; text-align: center; padding: 5px;font-size: 10pt;">
                        <button id="role-assign"style="width:100%; margin-top: 5px;">>></button>
                        <button id="role-unassign" style="width:100%; margin-top: 5px;"><<</button>
                    </td>
                    <td style="width: 40%;">
                        <div id="action-assigned-grid"></div>
                    </td>
                </tr>
            </table>
            <div style="margin-top: 20px">
                <span>*User will have access to current action that assigned to</span>
            </div>
        </div>
    </div>
</div>