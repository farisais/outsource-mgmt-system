<div style="border: solid thin lightgray; width: 600px;font-family: 'Myriad-Roman', Calibri, Tahoma;color: #565656;padding: 2px;">
	<table style="padding: 10px;" border=0 width=600 cellpadding=0 cellspacing=0>
		<tr>
			<td height=30 style="background-color: #cfcfcf;">
				<img src="<?php echo base_url() ?>/images/company_logo.png" alt="company logo" style="height: 70px;"/>
			</td>
		</tr>
		<tr>
			<td height=10>
				
			</td>
		</tr>
		<tr>
			<td style=" font-size: 10pt;">
				<?php 
                echo $message['header'];
                $array = json_decode($message['data']);
                foreach($array as $key => $value)
                {
                    echo $key . ' : ';
                    if(is_array($value))
                    {
                        
                    }
                    else
                    {
                        echo $value . '</br>';
                    }
                }
                echo '</br>' . $message['footer'];
                ?>
			</td>
		</tr>
		<tr>
			<td style="height: 20px;">
			</td>
		</tr>
		<tr>
			<td style=" font-size: 8pt; color: #555555; background-color:#c9c9c9; height: 40px; padding: 10px;">
				&copy <?php echo date('Y') ?> <?php echo $company_name ?> | <?php echo $company_address ?>
			</td>
		</tr>
	</table>
</div>