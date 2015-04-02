<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>recruitment/get_recruitment_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id'},
                    { name: 'nama'},
                    { name: 'alamat'},
                    { name: 'telepon'},
                    { name: 'email'},
                    { name: 'birt_date', type: 'date'},
                    { name: 'religion'},
                    { name: 'gender'},
                    { name: 'blood_type'},
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
                    { text: 'ID', dataField: 'id'},
                    { text: 'Name', dataField: 'nama'},
                    { text: 'Address', dataField: 'alamat'},
                    { text: 'Telephone', dataField: 'telepon'}, 
                    { text: 'Email', dataField: 'email'},
                    { text: 'Tanggal Lahir', dataField: 'birt_date', cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Agama', dataField: 'religion'},
                    { text: 'Gender', dataField: 'gender'}, 
                    { text: 'Golongan Darah', dataField: 'blood_type'},
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 317, null, null);
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
        load_content_ajax(GetCurrentController(), 318 ,data_post, param);
    }
    else
    {
        alert('Select recruitment you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        
    if(row != null)
    {
       if(confirm("Are you sure you want to delete recruitment : " + row.nama))
        {
            var data_post = {};
            data_post['id_ext_company'] = row.id;
            load_content_ajax(GetCurrentController(), 320 ,data_post);
        }
    }
    else
    {
        alert('Select recruitment you want to delete first');
    }
}

function ImportData()
{
    var data_post = {};
    data_post['id_ext_company'] = "";
    load_content_ajax(GetCurrentController(), 314 ,data_post);
        
    
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
            <div id="jqxcombobox"></div>
        </div>
    </div>
</div>