<style>
.report-wrapper{
    width: 21cm;
    font-family: Verdana, Tahoma, Calibri;
    font-size: 10pt;
    padding: 20px;
}
.report-header
{
    margin: 0 auto;
    text-align: center;
}

.company-data
{
    float: right;
}

.company-logo-report
{
    margin-bottom: 20px;
    float: left;
}

.company-name-report
{
    font-size: 11pt;
    font-weight: bold;
}

.company-address-report
{
    width: 200px;
    position: relative;
    text-align: right;
    float: right;
}

.report-sub-content
{
    /* float: left; */
/* width: 200px; */
    height: 100px;
    position: relative;
    margin-top: 40px;
}

.first-col-report
{
    float: left;
    position: relative;
    width: 250px;
}

.second-col-report
{
    position: relative;
    float: right;
}

.report-data
{
    margin: 0 auto;
    width: 100%;
}

.report-data-content
{
    position: relative;
    /* float: left; */
    font-family: calibri, verdana, tahoma;
    font-size: 10pt;
    text-align: center;
    width: 100%;
    
    border: solid thin lightgray;
    min-height: 200px;
}

.report-data-content table
{

    width: 100%;
    
    border-spacing: 0px;
}

.report-data-content table thead
{
    height: 20px;
    text-align: left;
    
}

.report-data-content table th
{
    border-bottom: solid thin lightgray;
}

.report-data-content table tr
{
    height: 20px;
    vertical-align: top;
}

.report-data-footer
{
    font-family: calibri, verdana, tahoma;
    font-size: 10pt;
    position: relative;
    float: right;
    margin-top: 20px;
}

.bold-font
{
    font-weight: bold;
}
.field1
{
    font-weight: bold;
    font-size: 11pt;
}
.report-document-name
{
    font-weight: bold;
    font-size: 12pt;
}

.break-line
{
    border-bottom: solid thin lightgray;
}

.field4
{
    margin-top: 10px;
    float: left;
    width: 40%;
    border: solid thin lightgray;
    min-height: 80px;
}

.footer-label
{
    margin-top: 10px;
    font-weight: bold;
}

.report-footer
{
    margin-top: 20px;
}
</style>
<script>
$(document).ready(function(){
    
});
</script>
<div class="report-wrapper">
    <div class="report-header break-line">
        <div class="company-logo-report">
            <img src="<?php echo base_url() ?>/images/company_logo.png" alt="company logo" style="height: 70px;"/>
        </div>
        <div class="company-data">
            <div class="company-name-report">
            <span><?php echo $company ?></span>
            </div>
            <div class="company-address-report">
    
                <span>
                <?php echo $company_address ?>
                </span>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="report-sub-content">
        <div class="first-col-report">
            <div class="field1">
                <?php echo $customer_name ?>
            </div>
            <div class="field2">
                <?php echo $customer_address ?>
            </div>
        </div>
        <div class="second-col-report">
            <div class="report-document-name">
                <?php echo $document_name ?>
            </div>
            <div>
                <span>No: </span><span><?php echo $document_number ?></span>
            </div>
            <div>
                <span>Date: </span><span><?php echo $document_date ?></span>
            </div>
        </div>
    </div>
    <div class="report-data">
        <div class="report-data-content">
            <table>
                <thead>
                    <tr>
                        <th>
                            Product Code
                        </th>
                        <th>
                            Product Name
                        </th>
                        <th>
                            Unit
                        </th>
                        <th>
                            Qty
                        </th>
                        <th>
                            Unit Price
                        </th>
                        <th style="width: 120px;">
                            Total Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($items as $it)
                {?>
                    <tr>
                        <td>
                            <?php echo $it['product_code'] ?>
                        </td>
                        <td>
                            <?php echo $it['product_name'] ?>
                        </td>
                        <td>
                            <?php echo $it['unit_name'] ?>
                        </td>
                        <td>
                            <?php echo $it['qty'] ?>
                        </td>
                        <td>
                            Rp. <?php echo number_format($it['unit_price'], 2, ',', '.') ?>
                        </td>
                        <td>
                            Rp. <?php echo number_format($it['total_price'], 2, ',', '.') ?>
                        </td>
                    </tr>
                <?php     
                }
                ?>
                    
                </tbody>
            </table>
        </div>
        <div class="report-data-footer">
            <table>
                    <tr>
                        <td colspan="5" style="width: 120px;">
                            <span class="bold-font">Sub Total</span>
                        </td>
                        <td style="width: 120px;">
                            Rp. <?php echo number_format($sub_total, 2, ',', '.') ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="break-line">
                            <span class="bold-font">Tax</span>
                        </td>
                        <td class="break-line">
                             Rp. <?php echo number_format($tax, 2, ',', '.') ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <span class="bold-font">Total</span>
                        </td>
                        <td>
                             Rp. <?php echo number_format($total_price, 2, ',', '.') ?>
                        </td>
                    </tr>
                </table>
        </div>
    </div>
    <div class="report-footer">
        <div class="footer-label">
            Notes
        </div>
        <div class="field4">
            
        </div>
    </div>
</div>