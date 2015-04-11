<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>leave_application/get_leave_application_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id'},
                    { name: 'employee_id'},
                    { name: 'full_name'},
                    { name: 'start_date', type: 'date'},
                    { name: 'end_date', type: 'date'},
                    { name: 'total_day'},
                    { name: 'leave_type'},
                    { name: 'reason'},
                    { name: 'validasi'}
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
                    { text: 'Employee', dataField: 'full_name', width: 150},
                    { text: 'Date From', dataField: 'start_date', width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Date To', dataField: 'end_date', width: 125, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Type', dataField: 'leave_type', width: 100},
                    { text: 'Leave Day', dataField: 'total_day'},
                    { text: 'Reason', dataField: 'reason'},
                    { text: 'Status', dataField: 'validasi', width: 100}
                ]
            });

    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 160, null, null);
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
            item['paramValue'] = row.id;
            param.push(item);        
            data_post['id'] = row.id;
            load_content_ajax(GetCurrentController(), 161 ,data_post, param);
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
           if(confirm("Are you sure you want to delete recruitment : " + row.full_name))
            {
                var data_post = {};
                data_post['id'] = row.id;
                load_content_ajax(GetCurrentController(), 162 ,data_post);
            }
        }
        else
        {
            alert('Select recruitment you want to delete first');
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