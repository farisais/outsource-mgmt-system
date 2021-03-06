<script>
    $(document).ready(function () {
        var url = "<?php echo base_url() ;?>incident_report/get_incident_report_list";
        var source =
        {
            datatype: "json",
            datafields:
                [
                    { name: 'id'},
                    { name: 'employee_id'},
                    { name: 'full_name'},
                    { name: 'incident_time'},
                    { name: 'location'}
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
                    { text: 'Incident Time', dataField: 'incident_time'},
                    { text: 'Location', dataField: 'location'}
                ]
            });

    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 175, null, null);
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
            load_content_ajax(GetCurrentController(), 176 ,data_post, param);
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
                load_content_ajax(GetCurrentController(), 177 ,data_post);
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