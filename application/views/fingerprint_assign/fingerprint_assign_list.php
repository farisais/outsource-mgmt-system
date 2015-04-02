<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>fingerprint_assign/get_fingerprint_assign_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_fingerprint_assign'},
                    { name: 'work_order'},
                    { name: 'work_order_number'},
                    { name: 'app_id'},
                    { name: 'site'},
                    { name: 'site_name'},
                    { name: 'status'},
                       
                ],
                id: 'id_fingerprint_assign',
                url: url,
                root: 'data'
            };
            var cellclass = function (row, columnfield, value) 
            {
                if (value == 'unassigner') {
                    return 'red';
                }
                else if(value == 'assigned')
                {
                    return 'green';
                }
            }
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: '96%',
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: [
                    { text: 'Work Order', dataField: 'work_order', displayfield: 'work_order_number'},
                    { text: 'AppID', dataField: 'app_id', width: 400},
                    { text: 'Site', dataField: 'site', displayfield: 'site_name',width: 200},
                    { text: 'Status', dataField: 'status', width: 200, cellclassname: cellclass},
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 276, null, null);
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
        item['paramValue'] = row.id_fingerprint_assign;
        param.push(item);
        data_post['id_fingerprint_assign'] = row.id_fingerprint_assign;
        load_content_ajax(GetCurrentController(), 277 ,data_post, param);
        //window.location = "<?php echo base_url() ?>" + GetCurrentController() + '?menu=157&action=270&id=' + row.id_fingerprint_device;
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
       if(confirm("Are you sure you want to delete data : " + row.id_fingerprint_assign))
        {
            var data_post = {};
            data_post['id_fingerprint_assign'] = row.id_fingerprint_assign;
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