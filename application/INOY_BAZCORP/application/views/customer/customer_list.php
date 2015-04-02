<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>customer/get_customer_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_ext_company'},
                    { name: 'company_code'},
                    { name: 'name'},
                    { name: 'address'},
                    { name: 'city'},
                    { name: 'contact'},
                    { name: 'tlp'},
                    { name: 'email'},
                ],
                id: 'id_ext_company',
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
                    { text: 'Name', dataField: 'name'},
                    { text: 'Code', dataField: 'company_code'},
                    { text: 'Address', dataField: 'address'},
                    { text: 'City', dataField: 'city', width: 100}, 
                    { text: 'Contact', dataField: 'contact', width: 100},
                    { text: 'Call Number', dataField: 'tlp', width: 100},
                    { text: 'Email', dataField: 'email', width: 100}
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 43, null, null);
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
        item['paramValue'] = row.id_ext_company;
        param.push(item);        
        data_post['id_ext_company'] = row.id_ext_company;
        load_content_ajax(GetCurrentController(), 44 ,data_post, param);
    }
    else
    {
        alert('Select customer you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete customer : " + row.name))
        {
            var data_post = {};
            data_post['id_ext_company'] = row.id_ext_company;
            load_content_ajax(GetCurrentController(), 45 ,data_post);
        }
    }
    else
    {
        alert('Select customer you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>