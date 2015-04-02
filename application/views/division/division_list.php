<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>division/get_division_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_division'}, 
                    { name: 'name'}, 
                    { name: 'abbreviation'}
                ],
                id: 'id_division',
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
                    { text: 'ID', dataField: 'id_division'},
                    { text: 'Name', dataField: 'name'}, 
                    { text: 'Abbreviation', dataField: 'abbreviation'}
                ]
            });         
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax('division', 12, null);
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
        item['paramValue'] = row.id_application_action;
        param.push(item);        
        data_post['id_application_action'] = row.id_application_action;
        alert(JSON.stringify(param));
        load_content_ajax(GetCurrentController(), 14 ,data_post, param);
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
            data_post['id_application_action'] = row.id_application_action;
            load_content_ajax(GetCurrentController(), 4 ,data_post);
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