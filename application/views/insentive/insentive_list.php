<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>insentive/get_insentive_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id'},
                    { name: 'salary_type'},
                    { name: 'master_salary_type_id'},
                    { name: 'employee_id'},
                    { name: 'payroll_periode_id'},
                    { name: 'nominal'},
                    { name: 'description'},
                    { name: 'full_name'},
                    { name: 'periode_name'}
                ],
                id: 'id',
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
                columns: [
                    { text: 'ID', dataField: 'id'},
                    { text: 'Employee', dataField: 'full_name'},
                    { text: 'Periode', dataField: 'periode_name'},
                    { text: 'Nominal', dataField: 'nominal'},
                    { text: 'Salary Type', dataField: 'salary_type'},
                    { text: 'Description', dataField: 'description'}
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 387, null, null);
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
        load_content_ajax(GetCurrentController(), 390 ,data_post, param);
    }
    else
    {
        alert('Select Log Error you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete Insentive : " + row.full_name))
        {
            var data_post = {};
            data_post['id'] = row.id;
            load_content_ajax(GetCurrentController(), 389 ,data_post);
        }
    }
    else
    {
        alert('Select Log Error you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>