<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>bank_statement/get_bank_statement_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_bank_statement'},
                    { name: 'amount', type: 'number'},
                    { name: 'date', type: 'date'},
                    { name: 'description'},
                    { name: 'recipient'},
                    { name: 'status'}
                ],
            id: 'id_bank_statement',
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
                    { text: 'Recipient', dataField: 'recipient', width: 100},
                    { text: 'Status', dataField: 'status', width: 100}
                ]
            });
    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 195, null, null);
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
            item['paramValue'] = row.id_bank_statement;
            param.push(item);
            data_post['id_bank_statement'] = row.id_bank_statement;
            load_content_ajax(GetCurrentController(), 196, data_post, param);
        }
        else
        {
            alert('Select bank statement you want to edit first');
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
                data_post['id_bank_statement'] = row.id_bank_statement;
                load_content_ajax(GetCurrentController(), 197, data_post);
            }
        } else {
            alert('Select bank statement you want to delete first');
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