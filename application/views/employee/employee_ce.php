<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function(){
    $('#employee-tabs').jqxTabs({ width: '100%', position: 'top', scrollPosition: 'right'});

     //=================================================================================
    //
    //   Employee Identification Grid
    //
    //=================================================================================
    
    var document_type = [
        <?php
        foreach($document_type as $dt)
        {
            echo '{ value: "'. $dt['id_employee_document_type'] .'", label: "'. $dt['name'] .'"},';
        }
        ?> 
    ];
    var employee_identification = <?php if(isset($is_edit))
    {
    echo json_encode($employee_identification);
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
            { name: 'id_employee_document_detail'},
            { name: 'employee_document_type'},
            { name: 'employee_document_type_name' },
            { name: 'number'},
            { name: 'date_issue', type: 'date', format: "yyyy-MM-dd"},
            { name: 'date_expire', type: 'date', format: "yyyy-MM-dd"},
        ],
        id: 'id',
        localdata: employee_identification
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#identification-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        source: dataAdapter,
        selectionmode : 'singlerow',
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Number', dataField: 'number'},
            { text: 'Type', dataField: 'employee_document_type', displayField: 'employee_document_type_name',columntype: 'combobox', width: 110, 
                createeditor: function (row, value, editor) 
                {
                    editor.jqxComboBox({ source: document_type, displayMember: 'label', valueMember: 'value' });
                }
            },
            { text: 'Date Issue', dataField: 'date_issue', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
            { text: 'Date Expire', dataField: 'date_expire', columntype: 'datetimeinput', width: 110, cellsformat: 'd'},
        ]
    });
    $("#add-identification").click(function(){
         var data = {};
        data['number'] = null;
        data['date_issue'] = null;
        data['date_expire'] = null;
        data['employee_document_type'] = null;
        var commit0 = $("#identification-grid").jqxGrid('addrow', null, data);
    });
    $("#remove-identification").click(function(){
        var selectedrowindex = $("#identification-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#identification-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#identification-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    //=================================================================================
    //
    //   Employee Address Grid
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
    
    var sourceAddressType = [
        <?php
        foreach($address_type as $at)
        {
            echo '{ value: "'. $at['id_address_type'] .'", label: "'. $at['name'] .'"},';
        }
        ?>
    ];
    
    var housing_source = [{value:"private_own", label:"Private Own"},{value:"others", label:"Others"}];
    var employee_address = <?php if(isset($is_edit))
    {?>
    <?php
    echo json_encode($employee_address);
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
            { name: 'id_employee_address'},
            { name: 'address'},
            { name: 'city_name'},
            { name: 'city'},
            { name: 'phone'},
            { name: 'address_type_name'},
            { name: 'address_type'},
            { name: 'housing_owner_name'},
            { name: 'housing_owner'},
        ],
        id: 'id',
        localdata: employee_address,
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#address-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        source: dataAdapter,
        selectionmode : 'singlerow',
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Address', dataField: 'address'},
            { text: 'City', dataField: 'city', displayField: 'city_name', columntype: 'combobox', width: 200, 
                createeditor: function (row, value, editor) 
                {
                    editor.jqxComboBox({ source: city, valueMember: 'value', displayMember: 'label' });
                }
            },
            { text: 'Phone', dataField: 'phone', width: 110},
            { text: 'Address Type', dataField: 'address_type', displayField: 'address_type_name',columntype: 'combobox', width: 110, 
                createeditor: function (row, value, editor) 
                {
                    editor.jqxComboBox({ source: sourceAddressType, displayMember: 'label', valueMember: 'value', selectedIndex: 1 });
                }
            },
            { text: 'Owner', dataField: 'housing_owner', displayField: 'housing_owner_name',columntype: 'combobox', width: 110, 
                createeditor: function (row, value, editor) 
                {
                    editor.jqxComboBox({ source: housing_source, displayMember: 'label', valueMember: 'value' });
                }
            },
        ]
    });
    
    $("#add-address").click(function(){
         var data = {};
        data['address'] = null;
        data['city'] = null;
        data['phone'] = null;
        data['address_type'] = null;
        data['housing_owner'] = null;
        var commit0 = $("#address-grid").jqxGrid('addrow', null, data);
    });
    $("#remove-address").click(function(){
        var selectedrowindex = $("#address-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#address-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#address-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    //=================================================================================
    //
    //   combobox & Other Selector
    //
    //=================================================================================
    
    var employment_type = [
        <?php
        foreach($employment_type as $at)
        {
            echo '{ value: "'. $at['id_employment_type'] .'", label: "'. $at['name'] .'"},';
        }
        ?>
    ];
        
    $("#select-employment-type").jqxComboBox({ source: employment_type, displayMember: 'label', valueMember: 'value'});
    $("#select-birth-place").jqxComboBox({ source: city, displayMember: 'label', valueMember: 'value'});
    $("#select-birth-date").jqxDateTimeInput({width: '250px', height: '25px', value: null}); 
    $("#select-gender").jqxComboBox({ source: [{value:"male",label:"Male"},{value:"female",label:"Female"}], displayMember: 'label', valueMember: 'value'});
    $("#select-blood").jqxComboBox({ 
        source: [
            {value:"a",label:"A"},
            {value:"b",label:"B"},
            {value:"ab",label:"AB"},
            {value:"o",label:"O"},
            ], 
            displayMember: 'label', 
            valueMember: 'value'
        });
    var religion = [
        <?php
        foreach($religion as $at)
        {
            echo '{ value: "'. $at['id_religion'] .'", label: "'. $at['name'] .'"},';
        }
        ?>
    ];
    $("#select-religion").jqxComboBox({ source: religion, displayMember: 'label', valueMember: 'value'});
    
    <?php 
    if(isset($is_edit))
    {?>
    $("#select-employment-type").jqxComboBox('val', <?php echo $data_edit[0]['employment_type'] ?>);
    $("#select-gender").jqxComboBox('val', '<?php echo $data_edit[0]['gender'] ?>');
    $("#select-blood").jqxComboBox('val', '<?php echo $data_edit[0]['blood_type'] ?>');        
    $("#select-religion").jqxComboBox('val', <?php echo $data_edit[0]['religion'] ?>);
    $("#select-birth-place").jqxComboBox('val', <?php echo $data_edit[0]['birth_city'] ?>);
    $("#select-birth-date").jqxDateTimeInput('val', '<?php echo $data_edit[0]['birth_date'] ?>'); 
    <?php   
    }    
    ?>                
});


function SaveData()
{   
    var data_post = {};

    data_post['is_edit'] = $("#is_edit").val(); 
    data_post['id_employee'] = $("#id_employee").val();
    data_post['id_employee_contract'] = $("#id_employee_contract").val();
    
    data_post['full_name'] = $("#fullname").val();
    data_post['employment_type'] = $("#select-employment-type").val();
    //Detail Address
    data_post['employee_address'] = $("#address-grid").jqxGrid('getrows');
    //
    
    data_post['birth_city'] = $("#select-birth-place").val();
    
    data_post['birth_date'] =  ($("#select-birth-date").val('date') == null ? null : $("#select-birth-date").val('date').format('yyyy-mm-dd'));
    
    data_post['religion'] = $("#select-religion").val();
    data_post['gender'] = $("#select-gender").val();
    data_post['blood_type'] = $("#select-blood").val();
    data_post['height'] = $("#height").val();
    data_post['weight'] = $("#weight").val();
    data_post['native'] = $("#native").val();
    
    //Detail Identification
    
    data_post['employee_identification'] = $("#identification-grid").jqxGrid('getrows');
    for(var i=0;i<data_post['employee_identification'].length;i++)
    {
        data_post['employee_identification'][i].date_expire = (data_post['employee_identification'][i].date_expire == null ? null : data_post['employee_identification'][i].date_expire.format('yyyy-mm-dd'));
        data_post['employee_identification'][i].date_issue = (data_post['employee_identification'][i].date_issue == null ? null : data_post['employee_identification'][i].date_issue.format('yyyy-mm-dd'));
    }
    
    //
    //alert(JSON.stringify(data_post));
    //Contract Section
    data_post['contract_number'] = $("#contract-number").val();
    data_post['join_date'] = ($("#join-date").val('date') == null ? null : $("#join-date").val('date').format('yyyy-mm-dd'));
    data_post['end_date'] = ($("#end-date").val('date') == null ? null : $("#end-date").val('date').format('yyyy-mm-dd'));
    data_post['position'] = $("#position").val();
    data_post['position_level'] = $("#position-level").val();
    data_post['employee_contract_type'] = $("#contract-type").val();
    
    data_post['contract_phase_detail'] = $("#contract-phase-grid").jqxGrid('getrows'); 
    for(var i=0;i<data_post['contract_phase_detail'].length;i++)
    {
        data_post['contract_phase_detail'][i].start_date = (data_post['contract_phase_detail'][i].start_date == null ? null : data_post['contract_phase_detail'][i].start_date.format('yyyy-mm-dd'));
        data_post['contract_phase_detail'][i].end_date = (data_post['contract_phase_detail'][i].end_date == null ? null : data_post['contract_phase_detail'][i].end_date.format('yyyy-mm-dd'));
    }
    data_post['contract_document'] = $("#contract-document-grid").jqxGrid('getrows');
    
    //Education & Course
    data_post['employee_education'] = $("#education-grid").jqxGrid('getrows');
    data_post['employee_course'] = $("#course-grid").jqxGrid('getrows');
    data_post['employee_language'] = $("#language-grid").jqxGrid('getrows');
    data_post['employee_social'] = $("#social-grid").jqxGrid('getrows');
    data_post['hobbies'] = $("#hobbies").val();
    
    //Experience
    data_post['employee_experience'] = $("#experience-grid").jqxGrid('getrows');
    
    //Family
    data_post['marital_status'] = $("#select-marital-status").val();
    data_post['marital_date'] = ($("#marital-date").val('date') == null ? null : $("#marital-date").val('date').format('yyyy-mm-dd'));
    data_post['employee_family'] = $("#family-grid").jqxGrid("getrows");
    for(var i=0;i<data_post['employee_family'].length;i++)
    {
        data_post['employee_family'][i].birth_date = (data_post['employee_family'][i].birth_date == null ? null : data_post['employee_family'][i].birth_date.format('yyyy-mm-dd'));
    }
    data_post['employee_marital'] = $("#marital-grid").jqxGrid("getrows");
    for(var i=0;i<data_post['employee_marital'].length;i++)
    {
        data_post['employee_marital'][i].birth_date = (data_post['employee_marital'][i].birth_date == null ? null : data_post['employee_marital'][i].birth_date.format('yyyy-mm-dd'));
    }
    //Emergency Contact
    data_post['emergency_contact'] = $("#contact-grid").jqxGrid("getrows");
    
    //Transportation
    data_post['employee_vehicle'] = $("#transport-grid").jqxGrid("getrows");
    
    //Survey
    
    //Others
    
    //alert(JSON.stringify(data_post));
    
    load_content_ajax(GetCurrentController(), 98, data_post);
    
}
function DiscardData()
{
    //load_content_ajax('administrator', 21 , null);
}

</script>
<style>

.second-column
{
    padding-left: 30px;
}

.image-field
{
    border: 1px solid #c8c8d3;
    -moz-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    -webkit-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);  
    padding: 10px;  
    cursor: pointer;
}

#clear-image
{
    width: 30px;
    height: 30px;
    background: darkgray;
    /* float: left; */
    position: relative;
    top: -152px;
    left: 120px;
    display: -webkit-inline-box;
    z-index: 100;
}
#clear-image span
{
    font-weight: bold;
    font-size: 12pt;
    color: white;
}


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_employee" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_employee'] : '') ?>" />
<input type="hidden" id="id_employee_contract" value="<?php echo (isset($is_edit) ? $employee_contract[0]['id_employee_contract'] : '') ?>" />
<div class="document-action">
    <button id="po-validate">Validate</button>
    <button id="po-validate">Proceed Recruit</button>
    <ul class="document-status">
        <li <?php 
            if(isset($is_edit))
            {
                if($data_edit[0]['employee_status'] == 4)
                {
                    echo 'class="status-active"';
                }
            }
            else
            {
                echo 'class="status-active"';
            }
        ?> >
            <span class="label">Listed</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['employee_status'] == 1 ? 'class="status-active"' : '') ?>>
            <span class="label">Recruitment</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['employee_status'] == 2 ? 'class="status-active"' : '') ?>>
            <span class="label">Hired</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['employee_status'] == 3 ? 'class="status-active"' : '') ?>>
            <span class="label">Resigned</span>
            <span class="arrow">
                <span></span>
            </span>
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
                        <input style="display: inline; width: 83%" class="field" type="text" id="product-code" value="<?php echo (isset($is_edit) ? $data_edit[0]['employee_number'] : '') ?>" /><button style="margin-left: 2px;" id="auto-generate">></button>
                    </td>
                    <td>
                    
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Full Name
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="fullname" value="<?php echo (isset($is_edit) ? $data_edit[0]['full_name'] : '') ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Employment Type
                    </td>
                    <td colspan="2">
                        <div id="select-employment-type"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Religion
                    </td>
                    <td colspan="2">
                        <div id="select-religion"></div>
                    </td>
                </tr>
                
                <!-- Unsplitted form-->
                <tr>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row-color">
                            <button id="add-address">+</button>
                            <button id="remove-address">-</button>
                            <span>Employee Address</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="address-grid"></div>
                    </td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td class="label">
                        Birth Date
                    </td>
                     <td>
                        <div id="select-birth-date"></div>
                    </td>
                     <td class="label second-column">
                        Birth Place
                    </td>
                     <td >
                        <div id="select-birth-place"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Gender
                    </td>
                     <td class="label">
                        <div id="select-gender"></div>
                    </td>
                     <td class="label second-column">
                        Blood Type
                    </td>
                     <td class="label">
                        <div id="select-blood"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Height
                    </td>
                     <td>
                        <input type="text" class="field" id="height" value="<?php echo (isset($is_edit) ? $data_edit[0]['height'] : '') ?>"/>
                    </td>
                     <td class="label second-column">
                        Weight
                    </td>
                     <td>
                        <input type="text" class="field" id="weight" value="<?php echo (isset($is_edit) ? $data_edit[0]['weight'] : '') ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Native
                    </td>
                     <td colspan="3">
                        <input type="text" class="field" style="width: 97%;" id="native" value="<?php echo (isset($is_edit) ? $data_edit[0]['native'] : '') ?>" />
                    </td>
                </tr>                
                <tr>
                    <td colspan="4">
                        <div class="row-color">
                            <button id="add-identification">+</button>
                            <button id="remove-identification">-</button>
                            <span>Employee Identification</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="identification-grid"></div>
                    </td>
                </tr>
            </table>
            <div id='employee-tabs' style="margin-top: 20px;">
                <ul>
                    <li style="margin-left: 30px;">Contract</li>
                    <li>Education & Course</li>
                    <li>Experience</li>
                    <li>Family</li>
                    <li>Emergency Contact</li>
                    <li>Transportation</li>
                    <li>Survey</li>
                    <li>Other Info</li>
                </ul>
                <div>
                    <?php echo $this->load->view('employee/employee_contract', null, true); ?>
                </div>
                <div>
                    <?php echo $this->load->view('employee/education_create', null, true); ?>
                </div>
                <div>
                    <?php echo $this->load->view('employee/experience_ce', null, true); ?>
                </div>
                <div>
                    <?php echo $this->load->view('employee/employee_family_ce', null, true); ?>
                </div>
                <div>
                     <?php echo $this->load->view('employee/emergency_contact_ce', null, true); ?>
                </div>
                <div>
                    <?php echo $this->load->view('employee/employee_transport_ce', null, true); ?>
                </div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</div>
