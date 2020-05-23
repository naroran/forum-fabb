<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6 col-xs-12">

<?php
echo form_open('contact/report_msg');
?>
<div class="form-group">
<label for="sender">Expediteur : </label>
<input class="form-control" type="email" readonly name="sender" id="sender" value="<?= $this->email ?>"></div>
<div class="form-group">
<?= form_error('object'); ?>
<label for="object">Objet :</label>
<input class="form-control" type="text"  name="object" id="object" value="<?=set_value('object'); ?>" /></div>
<div class="form-group">
<?= form_error('msg'); ?>
<label for="msg">Message : </label>
<textarea class="form-control" name="msg" id="msg" rows="10" cols="15" >
<?= set_value('msg'); ?>
</textarea></div>
<div class="form-inline"><br>

<input type="submit" class="btn btn-primary btn-ms" name="envoyer" value="Envoyer" />
<input type="reset" class="btn btn-primary btn-ms" name="reset" value="Effacer">
<a href="<?= base_url('forum')?>" class="btn btn-primary btn-ms">Annuler</a>

</div>
</form> <br><br><br><br>

</div>
<div class="col-md-3"></div>
</div></div></div>