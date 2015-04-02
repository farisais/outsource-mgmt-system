<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>product_category/get_product_category_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_product_category'},
                    { name: 'product_category'},
                    { name: 'abbreviation'}
                ],
                id: 'id_product_category',
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
                    { text: 'ID', dataField: 'id_product_category', width: 60},
                    { text: 'Name', dataField: 'product_category'},
                    { text: 'Abbreviation', dataField: 'abbreviation', width: 150}
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 32, null, null);
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
        item['paramValue'] = row.id_product_category;
        param.push(item);        
        data_post['id_product_category'] = row.id_product_category;
        load_content_ajax(GetCurrentController(), 33 ,data_post, param);
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
       if(confirm("Are you sure you want to delete product category : " + row.product_category))
        {
            var data_post = {};
            data_post['id_product_category'] = row.id_product_category;
            load_content_ajax(GetCurrentController(), 34 ,data_post);
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