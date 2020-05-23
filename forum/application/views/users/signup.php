<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$attributs=array('autocomplete'=>'on');
$hidden=array($this->input->ip_address()); 
?>
<div class="container">
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<br><br>
<div class="forum-center">
       <center>
		    <button class="btn btn-info btn-block rounded-0 text-white text-center">Inscription</button>
</center>
</div>
<br><br>
                      
                      <?= form_open($action,$attributs,$hidden);?>

<div class="form-group">
<label for="pseudo" id="pseudo">Pseudo <span data-html="true" data-toggle="tooltip" title="Pseudonyme par le quel vous serez reconnu sur le forum. <br>Obligatoire " style="color:red"> * </span></label><br/>
<?= form_error('pseudo'); ?>
<input class="form-control" type="text" name="pseudo" id="pseudo" value="<?=set_value('pseudo'); ?>" />
</div>

<div class="form-group">
<label for="password" id="password">Mot de passe<span data-html="true" data-toggle="tooltip" title="Mot de passe. <br>Obligatoire " style="color:red"> * </span>
</label><br/>
<?=form_error('password'); ?>
<input class="form-control" type="password" name="password" placeholder="alphanumériques" value="<?=set_value('password'); ?>"/>
</div>

<div class="form-group">
<label for="conf_psw" id="conf_psw">Confirmer MP <span data-html="true" data-toggle="tooltip" title="Confirmer votre mot de passe. <br>Obligatoire " style="color:red"> * </span></label><br/>
<?= form_error('conf_psw'); ?>
<input class="form-control" type="password" name="conf_psw" value="<?= set_value('conf_psw'); ?>" />
</div>
<div class="form-group">
<label for="email" id="email">Addresse email <span data-html="true" data-toggle="tooltip" title="Adresse email valide et opérationnell, Autrement votre inscription n'est pas possible. <br>Obligatoire " style="color:red"> * </span>
</label><br/>
<?= form_error('email'); ?>
<input class="form-control" type="text" name="email" placeholder="adresse e-mail" value="<?= set_value('email'); ?>" />
</div>
<div class="form-group">
  <?php if(isset($image)) echo $image; else echo 'no image' ; ?>
  <span style=" font-style:italic; color:red; font-family:Arial, Helvetica, sans-serif;font-size:9px;">Code sensible à la casse, obligatoire.</span>
  </div>
<div class="form-group">
  <label for="captcha">Code securité </label>
<span class="error_captcha"><?php echo form_error('captcha'); ?></span>
    <input class="form-control" id="captcha" name="captcha" type="text" />
  
</div>

<div class="form-group">
<input class="btn btn-info btn-block rounded-0 " type="reset" value="Effacer"/>
<input class="btn btn-info btn-block rounded-0 " type="submit" value="Valider" />
</div>
<?= form_close();?>

<br><br>
    </div>
       <div class="col-md-4"></div>
    </div>
    </div>
    </div>