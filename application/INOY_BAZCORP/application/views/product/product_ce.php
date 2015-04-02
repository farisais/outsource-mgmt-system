<script>
$(document).ready(function(){
    
        $("#auto-generate").click(function(){
            alert($("#service-type").val()); 
        });

});


function SaveData()
{
    var data_post = {};
    
    data_post['product_name'] = $("#product-name").val();
    data_post['unit'] = $("#product-unit").val();
    data_post['product_category'] = $("#product-category").val();
    data_post['merk'] = $("#product-merk").val();
    data_post['type_material'] = $("#product-type").val();
    data_post['description'] = $('#product-description').val();
    data_post['is_active'] = false;
    data_post['is_service'] = false;
    if($("#is-active").is(':checked'))
    {
        data_post['is_active'] = true;
    }
    
    if($("#service-type").is(':checked'))
    {
        data_post['is_service'] = true;
    }
    
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_product'] = $("#id_product").val();
    alert(JSON.stringify(data_post));
    load_content_ajax(GetCurrentController(), 25, data_post);
    
}
function DiscardData()
{
    load_content_ajax('administrator', 21 , null);
}

</script>
<style>

.second-column
{
    padding-left: 30px;
}

.image-field
{
    border: 1px solid #c8c8d3;
    -moz-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    -webkit-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);  
    padding: 10px;  
    cursor: pointer;
}

#clear-image
{
    width: 30px;
    height: 30px;
    background: darkgray;
    /* float: left; */
    position: relative;
    top: -152px;
    left: 120px;
    display: -webkit-inline-box;
    z-index: 100;
}
#clear-image span
{
    font-weight: bold;
    font-size: 12pt;
    color: white;
}


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_product" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_product'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Product / <span><?php echo (isset($is_edit) ? $data_edit[0]['id_product'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td rowspan="4">
                        <div>
                            <img class="image-field" src="<?php echo base_url() . 'images/product-default.png' ?>" alt="product-default"/>
                        </div>
                    </td>
                     <td class="label">
                        Product Code
                    </td>
                    <td>
                        <input disabled="true" style="display: inline;" class="field" type="text" id="product-code" value="<?php echo (isset($is_edit) ? $data_edit[0]['product_code']: '' ) ?>" />
                    </td>
                    <td>
                        <input style="display: inline" type="checkbox" id="service-type" value="true" <?php echo (isset($is_edit) && $data_edit[0]['is_service'] == true ? 'checked="checked"' : '' ) ?>/>Service
                        <input style="display: inline" type="checkbox" id="is-active" value="true" <?php echo (isset($is_edit) && $data_edit[0]['is_active'] == true ? 'checked="checked"' : '' ) ?>/>Is Active
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Product Name
                    </td>
                    <td colspan="3">
                        <input class="field" style="width: 92%;" type="text" id="product-name" value="<?php echo (isset($is_edit) ? $data_edit[0]['product_name'] : '' ) ?>" />
                        
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Unit
                    </td>
                    <td colspan="3">
                        <select class="field" id="product-unit" style="width: 95%;">
                            <?php
                            foreach($unit_measure as $unit)
                            {?>
                            <option value="<?php echo $unit['id_unit_measure'] ?>" <?php echo (isset($is_edit) && $data_edit[0]['unit'] == $unit['id_unit_measure'] ? "selected='selected'" : ""); ?>><?php echo $unit['name'] ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 120px;">
                        Product Category
                    </td>
                    <td colspan="3">
                        <select class="field" id="product-category" style="width: 95%;">
                            <?php
                            foreach($product_category as $pc)
                            {?>
                            <option value="<?php echo $pc['id_product_category'] ?>" <?php echo (isset($is_edit) && $data_edit[0]['product_category'] == $pc['id_product_category'] ? "selected='selected'" : ""); ?>><?php echo $pc['product_category'] . ' ('. $pc['abbreviation'] .')'  ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <!-- /////////////////////////////////////////////////////////////// -->
                <tr>
                    <td colspan="4">                       
                         <div class="row-color" style="width: 100%;height: 20px">
                            
                        </div>
                    </td>
                </tr>
                <tr>
                   <td class="label">
                        Merk
                    </td>
                    <td>
                        <select class="field" id="product-merk">
                            <?php
                            foreach($merk as $m)
                            {?>
                            <option value="<?php echo $m['id_merk'] ?>" <?php echo (isset($is_edit) && $data_edit[0]['merk'] == $m['id_merk'] ? "selected='selected'" : ""); ?>><?php echo $m['name'] . ' ('. $m['abbreviation'] .')'  ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </td>
                    <td class="label second-column">
                        Type Material
                    </td>
                    <td>
                        <select class="field" id="product-type">
                            <?php
                            foreach($type_material as $tm)
                            {?>
                            <option value="<?php echo $tm['id_type_material'] ?>" <?php echo (isset($is_edit) && $data_edit[0]['type'] == $tm['id_type_material'] ? "selected='selected'" : ""); ?>><?php echo $tm['type_material'] . ' ('. $tm['abbreviation'] .')'  ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Description
                    </td>
                    <td colspan="4">
                        <textarea class="field" cols="20" rows="5" id="product-description" style="width: 95%;height: 80px;"><?php echo (isset($is_edit) ? $data_edit[0]['description'] : '' ) ?></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>