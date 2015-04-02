<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){  
    $("#select-action-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-group-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#add-action").click(function(){
        $("#select-action-popup").jqxWindow('open');
    });
    
    $("#add-group").click(function(){
        $("#select-group-popup").jqxWindow('open');
    });
    
    
    //=================================================================================
    //
    //   Action Grid
    //
    //=================================================================================
    
    var urlNAction = "<?php if(isset($is_edit)){?><?php echo base_url()?>notification_setting/get_notification_action_list?id=<?php echo $data_edit[0]['id_notification_setting']; ?> <?php }?>";
    var sourceNAction =
    {
        datatype: "json",
        datafields:
        [
            { name: 'action_name'},
            { name: 'action'},
        ],
        url: urlNAction ,
        root: 'data'
    };
    
    var dataAdapterNA = new $.jqx.dataAdapter(sourceNAction);
    $("#action-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '90%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapterNA,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add-action").click(function(){
                var offset = $("#remove-action").offset();
                $("#select-action-popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-action").width() + 20, y: parseInt(offset.top)} });
                $("#select-action-popup").jqxWindow('open');
            });
            $("#remove-action").click(function(){
                var selectedrowindex = $("#action-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#action-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#action-grid").jqxGrid('deleterow', id);
                }
                
            });
        },
        columns: [
            { text: 'Name', displayField: 'action_name', dataField: 'action'},
        ]
    });
    
    //=================================================================================
    //
    //   Group Grid
    //
    //=================================================================================
    
    var urlNG = "<?php if(isset($is_edit)){?><?php echo base_url()?>notification_setting/get_notification_group_list?id=<?php echo $data_edit[0]['id_notification_setting']; ?> <?php }?>";
    var sourceNG =
    {
        datatype: "json",
        datafields:
        [
            { name: 'group_name'},
            { name: 'id_group'},
        ],
        url: urlNG ,
        root: 'data'
    };
    
    var dataAdapterNG = new $.jqx.dataAdapter(sourceNG);
    $("#group-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '90%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapterNG,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add-group").click(function(){
                var offset = $("#remove-action").offset();
                $("#select-group-popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-group").width() + 20, y: parseInt(offset.top)} });
                $("#select-group-popup").jqxWindow('open');
            });
            $("#remove-group").click(function(){
                var selectedrowindex = $("#group-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#group-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#group-grid").jqxGrid('deleterow', id);
                }
                
            });
        },
        columns: [
            { text: 'Name', displayfield: 'group_name', dataField: 'id_group'},
        ]
    });
    
    //=================================================================================
    //
    //   Select action Grid
    //
    //=================================================================================
    
    var url_select_action = "<?php echo base_url() ;?>action/get_action_list";
    var source_select_action =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_application_action', type: 'int'},
            { name: 'name'},
        ],
        id: 'id_application_action',
        url: url_select_action ,
        root: 'data'
    };
    var dataAdapter_select_action = new $.jqx.dataAdapter(source_select_action);
    
    $("#select-action-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_action,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Name', dataField: 'id_application_action', displayfield: 'name'},                                  
        ]
    });
    
    $('#select-action-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-action-grid').jqxGrid('getrowdata', args.rowindex);

        data['action'] = data.id_application_action;
        data['action_name'] = data.name;
        data['notification_setting'] = null;

        var commit0 = $("#action-grid").jqxGrid('addrow', null, data);
           
        $("#select-action-popup").jqxWindow('close');
        
    });
    
     $('#action-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#action-grid').jqxGrid('getrowdata', args.rowindex);

        //alert(JSON.stringify(data));
    });
    
    //=================================================================================
    //
    //   Select group Grid
    //
    //=================================================================================
    
    var url_select_group = "<?php echo base_url() ;?>group/get_group_list";
    var source_select_group =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_group', type: 'int'},
            { name: 'group_name'},
        ],
        id: 'id_group',
        url: url_select_group ,
        root: 'data'
    };
    var dataAdapter_select_group = new $.jqx.dataAdapter(source_select_group);
    
    $("#select-group-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 400,
        selectionmode : 'singlerow',
        source: dataAdapter_select_group,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Name', dataField: 'id_group', displayField: 'group_name'},                                  
        ]
    });
    
    $('#select-group-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-group-grid').jqxGrid('getrowdata', args.rowindex);
        var commit1 = $("#group-grid").jqxGrid('addrow', null, data);
        $("#select-group-popup").jqxWindow('close');
        
    });
    
     $('#group-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#group-grid').jqxGrid('getrowdata', args.rowindex);

        alert(JSON.stringify(data));
    });
    
                
   
});

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $('#name').val();
    data_post['description'] = $("#description").val();
    data_post['email_template_header'] = $('#email-template-header').val();
    
    data_post['action_list'] = $("#action-grid").jqxGrid('getrows');
    
    data_post['group_list'] = $("#group-grid").jqxGrid('getrows');
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_notification_setting'] = $("#id_notification_setting").val(); 
    
    //alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 'save_edit_notification_setting', data_post);
}
function DiscardData()
{
    load_content_ajax('administrator', 'view_notification_setting' , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_notification_setting" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_notification_setting'] : '') ?>" />

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">

    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Notification Setting / <span><?php echo (isset($is_edit) ? $data_edit[0]['id_notification_setting'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Name
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '')?>"/>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Description
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%" class="field" type="text" id="description" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['description'] : '')?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>                       
                         <div class="row-color" style="width: 90%;">
                            <button style="width: 30px;" id="add-action">+</button>
                            <button style="width: 30px;" id="remove-action">-</button>
                            <div style="display: inline;"><span>Add / Remove Action</span></div>
                        </div>
                        <div id="action-grid"></div>
                    </td>
                    <td>                       
                         <div class="row-color" style="width: 90%;">
                            <button style="width: 30px;" id="add-group">+</button>
                            <button style="width: 30px;" id="remove-group">-</button>
                            <div style="display: inline;"><span>Add / Remove Group</span></div>
                        </div>
                        <div id="group-grid"></div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%;padding-top: 20px;" colspan="2">
                        <div class="label">
                            Email Template Head
                        </div>
                        <textarea class="field" id="email-template-header" cols="10" rows="25" style="height: 50px;"><?php echo (isset($is_edit) ? $data_edit[0]['email_template_header'] : '')?></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div id="select-action-popup">
    <div>Select Action</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-action-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="select-group-popup">
    <div>Select Group</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-group-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>