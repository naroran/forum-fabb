<?php
session_start();
error_reporting(E_ALL);
include('resources/functions.php');
if(isset($_POST['submit']))
{       $i=0;
        $array['errors']='';
        switch($_POST['install'])
        {
			//--------------------------- licence --------------------
		case 'licence':
		if(!isset($_POST['stepLicence'])){	
		include('licence.php');
		}else{
		$bienvenue='class="btn success btn-xs"';	
        if(empty($_POST['terms']))
		{
		$array['errors'].='Veuiller accepter la licence pour continuer svp.';	
		$i++;
		}
		if($i>0){	
		include('licence.php');
		break;
		}
		include('config_db.php');
		}
		break;	
		//----------------------------- config database --------------------
	    case 'config_db':
		if(!isset($_POST['stepConfig'])){
		include('config_db.php');
		}else{
		    
			if(empty($_POST['hostname'])||empty($_POST['username'])||empty($_POST['password'])||empty($_POST['database']))
			{
			$array['errors'].='Tout les champs avec astérix <span style="color:red">* </span> sont obligatoires.';
				 $i++;
			}
			elseif(empty($_POST['url']))
			{
			$array['errors'].="Veuillez vérifier et renseigner le champ Url Website.";
				 $i++;
			} 
			elseif(empty($_POST['url_forum']))
			{
			$array['errors'].="Veuillez vérifier et renseigner le champ URL Du Forum.";
				 $i++;
			} 
			if($i>0){

			include('config_db.php');
			break;
			}
			
			else{
			$data =array('hostname'=>trim(strtolower($_POST['hostname'])),
						 'username'=>  trim($_POST['username']),
						 'password' => trim($_POST['password']),
						 'database'=>trim($_POST['database']),
						 );	
			$url=trim(strtolower($_POST['url']));
			$forum=trim(strtolower($_POST['url_forum']));
			$title_website=trim(strtolower(ucfirst($_POST['titre'])));	
				
									 	 
			$config ='../'.$forum.'application/config/config.php';
			$db ='../'.$forum.'application/config/database.php';
			$const ='../'.$forum.'application/config/constants.php';
			$addconst='defined("FABB") OR define("FABB", true);';
			$sql ='resources/sql.sql';
			$connect='resources/link.php';
            $base_url=$url.$forum;
			//----------------------------------------------------------------------

			$conn = new mysqli($data['hostname'], $data['username'], $data['password'], $data['database']);
			if ($conn->connect_error) 
			{
			   $array['errors'].='Impossible de se connecter à la base de donnée. Veuillez verifier vos identifiant svp.'.
			   utf8_encode($conn->connect_error);
			   $i++;
			}
			if($i>0){
			include('config_db.php');
			break;
			}
			
			if(!create_config($config,$base_url))
			{
			  exit("Un problème est survenu lors de l'écriture dans le fichier de configuration.<br>
			  Veuillez chmoder le fichier :: forum/application/config/config.php à 0777  et ressayez.<br>
			  Si non veuillez passer à l'installation manuelle en suivant les étapes dans le fichier ::
			  forum/docs/setup-manuel.php.");
			}
	
			if(!create_db($db,$data))
			{
			  exit("Un problème est survenu lors de l'écriture dans le fichier database,<br>
			  Veuillez chmoder le fichier :: forum/application/config/database.php à 0777 et ressayez.");
			}	
				
			   if(create_tables($data,$sql)==false)
			    {
				exit("Un problème est survenu lors de l'écriture des tables dans la base de 
				donnée. Veuillez ressayer svp.<br>
				Si non, vous pouvez installer le forum manuellement en installant les tables du fichier ::<br>
				install/resources/sql.sql directement dans phpmyadmin.");
				}
             if(!create_const($const,$addconst))
			    {
				exit("Un problème est survenu lors de l'écriture des constantes dans le fichier, si le problème persiste, veuillez ressayer une nouvelle installation.  ");
				}				

			  if(!create_conn($connect,$data))
			  {
			   $array['errors'].='Impossible de creer le fichier de connexion à la base de donnée. Veuillez ressayer l\'installation à partir de l\'étape 1 svp.';
			   $i++;
			  }
			  if($i>0){
			  include('config_db.php');
			  break;
			  }
				 
			   //------------------------------------ ok show tables ---------------------------
		   
	           $_SESSION['website']=$url;
			   $_SESSION['forum']=$forum;
			   $_SESSION['title']=$title_website;
			   include('setup.php');
			  
			}
		       
	        
		}
		break;	
		//------------------------------------ continue with admin ---------------------------
		
		
			case 'admin':
			if(!isset($_POST['stepadmin'])){
		     include('admin.php');
		    }else{
			$i=0;
		    $array['errors']='';
	
				if(empty($_POST['pseudo'])||empty($_POST['psw'])||empty($_POST['cpsw'])||empty($_POST['email']))
				{											
				$array['errors'].='Tout les champs avec astérix sont obligatoires.';
			    $i++;
				}
				elseif(strlen($_POST['pseudo'])<3 || strlen($_POST['pseudo'])>32)
				{
				$array['errors'].='Le pseudo doit &ecirc;tre entre 3 et 32 caractères.';
					$i++;
				}
				/*elseif(preg_match('/^[a-z\d_\-]{5,20}$/i', trim($_POST['pseudo'])))
				{
				$array['errors'].='Le pseudo ne doit contenir que des chiffres, des lettres, _ et - ';
					$i++;

				}*/
				elseif(strlen($_POST['psw'])<6 || strlen($_POST['psw'])>16)
				{
				$array['errors'].='Le mot de passe doit &ecirc;tre entre 6 et 16 caractères.';
					$i++;
				}
				elseif($_POST['psw']!=$_POST['cpsw'])
				{
				$array['errors'].='Le mot de passe doit &ecirc;tre identique au mot de passe de confirmation.';
					$i++;
				}
				elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
				 {
                $array['errors'].='Votre adresse email ne semble pas &ecirc;tre valide, veuillez la corriger svp.';
					$i++;
				}
				elseif(strlen($_POST['signature'])>128)
				{
                $array['errors'].='Votre signature ne doit pas dépasser 128 caractères.';
				  $i++;
				}
				
				if($i>0){
				include('admin.php');
			    break;
			    }
				else{
					include('resources/link.php');
			        //$salt='1234ABCD';	
					$pseudo=trim($_POST['pseudo']);					
				    $psw=hash('sha512',$_POST['psw']);
				    $mail=$_POST['email'];	
				    $signature=$_POST['signature'];	
					$ip=$_SERVER["REMOTE_ADDR"];
					$time=time();
					$sql ="INSERT INTO fabb_members (member_pseudo, member_mdp, member_email, member_level, member_signature,
					member_registred, member_last_visit, member_post, member_ip)
					VALUES ('$pseudo', '$psw','$mail','6','$signature', '$time','$time','0','$ip')";
					$conn=open_conn();
					if($conn->query($sql)){
					$_SESSION['pseudo']=$pseudo;
					$_SESSION['email']=$mail;						
					close_conn($conn);
					}
                    }
  					include('config_rapide.php');
		             }
					 break;
            
			case 'config_rapide':
			if(!isset($_POST['stepquickconfig'])){
		     include('config_rapide.php');
		    }else{
		  
			$raison=$_POST['raison'];
			$title=$_POST['title_forum'];
			$slogun=$_POST['slogan1'];
			$slogdeux=$_POST['slogan2'];
			$sql=array("UPDATE fabb_config SET config_value='".$raison."' WHERE config_name='raison_sociale'",
			"UPDATE fabb_config SET config_value='".$title."' WHERE config_name='forum_titre'",
			"UPDATE fabb_config SET config_value='".$slogun."' WHERE config_name='slogan_1'",
		    "UPDATE fabb_config SET config_value='".$slogdeux."' WHERE config_name='slogan_2'",
			"UPDATE fabb_config SET config_value='".$_SESSION['title']."' WHERE config_name='website_title'",
			"UPDATE fabb_config SET config_value='".$_SESSION['email']."' WHERE config_name='admin_email'");
			// plus admin contact
			include('resources/link.php');					
			$conn=open_conn();
			for($i=0;$i<sizeof($sql);$i++){
			$conn->query($sql[$i]);
			}
			close_conn($conn);		
			}
			include('finish.php');	
			break;
			
			case 'finish':
			if(!isset($_POST['stepfinish'])){
		     include('finish.php');
		    }else{
			register_shutdown_function('goodbye');	
	       $str=__DIR__.'/resources';
           (is_dir($str)) ;
           $scan = glob(rtrim($str, '/').'/*'); 
           foreach($scan as $index=>$path) { 
           unlink($path); 
           } 
           @rmdir($str); 
		   $dir = opendir('.'); // open the cwd..also do an err check.
		   while(false != ($file = readdir($dir))) 
		   {
           if(($file != ".") and ($file != "..")) 
		   {
           unlink( $file);
           }
		   } 
		   session_destroy();
           rmdir(__DIR__);

           break;
		
			}

   }
    }else{

	include('bienvenue.php');
	}
?>