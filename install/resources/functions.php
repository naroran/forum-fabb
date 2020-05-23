<?php
function create_db($file,$data)
	{
         $oldfile=file_get_contents($file);
		 
		 ////////////////////////////////////////////////////////////
		 $old = array("%hostname%",
		              "%username%",
					  "%password%",
					  "%database%");		  
		  $modified = str_replace($old, $data, $oldfile);
		  if(file_put_contents($file,$modified)){
				return true;
			   }else{
				return false;
			   }
		 
	}
//----------------------------- config base url --------------------------------
	function create_config($file,$url)
	{
          $old=file_get_contents($file);
		  
		  $text=str_replace('%base_url%', $url,$old);
		  
		 if(file_put_contents($file, $text))
		 {	return true;
			} else {
				return false;
			       }
		 	}
//-------------------------------------------------------------				
	// Function to create the tables and fill them with the default data
	function create_tables($data,$file)
	{
			// Check for errors
		$conn = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);			
		if (!$conn) {
		return false;
		}
		$query = file_get_contents($file);
		if($conn->multi_query($query))
		{
		return true;
		}else return false;
        $conn->close();
}
//--------------------------------------------------------
function create_conn($file,$data)
	{
         $oldfile=file_get_contents($file);
		 
		 ////////////////////////////////////////////////////////////
		 $old = array("%hostname%",
		              "%username%",
					  "%password%",
					  "%database%");		  
		  $modified = str_replace($old, $data, $oldfile);
		  if(file_put_contents($file,$modified)){
				return true;
			   }else{
				return false;
			   }
		 
	}
function create_const($file,$data){	
//$file = 'people.txt';
// Ouvre un fichier pour lire un contenu existant
$constante = file_get_contents($file);
// Ajoute une personne
$constante .= $data;
// Écrit le résultat dans le fichier
if(file_put_contents($file, $constante)){return true;}else{return false;}	
}
//---------------------------------- del files --------------------------

function delete_folder($dir) {
    $dh = opendir($dir);
 if ($dh) {
  while($file = readdir($dh)) {
   if (!in_array($file, array('.', '..'))) {
    if (is_file($dir.$file)) {
     unlink($dir.$file);
    }
    else if (is_dir($dir.$file)) {
     delete_folder($dir.$file);
    }
   }
  }
  rmdir($dir);
 }
}
//---------------------------------------------------------------
function myfiles(){
	
  			$files = array();
$dir = opendir('.'); // open the cwd..also do an err check.
while(false != ($file = readdir($dir))) {
        if(($file != ".") and ($file != "..") and ($file != "index.php"))
		 {
                $files[] = $file; // put in array.
        }  
		 
}

	return $files;
	
	}
function goodbye(){
		if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}
	
	
	header("location:".$protocol.$_SERVER['SERVER_NAME']."/".$_SESSION['forum']."login");
	
	}
?>