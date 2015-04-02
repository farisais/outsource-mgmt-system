<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>po/get_po_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_po'},
            { name: 'supplier'},
            { name: 'po_number'},
            { name: 'note'},
            { name: 'date', type: 'date'},
            { name: 'status'},
            { name: 'total_price', type: 'number'},
            { name: 'supplier_name'},
            { name: 'mr'},
            { name: 'mr_number'},
            { name: 'delivery_date', type: 'date'},
        ],
        id: 'id_product',
        url: url,
        root: 'data'
    };
    var cellclass = function (row, columnfield, value) 
    {
        if (value == 'draft') {
            return 'red';
        }
        else if(value == 'close')
        {
            return 'green';
        }
    }
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#jqxgrid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: '92%',
        source: dataAdapter,
        groupable: true,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        filterable: true,
        showfilterrow: true,
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'PO Number', dataField: 'po_number', width: 100},
            { text: 'MR Number', dataField: 'mr_number', width: 100},
            { text: 'Supplier', dataField: 'supplier', displayField: 'supplier_name'},
            { text: 'Date', dataField: 'date', width: 200, cellsformat: 'dd/MM/yyyy',filtertype: 'date'}, 
            { text: 'Delivery Date', dataField: 'delivery_date', width: 200, cellsformat: 'dd/MM/yyyy',filtertype: 'date'}, 
            { text: 'Total Price', dataField: 'total_price', width: 200, cellsformat: 'c2'},
            { text: 'Status', dataField: 'status', width: 100, cellclassname: cellclass}
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
function CreateData()
{
    load_content_ajax(GetCurrentController(), 58, null, null);
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
        item['paramValue'] = row.id_po;
        param.push(item);        
        data_post['id_po'] = row.id_po;
        load_content_ajax(GetCurrentController(), 59 ,data_post, param);
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

<div>

</div>