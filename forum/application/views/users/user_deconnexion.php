<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container">
<div class="row">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-4">
<?php

if(isset($compte_supprime)){
	echo'<h3><strong style="color:green"> Déconnecté avec success</strong></h3>';
	echo '<p class="alert alert-success text-center">'. $compte_supprime.'
<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Quitter</a> |'.
safe_mailto($this->config_model->admin_contact(),'Contact Admin').' |
<a class="btn btn-success" href="'.base_url('contact/reactivate').'">Réactiver Mon compte</a>
</p><br><br><br><br>';

}
else{
?>
<h3><strong style="color:green"> Déconnecté avec success</strong></h3>
<p class="alert alert-success text-center">Merci pour votre visite, esperant vous voir tres prochainement.<br>
votre visite nous fait toujours plaisir</p>
<a class="btn btn-success" href="<?php echo base_url('forum'); ?>">Quitter</a>
<?= br(5)?>
</div>
<div class="col-md-4">&nbsp;</div>
</div>
</div>
<?php
}
?>