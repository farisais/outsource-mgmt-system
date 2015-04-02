<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function () {
    
    
   
        
    $("#date_overtime").jqxDateTimeInput({width: '250px', height: '25px', value: null});
    $("#from_overtime,#to_overtime").jqxDateTimeInput({ width: '250px', height: '25px', formatString: 'HH:mm:ss', showCalendarButton: false});

    <?php if (isset($is_edit)) : ?>
        $("#overtime-validate").on('click', function(e) {  
            var data_post = {};
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit->id_overtime ?>;
            param.push(item);        
            data_post['is_edit'] = $("#is_edit").val();
            data_post['id_overtime'] = $("#id_overtime").val();
            load_content_ajax(GetCurrentController(), 385, data_post, param);
            e.preventDefault();
        });    
        $("#date_overtime").jqxDateTimeInput('val', <?php echo "'" . date('m/d/Y', strtotime($data_edit->date_overtime)) . "'"; ?>);
        $("#from_overtime").jqxDateTimeInput('val', <?php echo "'" .$data_edit->from_overtime. "'" ; ?>);
        $("#to_overtime").jqxDateTimeInput('val', <?php echo "'" .$data_edit->to_overtime. "'" ; ?>);
        $('.document-action').show();
    <?php endif; ?>

        var urlsecurity = "<?php echo base_url(); ?>overtime/get_security_list";
        var sourcesecurity =
                {
                    datatype: "json",
                    datafields:
                            [
                                {name: 'id_employee'},
                                {name: 'employee_number'},
                                {name: 'full_name'},
                                {name: 'employee_status'}
                            ],
                    id: 'id_employee',
                    url: urlsecurity,
                    root: 'data'
                };
        var dataAdaptersecurity = new $.jqx.dataAdapter(sourcesecurity);

        $("#select-security-popup").jqxWindow({
            width: 600, height: 500, resizable: false, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
        });

        $("#select-security-grid").jqxGrid(
                {
                    theme: $("#theme").val(),
                    width: '100%',
                    height: 400,
                    selectionmode: 'singlerow',
                    source: dataAdaptersecurity,
                    columnsresize: true,
                    autoshowloadelement: false,
                    sortable: true,
                    filterable: true,
                    showfilterrow: true,
                    autoshowfiltericon: true,
                    columns: [
                        {text: 'Security Number', dataField: 'employee_number', width: 150},
                        {text: 'Name', dataField: 'full_name'}
                    ]
                });

        $("#security_name").focus(function () {
            $(this).attr('grid','1');
             $("#supervisor").attr('grid','0');
            
            $("#select-security-popup").jqxWindow('open');
        });
        $("#supervisor").focus(function () {
            $(this).attr('grid','1');
            $("#security_name").attr('grid','0');
            
            $("#select-security-popup").jqxWindow('open');
        });

        $('#select-security-grid').on('rowdoubleclick', function (event)
        {
            var args = event.args;
            var data = $('#select-security-grid').jqxGrid('getrowdata', args.rowindex);
            //console.log(data);
            //return false;
            if($("#security_name").attr('grid')==1){
                $('#security_name').val(data.full_name);
                $('#id_security').val(data.id_employee);
            }else{
                
                $('#supervisor').val(data.full_name);
            $('#id_supervisor').val(data.id_employee);
            }
            
            //$('#id_security').jqxInput('val', {label: data.name, value: data.id_ext_company});
            $("#select-security-popup").jqxWindow('close');
        });

    });

    function SaveData() {
        var data_post = {};

        data_post['id_security'] = $("#id_security").val();
        data_post['date_overtime'] = $("#date_overtime").val();
        data_post['from_overtime'] = $("#from_overtime").val();
        data_post['to_overtime'] = $("#to_overtime").val();
        data_post['hours_overtime'] = $("#hours_overtime").val();
        data_post['supervisor'] = $("#id_supervisor").val();
        data_post['description'] = $("#description").val();

        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_overtime'] = $("#id_overtime").val();

        load_content_ajax(GetCurrentController(), 382, data_post);
    }

    function DiscardData()
    {
        load_content_ajax('overtime', 380, null);
    }

</script>

<style>
    .table-form
    {
        margin: 30px;
        width: 100%;
    }

    .table-form tr td
    {

    }

    .table-form tr
    {
        height: 35px;
    }

    .field 
    { 
        border: 1px solid #c4c4c4; 
        height: 15px; 
        width: 80%; 
        font-size: 11px; 
        padding: 4px 4px 4px 4px; 
        border-radius: 4px; 

    } 

    select.field
    {
        height: 26px;
    }

    .field:focus 
    { 
        outline: none; 
        border: 1px solid #7bc1f7; 
    } 

    .label
    {
        font-size: 11pt;
        width: 50px;
        padding-right: 20px;
        font: -webkit-small-control;
    }


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_overtime" value="<?php echo (isset($is_edit) ? $data_edit->id_overtime : '') ?>" />
<div class="document-action" style="display: none;">
    <?php if (isset($is_edit) && $data_edit->status == 'created'): ?><button id="overtime-validate">Validate</button><?php endif; ?>
    
    <ul class="document-status">
        
        <li <?php echo (isset($is_edit) && $data_edit->status == 'created' ? 'class="status-active"' : '') ?>>
            <span class="label">Created</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit->status == 'validated' ? 'class="status-active"' : '') ?>>
            <span class="label">Validated</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div>
            <table class="table-form" >
                <tr>
                    <td class="label">
                        Security Name
                    </td>
                    <td>
                        <input grid="0" class="field" type="text" id="security_name" name="security_name" value="<?php echo (isset($is_edit) ? $data_edit->full_name : '') ?>"/>
                        <input  class="field" type="hidden" id="id_security" name="id_security" value="<?php echo (isset($is_edit) ? $data_edit->id_security : '') ?>"/>
                        
                    </td>
                    <td>
                   
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Overtime Date
                    </td>
                    <td>
                        <div id="date_overtime" name="date_overtime" style="display: inline-block;"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="label">
                        From
                    </td>
                    <td>                        
                        <div id="from_overtime" name="from_overtime" style="display: inline-block;"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="label">
                        To
                    </td>
                    <td>                        
                        <div id="to_overtime" name="to_overtime" style="display: inline-block;"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="label">
                        Hours Overtime
                    </td>
                    <td>
                        <input class="field" type="text" id="hours_overtime" name="hours_overtime" value="<?php echo (isset($is_edit) ? $data_edit->hours_overtime : '') ?>"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="label">
                        Supervisor
                    </td>
                    <td>
                        <input grid="0" class="field" type="text" id="supervisor" name="supervisor" value="<?php echo (isset($is_edit) ? $data_edit->nama_suvervisor : '') ?>"/>
                        <input   class="field" type="hidden" id="id_supervisor" name="id_supervisor" value="<?php echo (isset($is_edit) ? $data_edit->supervisor : '') ?>"/>
                        
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="label">
                        Description
                    </td>
                    <td>
                        <textarea class="field" id="description" name="description" style="height: 50px;" rows="6" cols="40">
                            <?php echo (isset($is_edit) ? $data_edit->description : '') ?>
                        </textarea>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div id="select-security-popup">
    <div>Select Security</div>
    <div id="select-security-grid"></div>
</div>
