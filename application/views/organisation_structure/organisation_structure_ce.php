<script>
$(document).ready(function(){
    
    var url = "<?php echo base_url();?>organisation_structure/get_organisation_structure_list";
    // prepare the data
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_organisation_structure', type : 'int'}, 
            { name: 'structure_name'}
        ],
        id: 'id_organisation_structure',
        url: url,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $('#parent').jqxDropDownList({
        filterable: true, selectedIndex: 0, source: dataAdapter, displayMember: "structure_name", valueMember: "id_organisation_structure", width: 200, height: 25
    });    
    
    $("#parent").on('bindingComplete', function (event) { 
        <?php
        if(isset($is_edit))
        {
            if($data_edit[0]['parent_structure'] != '' && $data_edit[0]['parent_structure'] != null)
            {
        ?>
                $("#parent").jqxDropDownList('val', <?php echo $data_edit[0]['parent_structure'] ?>);
        <?php
            }
        }
        ?>
    });   
});

function SaveData()
{
    var data_post = {};
    
    data_post['structure_name'] = $("#structure-name").val();
    data_post['employment_type'] = $("#employment-type").val();
    data_post['position_type'] = $("#position-type").val();
    data_post['parent_structure'] = $("#parent").val();
    data_post['index'] = $("#index").val();

    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_organisation_structure'] = $("#id_organisation_structure").val(); 
    
    load_content_ajax(GetCurrentController(), 230, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 226 , null);
}

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
<input type="hidden" id="id_menu" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_organisation_structure'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div>
            <table class="table-form">
                <tr>
                    <td class="label">
                        Structure Name
                    </td>
                    <td>
                        <input class="field" type="text" id="structure-name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['structure_name'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Parent
                    </td>
                    <td>
                        <div id="parent"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Employment Type
                    </td>
                    <td>
                        <select id="employment-type" name="employment_type" class="field">
                        <?php foreach($employment_types as $employment_type):?>
                            <option value="<?=$employment_type['id_employment_type']?>"><?=$employment_type['name']?></option>
                        <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Position Type
                    </td>
                    <td>
                        <select id="position-type" name="position_type" class="field">
                            <option value="service">Service</option>
                            <option value="non_service">Non Service</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>