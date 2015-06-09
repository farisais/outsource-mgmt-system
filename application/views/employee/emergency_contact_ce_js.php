<script>
$(document).ready(function(){
    
    $("#add-contact").click(function(){
        var data_init = {};
        data_init['relation'] = null;
        data_init['name'] = null;
        data_init['phone'] = null;
        data_init['address'] = null;
        data_init['city'] = null;
        data_init['profession'] = null;
        var commit0 = $("#contact-grid").jqxGrid('addrow', null, data_init);
    });
    $("#remove-contact").click(function(){
        var selectedrowindex = $("#contact-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#contact-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#contact-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    //=================================================================================
    //
    //   Family Grid
    //
    //=================================================================================
    var city = [
        <?php
        foreach($cities as $city)
        {
            echo '{ value: "'. $city['id_city'] .'", label: "'. $city['name'] .'"},';
        }
        ?> 
    ];
    
    var employee_contact = 
    <?php if(isset($is_edit))
    {
        echo json_encode($employee_contact);
    }
    else
    {
        echo '[]';
    }
    ?>;
    var sourceContact = 
    {
        datatype: 'json',
        datafields:
        [
            { name: 'id_employee_emergency_contact'},
            { name: 'name'},
            { name: 'address'},
            { name: 'city'},
            { name: 'city_name'},
            { name: 'phone'},
            { name: 'profession'},
            { name: 'relation'},
        ],
        id: 'id_employee_emergency_contact',
        localdata: employee_contact    
    };
    
    var dataAdapterContact = new $.jqx.dataAdapter(sourceContact);
    
    $("#contact-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterContact,        
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Name', dataField: 'name', width: 200},
            { text: 'Address', dataField: 'address', width: 200},
            { text: 'City', dataField: 'city', displayField : 'city_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: city, displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Phone', dataField: 'phone', width: 200},
            { text: 'Profession', dataField: 'profession', width: 200},
            { text: 'relation', dataField: 'relation', width: 200}
        ]
    });
    
});
</script>
