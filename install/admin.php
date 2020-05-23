<?php
include('header.php');
?>
 		<div class="row">
        <div class="col-md-12">
        <div class="progress" style="height:30px;">
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="70" 
          aria-valuemin="0" aria-valuemax="100" style="width:70%"><span style="font-size:11px;">70% Completed</span>
          </div>
        </div>
        </div></div>

             <h4>Etape 5 :: Informations de compte admin</h4>

<?php
                if(isset($i)&&$i>0){
	             echo '
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>';
                    $erreur=explode(".", $array['errors']);
					for($i=0;$i<count($erreur);$i++)
					{
					echo '<p style="color:red;font-size:11px;">'.$erreur[$i].'</p>';
					}
				    echo'</div>';
					
				    }
?>
              <form action="index.php" method="post">
              <div class="form-group ">
		      <label class="control-label" data-toggle="tooltip" title="Pseudonyme avec lequel vous serez reconnu sur le forum" for="pseudo">Pseudo <span style="color:red"> *</span></label> 
			  <input class="form-control input-sm" name="pseudo" type="text" id="pseudo" 
              value="<?php if(isset($_POST['pseudo'])) echo htmlspecialchars($_POST['pseudo']); ?>">
			  </div>
			
              <div class="form-group">
			  <label data-toggle="tooltip" title="Un mot de passe fort renforce la sécurité de votre compte" class="control-label" for="psw">Mot de Passe <span style="color:red"> *</span></label> 
			  <input class="form-control input-sm " type="password" name="psw" id="psw" value="<?php if(isset($_POST['psw'])) echo htmlspecialchars($_POST['psw']); ?>" >
			  </div>
				 
              <div class="form-group">
			  <label class="control-label" data-toggle="tooltip" title="Confirmez votre mot de passe."
               for="cpsw">Confirmer MDP <span style="color:red"> *</span></label> 
			  <input class="form-control input-sm " type="password" name="cpsw" id="confirm" value="<?php if(isset($_POST['cpsw'])) echo htmlspecialchars($_POST['cpsw']); ?>">
			  </div>
              
              <div class="form-group">
		      <label class="control-label" for="email">Adresse e-mail <span data-toggle="tooltip" data-html="true" title="Votre adresse email doit &ecirc;tre valide est opérationnelle à risque d'&ecirc;tre dans l'impossibilité d'envoyer des message à vos membres.<br> Une adresse email avec votre nom de domaine est fortement recommandée" style="color:red"> *</span></label>
              <input class="form-control input-sm" type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">
			  </div>
              
               
               
               <div class="form-group">
				<label class="control-label" for="signature"
                data-html="true" data-toggle="tooltip" title="La signature est votre slogan, votre proverbe préféré ou toute expression de sagesse dans laquelle plongent vos convictions.<br> Max :: 128 caractères. Vous pouvez changer cette valeur dans Admin-panel">
             Signature <span style="font-size:10px;color:red">(128 caractères)</span> </label> 
                <textarea class="form-control" name="signature" id="signature">
                <?php if(isset($_POST['signature'])) echo htmlspecialchars($_POST['signature']); ?>
			    </textarea>             
			      </div>
                  
        
               
                
        <div class="form-group">
        <input type="hidden" name="install" value="admin">
        <input type="hidden" name="stepadmin" value="admin">
        <input class="btn btn-primary btn-block" type="submit" name="submit" value="suivant">
        </div>
        </form>
        
        </div>
        </div>
        <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<?php
include('footer.php');
?>