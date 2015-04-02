<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>import_xls/get_temp_import_excel";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_payroll_periode'}, 
                    { name: 'periode_name'}, 
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
                pageable: true,
                //pagerrenderer: pagerrenderers,
                columns: [
                    { text: 'ID', dataField: 'id_payroll_periode'},
                    { text: 'Periode Name', dataField: 'periode_name'}, 
                    { text: 'Periode Start', dataField: 'date_start',cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Periode Finish', dataField: 'date_finish',cellsformat: 'dd/MM/yyyy',filtertype: 'date'}
                ]
            });         
        });  
</script>
<script>

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete menu : " + row.name))
        {
            var data_post = {};
            data_post['id_payroll_periode'] = row.id_payroll_periode;
            load_content_ajax(GetCurrentController(), 301 ,data_post);
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