<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>cash_register/get_cash_register_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_cash_register'},
                    { name: 'amount', type: 'number'},
                    { name: 'date', type: 'date'},
                    { name: 'description'},
                    { name: 'status'}
                ],
            id: 'id_cash_register',
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
                    { text: 'Date', dataField: 'date', width: 150, width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Description', dataField: 'description'},
                    { text: 'Amount', dataField: 'amount', width: 200},
                    { text: 'Status', dataField: 'status', width: 100}
                ]
            });

    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 200, null, null);
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
            item['paramValue'] = row.id_cash_register;
            param.push(item);
            data_post['id_cash_register'] = row.id_cash_register;
            load_content_ajax(GetCurrentController(), 201, data_post, param);
        }
        else
        {
            alert('Select cash register you want to edit first');
        }
    }

    function DeleteData()
    {
        var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));

        if(row != null)
        {
            if(confirm("Are you sure you want to delete chart of account : " + row.description + "? All data relate to this user will be deleted."))
            {
                var data_post = {};
                data_post['id_cash_register'] = row.id_cash_register;
                load_content_ajax(GetCurrentController(), 202, data_post);
            }
        } else {
            alert('Select cash register you want to delete first');
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