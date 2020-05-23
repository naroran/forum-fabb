<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container">
<div class="row">
<div class="col-md-2"></div>
<div style="padding:50px 50px;" class="col-md-8">

	<?php
	echo br(5);
	 if(has_alert()):  
		foreach(has_alert() as $type => $message): ?>  
			<div class="alert alert-dismissible <?php echo $type; ?>">  
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				<?php echo $message; ?>  
			</div>  
		<?php endforeach;  
	endif; 
	echo br(5);
	?>

</div>
<div class="col-md-2"></div>
</div>
</div>