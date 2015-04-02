<script>
    $(document).ready(function () {
        $("#simpan_xls").jqxButton({template: "success", disabled: true});

        var url = "<?php echo base_url(); ?>import_xls/get_temp_import_excel";
        var source =
                {
                    datatype: "json",
                    datafields:
                            [
                                {name: 'id_customer_site'},
                                {name: 'customer'},
                                {name: 'site_name'},
                                {name: 'address'},
                                {name: 'city'}
                            ],
                    id: 'id_customer_site',
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
                    selectionmode: 'checkbox',
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
                        {text: 'ID', dataField: 'id_customer_site'},
                        {text: 'Customer', dataField: 'customer'},
                        {text: 'Site Name', dataField: 'site_name'},
                        {text: 'Address', dataField: 'address'},
                        {text: 'City', dataField: 'city'}
                    ]
                });

        $("#jqxgrid").bind('cellendedit', function (event) {
            if (event.args.value) {
                $("#jqxgrid").jqxGrid('selectrow', event.args.rowindex);
            }
            else {
                $("#jqxgrid").jqxGrid('unselectrow', event.args.rowindex);
            }
        });
        // get all selected records.
        $("#Button").click(function () {
            var rows = $("#jqxgrid").jqxGrid('selectedrowindexes');
            var selectedRecords = new Array();
            for (var m = 0; m < rows.length; m++) {
                var row = $("#jqxgrid").jqxGrid('getrowdata', rows[m]);
                selectedRecords[selectedRecords.length] = row;
            }

            var jsonText = JSON.stringify(selectedRecords);
            var hasil_jsonPisah = {jsonPisah: $.parseJSON(jsonText)};

            if (!confirm("Do you want to delete this records ?")) {
                return false;
            }

            $.ajax({
                type: "post",
                url: "import_xls/delete_temp_excel_data",
                data: hasil_jsonPisah,
                //dataType: "json",
                success: function (hsl) {
                    console.log(hsl);
                    $("#jqxgrid").jqxGrid('updatebounddata');
                }
            })
            //console.log(hasil_jsonPisah);
            //alert(jsonText);
        });

        $("#dt_import").change(function () {
            $("#simpan_xls").jqxButton({disabled: false});
        })

        $("#savedt").click(function () {
            $(this).attr("disabled");

            $.ajax({
                type: "post",
                url: "import_xls/send_import",
                dataType: "json",
                success: function (hsl) {
                    if (hsl.success == true) {
                        $("#jqxgrid").jqxGrid('updatebounddata');
                    }
                }
            })
        })
    });
</script>

<style>
    .table-form
    {
        margin: 30px;
        width: 100%;
    }

    .table-form tr td
    {

    }

    .table-form tr
    {
        height: 35px;
    }

    .field 
    { 
        border: 1px solid #c4c4c4; 
        height: 15px; 
        width: 80%; 
        font-size: 11px; 
        padding: 4px 4px 4px 4px; 
        border-radius: 4px; 

    } 

    select.field
    {
        height: 26px;
    }

    .field:focus 
    { 
        outline: none; 
        border: 1px solid #7bc1f7; 
    } 

    .label
    {
        font-size: 11pt;
        width: 50px;
        padding-right: 20px;
        font: -webkit-small-control;
    }


</style>

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <form method="post" class="form-center" id="frmImport" action="import_xls/import_excel" enctype="multipart/form-data">
        <div>
            <table class="table-form">
                <tr>
                    <td>File Excell</td>
                    <td>
                        <input type="hidden" name="dtUrl" id="dtUrl" value="<?= site_url(); ?>"/>
                        <input type="file" name="dt_import" id="dt_import" />
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" name="simpan_xls" id="simpan_xls" value="Simpan" />
                    </td>
                </tr>

            </table>
        </div>
    </form>
</div>

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <table>
            <tr>
                <td><input type="button" id="Button" value="Delete Selected Rows" /></td>
                <td><input type="button" id="savedt" value="Send Data" /></td>
            </tr>
        </table>
        <br/>
        <div id="jqxgrid"></div>        
    </div>
</div>