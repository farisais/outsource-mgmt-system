<script>
    $(document).ready(function () {
        var url = "<?php echo base_url(); ?>overtime/get_overtime_rule_all";
        var source =
                {
                    datatype: "json",
                    datafields:
                            [
                                {name: 'id_overtime_rule'},
								{name: 'name'},
	                            {name: 'description'},
                            ],
                    id: 'id_overtime_rule',
                    url: url,
                    root: 'data'
                };

        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#jqxgrid").jqxGrid(
                {
                    theme: $("#theme").val(),
                    width: '100%',
                    autoheight: true,
                    source: dataAdapter,
                    groupable: true,
                    columnsresize: true,
                    autoshowloadelement: false,
                    filterable: true,
                    showfilterrow: true,
                    sortable: true,
                    autoshowfiltericon: true,
                    pageable: true,
                    columns: [
                        {text: 'Name', dataField: 'name'},
                        {text: 'Description', dataField: 'description'}

                    ]
                });
    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 'create_overtime_rule', null);
    }

    function EditData()
    {
        var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        if (row != null)
        {
            var data_post = {};
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = row.id_overtime_rule;
            param.push(item);
            data_post['id_overtime_rule'] = row.id_overtime_rule;

            load_content_ajax(GetCurrentController(), 'edit_overtime_rule', data_post, param);
        }
        else
        {
            alert('Select menu you want to edit first');
        }
    }

    function DeleteData()
    {
        /*var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));

        if (row != null)
        {
            if (confirm("Are you sure you want to delete menu : " + row.full_name))
            {
                var data_post = {};
                data_post['id_overtime'] = row.id_overtime;
                load_content_ajax(GetCurrentController(), 383, data_post);
            }
        }
        else
        {
            alert('Select menu you want to delete first');
        }*/
    }

</script>

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>