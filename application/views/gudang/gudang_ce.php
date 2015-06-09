<script>
$(document).ready(function(){
    
});

function SaveData()
{
    var data_post = {};
    
    data_post['name'] = $("#name").val();
    data_post['address'] = $("#address").val();
    data_post['note'] = $("#note").val();
    data_post['id_warehouse'] = $("#id_warehouse").val();
    data_post['kode_lokasi'] = $("#kode_lokasi").val();
    data_post['is_edit'] = $("#is_edit").val();
    data_post['is_virtual'] = 0;
    
    if($("#is-virtual").is(':checked'))
    {
        data_post['is_virtual'] = 1;
    }
    
    //alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 51, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 47 , null);
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


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_warehouse" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_warehouse'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div>
            <table class="table-form">
                <tr>
                  <td style="vertical-align: top; width: 112px;">Location Code<br></td>
                  <td style="vertical-align: top; width: 870px;">
                  <input class="field" id="kode_lokasi" name="KodeLoakasi" type="text" value="<?php echo (isset($is_edit) ? $data_edit[0]['kode_lokasi'] : '') ?>">
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;">Location Name <br></td>
                  <td style="vertical-align: top;">
                  <input class="field" id="name" name="Name" type="text" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '') ?>">
                </tr>
                <tr>
                    <td style="vertical-align: top;">Address<br></td>
                  <td style="vertical-align: top;">
                  <textarea id="address" style="height: auto" class="field" cols="50" rows="10" type="text" name="Alamat"><?php echo (isset($is_edit) ? $data_edit[0]['address'] : '') ?></textarea></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Note<br></td>
                  <td style="vertical-align: top;">
                  <textarea id="note" style="height: auto" class="field" cols="50" rows="10" type="text" name="Note"><?php echo (isset($is_edit) ? $data_edit[0]['note'] : '') ?></textarea></td>
                </tr>
                <tr>
                  <td style="vertical-align: top;">Virtual Location<br></td>
                  <td style="vertical-align: top;">
                  <input class="field" id="is-virtual" type="checkbox" <?php echo (isset($is_edit) && $data_edit[0]['is_virtual'] ? 'checked=checked' : '') ?>>
                </tr>
            </table>
        </div>
    </div>
</div>