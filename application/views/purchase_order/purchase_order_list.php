<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxgrid.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxgrid.selection.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxgrid.grouping.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>jqwidgets/jqxgrid.columnsresize.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/jqxdata.js"></script> 

<script>
 $(document).ready(function () {
        var url = "<?php echo base_url() ;?>purchase_order/get_po_list";
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'po_number'}, 
                    { name: 'supplier'}, 
                    { name: 'date'},
                ],
                id: 'id_po',
                url: url,
                root: 'data'
            };
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
                    { text: 'PO No.', dataField: 'id_application_action', width: 40},
                    { text: 'date', dataField: 'name', width: 200}, 
                    { text: 'Supplier', dataField: 'controller'},
                ]
            });
                        
        });  
</script>
<script>
function CreateData()
{
    load_content_ajax(GetCurrentController(), 2, null, null);
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
        item['paramValue'] = row.id_application_action;
        param.push(item);        
        data_post['id_application_action'] = row.id_application_action;
        load_content_ajax(GetCurrentController(), 3 ,data_post, param);
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
            load_content_ajax(GetCurrentController(), 4 ,data_post);
        }
    }
    else
    {
        alert('Select menu you want to delete first');
    }
}

</script>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
        <div id="jqxgrid">
        </div>
    </div>
</div>