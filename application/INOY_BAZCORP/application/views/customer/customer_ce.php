<script>
$(document).ready(function(){
    
    var city = [
        <?php
        foreach($cities as $city)
        {
            echo '{ value: "'. $city['id_city'] .'", label: "'. $city['name'] .'"},';
        }
        ?> 
    ];
    
     
    <?php 
    if(isset($is_edit))
    {?>
    
    var site = [
    <?php
        foreach($sites as $site)
        {
            echo '{ site_name: "'. $site['site_name'] .'", address: "'. $site['address'] .'", city: "'. $site['city'] .'", city_name: "'. $site['city_name'] .'"},';
        }
    ?>
    ];
    
    var source =
    {
        datatype: "array",
        datafields:
        [
            { name: 'site_name'}, 
            { name: 'address'},
            { name: 'city'},
            { name: 'city_name'}
        ],
        localdata: site
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    
    <?php
    }
    ?>
    
    $("#site-grid").jqxGrid({
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        <?php echo (isset($is_edit) ? 'source: dataAdapter,' : ''); ?>
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        columns: [
            { text: 'Site Name', dataField: 'site_name'},
            { text: 'Address', dataField: 'address'},
            { text: 'City', dataField: 'city', displayField: 'city_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: city, displayMember: 'label', valueMember: 'value', filterable: true });
                }
            }
        ]
    });
    
    $("#add-site").click(function(){
        var data = {};
        data['site_name'] = null;
        data['address'] = null;
        data['city'] = null;
        var commit0 = $("#site-grid").jqxGrid('addrow', null, data);
    });
    
    $("#remove-site").click(function(){
        var selectedrowindex = $("#site-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#site-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#site-grid").jqxGrid('deleterow', id);
        }
    });
    
    $('#city').jqxDropDownList({
        filterable: true, source: city, displayMember: "label", valueMember: "value", width: 200, height: 25
    });    
    
        <?php
        if(isset($is_edit))
        {
            if($data_edit[0]['city'] != '' && $data_edit[0]['city'] != null)
            {
        ?>
                $("#city").jqxDropDownList('val', <?php echo $data_edit[0]['city'] ?>);
        <?php
            }
        }
        ?>
});
function SaveData()
{
    var data_post = {};
    
    data_post['company_code'] = $("#company-code").val();
    data_post['name'] = $("#name").val();
    data_post['address'] = $("#address").val();
    data_post['city'] = $("#city").val();
    data_post['npwp'] = $("#npwp").val();
    data_post['contact'] = $("#contact").val();
    data_post['tlp'] = $("#telp").val();
    data_post['fax'] = $("#fax").val();
    data_post['email'] = $("#email").val();
    data_post['rekening'] = $("#no-rek").val();
    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_ext_company'] = $("#id_ext_company").val(); 
    data_post['sites'] = $('#site-grid').jqxGrid('getrows');
    
    load_content_ajax(GetCurrentController(), 46, data_post);
    
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 41 , null);
}

</script>
<script>
$(document).ready(function(){
     
});
</script>
<style>
.table-form .label
{
    width: 80px;
}

.table-form .field
{
    width: 90%;
}
</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="text" id="id_ext_company" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_ext_company'] : '') ?>" />
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Customer / <span><?php echo (isset($is_edit) ? $data_edit[0]['company_code'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                  <tr>
                    <td class="label">Customer Code:</td>
                    <td>
                        <input class="field" id="company-code" name="KodeSupplier" type="text" value="<?php echo (isset($is_edit) ? $data_edit[0]['company_code'] : '') ?>">
                    </td>
                    <td class="label">Name :</td>
                    <td>
                        <input class="field" id="name" name="NamaSupplier" type="text" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '') ?>">
                    </td>
                  </tr>
                  <tr>
                    <td class="label">Address :</td>
                    <td colspan="3">
                        <textarea id="address" style="height: auto" class="field" rows="10" type="text" name="Alamat"><?php echo (isset($is_edit) ? $data_edit[0]['address'] : '') ?></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td class="label">
                        City :
                    </td>
                    <td colspan="3">
                        <div id="city"></div>
                    </td>
                  </tr>
                  <tr>
                    <td class="label">NPWP:</td>
                    <td ><input class="field" id="npwp" name="NPWP" value="<?php echo (isset($is_edit) ? $data_edit[0]['npwp'] : '') ?>"></td>
                    <td class="label">Contact:</td>
                    <td ><input class="field" id="contact" name="ContactSupplier" value="<?php echo (isset($is_edit) ? $data_edit[0]['contact'] : '') ?>"></td>
                  </tr>
                  <tr>
                    <td class="label">Telephone:</td>
                    <td ><input class="field" id="telp" name="TelephoneSupplier" value="<?php echo (isset($is_edit) ? $data_edit[0]['tlp'] : '') ?>"></td>
                    <td class="label">Fax:</td>
                    <td ><input class="field" id="fax" name="FaxSupplier" value="<?php echo (isset($is_edit) ? $data_edit[0]['fax'] : '') ?>"></td>
                  </tr>
                  <tr>
                    <td class="label">Email:</td>
                    <td ><input class="field" id="email" name="EmailSupplier" value="<?php echo (isset($is_edit) ? $data_edit[0]['email'] : '') ?>"></td>
                    <td class="label">No Rek.</td>
                    <td ><input class="field" id="no-rek" name="no-rek" value="<?php echo (isset($is_edit) ? $data_edit[0]['rekening'] : '') ?>"></textarea></td>
                  </tr>  
                  <tr>
                    <td colspan="4">                       
                         <div class="row-color" style="width: 100%;">
                            <button style="width: 30px;" id="add-site">+</button>
                            <button style="width: 30px;" id="remove-site">-</button>
                            <div style="display: inline;"><span>Add / Remove Site</span></div>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <td colspan="4">
                        <div id="site-grid"></div>
                    </td>
                </tr>             
            </table>
        </div>
    </div>
</div>