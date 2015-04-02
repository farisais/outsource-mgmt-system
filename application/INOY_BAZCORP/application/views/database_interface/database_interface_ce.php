<script>
$(document).ready(function(){
    
    //=================================================================================
    //
    //   DN Product Grid
    //
    //=================================================================================
    
    var url = "<?php echo base_url() ;?>database_interface/get_database_table_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'table_name'},
            { name: 'model_name'},
            { name: 'alias'},
            { name: 'sync_status'},
        ],
        id: 'id',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#database-interface-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 450,
        selectionmode : 'singlerow',
        source: dataAdapter,
        editable: true,
        columnsresize: true,
        autoshowloadelement: true,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Table Name', dataField: 'table_name', width: 200},
            { text: 'Model Name', dataField: 'model_name'},
            { text: 'Alias', dataField: 'alias'},
            { text: 'Sync Status', dataField: 'sync_status'}
        ]
    });
    
    $("#database-interface-grid").on("bindingcomplete", function (event) {
        $("#database-interface-grid").jqxGrid('setcolumnproperty', 'table_name', 'editable', false);
        $("#database-interface-grid").jqxGrid('setcolumnproperty', 'sync_status', 'editable', false);
    });  
    
    
});

function SaveData()
{
    var data_post = {};
    
    data_post['data'] = $('#database-interface-grid').jqxGrid('getrows');
    
    //load_content_ajax(GetCurrentController(), 20, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 16 , null);
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
    margin-bottom: 10px;
}


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_po" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_po'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <p>
                Map database table with internal system model definition. Sync status = 1 indicate that the table has been mapped with internal system model definition
            </p>
        </div>
        <div>
            <div id="database-interface-grid"></div> 
        </div>
    </div>
</div>