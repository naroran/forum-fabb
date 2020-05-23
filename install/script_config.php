<?php
include('header.php');
 
 
           /* if(is_writable($chmod))
            {*/
 
                if(isset($_SESSION['i'])){
	             echo '
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>';
                    $erreur=explode(".", $_SESSION['errors']);
					for($i=0;$i<count($erreur);$i++)
					{
					echo '<span style=" font-size:rem">'. $erreur[$i].'</span><br>';
					}
				    echo'</div>';
					
				    }
				if(isset($_SESSION['conn'])){
	             echo '
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>';
                    
					echo '<span style=" font-size:rem">'.$_SESSION['conn'].'</span><br>';
					
				    echo'</div>';
					
				    }	
                
				?>
             
             <h4>Information base de donnée</h4>
             <hr>
                <form id="install_form" method="POST" action="index.php">
                <div class="form-group">
                    <label for="hostname">Hostname</label>
                    <input type="text" id="hostname" placeholder="Généralement :: localhost, mais vous devez vous en &ecirc;tre s&ucirc;r." class="form-control" name="hostname" />
                </div>
                
                <div class="form-group">
                    <label for="username">Database username</label>
                    <input type="text" id="username" class="form-control" name="username" />
                </div>
                
                <div class="form-group">
                    <label for="password">Database Password</label>
                    <input type="password" id="password" class="form-control" name="password" />
                </div>
                
                <div class="form-group">
                    <label for="database">Database Name</label>
                    <input type="text" id="database" class="form-control" name="database" />
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
                 <label for="url">URL Website <span style=" font-size:10px;color:red">Veuillez vérifier votre URL</span></label>
                  <input type="text" id="url" class="form-control" name="url" value="<?= $protocol.$_SERVER['SERVER_NAME']?>/" />
                
                </div>
                
                <div class="form-group">
                    <label for="url_forum">URL Du Forum <span style=" font-size:10px;color:red">Par défaut, le forum sera installé dans :: </span></label>
                    <input type="text" id="url_forum" class="form-control" name="url_forum" value="<?=$protocol.$_SERVER['SERVER_NAME']?>/forum/" />

                </div> 
                        <input type="hidden" name="install" value="dbase">
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
							session_destroy();
                include('footer.php');
				?>