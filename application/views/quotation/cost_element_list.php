 <script>
 function component_grid_salary_setting()
 {    
    //Source Level
    var url_unit_level = "<?php echo base_url() ;?>work_order/get_level_list";
    var unitSourceLevel =
    {
         datatype: "json",
         datafields: [
             { name: 'id_position_level'},
             { name: 'name'}
         ],
        id: 'id_position_level',
        url: url_unit_level ,
        root: 'data'
    };
    
    
    
    var unitAdapter_level = new $.jqx.dataAdapter(unitSourceLevel, {
        autoBind: true
    });
    
    var url = "<?php echo base_url() ;?>organisation_structure/get_organisation_structure_list_grid";
    var source =
    {
        datatype: "json",
        datafields: [
            { name:  'structure_org_id' },
            { name: 'structure_name' },
            { name: 'parent_structure' },
            { name: 'parent_name' }                  
        ],
        id: 'structure_org_id',
        url: url,
        root: 'data'
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#select_structure_org_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 500,
        autoShowLoadElement: false,
        filterable: true,
        source: dataAdapter,
        sortable: true,
        filterMode: 'advanced',
        columnsresize: true,
        columns: [
          { text: 'Position Name', dataField: 'structure_name'},     
        ]
    });
    
    // Event On Double click Grid Struktur Organisasi
     $('#select_structure_org_grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select_structure_org_grid').jqxGrid('getrowdata', args.rowindex);
        var commit0 = $("#cost_element_grid").jqxGrid('addrow', null, data);
        $("#select_structure_org_popup").jqxWindow('close');
        //console.log(data);
    });
    $('#txt_hidden_salary_setting').val(1);
}
function grid_cost_element_template(){
   var url_unit_level = "<?php echo base_url() ;?>work_order/get_level_list";
    var unitSourceLevel =
    {
         datatype: "json",
         datafields: [
             { name: 'id_position_level'},
             { name: 'name'}
         ],
        id: 'id_position_level',
        url: url_unit_level ,
        root: 'data'
    };
    
    
    
    var unitAdapter_level = new $.jqx.dataAdapter(unitSourceLevel, {
        autoBind: true
    });
    var url = "<?php echo base_url() ;?>quotation/get_cost_element_template";
     var source =
        {
            datatype: "json",
            datafields:
            [
                { name: 'quotation_cost_element_template_id'},
                { name: 'structure_name'},
                { name: 'name'},
                { name: 'description'},
                { name: 'notes'},
                
            ],
            id: 'quotation_cost_element_template_id',
            url: url,
            root: 'data'
        };
        
        var urlDetail = "<?php echo base_url() ;?>quotation/get_cost_element_detail_template";
        var sourceDetail =
        {
            datatype: "json",
            datafields:
            [
                { name: 'quotation_cost_element_template_id'},
                { name: 'item'},
                { name: 'nominal'},
                { name: 'persentase'},
                { name: 'recipient'},
                { name: 'remarks'},
                {name:'salary_type'},
                 {name:'salary_type_id'},
                
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
                var result = filter.evaluate(orders[m]["quotation_cost_element_template_id"]);
                if (result)
                {
                    ordersbyid.push(orders[m]);
                } 
            }
            var orderssource = {
                datafields:
                [
                    { name: 'id'},
                    { name:'salary_type'},
                    { name: 'quotation_cost_element_template_id'},
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
                      { text: 'Salary Type', datafield: 'salary_type'},
                      { text: 'Nominal', datafield: 'nominal', width: 150},
                      { text: 'Persentase', datafield: 'persentase', width: 150},
                      { text: 'Recipient', datafield: 'recipient' },
                      { text: 'Remarks', datafield: 'remarks'},
                   ]
                });
            }
        }
        
        $("#cost_element_grid_template").jqxGrid(
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
            rowdetailstemplate: { rowdetails: "<div id='grid' style='margin: 10px;'></div>", rowdetailsheight: 200, rowdetailshidden: true },
            ready: function () {
               
            },
            columns: [
                { text: 'Struktur Name', dataField: 'structure_name', width: 150},
                 { text: 'Level', dataField: 'level_employee_id', displayfield: 'name', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapter_level, displayMember: 'name', valueMember: 'id_position_level' });
            }},
                { text: 'Description', dataField: 'description'}, 
                
            ],
            rendertoolbar: function (toolbar) {
            $("#add_cost_element_template").click(function(){
                var row = $('#cost_element_grid_template').jqxGrid('getrowdata', parseInt($('#cost_element_grid_template').jqxGrid('getselectedrowindexes')));
                if(row==null){
                    alert("select Project first");
                }else{
                if(confirm("Copy Selected Data?")){
                    var rows = $("#cost_element_grid_template").jqxGrid('selectedrowindexes');
                    var selectedRecords = new Array();
                        for (var m = 0; m < rows.length; m++) {
                            var row = $("#cost_element_grid_template").jqxGrid('getrowdata', rows[m]);
                            selectedRecords[selectedRecords.length] = row.quotation_cost_element_template_id;
                        }
                        //alert(selectedRecords);
                        //return false;
                        var IdWo = selectedRecords;
                            $.ajax({
                                type : "POST",
                                url: "<?php echo base_url(); ?>quotation/copy_cost_element",
                                data : "id_template="+IdWo+"&id_quotation="+$('#id_quotation').val(),
                                success: function(data){
                                     $("#cost_element_grid").jqxGrid('updatebounddata');
                                     $("#select-cost_element-popup").jqxWindow('close');                                         
                                }
                            });
                        }
                    }
                });
            }
        });
 }
 $(document).ready(function(){
    
    $("#select_structure_org_popup").jqxWindow({
        width: 500, height: 200, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
    $("#select-cost_element-popup").jqxWindow({
        width: 1000, height: 600, resizable: true,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.04           
    });
    //
    
    
    
    var url = "<?php echo base_url() ;?>quotation/get_cost_element/"+$('#id_quotation').val();
     var source =
        {
            datatype: "json",
            datafields:
            [
                { name: 'id'},
                { name: 'quotation_cost_element_id'},
                { name: 'structure_name'},
                { name: 'name'},
                {name:'level_employee_id'},
                {name:'structure_org_id'},                
                { name: 'description'},
                { name: 'notes'},
                
            ],
         
            url: url,
            root: 'data',
            id: 'id'
        };
        
        var urlDetail = "<?php echo base_url() ;?>quotation/get_cost_element_detail";
        var sourceDetail =
        {
            datatype: "json",
            datafields:
            [
                { name : 'id'},
                { name: 'quotation_cost_element_id'},
                { name: 'item'},
                { name: 'nominal'},
                { name: 'persentase'},
                { name: 'recipient'},
                { name: 'remarks'}
            ],
            url: urlDetail,
            root: 'data',
            id: 'id',
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
                    columnsresize: true,
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
        var url_unit_level = "<?php echo base_url() ;?>work_order/get_level_list";
        var unitSourceLevel =
        {
             datatype: "json",
             datafields: [
                 { name: 'id_position_level'},
                 { name: 'name'}
             ],
            id: 'id_position_level',
            url: url_unit_level ,
            root: 'data'
        };
    
    
    
    var unitAdapter_level = new $.jqx.dataAdapter(unitSourceLevel, {
        autoBind: true
    });
    $("#cost_element_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: '100%',
        source: dataAdapter,
        rowdetails: true,
        groupable: true,
        editable: true,
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
            { text: 'Level', dataField: 'level_employee_id', displayfield: 'name', columntype: 'dropdownlist',
        createeditor: function (row, value, editor) {
            editor.jqxDropDownList({ source: unitAdapter_level, displayMember: 'name', valueMember: 'id_position_level' });
        }},
            { text: 'Description', dataField: 'description'}, 
            
        ],
        rendertoolbar: function (toolbar) {
        $("#add_cost_element").click(function(){
           // $("#add_time_schedulling").click(function(){
            //$("#cost_element_grid").jqxGrid('addrow', 0, {});
            if($('#txt_hidden_salary_setting').val()==0){
                component_grid_salary_setting();
            }
            
            var offset = $("#remove_cost_element").offset();
            $("#select_structure_org_popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove_cost_element").width() + 20, y: parseInt(offset.top)} });
            $("#select_structure_org_popup").jqxWindow('open');
            
        //});
        });
         $("#remove_cost_element").click(function(){
            var selectedrowindex = $("#cost_element_grid").jqxGrid('getselectedrowindex');
            if (selectedrowindex >= 0) {
                var id = $("#cost_element_grid").jqxGrid('getrowid', selectedrowindex);
                var commit1 = $("#cost_element_grid").jqxGrid('deleterow', id);
            }
        });
        $("#save_cost_element").click(function(){
           
        });
        $("#copy_cost_element").click(function(){
            grid_cost_element_template();
            $("#select-cost_element-popup").jqxWindow('open');
            return false;
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
function SaveData()
{
    var data_post = {};
        data_post['cost_element_grid'] = $("#cost_element_grid").jqxGrid('getrows');
        data_post['id']=$("#id_quotation").val();
        var param = [];
        var item = {};
        item['paramName'] = 'id';
        item['paramValue'] = $("#id_quotation").val();
        param.push(item);                
        load_content_ajax(GetCurrentController(), 'save_cost_element', data_post, param);
}
 </script>     

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;">Quotation / <span><?php echo $data_edit[0]['quote_number'] ?></span></h1></div>
        <div>
            <table class="table-form">
                <tr>
                    <td colspan="2">
                        <div class="row-color" style="width: 100%;">
                        <input type="hidden" value="0" id="txt_hidden_salary_setting" />
                        <?php //var_dump($id_quotation); ?>
                            <input  value="<?php echo $id_quotation ; ?>" id="id_quotation" type="hidden" />
                            <button style="width: 30px;" id="add_cost_element">+</button>
                            <button style="width: 30px;" id="remove_cost_element">-</button>
                            <!--<button style="width: 60px;" id="save_cost_element">Save</button>-->
                            <button style="width: 150px;" id="copy_cost_element">Copy From Template</button>
                        </div>
                    </td>
                </tr>   
                <tr>
                    <td colspan="2">
                        <div id="cost_element_grid"></div>
                    </td>
                </tr>       
            </table>
            
        </div>
    </div>
</div>

              
<div id="select-cost_element-popup" style="width: 80%;">
    <div>Select Cost Element</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                <div class="row-color" style="width: 100%;">
                    <button style="width: 150px;" id="add_cost_element_template">Copy From Template</button>
                </div>
                    <div id="cost_element_grid_template"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="select_structure_org_popup">
    <div>Select position</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select_structure_org_grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>