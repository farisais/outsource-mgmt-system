<script>
    $(document).ready(function () {
         var payroll_combo = [
        <?php
        foreach($payroll as $at)
            {
                echo '{ value: "'. $at['id_payroll_wo'] .'", label: "'. $at['customer_name'] .'"},';
            }
            ?>
        ];
            
    $("#payroll_combo").jqxComboBox({ source: payroll_combo, displayMember: 'label', valueMember: 'value'});

        $("#select-project-popup").jqxWindow({
            width: 800, height: 500, resizable: false, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01
        });

        $("#invoice_date").jqxDateTimeInput({ height: '25px', value: null});

<?php if (isset($is_edit)) : ?>
            $('.document-action').show();
            $("#invoice_date").jqxDateTimeInput('val', <?php echo "'" . date('m/d/Y', strtotime($data_edit->invoice_date)) . "'"; ?>);
<?php endif; ?>

    });

    function SaveData() {
        var data_post = {};

        data_post['sub_total'] = $("#sub_total").val();
        data_post['tax'] = $("#tax").val();
        data_post['total_price'] = $("#total_price").val();
        data_post['total_payment'] = $("#total_payment").val();
        data_post['status'] = $("#status").val();
        data_post['invoice_receipt_number'] = $("#invoice_receipt_number").val();

        data_post['invoice_date'] = $("#invoice_date").val();
        data_post['invoice_method'] = $("#invoice_method").val();
        data_post['so'] = $("#so").val();
        data_post['rekening'] = $("#rekening").val();
        data_post['work_order'] = $("#work_order").val();
        data_post['email'] = $("#email").val();

        data_post['is_edit'] = $("#is_edit").val();
        data_post['id_invoice'] = $("#id_invoice").val();

        load_content_ajax(GetCurrentController(), 396, data_post);
    }

    function DiscardData()
    {
        load_content_ajax('payroll_periode', 395, null);
    }

</script>

<style>
    .table-form
    {
        margin: 30px;
        width: 95%;
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
<input type="hidden" id="id_invoice" value="<?php echo (isset($is_edit) ? $data_edit->id_invoice : '') ?>" />

<div id='form-container' style="font-size: 12px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center">
        <div>
            <table class="table-form">
                
                <tr>
                    <td width="10%" class="label">
                        Payroll
                    </td>
                    <td width="30%">
                        <div id="payroll_combo"></div>
                    </td>
                    <td width="30%" class="label">
                    </td>
                    <td width="30%">
                     
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="label">
                        Sub Total
                    </td>
                    <td width="30%">
                        <input class="field" type="text" id="sub_total" name="sub_total" value="<?php echo (isset($is_edit) ? $data_edit->sub_total : '') ?>"/>
                    </td>
                    <td width="30%" class="label">
                        Tax
                    </td>
                    <td width="30%">
                        <input class="field" type="text" id="tax" name="tax" value="<?php echo (isset($is_edit) ? $data_edit->tax : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Total Price
                    </td>
                    <td>                        
                        <input class="field" type="text" id="total_price" name="total_price" value="<?php echo (isset($is_edit) ? $data_edit->total_price : '') ?>"/>
                    </td>
                    <td class="label">
                        Total Payment
                    </td>
                    <td>                        
                        <input class="field" type="text" id="total_payment" name="total_payment" value="<?php echo (isset($is_edit) ? $data_edit->total_payment : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Status
                    </td>
                    <td>                        
                        <input class="field" type="text" id="status" name="status" value="<?php echo (isset($is_edit) ? $data_edit->status : '') ?>"/>
                    </td>
                    <td class="label">
                        Invoice Receipt Number
                    </td>
                    <td>                        
                        <input class="field" type="text" id="invoice_receipt_number" name="invoice_receipt_number" value="<?php echo (isset($is_edit) ? $data_edit->invoice_receipt_number : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Invoice Date
                    </td>
                    <td>                        
                        <div id="invoice_date" name="invoice_date" style="display: inline-block;"></div>
                    </td>
                    <td class="label">
                        Invoice Method
                    </td>
                    <td>                        
                        <input class="field" type="text" id="invoice_method" name="invoice_method" value="<?php echo (isset($is_edit) ? $data_edit->invoice_method : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Sales Order
                    </td>
                    <td>                        
                        <input class="field" type="text" id="so" name="so" value="<?php echo (isset($is_edit) ? $data_edit->so : '') ?>"/>
                    </td>
                    <td class="label">
                        Rekening Bank
                    </td>
                    <td>                        
                        <input class="field" type="text" id="rekening" name="rekening" value="<?php echo (isset($is_edit) ? $data_edit->rekening : '') ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Work Order
                    </td>
                    <td>                        
                        <input class="field" type="text" id="work_order" name="work_order" value="<?php echo (isset($is_edit) ? $data_edit->work_order : '') ?>"/>
                    </td>
                    <td class="label">
                        Email
                    </td>
                    <td>
                        <input class="field" type="text" id="email" name="email" value="<?php echo (isset($is_edit) ? $data_edit->email : '') ?>"/>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div id="project-wo-grid"></div>


<div id="select-project-popup">
    <div>Select Project</div>
    <div id="select-project-grid"></div>
</div>
