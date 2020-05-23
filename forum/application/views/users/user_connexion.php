<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$erreur=isset($erreur)?$erreur:'';
?>
<div class="container">
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<br><br>
<div class="forum-center">
       <center>
       

       <?php
	   if($action=='contact/reactivate'){
		   $action='contact/reactivate';
		   $label_reactivate='Adresse Email';
		  
		    echo'<button class="btn btn-info btn-block rounded-0 text-white text-center">Réactiver son compte</button>';
		   
		   }
		   else{
			   
		   $action='users/connexion';			   
			   echo '<button class="btn btn-info btn-block rounded-0 text-white text-center">Identifiez-vous</button>';
			   $label_reactivate='Pseudo OR Adresse Email';
			   }
	   ?>
                  
    </center>
    </div>
<?php
echo form_open($action);
?>

<br><br>
<?php echo form_error('field'); ?>
<div class="form-group">
             
        <label for="field"> <?= $label_reactivate; ?> </label>
        
        <input type="text" id="field" name="field" class="form-control" value="<?php echo set_value('field'); ?>" placeholder="Adresse email ou pseudo" autofocus>
        <br>
        <?php echo form_error('password'); ?>
        <label for="password">Mot de passe</label>
        
        <input type="password" id="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" placeholder="votre mot de passe">
        
        
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember" value="remember-me"> Remember me</label>
            &nbsp;&nbsp;&nbsp;&nbsp;<span style="font-style:italic; font-family:Arial;font-size:10px;color:red;"><a  href="<?= base_url('users/forget_psw')?>">Mot de passe oublié</a> / <a href="<?= base_url('register')?>">S'enregistrer</a></span>
            <input type="hidden" name="prev_page" value="<?=$this->agent->referrer();?>">
        </div>
        <br>
        <button class="btn btn-info btn-block rounded-0 py-2" type="submit">Valider</button>
                
        
       
      <?= form_close();?>
<br><br>
    </div>
       <div class="col-md-4"></div>
    </div>
    </div>
    </div>