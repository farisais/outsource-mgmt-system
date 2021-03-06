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
<html>
<body>
<div class="report-wrapper">
    <div class="report-header break-line">
        <div class="company-logo-report">
            <img src="<?php echo base_url() ?>/images/company_logo.png" alt="company logo" style="height: 70px;"/>
        </div>
        <div class="company-data">
            <div class="company-name-report">
            <span><?php echo isset($company)?$company:'' ?></span>
            </div>
            <div class="company-address-report">
    
                <span>
               
                </span>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <table class="bordercollapse" style="width: 100%">
	<tr>
		<td colspan="2" width="50%" ></td>
		<td ></td>
		<td width="10%"><strong>Date </strong> </td>
		<td ><strong>: xxx</strong></td>
	</tr>
	<tr>
		<td colspan="2" ></td>
		<td ></td>
		<td ><strong>Invoice</strong></td>
		<td ><strong>: xxx</strong></td>
	</tr>
	<tr>
		<td colspan="2" >&nbsp;</td>
		<td >&nbsp;</td>
		<td >&nbsp;</td>
		<td >&nbsp;</td>
	</tr>
	<tr>
		<td " id="center" colspan="2"><strong>BILL TO:</strong></td>
		<td ></td>
		<td colspan="2" ><b>PT. BAZ Citra Indonesia</b></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="4" class="border" id="center">
		<strong>PT. XXXasda (JALIURANG)
		<br />
		TENGGARA TIMU</strong>
		<strong><br />
		<br />
		<br />
		ATTENTION: MR. Adi Dedis</strong></td>
		<td>&nbsp;</td>
		<td colspan="2">Jl. Raya Rawa Buntu...Tangerang</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Phone</td>
		<td>: 1231232</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Fax</td>
		<td>: 234234</td>
	</tr>
	<tr>
		<td ></td>
		<td >Email</td>
		<td >: dqwe</td>
	</tr>
	<tr>
		<td style="width: 477px">&nbsp;</td>
		<td style="width: 220px">&nbsp;</td>
		<td>&nbsp;</td>
		<td>Website</td>
		<td>: <a href="http://www.324">www.324</a></td>
	</tr>
	<tr>
		<td  width: 477px;" class="border" id="center">
		<strong>Contract Number</strong></td>
		<td  width: 220px;" class="border" id="center">
		<strong>Period</strong></td>
		<td ></td>
		<td >NPWP</td>
		<td >: 1023</td>
	</tr>
	<tr>
		<td class="border" id="center" style="width: 477px">0213/BCL-412/IV/20</td>
		<td class="border" id="center" style="width: 220px">1/12/2015 to 12/12/2017</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<p>&nbsp;</p>
<b>
<table width="100%" id="bordercollapse" >
	<tr>
		<td class="border" style="height: 27px">NO</td>
		<td class="border" colspan="4" style="height: 27px">DESCRIPTION</td>
		<td class="border" style="height: 27px" >AMOUNT (IDR)</td>
	</tr>
	<tr>
		<td class="border">1</td>
		<td colspan="4" class="border">Security Service</td>
		<td class="border">&nbsp;</td>
	</tr>
	<tr>
		<td  width: 35px;" colspan="4" width="50%" style="height: 23px"></td>
		<td  class="border" style="height: 23px"  width="20%">TOTAL WAGES</td>
		<td  class="border" style="height: 23px" >xxx</td>
	</tr>
	<tr>
		<td colspan="3" rowspan="6">
		<div style="border:thin black solid" align="center">
			AUTHORIZED BY:<br />
			<br />
			<br />
			<br />
			<br />
			Ratna Kom<br />
			<i>Finance Manager</i><br />
			PT. BAZCROP
			Cita Indonesia</div>
		</td>
		<td width="20%" ></td>
		<td  class="border" >TOTAL MANAGEMENT FEE</td>
		<td  class="border" >xxx</td>
	</tr>
	<tr>
		<td style="height: 27px"></td>
		<td class="border" style="height: 27px">SUB TOTAL</td>
		<td class="border" style="height: 27px">xxx</td>
	</tr>
	<tr>
		<td ></td>
		<td class="border" >PPN 10% (FROM MF)</td>
		<td class="border" >xxx</td>
	</tr>
	<tr>
		<td ></td>
		<td class="border" >PPh 23 2% (FROM MF)</td>
		<td class="border" >xxx</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td class="border">DISKON</td>
		<td class="border">xxx</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td class="border">TOTAL</td>
		<td class="border">xxx</td>
	</tr>
	<tr>
		<td style="width: 35px">&nbsp;</td>
		<td style="width: 108px">&nbsp;</td>
		<td style="width: 61px">&nbsp;</td>
		<td>&nbsp;</td>
		<td class="border">STAMP</td>
		<td class="border">xxx</td>
	</tr>
	<tr>
		<td style="width: 35px">&nbsp;</td>
		<td style="width: 108px">&nbsp;</td>
		<td style="width: 61px">&nbsp;</td>
		<td>&nbsp;</td>
		<td class="border">INVOICE TOTAL</td>
		<td class="border">xxx</td>
	</tr>
</table>
</b>

<br/>
<br/>


<strong>REMITTANCE ADVICE: <u>WITHIN 14 DAYS OF INVOICE PRESENTATION</u><br/>
DEPOSIT PAYMENT IN MANDIRI BANK<br/>
BURSA EFEK JAKARTA BRANCH, SOUTH OF JAKARTA<br />
PT. BAZCORP CITRA Indonesia
<br />
Account Number: 1040000200001 </strong>

</body>

</html>
