<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>employee/get_employee_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_employee'},
                    { name: 'employee_number'},
                    { name: 'full_name'},
                    { name: 'employment_type'},
                    { name: 'employment_type_name'},
                    { name: 'employee_status'},
                    { name: 'employee_status_name'},
                    { name: 'employee_contract_type'},
                    { name: 'employee_contract_type_name'},
                       
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
                    { text: 'Employee ID', dataField: 'employee_number', width: 200},
                    { text: 'Full Name', dataField: 'full_name'},
                    { text: 'Type', dataField: 'employment_type_name', width: 200},
                    { text: 'Contract', dataField: 'employee_contract_type_name', width: 200},
                    { text: 'Status', dataField: 'employee_status_name', width: 100},
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 95, null, null);
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
        item['paramValue'] = row.id_employee;
        param.push(item);
        data_post['id_employee'] = row.id_employee;
        load_content_ajax(GetCurrentController(), 96 ,data_post, param);
    }
    else
    {
        alert('Select data you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete data : " + row.name))
        {
            var data_post = {};
            data_post['id_employee'] = row.id_employee;
            //load_content_ajax(GetCurrentController(), 4 ,data_post);
        }
    }
    else
    {
        alert('Select data you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>