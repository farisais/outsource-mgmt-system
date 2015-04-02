<script>
$(document).ready(function(){
    
    $("#add-vehicle").click(function(){
        var data_init = {};
        data_init['vehicle_type'] = null;
        data_init['merk'] = null;
        data_init['year'] = null;
        data_init['owner'] = null;
        var commit0 = $("#transport-grid").jqxGrid('addrow', null, data_init);
    });
    $("#remove-vehicle").click(function(){
        var selectedrowindex = $("#transport-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#transport-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#transport-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    //=================================================================================
    //
    //   Transport Grid
    //
    //=================================================================================
    
    var year = [
    <?php
    for($i=0;$i<100;$i++)
    {
        echo '{ value: "'. (intval(date("Y")) - $i) .'", label: "'. (intval(date("Y")) - $i) .'" },';
    }
    ?>
    ];
    
    var employee_transportation = 
    <?php if(isset($is_edit))
    {
        echo json_encode($employee_transportation);
    }
    else
    {
        echo '[]';
    }
    ?>;
    var sourceTransportation = 
    {
        datatype: 'json',
        datafields:
        [
            { name: 'id_employee_vehicle'},
            { name: 'vehicle_type_name'},
            { name: 'vehicle_type'},
            { name: 'merk'},
            { name: 'year'},
            { name: 'owner'},
            { name: 'owner_name'},
        ],
        id: 'id_employee_vehicle',
        localdata: employee_transportation 
    };
    
    var dataAdapterTransportation = new $.jqx.dataAdapter(sourceTransportation);
    
    $("#transport-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterTransportation,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Type', dataField: 'vehicle_type', displayField: 'vehicle_type_name',width: 200, columntype: 'dropdownlist',
                createeditor: function(row, value, editor)
                {
                    editor.jqxDropDownList({ source: [{value:'car',label:'Car'},{value:'motorcycle',label:'Motor Cycle'},{value:'bicycle',label:'Bicycle'}], displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Brand', dataField: 'merk', width: 200},
            { text: 'Year', dataField: 'year', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: year, displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Owning', dataField: 'owner', displayField: 'owner_name',columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: [{value:'private_own',label:'Private Own'},{value:'others',label:'Others'}], displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
        ]
    });
    
});
</script>
<table class="table-form" style="margin: 20px; width: 90%;">
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-vehicle">+</button>
                <button id="remove-vehicle">-</button>
                <span>Add Vehicle</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="transport-grid"></div>
        </td>
    </tr>
</table>