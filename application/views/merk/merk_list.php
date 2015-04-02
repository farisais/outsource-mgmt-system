<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>merk/get_merk_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_merk'},
                    { name: 'name'},
                    { name: 'abbreviation'}
                ],
                id: 'id_merk',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: '100%',
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: [
                    { text: 'ID', dataField: 'id_merk', width: 60},
                    { text: 'Name', dataField: 'name'},
                    { text: 'Abbreviation', dataField: 'abbreviation', width: 150}
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 37, null, null);
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
        item['paramValue'] = row.id_merk;
        param.push(item);        
        data_post['id_merk'] = row.id_merk;
        load_content_ajax(GetCurrentController(), 38 ,data_post, param);
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
       if(confirm("Are you sure you want to delete merk : " + row.merk))
        {
            var data_post = {};
            data_post['id_merk'] = row.id_merk;
            load_content_ajax(GetCurrentController(), 39 ,data_post);
        }
    }
    else
    {
        alert('Select merk you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>