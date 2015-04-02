<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
    $(document).ready(function(){
        $("#cr-date").jqxDateTimeInput({width: '250px', height: '25px'});

        <?php if(isset($is_edit)) :?>
        $("#cr-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date'])) . "'" ?>);
        <?php endif; ?>
    });

    function SaveData()
    {
        var data_post = {};

        // data_post[''] = $("#").val();
        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_cash_register'] = $("#id_cash_register").val();
        data_post['date'] = $("#cr-date").val('date').format('yyyy-mm-dd');
        data_post['account'] = $("#coa-name").val().value;
        data_post['amount'] = $("#cr-amount").val();
        data_post['type'] = $("#cr-type").val();
        data_post['description'] = $("#cr-description").val();

        load_content_ajax(GetCurrentController(), 203, data_post);
    }
    function DiscardData()
    {
        load_content_ajax(GetCurrentController(), 199, null);
    }

    //=================================================================================
    //
    //   Chart of Account Input
    //
    //=================================================================================

    var urlCoa = "<?php echo base_url() ;?>coa/get_coa_list";
    var sourceCoa =
    {
        datatype: "json",
        datafields:
            [
                { name: 'id_chart_of_account'},
                { name: 'account_number'},
                { name: 'name'},
                { name: 'type'}
            ],
        id: 'id_chart_of_account',
        url: urlCoa,
        root: 'data'
    };
    var dataAdapterCoa = new $.jqx.dataAdapter(sourceCoa);

    $("#coa-name").jqxInput({ source: dataAdapterCoa, displayMember: "name", valueMember: "id_coa", height: 23});

    <?php if (isset($is_edit)): ?>
    $("#coa-name").jqxInput('val', {label: '<?php echo $data_edit[0]['account_number'] . " - " . $data_edit[0]['account_name']  ?>', value: '<?php echo $data_edit[0]['account']?>'});
    <?php endif; ?>

    $("#select-coa-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
    });

    $("#select-coa-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 400,
            selectionmode : 'singlerow',
            source: dataAdapterCoa,
            columnsresize: true,
            autoshowloadelement: false,
            sortable: true,
            filterable: true,
            showfilterrow: true,
            autoshowfiltericon: true,
            columns: [
                { text: 'Account Number', dataField: 'account_number', width: 150},
                { text: 'Name', dataField: 'name'},
                { text: 'Type', dataField: 'type', width: 100}
            ]
        });

    $("#coa-select").click(function(){
        $("#select-coa-popup").jqxWindow('open');
    });

    $('#select-coa-grid').on('rowdoubleclick', function (event)
    {
        var args = event.args;
        var data = $('#select-coa-grid').jqxGrid('getrowdata', args.rowindex);
        $('#coa-name').jqxInput('val', {label: data.account_number + " - " + data.name, value: data.id_chart_of_account});
        $("#select-coa-popup").jqxWindow('close');
    });
</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_cash_register" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_cash_register'] : '') ?>" />

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <table class="table-form">
                <tbody>
                <tr>
                    <td>
                        <div class="label">Date</div>
                        <div class="column-input">
                            <div id="cr-date"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">Chart of Account</div>
                        <div class="column-input">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="coa-name" name="coa" value="" readonly="readonly"/>
                            <button id="coa-select">...</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Amount</div>
                        <div class="column-input">
                            <input class="field" id="cr-amount" name="amount" type="text" value="<?php echo (isset($is_edit) ? $data_edit[0]['amount'] : '') ?>">
                        </div>
                    </td>
                    <td>
                        <div class="label">Type</div>
                        <div class="column-input">
                            <select id="cr-type" name="type">
                                <option value="in" <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'in' ? "selected='selected'" : "") ?>>In</option>
                                <option value="out" <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'out' ? "selected='selected'" : "") ?>>Out</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="label">Description</div>
                        <div class="column-input">
                            <textarea id="cr-description" name="description"><?php echo (isset($is_edit) ? $data_edit[0]['description'] : '') ?></textarea>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="select-coa-popup">
    <div>Select Chart of Account</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-coa-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>