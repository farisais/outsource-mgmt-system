<script>
$(document).ready(function(){

});
function SaveData()
{
    var data_post = {};
    
    data_post['id'] = $("#id").val();
    data_post['log_error'] = $("#log_error").val();
    data_post['date'] = $("#date").val();
    data_post['pelapor'] = $("#pelapor").val();
    data_post['handle_by'] = $("#handle_by").val();
    data_post['kategori'] = $("#kategori").val();
    data_post['waktu_pengerjaan'] = $("#waktu_pengerjaan").val();
    data_post['status_pekerjaan'] = $("#status_pekerjaan").val();
    data_post['sites'] = $('#site-grid').jqxGrid('getrows');
     
    load_content_ajax(GetCurrentController(), 283, data_post); 
}
function DiscardData()
{
    load_content_ajax(GetCurrentController(), 281 , null);
}

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
        <div><h1 style="font-size: 18pt; font-weight: bold;">Customer / <span><?php echo (isset($is_edit) ? $data_edit[0]['id'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                  <tr>
                    <td class="label">Pesan Error:</td>
                    <td><input class="field" id="log_error" name="log_error" type="text" value="<?php echo (isset($is_edit) ? $data_edit[0]['log_error'] : '') ?>"></td>
                    <td class="label">Tanggal :</td>
                    <td><input class="field" id="date" name="date" type="text" value="<?php echo (isset($is_edit) ? $data_edit[0]['date'] : '') ?>">
                    </td>
                  </tr>
                  <tr>
                    <td class="label">Pelapor:</td>
                    <td ><input class="field" id="pelapor" name="pelapor" value="<?php echo (isset($is_edit) ? $data_edit[0]['pelapor'] : '') ?>"></td>
                    <td class="label">Handle By:</td>
                    <td ><input class="field" id="handle_by" name="handle_by" value="<?php echo (isset($is_edit) ? $data_edit[0]['handle_by'] : '') ?>"></td>
                  </tr>
                  <tr>
                    <td class="label">Kategori:</td>
                    <td ><input class="field" id="kategori" name="kategori" value="<?php echo (isset($is_edit) ? $data_edit[0]['kategori'] : '') ?>"></td>
                    <td class="label">Waktu Pengerjaan:</td>
                    <td ><input class="field" id="waktu_pengerjaan" name="waktu_pengerjaan" value="<?php echo (isset($is_edit) ? $data_edit[0]['waktu_pengerjaan'] : '') ?>"></td>
                  </tr>
                  <tr>
                    <td class="label">Status Pekerjaan:</td>
                    <td>
                        <input class="field" id="status_pekerjaan" name="status_pekerjaan" value="<?php echo (isset($is_edit) ? $data_edit[0]['status_pekerjaan'] : '') ?>">
                    </td>
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