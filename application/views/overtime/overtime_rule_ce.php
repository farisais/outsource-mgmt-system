<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script>
$(document).ready(function () {
    
    var url = "<?php echo (isset($is_edit) ?  base_url() . "overtime/get_detail_overtime_rule?id=" . $data_edit[0]['id_overtime_rule'] : "") ?>"
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_detail_overtime'},
            { name: 'overtime_rule'},
            { name: 'hour_regex'},
			{ name: 'multiply', type: 'number'}
        ],
        id: 'id_detail_overtime_rule',
        url: url ,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#overtime-rule-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '95%',
        height: 250,
        selectionmode : 'singlerow',
        source: dataAdapter,
        editable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,        
        columns: [
            { text: 'hour_regex', dataField: 'hour_regex', width: 200},
            { text: 'Multiply', dataField: 'multiply', cellsformat : 'd2'},
        ]
    });
	
	$("#add-rule").click(function(){
		var data = {};
		data['hour_regex'] = null;
		data['multiply'] = null;
		$("#overtime-rule-grid").jqxGrid('addrow', null, data);
	});
	
	$("#remove-rule").click(function(){
		var selectedrowindex = $("#overtime-rule-grid").jqxGrid('getselectedrowindex');
		if (selectedrowindex >= 0) {
			var id = $("#overtime-rule-grid").jqxGrid('getrowid', selectedrowindex);
			var commit1 = $("#overtime-rule-grid").jqxGrid('deleterow', id);
		}
	});
});
    
    

    function SaveData() 
	{
        var data_post = {};

        data_post['name'] = $("#name").val();
        data_post['description'] = $("#description").val();
		data_post['detail_overtime_rule'] = $("#overtime-rule-grid").jqxGrid('getrows');

        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_overtime_rule'] = $("#id_overtime_rule").val();

        load_content_ajax(GetCurrentController(), 'save_edit_overtime_rule', data_post);
    }

    function DiscardData()
    {
        load_content_ajax('overtime', 'view_overtime_rule', null);
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
<input type="hidden" id="id_overtime_rule" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_overtime_rule'] : '') ?>" />

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;">Overtime Rule / <?php echo (isset($is_edit) ? $data_edit[0]['id_overtime_rule'] : ''); ?></span></h1></div>
    <div><h1 style="font-size: 18pt; font-weight: bold;"></span></h1></div>
        <div>
            <table class="table-form" >
                <tr>
                    <td class="label">
                        Name
                    </td>
                    <td>
                        <input class="field" type="text" id="name" value="<?php echo (isset($is_edit) ? $data_edit[0]['name'] : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Description
                    </td>
                    <td>
                        <textarea id="description" name="description" style="height: 50px;" rows="6" cols="40" class="field"><?php echo  (isset($is_edit) ? $data_edit[0]['description'] : "" ) ?></textarea>
                    </td>
                </tr>
                <tr>
					<td colspan="2">                       
                         <div class="row-color" style="width: 95%;">
                            <button style="width: 30px;" id="add-rule">+</button>
                            <button style="width: 30px;" id="remove-rule">-</button>
                            <div style="display: inline;"><span>Add / Remove Rule</span></div>
                        </div>
                    </td>
				</tr>
				<tr>
                    <td colspan="3">                       
                        <div id="overtime-rule-grid">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

