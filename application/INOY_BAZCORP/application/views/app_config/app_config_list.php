<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>app_config/get_app_config_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_config'}, 
                    { name: 'name'},
                    { name: 'data_type'},
                    { name: 'value'},
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
                height: '92%',
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
                    { text: 'Data Type', dataField: 'data_type'},
                    { text: 'value', dataField: 'value',
                         cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                           var value = value;
                           if(rowdata.data_type == 'password')
                           {
                                value = '******';
                           }
                           return "<div style='margin: 4px;' class='jqx-left-align'>" + value + "</div>";
                        }
                    },
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 'create_configuration_parameter', null, null);
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
        item['paramValue'] = row.id_config;
        param.push(item);        
        data_post['id_config'] = row.id_config;
        load_content_ajax(GetCurrentController(), 'edit_configuration_parameter' ,data_post, param);
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
       if(confirm("Are you sure you want to delete app_config : " + row.name))
        {
            var data_post = {};
            data_post['id_config'] = row.id_config;
            load_content_ajax(GetCurrentController(), 'delete_configuration_parameter' ,data_post);
        }
    }
    else
    {
        alert('Select data you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>