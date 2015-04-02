<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
    $(document).ready(function(){
        $("#payroll-process-date").jqxDateTimeInput({width: '250px', height: '25px'});
        $("#payroll-period-start").jqxDateTimeInput({width: '250px', height: '25px'});
        $("#payroll-period-end").jqxDateTimeInput({width: '250px', height: '25px'});
    });

    function SaveData()
    {
        var data_post = {};

        // data_post[''] = $("#").val();

        load_content_ajax(GetCurrentController(), 183, data_post);

    }
    function DiscardData()
    {
        load_content_ajax(GetCurrentController(), 179, null);
    }

    //=================================================================================
    //
    //   Customer Input
    //
    //=================================================================================

    var urlCustomer = "<?php echo base_url() ;?>customer/get_customer_list";
    var sourceCustomer =
    {
        datatype: "json",
        datafields:
            [
                { name: 'id_ext_company'},
                { name: 'name'},
                { name: 'address'},
                { name: 'contact'}
            ],
        id: 'id_ext_company',
        url: urlCustomer,
        root: 'data'
    };
    var dataAdapterCustomer = new $.jqx.dataAdapter(sourceCustomer);

    $("#customer-name").jqxInput({ source: dataAdapterCustomer, displayMember: "name", valueMember: "id_ext_company", height: 23});

    $("#select-customer-popup").jqxWindow({
        width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
    });

    $("#select-customer-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 400,
            selectionmode : 'singlerow',
            source: dataAdapterCustomer,
            columnsresize: true,
            autoshowloadelement: false,
            sortable: true,
            filterable: true,
            showfilterrow: true,
            autoshowfiltericon: true,
            columns: [
                { text: 'Name', dataField: 'name', width: 175},
                { text: 'Address', dataField: 'address'},
                { text: 'Contact', dataField: 'contact', width: 175}
            ]
        });

    $("#customer-select").click(function(){
        $("#select-customer-popup").jqxWindow('open');
    });

    $('#select-customer-grid').on('rowdoubleclick', function (event)
    {
        var args = event.args;
        var data = $('#select-customer-grid').jqxGrid('getrowdata', args.rowindex);
        $('#customer-name').jqxInput('val', {label: data.name, value: data.id_ext_company});
        $("#select-customer-popup").jqxWindow('close');
    });

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

    $("#product-service-grid").jqxGrid(
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
                { text: 'SO Name', dataField: 'so', displayfield: 'so_name', width: 125},
                { text: 'Service', dataField: 'service', displayfield: 'service_name', width: 125},
                { text: 'Title', dataField: 'title'},
                { text: 'Working Hour', dataField: 'working_hour', displayfield: 'working_hour_name', width: 100},
                { text: 'Rate', dataField: 'rate', width: 100}
            ]
        });

</script>

<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_payroll" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_payroll'] : '') ?>" />
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
                <tbody>
                <tr>
                    <td>
                        <div class="label">Process Date</div>
                        <div class="column-input">
                            <div id="payroll-process-date"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">Customer</div>
                        <div class="column-input">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-name" name="customer" value=""/>
                            <button id="customer-select">...</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Period Start</div>
                        <div class="column-input">
                            <div id="payroll-period-start"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">Period End</div>
                        <div class="column-input">
                            <div id="payroll-period-end"></div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            &nbsp;
            <div class="row-color" style="width: 100%; padding: 3px;">
                <span>Product / Service Grid</span>
            </div>
            &nbsp;
            <div>
                <div id="product-service-grid"></div>
            </div>
            &nbsp;
        </div>
    </div>
</div>

<div id="select-customer-popup">
    <div>Select Customer</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-customer-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>