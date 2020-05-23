<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
function goBack() {
    window.history.go(-1);
}
</script>
<br><br><br><br>
<div class="container">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
    <br><br>
<?php

	     if ($this->session->flashdata('s_forget_psw')){
		 
		 echo'<div class="alert alert-success">'.$this->session->flashdata('s_forget_psw').'</div>';
		 
		 echo $message;
		 
		 }
		 else
		 {
?>

<div class="alert alert-info">
<button class="btn btn-info btn-block rounded-0 text-white text-center">Récupérer son Mot de Passe</button>
</div>

<?php echo form_error('email'); 

echo form_open('users/forget_psw');
?>

	<form action="<?= base_url('user/update_psw')?>" method="post">
    <div class="form-group">
	<label  for="email" >E-Mail</label>
    <input class="form-control mobile" type="text" name="email" value="<?= set_value('email'); ?>" id="email" autofocus />
    </div>

 <br><br>

		<div class="form-inline">
		<input type="submit" class=" btn-primary btn-sm" name="Envoyer" value="Envoyer"/>
	   <input type="reset" class=" btn-primary btn-sm" name="reset" value="Effacer"/>
	       <input onClick="location.href(goBack())" class=" btn-primary btn-sm" type="button" value="Annuler"/>
      </div>



<?php
echo form_close();
		 }
		 ?>
</div>

<div class="col-md-3"></div>

</div>
</div>
<br><br><br><br><br><br>