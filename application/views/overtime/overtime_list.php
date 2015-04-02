<script>
    $(document).ready(function () {
        var url = "<?php echo base_url(); ?>overtime/get_overtime_list";
        var source =
                {
                    datatype: "json",
                    datafields:
                            [
                                {name: 'id_overtime'},
                                {name: 'full_name'},
                                {name: 'date_overtime', type: 'date'},
                                {name: 'from_overtime', type: 'time'},
                                {name: 'to_overtime', type: 'time'},
                                {name: 'hours_overtime', type: 'time'},
                                {name: 'nama_suvervisor'},
                                {name: 'description'},
                                {name: 'status'}
                            ],
                    id: 'id_overtime',
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
                    //pagerrenderer: pagerrenderers,
                    columns: [
                        {text: 'Security Name', dataField: 'full_name'},
                        {text: 'Date Overtime', dataField: 'date_overtime', cellsformat: 'dd/MM/yyyy', filtertype: 'date', cellsalign: 'center'},
                        {text: 'From Hour', dataField: 'from_overtime', cellsformat: "HH:MM", cellsalign: 'center'},
                        {text: 'To Hour', dataField: 'to_overtime', cellsformat: "HH:MM", cellsalign: 'center'},
                        {text: 'Amount Hours', dataField: 'hours_overtime', cellsformat: "HH:MM", cellsalign: 'center'},
                        {text: 'Supervisor', dataField: 'nama_suvervisor'},
                        {text: 'Status', dataField: 'status'}
                    ]
                });
    });
</script>
<script>
    function CreateData()
    {
        load_content_ajax('overtime', 381, null);
    }

    function EditData()
    {
        var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
        if (row != null)
        {
            var data_post = {};
            var param = [];
            var item = {};
            item['paramName'] = 'id_overtime';
            item['paramValue'] = row.id_overtime;
            param.push(item);
            data_post['id_overtime'] = row.id_overtime;
            //console.log(row);
            //alert(row.id_payroll_periode);
            load_content_ajax(GetCurrentController(), 384, data_post, param);
        }
        else
        {
            alert('Select menu you want to edit first');
        }
    }

    function DeleteData()
    {
        var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));

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
        }
    }

</script>

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>