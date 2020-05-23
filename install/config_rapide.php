<?php
include('header.php');
$db=dbname();
$i=1;
	?>
  		<div class="row">
        <div class="col-md-12">
        <div class="progress" style="height:30px;">
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="85" 
          aria-valuemin="0" aria-valuemax="100" style="width:85%"><span style="font-size:11px;">85% Completed</span>
          </div>
        </div>
        </div></div> 
                     <h4>Etape 6 :: Configuration rapide du forum</h4> 
        
        <?php
	             echo '
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>';
                    
					echo '<p style="color:red;font-size:12px;">Cette étape n\'est pas tellement importante. Ces donnée sont des données par défaut.<br> Vous pouvez configurer toutes les options en accédant à votre Admin-panel.<br>
					Cliquez sur suivant pour finaliser l\'installation.</p>';
					
				    echo'</div>';
					
				    
?>
        
        <form action="index.php" method="post">
        <div class="form-group">
        <label class="control-label" for="raison">Raison social</label>
    <input class="form-control input-sm" placeholder="Nous vous suggerons le nom de votre nom de domaine" type="text" name="raison" id="raison" value="">
    </div>
    <div class="form-group">
		<label  class="control-label" for="title_forum">Titre forum </label>
        <input class="form-control input-sm" type="text" name="title_forum" id="title_forum" value="My community" >
        </div>
        
        <div class="form-group">
	<label  class="control-label" for="slogan1">Premier slogan </label>
    <input class="form-control input-sm" type="text" name="slogan1" id="slogan1" value="Free forum">
    </div>
    
    <div class="form-group">
    <label  class="control-label" for="slogan2">2<sup>ème</sup>Slogan</label>
    <input class="form-control input-sm" type="text" name="slogan2" id="slogan2" value="Welcome to every one">
    </div>
    <?php 
		       if (isset($_SERVER['HTTPS']) &&($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
               isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
               $protocol = 'https://';
               }
			   else {
			   $protocol = 'http://';
			   }
               ?>
    <div class="form-group">
    		<label  class="control-label" for="titlewebsite">Titre site web <span style=" font-size:10px;color:red">Veuillez vérifier votre URL</span></label>
        <input class="form-control input-sm" type="text" name="titlewebsite" id="titlewebsite" value="<?=$protocol.$_SERVER['SERVER_NAME']?>" >
        </div>
        <input type="hidden" name="install" value="config_rapide">
        <input type="hidden" name="stepquickconfig" value="config_rapid">        
        <input type="submit" name="submit" value="Suivant" class="btn btn-primary btn-block">
        
    </form>
	
	
	
	 <?php   
	
  include('footer.php');
				?>