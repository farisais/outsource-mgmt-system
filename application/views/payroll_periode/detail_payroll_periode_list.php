<script>
function detail_grid_salary(organisation_structure_id,position_level,work_order_id,id_employee){
    //alert(id_employee);
    //return false;
     $("#select_structure_org_popup,#select_employee_popup").jqxWindow({
        width: 705, height: 400, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.5          
    });
    var url = "<?php echo base_url()."payroll_periode/detail_pop_up_salary/$date_start/$date_finished/$id_payroll_periode/" ;?>"+organisation_structure_id+"/"+position_level+"/"+work_order_id+"/"+id_employee;
    var source =
    {
        datatype: "json",
        datafields: [
            { name:  'salary_type' },
            { name: 'occurence' },
            { name: 'base_value' },
            { name: 'quantity' },
            {name:'total'}
        ],
        id: 'salary_type',
        url: url,
        root: 'data'
    };
    var dataAdapter_Popup = new $.jqx.dataAdapter(source);
    $("#select_employee_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width:700,
        height:290,
        autoShowLoadElement: false,
        filterable: true,
        source: dataAdapter_Popup,
        sortable: true,
        filterMode: 'advanced',
        columnsresize: true,
         rendertoolbar: function (toolbar) {
            $("#print_slip").click(function(){
                
                
            });
        },
        columns: [
          { text: 'Salary Type', dataField: 'salary_type'},     
          { text: 'Occurence', dataField: 'occurence'},
          { text: 'Base Value', dataField: 'base_value',cellsformat: 'd2'},
          { text: 'Qty', dataField: 'quantity'},
          {
              text: 'Total',width:250, editable: false, datafield: 'total',
              cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                  var total = parseFloat(rowdata.base_value) * parseFloat(rowdata.quantity);
                  var culture = {};
                    culture.currencysymbol = "Rp. ";
                    culture.currencysymbolposition = "before";
                    culture.decimalseparator = '.';
                    culture.thousandsseparator = ',';
                  return "<div style='margin: 4px;' class='jqx-right-align'>" + dataAdapter_Popup.formatNumber(total, "c2",culture) + "</div>";
              }
          }
        ]
    });
    $("#select_employee_grid").on("bindingcomplete", function (event) {
        
                var rows = $("#select_employee_grid").jqxGrid('getrows');
                
                var amount = 0;
                for(var i=0;i<rows.length;i++)
                {
                    var total = parseFloat(rows[i].base_value) * parseFloat(rows[i].quantity);
                    amount += total ;
                }
                //alert(amount);
                //alert(rows);
                //return false;
                //console.log(rows);
                var culture = {};
                culture.currencysymbol = "Rp. ";
                culture.currencysymbolposition = "before";
                culture.decimalseparator = '.';
                culture.thousandsseparator = ',';
                $("#salary-amount").html(dataAdapter_Popup.formatNumber(amount, "c2", culture));
            })
}
 $(document).ready(function () {
   
        var url = "<?php echo base_url()."payroll_periode/view_detail_wo/".$date_start."/".$date_finished."/".$id_work_order."/".$id_payroll_periode ;?>";
       
         var source =
            {
                datatype: "json",
                datafields:
                [
                    { name: 'id_employee'}, 
                    { name: 'base_salary_overtime'}, 
                    { name: 'contract_expdate'}, 
                    { name: 'contract_startdate'}, 
                    { name: 'full_name'}, 
                    { name: 'organisation_structure_id'}, 
                    { name: 'position_level'}, 
                    {name:'work_order_id'},
                    { name: 'total_salary_each_employee'}, 
                    {name:'detail'}                                                                                                                                              
                   ], 
                id: 'id_employee',
                url: url,
                root: 'data'
            };
            var renderer = function (id) {
            return '<button onClick="buttonpdf(event)" class="Pdfbutton" id="buttonpdf_' + id + '">Detail</button>';
            }
    
            
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                theme: $("#theme").val(),
                width: '100%',
                autoheight: true,
                source: dataAdapter,
                groupable: true,
                columnsresize: true,
                autoshowloadelement: false,                                                                                
                filterable: true,
                showfilterrow: true,
                sortable: true,
                autoshowfiltericon: true,
                
                pageable: false,
                //pagerrenderer: pagerrenderers,
                columns: [
                    { text: 'Full Name', dataField: 'full_name'}, 
                    { text: 'Total Salary', dataField: 'total_salary_each_employee',cellsformat: 'd'},
                    {text: 'Detail', datafield: 'email', columntype: 'button', cellsrenderer: function () {
                                return "Detail";
                            }, buttonclick: function (row) {
                                var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
                               // var dt = {id:datarow.id_invoice,email: datarow.email};
                               //alert(datarow.organisation_structure_id);
                                detail_grid_salary(datarow.organisation_structure_id,datarow.position_level,datarow.work_order_id,datarow.id_employee);
                                $("#select_employee_popup").jqxWindow('open');
                                return false;
                                $.ajax({
                                    type: "post",
                                    url: "invoice/kirim_invoice_email",
                                    data: dt,
                                    dataType: "json",
                                    success: function (hsl) {
                                        if(hsl.success==true){
                                            alert("Successed send Email !");
                                        }
                                    }
                                })
                            }}                                                          
                   
                ]
            }); 
           $("#jqxgrid").on("bindingcomplete", function (event) {
                var rows = $("#jqxgrid").jqxGrid('getrows');
                //alert(rows);
                //console.log(rows);
                var amount = 0;
                for(var i=0;i<rows.length;i++)
                {
                    amount += parseFloat(rows[i].total_salary_each_employee) ;
                }
                var culture = {};
                culture.currencysymbol = "Rp. ";
                culture.currencysymbolposition = "before";
                culture.decimalseparator = '.';
                culture.thousandsseparator = ',';
                $("#untaxed-amount").html(dataAdapter.formatNumber(amount, "c2", culture));
            })
                
                    
        });  
</script>
<script>
function back_data(){
    var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id_payroll_periode';
        item['paramValue'] = 3;
        param.push(item);        
        data_post['id_payroll_periode'] = 7;
        //console.log(row);
        //alert(row.id_payroll_periode);
        load_content_ajax(GetCurrentController(), 359 ,data_post, param);
}
</script>

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-full">
    
    <?php
    //echo $a;
    ?>
    <!--
        <a href="#" id="back-payroll" onclick="back_data()" >Back</a>
    -->
        <div id="jqxgrid"></div>
        <table style="float: right; text-align: right;margin-right: 22px; font-weight: bold; margin-top: 15px; ">
            <tr>
                <td></td>
                <td></td>
                <td style="width: 250px;"><div id="untaxed-amount">Rp. 0</div></td>
            </tr>
            
        </table>        
        
    </div>
</div>

<div id="select_employee_popup">
    <div>Detail Salary Employee</div>
        <button style="width: 70px; margin: 4px;" id="print_slip">Print</button>
    
<div id="select_employee_grid"></div>
<table style="float: right; text-align: right;margin-right: 22px; font-weight: bold; margin-top: 15px; ">
    <tr>
        <td></td>
        <td></td>
        <td style="width: 250px;"><div id="salary-amount">Rp. 0</div></td>
    </tr>
            
</table>   
      
</div>