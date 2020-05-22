<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 if ( ! function_exists('page_title'))
{
function page_title($title){
		switch($title){

			//----------------------------- forum ------------------------
			case "forum/index": $title='forum fabb ';return $title; break;
			case "voir forum": $title='discussion sur la creation des sites web';return $title; break;
			case "voir topic": $title='sujet de discussion sur la creation des sites web ';return $title; break;
			//--------------------------------- member -------------------------------------------
			case "signup": $title='inscription dans forum de discussion ';return $title; break;	
			case "login": $title='acces forum de discussion fabb ';return $title; break;
			case "register": $title='s\'enregister au forum de discussion ';return $title; break;
			case "logout": $title='deconnexion du forum de discussion ';return $title; break;
					
			//--------------------------------- rules------------------------------------------
			case "rules": $title=' les regles du site ';return $title; break;
			

			
			}
                  }	
}