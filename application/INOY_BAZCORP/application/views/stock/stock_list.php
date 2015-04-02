<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>stock/get_stock_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_product'},
                    { name: 'product_category'},
                    { name: 'merk'},
                    { name: 'product_code'},
                    { name: 'product_name'},
                    { name: 'merk_name'},
                    { name: 'category_name'},
                    { name: 'total_qty', type: 'number'},
                    { name: 'unit_name'}
                ],
                id: 'id_product',
                url: url,
                root: 'data'
            };
            
            var urlDetail = "<?php echo base_url() ;?>stock/get_stock_gudang";
            var sourceDetail =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_product'},
                    { name: 'id_warehouse'},
                    { name: 'kode_lokasi'},
                    { name: 'warehouse_name'},
                    { name: 'unit_name'},
                    { name: 'total_qty', type: 'number'}
                ],
                url: urlDetail,
                root: 'data',
                async: false
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            var dataDetailAdapter = new $.jqx.dataAdapter(sourceDetail, {autoBind: true});
            var orders = dataDetailAdapter.records;
            //alert(JSON.stringify(orders.toString()));
            var nestedGrids = new Array();
            var initrowdetails = function(index, parentElement, gridElement, record)
            {
                var id = record.uid.toString();
                var grid = $($(parentElement).children()[0]);
                nestedGrids[index] = grid;
                var filtergroup = new $.jqx.filter();
                var filter_or_operator = 1;
                var filtervalue = id;
                var filtercondition = 'equal';
                var filter = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
                // fill the orders depending on the id.
                var ordersbyid = [];
                for (var m = 0; m < orders.length; m++) 
                {
                    //alert(JSON.stringify(orders[m]));
                    var result = filter.evaluate(orders[m]["id_product"]);
                    if (result)
                    {
                        ordersbyid.push(orders[m]);
                    } 
                }
                var orderssource = {
                    datafields:
                    [
                        { name: 'id_product'},
                        { name: 'id_warehouse'},
                        { name: 'kode_lokasi'},
                        { name: 'warehouse_name'},
                        { name: 'unit_name'},
                        { name: 'total_qty', type: 'number'}
                    ],
                    id: 'id',
                    localdata: ordersbyid
                }
                var nestedGridAdapter = new $.jqx.dataAdapter(orderssource);
                if (grid != null) {
                    grid.jqxGrid({
                        theme: $("#theme").val(),
                        source: nestedGridAdapter, width: '90%', height: 150,
                        columns: [
                          { text: 'Warehouse Name', datafield: 'warehouse_name'},
                          { text: 'Code', datafield: 'kode_lokasi', width: 100 },
                          { text: 'Unit', datafield: 'unit_name', width: 150},
                          { text: 'Qty', datafield: 'total_qty', width: 150, cellsformat: 'd2'}
                       ]
                    });
                }
            }
            
            $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: '100%',
                source: dataAdapter,
                rowdetails: true,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                initrowdetails: initrowdetails,
                rowdetailstemplate: { rowdetails: "<div id='grid' style='margin: 10px;'></div>", rowdetailsheight: 200, rowdetailshidden: true },
                ready: function () {
                   
                },
                columns: [
                    { text: 'Product Code', dataField: 'product_code', width: 150},
                    { text: 'Name', dataField: 'product_name'},
                    { text: 'Category', dataField: 'category_name', width: 200}, 
                    { text: 'Merk', dataField: 'merk_name', width: 100},
                    { text: 'Total Qty', dataField: 'total_qty', width: 100, cellsformat: 'd2'},
                    { text: 'Unit', dataField: 'unit_name', width: 100},
                ]
            });
                        
        }); 

</script>
<script>
function view_detail()
{
    alert('test');
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>