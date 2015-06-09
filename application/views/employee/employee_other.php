<table class="table-form" style="margin: 20px; width: 90%;">
    <tr>
        <td class="label">
            NPWP No.
        </td>
         <td colspan="3">
            <input style="display: inline; width: 70%" type="text" class="field" id="npwp" value="<?php echo (isset($is_edit) ? $data_edit[0]['npwp'] : '') ?>"/>
        </td>
    </tr>
     <tr>
        <td class="label">
            BPJS No.
        </td> 
         <td colspan="3">
            <input style="display: inline; width: 70%" type="text" class="field" id="bpjs" value="<?php echo (isset($is_edit) ? $data_edit[0]['bpjs'] : '') ?>"/>
        </td>
    </tr>
	</tr>
     <tr>
        <td class="label">
            Jamsostek
        </td> 
         <td colspan="3">
            <input style="display: inline; width: 70%" type="text" class="field" id="jamsostek" value="<?php echo (isset($is_edit) ? $data_edit[0]['jamsostek'] : '') ?>"/>
        </td>
    </tr>
	<tr>
        <td class="label">
           Rekening No.
        </td> 
         <td colspan="3">
            <input style="display: inline; width: 70%" type="text" class="field" id="rekening" value="<?php echo (isset($is_edit) ? $data_edit[0]['rekening'] : '') ?>"/>
        </td>
    </tr>
	<tr>
        <td class="label">
            Bank
        </td> 
         <td colspan="3">
            <div id="select-bank"></div>
        </td>
    </tr>
</table>