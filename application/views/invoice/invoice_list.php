<script>
    $(document).ready(function () {
        //$(".Pdfbutton").jqxButton({template: "info"});

        var url = "<?php echo base_url(); ?>invoice/get_invoice_list";
        var source =
                {
                    datatype: "json",
                    datafields:
                            [
                                {name: 'id_invoice'},
                                {name: 'invoice_number'},
                                {name: 'sub_total', type: 'number'},
                                {name: 'total_tax',type:'number'},
                                {name: 'total_invoice',type:'number'},
                                {name: 'no_rekening'},
                                {name: 'invoice_date',type:'date'},
                                {name: 'status_invoice'},
                                {name: 'payroll_wo_id'},
                                {name: 'link_invoice_pdf'},
                                {name: 'project_name'},
                                {name: 'name'},
                                {name: 'email'}
                            ],
                    id: 'id_invoice',
                    url: url,
                    root: 'data'
                };
        var cellclass = function (row, columnfield, value)
        {
            if (value == 'close') {
                return 'green';
            }
        }

        var renderer_pdf = function (id) {
            return '<button onClick="button_pdf(event)" class="Pdfbutton" id="buttonpdf_' + id + '">Email</button>';
        }

        var linkrenderer_pdf = function (row, column, value) {
            return "<a href='#' onclick='openPopup(" + row + ")'>" + value + "</a>";
        };
        var renderer = function (id) {
            return '<button onClick="buttonpdf(event)" class="Pdfbutton" id="buttonpdf_' + id + '">Email</button>';
        }

        var linkrenderer = function (row, column, value) {
            return "<a href='#' onclick='openPopup(" + row + ")'>" + value + "</a>";
        };

        var dataAdapter = new $.jqx.dataAdapter(source);
        $('#jqxgrid').jqxGrid(
                {
                    theme: $("#theme").val(),
                    width: '99.8%',
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
                        {text: 'Invoice', dataField: 'invoice_number', width: 100},
                        {text: 'Date', width: 100, dataField: 'invoice_date', cellsformat: 'dd/MM/yyyy', filtertype: 'date'},
                        {text: 'Sub Total', dataField: 'sub_total', cellsalign: 'right',cellsformat: 'f'},
                        {text: 'Customer', dataField: 'name'},
                        {text: 'Project Name', dataField: 'project_name'},
                        {text: 'Tax', dataField: 'total_tax', cellsalign: 'right',cellsformat: 'f'},
                        {text: 'Total Payment', dataField: 'total_invoice', width: 200, cellsalign: 'right',cellsformat: 'f'},
                        {text: 'Status', dataField: 'status_invoice', width: 100, cellclassname: cellclass},
                        {text: 'Invoice Document', width: 100, datafield: 'link_invoice_pdf', columntype: 'button', cellsrenderer: function () {
                                return "PDF";
                            }, buttonclick: function (row) {
                                var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
                                var dt = datarow.invoice_number;
                                window.open('images/upload/' + dt + '.pdf');
                            }},
                            {text: 'Email', datafield: 'email', columntype: 'button', cellsrenderer: function () {
                                return "Email";
                            }, buttonclick: function (row) {
                                var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
                                var noInv = datarow.invoice_number;
                                var dt = {id: datarow.id_invoice, email: datarow.email, invNo: noInv};
                                $.ajax({
                                    type: "post",
                                    url: "invoice/kirim_invoice_email",
                                    data: dt,
                                    dataType: "json",
                                    success: function (hsl) {
                                        if (hsl.success == true) {
                                            alert("Successed send Email !");
                                        }
                                    }
                                })
                            }}

                    ]
                });

        $("#jqxgrid").on("bindingcomplete", function (event) {
            var localizationobj = {};
            localizationobj.currencysymbol = "Rp. ";
            $("#jqxgrid").jqxGrid('localizestrings', localizationobj);
        });


    });
</script>
<script>
    function buttonpdf(event) {
        //var email = event.target.email;
        console.log(event.target);
        return false;
        $("#jqxgrid").jqxGrid('kirimemail', email);
    }
    function button_pdf(event) {
        //var email = event.target.email;
        console.log(event.target);
        return false;
        $("#jqxgrid").jqxGrid('kirimemail', email);
    }
    function CreateData()
    {
        load_content_ajax(GetCurrentController(), 'create_invoice', null, null);
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
            item['paramValue'] = row.id_invoice;
            param.push(item);
            data_post['id_invoice'] = row.id_invoice;
            load_content_ajax(GetCurrentController(), 'edit_invoice', data_post, param);
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
            if (confirm("Are you sure you want to delete menu : " + row.name))
            {
                var data_post = {};
                data_post['id_invoice'] = row.id_invoice;
                load_content_ajax(GetCurrentController(), 'delete_invoice', data_post);
            }
        }
        else
        {
            alert('Select menu you want to delete first');
        }
    }

</script>
<style>
    .green {
        color: green;
    }
</style>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>