<script>
function detail_grid_salary(organisation_structure_id,position_level,work_order_id,id_employee)
{
    $("#select_employee_grid").jqxGrid(
    {
        theme: $("#theme").val(),
        width:700,
        height:290,
        autoShowLoadElement: false,
        filterable: true,
        sortable: true,
        filterMode: 'advanced',
        columnsresize: true,
        rendertoolbar: function (toolbar) {
            $("#print_slip").click(function(){

            });
        },
        columns: [
            { text: 'Name', dataField: 'name', width: 150},
            { text: 'Value', dataField: 'value', cellsformat: 'd2', width: 100},
            { text: 'Qty', dataField: 'qty', cellsformat: 'd2', width: 60 },
            { text: 'Calc. Value', dataField: 'calc_value', cellsformat: 'd2', width: 100},
            { text: 'Aggregate Value', dataField: 'aggregate', cellsformat: 'd2', width: 100},
            { text: 'THP', dataField: 'thp', cellsformat: 'd2', width: 100},
            { text: 'Remark', dataField: 'remark', width: 150}
        ]
    });
    $("#select_employee_grid").on("bindingcomplete", function (event)
    {
        var rows = $("#select_employee_grid").jqxGrid('getrows');

        var amount = 0;
        for(var i=0;i<rows.length;i++)
        {
            var total = parseFloat(rows[i].base_value) * parseFloat(rows[i].quantity);
            amount += total ;
        }

    });

    get_employee_salary(organisation_structure_id, position_level, work_order_id, id_employee);
}

function get_employee_salary(organisation_structure_id, position_level, work_order_id, id_employee)
{
    var url = "<?php echo base_url()."payroll_periode/detail_pop_up_salary/$date_start/$date_finished/$id_payroll_periode/" ;?>" + organisation_structure_id + "/" + position_level + "/" + work_order_id + "/" + id_employee;
    var data_post = {};
    loadAjaxGif();
    $.ajax({
        url: url,
        type: "GET",
        dataType:'json',
        success:function(output)
        {
            unloadAjaxGif();
            //alert(JSON.stringify(output));
            var dataAdapter = new $.jqx.dataAdapter();
            var culture = {};
            culture.currencysymbol = "Rp. ";
            culture.currencysymbolposition = "before";
            culture.decimalseparator = '.';
            culture.thousandsseparator = ',';

            $("#select_employee_grid").jqxGrid('clear');
            for(i=0;i<output.detail_calculation.length;i++)
            {
                var data = output.detail_calculation[i];
                $("#select_employee_grid").jqxGrid('addrow', null, data);

            }

            $("#salary-amount").html(dataAdapter.formatNumber(output.total, "c2", culture));
        },
        error:function(jqXhr)
        {
            if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                var json = $.parseJSON( jqXhr.responseText );
                alert(json);
            }

            unloadAjaxGif();
        }
    });
}

$(document).ready(function () {

     $("#select_employee_popup").jqxWindow({
         width: 705, height: 400, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.5
     });
    var url = "<?php echo base_url()."payroll_periode/view_detail_wo/".$date_start."/".$date_finished."/".$id_work_order."/".$id_payroll_periode ;?>";

    var source =
    {
        datatype: "json",
        datafields:
        [
            { name: 'id_employee'},
            { name: 'employee_number'},
            { name: 'base_salary_overtime'},
            { name: 'contract_expdate'},
            { name: 'contract_startdate'},
            { name: 'full_name'},
            { name: 'organisation_structure_id'},
            { name: 'position_level'},
            { name: 'work_order_id'},
            { name: 'total_salary_each_employee'},
            { name: 'net_salary_each_employee'},
            { name: 'detail'},
            { name: 'pph'},
            { name: 'jamsostek'}
           ],
        id: 'id_employee',
        url: url,
        root: 'data'
    };
    var renderer = function (id)
    {
        return '<button onClick="buttonpdf(event)" class="Pdfbutton" id="buttonpdf_' + id + '">Detail</button>';
    }


    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#jqxgrid").jqxGrid(
    {
        theme: $("#theme").val(),
        width: '100%',
        autoheight: true,
        source: dataAdapter,
        columnsresize: true,
        autoshowloadelement: false,
        filterable: true,
        showfilterrow: true,
        sortable: true,
        autoshowfiltericon: true,
        pageable: false,
        //pagerrenderer: pagerrenderers,
        columns: [
            { text: 'ID', dataField: 'employee_number', width: 80},
            { text: 'Full Name', dataField: 'full_name'},
            { text: 'Gross Salary', dataField: 'total_salary_each_employee', cellsformat: 'd', width: 100},
            { text: 'Net Salary', dataField: 'net_salary_each_employee', cellsformat: 'd', width: 100},
            { text: 'Jamsostek', dataField: 'jamsostek', cellsformat: 'd' , width: 100},
            { text: 'PPH 21', dataField: 'pph', cellsformat: 'd' , width: 100},
            { text: 'Detail', datafield: 'email', columntype: 'button', cellsrenderer: function () {
                        return "Detail";
                    }, buttonclick: function (row) {
                        var datarow = $("#jqxgrid").jqxGrid('getrowdata', row);
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
    });

    $("#generate-payslip").click(function(){
        <?php
        if(isset($is_edit) && $data_edit[0]['status_po'] != 'generated' || !isset($is_edit))
        {
        ?>
        if(confirm("This will generate payslip for all the employees under this work order, press OK to continue.") == true) {
            var data_post = {};
            data_post['id_payroll_periode'] = <?php echo $id_payroll_periode ?>;
            data_post['id_work_order'] = <?php echo $id_work_order ?>;
            data_post['date_start'] = '<?php echo $date_start ?>';
            data_post['date_finished'] = '<?php echo $date_finished ?>';
            load_content_ajax(GetCurrentController(), 'generate_payslip', data_post);
        }
        <?php
        }
        ?>
    });
                
                    
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
        load_content_ajax(GetCurrentController(), 359 ,data_post, param);
}
function DiscardData()
{

}
</script>
<div class="document-action">
    <?php
    if(isset($is_edit) && $data_edit[0]['status_po'] != 'generated' || !isset($is_edit))
    {?>
        <button style="margin-left: 20px;" id="generate-payslip">Generate Payroll</button>
    <?php
    }
    ?>
    <ul class="document-status">
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_po'] == 'draft' ? 'class="status-active"' : '') ?> >
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_po'] == 'approve' ? 'class="status-active"' : '') ?>>
            <span class="label">Approve</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['status_po'] == 'generated' ? 'class="status-active"' : '') ?>>
            <span class="label">Generated</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px; padding-bottom: 50px">
        <div><h1 style="font-size: 18pt; font-weight: bold;">WO Payroll / <span><?php echo (isset($is_edit) ? $work_order[0]['work_order_number'] : ''); ?></span></h1></div>
        <table class="table-form">
            <tr>
                <td colspan="3">
                    <div class="row-color" style="width: 100%; margin: 0px;">
                        <button style="width: 70px;" id="add_po_approve">Approve</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div id="jqxgrid"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Total Gross Salary : </td>
                <td style="width: 150px;font-weight: bold"><div id="untaxed-amount">Rp. 0</div></td>
            </tr>
        </table>
    </div>
</div>

<div id="select_employee_popup">
    <div>Detail Salary Employee</div>
    <div>
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
</div>