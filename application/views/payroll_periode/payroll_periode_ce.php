<script>
function formatDate(date) {
        var foo = date;
        var arr = foo.split("/");
        return arr[2]+'-'+arr[1]+'-'+arr[0];
}
function buttonclick(){
    //alert('ok');
      var id = event.target.id;
      var data = $('#project-wo-grid').jqxGrid('getrowdata', id);
      //alert(data);
      var data_post = {};
        //console.log(data);
        //data_post['is_edit'] = $("#is_edit").val();
        data_post['id_work_order'] = data.id_work_order;
        
        date_start = $("#date_start").val();
        data_post['date_start'] = formatDate(date_start);
        
        date_finished = $("#date_finish").val();
        //alert(formatDate(date_finished));
        //return false;
        data_post['date_finished'] = formatDate(date_finished);
        load_content_ajax(GetCurrentController(), 393, data_post);
    // alert(data.customer_name + " " + data.id_work_order);
}
function buttonclick_aprove(){
      var id = event.target.id;
      var data = $('#payroll-wo-grid').jqxGrid('getrowdata', id);
              
      var data_post = {};

        //data_post['is_edit'] = $("#is_edit").val();
        data_post['id_work_order'] = data.id_work_order;
        
        date_start = $("#date_start").val();
        data_post['date_start'] = formatDate(date_start);
        
        date_finished = $("#date_finish").val();
        //alert(formatDate(date_finished));
        //return false;
        data_post['date_finished'] = formatDate(date_finished)
        //alert(data_post['date_finished']);
      //return false;    ;
        load_content_ajax(GetCurrentController(), 393, data_post);
    // alert(data.customer_name + " " + data.id_work_order);
}
    $(document).ready(function () {
        $('#generate-payroll').on('click', function(e) {  
            
        });
        $("#delete-payroll").on('click', function(e){
            var row = $('#payroll-wo-grid').jqxGrid('getrowdata', parseInt($('#payroll-wo-grid').jqxGrid('getselectedrowindexes')));
            if(row==null){
                alert("select Project first");
            }else{
            if(confirm("Delete Selected Data?")){
                var rows = $("#payroll-wo-grid").jqxGrid('selectedrowindexes');
                var selectedRecords = new Array();
                    for (var m = 0; m < rows.length; m++) {
                        var row = $("#payroll-wo-grid").jqxGrid('getrowdata', rows[m]);
                        selectedRecords[selectedRecords.length] = row.id;
                    }
                        var IdWo = selectedRecords;
                        var IdPayrollperiode=$("#id_payroll_periode").val();
                            $.ajax({
                                type : "POST",
                                url: "<?php echo base_url(); ?>payroll_periode/delete_payroll_po",
                                data : "id_wo="+IdWo+"&idpayrollperiode="+IdPayrollperiode,
                                success: function(data){
                                     $("#payroll-wo-grid").jqxGrid('updatebounddata');
                                }
                            });
            }
        }
        });
        $("#select-project-popup").jqxWindow({
            width: 800, height: 500, resizable: false, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
        });
       
        
                
        $("#date_start,#date_finish").jqxDateTimeInput({width: '250px', height: '25px', value: null});
        //$("#date_finish").jqxDateTimeInput({width: '250px', height: '25px'});

<?php 

if (isset($is_edit)) : ?>
     $('.document-action').show();
     $("#date_start").jqxDateTimeInput('val', <?php echo "'" . date('m/d/Y', strtotime($data_edit->date_start)) . "'"; ?>);
     $("#date_finish").jqxDateTimeInput('val', <?php echo "'" . date('m/d/Y', strtotime($data_edit->date_finish)) . "'"; ?>);
     
        var urlproject = "<?php echo base_url().'payroll_periode/get_work_order_list/'.$data_edit->date_start.'/'.$data_edit->date_finish ; ?>";
        var sourceproject =
                {
                    datatype: "json",
                    datafields:
                            [
                               { name: 'id_work_order'},
                                { name: 'work_order_number'},
                                { name: 'date', type: 'date'},
                                { name: 'so_number'},
                                { name: 'so'},
                                { name: 'customer_name'},
                                { name: 'status'},
                                { name: 'project_name'},
                                { name: 'contract_startdate'},
                                { name: 'contract_expdate'},
                                { name: 'total_amount_salary'}
                            ],
                    id: 'id_work_order',
                    url: urlproject,
                    root: 'data'
                };
        var dataAdapterproject = new $.jqx.dataAdapter(sourceproject);
        var cellsrenderer = function (id) {
                	return '<input type="button" onClick="buttonclick(event)" class="gridButton" id="' + id + '" value="Detail"/>'
                }
        
        $("#project-wo-grid").jqxGrid(
                {
                    theme: $("#theme").val(),
                    width: '100%',
                    height:200,
                    selectionmode: 'multiplerows',
                    source: dataAdapterproject,
                    columnsresize: true,
                    autoshowloadelement: false,
                    sortable: true,
                    filterable: true,
                    showfilterrow: true,
                    autoshowfiltericon: true,
                    rendertoolbar: function (toolbar) {
                        $("#add_po_approve").click(function(){
                            var data_post = {};
                            var row = $('#project-wo-grid').jqxGrid('getrowdata', parseInt($('#project-wo-grid').jqxGrid('getselectedrowindexes')));
                            if(row==null){
                                alert("select Project first");
                            }else{
                            var rows = $("#project-wo-grid").jqxGrid('selectedrowindexes');
                            var selectedRecords = new Array();
                            for (var m = 0; m < rows.length; m++) {
                                var row = $("#project-wo-grid").jqxGrid('getrowdata', rows[m]);
                                selectedRecords[selectedRecords.length] = row.id_work_order;
                            }
                            var IdWo = selectedRecords;
                            var IdPayrollperiode=$("#id_payroll_periode").val();
                                $.ajax({
                                   type : "POST",
                                   url: "<?php echo base_url(); ?>payroll_periode/update_payroll_po",
                                   data : "id_wo="+IdWo+"&idpayrollperiode="+IdPayrollperiode,
                                   success: function(data){
                                        $("#payroll-wo-grid").jqxGrid('updatebounddata');
                                    }
                                });
                                }
                        });
                    },
                    columns: [
                        { text: 'Customer Name', dataField: 'customer_name'},
                        { text: 'Project Name', dataField: 'project_name'},
                        { text: 'Start Project', dataField: 'contract_startdate'},
                        { text: 'End Project', dataField: 'contract_expdate'},
                        { text: 'Amount', dataField: 'total_amount_salary',cellsformat: 'd'},
                        { text: 'Detail',width:52,cellsalign:'center', dataField: 'id_work_order', cellsrenderer: cellsrenderer }
                    ]
                });
                
                $("#project-wo-grid").on("bindingcomplete", function (event) {
                    var rows = $("#project-wo-grid").jqxGrid('getrows');
                    //alert(rows);                    
                    var amount = 0;
                    for(var i=0;i<rows.length;i++)
                    {
                        amount += parseFloat(rows[i].total_amount_salary) ;
                    }
                    //alert($('#project-amount').val());                    
                    var culture = {};
                    culture.currencysymbol = "Rp. ";
                    culture.currencysymbolposition = "before";
                    culture.decimalseparator = '.';
                    culture.thousandsseparator = ',';
                    $("#total_amount").html(dataAdapterproject.formatNumber(amount, "c2", culture));
                })
            
                                //grid 2
                var urlproject_approve = "<?php echo base_url()."payroll_periode/get_wo_list/".$data_edit->date_start."/".$data_edit->date_finish."/" ;?>"+$('#id_payroll_periode').val();
                var sourceproject_approve =
                        {
                            datatype: "json",
                            datafields:
                                    [
                                        { name: 'id'},
                                        { name: 'project_name'},
                                        { name: 'contract_startdate'},
                                        { name: 'contract_expdate'},
                                        { name: 'customer_name'},
                                        { name: 'periode_name'},
                                        { name: 'contract_startdate'},
                                        { name: 'contract_expdate'},
                                        { name: 'total_amount_salary'},
                                        {name:'id_payroll_wo'},
                                        {name:'id_work_order'}
                                    ],
                            id: 'id_work_order',
                            url: urlproject_approve,
                            root: 'data'
                        };
                var dataAdapterproject_approve = new $.jqx.dataAdapter(sourceproject_approve);
                var cellsrenderer_approve = function (id) {
                	return '<input type="button" onClick="buttonclick_aprove(event)" class="gridButton" id="' + id + '" value="Detail"/>'
                }                
                $("#payroll-wo-grid").jqxGrid(
                        {
                            theme: $("#theme").val(),
                            width: '100%',
                            height:200,
                            selectionmode: 'multiplerows',
                            source: dataAdapterproject_approve,
                            columnsresize: true,
                            autoshowloadelement: false,
                            sortable: true,
                            filterable: true,
                            showfilterrow: true,
                            autoshowfiltericon: true,
                            rendertoolbar: function (toolbar) {
                                    $("#remove_po_approve").click(function(){
                                        var row = $('#payroll-wo-grid').jqxGrid('getrowdata', parseInt($('#payroll-wo-grid').jqxGrid('getselectedrowindexes')));
                                        if(row==null){
                                            alert("select Project first");
                                        }else{
                                        if(confirm("Delete Selected Data?")){
                                            var rows = $("#payroll-wo-grid").jqxGrid('selectedrowindexes');
                                            var selectedRecords = new Array();
                                                for (var m = 0; m < rows.length; m++) {
                                                    var row = $("#payroll-wo-grid").jqxGrid('getrowdata', rows[m]);
                                                    selectedRecords[selectedRecords.length] = row.id_payroll_wo;
                                                }
                                                    var IdWo = selectedRecords;
                                                    var IdPayrollperiode=$("#id_payroll_periode").val();
                                                        $.ajax({
                                                            type : "POST",
                                                            url: "<?php echo base_url(); ?>payroll_periode/delete_payroll_po",
                                                            data : "id_wo="+IdWo+"&idpayrollperiode="+IdPayrollperiode,
                                                            success: function(data){
                                                                 $("#payroll-wo-grid").jqxGrid('updatebounddata');
                                                            }
                                                        });
                                        }
                                    }
                                    });
                                },
                            columns: [
                                { text: 'Customer Name', dataField: 'customer_name'},
                                { text: 'Project Name', dataField: 'project_name'},
                               /*
                                 { text: 'Salary Period', dataField: 'periode_name'},
                                */
                                { text: 'Start Project', dataField: 'contract_startdate'},
                                { text: 'End Project', dataField: 'contract_expdate'},
                                { text: 'Amount', dataField: 'total_amount_salary',cellsformat: 'd',width:122},
                                { text: 'Detail',width:52,cellsalign:'center', dataField: 'id_work_order', cellsrenderer: cellsrenderer_approve }
                            ]
                });
                $("#payroll-wo-grid").on("bindingcomplete", function (event) {
                    var rows = $("#payroll-wo-grid").jqxGrid('getrows');
                    //alert(rows);                    
                    var amount = 0;
                    for(var i=0;i<rows.length;i++)
                    {
                        amount += parseFloat(rows[i].total_amount_salary) ;
                    }
                    //alert($('#project-amount').val());                    
                    var culture = {};
                    culture.currencysymbol = "Rp. ";
                    culture.currencysymbolposition = "before";
                    culture.decimalseparator = '.';
                    culture.thousandsseparator = ',';
                    $("#total_amount_approve").html(dataAdapterproject_approve.formatNumber(amount, "c2", culture));
                })
                
<?php endif; ?>

    });

    function SaveData() {
        var data_post = {};

        data_post['periode_name'] = $("#periode_name").val();
        data_post['date_start'] = $("#date_start").val();
        data_post['date_finish'] = $("#date_finish").val();

        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_payroll_periode'] = $("#id_payroll_periode").val();

        load_content_ajax(GetCurrentController(), 392, data_post);
    }

    function DiscardData()
    {
        load_content_ajax('payroll_periode', 356, null);
    }

</script>

<style>
    .table-form
    {
        margin: 30px;
        width: 100%;
    }

    .table-form tr td
    {

    }

    .table-form tr
    {
        height: 35px;
    }

    .field 
    { 
        border: 1px solid #c4c4c4; 
        height: 15px; 
        width: 80%; 
        font-size: 11px; 
        padding: 4px 4px 4px 4px; 
        border-radius: 4px; 

    } 

    select.field
    {
        height: 26px;
    }

    .field:focus 
    { 
        outline: none; 
        border: 1px solid #7bc1f7; 
    } 

    .label
    {
        font-size: 11pt;
        width: 50px;
        padding-right: 20px;
        font: -webkit-small-control;
    }


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_payroll_periode" value="<?php echo (isset($is_edit) ? $data_edit->id_payroll_periode : '') ?>" />
<div class="document-action" style="display: none;">
    <?php if (isset($is_edit) && $data_edit->status == 'draft'): ?><button id="generate-payroll">Generate</button><?php endif; ?>
    
    <ul class="document-status">
        
        <li <?php echo (isset($is_edit) && $data_edit->status == 'draft' ? 'class="status-active"' : '') ?>>
            <span class="label">Draft</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit->status == 'generate_all' ? 'class="status-active"' : '') ?>>
            <span class="label">All</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit->status == 'generate_partial' ? 'class="status-active"' : '') ?>>
            <span class="label">Partial</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>

<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div style="padding: 15px; padding-bottom: 50px;">
            <table class="table-form">
                <tr>
                    <td class="label">
                        Periode Name
                    </td>
                    <td>
                        <input class="field" type="text" id="periode_name" name="periode_name" value="<?php echo (isset($is_edit) ? $data_edit->periode_name : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Periode Start
                    </td>
                    <td>
                        <div id="date_start" name="date_start" style="display: inline-block;"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        periode Finish
                    </td>
                    <td>                        
                        <div id="date_finish" name="date_finish" style="display: inline-block;"></div>
                    </td>
                </tr>
            </table>
             <?php if (isset($is_edit)){
                //echo "<input type='hidden' value='$data_edit->date_finish' id='date_finish' />";
            ?>
            <div class="row-color" style="width: 100%; margin: 0px;">
                        <button style="width: 70px;" id="add_po_approve">Approve</button>
            </div>
            <div id="project-wo-grid"></div>
            <table style="float: right; text-align: right;margin-right: 22px; font-weight: bold; margin-top: 15px; ">
                <tr>
                    <td></td>
                    <td></td>
                    <td style="width: 250px;"><div id="total_amount">Rp. 0</div></td>
                </tr>
                
            </table>   
           
            <div class="row-color" style="width: 100%; margin: 0px; margin-top: 80px;">
                <button style="width: 70px;" id="remove_po_approve">Remove</button>
            </div>
            <div id="payroll-wo-grid"></div>
            <table style="float: right; text-align: right;margin-right: 22px; font-weight: bold; margin-top: 15px; ">
                <tr>
                    <td></td>
                    <td></td>
                    <td style="width: 250px;"><div id="total_amount_approve">Rp. 0</div></td>
                </tr>
                
            </table> 
            <?php
            }
            ?>
        </div>
    </div>
</div>




<div id="select-project-popup">
    <div>Select Project</div>
    <div id="select-project-grid"></div>
</div>
