<script>
$(document).ready(function(){
    
    $("#add-education").click(function(){
        var data = {};
        data['city'] = null;
        data['institution_name'] = null;
        data['from_year'] = null;
        data['to_year'] = null;
        data['education_level'] = null;
        data['graduated'] = null;
        var commit0 = $("#education-grid").jqxGrid('addrow', null, data);
    });
    $("#remove-education").click(function(){
        var selectedrowindex = $("#education-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#education-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#education-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    //=================================================================================
    //
    //   Education Grid
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
    
    var sourceGrad = ['Yes', 'No'];
    
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
    
     var employee_education = 
    <?php if(isset($is_edit))
    {
        echo json_encode($employee_education);
    }
    else
    {
        echo '[]';
    }
    ?>;
    var sourceEducation = 
    {
        datatype: 'json',
        datafields:
        [
            { name: 'id_education'},
            { name: 'institution_name'},
            { name: 'city'},
            { name: 'city_name'},
            { name: 'from_year'},
            { name: 'to_year'},
            { name: 'education_level'},
            { name: 'education_level_name'},
            { name: 'graduated'},
            { name: 'graduated_name'},
        ],
        id: 'id_education',
        localdata: employee_education
    };
    
    var dataAdapterEducation = new $.jqx.dataAdapter(sourceEducation);
    
    $("#education-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterEducation,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Institution Name', dataField: 'institution_name'},
            { text: 'City', dataField: 'city', displayField: 'city_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: city, displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'From Year', dataField: 'from_year', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: dataAdapterYear, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: 'To Year', dataField: 'to_year', columntype: 'dropdownlist',
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: dataAdapterYear, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: 'Level', dataField: 'education_level', displayField: 'education_level_name',columntype: 'dropdownlist',
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: dataAdapterLevel, displayMember: 'level_name', valueMember: 'id_education_level' });
                }
            },
            { text: 'Graduated', dataField: 'graduated',  displayField: 'graduated_name',columntype: 'dropdownlist',
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: sourceGrad, selectedIndex: 1 });
                }
            },
        ]
    });
    
    //=================================================================================
    //
    //   Course Grid
    //
    //=================================================================================
    
     $("#add-course").click(function(){
        var data = {};
        data['provider'] = null;
        data['field'] = null;
        data['city'] = null;
        data['year'] = null;
        data['supported_by'] = null;
        data['remarks'] = null;
        var commit0 = $("#course-grid").jqxGrid('addrow', null, data);
    });
    $("#remove-course").click(function(){
        var selectedrowindex = $("#course-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#course-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#course-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    var sourceUOMDate = [
        <?php
        foreach($unit_of_measure as $at)
        {
            echo '{ value: "'. $at['id_unit_measure'] .'", label: "'. $at['name'] .'"},';
        }
        ?>
    ];
    
     var employee_course = 
    <?php if(isset($is_edit))
    {
        echo json_encode($employee_course);
    }
    else
    {
        echo '[]';
    }
    ?>;
    var sourceCourse = 
    {
        datatype: 'json',
        datafields:
        [
            { name: 'id_employee_course'},
            { name: 'name'},
            { name: 'provider'},
            { name: 'field'},
            { name: 'city'},
            { name: 'city_name'},
            { name: 'duration'},
            { name: 'duration_uom'},
            { name: 'duration_uom_name'},
            { name: 'year'},
            { name: 'supported_by'},
            { name: 'supported_by_name'},
            { name: 'remarks'}
        ],
        id: 'id_employee_course',
        localdata: employee_course     
    };
    
    var dataAdapterCourse = new $.jqx.dataAdapter(sourceCourse);
    
    $("#course-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterCourse,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Course Name', dataField: 'name', width: 100},
            { text: 'Provider Name', dataField: 'provider', width: 100},
            { text: 'Field', dataField: 'field', width: 100},
            { text: 'City', dataField: 'city', displayField : 'city_name', columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: city, displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Duration', dataField: 'duration', columntype: 'numberinput', width: 100},
            { text: 'Measure', dataField: 'duration_uom', displayField : 'duration_uom_name', columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: sourceUOMDate, displayMember: 'label', valueMember: 'value',filterable: true  });
                }
            },
            { text: 'Year', dataField: 'year', columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: dataAdapterYear, displayMember: 'label', valueMember: 'value',filterable: true  });
                }
            },
            { text: 'Supported By', dataField: 'supported_by', displayField: 'supported_by_name',columntype: 'dropdownlist', width: 200,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: [{value:"private",label:"Private"},{value:"company",label:"Company"}], displayMember: 'label', valueMember: 'value',filterable: true  });
                }
            },
            { text: 'Remarks', dataField: 'remarks', width: 300}
        ]
    });
    
    $("#course-grid").on('rowdoubleclick', function(event){
        alert(JSON.stringify($("#course-grid").jqxGrid('getrowdata', event.args.rowsindexe)));
    });
    
    //=================================================================================
    //
    //   Language Grid
    //
    //=================================================================================
    
    var language = [
        <?php
        foreach($language as $at)
        {
            echo '{ value: "'. $at['id_languages'] .'", label: "'. $at['name'] .'"},';
        }
        ?>
    ];
    
    var fluency = [
        <?php
        foreach($language_fluency as $at)
        {
            echo '{ value: "'. $at['id_language_fluency'] .'", label: "'. $at['name'] .'"},';
        }
        ?>
    ];
    
    var employee_language = 
    <?php if(isset($is_edit))
    {
        echo json_encode($employee_language);
    }
    else
    {
        echo '[]';
    }
    ?>;
    var sourceLanguage = 
    {
        datatype: 'json',
        datafields:
        [
            { name: 'id_employee_languages'},
            { name: 'language'},
            { name: 'language_name'},
            { name: 'reading'},
            { name: 'reading_name'},
            { name: 'hearing'},
            { name: 'hearing_name'},
            { name: 'writing'},
            { name: 'writing_name'},
            { name: 'speaking'},
            { name: 'speaking_name'},
            { name: 'remarks'}
        ],
        id: 'id_employee_languages',
        localdata: employee_language    
    };
    
    var dataAdapterLanguage = new $.jqx.dataAdapter(sourceLanguage);
    
    $("#add-language").click(function(){
        var data = {};
        data['language'] = null;
        data['hearing'] = null;
        data['reading'] = null;
        data['speaking'] = null;
        data['writing'] = null;
        data['remarks'] = null;
        var commit0 = $("#language-grid").jqxGrid('addrow', null, data);
    });
    $("#remove-language").click(function(){
        var selectedrowindex = $("#language-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#language-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#language-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    $("#language-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterLanguage,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Language', dataField: 'language', displayField: 'language_name',columntype: 'dropdownlist', width: 200,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: language, displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Hearing', dataField: 'hearing', displayField: 'hearing_name',columntype: 'dropdownlist', width: 150,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: fluency, displayMember: 'label', valueMember: 'value', filterable: true });
                }
            },
            { text: 'Reading', dataField: 'reading', displayField: 'reading_name',columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: fluency, displayMember: 'label', valueMember: 'value',filterable: true  });
                }
            },
            { text: 'Speaking', dataField: 'speaking', displayField: 'speaking_name',columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: fluency, displayMember: 'label', valueMember: 'value',filterable: true  });
                }
            },
            { text: 'Writing', dataField: 'writing', displayField: 'writing_name',columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: fluency, displayMember: 'label', valueMember: 'value',filterable: true  });
                }
            },
            { text: 'Remarks', dataField: 'remarks', width: 300}
        ]
    });
    
    //=================================================================================
    //
    //   Social Grid
    //
    //=================================================================================
    
    $("#add-social").click(function(){
        var data = {};
        data['organisation'] = null;
        data['activities'] = null;
        data['position'] = null;
        data['year'] = null;
        var commit0 = $("#social-grid").jqxGrid('addrow', null, data);
    });
    $("#remove-social").click(function(){
        var selectedrowindex = $("#social-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#social-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#social-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    var employee_social = 
    <?php if(isset($is_edit))
    {
        echo json_encode($employee_social);
    }
    else
    {
        echo '[]';
    }
    ?>;
    var sourceSocial = 
    {
        datatype: 'json',
        datafields:
        [
            { name: 'id_employee_social'},
            { name: 'organisation'},
            { name: 'activities'},
            { name: 'position'},
            { name: 'year'},
        ],
        id: 'id_employee_social',
        localdata: employee_social    
    };
    
    var dataAdapterSocial = new $.jqx.dataAdapter(sourceSocial);
    
    $("#social-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapterSocial,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Organisation Name', dataField: 'organisation'},
            { text: 'Activity Description', dataField: 'activities', width: 300},
            { text: 'Position', dataField: 'position', width: 200},
            { text: 'Year', dataField: 'year', columntype: 'dropdownlist', width: 100,
                createeditor: function (row, value, editor) 
                {
                    editor.jqxDropDownList({ source: dataAdapterYear, displayMember: 'label', valueMember: 'value',filterable: true  });
                }
            }
        ]
    });
});
</script>