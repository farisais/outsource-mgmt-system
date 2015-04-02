<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>coa/get_coa_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_chart_of_account'},
                    { name: 'account_number'},
                    { name: 'name'},
                    { name: 'parent'},
                    { name: 'index'},
                    { name: 'type'}
                ],
            id: 'id_chart_of_account',
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
                    { text: 'Account Number', dataField: 'account_number', width: 150},
                    { text: 'Name', dataField: 'name'},
                    { text: 'type', dataField: 'type', width: 100}
                ]
            });

    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 210, null, null);
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
            item['paramValue'] = row.id_chart_of_account;
            param.push(item);
            data_post['id_chart_of_account'] = row.id_chart_of_account;
            load_content_ajax(GetCurrentController(), 211, data_post, param);
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
            if(confirm("Are you sure you want to delete chart of account : " + row.account_number + ' - ' + row.name + "? All data relate to this user will be deleted."))
            {
                var data_post = {};
                data_post['id_chart_of_account'] = row.id_chart_of_account;
                load_content_ajax(GetCurrentController(), 212, data_post);
            }
        } else {
            alert('Select chart of account you want to delete first');
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

<div></div>