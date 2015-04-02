<script>
 $(document).ready(function () {
    var url = "<?php echo base_url() ;?>inquiry/get_inquiry_list";
    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_inquiry'},
            { name: 'inquiry_number'},
            { name: 'inquiry_date', type: 'date'},
            { name: 'customer_name'},
            { name: 'expected_delivery', type: 'date'},
            { name: 'notes'},
            { name: 'status'}
        ],
        id: 'id_inquiry',
        url: url,
        root: 'data'
    };
    
    var cellclass = function (row, columnfield, value) 
    {
        if (value === 'draft') {
            return 'red';
        }
        else if (value === 'close') {
            return 'green';
        }
    }
    var dataAdapter = new $.jqx.dataAdapter(source);
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
            { text: 'Number', dataField: 'inquiry_number', width: 200},
            { text: 'Date', dataField: 'inquiry_date', width: 200, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
            { text: 'Customer', dataField: 'customer_name'},
            { text: 'Expected Delivery', dataField: 'expected_delivery', width: 200, cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
            { text: 'Status', dataField: 'status', width: 100, cellclassname: cellclass}
        ]
    });
                
    });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 110, null, null);
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
        item['paramValue'] = row.id_inquiry;
        param.push(item);        
        data_post['id_inquiry'] = row.id_inquiry;
        load_content_ajax(GetCurrentController(), 111 ,data_post, param);
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
       if(confirm("Are you sure you want to delete data : " + row.inquiry_number))
        {
            var data_post = {};
            data_post['id_inquiry'] = row.id_inquiry;
            load_content_ajax(GetCurrentController(), 112, data_post);
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