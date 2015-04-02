<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>fingerprint/get_fingerprint_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_fingerprint_device'},
                    { name: 'merk'},
                    { name: 'series'},
                    { name: 'serial_number'},
                    { name: 'ip_local_setting'},
                    { name: 'status'},
                       
                ],
                id: 'id',
                url: url,
                root: 'data'
            };
            var cellclass = function (row, columnfield, value) 
            {
                if (value == 'inactive') {
                    return 'red';
                }
                else if(value == 'active')
                {
                    return 'green';
                }
            }
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
                    { text: 'Serial No.', dataField: 'serial_number', width: 200},
                    { text: 'Merk', dataField: 'merk'},
                    { text: 'Series', dataField: 'series', width: 200},
                    { text: 'IP Local', dataField: 'ip_local_setting', width: 200},
                    { text: 'Status', dataField: 'status', width: 100, cellclassname: cellclass},
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 269, null, null);
}

function EditData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
    if(row != null)
    {
        /*var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = row.id_fingerprint_device;
        param.push(item);
        data_post['id_fingerprint'] = row.id_fingerprint_device;
        load_content_ajax(GetCurrentController(), 270 ,data_post, param);*/
        window.location = "<?php echo base_url() ?>" + GetCurrentController() + '?menu=157&action=270&id=' + row.id_fingerprint_device;
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
            data_post['id_fingerprint'] = row.id_fingerprint;
            //load_content_ajax(GetCurrentController(), 4 ,data_post);
        }
    }
    else
    {
        alert('Select data you want to delete first');
    }
}

</script>
<style>
.green {
    color: green;
}
.red {
    color: red;
}
.blue {
    color: blue;
}
</style>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>