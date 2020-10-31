<div>
	<span class='data_label'>
		<?php 
		echo str_replace(" ", '&nbsp;', $indent);
		if(!is_numeric(key($data))){ echo key($data).": ";}?>
	</span> 
	<?php if(is_string($d)||is_numeric($d)){echo $d;} ?>
</div>