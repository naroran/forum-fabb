<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<br><br><br><br>
<div class="container">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="alert alert-info">
    
<p style="text-align:center">Ré-initialiser son mot de passe.</p>
<p style=" font-size:80%; color:red; text-align:center;">Tous les champs sont obligatoires</p>
</div>
<?php

	     if ($this->session->flashdata('s_new_psw')){
		 
		 echo'<div class="alert alert-success">'.$this->session->flashdata('s_new_psw').'</div>';
		 echo'<a class="btn btn-success" href="'.base_url('welcome/index/').'">Allez Page Accueil</a>&nbsp;<a class="btn btn-success" href="'.base_url('forum/index/').'">Allez Accueil Forum</a>
		 <br><br><br><br><br><br>';
		 
		 
		 
		 }
		 else
		 {
 echo form_open('new/password/'.$this->uri->segment(3));
 echo form_error('email'); ?>
<label for="email" > Addresse E-mail</label>
<input class="form-control mobile" type="email" name="email" value="<?= set_value('email'); ?>" id="email"/> 
<br>
<?php echo form_error('psw'); ?>
<label  for="psw" > Nouveau Mot De Passe </label> 
<input class="form-control mobile" type="password" name="psw"  id="psw"/>
<br> 
<?php echo form_error('confirm'); ?>
<label  for="confirm" > Confirmez MDP :</label>
<input class="form-control mobile"  type="password" name="confirm" id="confirm" />
<br>
<input class="btn-primary mobile"  type="submit" name="changer" value="Valider" />
<input class="btn-primary mobile" type="reset" name="effacer" value="Effacer" />
</form>
<br><br><br><br>
<?php
		 }
		 ?>
</div>
<div class="col-md-3"></div>
</div>
</div>