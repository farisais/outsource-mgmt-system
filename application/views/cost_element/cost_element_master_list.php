<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>cost_element/get_cost_element_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_cost_element'},
                    { name: 'name'},
                    { name: 'description'},
                    { name: 'date_create', type: 'date'}
                ],
            id: 'id_cost_element',
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
                    { text: 'Name', dataField: 'name'},
                    { text: 'Description', dataField: 'description'},
                    { text: 'Date Create', dataField: 'date_create', cellsformat: 'dd/MM/yyyy', width: 100},
                ]
            });

    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 'create_cost_element_2', null, null);
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
            item['paramValue'] = row.id_cost_element;
            param.push(item);
            data_post['id_cost_element'] = row.id_cost_element;
            load_content_ajax(GetCurrentController(), 'edit_cost_element' ,data_post, param);
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
            if(confirm("Are you sure you want to delete cost_element : " + row.name + ' WARNING: ALL REFERENCE DATA TO THIS COST ELEMENT WILL BE ALSO DELETED.'))
            {
                var data_post = {};
                data_post['id_cost_element'] = row.id_cost_element;
                load_content_ajax(GetCurrentController(), 'delete_cost_element' ,data_post);
            }
        }
        else
        {
            alert('Select Cost Element you want to delete first');
        }
    }

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>