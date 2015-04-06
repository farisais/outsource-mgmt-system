 <script>
 $(document).ready(function(){
    var url = "<?php echo base_url() ;?>quotation/get_cost_element";
     var source =
        {
            datatype: "json",
            datafields:
            [
                { name: 'quotation_cost_element_id'},
                { name: 'structure_name'},
                { name: 'name'},
                { name: 'description'},
                { name: 'notes'},
                
            ],
            id: 'quotation_cost_element_id',
            url: url,
            root: 'data'
        };
        
        var urlDetail = "<?php echo base_url() ;?>quotation/get_cost_element_detail";
        var sourceDetail =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id'},
                { name: 'quotation_cost_element_id'},
                { name: 'item'},
                { name: 'nominal'},
                { name: 'persentase'},
                { name: 'recipient'},
                { name: 'remarks'}
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
                var result = filter.evaluate(orders[m]["quotation_cost_element_id"]);
                if (result)
                {
                    ordersbyid.push(orders[m]);
                } 
            }
            var orderssource = {
                datafields:
                [
                    { name: 'id'},
                    { name: 'quotation_cost_element_id'},
                    { name: 'item'},
                    { name: 'nominal'},
                    { name: 'persentase'},
                    { name: 'recipient'},
                    { name: 'remarks'}
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
                      { text: 'Item', datafield: 'item'},
                      { text: 'Nominal', datafield: 'nominal', width: 150},
                      { text: 'Persentase', datafield: 'persentase', width: 150},
                      { text: 'Recipient', datafield: 'recipient' },
                      { text: 'Remarks', datafield: 'remarks'},
                   ]
                });
            }
        }
        
        $("#cost_element_grid").jqxGrid(
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
                { text: 'Struktur Name', dataField: 'structure_name', width: 150},
                { text: 'Level', dataField: 'name'},
                { text: 'Description', dataField: 'description'}, 
                
            ],
            rendertoolbar: function (toolbar) {
            $("#add_cost_element").click(function(){
                load_content_ajax(GetCurrentController(), 401, dataPost());
            });
            $("#copy_cost_element").click(function(){
                $.ajax({
            		url: 'quotation/copy_cost_element',
            		type: "POST",
            		data: 'id_quotation='+$('#id_quotation').val(),
                    dataType:'json',
            		success:function(result){
                           	if (result.success==true){
                        	    $("#cost_element_grid").jqxGrid('updatebounddata');
                            }else{
                                alert('False');
                                return false;
                            }
                            
            		}
               	});
            });
            
            }
        });
})
function dataPost()
{
    var data_post = {};
    data_post['is_edit'] = $("#is_edit").val();
    data_post['invoice_period'] = $("#invoice_period").val();    
    
    return data_post;
}
 </script>
 <div>
   
            
<div class="row-color" style="width: 100%;">
<?php //var_dump($id_quotation); ?>
    <input type="text" value="<?php echo $id_quotation ; ?>" id="id_quotation" />
    <button style="width: 30px;" id="add_cost_element">+</button>
    <button style="width: 150px;" id="copy_cost_element">Copy From Template</button>
</div>
<div id="cost_element_grid"></div>
           
</div>    