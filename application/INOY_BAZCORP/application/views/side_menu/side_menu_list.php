<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>side_menu/get_side_menu";
            var source =
            {
                datatype: "json",
                datafields: [
                    { name:  'id_application_menu' },
                    { name: 'name' },
                    { name: 'type' },
                    { name: 'stored_value'},
                    { name: 'views_path'},
                    { name:  'parent' },
                    { name: 'parent_name'},
                    { name: 'division_name'},
                    { name: 'controller'},
                    { name: 'action_name'},
                    { name: 'default_menu'},
                    { name: 'index' , type: 'int'}                    
                ],
                hierarchy: 
                {
                    keyDataField: { name: 'id_application_menu' },
                    parentDataField: { name: 'parent' }
                },
                id: 'id_application_menu',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxtree").jqxTreeGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: '100%',
                autoShowLoadElement: false,
                filterable: true,
                source: dataAdapter,
                sortable: true,
                filterMode: 'advanced',
                columnsresize: true,
                columns: [
                  { text: 'ID', dataField: 'id_application_menu', width: 80  },
                  { text: 'Menu Name', dataField: 'name', width: 200 },
                  { text: 'Menu Type', dataField: 'type', width: 200 },
                  { text: 'Division', dataField: 'division_name', minwidth: 100},
                  { text: 'Controller Bind', dataField: 'controller', minwidth: 100},
                  { text: 'Action Bind', dataField: 'action_name', minwidth: 100},
                  { text: 'Default Menu', dataField: 'default_menu', minwidth: 100},
                  { text: 'Index', dataField: 'index', minwidth: 100}                  
                ]
            });
            
            $('#treeGrid').on('rowSelect', function (event){
                // event args.
                var args = event.args;
                // row data.
                row = args.row;
                // row key.
                var key = args.key;
            });
        });
</script>
<script>



function CreateData()
{
    load_content_ajax('administrator', 6, null);
}

function EditData()
{
    if($("#jqxtree").jqxTreeGrid('getSelection').length > 0)
    {
        var data_post = {};
        data_post['id_application_menu'] = $("#jqxtree").jqxTreeGrid('getSelection')[0].id_application_menu;
        
        var param = [];
        
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = data_post['id_application_menu'];
        
        param.push(item);
        
        load_content_ajax(GetCurrentController(), 7 ,data_post, param);
    }
    else
    {
        alert('Select menu you want to edit first');
    }
}

function DeleteData()
{
    if($("#jqxtree").jqxTreeGrid('getSelection').length > 0)
    {
        if(confirm("Are you sure you want to delete menu : " + $("#jqxtree").jqxTreeGrid('getSelection')[0].name))
        {
            var data_post = {};
            data_post['id_application_menu'] = $("#jqxtree").jqxTreeGrid('getSelection')[0].id_application_menu;
            load_content_ajax(GetCurrentController(), 8 ,data_post);
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
        <div id="jqxtree">
        </div>
    </div>
</div>