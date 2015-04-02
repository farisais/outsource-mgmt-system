<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
    $(document).ready(function(){
        $("#leave-date-from").jqxDateTimeInput({width: '250px', height: '25px'});
        $("#leave-date-to").jqxDateTimeInput({width: '250px', height: '25px'});
    });

    function SaveData()
    {
        var data_post = {};

        // data_post[''] = $("#").val();

        load_content_ajax(GetCurrentController(), 203, data_post);

    }
    function DiscardData()
    {
        load_content_ajax(GetCurrentController(), 159, null);
    }

</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_leave_application" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_leave_application'] : '') ?>" />
<div class="document-action">
    <button id="leave-validate">Submit for approval</button>
    <button id="leave-cancel">Cancel</button>
    <ul class="document-status">
        <li class="status-active">
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li>
            <span class="label">Approved</span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <table class="table-form">
                <tr>
                    <td rowspan="4">
                        <div>
                            <img class="image-field" style="width: 100px;" src="<?php echo base_url() . 'images/user-icon.png' ?>" alt="product-default"/>
                        </div>
                    </td>
                    <td class="label">
                        Employee Number
                    </td>
                    <td colspan="2">
                        <input style="display: inline; width: 83%" class="field" type="text" id="product-code" value="" /><button style="margin-left: 2px;" id="auto-generate">></button>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Full Name
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Employment Type
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="fullname" value="" />
                    </td>
                </tr>
            </table>
            &nbsp;
            <table class="table-form">
                <tbody>
                <tr>
                    <td>
                        <div class="label">Type</div>
                        <div class="column-input">
                            <select id="leave-type" class="field">
                                <option value="Vacation">Vacation</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Maternity">Maternity</option>
                            <select>
                        </div>
                    </td>
                    <td rowspan="4">
                        <div class="label">&nbsp;</div>
                        <table style="border: 1px solid #000000; width: 100%">
                            <tr style="background-color: #f5f5f5; text-align: center">
                                <td>Entitlement</td>
                                <td>B/F <?=date('Y')?></td>
                                <td>Balance Leave <?=date('Y')?></td>
                            </tr>
                            <tr style="text-align: center">
                                <td>13</td>
                                <td>0</td>
                                <td>11</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Leave Applied From Date</div>
                        <div class="column-input">
                            <div id="leave-date-from"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Leave Applied To Date</div>
                        <div class="column-input">
                            <div id="leave-date-to"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">No. of Days Applied</div>
                        <div class="column-input">
                            <input class="field" id="leave-day" name="leave_day" type="text" value="">
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="label">
                Reason
            </div>
            <textarea class="field" id="notes" cols="10" rows="20" style="height: 50px;"></textarea>
        </div>
    </div>
</div>
