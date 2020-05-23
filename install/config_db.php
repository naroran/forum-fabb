<?php
include('header.php');
?>
 		<div class="row">
        <div class="col-md-12">
        <div class="progress" style="height:30px;">
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="45" 
          aria-valuemin="0" aria-valuemax="100" style="width:45%"><span style="font-size:11px;">45% Completed</span>
          </div>
        </div>
        </div></div>
 <?php
           /* if(is_writable($chmod))
            {*/
 
                if(isset($i)&&$i>0){
	             echo '
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>';
                    $erreur=explode(".", $array['errors']);
					for($i=0;$i<count($erreur);$i++)
					{
					echo '<p style="font-size:11px">'.$erreur[$i].'</span></p>';
					}
				    echo'</div>';
					
				    }
                
				?>
             
             <h4>Etape 3 :: Informations base de donnée</h4>
             <hr>
                <form id="install_form" method="POST" action="index.php">
                <div class="form-group">
                    <label for="hostname">Hostname <span style="color:red"> * </span></label>
                    <input required type="text" id="hostname" placeholder="Généralement :: localhost, mais vous devez vous en &ecirc;tre s&ucirc;r." class="form-control" name="hostname" value="<?php if(isset($_POST['hostname'])) echo htmlspecialchars($_POST['hostname']); ?>" />
                </div>
                
                <div class="form-group">
                    <label for="username">Database username <span style="color:red"> * </span><span data-html="true" data-toggle="tooltip" title="Le nom d'utilisateur pour se connecter à la base de données" class="glyphicon glyphicon-question-sign" style="color:#3333FF; font-size:14px;"></span></label>
                    <input required type="text" id="username" class="form-control" name="username" value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>" />
                </div>
                
                <div class="form-group">
                    <label for="password">Database Password<span style="color:red"> * </span><span data-html="true" data-toggle="tooltip" title="Le mot de passe pour se connecter à la base de données" class="glyphicon glyphicon-question-sign" style="color:#3333FF; font-size:14px;"></span></label>
                    <input required type="password" id="password" class="form-control" name="password" value="<?php if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>" />
                </div>
                
                <div class="form-group">
                    <label for="database">Database Name<span style="color:red"> * </span><span data-html="true" data-toggle="tooltip" title="Le nom de la base de données qui recevera les tables du forum" class="glyphicon glyphicon-question-sign" style="color:#3333FF; font-size:14px;"></span></label>
                    <input required type="text" id="database" class="form-control" name="database" value="<?php if(isset($_POST['database'])) echo htmlspecialchars($_POST['database']); ?>" />
                </div>
                <?php 
			
		if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}
?>
                <div class="form-group">
                <?php if(isset($_POST['titre'])){
					$value=$_POST['titre'];
			$titre='le titre de votre site est :: <strong>'.$_POST['titre']. '</strong> selon vtre rectification';}
				else{
					$value=substr($_SERVER['SERVER_NAME'],4);
					$titre= 'le titre de votre site sera mentionné dans les e-mail que vous envoyez à vos membres ou lors de leur inscription sur le site.';}?>
                    <label for="titre">
                    
                    
    Titre website <span style="font-size:10px;color:red">Obligatoire </span>
    <span data-html="true" data-toggle="tooltip" title="<?=$titre?>" class="glyphicon glyphicon-question-sign" style="color:#3333FF; font-size:14px;"></span></label>
    
                    <input required type="text" id="titre" class="form-control" name="titre" value="<?=$value?>" />

                </div> 
                
                <div class="form-group">
                 <label for="url">URL Website <span style=" font-size:10px;color:red">Veuillez vérifier votre URL, le slash ' <strong>/</strong> ' à la fin est obligatoire </span> <span style="color:red"> * </span></label>
                  <input required type="text" id="url" class="form-control" name="url" value="<?php if(isset($_POST['url'])) echo htmlspecialchars($_POST['url']);else echo htmlspecialchars($protocol.$_SERVER['SERVER_NAME'].'/')?>" />
                </div>
                
                
                <div class="form-group">
                <?php if(isset($_POST['url_forum'])){
					$value=$_POST['url_forum'];
			$dossier='le forum sera installé dans le dossier <strong>'.$_POST['url_forum']. '</strong>';}
				else{
					$value='forum/';
					$dossier= 'Le forum sera installé dans le dossier<strong> forum/ </strong>';}?>
                    <label for="url_forum">
                    
                    
    Dossier Du Forum <span data-html="true" data-toggle="tooltip" title="<?=$dossier?>" class="glyphicon glyphicon-question-sign" style="color:#3333FF; font-size:14px;"></span></label>
    
                    <input type="text" id="url_forum" readonly class="form-control" name="url_forum" value="<?=$value?>" />

                </div> 
                <input type="hidden" name="install" value="config_db">
                <input type="hidden" name="stepConfig" value="config_db">
                <input type="submit" name="submit" value="Suivant" class="btn btn-primary btn-block" id="submit" />
                </form>
        
                <?php 
               /*} 
                else {
                ?>
                <p class="alert alert-danger">
                    Please make the application/config/database.php file writable.<br>
                    <strong>Example</strong>:<br />
                    <code>chmod 777 ::  forum/application/config/database.php</code>
                    </p>
                <?php 
                } */
				?>
				
		 <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<?php
include('footer.php');
?>