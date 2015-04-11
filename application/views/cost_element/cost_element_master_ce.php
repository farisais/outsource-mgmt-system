<script>
    $(document).ready(function(){

        //=================================================================================
        //
        //   Cost Element Detail Grid
        //
        //=================================================================================
        var value_type = [
            { label: 'Numeric', value: 'numeric'},
            { label: 'Percentage', value: 'percentage'}
        ];

        var sequence_operation = [
            { label: 'Tambah', value: 'sum'},
            { label: 'Kurang', value: 'substract'},
            { label: 'Kali -> Tambah', value: 'multply_sum'},
            { label: 'Bagi -> Tambah', value: 'divide_sum'},
            { label: 'Skip', value: 'skip'},
        ];

        var element_category = [
            { label: 'Base Salary', value: 'base_salary'},
            { label: 'Employee Benefit', value: 'employee_benefit'},
            { label: 'Overtime', value: 'overtime'},
            { label: 'Jamsostek', value: 'jamsostek'},
            { label: 'Direct Cost', value: 'direct_cost'},
            { label: 'Profit', value: 'profit'},
            { label: 'PPH', value: 'pph'},
            { label: 'PPN', value: 'ppn'}
        ];

        var occurrence = [
            { label: 'Per Hour', value: 'per_hour'},
            { label: 'Per Day', value: 'per_day'},
            { label: 'Per Week', value: 'per_week'},
            { label: 'Per Month', value: 'per_month'},
            { label: 'Per Hour', value: 'per_hour'},
            { label: 'Per Year', value: 'per_year'},
            { label: 'One Time', value: 'one_time'},
            { label: 'On Termination', value: 'on_termination'},
            { label: 'Specific Condition', value: 'specific_condition'}
        ];
        var url = "<?php if(isset($is_edit)){?><?php echo base_url()?>cost_element/get_cost_element_detail_list?id=<?php echo $data_edit[0]['id_cost_element']; ?> <?php }?>";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'cost_element'},
                    { name: 'name'},
                    { name: 'description'},
                    { name: 'value_type'},
                    { name: 'value_type_name'},
                    { name: 'element_category'},
                    { name: 'sequence_operation'},
                    { name: 'value', type: 'float'},
                    { name: 'condition'},
                    { name: 'invoiceable'},
                    { name: 'occurrence'},
                    { name: 'salariable'}
                ],
            url: url ,
            root: 'data'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#ce-detail-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 250,
            selectionmode : 'singlerow',
            source: dataAdapter,
            <?php if(!isset($is_view)){ echo 'editable: true,'; }?>
            columnsresize: true,
            autoshowloadelement: false,
            autoshowfiltericon: true,
            columns: [
                { text: 'Name', dataField: 'name', width: 200},
                { text: 'Value Type', dataField: 'value_type' ,columntype: 'combobox', width: 150,
                    createeditor: function (row, value, editor) {
                        editor.jqxComboBox({ source: value_type, displayMember: 'label', valueMember: 'value' });
                    }
                },
                { text: 'Category', dataField: 'element_category', columntype: 'combobox', width: 150,
                    createeditor: function (row, value, editor) {
                        editor.jqxComboBox({ source: element_category, displayMember: 'label', valueMember: 'value' });
                    }
                },
                { text: 'Seq. Operation', dataField: 'sequence_operation', columntype: 'combobox', width: 150,
                    createeditor: function (row, value, editor) {
                        editor.jqxComboBox({ source: sequence_operation, displayMember: 'label', valueMember: 'value' });
                    }
                },
                { text: 'Value', dataField: 'value', cellsformat: 'd2', width: 150},
                { text: 'Occurrence', dataField: 'occurrence', columntype: 'combobox', width: 150,
                    createeditor: function (row, value, editor) {
                        editor.jqxComboBox({ source: occurrence, displayMember: 'label', valueMember: 'value' });
                    }
                },
                { text: 'Salariable', dataField: 'salariable', columntype: 'combobox', width: 150,
                    createeditor: function (row, value, editor) {
                        editor.jqxComboBox({ source: [{label: 'Yes', value: 1},{label: 'No', value: 0}], displayMember: 'label', valueMember: 'value' });
                    }
                },
                { text: 'Invoiceable', dataField: 'invoiceable', columntype: 'combobox', width: 150,
                    createeditor: function (row, value, editor) {
                        editor.jqxComboBox({ source: [{label: 'Yes', value: 1},{label: 'No', value: 0}], displayMember: 'label', valueMember: 'value' });
                    }
                },
                { text: 'Condition', dataField: 'condition', width: 200},
            ]
        });

        $("#add-detail").click(function(){
            var data = {};
            data['name'] = null;
            data['description'] = null;
            data['value_type'] = null;
            data['element_category'] = null;
            data['sequence_operation'] = null;
            data['value'] = null;

            $("#ce-detail-grid").jqxGrid('addrow', null, data);
        });
        $("#remove-detail").click(function(){
            var selectedrowindex = $("#ce-detail-grid").jqxGrid('getselectedrowindex');
            if (selectedrowindex >= 0) {
                var id = $("#ce-detail-grid").jqxGrid('getrowid', selectedrowindex);
                var commit1 = $("#ce-detail-grid").jqxGrid('deleterow', id);
            }
        });

        $("#ce-detail-grid").on('rowdoubleclick', function(event){
            //alert(JSON.stringify($("#ce-detail-grid").jqxGrid('getrowdata', event.args.rowindex)));
        });

        $("#move-up").click(function(){
            var selectedrowindex = $("#ce-detail-grid").jqxGrid('getselectedrowindex');
            if (selectedrowindex > 0)
            {
                var data_move_up = $("#ce-detail-grid").jqxGrid('getrowdata', selectedrowindex);
                var ob_key = Object.keys(data_move_up);
                for(i=0;i<ob_key.length;i++)
                {
                    if(ob_key[i] != 'uid')
                    {
                        var valueTemp = $("#ce-detail-grid").jqxGrid('getcellvalue', selectedrowindex - 1, ob_key[i]);
                        $("#ce-detail-grid").jqxGrid('setcellvalue', selectedrowindex - 1, ob_key[i], data_move_up[ob_key[i]]);
                        $("#ce-detail-grid").jqxGrid('setcellvalue', selectedrowindex, ob_key[i], valueTemp);
                    }
                }
            }
            else
            {
                alert("Select row first");
            }
        });

        $("#move-down").click(function(){
            var selectedrowindex = $("#ce-detail-grid").jqxGrid('getselectedrowindex');
            if (selectedrowindex < $("#ce-detail-grid").jqxGrid('getrows').length)
            {
                var data_move_down = $("#ce-detail-grid").jqxGrid('getrowdata', selectedrowindex);
                var ob_key = Object.keys(data_move_down);
                for(i=0;i<ob_key.length;i++)
                {
                    if(ob_key[i] != 'uid')
                    {
                        var valueTemp = $("#ce-detail-grid").jqxGrid('getcellvalue', selectedrowindex + 1, ob_key[i]);
                        $("#ce-detail-grid").jqxGrid('setcellvalue', selectedrowindex + 1, ob_key[i], data_move_down[ob_key[i]]);
                        $("#ce-detail-grid").jqxGrid('setcellvalue', selectedrowindex, ob_key[i], valueTemp);
                    }
                }
            }
            else
            {
                alert("Select row first");
            }
        });

        <?php if(!isset($is_view)){ ?>
        //=================================================================================
        //
        //   Invoice Simulation Grid
        //
        //=================================================================================

        $("#invoice-simulation-grid").jqxGrid(
        {
            theme: $("#theme").val(),
            width: '100%',
            height: 250,
            selectionmode: 'singlerow',
            columnsresize: true,
            autoshowloadelement: false,
            sortable: true,
            autoshowfiltericon: true,
            columns: [
                {text: 'Name', dataField: 'name', width: 200},
                {text: 'Value', dataField: 'value', cellsformat: 'd2', width: 200},
                {text: 'Calc. Value', dataField: 'calc_value', cellsformat: 'd2', width: 200},
                {text: 'Aggregate Value', dataField: 'aggregate', cellsformat: 'd2', width: 200}
            ]
        });

        $("#simulate-invoice").click(function(){
            $("#invoice-simulation-grid").jqxGrid('clear');
            var data = $("#ce-detail-grid").jqxGrid('getrows');
            var aggregate = 0;
            var temp_grid = [];
            for(i=0;i<data.length;i++)
            {
                if(data[i]['sequence_operation'] != 'skip' && data[i]['occurrence'] == 'per_month' && data[i]['invoiceable'] == 1)
                {
                    var data_input = {};
                    data_input['name'] = data[i]['name'];
                    data_input['value'] = data[i]['value'];
                    switch(data[i]['sequence_operation'])
                    {
                        case 'sum':
                            data_input['calc_value'] = data[i]['value'];
                            aggregate += data[i]['value'];
                            break;
                        case 'multply_sum':
                            if(data[i]['condition'] != '' && data[i]['condition'] != null)
                            {
                                try
                                {
                                    var condition = JSON.parse(data[i]['condition']);
                                }
                                catch(err)
                                {
                                    alert(err);
                                }

                                if(condition.previous_value != null)
                                {
                                    var count = parseInt(condition.previous_value.length);
                                    var grid = temp_grid;
                                    for(j=0;j<count;j++)
                                    {
                                        for(k=0;k<grid.length;k++)
                                        {
                                            if(grid[k]['name'] == condition.previous_value[j])
                                            {
                                                var val = grid[k]['calc_value'] * data[i]['value'];
                                                data_input['calc_value'] = val;
                                                aggregate += val;
                                                break;
                                            }
                                        }
                                    }
                                }
                                else
                                {
                                    var val = aggregate * data[i]['value'];
                                    data_input['calc_value'] = val;
                                    aggregate += val;
                                }
                            }
                            else
                            {
                                var val = aggregate * data[i]['value'];
                                data_input['calc_value'] = val;
                                aggregate += val;
                            }
                            break;
                    }
                    data_input['aggregate'] = aggregate;
                    temp_grid.push(data_input);

                    $("#invoice-simulation-grid").jqxGrid('addrow', null, data_input);
                }
            }
            //$("#total-simulate-invoice").html(aggregate);
        });

        function get_value_cegrid(grid, inputcol, value, returncol)
        {
            var data = grid;
            for(i=0;i<data.length;i++)
            {
                var val = data[i][inputcol];
                if(val == value)
                {
                    return data[i][returncol];
                }
            }
            return null;
        }

        <?php } ?>

        //=================================================================================
        //
        //   Tabs Initialisation
        //
        //=================================================================================

        //$('#ce-tabs').jqxTabs({ width: '100%', position: 'top', scrollPosition: 'right'});

        <?php if(!isset($is_view)){ ?>
        //=================================================================================
        //
        //   CE Existing
        //
        //=================================================================================

        var url_existing = "<?php echo base_url()?>cost_element/get_cost_element_list";
        var source_existing =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_cost_element'},
                    { name: 'name'},
                    { name: 'description'},
                    { name: 'date_create', type: 'date'}
                ],
            id: 'id_cost_element',
            url: url_existing,
            root: 'data'
        };
        var dataAdapterExisting = new $.jqx.dataAdapter(source_existing);
        $("#ce-existing-grid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: '100%',
                source: dataAdapterExisting,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: [
                    { text: 'Name', dataField: 'name'},
                    { text: 'Description', dataField: 'description'},
                    { text: 'Date Create', dataField: 'date_create', cellsformat: 'dd/MM/yyyy', width: 100},
                ]
            });

        $("#ce-existing-grid").on('rowdoubleclick', function(event){
            $("#ce-existing-popup").jqxWindow('close');
            var args = event.args;
            var rowindex = args.rowindex;

            var data_copy = $(this).jqxGrid('getrowdata', rowindex);

            $("#name").val(data_copy['name']);
            $("#description").val(data_copy['description']);

            //insert detatil
            url = "<?php echo base_url() ?>cost_element/get_cost_element_detail_list?id=" + data_copy['id_cost_element'];
            source =
            {
                datatype: "json",
                datafields:
                    [
                        { name: 'cost_element'},
                        { name: 'name'},
                        { name: 'description'},
                        { name: 'value_type'},
                        { name: 'value_type_name'},
                        { name: 'element_category'},
                        { name: 'sequence_operation'},
                        { name: 'value', type: 'float'},
                        { name: 'condition'},
                        { name: 'invoiceable'},
                        { name: 'occurrence'},
                        { name: 'salariable'}
                    ],
                url: url ,
                root: 'data'
            };
            dataAdapter = new $.jqx.dataAdapter(source);
            $("#ce-detail-grid").jqxGrid({source: dataAdapter});
            $("#ce-detail-grid").jqxGrid('refreshdata');

        });

        $("#ce-existing-popup").jqxWindow({
            width: 600, height: 500, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
        });

        $("#copy-existing").click(function(){
            $("#ce-existing-popup").jqxWindow('open');
        });

        <?php } ?>
    });



    function SaveData()
    {
        var data_post = {};

        data_post['name'] = $("#name").val();
        data_post['description'] = $("#description").val();
        data_post['detail_cost_element'] = $("#ce-detail-grid").jqxGrid('getrows');

        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_cost_element'] = $("#id_cost_element").val();

        //alert(JSON.stringify(data_post));
        load_content_ajax(GetCurrentController(), 'save_edit_cost_element', data_post);

    }
    function DiscardData()
    {
        /*var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = 1;
        param.push(item);
        load_content_ajax(GetCurrentController(), 'edit_cost_element' , {}, param, true);*/
        load_content_ajax(GetCurrentController(), 'view_cost_element_2' , null);
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
<input type="hidden" id="id_cost_element" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_cost_element'] : '') ?>" />
<?php if(!isset($is_view)) { ?>
<div class="document-action">
    <button style="margin-left: 20px;" id="copy-existing">Copy Existing</button>
</div>
<?php } ?>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div><h1 style="font-size: 18pt; font-weight: bold;">Cost Element / <span><?php echo (isset($is_edit) ? $data_edit[0]['id_cost_element'] : ''); ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td class="label">
                        Name
                    </td>
                    <td class="column-input" colspan="3">
                        <input class="field" type="text" id="name" name="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '') ?>" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Description
                    </td>
                    <td class="column-input" colspan="3">
                        <input class="field" type="text" id="description" name="uname" value="<?php echo (isset($is_edit) ? $data_edit[0]['description'] : '') ?>" <?php if(isset($is_view)){ echo 'disabled=disabled';} ?>/>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row-color" style="width: 100%;">
                            <?php if(!isset($is_view)){?>
                            <button style="width: 30px;" id="add-detail">+</button>
                            <button style="width: 30px;" id="remove-detail">-</button>
                            <div style="display: inline;"><span>Add / Remove Detail</span></div>
                            <button style="width: 30px;float:right" id="move-down">V</button>
                            <button style="width: 30px;float:right" id="move-up">A</button>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="ce-detail-grid"></div>
                    </td>
                </tr>
                <?php if(!isset($is_view)) { ?>
                <tr>

                </tr>
                <tr>
                    <td colspan="4">
                        <span>Below is the invoice simulation for 1 qty. Click on "Begin" to begin the simulation</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input type="checkbox" id="ask_invoice" style="display: inline"/>Ask on Invoice
                        <input type="checkbox" id="per_year" style="display: inline"/>Include per year
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row-color" style="width: 100%;">
                            <button style="width: 60px;" id="simulate-invoice">Begin</button>
                            <div style="display: inline;"><span>Invoice Simulation</span></div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <div id="invoice-simulation-grid"></div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<div id="ce-existing-popup">
    <div>Select Existing Cost Element to Copy</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="ce-existing-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>