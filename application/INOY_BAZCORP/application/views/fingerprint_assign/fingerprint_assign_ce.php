<script>
$(document).ready(function(){
    $("#select-device-popup").jqxWindow({
        width: 600, height: 400, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#select-wo-popup").jqxWindow({
        width: 600, height: 400, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
     $("#select-site-popup").jqxWindow({
        width: 600, height: 400, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#wo-select").click(function(){
        $("#select-wo-popup").jqxWindow('open');
    });
    
    $("#site-select").click(function(){
        $("#select-site-popup").jqxWindow('open');
    });
    
    var site_client = [];
    
    //=================================================================================
    //
    //   Device Grid
    //
    //=================================================================================
     var url = "";
    <?php 
    if(isset($is_edit))
    {?>
        url = "<?php echo base_url()?>fingerprint_assign/get_fingerprint_assign_detail?id=<?php echo $data_edit[0]['id_fingerprint_assign']; ?>";
    <?php    
    }
    ?>
    
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_fingerprint_assign_detail'},
            { name: 'fingerprint_assign'},
            { name: 'fingerprint_device'},
            { name: 'ip_local'},
            { name: 'port'},
            { name: 'comm_password'},    
            { name: 'fdid'},
            { name: 'serial_number'},
        ],
        id: 'id_fingerprint_assign',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#device-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapter,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add-device").click(function(){
                var offset = $("#remove-device").offset();
                $("#select-device-popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove-device").width() + 20, y: parseInt(offset.top)} });
                $("#select-device-popup").jqxWindow('open');
            });
            $("#remove-device").click(function(){
                var selectedrowindex = $("#device-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#device-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#device-grid").jqxGrid('deleterow', id);
                }
            });
        },
        columns: [
            { text: 'Fingerprint Serial', dataField: 'fingerprint_device', displayfield: 'serial_number'},
            { text: 'IP Local', dataField: 'ip_local'},
            { text: 'Port', dataField: 'port'},
            { text: 'Comm Password', dataField: 'comm_password'}, 
            { text: 'Fdid', dataField: 'fdid'},
            //{ text: 'Site', dataField: 'customer_site', displayfield: 'site_name'},
            /*{ text: 'Action', dataField: 'select_site', columntype: 'button', 
                cellsrenderer: function () 
                        {
                            return "Select Site";
                        }, 
                buttonclick: function (row) {
                    editrow = row;
                    var dataRecord = $("#device-grid").jqxGrid('getrowdata', editrow);
                    $("#device-row").val(editrow);
                    $("#select-site-popup").jqxWindow('open');
                }
            },*/
        ]
    });
    
    $("#device-grid").jqxGrid('setcolumnproperty', 'fingerprint_device', 'editable', false);
    $("#device-grid").jqxGrid('setcolumnproperty', 'customer_site', 'editable', false);
    
    //=================================================================================
    //
    //   Select Device
    //
    //=================================================================================
    var urlDevice = "<?php echo base_url()?>fingerprint/get_fingerprint_device_list_active";

    
    var sourceDevice =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_fingerprint_device'},
            { name: 'merk'},
            { name: 'series'},
            { name: 'serial_number'},
        ],
        id: 'id_fingerprint_device',
        url: urlDevice ,
        root: 'data'
    };
    var dataAdapterDevice = new $.jqx.dataAdapter(sourceDevice);
    $("#select-device-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        source: dataAdapterDevice,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Serial Number', dataField: 'serial_number', width: 150},
            { text: 'Merk', dataField: 'merk'},
            { text: 'Series', dataField: 'series', width: 150}                                   
        ]
    });
    
    $("#select-device-grid").on('rowdoubleclick', function(event){
        var args = event.args;
        var data = $('#select-device-grid').jqxGrid('getrowdata', args.rowindex);
        data['fingerprint_device'] = data['id_fingerprint_device'];
        data['ip_local'] = null;
        data['port'] = null;
        data['comm_password'] = null;
        data['fdid'] = null;
        var commit0 = $("#device-grid").jqxGrid('addrow', null, data);
        $("#select-device-popup").jqxWindow('close');
    });
    
    //=================================================================================
    //
    //  Select WO
    //
    //=================================================================================
    var urlWO = "<?php echo base_url()?>work_order/get_work_order_list";
    
    var sourceWO =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_work_order'},
            { name: 'work_order_number'},
            { name: 'customer'},
            { name: 'customer_name'},
            { name: 'date', type: 'date'},
        ],
        id: 'id_work_order',
        url: urlWO ,
        root: 'data'
    };
    var dataAdapterWO = new $.jqx.dataAdapter(sourceWO);
    $("#select-wo-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        source: dataAdapterWO,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'WO Number', dataField: 'id_work_order',displayfield: 'work_order_number', width: 150},
            { text: 'Customer', dataField: 'customer', displayfield: 'customer_name'},
            { text: 'Date', dataField: 'date', cellsformat: 'dd/MM/yyyy',width: 150}                                   
        ]
    });
    
    $("#select-wo-grid").on("rowdoubleclick", function(event){
        var args = event.args;
        var data = $(this).jqxGrid('getrowdata', args.rowindex);
        $("#wo-no").val(data['work_order_number']);
        $("#wo-id").val(data['id_work_order']);
        $("#select-wo-popup").jqxWindow('close');
        //alert(JSON.stringify(data));
        
        var urlSite = "<?php echo base_url() ?>customer/get_customer_site_list/" + data['customer'];
    
        var sourceSite =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_customer_site'},
                { name: 'csutomer'},
                { name: 'customer_name'},
                { name: 'site_name'},
                { name: 'address'},
                { name: 'city'},
                { name: 'city_name'},
            ],
            id: 'id_customer_site',
            url: urlSite ,
            root: 'data'
        };
        var dataAdapterSite = new $.jqx.dataAdapter(sourceSite);
        $("#select-site-grid").jqxGrid({source: dataAdapterSite});
        
    });
    
    //=================================================================================
    //
    //   Select Site
    //
    //=================================================================================
    
       
    
    $("#select-site-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        filterable: true,
        showfilterrow: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Site Name', dataField: 'id_customer_site',displayfield: 'site_name', width: 150},
            { text: 'Customer', dataField: 'customer', displayfield: 'customer_name'},
            { text: 'Address', dataField: 'address'}                                   
        ]
    });
    
    $("#select-site-grid").on("rowdoubleclick", function(event){
        var args = event.args;
        var data = $(this).jqxGrid('getrowdata', args.rowindex);
        $("#site-name").val(data["site_name"]);
        $("#site-id").val(data['id_customer_site']);
        //$("#device-grid").jqxGrid('setcellvalue', $("#device-row").val(), "customer_site", data['id_customer_site']);
        //$("#device-grid").jqxGrid('setcellvalue', $("#device-row").val(), "site_name", data['site_name']);
        $("#select-site-popup").jqxWindow('close');
        
        
    });
    
     <?php
        if(isset($is_edit))
        {?>
        var urlSite = "<?php echo base_url() ?>customer/get_customer_site_list/" + <?php echo $data_edit[0]['customer'] ?>;
    
        var sourceSite =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id_customer_site'},
                { name: 'csutomer'},
                { name: 'customer_name'},
                { name: 'site_name'},
                { name: 'address'},
                { name: 'city'},
                { name: 'city_name'},
            ],
            id: 'id_customer_site',
            url: urlSite ,
            root: 'data'
        };
        var dataAdapterSite = new $.jqx.dataAdapter(sourceSite);
        $("#select-site-grid").jqxGrid({source: dataAdapterSite});
        <?php    
        }
        ?>
    
    //=================================================================================
    //
    //   Assign
    //
    //=================================================================================
    
    $("#assign").click(function(){
        var data_post = {};
        <?php
        if((!isset($is_edit)) || (isset($is_edit) && $data_edit[0]['status'] == 'unassign'))
        {?>
        
        data_post['work_order'] = $("#wo-id").val();
        data_post['work_order_number'] = $("#wo-no").val();
        data_post['site'] = $("#site-id").val();
        data_post['fingerprint_devices'] = $("#device-grid").jqxGrid('getrows');
        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_fingerprint_assign'] = $("#id_fingerprint_assign").val(); 
        data_post['action_condition_identifier'] = 'assign_fingerprint';
        
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_fingerprint_assign'] ?>;
        param.push(item);        
        
        load_content_ajax(GetCurrentController(), 'save_edit_fingerprint_assign', data_post, param);
        <?php 
        }
        else
        {?>
       
        
        <?php 
        }   
        ?>     
    });
    
    $("#unassign").click(function(){
        var data_post = {};
        <?php
        if(isset($is_edit))
        {?>
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = <?php echo $data_edit[0]['id_fingerprint_assign'] ?>;
        param.push(item);        
        data_post['is_edit'] = $("#is_edit").val(); 
        data_post['id_fingerprint_assign'] = $("#id_fingerprint_assign").val();
        load_content_ajax(GetCurrentController(), "unassign_fingerprint", data_post, param);
        <?php 
        }
        ?>     
    });
    

    
});
</script>
<script>
function SaveData()
{
    var data_post = {};
    <?php 
    if((isset($is_edit) && $data_edit[0]['status'] == 'unassign') || !isset($is_edit))
    {
    ?>
    
    
    data_post['work_order'] = $("#wo-id").val();
    data_post['work_order_number'] = $("#wo-no").val();
    data_post['site'] = $("#site-id").val();
    data_post['fingerprint_devices'] = $("#device-grid").jqxGrid('getrows');
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_fingerprint_assign'] = $("#id_fingerprint_assign").val(); 
    
    load_content_ajax(GetCurrentController(), 'save_edit_fingerprint_assign', data_post);
    <?php
    }
    else
    {
    ?>
    load_content_ajax(GetCurrentController(), 'view_fingerprint_assign', data_post);
    <?php
    }
    ?>
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 'view_fingerprint_assign' , null);
}

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_fingerprint_assign" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_fingerprint_assign'] : '') ?>" />
<div class="document-action">
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] == 'unassign' || !isset($is_edit))
    {?>
    <button style="margin-left: 20px;" id="assign">Assign</button>
    <?php    
    }
    ?>
    
    <?php 
    if(isset($is_edit) && $data_edit[0]['status'] == 'assigned')
    {?>
    <button style="margin-left: 20px;" id="unassign">Unassign</button>
    <?php    
    }
    ?>

    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'unassign' ? 'class="status-active"' : '') ?> >
            <span class="label">Unassign</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'assigned' ? 'class="status-active"' : '') ?>>
            <span class="label">Assigned</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;padding-bottom: 50px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;">Fingerprint Assign / <span><?php echo (isset($is_edit) ? $data_edit[0]['app_id'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td class="label" style="width: 20px;">
                        AppID
                    </td>
                    <td colspan="32">
                        <input class="field" type="text" id="AppID" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['app_id'] : '') ?>" placeholder="Will be Generated Automatically"/>
                    </td>
                </tr>
                <tr>
                    <td class="label" style="width: 20px;">
                        Work Order
                    </td>
                    <td>
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="wo-no" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['work_order_number'] : '') ?>"/>
                        <input type="hidden" id="wo-id" value="<?php echo (isset($is_edit) ? $data_edit[0]['work_order'] : '') ?>" />
                        <button id="wo-select">...</button>
                    </td>
                    <td class="label" style="width: 20px;">
                       Site Name
                    </td>
                    <td >
                        <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="site-name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['site_name'] : '') ?>"/>
                        <input type="hidden" id="site-id" value="<?php echo (isset($is_edit) ? $data_edit[0]['site'] : '') ?>" />
                        <button id="site-select">...</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">                       
                         <div class="row-color" style="width: 100%;">
                            <button style="width: 30px;" id="add-device">+</button>
                            <button style="width: 30px;" id="remove-device">-</button>
                            <div style="display: inline;"><span>Add / Remove Device</span></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%;" colspan="4">
                        <div id="device-grid"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div id="select-device-popup">
    <div>Select Device</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-device-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="select-wo-popup">
    <div>Select Work Order</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-wo-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<input type="hidden" id="device-row" value="" />
<div id="select-site-popup">
    <div>Select Site</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-site-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>