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
    margin-top: 20px;
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
    /*margin-top: 10px;*/
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
                <?php echo $full_name ?>
            </div>
            <div class="field2">
				<span>ID : </span>
                <?php echo $employee_number ?>
            </div>
			<div class="field2">
				<span>Posisi : </span>
                <?php echo $structure_name ?>
            </div>
        </div>
        <div class="second-col-report">
			<div class="report-document-name">
                PAYSLIP
            </div>
			<div class="report-document-name">
                <?php echo $periode_name ?>
            </div>
            <div>
                <span>Tanggal Payslip: </span><span><?php echo $date_finished ?></span>
            </div>
        </div>
    </div>
    <div class="report-data">
        <div class="report-data-content">
            <table>
                <thead>
                    <tr>
                        <th>
                            Element
                        </th>
                        <th>
                            Unit
                        </th>
                        <th>
                            Multiply
                        </th>
                        <th>
                            Amount
                        </th>
                        <th style="width: 120px;">
                            Total Amount
                        </th>
                    </tr>
                </thead>
                <tbody>
					<tr>
                       <!-- <td>
                            <?php echo $it['product_code'] ?>
                        </td>-->
                        <td>
                            THP
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            Rp. <?php echo number_format($total_thp, 2, ',', '.') ?>
                        </td>
                        <td>
                            Rp. <?php echo number_format($total_thp, 2, ',', '.') ?>
                        </td>
                    </tr>
					<tr>
                       <!-- <td>
                            <?php echo $it['product_code'] ?>
                        </td>-->
                        <td>
                            Overtime
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            <?php echo $total_overtime ?>
                        </td>
                        <td>
						
                        </td>
                    </tr>
					<tr>
                       <!-- <td>
                            <?php echo $it['product_code'] ?>
                        </td>-->
                        <td>
                            Allowance
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
					<tr>
                       <!-- <td>
                            <?php echo $it['product_code'] ?>
                        </td>-->
                        <td>
                            Jamsostek
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            Rp. <?php echo number_format($jamsostek, 2, ',', '.') ?>
                        </td>
                        <td>
                            Rp. <?php echo number_format($jamsostek, 2, ',', '.') ?>
                        </td>
                    </tr>
					<tr>
                       <!-- <td>
                            <?php echo $it['product_code'] ?>
                        </td>-->
                        <td>
                            PPH 21
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            Rp. <?php echo number_format($pph, 2, ',', '.') ?>
                        </td>
                        <td>
                            Rp. <?php echo number_format($pph, 2, ',', '.') ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="report-data-footer">
            <table>
                    <tr>
                        <td colspan="5" style="width: 120px;">
                            <span class="bold-font">Total Gross</span>
                        </td>
                        <td style="width: 120px;">
                            Rp. <?php echo number_format($total_gross, 2, ',', '.') ?>
                        </td>
                    </tr>
                </table>
        </div>
    </div>
</div>