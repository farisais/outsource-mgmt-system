<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>payroll_periode/get_payroll_periode_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_payroll_periode'}, 
                    { name: 'periode_name'}, 
					{ name: 'payroll_type'}, 
                    { name: 'date_start',type: 'date'},
                    { name: 'date_finish',type: 'date'}
                ],
                id: 'id_payroll_periode',
                url: url,
                root: 'data'
            };
            
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                autoheight: true,
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                //pagerrenderer: pagerrenderers,
                columns: [
                    { text: 'ID', dataField: 'id_payroll_periode'},
                    { text: 'Periode Name', dataField: 'periode_name'}, 
                    { text: 'Periode Start', dataField: 'date_start',cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Periode Finish', dataField: 'date_finish',cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
					{ text: 'Type', dataField: 'payroll_type'}
                ]
            });         
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax('payroll_periode', 357, null);
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
        item['paramValue'] = row.id_payroll_periode;
        param.push(item);        
        data_post['id_payroll_periode'] = row.id_payroll_periode;
        //console.log(row);
        //alert(row.id_payroll_periode);
        load_content_ajax(GetCurrentController(), 'edit_payroll_periode' ,data_post, param);
    }
    else
    {
        alert('Select menu you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete menu : " + row.name))
        {
            var data_post = {};
            data_post['id_payroll_periode'] = row.id_payroll_periode;
            load_content_ajax(GetCurrentController(), 360 ,data_post);
        }
    }
    else
    {
        alert('Select menu you want to delete first');
    }
}

</script>

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>