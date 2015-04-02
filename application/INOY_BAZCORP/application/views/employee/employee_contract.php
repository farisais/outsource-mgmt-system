<script type="text/javascript">
$(document).ready(function(){
    $("#phase-add-window").jqxWindow({
        width: 600, height: 300, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    
    $("#add-phase").click(function(){
        var offset = $("#add-phase").offset();
        $("#phase-add-window").jqxWindow({ position: { x: parseInt(offset.left) + $("#add-phase").width() + 20, y: parseInt(offset.top)} });
        $("#phase-add-window").jqxWindow('open');
    });
    
    $("#remove-phase").click(function(){
        var selectedrowindex = $("#contract-phase-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#contract-phase-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#contract-phase-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    $("#join-date").jqxDateTimeInput({width: '250px', height: '25px', value: null}); 
    $("#end-date").jqxDateTimeInput({width: '250px', height: '25px', value: null}); 
    
    <?php
    if(isset($is_edit))
    {?>
    $("#join-date").jqxDateTimeInput('val', '<?php echo $employee_contract[0]['join_date'] ?>'); 
    $("#end-date").jqxDateTimeInput('val', '<?php echo $employee_contract[0]['end_date'] ?>'); 
    <?php 
    }
    ?>
    
    //=================================================================================
    //
    //   Contract Phase Grid
    //
    //=================================================================================

    var employee_phase = 
    <?php if(isset($is_edit))
    {
        echo json_encode($employee_contract_detail);
    }
    else
    {
        echo '[]';
    }
    ?>;
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_employee_contract_phase'},
            { name: 'contract_phase_type'},
            { name: 'contract_phase_type_name'},
            { name: 'start_date', type: 'date', format: "yyyy-MM-dd"},
            { name: 'end_date', type: 'date', format: "yyyy-MM-dd"},
            { name: 'status'},
        ],
        id: 'id',
        localdata: employee_phase
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#contract-phase-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 250,
        source: dataAdapter,
        selectionmode : 'singlerow',
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Name', dataField: 'contract_phase_type_name'},
            { text: 'Start Date', dataField: 'start_date', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'End Date', dataField: 'end_date', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
        ]
    });
    
    $("#contract-phase-grid").jqxGrid('setcolumnproperty', 'contract_phase_type_name', 'editable', false);
    
    //=================================================================================
    //
    //   Phase Type Grid
    //
    //=================================================================================

    var url_phase = "<?php echo base_url() ?>employee/get_employee_contract_phase_type_list";
    var source_phase =
    {
        datatype: "json",
        datafields:
        [
            { name: 'contract_phase_type'},
            { name: 'contract_phase_type_name'},
            { name: 'abv'},
        ],
        id: 'id',
        url: url_phase,
        root: 'data'
    };
    var dataAdapter_phase = new $.jqx.dataAdapter(source_phase);
    $("#select-phase-type-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 250,
        source: dataAdapter_phase,
        selectionmode : 'singlerow',
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Name', dataField: 'contract_phase_type_name'},
            { text: 'abv', dataField: 'abv', width: 200}
        ]
    });
    
    $('#select-phase-type-grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select-phase-type-grid').jqxGrid('getrowdata', args.rowindex);
        data['start_date'] = null;
        data['end_date'] = null;
        var commit0 = $("#contract-phase-grid").jqxGrid('addrow', null, data);
        $("#phase-add-window").jqxWindow('close');
    });
    
    //=================================================================================
    //
    //   Position
    //
    //=================================================================================
    
    var position = [
    <?php
    foreach($position as $p)
    {
        echo '{ value: "'. $p['id_organisation_structure'] .'", label: "'. $p['structure_name'] .'"},';
    }
    ?>
    ];
    $("#position").jqxDropDownList({ source: position, displayMember: 'label', valueMember: 'value', filterable: true });
    
    var position_level = [
    <?php
    foreach($position_level as $p)
    {
        echo '{ value: "'. $p['id_position_level'] .'", label: "'. $p['name'] .'"},';
    }
    ?>
    ];
    $("#position-level").jqxDropDownList({ source: position_level, displayMember: 'label', valueMember: 'value', filterable: true });
    
    var contract_type = [
    <?php
    foreach($contract_type as $p)
    {
        echo '{ value: "'. $p['id_employee_contract_type'] .'", label: "'. $p['name'] .'"},';
    }
    ?>
    ];
    $("#contract-type").jqxDropDownList({ source: contract_type, displayMember: 'label', valueMember: 'value', filterable: true });
    
    <?php
    if(isset($is_edit))
    {?>
    $("#position").jqxDropDownList('val', <?php echo ($employee_contract[0]['position'] == null ? null :  $employee_contract[0]['position'])?>);
    $("#position-level").jqxDropDownList('val', <?php echo ($employee_contract[0]['position_level'] == null ? null : $employee_contract[0]['position_level']) ?>);
    $("#contract-type").jqxDropDownList('val', '<?php echo ($data_edit[0]['employee_contract_type'] == null ? null : $data_edit[0]['employee_contract_type']) ?>');
    <?php 
    }
    ?>
    
    //=================================================================================
    //
    //   Contract Document
    //
    //=================================================================================
    
     $("#add-contract").click(function(){
        $('#contract-file').trigger('click');
    });
    
    $("#contract-file").change(function(){
        var data = {};
        data['filename'] = $('#contract-file').val();
        data['remark'] = '';
        var commit0 = $("#contract-document-grid").jqxGrid('addrow', null, data);
    })
    $("#remove-contract").click(function(){
        var selectedrowindex = $("#contract-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#contract-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#contract-grid").jqxGrid('deleterow', id);
        }
    });
        
    $("#contract-document-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 100,
        selectionmode : 'singlerow',
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns : [
            { text: 'Filename', dataField: 'filename'},
            { text: 'Remark', dataField: 'remark'}
        ]
    });
    
});
</script>
<table class="table-form" style="margin: 20px; width: 90%;">
    <tr>
        <td class="label">
            Contract Number
        </td>
         <td colspan="3">
            <input style="display: inline; width: 70%" type="text" class="field" id="contract-number" value="<?php echo (isset($is_edit) ? $employee_contract[0]['contract_number'] : '') ?>"/><button style="margin-left: 2px;" id="auto-generate">></button>
            <input type="checkbox" style="display:inline" />Save Draft
        </td>
    </tr>
    <tr>
       <td class="label">
            Join Date
        </td>
         <td>
            <div id="join-date"></div>
        </td>
        <td class="label second-column">
            End Date
        </td>
         <td>
            <div id="end-date"></div>
        </td> 
    </tr>
    <tr>
        <td class="label">
            Position
        </td>
         <td>
            <div id="position"></div>
        </td>
        <td class="label second-column">
            Level
        </td>
         <td>
            <div id="position-level"></div>
        </td> 
    </tr>
    
    <tr>
        <td class="label">
            Contract Type
        </td>
         <td colspan="3">
            <div id="contract-type"></div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-phase">+</button>
                <button id="remove-phase">-</button>
                <span>Contract Phase</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="contract-phase-grid"></div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-contract">+</button>
                <button id="remove-contract">-</button>
                <span>Contract Document</span>
                <input type="file" style="display:none;" id="contract-file">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="contract-document-grid"></div>
        </td>
    </tr>
</table>
<div id="phase-add-window">
    <div>Add Phase</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-phase-type-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>