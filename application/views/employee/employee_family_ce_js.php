<script>
$(document).ready(function(){
    
    $("#add-sibling").click(function(){
        var data_init = {};
        data_init['relation'] = null;
        data_init['relation_name'] = null;
        data_init['name'] = null;
        data_init['last_education_level'] = null;
        data_init['last_employment_position'] = null;
        data_init['last_employment_position'] = null;
        var commit0 = $("#family-grid").jqxGrid('addrow', null, data_init);
    });
    $("#remove-sibling").click(function(){
        var selectedrowindex = $("#family-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 2) {
            var id = $("#family-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#family-grid").jqxGrid('deleterow', id);
        }
        else
        {
            alert('Cannot delete this row');
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
    
    var url = "";
    var year = [
    <?php
    for($i=0;$i<100;$i++)
    {
        echo '{ value: "'. (intval(date("Y")) - $i) .'", label: "'. (intval(date("Y")) - $i) .'" },';
    }
    ?>
    ];
    var sourceYear =
    {
        datatype: "array",
        datafields:
        [
            { name: 'label'},
            { name: 'value'},
        ],
        localdata: year,
    };
    var dataAdapterYear = new $.jqx.dataAdapter(sourceYear);
    
    var urlLevel = "<?php echo base_url() ?>employee/get_education_level_list";
    var sourceLevel =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_education_level'},
            { name: 'level_name'},
        ],
        id: 'id',
        url: urlLevel,
        root: 'data'
    };
    var dataAdapterLevel = new $.jqx.dataAdapter(sourceLevel);
    
    var employee_family = 
    <?php if(isset($is_edit))
    {
        echo json_encode($employee_family);
    }
    else
    {
        echo '[]';
    }
    ?>;
    var sourceFamily = 
    {
        datatype: 'json',
        datafields:
        [
            { name: 'id_employee_family'},
            { name: 'relation'},
            { name: 'relation_name'},
            { name: 'name'},
            { name: 'birth_place'},
            { name: 'birth_place_name'},
            { name: 'birth_date', type: 'date', format: "yyyy-MM-dd"},
            { name: 'last_education_level'},
            { name: 'last_education_level_name'},
            { name: 'last_employment_position'},
            { name: 'last_employment_company'},
        ],
        id: 'id_employee_family',
        localdata: employee_family    
    };
    
    var dataAdapterFamily = new $.jqx.dataAdapter(sourceFamily);
    
    $("#family-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterFamily,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Relation', dataField: 'relation', displayField: 'relation_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: [{value:"brother",label:"Brother"},{value:"sister",label:"Sister"}], 
                    displayMember: 'label', valueMember: 'value', filterable: true });
                },
                cellbeginedit: function (row, datafield, columntype, value) 
                {
                    if (row == 0 || row == 1) return false;
                }
            },
            { text: 'Name', dataField: 'name', width: 200},           
            { text: 'Birth Place', dataField: 'birth_place', displayField : 'birth_place_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: city, displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Birth Date', dataField: 'birth_date', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'Last Education', dataField: 'last_education_level', displayField: 'last_education_level_name',columntype: 'dropdownlist', width:100,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: dataAdapterLevel, displayMember: 'level_name', valueMember: 'id_education_level' });
                }
            },
            { text: 'Last Employment Position', dataField: 'last_employment_position', width: 200},
            { text: 'Last Employment Company', dataField: 'last_employment_company', width: 200},
            { text: 'Remarks', dataField: 'remarks', width: 300}
        ]
    });
    
    <?php
    if(!isset($is_edit))
    {?>
    /*var data_init = {};
    data_init['relation'] = 'father';
    data_init['relation_name'] = 'Father';
    data_init['name'] = null;
    data_init['last_education_level'] = null;
    data_init['last_employment_company'] = null;
    data_init['last_employment_position'] = null;
    
    var commit = $("#family-grid").jqxGrid('addrow', null, data_init);
    
    data_init = {};
    data_init['relation'] = 'mother';
    data_init['relation_name'] = 'Mother';
    data_init['name'] = null;
    data_init['last_education_level'] = null;
    data_init['last_employment_company'] = null;
    data_init['last_employment_position'] = null;
    
    var commit1 = $("#family-grid").jqxGrid('addrow', null, data_init);*/
    <?php  
    }
    ?>
    
    
    
    //=================================================================================
    //
    //   Course Grid
    //
    //=================================================================================
    
    $("#add-member").click(function(){
        var data_init = {};
        data_init['relation'] = null;
        data_init['relation_name'] = null;
        data_init['name'] = null;
        data_init['gender'] = null;
        data_init['gender_name'] = null;
        data_init['birth_place'] = null;
        data_init['birth_date'] = null;
        data_init['blood_type'] = null;
        data_init['last_education_level'] = null;
        data_init['last_employment_position'] = null;
        data_init['last_employment_position'] = null;
        var commit0 = $("#marital-grid").jqxGrid('addrow', null, data_init);
    });
    $("#remove-member").click(function(){
        var selectedrowindex = $("#marital-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#marital-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#marital-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    var city = [
        <?php
        foreach($cities as $city)
        {
            echo '{ value: "'. $city['id_city'] .'", label: "'. $city['name'] .'"},';
        }
        ?> 
    ];
    
   	var employee_marital = 
    <?php if(isset($is_edit))
    {
        echo json_encode($employee_marital);
    }
    else
    {
        echo '[]';
    }
    ?>;
    var sourceMarital = 
    {
        datatype: 'json',
        datafields:
        [
            { name: 'id_employee_marital'},
            { name: 'relation'},
            { name: 'relation_name'},
            { name: 'gender'},
            { name: 'gender_name'},
            { name: 'blood_type'},
            { name: 'blood_type_name'},
            { name: 'name'},
            { name: 'birth_place'},
            { name: 'birth_place_name'},
            { name: 'birth_date', type: 'date', format: "yyyy-MM-dd"},
            { name: 'last_education_level'},
            { name: 'last_education_level_name'},
            { name: 'last_employment_position'},
            { name: 'last_employment_company'},
        ],
        id: 'id_employee_marital',
        localdata: employee_marital    
    };
    
    var dataAdapterMarital = new $.jqx.dataAdapter(sourceMarital);
    
    $("#marital-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterMarital,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Relation', dataField: 'relation', displayField: 'relation_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: [{value:"husband",label:"Husband"},{value:"wife",label:"Wife"},{value:"child",label:"Child"}], 
                    displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Name', dataField: 'name', width: 200},
            { text: 'Gender', dataField: 'gender', displayField: 'gender_name',columntype: 'dropdownlist', width:100,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: [{value:"male",label:"Male"},{value:"female",label:"Female"}], displayMember: 'label', 
                    valueMember: 'value' });
                }
            },
            { text: 'Birth Place', dataField: 'birth_place', displayField : 'birth_place_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: city, displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Birth Date', dataField: 'birth_date', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'Blood Type', dataField: 'blood_type', displayField : 'blood_type_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: [
                        {value:"a",label:"A"},
                        {value:"b",label:"B"},
                        {value:"ab",label:"AB"},
                        {value:"o",label:"O"},
                    ], 
                    displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Last Education', dataField: 'last_education_level', displayField: 'last_education_level_name',columntype: 'dropdownlist', width:100,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: dataAdapterLevel, displayMember: 'level_name', valueMember: 'id_education_level' });
                }
            },
            { text: 'Last Employment Position', dataField: 'last_employment_position', width: 200},
            { text: 'Last Employment Company', dataField: 'last_employment_company', width: 200}
        ]
    });
    
    $("#marital-date").jqxDateTimeInput({width: '250px', height: '25px', value: null});
    
    $("#select-marital-status").jqxDropDownList({ source: [{value:"single",label:"Single"},{value:"married",label:"Married"},{value:"divorce",label:"Divorce"},{value:"widow(er)",label:"Widow / Widower"}], 
    displayMember: 'label', valueMember: 'value', filterable: true });
    
    $("#marital-grid").on('rowdoubleclick', function(event){
        alert(JSON.stringify($("#marital-grid").jqxGrid('getrowdata', event.args.rowsindex)));
    });
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#marital-date").jqxDateTimeInput('val', '<?php echo $data_edit[0]['marital_date']?>');
    $("#select-marital-status").jqxDropDownList('val', '<?php echo $data_edit[0]['marital_status']?>');
    <?php 
    }
    ?>
            
    
    $('#select-marital-status').on('change', function (event)
    {     
        var args = event.args;
        if (args) {                     
            if(args.item.value == 'single')
            {
                $("#marital-date").css("display", "none");
                $("#marital-grid").css("display", "none");
                $("#marital-action").css("display", "none");
            }
            else
            {
                $("#marital-date").css("display", "");
                $("#marital-grid").css("display", "");
                $("#marital-action").css("display", "");
            }
        } 
    });

});
</script>
