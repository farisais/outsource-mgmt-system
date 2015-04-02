<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
    $(document).ready(function(){

    });

    function SaveData()
    {
        var data_post = {};

        // data_post[''] = $("#").val();

        load_content_ajax(GetCurrentController(), 203, data_post);

    }
    function DiscardData()
    {
        load_content_ajax(GetCurrentController(), 154, null);
    }

    //=================================================================================
    //
    //   Working Schedule Assignment Grid
    //
    //=================================================================================

    var urlWS = "";
    var sourceWS =
    {
        datatype: "json",
        datafields:
            [
                { name: 'id_employee'},
                { name: 'employee_number'},
                { name: 'full_name'},
                { name: 'position'},
                { name: 'position_name'},
                { name: 'position_level'},
                { name: 'position_level_name'},
                { name: 'site_location'},
                { name: 'location_name'},
                { name: 'shift1'},
                { name: 'working_hour_type'},
                { name: 'working_hour_type_name'},
                { name: 'remark', type: 'string'},
                { name: 'status'}
            ],
        id: 'id_employee',
        url: urlWS ,
        root: 'data'
    };

    $("#from-work-schedule-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 200,
            selectionmode : 'singlerow',
            columnsresize: true,
            autoshowloadelement: false,
            sortable: true,
            autoshowfiltericon: true,
            columns: [
                { text: 'Client Site', dataField: 'site', displayfield: 'site_name', width: 100},
                { text: 'Area', dataField: 'area', width: 100},
                { text: 'Location', dataField: 'site_location', displayfield: 'location_name', width: 100},
                { text: 'No. Shift', dataField: 'number_shift', width: 100},
                { text: 'Working Hour / shift', dataField: 'working_hour_type', displayfield: 'working_hour_type_name', width: 100},
                { text: 'Status', dataField: 'status', width: 100},
                { text: 'Remark', dataField: 'remark', width: 200}
            ]
        });

    $("#to-work-schedule-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 200,
            selectionmode : 'singlerow',
            columnsresize: true,
            autoshowloadelement: false,
            sortable: true,
            autoshowfiltericon: true,
            columns: [
                { text: 'Client Site', dataField: 'site', displayfield: 'site_name', width: 100},
                { text: 'Area', dataField: 'area', width: 100},
                { text: 'Location', dataField: 'site_location', displayfield: 'location_name', width: 100},
                { text: 'No. Shift', dataField: 'number_shift', width: 100},
                { text: 'Working Hour / shift', dataField: 'working_hour_type', displayfield: 'working_hour_type_name', width: 100},
                { text: 'Status', dataField: 'status', width: 100},
                { text: 'Remark', dataField: 'remark', width: 200}
            ]
        });
</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_shift_change" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_shift_change'] : '') ?>" />
<div class="document-action">
    <button id="leave-validate">Submit for assigning</button>
    <button id="leave-cancel">Cancel</button>
    <ul class="document-status">
        <li class="status-active">
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li>
            <span class="label">Assigned</span>
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
            <div class="row-color" style="width: 100%; padding: 3px;">
                <span>From Work Schedule</span>
            </div>
            &nbsp;
            <div>
                <div id="from-work-schedule-grid"></div>
            </div>
            &nbsp;
            <div class="row-color" style="width: 100%; padding: 3px;">
                <span>To Work Schedule</span>
            </div>
            &nbsp;
            <div>
                <div id="to-work-schedule-grid"></div>
            </div>
            &nbsp;
            <div class="label">
                Reason
            </div>
            <textarea class="field" id="notes" cols="10" rows="20" style="height: 50px;"></textarea>
        </div>
    </div>
</div>
