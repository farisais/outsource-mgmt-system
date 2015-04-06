<script>
    $(document).ready(function () {
        $("#download-template").click(function(){
           window.location.replace("<?=base_url();?>assets/excel_template/recruitment_template.xlsx"); 
        });
        
        $("#test_form").on("submit", function(event){
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                 url : "<?php echo base_url();?>import_xls/import_excel_inoy",
                 type : "post",
                 data : formData,
                 cache: false,
                 contentType: false,
                 processData: false,
                 //dataType : "json",
                 success: function(e){
                     //$("#inti-content").load('<?=base_url();?>user/index');
                     if(e==="oke"){
                        $("#jqxgrid").jqxGrid('updatebounddata');
                        $("#dt_import").val('');
                     }else{
                        alert('Please upload file with xls or xlsx extension!!!');
                        $("#dt_import").val('');
                     }
                 },
                 error: function(e){
                     alert('fail');
                 }
            });
        });
        
        
        $("#simpan_xls").jqxButton({template: "success", disabled: true});

        var url = "<?php echo base_url(); ?>import_xls/get_temp_import_excel";
        var source =
                {
                    datatype: "json",
                    datafields:
                            [
                                {name: 'id'},
                                {name: 'nama'},
                                {name: 'alamat'},
                                {name: 'telepon'},
                                {name: 'email'},
                                {name: 'religion'},
                                {name: 'gender'},
                                {name: 'blood_type'}
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
                        {text: 'ID', dataField: 'id'},
                        {text: 'Name', dataField: 'nama'},
                        {text: 'Address', dataField: 'alamat'},
                        {text: 'Telephone', dataField: 'telepon'},
                        {text: 'Email', dataField: 'email'},
                        {text: 'Religion', dataField: 'religion'},
                        {text: 'Gender', dataField: 'gender'},
                        {text: 'Blood', dataField: 'blood_type'},
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
            var rowx = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
            if(rowx==null){
                alert("select data first");
            }else{
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
            }
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
        });
    });
    
     function SaveData() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>import_xls/save_import",
            //dataType: "json",
            success: function (hsl) {
                //if (hsl.success == true) {
                    //$("#jqxgrid").jqxGrid('updatebounddata');
                    load_content_ajax('recruitment', 375, null);
                //}
            }
        });
    }

    function DiscardData()
    {
        load_content_ajax('recruitment', 375, null);
    }
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
    <!--<form method="post" class="form-center" id="frmImport" action="import_xls/import_excel" enctype="multipart/form-data">-->
    <form method="post" name="test_form" id="test_form" enctype="multipart/form-data">
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
                <td><input type="button" id="download-template" value="Download Template" /></td>
            </tr>
        </table>
        <br/>
        <div id="jqxgrid"></div>        
    </div>
</div>