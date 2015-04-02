<script>
    $(document).ready(function(){

    });

    function SaveData()
    {
        var data_post = {};

        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_chart_of_account'] = $("#id_chart_of_account").val();
        data_post['account_number'] = $("#account_number").val();
        data_post['name'] = $("#name").val();
        data_post['parent'] = $("#parent").val();
        data_post['index'] = $("#index").val();
        data_post['type'] = $("#type").val();

        load_content_ajax(GetCurrentController(), 213, data_post);

    }

    function DiscardData()
    {
        load_content_ajax(GetCurrentController(), 209, null);
    }
</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_chart_of_account" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_chart_of_account'] : '') ?>" />

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <table class="table-form">
                <tbody>
                <tr>
                    <td class="label">
                        Account Number
                    </td>
                    <td>
                        <input class="field" type="text" id="account_number" name="account_number" value="<?php echo (isset($is_edit) ? $data_edit[0]['account_number'] : '') ?>"/>
                    </td>
                </tr>
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
                        Parent
                    </td>
                    <td>
                        <select id="parent" name="parent" class="field">
                            <option value="0">- no parent -</option>
                        <?php foreach ($parent as $key => $value) : ?>
                            <option value="<?=$key?>" <?php echo (isset($is_edit) && $data_edit[0]['parent'] == $key ? "selected='selected'" : ""); ?>><?=$value?></option>
                        <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Index
                    </td>
                    <td>
                        <input class="field" type="text" id="index" name="index" value="<?php echo (isset($is_edit) ? $data_edit[0]['index'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Type
                    </td>
                    <td>
                        <select id="type" name="type" class="field">
                            <option value="debit" <?php echo (isset($is_edit) && $data_edit[0]['type'] == 'debit' ? "selected='selected'" : ""); ?>>Debit</option>
                            <option value="credit" <?php echo (isset($is_edit) && $data_edit[0]['type'] == 'credit' ? "selected='selected'" : ""); ?>>Credit</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>