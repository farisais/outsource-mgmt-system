<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>unit_measure/get_unit_measure_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_unit_measure'},
                    { name: 'name'},
                    { name: 'unit_of_measure_category'},
                    { name: 'uom_category_name'}
                ],
                id: 'id_unit_measure',
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
                    { text: 'ID', dataField: 'id_unit_measure', width: 60},
                    { text: 'Name', dataField: 'name'},
                    { text: 'Category', dataField: 'uom_category_name'}
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 89, null, null);
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
        item['paramValue'] = row.id_unit_measure;
        param.push(item);        
        data_post['id_unit_measure'] = row.id_unit_measure;
        load_content_ajax(GetCurrentController(), 90 ,data_post, param);
    }
    else
    {
        alert('Select unit measure you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete unit measure : " + row.name))
        {
            var data_post = {};
            data_post['id_unit_measure'] = row.id_unit_measure;
            load_content_ajax(GetCurrentController(), 91 ,data_post);
        }
    }
    else
    {
        alert('Select unit measure you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>