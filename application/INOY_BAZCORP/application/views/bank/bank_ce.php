<script>
    $(document).ready(function(){

    });

    function SaveData()
    {
        var data_post = {};

        // data_post[''] = $("#").val();
        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_bank'] = $("#id_bank").val();
        data_post['name'] = $("#name").val();
        data_post['branch'] = $("#branch").val();
        data_post['address'] = $("#address").val();
        data_post['contact'] = $("#contact").val();

        load_content_ajax(GetCurrentController(), 245, data_post);
    }

    function DiscardData()
    {
        load_content_ajax(GetCurrentController(), 241, null);
    }
</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_bank" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_bank'] : '') ?>" />

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <table class="table-form">
                <tbody>
                <tr>
                    <td class="label">
                        Name
                    </td>
                    <td>
                        <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Branch
                    </td>
                    <td>
                        <input class="field" type="text" id="branch" name="branch" value="<?php echo (isset($is_edit) ? $data_edit[0]['branch'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Address
                    </td>
                    <td>
                        <textarea id="address" name="address"><?php echo (isset($is_edit) ? $data_edit[0]['address'] : '') ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Contact
                    </td>
                    <td>
                        <input class="field" type="text" id="contact" name="contact" value="<?php echo (isset($is_edit) ? $data_edit[0]['contact'] : '') ?>"/>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>