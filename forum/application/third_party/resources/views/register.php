<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
    <p class="text-justify">Bonjour et bienvenue <?= $pseudo?></p>
	
<p class="content"> vous venez de vous inscrire sur le site <?=$title_website?> le <?=date('d - m - Y')?> à <?= date('H-i-s')?>

Cette inscription est effectuée depuis L'adresse IP :: <?= $ip?> <br/>

Si vous n'&ecirc;tes pas à l'origine de cette inscription sur le site ou une personne tierce a abusé de votre identité ou ce message vous est arrivé par erreur veuillez l'ignorer  SVP.<br/>

Si non, pour confirmer votre inscription et activer votre compte, veuillez cliquez sur le lien ci-dessous.<br/>

	<a class="btn btn-primary btn-sm" href="<?=base_url('valid/email/'.$key)?>"> Oui, confirmer mon inscription</a><br/>
	
	  Nous vous demandons cette opération  pour nous prévenir du spam et des abus .<br/>
	  
	  NB: Si le lien ci dessus n'est pas fonctionnel, veuillez copier/coller dans la barre d'adresse de votre navigateur le lien suivant et valider ::<br>  
	  <?=base_url('valid/email/'.$key)?> <br/>

 Cordialement le Webmaster .</p>