<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('thumb')){							
	  
    function thumb($fullname, $width, $height)
    {

        $dir = './assets/avatars/';
        $url = base_url('assets/avatars/');
        
		$CI = &get_instance();
        $extension = pathinfo($fullname, PATHINFO_EXTENSION);
        $filename = pathinfo($fullname, PATHINFO_FILENAME);
        $image_org = $dir . $filename . "." . $extension;
        $image_thumb = $dir . $filename . "-" . $height . '_' . $width . "." . $extension;
        $image = $url . $filename . "-" . $height . '_' . $width . "." . $extension;

        if (!file_exists($image_thumb)) {
            $CI->load->library('image_lib');
            $config['source_image'] = $image_org;
            $config['new_image'] = $image_thumb;
            $config['width'] = $width;
            $config['height'] = $height;
            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();
            $CI->image_lib->clear();
        }
        return $image;
    }								  
	}
	
//------------------------------------- menu forum ------------------------------------

if ( ! function_exists('menu'))
{

   function menu($array)
{
     switch($array['lvl'])
	 {

             case PENDING:
			 
			 $menu='
			 
<nav class="navbar navbar-inverse">
                  <div class="container-fluid">
                  <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
                  </button>
                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav">';
				  
				   if($array['blink']=='home'){
				   $menu.='<li class="active">				  		  
				   <a href="'.base_url('logout').'"><span class="glyphicon glyphicon-home"></span> Home</a></li>';
				   }else{
				   $menu.='<li class="">				  		  
				   <a href="'.base_url('logout').'"><span class="glyphicon glyphicon-home"></span> Home</a></li>';					                   }
	               
				   if($array['blink']=='forum'){
				   $menu.='<li class="active"><a href="'.base_url('logout').'">Forum </a></li>';					   
				   }else{ 
				   $menu.='<li class=""><a  href="'.base_url('logout').'">Forum </a></li>';
					}
							
		$menu.='<li><a data-toggle="tooltip" data-placement="bottom" data-original-title="Effectuer des recherches sur le forum"
       class="red-tooltip" href="'.base_url('logout').'"> Rechercher</a></li>
		        
	    <li><a data-toggle="tooltip" data-placement="bottom" title="" data-original-title="la liste des membre est disponible dans votre tableau de bord U-Panel"
       class="red-tooltip"href="'.base_url('logout').'"> Membres</a></li>
	 
	    <li><a><strong style="color:red">Bienvenue '.ucfirst($array['pseudo']).', veuillez activer votre compte:</strong> '.$array['msg'].'</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">';
         $menu.='
		        <li><a href="'.base_url('users/deconnexion').'"><span class="glyphicon glyphicon-log-out"></span> Deconnexion</a></li>
      </ul>
    </div>
  </div>
</nav>';
return $menu;
			 break;
			 
			 case MEMBER:
						  
			 $menu='
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">';
	  
				   if($array['blink']=='home'){
				   $menu.='<li class="active">				  		  
				   <a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span> Home</a></li>';
				   }else{
				   $menu.='<li class="">				  		  
				   <a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span> Home</a></li>';					                   }
	               
				   if($array['blink']=='forum'){
				   $menu.='<li class="active"><a href="'.base_url('index').'">Forum </a></li>';					   
				   }else{ 
				   $menu.='<li class=""><a  href="'.base_url('index').'">Forum </a></li>';
					}
				   if($array['blink']=='search'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="Effectuer des recherches sur le forum" href="'.base_url('search/index').'"> 
				   Rechercher</a></li>';
				   }else{
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="Effectuer des
				   recherches sur le forum" href="'.base_url('search/index').'"> Rechercher</a></li>';
				   }
				   if($array['blink']=='member'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" 
				   href="'.base_url('member/member_list/'.$array['idM'].'/').'">
				   Membres</a></li>';				   
				   }else{
                   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" 
				   href="'.base_url('member/member_list/'.$array['idM'].'/').'"> Membres</a></li>';
				   }
				   $menu.='<li><a><b class="text-success"> '.ucwords('bienvenue chère membre :: '.$array['pseudo']).'</b></a></li>';
				   $menu.='
				    </ul>
				  
				    <ul class="nav navbar-nav navbar-right">';
				    if($array['blink']=='panel'){
				    $menu.='<li class="active"><a href="'.base_url('member/index/'.$array['idM']).'"> U-Panel </a></li>';	
				    }else{
				    $menu.='<li class=""><a href="'.base_url('member/index/'.$array['idM']).'"> U-Panel </a></li>';
					   }
				    if($array['blink']=='message')
				    {
				    if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='
					 <li class="active"><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='
						 <li class="active"><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
						 }
					 
					 

				 }else{
					 if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
						 }
				 }
				 
				 $menu.='
				<li class="dropdown">
				<a href="#" class="dropdown-toggle dropdownaction" data-toggle="dropdown" role="button" aria-haspopup="true" 
				aria-expanded="false">Action &nbsp;&nbsp;<span class="caret"></span></a>
				<ul class="dropdown-menu dropdownaction">
				<li class="dropdownaction">
				<a class="dropdownaction">Your Total Warning :: 0/5</a></li>
				<li><a class="dropdownaction">Yout Total Post :: '.$array['tpid'].'</a></li>
				<li><a class="dropdownaction">Your Total Topic :: '.$array['ttid'].'</a></li>
				<li role="separator" class="divider"></li>
				<li><a class="dropdownaction" href="'.base_url('users/deconnexion').'"><span class="glyphicon glyphicon-log-out">
				</span>'.nbs(2).'Déconnexion</a></li>
			  </ul>
			</li>

      </ul>
    </div>
  </div>
</nav>';

				  
return $menu;
break;	

case MODO:
						  
			 $menu='
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">';
	  
	  if($array['blink']=='home'){
		  $menu.='<li class="active"><a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span>
		   Home </a></li>';
		  }else{
          $menu.='<li class=""><a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span> Home </a></li>';
			  }
	  if($array['blink']=='forum'){
				   $menu.='<li class="active"><a href="'.base_url('index').'">Forum </a></li>';					   
				   }else{ 
				   $menu.='<li class=""><a  href="'.base_url('index').'">Forum </a></li>';
					}
				   if($array['blink']=='search'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="Effectuer des recherches sur le forum" href="'.base_url('member/search').'"> 
				   Rechercher</a></li>';
				   }else{
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="Effectuer des
				   recherches sur le forum" href="'.base_url('member/search').'"> Rechercher</a></li>';
				   }
				   if($array['blink']=='member'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" href="'.base_url('liste/membres').'">
				   Membres</a></li>';				   
				   }else{
                   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" 
				   href="'.base_url('liste/membres').'"> Membres</a></li>';
				   }
				   $menu.='<li><a><b class="text-success"> '.ucwords('bienvenue chère modérateur :: '.$array['pseudo']).'</b></a></li>';
				   $menu.='
				  </ul>
      
	  
                  <ul class="nav navbar-nav navbar-right">';
				  if($array['blink']=='modo'){
				  $menu.='<li class="active"><a href="'.base_url('modo/index/'.$array['idM']).'"> M-Panel </a></li>';	
				  }else{
				  $menu.='<li class=""><a href="'.base_url('modo/index/'.$array['idM']).'"> M-Panel </a></li>';
					   }
				 if($array['blink']=='message')
				 {
				    if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class="active"><a href="'.base_url('messagerie/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class="active"><a href="'.base_url('messagerie/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
						 }
					 
					 

				 }else{
					 if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
						 }
				 }
				 
				 $menu.='
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
				aria-expanded="false">Action<span class="caret"></span></a>
				<ul class="dropdown-menu">
                 <li class="dropdownaction">
				<a class="dropdownaction">Your Total Warning :: 0/5</a></li>
				<li><a class="dropdownaction">Yout Total Post :: '.$array['tpid'].'</a></li>
				<li><a class="dropdownaction">Your Total Topic :: '.$array['ttid'].'</a></li>
				<li role="separator" class="divider"></li>
				<li><a class="dropdownaction" href="'.base_url('users/deconnexion').'"><span class="glyphicon glyphicon-log-out">
				</span>'.nbs(2).'Déconnexion</a></li>
			  </ul>
			</li>

      </ul>
    </div>
  </div>
</nav>';

				  
return $menu;
break;
case ADMIN:
						  
			 $menu='
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">';
	  
	  if($array['blink']=='home'){
		  $menu.='<li class="active"><a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span>
		   Home </a></li>';
		  }else{
          $menu.='<li class=""><a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span> Home </a></li>';
			  }
	  if($array['blink']=='forum'){
				   $menu.='<li class="active"><a href="'.base_url('index').'">Forum </a></li>';					   
				   }else{ 
				   $menu.='<li class=""><a  href="'.base_url('index').'">Forum </a></li>';
					}
				   if($array['blink']=='search'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="Effectuer des recherches sur le forum" href="'.base_url('search/index').'"> 
				   Rechercher</a></li>';
				   }else{
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="Effectuer des
				   recherches sur le forum" href="'.base_url('search/index').'"> Rechercher</a></li>';
				   }
				   if($array['blink']=='member'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" href="'.base_url('liste/membres').'">
				   Membres</a></li>';				   
				   }else{
                   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" 
				   href="'.base_url('liste/membres').'"> Membres</a></li>';
				   }
				   $menu.='<li><a><b class="text-success"> '.ucwords('bienvenue chère administrateur :: '.$array['pseudo']).'</b></a></li>';
				   $menu.='
				  </ul>
      
	  
                  <ul class="nav navbar-nav navbar-right">';
				  if($array['blink']=='admin'){
				  $menu.='<li class="active"><a href="'.base_url('admin/index/'.$array['idM']).'"> A-Panel </a></li>';	
				  }else{
				  $menu.='<li class=""><a href="'.base_url('admin/index/'.$array['idM']).'"> A-Panel </a></li>';
					   }
				 if($array['blink']=='message')
				 {
				    if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class="active"><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class="active"><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
						 }
					 
					 

				 }else{
					 				    if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
						 }
				 }
				 
				 $menu.='
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
				aria-expanded="false">Action<span class="caret"></span></a>
				<ul class="dropdown-menu">
                <li class="dropdownaction">
				<a class="dropdownaction">Total Warning Member:: RAS</a></li>
				<li><a class="dropdownaction">Yout Total Post :: '.$array['tpid'].'</a></li>
				<li><a class="dropdownaction">Your Total Topic :: '.$array['ttid'].'</a></li>
				<li role="separator" class="divider"></li>
				<li><a class="dropdownaction" href="'.base_url('users/deconnexion').'"><span class="glyphicon glyphicon-log-out">
				</span>'.nbs(2).'Déconnexion</a></li>
			  </ul>
			</li>

      </ul>
    </div>
  </div>
</nav>';

				  
return $menu;
break;
default:
	
	       $menu='
	              <nav class="navbar navbar-inverse">
                  <div class="container-fluid">
                  <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
                  </button>
                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav">';
				  
				   if($array['blink']=='home'){
				   $menu.='<li class="active">				  		  
				   <a href="'.base_url('home/index').'"><img src="'.base_url('assets/svg/home.svg').'" height="16" width="16"> Home</a></li>';
				   }else{
				   $menu.='<li class="">				  		  
				   <a href="'.base_url('home/index').'"><img src="'.base_url('assets/svg/home.svg').'" height="16" width="16"> Home</a></li>';					                   }
	               
				   if($array['blink']=='forum'){
				   $menu.='<li class="active"><a href="'.base_url('index').'">Forum </a></li>';					   
				   }else{ 
				   $menu.='<li class=""><a  href="'.base_url('index').'">Forum </a></li>';
					}
				   
				   if($array['blink']=='search'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom"
				   data-original-title="Effectuer des recherches sur le forum" href="'.base_url('search/index').'">
				   Rechercher</a></li>';}else{
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom"
				   data-original-title="Effectuer des recherches sur le forum" href="'.base_url('search/index').'">
				   Rechercher</a></li>';	   
				   }
				   if($array['blink']=='member'){
	               $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom"
				   data-original-title="la liste des membres est disponible dans votre tableau de bord." 
				   class="red-tooltip" href="'.base_url('login').'"> Membres</a></li>';
		           }else{
	               $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="la liste des membres est disponible dans votre tableau de bord." 
				   class="red-tooltip" href="'.base_url('login').'"> Membres</a></li>';			  
		           }

                   $menu.='<li><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="Cliquez pour télécharger le forum fabb" 
				   class="red-tooltip" href="'.base_url('assets/download/fabb.rar').'"> Télécharger</a></li>
	   
		           <li><a><strong style="color:#3700EA">  Bienvenue visiteur </strong> </a></li>
                   </ul>
                   <ul class="nav navbar-nav navbar-right">';

				   if($array['blink']=='register'){
				   $menu.='<li class="active"><a href="'.base_url('inscrire').'"><img src="'.base_url('assets/svg/userplus-white.svg').'" height="14" width="14">
				   Register </a></li>';}else{
				   $menu.='<li class=""><a href="'.base_url('inscrire').'"><img src="'.base_url('assets/svg/userplus-blue.svg').'" height="14" width="14">
				   Register </a></li>';	  
				   }

				   if($array['blink']=='login'){
				   $menu.='<li class="active"><a href="'.base_url('login').'"> '.$array['sign-white'].nbs(1).' Login</a></li>';
				   }
				   else{
				   $menu.='<li class=""><a href="'.base_url('login').'"> <img src="'.base_url('assets/svg/sign-in-alt.svg').'" height="14" width="14">'.nbs(1).' Login</a></li>';
				   }
				   $menu.='
				   </ul>
				   </div>
				   </div>
				   </nav>';
				
	               return $menu;
	
                  break;
     

	}
}
}
//------------------------------------- menu forum ------------------------------------

if ( ! function_exists('menu_home'))
{

   function menu_home($array)
{
     switch($array['lvl'])
	 {
		 case VISITOR:
	
	       $menu='
	              <nav class="navbar navbar-inverse">
                  <div class="container-fluid">
                  <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
                  </button>
                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav">';
				  
				   if($array['blink']=='home'){
				   $menu.='<li class="active">				  		  
				   <a href="'.base_url('home/index').'"><span class="glyphicon glyphicon-home"></span> Home</a></li>';
				   }else{
				   $menu.='<li class="">				  		  
				   <a href="'.base_url('home/index').'"><span class="glyphicon glyphicon-home"></span> Home</a></li>';					                   }
	               
				   if($array['blink']=='forum'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-html="true"
				   data-original-title="Accéder au forum." href="'.base_url('index').'">Community </a></li>';					   
				   }else{ 
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-html="true"
				   data-original-title="Accéder au forum."  href="'.base_url('index').'">Community </a></li>';
					}
				   
				   if($array['blink']=='search'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-html="true"
				   data-original-title="Support<br> Les pages du support sont en cours de réalisation.<br>Veuillez patienter 
				   encore qulque temps." href="">
				   Support</a></li>';}else{
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-html="true"
				   data-original-title="Support<br> Les pages du support sont en cours de réalisation.<br>Veuillez patienter 
				   encore qulque temps." href="">
				   Aide/Support</a></li>';	   
				   }
				   if($array['blink']=='member'){
	               $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-html="true"
				   data-original-title="Documemtation<br>La documemtation est en cours de réalisation.<br>Veuillez patienter 
				   encore qulque temps." href=""> Documentation</a></li>';
		           }else{
	               $menu.='<li class=""><a class="text-left" data-toggle="tooltip" data-placement="bottom" data-html="true"
				   data-original-title="Documemtation<br>La documemtation est en cours de réalisation.<br>Veuillez patienter 
				   encore qulque temps." href=""> Documentation</a></li>';			  
		           }

                   $menu.='<li><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="Cliquez pour télécharger le forum fabb" 
				   class="red-tooltip" href="'.base_url('assets/download/fabb.rar').'"> Télécharger</a></li>
	   
		           <li><a><strong style="color:green">  Bienvenue visiteur </strong> </a></li>
                   </ul>
                   <ul class="nav navbar-nav navbar-right">';

				   if($array['blink']=='register'){
				   $menu.='<li class="active"><a href="'.base_url('register/inscription').'"><i class="fas fa-user-plus"></i> 
				   Register </a></li>';}else{
				   $menu.='<li class=""><a href="'.base_url('register/inscription').'"><i class="fas fa-user-plus"></i> 
				   Register </a></li>';	  
				   }

				   if($array['blink']=='login'){
				   $menu.='<li class="active"><a href="'.base_url('users/connexion').'"> <i class="fas fa-sign-in-alt"></i>
				    Login</a></li>';
				   }
				   else{
				   $menu.='<li class=""><a href="'.base_url('users/connexion').'"> <i class="fas fa-sign-in-alt"></i>
				    Login</a></li>';
				   }
				   $menu.='
				   </ul>
				   </div>
				   </div>
				   </nav>';
				
	               return $menu;
	
                  break;
				   case MEMBER:
						  
			 $menu='
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">';
	  
				   if($array['blink']=='home'){
				   $menu.='<li class="active">				  		  
				   <a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span> Home</a></li>';
				   }else{
				   $menu.='<li class="">				  		  
				   <a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span> Home</a></li>';					                   }
	               
				   if($array['blink']=='forum'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-html="true"
				   data-original-title="Accéder au forum." href="'.base_url('index').'">Community </a></li>';					   
				   }else{ 
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-html="true"
				   data-original-title="Accéder au forum."  href="'.base_url('index').'">Community </a></li>';
					}
				   if($array['blink']=='search'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="Effectuer des recherches sur le forum" href="'.base_url('search/index').'"> 
				   Support</a></li>';
				   }else{
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="Effectuer des
				   recherches sur le forum" href="'.base_url('search/index').'"> Support</a></li>';
				   }
				   if($array['blink']=='member'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" 
				   href="'.base_url('member/member_list/'.$array['idM'].'/').'">
				   Documentation</a></li>';				   
				   }else{
                   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" 
				   href="'.base_url('member/member_list/'.$array['idM'].'/').'"> Documemtation</a></li>';
				   }
				   $menu.='<li><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="Cliquez pour télécharger le forum fabb" 
				   class="red-tooltip" href="'.base_url('assets/download/fabb.rar').'"> Télécharger</a></li>';
				   
				   $menu.='<li><a><b class="text-success"> '.ucwords('bienvenue '.$array['pseudo']).'</b></a></li>';
				   $menu.='
				    </ul>
				  
				    <ul class="nav navbar-nav navbar-right">';
				    if($array['blink']=='panel'){
				    $menu.='<li class="active"><a href="'.base_url('panel/index').'"> U-Panel </a></li>';	
				    }else{
				    $menu.='<li class=""><a href="'.base_url('panel/index').'"> U-Panel </a></li>';
					   }
				    if($array['blink']=='message')
				    {
				    if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='
					 <li class="active"><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='
						 <li class="active"><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
						 }
					 
					 

				 }else{
					 if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';

						 }
				 }
				 
				 $menu.='
				<li class="dropdown">
				<a href="#" class="dropdown-toggle dropdownaction" data-toggle="dropdown" role="button" aria-haspopup="true" 
				aria-expanded="false">Action &nbsp;&nbsp;<span class="caret"></span></a>
				<ul class="dropdown-menu dropdownaction">
				<li class="dropdownaction"><a class="dropdownaction" href="'.base_url('users/deconnexion').'"><span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>
				<li><a class="dropdownaction" href="#">Another action</a></li>
				<li><a class="dropdownaction" href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a class="dropdownaction" href="#">Separated link</a></li>
			  </ul>
			</li>

      </ul>
    </div>
  </div>
</nav>';

				  
return $menu;
break;	

case MODO:
						  
			 $menu='
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">';
	  
	  if($array['blink']=='home'){
		  $menu.='<li class="active"><a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span>
		   Home </a></li>';
		  }else{
          $menu.='<li class=""><a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span> Home </a></li>';
			  }
	  if($array['blink']=='forum'){
				   $menu.='<li class="active"><a href="'.base_url('index').'">Forum </a></li>';					   
				   }else{ 
				   $menu.='<li class=""><a  href="'.base_url('index').'">Forum </a></li>';
					}
				   if($array['blink']=='search'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="Effectuer des recherches sur le forum" href="'.base_url('member/search').'"> 
				   Rechercher</a></li>';
				   }else{
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="Effectuer des
				   recherches sur le forum" href="'.base_url('member/search').'"> Rechercher</a></li>';
				   }
				   if($array['blink']=='member'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" href="'.base_url('liste/membres').'">
				   Membres</a></li>';				   
				   }else{
                   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" 
				   href="'.base_url('liste/membres').'"> Membres</a></li>';
				   }
				   $menu.='<li><a><b class="text-success"> '.ucwords('bienvenue '.$array['pseudo']).'</b></a></li>';
				   $menu.='
				  </ul>
      
	  
                  <ul class="nav navbar-nav navbar-right">';
				  if($array['blink']=='modo'){
				  $menu.='<li class="active"><a href="'.base_url('modo/index').'"> M-Panel </a></li>';	
				  }else{
				  $menu.='<li class=""><a href="'.base_url('modo/index').'"> M-Panel </a></li>';
					   }
				 if($array['blink']=='message')
				 {
				    if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class="active"><a href="'.base_url('messagerie/inbox').'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class="active"><a href="'.base_url('messagerie/inbox/').'">'.$color.' '.$envelope.'</a></li>';
						 }
					 
					 

				 }else{
					 				    if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class=""><a href="'.base_url('messagerie/inbox').'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class=""><a href="'.base_url('messagerie/inbox/').'">'.$color.' '.$envelope.'</a></li>';
						 }
				 }
				 
				 $menu.='
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
				aria-expanded="false">Action<span class="caret"></span></a>
				<ul class="dropdown-menu">
				<li><a href="'.base_url('logout').'"><span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
			  </ul>
			</li>

      </ul>
    </div>
  </div>
</nav>';

				  
return $menu;
break;
case ADMIN:
						  
			 $menu='
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">';
	  
	  if($array['blink']=='home'){
		  $menu.='<li class="active"><a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span>
		   Home </a></li>';
		  }else{
          $menu.='<li class=""><a href="'.base_url('home').'"><span class="glyphicon glyphicon-home"></span> Home </a></li>';
			  }
	  if($array['blink']=='forum'){
				   $menu.='<li class="active"><a href="'.base_url('index').'">Forum </a></li>';					   
				   }else{ 
				   $menu.='<li class=""><a  href="'.base_url('index').'">Forum </a></li>';
					}
				   if($array['blink']=='search'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" 
				   data-original-title="Effectuer des recherches sur le forum" href="'.base_url('member/search').'"> 
				   Rechercher</a></li>';
				   }else{
				   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="Effectuer des
				   recherches sur le forum" href="'.base_url('member/search').'"> Rechercher</a></li>';
				   }
				   if($array['blink']=='member'){
				   $menu.='<li class="active"><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" href="'.base_url('liste/membres').'">
				   Membres</a></li>';				   
				   }else{
                   $menu.='<li class=""><a data-toggle="tooltip" data-placement="bottom" data-original-title="la liste des 
				   membres est disponible dans votre tableau de bord." class="red-tooltip" 
				   href="'.base_url('liste/membres').'"> Membres</a></li>';
				   }
				   $menu.='<li><a><b class="text-success"> '.ucwords('bienvenue administrateur '.$array['pseudo']).'</b></a></li>';
				   $menu.='
				  </ul>
      
	  
                  <ul class="nav navbar-nav navbar-right">';
				  if($array['blink']=='admin'){
				  $menu.='<li class="active"><a href="'.base_url('admin/index/'.$array['idM']).'"> A-Panel </a></li>';	
				  }else{
				  $menu.='<li class=""><a href="'.base_url('admin/index/'.$array['idM']).'"> A-Panel </a></li>';
					   }
				 if($array['blink']=='message')
				 {
				    if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class="active"><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class="active"><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
						 }
					 
					 

				 }else{
					 				    if($array['nbr_msg']>0){
					 $color='<span style="color:red">'. $array['nbr_msg'].' </span> ';
					 $envelope='<span style="color:red" class="glyphicon glyphicon-envelope"></span>';
				     $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
					 }else{
						 $color='<span style="color:green">'. $array['nbr_msg'].' </span> ';
						 $envelope='<span style="color:green" class="glyphicon glyphicon-envelope"></span>';
						 $menu.='<li class=""><a href="'.base_url('message/inbox/'.$array['idM']).'">'.$color.' '.$envelope.'</a></li>';
						 }
				 }
				 
				 $menu.='
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
				aria-expanded="false">Action<span class="caret"></span></a>
				<ul class="dropdown-menu">
				<li><a href="'.base_url('users/deconnexion').'"><span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
			  </ul>
			</li>

      </ul>
    </div>
  </div>
</nav>';

				  
return $menu;
break;

		 
	 }
	 
}

}