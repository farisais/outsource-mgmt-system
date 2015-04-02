<h2>
<?php  
if(isset($subtitle))
{
	echo $subtitle;
}
?>
</h2>
<p>
<?php  
if(isset($content))
{
	echo $content;
}
?>
</p>
<?php 
echo $output->output;
?>