<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>organisation_structure/get_organisation_structure_list";
            var source =
            {
                datatype: "json",
                datafields: [
                    { name:  'id_organisation_structure' },
                    { name: 'structure_name' },
                    { name: 'parent_structure' },
                    { name: 'parent_name' }                  
                ],
                hierarchy: 
                {
                    keyDataField: { name: 'id_organisation_structure' },
                    parentDataField: { name: 'parent_structure' }
                },
                id: 'id_organisation_structure',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxtree").jqxTreeGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: 500,
                autoShowLoadElement: false,
                filterable: true,
                source: dataAdapter,
                sortable: true,
                filterMode: 'advanced',
                columnsresize: true,
                columns: [
                  { text: 'Position Name', dataField: 'structure_name'},     
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
    load_content_ajax(GetCurrentController(), 227, null);
}

function EditData()
{
    if($("#jqxtree").jqxTreeGrid('getSelection').length > 0)
    {
        var data_post = {};
        data_post['id_organisation_structure'] = $("#jqxtree").jqxTreeGrid('getSelection')[0].id_organistation_structure;
        
        var param = [];
        
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = data_post['id_organisation_structure'];
        
        param.push(item);
        
        load_content_ajax(GetCurrentController(), 228 ,data_post, param);
    }
    else
    {
        alert('Select data you want to edit first');
    }
}

function DeleteData()
{
    if($("#jqxtree").jqxTreeGrid('getSelection').length > 0)
    {
        if(confirm("Are you sure you want to delete data : " + $("#jqxtree").jqxTreeGrid('getSelection')[0].structure_name))
        {
            var data_post = {};
            data_post['id_organisation_structure'] = $("#jqxtree").jqxTreeGrid('getSelection')[0].id_organisation_structure;
            load_content_ajax(GetCurrentController(), 229 ,data_post);
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
        <div id="jqxtree">
        </div>
    </div>
</div>