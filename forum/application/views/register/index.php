<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="container-fluid">
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
<?php
switch($render){
	case 'infos':
		
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
	
	
	break;
	
	default:
	echo '<div class="container">
	      <div class="row">
		  <div class="col-md-3"></div>
		  <div class="col-md-6">';
		  echo br(3);

	$attributs=array('autocomplete'=>'on'); 
	?>
			    
				<button class="btn btn-info btn-block text-white text-center">Inscription</button>

                      <?=br(3)?>
                      <?= form_open($action,$attributs);?>

<div class="form-group">
<label for="pseudo" id="pseudo">Pseudo <span data-html="true" data-toggle="tooltip" title="Pseudonyme par le quel vous serez reconnu sur le forum" style="color:red"> * </span>
</label><br/>
<?= form_error('pseudo'); ?>
<input class="form-control" type="text" name="pseudo" id="pseudo" placeholder="un pseudonyme pour vous reconnaitre sur le forum" value="<?=set_value('pseudo'); ?>" />
</div>

<div class="form-group">
<label for="password" id="password">Mot de passe</label><br/>
<?=form_error('password'); ?>
<input class="form-control" type="password" name="password" placeholder="min 6 caractères" value="<?=set_value('password'); ?>"/>
</div>

<div class="form-group">
<label for="conf_psw" id="conf_psw">Confirmer MP</label><br/>
<?= form_error('conf_psw'); ?>
<input class="form-control" type="password" placeholder="confirmez votre mot de passe" name="conf_psw" value="<?= set_value('conf_psw'); ?>" />
</div>
<div class="form-group">
<label for="email" id="email">Addresse email</label><br/>
<?= form_error('email'); ?>
<input class="form-control" type="text" name="email" placeholder="une adresse e-mail valide est obligatoire" value="<?= set_value('email'); ?>" />
</div>
<div class="form-group">
  <?php if(isset($image)) echo $image; else echo 'no image' ; ?>
  <span style=" font-style:italic; color:red; font-family:Arial, Helvetica, sans-serif;font-size:9px;">Code sensible à la casse, obligatoire.</span>
  </div>
<div class="form-group">
  <label for="captcha">Code securité </label>
<span class="error_captcha"><?php echo form_error('captcha'); ?></span>
    <input class="form-control" id="captcha" name="captcha" placeholder="recopiez le code de l'image dans cet endroit" type="text" />
  
</div>

<div class="form-group">
<input class="btn btn-info btn-block rounded-0 " type="reset" value="Effacer"/>
<input class="btn btn-info btn-block rounded-0 " type="submit" value="Valider" />
</div>
<?php

form_close();
	echo'
	</div>
	<div class="col-md-3"></div>
	</div>
	</div>';
	
	break;
	
	
	
	}
?>
</div>
<div class="col-md-1"></div>
</div>
</div>
<?=br(3)?>