<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//------------------------------------------------------
if ( ! function_exists('dataVisitor'))
{
/**
 * dataVisitor return geo data about connected visitor/member 
 *
 * Our endpoints are limited to 45 HTTP requests per minute from an IP address. 
 * If you go over this limit your requests will be throttled (HTTP 429) until 
 * your rate limit window is reset.
 * If you need unlimited queries, please see <https://members.ip-api.com/>.
 * 
 * @param  mixed $ip the ip address 
 *
 * @return void|string[] data 
 */
function dataVisitor($ip)
{
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
if($query && $query['status'] == 'success') {
  return $query;
  } else {
	  $query=array('country'=>'undefined',
	  'countryCode'=>'undefined',
	  'city'=>'undefined');
  return $query;
}

}
}
//---------------------------------------------------------------
     if( ! function_exists('file_name'))
     {
	        function file_name($download='')
			{
	 
			switch($download)
			{
				case 'rar': return 'fabb.rar';break;

		    }
			
						 
		    }
		
	 }

function getip() 
{

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
return $ip;


}
//---------------------------------------  auth access ---------------------------------------------------------
	
                                
if (!function_exists('auth_access')){

function auth_access($lvl,$const)
{ 
if($lvl>$const){
	return true;
	}

			
}
}
//------------------------------------------  auth deny ------------------------------------------

													
			  if (!function_exists('auth_deny')){
			  
function auth_deny($lvl,$const)
			  {
if($lvl<$const)
	{
		return true;
		}
			  }
			  }
//------------------------------------------ auth equal ------------------------------------------
	
			  if (!function_exists('auth_equal')){
			  
			  function auth_equal($lvl,$const)
			  {
if($lvl==$const)
	{
		return true;
		}
			  }
			  }		
//--------------------------------------- check auth ---------------------------------------------------------
	
                                
if (!function_exists('check_auth')){

function check_auth($auth)
{
$level=(isset($_SESSION['lvl']))?$_SESSION['lvl']:1;
return $auth <= intval ($level);
}
}			  	  


if (!function_exists('imageResize')){

	 function imageResize($imageResourceId,$width,$height) {


    $targetWidth =45;

    $targetHeight =45;


    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);

    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);


    return $targetLayer;

}	 }

//------------------------------------------ resize img --------------------------------------------
if (!function_exists('resize_img'))
{
	function resize_img($texte){
preg_match_all("/<img.*>/",$texte,$out);
foreach($out as $t1)
{
    foreach($t1 as $img)
    {
        preg_match("/.*height:(.*?);width:(.*?);.*/",$img,$out2);
        $height = $out2[1];
        $width = $out2[2];
        $texte = str_ireplace($out2[0],str_ireplace("<img","<img width='" . $width . "' height='" . $height . "'",$out2[0]),$texte);
    }
}
	}
}
//---------------------------------------- has alert------------------------------------------------------------
if (!function_exists('has_alert'))
{
	function has_alert($type = '')
	{
		$CI =& get_instance();
		$alerts = $CI->alert->has_alert($type);
		
		if(!empty($alerts)){
			return $alerts;
		}
		
		return false;
	}
}

//----------------------------------------------------------------------------------------------
if ( ! function_exists('cacul_age'))
{
function calcul_age($ddn)
{
    $arr1 = explode('/', $ddn);
    $arr2 = explode('/', date('d/m/Y'));
		
    if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
    return $arr2[2] - $arr1[2];

    return $arr2[2] - $arr1[2] - 1;
}
}

//----------------------------------------- meta description ----------------------------

       if ( ! function_exists('time_elapsed'))
{

function time_elapsed($depuis){
	
$elepsed=array();
$temps_passe='';
$diff = time()-$depuis;
$years=floor($diff/(24*60*60*365));

if($years==0){$elepsed[]='';}

elseif($years==1){$elepsed[]=$years.'an ';}

elseif($years>1){$elepsed[]=$years.'ans ';}

$secEnMois=$diff % (24*60*60*365);

$mois=floor($secEnMois/(30*24*60*60));

if($mois==0){$elepsed[]='';}

else{$elepsed[]=$mois.'mois ';}

$secEnJours=$secEnMois % (30*24*60*60);
$jours=floor($secEnJours/(24*60*60));

if($jours==0){$elepsed[]='';}
else{$elepsed[]=$jours.'j ';}

$secEnHeures=$secEnJours % (24*60*60);
$heures=floor($secEnHeures/(60*60));

if($heures==0){$elepsed[]='';}
else{$elepsed[]=$heures.'h ';}


$secEnMin=$secEnHeures % (60*60);
$min=floor($secEnMin/60);
$elepsed[]=' '.$min.'min ' ;
$sec=$secEnMin % 60;
$elepsed[]=' '.floor($sec).'sec';
foreach($elepsed as $val){
	$temps_passe.= $val;
	                      }
	return $temps_passe;
}	
}
//--------------------------------------- check age ---------------------------------------


       if ( ! function_exists('check_age'))
{

function check_age($timestamp){
	if($timestamp==false){
		return 'Undefined';
	}else{
	
$elepsed=array();
$age='';
$diff = time()-$timestamp;
$years=floor($diff/(60*60*24*365));

if($years==0){$elepsed[]='';}

elseif($years==1){$elepsed[]=$years.'an ';}

elseif($years>1){$elepsed[]=$years.'ans ';}


foreach($elepsed as $val){
	$age.= $val;
	           }
	return $age;
}	
}}
//--------------------------------------------------

       if ( ! function_exists('elapsed'))
{

function elapsed($timestamp){
	
$elepsed=array();
$temps_passe='';
$years=floor($timestamp/(24*60*60*365));

if($years==0){$elepsed[]='';}

elseif($years==1){$elepsed[]=$years.'an ';}

elseif($years>1){$elepsed[]=$years.'ans ';}

$secEnMois=$timestamp % (24*60*60*365);

$mois=floor($secEnMois/(30*24*60*60));

if($mois==0){$elepsed[]='';}

else{$elepsed[]=$mois.'mois ';}

$secEnJours=$secEnMois % (30*24*60*60);
$jours=floor($secEnJours/(24*60*60));

if($jours==0){$elepsed[]='';}
else{$elepsed[]=$jours.'j ';}

$secEnHeures=$secEnJours % (24*60*60);
$heures=floor($secEnHeures/(60*60));

if($heures==0){$elepsed[]='';}
else{$elepsed[]=$heures.'h ';}


$secEnMin=$secEnHeures % (60*60);
$min=floor($secEnMin/60);
$elepsed[]=' '.$min.'min ' ;
$sec=$secEnMin % 60;
$elepsed[]=' '.floor($sec).'sec';
foreach($elepsed as $val){
	$temps_passe.= $val;
	                      }
	return $temps_passe;
}	
}
//------------------------------------------------------
if ( ! function_exists('set_copyright'))
{
	function set_copyright($year = 'auto')
	{ 
		if(intval($year) == 'auto')
		{ 
		return $year = date('Y'); 
		} 
		if(intval($year) == date('Y'))
		{ 
		return intval($year);
		} 
		if(intval($year) < date('Y'))
		{
		return intval($year) . ' - ' . date('Y');
		} 
		if(intval($year) > date('Y'))
		{ 
		return date('Y');
		}
	}		
} 
    if (!function_exists('is_email'))
{
	 function is_email($user)
	{
		  //If the username input string is an e-mail, return true
		  if(filter_var($user, FILTER_VALIDATE_EMAIL))
		   {
			  return true;
		   } else
		      {
			  return false;
			  }
	}
		   
  }

 
