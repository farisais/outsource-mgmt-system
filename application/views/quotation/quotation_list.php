<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>quotation/get_quotation_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_quotation'},
            { name: 'quote_date', type: 'date'},
            { name: 'quote_number'},
            { name: 'inquiry'},
            { name: 'inquiry_number'},
            { name: 'status'},
            { name: 'customer_name'}
        ],
        id: 'id_quotation',
        url: url,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    var cellclass = function (row, columnfield, value){
        if (value === 'draft') {
            return 'red';
        }
        else if (value === 'close') {
            return 'green';
        }
    };
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
            { text: 'Date', dataField: 'quote_date', width: 200, cellsformat: 'dd/MM/yyyy', filtertype: 'date'},
            { text: 'Quotation No.', dataField: 'quote_number', width: 200},
            { text: 'Inquiry No.', dataField: 'inquiry_number', width: 200},
            { text: 'Customer', dataField: 'customer_name'},
            { text: 'Status', dataField: 'status', width: 100, cellclassname: cellclass}
        ]
    })               
 });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 120, null, null);
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
        item['paramValue'] = row.id_quotation;
        param.push(item);        
        data_post['id_quotation'] = row.id_quotation;
        load_content_ajax(GetCurrentController(), 121,data_post, param);
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
       if(confirm("Are you sure you want to delete data : " + row.name))
        {
            var data_post = {};
            data_post['id_quotation'] = row.id_quotation;
            //load_content_ajax(GetCurrentController(), 4 ,data_post);
        }
    }
    else
    {
        alert('Select data you want to delete first');
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