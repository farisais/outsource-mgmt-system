<script>
$(document).ready(function(){
    $("#form-experience").jqxWindow({
        width: 700, height: 900, resizable: true,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    $("#add-experience").click(function(){
        var offset = $("#add-experience").offset();
        $("#form-experience").jqxWindow({ position: { x: parseInt(offset.left) + $("#add-experience").width() + 20, y: parseInt(offset.top) - 400} });
        $("#form-experience").jqxWindow('open');
        $("#exp-is-edit").val("false");
    });
    $("#remove-experience").click(function(){
        var selectedrowindex = $("#experience-grid").jqxGrid('getselectedrowindex');
        if (selectedrowindex >= 0) {
            var id = $("#experience-grid").jqxGrid('getrowid', selectedrowindex);
            var commit1 = $("#experience-grid").jqxGrid('deleterow', id);
        }
        
    });
    
    $('#form-experience').on('close', function (event) { 
        reset_form_value();
    }); 
    
     var city = [
        <?php
        foreach($cities as $city)
        {
            echo '{ value: "'. $city['id_city'] .'", label: "'. $city['name'] .'"},';
        }
        ?> 
    ];
    
    
    $("#save-experience").click(function(){
        data = {};
        data['company_name'] =  $('#company-name').val();
        data['company_address'] = $('#company-address').val();
        data['company_address_city'] = $('#company-address-city').val();
        data['city'] = $('#city').val();
        data['company_phone'] = $('#company-phone').val();
        data['from_month'] = $('#select-month-from').val();
        data['from_year'] = $('#select-year-from').val();
        data['to_month'] = $('#select-month-to').val();
        data['to_year'] = $('#select-year-to').val();
        data['entry_position'] = $('#entry-position').val();
        data['last_position'] = $('#last-position').val();
        data['total_employees'] = $('#total-employees').val();
        data['director_name'] = $('#director-name').val();
        data['type_of_business'] = $('#type-of-business').val();
        data['supervisor'] = $('#supervisor').val();
        data['responsibilities'] = $('#responsibilities').val();
        data['reason_for_leaving'] = $('#reason-for-leaving').val();
        data['last_salary'] = $('#last-salary').val();
        data['facilities'] = $('#facilities').val();
        data['supervisor_phone'] = $('#supervisor-phone').val();
        data['supervisor_can_be_contacted'] = $('#supervisor-can-be-contacted').val();
        
        reset_form_value();
        if($("#exp-is-edit").val() ==  'true')
        {
            var commit0 = $("#experience-grid").jqxGrid('updaterow', $("#exp-row-edit").val(), data);
        }
        else
        {
             var commit0 = $("#experience-grid").jqxGrid('addrow', null, data);
        }
       
        $("#form-experience").jqxWindow('close');

    });
    
    var month = [
        {label: 'January', value: 1}, 
        {label: 'February', value: 2}, 
        {label: 'March', value: 3}, 
        {label: 'April', value: 4}, 
        {label: 'May', value: 5}, 
        {label: 'June', value: 6}, 
        {label: 'July', value: 7}, 
        {label: 'August', value: 8}, 
        {label: 'September', value: 9}, 
        {label: 'October', value: 10}, 
        {label: 'November', value: 11}, 
        {label: 'December', value: 12}, 
    ];
    var year = [
    <?php
    for($i=0;$i<100;$i++)
    {
        echo '{ value: "'. (intval(date("Y")) - $i) .'", label: "'. (intval(date("Y")) - $i) .'" },';
    }
    ?>
    ];
    
    $("#select-month-from").jqxDropDownList({ source: month, displayMember: 'label', valueMember: 'value', filterable: true });
    $("#city").jqxDropDownList({ source: city, displayMember: 'label', valueMember: 'value', filterable: true });
    $("#select-month-to").jqxDropDownList({ source: month, displayMember: 'label', valueMember: 'value', filterable: true });
    $("#select-year-from").jqxDropDownList({ source: year, displayMember: 'label', valueMember: 'value', filterable: true });
    $("#select-year-to").jqxDropDownList({ source: year, displayMember: 'label', valueMember: 'value', filterable: true });
    
    //=================================================================================
    //
    //   Experience Grid
    //
    //=================================================================================
    
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'company_name'},
            { name: 'company_address'},
            { name: 'city'},
            { name: 'company_phone'},
            { name: 'from_month'},
            { name: 'from_year'},
            { name: 'to_month'},
            { name: 'to_year'},
            { name: 'entry_position'},
            { name: 'last_position'},
            { name: 'total_employees'},
            { name: 'director_name'},
            { name: 'type_of_business'},
            { name: 'supervisor'},
            { name: 'responsibilities'},
            { name: 'reason_for_leaving'},
            { name: 'last_salary'},
            { name: 'facilities'},
            { name: 'supervisor_phone'},
            { name: 'supervisor_can_be_contacted'}
        ],
        id: 'id'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#experience-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 150,
        selectionmode : 'singlerow',
        source: dataAdapter,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Company Name', dataField: 'company_name'},
            { text: 'Type of Business', dataField: 'type_of_business'},
            { text: 'From Month', dataField: 'from_month'},
            { text: 'From Year', dataField: 'from_year'}
        ]
    });
    
    $("#experience-grid").on('rowdoubleclick', function(event){
        var args = event.args;
        var data = $('#experience-grid').jqxGrid('getrowdata', args.rowindex);
        $('#company-name').val(data['company_name']);
        $('#company-address').val(data['company_address']);
        $('#company-address-city').val(data['company_address_city']);
        $('#city').val(data['city']);
        $('#company-phone').val(data['company_phone']);
        $('#select-month-from').val(data['from_month']);
        $('#select-year-from').val(data['from_year']);
        $('#select-month-to').val(data['to_month']);
        $('#select-year-to').val(data['to_year']);
        $('#entry-position').val(data['entry_position']);
        $('#last-position').val(data['last_position']);
        $('#total-employees').val(data['total_employees']);
        $('#director-name').val(data['director_name']);
        $('#type-of-business').val(data['type_of_business']);
        $('#supervisor').val(data['supervisor']);
        $('#responsibilities').val(data['responsibilities']);
        $('#reason-for-leaving').val(data['reason_for_leaving']);
        $('#last-salary').val(data['last_salary']);
        $('#facilities').val(data['facilities']);
        $('#supervisor-phone').val(data['supervisor_phone']);
        $('#supervisor-can-be-contacted').val(data['supervisor_can_be_contacted']);
        //alert(JSON.stringify(data));
        var offset = $("#add-experience").offset();
         $("#form-experience").jqxWindow({ position: { x: parseInt(offset.left) + $("#add-experience").width() + 20, y: parseInt(offset.top) - 400} });
        $("#exp-is-edit").val("true");
        $("#exp-row-edit").val(args.rowindex);
        $("#form-experience").jqxWindow('open');

    });
    
    <?php
    if(isset($is_edit))
    {?>
    $('#company-name').val('<?php echo $employee_experience[0]['company_name'] ?>');
    $('#company-address').val('<?php echo $employee_experience[0]['company_address'] ?>');
    $('#city').val('<?php echo $employee_experience[0]['city'] ?>');
    $('#company-phone').val('<?php echo $employee_experience[0]['company_phone'] ?>');
    $('#select-month-from').val('val',<?php echo $employee_experience[0]['from_month'] ?>);
    $('#select-year-from').val('val', <?php echo $employee_experience[0]['from_year'] ?>);
    $('#select-month-to').val('val', <?php echo $employee_experience[0]['to_month'] ?>);
    $('#select-year-to').val('val', <?php echo $employee_experience[0]['to_year'] ?>);
    $('#entry-position').val('<?php echo $employee_experience[0]['entry_position'] ?>');
    $('#last-position').val('<?php echo $employee_experience[0]['last_position'] ?>');
    $('#total-employees').val('<?php echo $employee_experience[0]['total_employees'] ?>');
    $('#director-name').val('<?php echo $employee_experience[0]['director_name'] ?>');
    $('#type-of-business').val('<?php echo $employee_experience[0]['type_of_business'] ?>');
    $('#supervisor').val('<?php echo $employee_experience[0]['supervisor'] ?>');
    $('#responsibilities').val('<?php echo $employee_experience[0]['responsibilities'] ?>');
    $('#reason-for-leaving').val('<?php echo $employee_experience[0]['reason_for_leaving'] ?>');
    $('#last-salary').val('<?php echo $employee_experience[0]['last_salary'] ?>');
    $('#facilities').val('<?php echo $employee_experience[0]['facilities'] ?>');
    $('#supervisor-phone').val('<?php echo $employee_experience[0]['supervisor_phone'] ?>');
    $('#supervisor-can-be-contacted').val('<?php echo $employee_experience[0]['supervisor_can_be_contacted'] ?>');
    
    var data = {};
    data['company_name']  = '<?php echo $employee_experience[0]['company_name']  ?>';
    data['company_address']  = '<?php echo $employee_experience[0]['company_address']  ?>';
    data['city']  = '<?php echo $employee_experience[0]['city']  ?>';
    data['company_phone']  = '<?php echo $employee_experience[0]['company_phone']  ?>';
    data['from_month']  = '<?php echo $employee_experience[0]['from_month']  ?>';
    data['from_year']  = '<?php echo $employee_experience[0]['from_year']  ?>';
    data['to_month']  = '<?php echo $employee_experience[0]['to_month']  ?>';
    data['to_year']  = '<?php echo $employee_experience[0]['to_year']  ?>';
    data['entry_position']  = '<?php echo $employee_experience[0]['entry_position']  ?>';
    data['last_position']  = '<?php echo $employee_experience[0]['last_position']  ?>';
    data['total_employees']  = '<?php echo $employee_experience[0]['total_employees']  ?>';
    data['director_name']  = '<?php echo $employee_experience[0]['director_name']  ?>';
    data['type_of_business'] = '<?php echo $employee_experience[0]['type_of_business'] ?>';
    data['supervisor']  = '<?php echo $employee_experience[0]['supervisor']  ?>';
    data['responsibilities']  = '<?php echo $employee_experience[0]['responsibilities']  ?>';
    data['reason_for_leaving']  = '<?php echo $employee_experience[0]['reason_for_leaving']  ?>';
    data['last_salary']  = '<?php echo $employee_experience[0]['last_salary']  ?>';
    data['facilities'] = '<?php echo $employee_experience[0]['facilities'] ?>';
    data['supervisor_phone']  = '<?php echo $employee_experience[0]['supervisor_phone']  ?>';
    data['supervisor_can_be_contacted'] = '<?php echo $employee_experience[0]['supervisor_can_be_contacted'] ?>';


    var commit0 = $("#experience-grid").jqxGrid('addrow', null, data);
    <?php
    }
    ?>
});

function reset_form_value()
{
    $('#company-name').val('');
    $('#company-address').val('');
    $('#city').val('');
    $('#company-phone').val('');
    $('#select-month-from').jqxDropDownList('val', null);
    $('#select-year-from').jqxDropDownList('val', null);
    $('#select-month-to').jqxDropDownList('val', null);
    $('#select-year-to').jqxDropDownList('val', null);
    $('#entry-position').val('');
    $('#last-position').val('');
    $('#total-employees').val('');
    $('#director-name').val('');
    $('#type-of-business').val('');
    $('#supervisor').val('');
    $('#responsibilities').val('');
    $('#reason-for-leaving').val('');
    $('#last-salary').val('');
    $('#facilities').val('');
    $('#supervisor-phone').val('');
    $('#supervisor-can-be-contacted').val('');
}
</script>
<table class="table-form" style="margin: 20px; width: 90%;">
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-experience">+</button>
                <button id="remove-experience">-</button>
                <span>Add Experience</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="experience-grid"></div>
        </td>
    </tr>
</table>
<div id="form-experience">
    <input type="hidden" id="exp-is-edit" value="false" />
    <input type="hidden" id="exp-row-edit" value="" />
    <div>Add Experience</div>
    <div style="padding: 10px;">
        <table class="table-form">
            <tr>
                <td class="label">
                    Company Name
                </td>
                <td>
                    <input id="company-name" type="text" class="field" />
                </td>
                <td class="label">
                    Company Phone
                </td>
                <td>
                    <input id="company-phone" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Company Address
                </td>
                <td colspan="3">
                    <textarea id="company-address" class="field" style="width: 99%; height: 80px"></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">
                    City
                </td>
                <td>
                    <div id="city"></div>
                </td>
                <td class="label">
                    
                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td class="label">
                    From
                </td>
                <td>
                    <div id="select-month-from"></div>
                    <div id="select-year-from"></div>
                </td>
                <td class="label">
                    To
                </td>
                <td>
                    <div id="select-month-to"></div>
                    <div id="select-year-to"></div>
                </td>
            </tr>
            <tr>
                <td class="label">
                    Posistion Began
                </td>
                <td>
                    <input id="entry-position" type="text" class="field" />
                </td>
                <td class="label">
                    Position End
                </td>
                <td>
                    <input id="last-position" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Type of Business
                </td>
                <td>
                    <input id="type-of-business" type="text" class="field" />
                </td>
                <td class="label">
                    Total Employee
                </td>
                <td>
                    <input id="total-employees" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Name of Supervisor
                </td>
                <td>
                    <input id="supervisor" type="text" class="field" />
                </td>
                <td class="label">
                    Name of Director
                </td>
                <td>
                    <input id="director-name" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Describe Your Responsibility
                </td>
                <td colspan="3">
                    <textarea id="responsibilities" class="field" style="width: 99%; height: 80px"></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">
                    Reason for Leaving
                </td>
                <td>
                    <input id="reason-for-leaving" type="text" class="field" />
                </td>
                <td class="label">
                    Last Salary
                </td>
                <td>
                    <input id="last-salary" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Supervisor Phone
                </td>
                <td colspan="3">
                    <input id="supervisor-phone" type="text" class="field" style="display: inline; width: 40%" />
                    <input id="supervisor-can-be-contacted" type="checkbox" style="display: inline" />Can be contacted
                </td>
            </tr>
            <tr>
                <td class="label">
                    Other Facilities
                </td>
                <td colspan="3">
                    <textarea id="facilities" class="field" style="width: 99%; height: 80px"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button id="save-experience" style="width: 200px;">Add Experience</button>
                </td>
            </tr>
        </table>
    </div>
</div>