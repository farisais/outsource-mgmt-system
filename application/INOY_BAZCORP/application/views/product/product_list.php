<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>product/get_product_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_product'},
                    { name: 'product_category'},
                    { name: 'merk'},
                    { name: 'product_code'},
                    { name: 'product_name'},
                    { name: 'name'},
                    { name: 'category_name'},
                ],
                id: 'id_product',
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
                    { text: 'Product Code', dataField: 'product_code', width: 150},
                    { text: 'Name', dataField: 'product_name'},
                    { text: 'Category', dataField: 'category_name', width: 200}, 
                    { text: 'Merk', dataField: 'name', width: 100}                                        
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 22, null, null);
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
        item['paramValue'] = row.id_product;
        param.push(item);        
        data_post['id_product'] = row.id_product;
        load_content_ajax(GetCurrentController(), 23 ,data_post, param);
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
       if(confirm("Are you sure you want to delete product : " + row.name + ' WARNING: ALL REFERENCE DATA TO THIS PRODUCT WILL BE ALSO DELETED.'))
        {
            var data_post = {};
            data_post['id_product'] = row.id_product;
            load_content_ajax(GetCurrentController(), 24 ,data_post);
        }
    }
    else
    {
        alert('Select product you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>