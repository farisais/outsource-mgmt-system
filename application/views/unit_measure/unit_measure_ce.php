<script>
$(document).ready(function(){
    $("#multiplier-input").jqxNumberInput({ width: '250px', height: '25px',  inputMode: 'simple', spinButtons: true });
    var urlSelect = "<?php echo base_url() ;?>unit_measure/get_unit_measure_list";
    var sourceSelect =
    {
        datatype: "json",
        datafields: [
            { name: 'id_unit_measure' },
            { name: 'name' },
            { name: 'unit_of_measure_category' },
        ],
        url: urlSelect,
    };
    var dataAdapterSelect = new $.jqx.dataAdapter(sourceSelect);

    $("#select-unit").jqxComboBox({ selectedIndex: 0, source: dataAdapterSelect, displayMember: "name", valueMember: "id_unit_measure", width: 200, height: 25});
                
    <?php 
    if(isset($is_edit))
    {?>
    var url_assign = "<?php echo base_url() ;?>unit_measure/get_unit_convertion?id=<?php echo  $data_edit[0]['id_unit_measure'] ?>";
    var source_assign =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_unit_measure', type: 'int'}, 
            { name: 'unit_name'},
            { name: 'multiplier_fix'},
        ],
        id: 'id',
        url: url_assign,
        root: 'data'
    };
    var dataAdapter_assign = new $.jqx.dataAdapter(source_assign);
    
    <?php    
    }
    ?>
        
    $("#unit-conversion-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 450,
        selectionmode : 'singlerow',
        <?php echo (isset($is_edit) ? 'source: dataAdapter_assign,' : '') ?>
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        filterable: true,
        showfilterrow: true,
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add-unit-conversion").click(function(){
                var item = $("#select-unit").jqxComboBox('getSelectedItem');
                var row = {};
                row['id_unit_measure'] = item.value;
                row['unit_name'] = item.label;
                row['multiplier_fix'] =  $("#multiplier-input").val();
                var commit = $("#unit-conversion-grid").jqxGrid('addrow', null, row);
            });
            
            $("#remove-unit-conversion").click(function(){
                var selectedrowindex = $("#unit-conversion-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#unit-conversion-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit = $("#unit-conversion-grid").jqxGrid('deleterow', id);
                }
            });
        },
        columns: [
            { text: 'Multiplier', dataField: 'multiplier_fix',width: 120},
            { text: 'Name', dataField: 'unit_name'}
        ]
    });
    
    var uom_category = [
        <?php
        foreach($uom_category as $at)
        {
            echo '{ value: "'. $at['id_unit_of_measure_category'] .'", label: "'. $at['name'] .'"},';
        }
        ?>
    ];
    
    $("#select-uom-category").jqxDropDownList({ source: uom_category, displayMember: 'label', valueMember: 'value', filterable: true });
    <?php
        if(isset($is_edit))
        {
            if($data_edit[0]['unit_of_measure_category'] != '' && $data_edit[0]['unit_of_measure_category'] != null)
            {
        ?>
                $("#select-uom-category").jqxDropDownList('val', <?php echo $data_edit[0]['unit_of_measure_category'] ?>);
    <?php
        }
    }
    ?>
});

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    
    var convertion = null;
    if($("#unit-conversion-grid").jqxGrid('getrows').length > 0)
    {
        convertion = $("#unit-conversion-grid").jqxGrid('getrows');
    }
    data_post['convertion'] = convertion;
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_unit_measure'] = $("#id_unit_measure").val(); 
    data_post['unit_of_measure_category'] = $("#select-uom-category").val();
    
    load_content_ajax(GetCurrentController(), 92, data_post);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 88 , null);
}

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
<input type="hidden" id="id_unit_measure" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_unit_measure'] : '') ?>" />
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
                            <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '') ?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="label">
                            Category
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="select-uom-category"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <span style="font-weight: bold;">Add Conversion</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">                       
                        <div style="float: left; margin-right: 5px;">
                             <div id="select-unit"></div>
                        </div>
                        <div style="float: left; margin-right: 5px;">
                            <div id="multiplier-input"></div>
                        </div>
                         <div style="float: left; margin-right: 5px;">
                            <button style="width: 30px;" id="add-unit-conversion">+</button>
                            <button style="width: 30px;" id="remove-unit-conversion">-</button>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td style="width: 80%;padding-top: 20px;" colspan="3">
                        <div id="unit-conversion-grid"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>