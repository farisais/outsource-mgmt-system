<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>salary_type/get_salary_type_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id'},
                    { name: 'salary_code'},
                    { name: 'salary_type'},
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
                    { text: 'Salary Code', dataField: 'salary_code'},
                    { text: 'Salary Type', dataField: 'salary_type'}
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 290, null, null);
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
        load_content_ajax(GetCurrentController(), 292 ,data_post, param);
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
       if(confirm("Are you sure you want to delete customer : " + row.salary_type))
        {
            var data_post = {};
            data_post['id'] = row.id;
            load_content_ajax(GetCurrentController(), 285 ,data_post);
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