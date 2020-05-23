<?php
include('header.php');

	?>
  		<div class="row">
        <div class="col-md-12">
        <div class="progress" style="height:30px;">
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" 
          aria-valuemin="0" aria-valuemax="100" style="width:100%"><span style="font-size:11px;">100% Completed</span>
          </div>
        </div>
        </div></div>  
        <h4>Etape 7 :: Fin d'installation </h4> 
        
        <?php
	             echo '
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>';
                    
					echo "
            <p class=\"content\" style=\"color:#238B0A\">
            Félicitation chère administrateur ::"; if(isset($_SESSION['pseudo'])) echo ucfirst($_SESSION['pseudo']);
            echo" <br>
            l'installation s'est achvée avec succès. Il est fortement recommandé de suppprimer les fichiers de l'installation.<br>
			<span style=\"color:red\">Important ::</span> Une fois vous quittez cette page, veuillez vérifier la suppression des fichiers d'installation, si ce n'est pas le cas, vous devez les supprimer manuellement en utilisant votre client ftp. 
            </p>";
					
				    echo'</div>';
				    ?>


        
        <form action="index.php" method="post">
        
                <input type="hidden" name="install" value="finish">
                <input type="hidden" name="stepfinish" value="finish">
        <input type="submit" name="submit" value="Supprimer maintenant" class="btn btn-danger btn-block">
        
    </form>
	
	
	
	 <?php   
	
  include('footer.php');
				?>