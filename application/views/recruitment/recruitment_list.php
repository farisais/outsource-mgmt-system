<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
 $(document).ready(function () {
        var btn_inoy="<button id='set-employee' style='margin-left: 3px;width: 100%;' class='jqx-rc-all jqx-button jqx-widget jqx-fill-state-normal jqx-info' role='button' aria-disabled='false'>Set To Employee</button>";
        $("#inoy_custom_button").append(btn_inoy);
        
        var url = "<?php echo base_url() ;?>recruitment/get_recruitment_list";
        var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id'},
                    { name: 'nama'},
                    { name: 'alamat'},
                    { name: 'telepon'},
                    { name: 'email'},
                    { name: 'birt_date', type: 'date'},
                    { name: 'religion'},
                    { name: 'gender'},
                    { name: 'blood_type'},
                    { name: 'validasi'},
                ],
                id: 'id_ext_company',
                url: url,
                root: 'data'
            };
            
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: 450,
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                pageable: true,
                columns: [
                    { text: 'Name', dataField: 'nama'},
                    { text: 'Address', dataField: 'alamat'},
                    { text: 'Telephone', dataField: 'telepon'}, 
                    { text: 'Email', dataField: 'email'},
                    { text: 'Tanggal Lahir', dataField: 'birt_date', cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Agama', dataField: 'religion'},
                    { text: 'Gender', dataField: 'gender'}, 
                    { text: 'Golongan Darah', dataField: 'blood_type'},
                    { text: 'Validasi', dataField: 'validasi'},
                    
                ]
            });
        $("#select-recruitment-popup").jqxWindow({
            width: 600, height: 500, resizable: false, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
        });
        
        //GET employement type
             var employment_type = [
                <?php
                foreach($employment_type as $at)
                {
                    echo '{ value: "'. $at['id_employment_type'] .'", label: "'. $at['name'] .'"},';
                }
                ?>
            ];
        $("#select-employment-type").jqxComboBox({ source: employment_type, displayMember: 'label', valueMember: 'value',selectedIndex: 0});
        //GET employement type
        
        //GET employement level
             var employment_level = [
                <?php
                foreach($employment_level as $at)
                {
                    echo '{ value: "'. $at['id_position_level'] .'", label: "'. $at['name'] .'"},';
                }
                ?>
            ];
        $("#select-employment-level").jqxComboBox({ source: employment_level, displayMember: 'label', valueMember: 'value',selectedIndex: 0});
        //GET employement type
        
        //GET organisation structure
             var oragnisation_structure = [
                <?php
                foreach($organisation_structure as $at)
                {
                    echo '{ value: "'. $at['id_organisation_structure'] .'", label: "'. $at['structure_name'] .'"},';
                }
                ?>
            ];
        $("#select-organisation-structure").jqxComboBox({ source: oragnisation_structure, displayMember: 'label', valueMember: 'value',selectedIndex: 0});
        //GET employement type
        
        $('#jqxgrid').on('rowdoubleclick', function (event){ 
            var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
            if(row.validasi!=="Validate"){
            $("#id-employee").val(row.id);
            $("#name-employee").val(row.nama);
            $("#gender-employee").val(row.gender);
            $("#religion-employee").val(row.religion);
            $("#select-recruitment-popup").jqxWindow('open');
            }
        });
        
        $('#cancel-employee').click(function(){
            $("#select-recruitment-popup").jqxWindow('close');
        });
        
        $('#save-employee').click(function(){
            var id_employee = $("#id-employee").val();
            var type_employee = $("#select-employment-type").val();
            var level_employee = $("#select-employment-level").val();
            var structure_employee =  $("#select-organisation-structure").val();
            var dt = {id_employee:id_employee,
                type_employee:type_employee,level_employee:level_employee,structure_employee:structure_employee}
            
            $.ajax({
               url:"<?=base_url();?>recruitment/set_employee",
               type:"post",
               data: dt,
               success: function(e){
                    console.log(e);
                    $("#jqxgrid").jqxGrid('updatebounddata');
                    $("#select-recruitment-popup").jqxWindow('close');
               },
               error: function(e){
                    alert(e);
               }
            });
        });
                   
});  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 376, null, null);
}

function EditData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
    if(row != null)
    {
        var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = row.id;
        param.push(item);        
        data_post['id'] = row.id;
        load_content_ajax(GetCurrentController(), 379 ,data_post, param);
    }
    else
    {
        alert('Select recruitment you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete recruitment : " + row.nama))
        {
            var data_post = {};
            data_post['id_ext_company'] = row.id;
            load_content_ajax(GetCurrentController(), 378 ,data_post);
        }
    }
    else
    {
        alert('Select recruitment you want to delete first');
    }
}

function ImportData()
{
    var data_post = {};
    data_post['id_ext_company'] = "";
    load_content_ajax(GetCurrentController(), 397 ,data_post);
        
    
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
            <div id="jqxcombobox"></div>
        </div>
    </div>
</div>
<div id="select-recruitment-popup">
    <div>Select Recruitment</div>
    <div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
        <table class="table-form" >
            <tr>
                <td>Name</td>
                <td>:</td><input type="hidden" id="id-employee"/>
                <td><input class="field" type="text" id="name-employee" readonly="true"/></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>:</td>
                <td><input class="field" type="text" id="gender-employee" readonly="true"/></td>
            </tr>
            <tr>
                <td>Religion</td>
                <td>:</td>
                <td><input class="field" type="text" id="religion-employee" readonly="true"/></td>
            </tr>
            <tr>
                <td>Employement Type</td>
                <td>:</td>
                <td><div id="select-employment-type"></div></td>
            </tr>
            <tr>
                <td>Employee Level</td>
                <td>:</td>
                <td><div id="select-employment-level"></div></td>
            </tr>
            <tr>
                <td>Organisation Structure</td>
                <td>:</td>
                <td><div id="select-organisation-structure"></div></td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <button id='save-employee' style='margin-left: 3px;' class='jqx-rc-all jqx-button jqx-widget jqx-fill-state-normal jqx-info' role='button' aria-disabled='false'>Save</button>
                    <button id='cancel-employee' style='margin-left: 3px;' class='jqx-rc-all jqx-button jqx-widget jqx-fill-state-normal jqx-danger' role='button' aria-disabled='false'>Cancel</button>
                </td>
            </tr>
        </table>
    </div>
    </div>
</div>