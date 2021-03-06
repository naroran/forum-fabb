<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title> Rappel confirmation email</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- ----------- google font ----------- -->
<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
body{margin-top:5rem;}
.content{ font-size:1.3rem; text-align:justify;font-family: 'Lato', sans-serif; font-style:normal; line-height:2rem;}
.logo{
-webkit-box-shadow: 9px -6px 19px 8px rgba(143,149,186,0.75);
-moz-box-shadow: 9px -6px 19px 8px rgba(143,149,186,0.75);
box-shadow: 9px -6px 19px 8px rgba(143,149,186,0.75);
padding:20px; margin:40px 0; border-radius:8px;	
	}
	.droit{ text-align:center; font-size:70%; margin-top:10%; margin-bottom:1%;}
	.footer p{background-color: #000000; color:#FFFFFF; text-align:center;font-size:80%; font-style:italic; padding:20px;}
</style>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-xs-1"></div>
<div class="col-xs-10">
<div class="row">
                <div class="col-xs-12">
                <div class="text-center"><img class="logo" src="https://www.forum-fabb.com/forum/assets/img/form.png" alt="Logo fabb"></div>
        
        
<?php
 echo 		  '<h4>Rappel de confirmation d\'email.</4>
		  
		  <p class="content">Salut '. $this->pseudo.'<br>
		  Nous vous informons que votre compte sur le site <a href="'.base_url().'">'.$this->config_model->title_forum().'</a> 
		  est toujours en attente de confirmation de votre adresse email.<br>
		  Vous ou quelqu\'un autre a demandé l\'envoi d\'un message pour re-confirmer votre adresse email, le  '.$date.'. à '. $heure .'<br>
  Cette demande est effectu&eacute;e depuis L\'adresse IP :'. $this->input->ip_address() .'<br>
		  Si vous n\'&ecirc;tes pas à l\'origine de cette action, veuillez ignorer cet email.<br> 
		  Si non, veuillez cliquer sur le lien ci-dessous pour confirmer et activer votre compte.<br></p>
		  
		  
			<p class="content"><a class="btn btn-primary btn-sm" href="'.base_url('valid/email/'.$key).'">Oui confirmer mon
			 email</a></p>
				
				<p class="content">NB: Si le lien ci-dessus n\'est pas fonctionnel, veuillez copier/coller dans la barre
				 d\'adresse de votre navigateur le lien suivant et valider :<br>  
				'.base_url('valid/email/'.$key).' <br/>
				Cordialement le Webmaster</p> ';
?>
</p>
        
        </div>
        </div>
        



        <div class="row">
        <div class="col-xs-12">
        <p class="droit">Vous recevez cet e-mail car vous êtes référencé sur notre base de données.<br>
Conformément à l'article 34 de la loi Informatique et Liberté du 6 janvier 1978<br>
vous disposez d'un droit ::<br> d'accès, de modification, de rectification et de suppression
des données vous concernant.<br>
<a href="#">Si vous souhaitez vous désinscrire, merci de cliquer sur ce lien.</a></p>
        </div></div>

        <div class="row">
        <div class="col-xs-12">
        
        <div class="footer">
        <p>
        Powered by <a href="https://www.forum-fabb.com/"> M.I.F</a> ® Version 1.0.0<br>
        Copyright © 2018 All rights reserved.</p>
        </div>
        
        </div>
        </div>  
        
        </div>   
           
        <div class="col-xs-1"></div>
      </div></div>
 </body>
</html>