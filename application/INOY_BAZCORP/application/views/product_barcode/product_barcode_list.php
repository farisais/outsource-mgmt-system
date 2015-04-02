<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>product_barcode/get_barcode_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_po_product'},
            { name: 'po'},
            { name: 'po_number'},
            { name: 'product'},
            { name: 'date', type: 'date'},
            { name: 'product_code'},
            { name: 'product_name'},
            { name: 'product_barcode'},
        ],
        id: 'id_po_product',
        url: url,
        root: 'data'
    };

    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#jqxgrid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
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
            { text: 'PO Number', dataField: 'po_number'},
            { text: 'Date', dataField: 'date', width: 100, cellsformat: 'dd/MM/yyyy',filtertype: 'date'}, 
            { text: 'Product Code', dataField: 'product_code', width: 200},
            { text: 'Product Name', dataField: 'product_name', width: 200},
            { text: 'Barcode ID', dataField: 'product_barcode', width: 150}
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

</script>

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>

<div>

</div>