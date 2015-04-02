<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>bank/get_bank_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id_bank'},
                    { name: 'name'},
                    { name: 'branch'},
                    { name: 'address'},
                    { name: 'contact'}
                ],
            id: 'id_bank',
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
                    { text: 'Name', dataField: 'name', width: 200},
                    { text: 'Branch', dataField: 'branch', width: 150},
                    { text: 'Address', dataField: 'address'},
                    { text: 'Contact', dataField: 'contact', width: 150}
                ]
            });

    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 242, null, null);
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
            item['paramValue'] = row.id_bank;
            param.push(item);
            data_post['id_bank'] = row.id_bank;
            load_content_ajax(GetCurrentController(), 243, data_post, param);
        }
        else
        {
            alert('Select bank you want to edit first');
        }
    }

    function DeleteData()
    {
        var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));

        if(row != null)
        {
            if(confirm("Are you sure you want to delete bank : " + row.name + "? All data relate to this user will be deleted."))
            {
                var data_post = {};
                data_post['id_bank'] = row.id_bank;
                load_content_ajax(GetCurrentController(), 244, data_post);
            }
        } else {
            alert('Select bank you want to delete first');
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