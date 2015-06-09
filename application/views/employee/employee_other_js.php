<script>
$(document).ready(function(){
	
	var bank = [
        <?php
        foreach($bank as $b)
        {
            echo '{ value: "'. $b['id_bank'] .'", label: "'. $b['name'] .'"},';
        }
        ?>
    ];
	 $("#select-bank").jqxComboBox({ source: bank, displayMember: 'label', valueMember: 'value'});
	<?php 
    if(isset($is_edit))
    {?>
	 $("#select-bank").jqxComboBox('val',<?php echo (isset($data_edit[0]['bank']) ? $data_edit[0]['bank'] : "''") ?>);
	<?php
	}
	?>
});
</script>