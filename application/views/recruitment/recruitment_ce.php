<script>
$(document).ready(function(){
    $("#birt_date").jqxDateTimeInput({width: '250px', height: '25px', readonly: true, formatString: 'yyyy-MM-dd'}); 
    $("#gender").jqxComboBox();
    $('#birt_date').on('change', function (event){  
        var date = $('#birt_date').jqxDateTimeInput('val');
        $("#txt_date").val(date);
    }); 
    $("#clear-birt_date").click(function(){
        $("#birt_date").val(null);
    
    });
    
    <?php 
    if(isset($is_edit)){?>
    $("#birt_date").val('<?php echo $data_edit[0]['birt_date']; ?>');   
    <?php 
    }
    ?>
});

function SaveData()
{
    var data_post = {};
    
    data_post['nama'] = $("#name").val();
    data_post['alamat'] = $("#address").val();
    data_post['telepon'] = $("#telephone").val();
    data_post['email'] = $("#email").val(); 
    data_post['birt_date'] = $("#txt_date").val();
    data_post['religion'] = $("#religion").val();
    data_post['gender'] = $("#gender").val();
    data_post['blood_type'] = $("#blood_type").val(); 
    data_post['is_edit']=$("#is_edit").val();
    data_post['id']= $("#id_recruitment").val();
    
    load_content_ajax(GetCurrentController(), 377, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 375 , null);
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
<input type="hidden" id="id_recruitment" value="<?php echo (isset($is_edit) ? $data_edit[0]['id'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div>
            <table class="table-form">
                <tr>
                    <td class="label">
                        Name
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['nama'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Address
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="address" name="address" value="<?php echo (isset($is_edit) ? $data_edit[0]['alamat'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Telephone
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="telephone" name="telephone" value="<?php echo (isset($is_edit) ? $data_edit[0]['telepon'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Email
                    </td>
                    <td class="column-input">
                        <input class="field" type="text" id="email" name="email" value="<?php echo (isset($is_edit) ? $data_edit[0]['email'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Date
                    </td>
                    <td class="column-input">
                        <div id='birt_date'></div>
                        <input type="hidden" id="txt_date" value="<?php echo (isset($is_edit) ? $data_edit[0]['birt_date'] : '') ?>">
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Agama
                    </td>
                    <td class="column-input">
                        <select class="field" id="religion" name="religion">
                            <?php
                            if(isset($is_edit)){
                                if($data_edit[0]['religion']=="Islam"){
                                    $islam="selected";
                                }else{
                                    $islam="";
                                }
                                if($data_edit[0]['religion']=="Kristen"){
                                    $kristen="selected";
                                }else{
                                    $kristen="";
                                }
                                if($data_edit[0]['religion']=="Budha"){
                                    $budha="selected";
                                }else{
                                    $budha="";
                                }
                                if($data_edit[0]['religion']=="Hindu"){
                                    $hindu="selected";
                                }else{
                                    $hindu="";
                                }
                                if($data_edit[0]['religion']=="Konghuchu"){
                                    $konghuchu="selected";
                                }else{
                                    $konghuchu="";
                                }
                                if($data_edit[0]['religion']=="Lainnya"){
                                    $lainnya="selected";
                                }else{
                                    $lainnya="";
                                }
                            }else{
                                $islam="selected";
                            }
                            ?>
                            <option value="Islam" <?php echo (isset($is_edit) ? $islam : '' );?>>Islam</option>
                            <option value="Kristen" <?php echo (isset($is_edit) ? $kristen : '' );?>>Kristen</option>
                            <option value="Budha" <?php echo (isset($is_edit) ? $budha : '' );?>>Budha</option>
                            <option value="Hindu" <?php echo (isset($is_edit) ? $hindu : '' );?>>Hindu</option>
                            <option value="Konghuchu" <?php echo (isset($is_edit) ? $konghuchu : '' );?>>Konghuchu</option>
                            <option value="Lainnya" <?php echo (isset($is_edit) ? $lainnya : '' );?>>Lainnya</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Gender
                    </td>
                    <td class="column-input">
                    <select class="field" type="text" id="gender" name="gender" value="<?php echo (isset($is_edit) ? $data_edit[0]['gender'] : '') ?>">
                        <?php 
                            if(isset($is_edit)){
                                if($data_edit[0]['gender']=="Male"){
                                    $male="selected";
                                }else{
                                    $male="";
                                }
                                if($data_edit[0]['gender']=="Female"){
                                    $female="selected";
                                }else{
                                    $female="";
                                }
                            }else{
                                $male="selected";
                                $female="";
                            }
                        ?>
                        <option value="Male" <?php echo $male;?>>Male</option>
                        <option value="Female" <?php echo $female;?>>Female</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Golongan Darah
                    </td>
                    <td class="column-input">
                        <select id="blood_type" class="field">
                            <?php
                            if(isset($is_edit)){
                                if($data_edit[0]['blood_type']=="O"){
                                    $o="selected";
                                }else{
                                    $o="";
                                }
                                if($data_edit[0]['blood_type']=="A"){
                                    $a="selected";
                                }else{
                                    $a="";
                                }
                                if($data_edit[0]['blood_type']=="B"){
                                    $b="selected";
                                }else{
                                    $b="";
                                }
                                if($data_edit[0]['blood_type']=="AB"){
                                    $ab="selected";
                                }else{
                                    $ab="";
                                }
                            }else{
                                $o="selected";
                                $a="";
                                $b="";
                                $ab="";
                            }
                            ?>
                            <option value="O" <?php echo $o;?>>O</option>
                            <option value="A" <?php echo $a;?>>A</option>
                            <option value="B" <?php echo $b;?>>B</option>
                            <option value="AB" <?php echo $ab;?>>AB</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>