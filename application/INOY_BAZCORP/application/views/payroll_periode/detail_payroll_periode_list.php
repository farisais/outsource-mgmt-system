<script>
 $(document).ready(function () {
        var url = "<?php echo base_url()."payroll_periode/view_detail_wo/".$date_start."/".$date_finished."/".$id_work_order ;?>";
       
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
                    { name: 'total_overtime'}, 
                    { name: 'total_salary'},
                    { name: 'sum_total_salary'},                                                                                                                                               
                   ], 
                id: 'id_employee',
                url: url,
                root: 'data'
            };
            
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
                    { text: 'ID Employee', dataField: 'id_employee'},
                    { text: 'Full Name', dataField: 'full_name'}, 
                    { text: 'Base Salary', dataField: 'total_salary'}, 
                    { text: 'Base Salary Overtime',aggregates: ['sum', 'avg'],cellsformat: 'c2', dataField: 'base_salary_overtime'}, 
                    { text: 'Total Overtime', dataField: 'total_overtime'},
                    { text: 'Total Salary', dataField: 'sum_total_salary', 
                        cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                            var total = parseFloat(rowdata.total_salary) + (parseFloat(rowdata.base_salary_overtime) * parseFloat(rowdata.total_overtime));
                            var culture = {};
                            culture.currencysymbol = "Rp. ";
                            culture.currencysymbolposition = "before";
                            culture.decimalseparator = '.';
                            culture.thousandsseparator = ',';
                            return "<div style='margin: 4px;' class='jqx-right-align'>" + dataAdapter.formatNumber(total, "c2", culture) + "</div>";
                        }
                    }                                                            
                   
                ]
            }); 
           $("#jqxgrid").on("bindingcomplete", function (event) {
                var rows = $("#jqxgrid").jqxGrid('getrows');
                //alert(rows);
                //console.log(rows);
                var amount = 0;
                for(var i=0;i<rows.length;i++)
                {
                    amount += parseFloat(rows[i].total_salary) + (parseFloat(rows[i].base_salary_overtime) * parseFloat(rows[i].total_overtime));
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
function CreateData()
{
    load_content_ajax('payroll_periode', 298, null);
}

function EditData()
{
    var row = $('#jqxgrid').jqxGrid('getrowdata', parseInt($('#jqxgrid').jqxGrid('getselectedrowindexes')));
    if(row != null)
    {
        var data_post = {};
        var param = [];
        var item = {};
        item['paramName'] = 'id_payroll_periode';
        item['paramValue'] = row.id_payroll_periode;
        param.push(item);        
        data_post['id_payroll_periode'] = row.id_payroll_periode;
        //console.log(row);
        //alert(row.id_payroll_periode);
        load_content_ajax(GetCurrentController(), 300 ,data_post, param);
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
            data_post['id_payroll_periode'] = row.id_payroll_periode;
            load_content_ajax(GetCurrentController(), 301 ,data_post);
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
    
    <?php
    //echo $a;
    ?>
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