<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>gr/get_gr_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_gr'},
                    { name: 'po'},
                    { name: 'po_number'},
                    { name: 'date', type: 'date'},
                    { name: 'do'},
                    { name: 'gr_number'},
                    { name: 'status'},
                    
                ],
                id: 'id_gr',
                url: url,
                root: 'data'
            };
            var cellclass = function (row, columnfield, value) 
            {
                if (value == 'transfer') {
                    return 'green';
                }
            }
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                height: '95%',
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: [
                    { text: 'Purchase Order', dataField: 'po_number', width: 200},
                    { text: 'Good Receive No.', dataField: 'gr_number'},
                    { text: 'Receive Date', dataField: 'date', cellsformat: 'dd/MM/yyyy',filtertype: 'date'},
                    { text: 'Status', dataField: 'status', width: 100, cellclassname: cellclass}
                    
                ]
            });
            
            
        $("#jqxgrid").on("rowdoubleclick", function(event){
        var row = $('#jqxgrid').jqxGrid('getrowdata', event.args.rowindex);
        
        if(row != null)
        {
            var data_post = {};
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = row.id_gr;
            param.push(item);        
            data_post['id_gr'] = row.id_gr;
            load_content_ajax(GetCurrentController(), 199 ,data_post, param);
            
        }
       
    });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 68, null, null);
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
        item['paramValue'] = row.id_gr;
        param.push(item);        
        data_post['id_gr'] = row.id_gr;
        load_content_ajax(GetCurrentController(), 69 ,data_post, param);
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
       if(confirm("Are you sure you want to delete Good Receipt : " + row.gr_number))
        {
            var data_post = {};
            data_post['id_gr'] = row.id_gr;
            load_content_ajax(GetCurrentController(), 70 ,data_post);
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