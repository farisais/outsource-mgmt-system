<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/handons.js"></script>
<link rel="stylesheet" media="screen" href="http://handsontable.com/dist/handsontable.full.css">
<link rel="stylesheet" media="screen" href="<?php echo base_url() ?>css/handons.css">
<script>
function component_grid_so_assignment(){    
    
}
function component_grid_salary_setting(){    
    // Grid Struktur Organisasi
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
        //data['qty_request'] = 0;
        //data['qty_deliver'] = 0;
        //data['remark'] = '';
        var commit0 = $("#salary-setting-grid").jqxGrid('addrow', null, data);
        $("#select_structure_org_popup").jqxWindow('close');
        //console.log(data);
    });
    $('#txt_hidden_salary_setting').val(1);
}
$(document).ready(function(){
    //validate Work Order
    $("#wo_validate").on('click', function(e) {  
            var data_post = {};
            var param = [];
            var item = {};
            item['paramName'] = 'id';
            item['paramValue'] = <?php echo $data_edit[0]['id_work_order'] ?>;
            param.push(item);        
            data_post['id_work_order'] = <?php echo $data_edit[0]['id_work_order'] ?>;
            load_content_ajax(GetCurrentController(), 315, data_post, param);
            e.preventDefault();
        });    
    // Grid Employee
    var url_employee = "<?php echo base_url() ;?>work_order/get_work_order_so_assignment_popup";
    var source_employee =
    {
        datatype: "json",
        datafields: [
            { name: 'so_assignment_number'},
            { name: 'full_name'},
            { name: 'structure_name'},
            { name: 'level_posisi'}              
        ],
        id: 'so_assignment_number',
        url: url_employee,
        root: 'data'
    };
    var dataAdapter_employee = new $.jqx.dataAdapter(source_employee);
    $("#select_employee_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 500,
        autoShowLoadElement: false,
        filterable: true,
        source: dataAdapter_employee,
        sortable: true,
        filterMode: 'advanced',
        columnsresize: true,
        columns: [
          { text: 'Full Name', dataField: 'full_name'}, 
          { text: 'Position', dataField: 'structure_name'}, 
          { text: 'Level', dataField: 'level_posisi'},     
        ]
    });
    
    // Event On Double click Grid Employee
     $('#select_employee_grid').on('rowdoubleclick', function (event) 
    {
        var args = event.args;
        var data = $('#select_employee_grid').jqxGrid('getrowdata', args.rowindex);
        var commit0 = $("#so-assignment-grid").jqxGrid('addrow', null, data);
        $("#select_employee_popup").jqxWindow('close');
        
    });
     //Source Level
    var url_unit = "<?php echo base_url() ;?>work_order/get_level_list"
    var unitSource =
    {
         datatype: "json",
         datafields: [
             { name: 'id_position_level'},
             { name: 'name'}
         ],
        id: 'id_position_level',
        url: url_unit ,
        root: 'data'
    };
    
    var unitAdapter_level = new $.jqx.dataAdapter(unitSource, {
        autoBind: true
    });
    
     //Source Employee
    var url_employee_grid = "<?php echo base_url() ;?>work_order/get_employee_grid/<?php echo $data_edit[0]['id_work_order']; ?>"
    var unitSource_employee_grid =
    {
         datatype: "json",
         datafields: [
             { name: 'full_name'},
             { name: 'id_employee'}
         ],
        id: 'id_employee',
        url: url_employee_grid ,
        root: 'data'
    };
    
    var unitAdapter_employee_grid = new $.jqx.dataAdapter(unitSource_employee_grid, {
        autoBind: true
    });
    
    //Source Level
    
    var urlTS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_time_schedule?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    
    var unitTS =
    {
         datatype: "json",
         datafields: [
             { name: 'id'},
             { name: 'kode_schedule'}
         ],
        id: 'id',
        url: urlTS ,
        root: 'data'
    };
    
    var unitAdapterTS = new $.jqx.dataAdapter(unitTS, {
        autoBind: true
    });
    
    
    //Source Salary Type
     var url_unit = "<?php echo base_url() ;?>work_order/get_salary_type"
     var unitSource =
     {
         datatype: "json",
         datafields: [
             { name: 'id'},
             { name: 'salary_type'}
         ],
        id: 'id',
        url: url_unit ,
        root: 'data'
     };
    
    var unitAdapter_salary_type = new $.jqx.dataAdapter(unitSource, {
        autoBind: true
    });
    //Inisiasi Form untuk input employee
    $("#select_structure_org_popup,#select_employee_popup").jqxWindow({
        width: 600, height: 300, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });
      
  
    $('#work-order-tabs').jqxTabs({ width: '100%', autoHeight: false,position: 'top', scrollPosition: 'right'});
    
    $("#work-order-date").jqxDateTimeInput({width: '250px', height: '25px'}); 
    $("#delivery-date").jqxDateTimeInput({width: '250px', height: '25px', value: null}); 
    
    <?php if(isset($is_edit)) :?>
    $("#work-order-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date'])) . "'" ?>);
    $("#delivery-date").jqxDateTimeInput('val', <?php echo "'" . date( 'd/m/Y' , strtotime($data_edit[0]['date_delivery'])) . "'" ?>);
    <?php endif; ?>
        
    //=================================================================================
    //
    //   Unit Measure Data
    //
    //=================================================================================
    
    var url_unit = "<?php echo base_url() ;?>unit_measure/get_unit_measure_list";
    var unitSource =
    {
         datatype: "json",
         datafields: [
             { name: 'id_unit_measure'},
             { name: 'name'}
         ],
        id: 'id_unit_measure',
        url: url_unit,
        root: 'data'
    };
    
    var unitAdapter = new $.jqx.dataAdapter(unitSource, {
        autoBind: true
    });
    
    //=================================================================================
    //
    //   work_order Grid
    //
    //=================================================================================
    
    var url = "<?php if (isset($is_edit)):?><?php echo base_url()?>work_order/get_work_order_product_list?id=<?php echo $data_edit[0]['id_work_order']; ?> <?php endif; ?>";
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
            { name: 'name'},
            { name: 'unit_name', value: 'unit', values: { source: unitAdapter.records, value: 'id_unit_measure', name: 'name' } },
            { name: 'unit'},            
            { name: 'category_name'},
            { name: 'qty', type: 'number'}
        ],
        id: 'id_product',
        url: url ,
        root: 'data'
    };
    
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#work-order-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapter,
        editable: false,
        columnsresize: true,
        autoshowloadelement: false,                                                                                
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Product Code', dataField: 'product_code'},
            { text: 'Product', dataField: 'product_name'},
            { text: 'Unit', dataField: 'unit_name'},
            { text: 'Qty Request', dataField: 'qty', cellsformat: 'd2', width: 100}
        ]
    });
    
  
    
    //=================================================================================
    //
    //   Working Schedule Assignment Grid
    //
    //=================================================================================
    
    var urlWS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_schedule/get_work_schedule_detail_list?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceWS =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_detail_work_schedule'},
            { name: 'area'},
            { name: 'id_customer_site'},
            { name: 'site'},
            { name: 'site_name'},
            { name: 'shift_no'},
            { name: 'qty', type: 'number'},
            { name: 'working_hour'},
            { name: 'time_start'},
            { name: 'time_end'},
            { name: 'level'},
            { name: 'jumlah_hari'},
            { name: 'hari'},
            { name: 'working_hour_type_name', type: 'string'}
        ],
        id: 'id_employee',
        url: urlWS ,
        root: 'data'
    };
    var dataAdapterWS = new $.jqx.dataAdapter(sourceWS);
    $("#working-schedule-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterWS,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        columns: [
            { text: 'Site', dataField: 'site', displayfield: 'site_name', width: 100},
            { text: 'Area', dataField: 'area', width: 100},
            { text: 'Shift', dataField: 'shift_no', width: 100},
            { text: 'Working Hour', datafield: 'working_hour', width: 100},
             { text: 'Time Start', datafield: 'time_start', width: 100},
              { text: 'Time End', datafield: 'time_end', width: 100},
            { text: 'Qty', dataField: 'qty', cellsformat: 'd2', width: 100},
            { text: 'Level', dataField: 'level', width: 100},
            { text: 'Jumlah Hari', dataField: 'jumlah_hari', width: 130},
            { text: 'Hari', dataField: 'hari', width: 300}
        ]
    });
    
    //=================================================================================
    //
    //   Salary Setting Grid
    //
    //=================================================================================
    
    var urlSS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_work_order_salary_setting?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceSS =
    {
        datatype: "json",
        datafields:
        [


            { name: 'id'},
            { name: 'structure_org_id'},
            { name: 'salary_type_id'},
            { name: 'level_employee_id'},
            { name: 'value'},
            { name: 'occurence'},
            { name: 'structure_name'},
            { name: 'salary_type'},
            { name: 'level_name'},

            { name: 'id_contract'},
            { name: 'filename'},
            { name: 'startdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'expdate', type: 'date', format: "yyyy-MM-dd"},
            { name: 'invoice_term'},
            { name: 'status'}

        ],
        id: 'id',
        url: urlSS ,
        root: 'data'
    };
    var dataAdapterSS = new $.jqx.dataAdapter(sourceSS);
    $("#salary-setting-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        source: dataAdapterSS,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        editable: true,        
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add_salary_setting").click(function(){
                if($('#txt_hidden_salary_setting').val()==0){
                    component_grid_salary_setting();    
                }
                
                var offset = $("#remove_salary_setting").offset();
                $("#select_structure_org_popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove_salary_setting").width() + 20, y: parseInt(offset.top)} });
                $("#select_structure_org_popup").jqxWindow('open');
            });
            $("#remove_salary_setting").click(function(){
                var selectedrowindex = $("#salary-setting-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#salary-setting-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#salary-setting-grid").jqxGrid('deleterow', id);
                }
            });
            $("#save_salary_setting").click(function(){
                var data_post = {};
                data_post['salary_setting'] = $("#salary-setting-grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
               
            $.ajax({
        		url: 'work_order/save_wo_salary_setting',
        		type: "POST",
        		data: data_post,
                dataType:'json',
        		success:function(result){
                       	//if (result.success==true){
                    	    $('#salary-setting-grid').jqxGrid('updatebounddata');
                            //$("#jqxgrid").jqxGrid('updatebounddata');
                            //$('#salary-setting-grid').trigger("reloadGrid");
                       // }else{
                            //$("#jqxNotification").jqxNotification('open');
                         //   return false;
                        //}
                        
        		}
           	})
             location.reload();
             $('#work-order-tabs').jqxTabs('select', 2); 
             });
        },        
        columns: [

            { text: 'Structure Organization',displayfield: 'structure_name', dataField: 'structure_org_id'},
            { text: 'Level', dataField: 'level_employee_id', displayfield: 'level_name', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapter_level, displayMember: 'name', valueMember: 'id_position_level' });
            }},
             { text: 'Salary Type', dataField: 'salary_type_id', displayfield: 'salary_type', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapter_salary_type, displayMember: 'salary_type', valueMember: 'id' });
            }},
            { text: 'Value', datafield: 'value', width: 100},
             {
                        text: 'Occurence', datafield: 'occurence', width: 150, columntype: 'dropdownlist',
                        createeditor: function (row, column, editor) {
                            // assign a new data source to the dropdownlist.
                            var list = ['Per Tahun', 'Per Bulan', 'Per Minggu',, 'Per Hari', 'Per Jam'];
                            editor.jqxDropDownList({ autoDropDownHeight: true, source: list });
                        }
                    },
            

        ]
    });
     //   END Salary Setting Grid
   
    //   Salary SO Assignment Grid
    var urlSO = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_work_order_so_assignment?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceSO =
    {
        datatype: "json",
        datafields:
        [

            { name: 'id_so_assignment'},
             { name: 'so_assignment_number'},
            { name: 'full_name'},
            { name: 'structure_name'},
            { name: 'level_posisi'}
        ],
        id: 'id_so_assignmnent',
        url: urlSO ,
        root: 'data'
    };
    var dataAdapterSO = new $.jqx.dataAdapter(sourceSO);
    $("#so-assignment-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterSO,
        columnsresize: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add_so_assignment").click(function(){
                //component_grid_so_assignment();
                var offset = $("#remove_so_assignment").offset();
                $("#select_employee_popup").jqxWindow({ position: { x: parseInt(offset.left) + $("#remove_so_assignment").width() + 20, y: parseInt(offset.top)} });
                $("#select_employee_popup").jqxWindow('open');
                //var selectedrowindex = $("#so-assignment-grid").jqxGrid('getselectedrowindex');
                //console.log(selectedrowindex);
            });
            $("#remove_so_assignment").click(function(){
                var selectedrowindex = $("#so-assignment-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#so-assignment-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#so-assignment-grid").jqxGrid('deleterow', id);
                }
            });
            
            $("#save_so_assignment").click(function(){
                var data_post = {};
                data_post['so_assignment'] = $("#so-assignment-grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
                $.ajax({
            		url: 'work_order/save_wo_so_assignment',
            		type: "POST",
            		data: data_post,
                    dataType:'json',
            		success:function(result){
            		  
        		}
           	    })
               location.reload();
                //$('#so-assignment-grid').jqxGrid('updatebounddata');
             });
        },
        columns: [
            { text: 'ID', dataField: 'so_assignment_number', width: 50},
            { text: 'Name', dataField: 'full_name'},
            { text: 'Position', dataField: 'structure_name', width: 150},
            { text: 'Level', dataField: 'level_posisi', width: 150}
            
        ]
    });
    
    //=================================================================================
    //
    //   End SO Assignment  Grid
    //
    //=================================================================================
    var shifts = [
        {label: '1', value: '1'},
        {label: '2', value: '2'},
        {label: '3', value: '3'}        
    ];
    var hours = [
        {label: '8 Hours', value: '8'},
        {label: '12 Hours', value: '12'}
    ];
    var structures = [
        {label: 'Security Office', value: '1'}, 
        {label: 'Shift Leader', value: '2'}, 
        {label: 'Security Supervisor', value: '3'}
    ];
    
     //=================================================================================
    //
    //   Time Schedulling Grid
    //
    //=================================================================================
    
    var urlTS = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_work_order_time_schedulling?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
    var sourceTS =
    {
        datatype: "json",
        url: urlTS ,
        datafields:
        [

 
            { name: 'id'},
            { name: 'kode_schedule'},
            { name: 'nama_schedule'},
            { name: 'from_time'},
            { name: 'to_time'},
            { name: 'late_in_tolerance'},
            { name: 'early_out_tolerance'}        ],
       
        id: 'id_employee',
       

        root: 'data'
    };
    var dataAdapterTS = new $.jqx.dataAdapter(sourceTS);
    $("#time-schedulling-grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 200,
        selectionmode : 'singlerow',
        source: dataAdapterTS,
        columnsresize: true,
        editable: true,
        autoshowloadelement: false,
        sortable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add_time_schedulling").click(function(){
                $("#time-schedulling-grid").jqxGrid('addrow', 5, {});
                //alert('ok');
            });
            $("#remove_time_schedulling").click(function(){
                var selectedrowindex = $("#time-schedulling-grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#time-schedulling-grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#time-schedulling-grid").jqxGrid('deleterow', id);
                }
            });
            $("#save_time_schedulling").click(function(){
                var data_post = {};
                data_post['time_schedulling'] = $("#time-schedulling-grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
                $.ajax({
            		url: 'work_order/save_wo_time_schedulling',
            		type: "POST",
            		data: data_post,
                    dataType:'json',
            		success:function(result){
            		  
        		}
           	    })
                location.reload();
             });
        },
        columns: [ 

            
            { text: 'Kode', dataField: 'kode_schedule', width: 100},
            { text: 'Schedule Description', dataField: 'nama_schedule'},
            { text: 'From', dataField: 'from_time', width: 100, cellsformat: 't'},
            { text: 'To', dataField: 'to_time', width: 100, cellsformat: 't'},
            { text: 'Late Tolerance (minutes)', dataField: 'late_in_tolerance', width: 100},
            { text: 'Early Tolerance (minutes)', dataField: 'early_out_tolerance', width: 100}
          

        ]
    });
    
    //=================================================================================
    //
    //   Time Schedulling  Grid
    //
    //=================================================================================
    
    
    //=================================================================================
    //
    //   Shift Rotation Grid
    //
    //=================================================================================
     var urlSR = "<?php if (isset($is_edit)):?><?php echo base_url() ;?>work_order/get_shift_rotation?id=<?php echo $data_edit[0]['id_work_order']; ?><?php endif; ?>";
   
    var sourceSR=
    {
        datatype: "json",
        url: urlSR ,
        datafields:
        [
            { name: 'employee_id'},
             { name: 'id'},
            { name: 'tahun'},
            { name: 'bulan'},
            { name: 'full_name'},
            { name: '01'},{ name: '02'},{ name: '03'},{ name: '04'},{ name: '05'},
            { name: '06'},{ name: '07'},{ name: '08'},{ name: '09'},{ name: 'd10'},
            { name: 'd11'},{ name: 'd12'},{ name: 'd13'},{ name: 'd14'},{ name: 'd15'},
            { name: 'd16'},{ name: 'd17'},{ name: 'd18'},{ name: 'd19'},{ name: 'd20'},
            { name: 'd21'},{ name: 'd22'},{ name: 'd23'},{ name: 'd24'},{ name: 'd25'},
            { name: 'd26'},{ name: 'd27'},{ name: 'd28'},{ name: 'd29'},{ name: 'd30'},
            { name: 'd31'},
            { name: 'd01'},{ name: 'd02'},{ name: 'd03'},{ name: 'd04'},{ name: 'd05'},
            { name: 'd06'},{ name: 'd07'},{ name: 'd08'},{ name: 'd09'},{ name: 'dd10'},
            { name: 'dd11'},{ name: 'dd12'},{ name: 'dd13'},{ name: 'dd14'},{ name: 'dd15'},
            { name: 'dd16'},{ name: 'dd17'},{ name: 'dd18'},{ name: 'dd19'},{ name: 'dd20'},
            { name: 'dd21'},{ name: 'dd22'},{ name: 'dd23'},{ name: 'dd24'},{ name: 'dd25'},
            { name: 'dd26'},{ name: 'dd27'},{ name: 'dd28'},{ name: 'dd29'},{ name: 'dd30'},
            { name: 'dd31'}
        ],
       id: 'id',
       root: 'data'
    };
    var dataAdapterSR = new $.jqx.dataAdapter(sourceSR);
    $("#shift_rotation_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        height: 300,
        selectionmode : 'singlerow',
        source: dataAdapterSR,
        columnsresize: true,
        editable: true,
        filterable: true,
        autoshowloadelement: false,
        sortable: true,
        pageable: true,
        autoshowfiltericon: true,
        rendertoolbar: function (toolbar) {
            $("#add_shift_rotation").click(function(){
                $("#shift_rotation_grid").jqxGrid('addrow', 5, {});
                //alert('ok');
            });
            $("#copy_shift_rotation").click(function(){
               
                var index_rows = $('#shift_rotation_grid').jqxGrid('selectedrowindex');
                var data = $('#shift_rotation_grid').jqxGrid('getrowdata',index_rows);
                $("#shift_rotation_grid").jqxGrid('addrow', 5, data);
              //   var args = event.args;
        
                //alert('ok');
            });
            $("#remove_shift_rotation").click(function(){
                var selectedrowindex = $("#shift_rotation_grid").jqxGrid('getselectedrowindex');
                if (selectedrowindex >= 0) {
                    var id = $("#shift_rotation_grid").jqxGrid('getrowid', selectedrowindex);
                    var commit1 = $("#shift_rotation_grid").jqxGrid('deleterow', id);
                }
            });
            $("#save_shift_rotation").click(function(){
                var data_post = {};
                data_post['shift_rotation'] = $("#shift_rotation_grid").jqxGrid('getrows');
                data_post['id']=$("#id_work_order").val();
                $.ajax({
            		url: 'work_order/save_wo_shift_rotation',
            		type: "POST",
            		data: data_post,
                    dataType:'json',
            		success:function(result){
            		  
        		}
           	    })
               location.reload();
             });
        },
        columns: [

            
            { text: 'Employee Name', width: 160,dataField: 'employee_id', displayfield: 'full_name', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapter_employee_grid, displayMember: 'full_name', valueMember: 'id_employee' });
            }},
             { text: 'Tahun', dataField: 'tahun', columntype: 'TextBox',width: 60},
            { text: 'Bulan', dataField: 'bulan', columntype: 'TextBox',width: 60},
            { text: '01', cellsalign: 'center', width: 40,dataField: '01', displayfield: 'd01', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '02', cellsalign: 'center', width: 40,dataField: '02', displayfield: 'd02', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '03', cellsalign: 'center', width: 40,dataField: '03', displayfield: 'd03', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '04', cellsalign: 'center', width: 40,dataField: '04', displayfield: 'd04', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '05', cellsalign: 'center', width: 40,dataField: '05', displayfield: 'd05', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '06', cellsalign: 'center', width: 40,dataField: '06', displayfield: 'd06', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '07', cellsalign: 'center', width: 40,dataField: '07', displayfield: 'd07', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '08', cellsalign: 'center', width: 40,dataField: '08', displayfield: 'd08', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '09', cellsalign: 'center', width: 40,dataField: '09', displayfield: 'd09', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '10', cellsalign: 'center', width: 40,dataField: 'd10', displayfield: 'dd10', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '11', cellsalign: 'center', width: 40,dataField: 'd11', displayfield: 'dd11', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '12', cellsalign: 'center', width: 40,dataField: 'd12', displayfield: 'dd12', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '13', cellsalign: 'center', width: 40,dataField: 'd13', displayfield: 'dd13', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '14', cellsalign: 'center', width: 40,dataField: 'd14', displayfield: 'dd14', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '15', cellsalign: 'center', width: 40,dataField: 'd15', displayfield: 'dd15', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '16', cellsalign: 'center', width: 40,dataField: 'd16', displayfield: 'dd16', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '17', cellsalign: 'center', width: 40,dataField: 'd17', displayfield: 'dd17', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '18', cellsalign: 'center', width: 40,dataField: 'd18', displayfield: 'dd18', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '19', cellsalign: 'center', width: 40,dataField: 'd19', displayfield: 'dd19', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '20', cellsalign: 'center', width: 40,dataField: 'd20', displayfield: 'dd20', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '21', cellsalign: 'center', width: 40,dataField: 'd21', displayfield: 'dd21', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '22', cellsalign: 'center', width: 40,dataField: 'd22', displayfield: 'dd22', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '23', cellsalign: 'center', width: 40,dataField: 'd23', displayfield: 'dd23', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '24', cellsalign: 'center', width: 40,dataField: 'd24', displayfield: 'dd24', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '25', cellsalign: 'center', width: 40,dataField: 'd25', displayfield: 'dd25', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '26', cellsalign: 'center', width: 40,dataField: 'd26', displayfield: 'dd26', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '27', cellsalign: 'center', width: 40,dataField: 'd27', displayfield: 'dd27', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '28', cellsalign: 'center', width: 40,dataField: 'd28', displayfield: 'dd28', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '29', cellsalign: 'center', width: 40,dataField: 'd29', displayfield: 'dd29', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '30', cellsalign: 'center', width: 40,dataField: 'd30', displayfield: 'dd30', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            { text: '31', cellsalign: 'center', width: 40,dataField: 'd31', displayfield: 'dd31', columntype: 'dropdownlist',
            createeditor: function (row, value, editor) {
                editor.jqxDropDownList({ source: unitAdapterTS, displayMember: 'kode_schedule', valueMember: 'id' });
            }},
            

        ]
    });
    
    
}); 
  

</script>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_work_order" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_work_order'] : '') ?>" />
<div class="document-action"><?php //print_r($shif_rotations) ; ?>

<?php //print_r($shif_rotations); ?>
    <button id="wo_validate">Validate</button>
    <ul class="document-status">
        <li <?php 
            if(isset($is_edit))
            {
                if($data_edit[0]['status'] == 'draft')
                {
                    echo 'class="status-active"';
                }
            }
            else
            {
                echo 'class="status-active"';
            }
        ?> >
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'open' ? 'class="status-active"' : '') ?>>
            <span class="label">Open</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'withdrawn' ? 'class="status-active"' : '') ?>>
            <span class="label">Withdrawn</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status'] == 'close' ? 'class="status-active"' : '') ?>>
            <span class="label">Close</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
   
    <div class="form-center" style="padding: 20px;">
    <div><h1 style="font-size: 18pt; font-weight: bold;"><span><?php echo (isset($is_edit) ? $data_edit[0]['work_order_number'] : ''); ?></span>
    / <span><?php echo (isset($is_edit) ? tgl_indo($data_edit[0]['contract_startdate']).' - '.tgl_indo($data_edit[0]['contract_expdate']) : ''); ?></span></h1>
    
    </div>
        <div>
            <table class="table-form">
                <tr>
                    <td>
                        <div class="label">
                            Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="work-order-date" style="display: inline-block;"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                           Expected Delivery Date
                        </div>
                        <div class="column-input" colspan="2">
                            <div id="delivery-date" style="display: inline-block;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">
                            SO Ref.
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="so-number" name="so_number" value="<?php echo (isset($is_edit) ? $data_edit[0]['so_number'] : '') ?>" readonly="readonly"/>
                            <input name="so" type="hidden" value="<?php echo (isset($is_edit) ? $data_edit[0]['so'] : '') ?>"/>
                        </div>
                    </td>
                    <td>
                        <div class="label">
                            Customer
                        </div>
                        <div class="column-input" colspan="2">
                            <input style="display:inline; width: 70%; font: -webkit-small-control; padding-left: 5px;" class="field" type="text" id="customer-name" name="customer_name" value="<?php echo (isset($is_edit) ? $data_edit[0]['customer_name'] : '') ?>" readonly="readonly"/>
                            <input name="customer" type="hidden" value="<?php echo (isset($is_edit) ? $data_edit[0]['customer'] : '') ?>"/>
                        </div>
                    </td>
                </tr>                
            </table>
            <div id='work-order-tabs' style="margin-top: 20px;height: 400px;">
                <ul>
                    <li>Product & Services</li>
                    <li>Working Schedule</li>
                    <li>Salary Setting</li>
                    <li>SO Assignment</li>
                    <li>Time Schedulling</li>
                     <li>Shift Rotation</li>
                    <li>Contract</li>
                    <li>Purchase Requirement</li>    
                                                        
                </ul>
                <div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="work-order-grid"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 80%;padding-top: 20px;" colspan="2">
                                <div class="label">
                                    Notes
                                </div>
                                <textarea class="field" cols="10" rows="20" style="height: 50px;"></textarea>
                            </td>
                        </tr>                        
                    </table>
                </div>
                <div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="working-schedule-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_salary_setting">+</button>
                        <button style="width: 30px;" id="remove_salary_setting">-</button>
                        <button style="width: 60px;" id="save_salary_setting">save</button>
                        <input type="hidden" value="0" id="txt_hidden_salary_setting" />
                    </div>
                                 
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="salary-setting-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_so_assignment">+</button>
                        <button style="width: 30px;" id="remove_so_assignment">-</button>
                        <button style="width: 60px;" id="save_so_assignment">save</button>
                    </div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="so-assignment-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_time_schedulling">+</button>
                        <button style="width: 30px;" id="remove_time_schedulling">-</button>
                        <button style="width: 60px;" id="save_time_schedulling">save</button>
                    </div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="time-schedulling-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <div class="row-color" style="width: 98%; margin: 5px;">
                        <button style="width: 30px;" id="add_shift_rotation">+</button>
                        <button style="width: 30px;" id="remove_shift_rotation">-</button>
                        <button style="width: 60px;" id="copy_shift_rotation">copy</button>
                        <button style="width: 60px;" id="save_shift_rotation">save</button>
                    </div>
                    <table class="table-form" style="margin: 5px; width: 98%;">
                        <tr>
                            <td colspan="2">
                                <div id="shift_rotation_grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div id="contract-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div> 
                <div>
                    <table class="table-form" style="margin: 20px; width: 90%;">
                        <tr>
                            <td colspan="2">
                                <div id="procurement-requirement-grid"></div>
                            </td>
                        </tr>
                    </table>
                </div>  
                                      
            </div>
        </div>
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
<div id="select_employee_popup">
    <div>Select Employee</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select_employee_grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>