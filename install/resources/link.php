<?php
function open_conn()
 {
 $dbhost = "%hostname%";
 $dbuser = "%username%";
 $dbpass = "%password%";
 $db = "%database%";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
 if ($conn->connect_error) {
   return "Connection failed, error:: " . $conn->connect_error;
}else
 
 return $conn;
 } 
 //----------------------------------
 function dbname(){
return "%database%";
	 
	 }
//--------------------------------------------	 
function close_conn($conn)
 {
 return $conn->close();
 }
 ?>