<script>
    $(document).ready(function () {
        var url = "<?php echo base_url(); ?>cost_element/get_cost_element_template";
        var source = {
            datatype: "json",
            datafields:
                    [
                        {name: 'quotation_cost_element_template_id'},
                        {name: 'structure_name'},
                        {name: 'name'},
                        {name: 'description'}
                    ],
            id: 'quotation_cost_element_template_id',
            url: url,
            root: 'data'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
       

        var urlDetail = "<?php echo base_url(); ?>cost_element/get_cost_element_detail_template";
        var sourceDetail = {
            datatype: "json",
            datafields:
                    [
                        {name: 'quotation_cost_element_template_id'},
                        {name: 'item'},
                        {name: 'nominal'},
                        {name: 'persentase'},
                        {name: 'recipient'},
                        {name: 'remarks'}
                    ],
            url: urlDetail,
            root: 'data',
            async: false
        };
        var dataDetailAdapter = new $.jqx.dataAdapter(sourceDetail, {autoBind: true});
        var orders = dataDetailAdapter.records;
        var nestedGrids = new Array();
        var initrowdetails = function (index, parentElement, gridElement, record)
        {
            var id = record.uid.toString();
            var grid = $($(parentElement).children()[0]);
            //alert(JSON.stringify(grid));
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
                var result = filter.evaluate(orders[m]["quotation_cost_element_template_id"]);
                if (result)
                {
                    ordersbyid.push(orders[m]);
                }
                
            }
            var orderssource = {
                datafields:
                        [
                            {name: 'quotation_cost_element_template_id'},
                            {name: 'item'},
                            {name: 'nominal'},
                            {name: 'persentase'},
                            {name: 'recipient'},
                            {name: 'remarks'}
                        ],
                id: 'quotation_cost_element_template_id',
                localdata: ordersbyid
            }
            var nestedGridAdapter = new $.jqx.dataAdapter(orderssource);
            if (grid != null) {
                grid.jqxGrid({
                    theme: $("#theme").val(),
                    source: nestedGridAdapter, width: '90%', height: 150,
                    columns: [
                        {text: 'Item', datafield: 'item'},
                        {text: 'Nominal', datafield: 'nominal', width: 150},
                        {text: 'Persentase', datafield: 'persentase', width: 150},
                        {text: 'Recipient', datafield: 'recipient'},
                        {text: 'Remarks', datafield: 'remarks'},
                    ]
                });
            }
        }
        
         $("#cost_element_grid").jqxGrid(
                {
                    theme: $("#theme").val(),
                    width: '100%',
                    height: '590',
                    source: dataAdapter,
                    rowdetails: true,
                    groupable: true,
                    columnsresize: true,
                    autoshowloadelement: false,
                    selectionmode: 'multiplerows',
                    filterable: true,
                    showfilterrow: true,
                    sortable: true,
                    autoshowfiltericon: true,
                    initrowdetails: initrowdetails,
                    rowdetailstemplate: {rowdetails: "<div id='grid' style='margin: 10px;'></div>", rowdetailsheight: 200, rowdetailshidden: true},
                    ready: function () {

                    },
                    columns: [
                        {text: 'Struktur Name', dataField: 'structure_name'},
                        {text: 'Level', dataField: 'name'},
                        {text: 'Description', dataField: 'description'}
                    ]
                });

    });

    function dataPost()
    {
        var data_post = {};
        data_post['is_edit'] = $("#is_edit").val();
        data_post['invoice_period'] = $("#invoice_period").val();

        return data_post;
    }
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 403, null, null);
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
        item['paramValue'] = row.id_so;
        param.push(item);        
        data_post['id_so'] = row.id_so;
        load_content_ajax(GetCurrentController(), 74, data_post, param);
    }
    else
    {
        alert('Select menu you want to edit first');
    }                            
}

function DeleteData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));

    if(row != null)
    {
       if(confirm("Are you sure you want to delete menu : " + row.name))
        {
            var data_post = {};
            data_post['id_application_action'] = row.id_application_action;
            //load_content_ajax(GetCurrentController(), 4 ,data_post);
        }
    }
    else
    {
        alert('Select menu you want to delete first');
    }
}

</script>

<div>
    <div id="cost_element_grid"></div>
</div>
