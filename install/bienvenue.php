<?php
include_once('header.php');
?>
  		<div class="row">
        <div class="col-md-12">
        <div class="progress" style="height:30px;">
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="14" 
          aria-valuemin="0" aria-valuemax="100" style="width:14%"><span style="font-size:11px;">14% Completed</span>
          </div>
        </div>
        </div></div> 
          
          <h4>Etape 1 :: Bienvenue sur Fabb</h4> 

<p class="content">Fabb est un forum gratuit, léger, rapide et complet. Il inclut presque toutes  les fonctionnalités et toutes les options  les plus répandues sur les forums.
<p class="content">La première version de Fabb a vu le jour un certain décembre 2012, elle a été écrite en procédurale que nous lui avons attribué : la version 1.0.0. Cette version a connu plusieurs bugs, la raison pour laquelle nous étions poussé à revoir tout notre code à partir du zéro.  La 2eme version  corrigée et améliorée est sortie en juin 2013. Depuis, le forum n’a pas connu un grand succès par conséquence le projet a été mis dans les tiroirs de l’oubliette.
<p class="content">En 2018, le projet est revenu avec un autre visage sous la version 3.0.0 que nous mettons gratuitement à la disposition des utilisateurs avec une licence GPL V3.
<p class="content">Le script d’installation vous guidera à travers les étapes d’installation automatiquement, presque sans aucune intervention de votre part sauf à accepter ou introduire quelque renseignement qui sont nécessaire pour  le bon déroulement de l’installation.<br>
Pour plus d’informations, nous vous invitons à prendre connaissance du <a href="guide-installation.php">guide d’installation</a> .

<h5 style="color:red"><strong>Important ::</strong></h5>
<p>Le script d’installation a besoin des identifiants de connexion à votre base de données MYSQL. Si vous ne les connaissez pas, veuillez contacter votre hébergeur.</p>

        <form action="index.php" method="post">
        <div class="form-group">
        <input type="hidden" name="install" value="licence">
        <input class="btn btn-primary btn-block" type="submit" name="submit" value="suivant">
        </div>
        </form>
        
        </div>
        </div>
        
<?php
include_once('footer.php');
?>