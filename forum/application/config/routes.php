<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'forum';

//$route['default_controller'] = 'welcome';
$route['404_override'] = 'Custom404';
$route['translate_uri_dashes'] = FALSE;
//--------------------------------------


//-------------------------------- users -------------------------------------
$route['login'] = 'users/connexion';
$route['logout'] = 'users/deconnexion';
$route['re-valider'] = 'users/reconfirm';


//------------------------------------ register --------------------------------
$route['inscrire'] = 'register/inscription';

//-------------------------------------------- member ------------------------------
$route['panel/index/(:any)'] = 'member/index/$1';
//-------------------------------------------- messagerie interne ---------------------------------
$route['message/inbox/(:any)'] = 'member/inbox/$1';
$route['lire/message/(:any)/(:any)'] = 'member/consulter/$1/$2';
$route['nouveau/message/(:any)'] = 'member/new_pm/$1';
$route['delete/message/(:any)/(:any)/(:any)'] = 'member/del_pm/$1/$2/$3';
$route['visit/profil/(:any)/(:any)'] = 'member/visit_profil/$1/$2';





































//---------------------------------- admin ----------------------------
$route['admin/index/(:any)'] = 'admin/index/$1';
$route['delete/pub/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/delete_pub/$1/$2/$3/$4/$5/$6';
$route['delete/pub/(:any)/(:any)/(:any)/(:any)'] = 'admin/delete_pub/$1/$2/$3/$4';
$route['delete/pub/(:any)/(:any)/(:any)'] = 'admin/delete_pub/$1/$2/$3';
$route['delete/pub/(:any)/(:any)/(:any)'] = 'admin/delete_pub/$1/$2';
$route['delete/pub/(:any)/(:any)'] = 'admin/delete_pub/$1';
$route['voir/pub/(:any)/(:any)'] = 'admin/view_add/$1/$2';
$route['delete/abus/(:any)/(:any)/(:any)'] = 'admin/delete_report/$1/$2/$3';


//----------------------------------- modo --------------------------
$route['delete/report/(:any)/(:any)/(:any)'] = 'modo/delete_report/$1/$2/$3';

//---------------------------------- forum --------------------------
$route['index'] = 'forum/index';
$route['voir/forum/(:any)'] = 'forum/view_forum/$1/';
$route['voir/forum/(:any)/(:any)'] = 'forum/view_forum/$1/$2';
$route['voir/topic/(:any)'] = 'forum/view_topic/$1/';
$route['voir/topic/(:any)/(:any)'] = 'forum/view_topic/$1/$2';
$route['voir/topic/(:any)/(:any)/(:any)'] = 'forum/view_topic/$1/$2/$3';
$route['lock/topic/(:any)'] = 'forum/lock_topic/$1';
//$route['lire/annonces/(:any)'] = 'forum/view_topic/$1';
$route['unlock/topic/(:any)'] ='forum/unlock_topic/$1';
$route['move/forum/(:any)'] ='forum/move_forum/$1';


//---------------------------------- poster -------------------------
$route['delete/post/(:any)'] = 'poster/delete_post/$1';

$route['supprimer/post/(:any)/(:any)'] = 'poster/del_post/$1/$2';

$route['delete/topic/(:any)'] ='poster/delete_topic/$1';
$route['delete/topic/(:any)/(:any)'] ='poster/delete_topic/$1/$2';


$route['repondre/post/(:any)'] = 'poster/reply/$1';
$route['add/topic/(:any)'] = 'poster/add_topic/$1';
$route['edit/post/(:any)'] ='poster/editer_post/$1';
//-------------------------------------------- contact -------------------------

$route['contact'] = 'contact/report_msg';












//------------------------------ member -----------------------
$route['valid/email/(:any)'] = 'users/email_confirm/$1';





$route['forget/password'] = 'users/forget_psw';
$route['new/password/(:any)'] = 'users/new_psw/$1';


$route['update/profile'] = 'member/update_profil';
$route['update/profile/(:any)'] = 'member/update_profil/$1';



$route['member/profil/(:any)/(:any)'] = 'member/view_profil/$1/$2';

//$route['liste/membres'] = 'member/member_list';
//$route['selection/ami'] = 'member/select_friend/';
$route['liste/amis'] = 'member/list_friends/';
$route['liste/amis/(:any)'] = 'member/list_friends/$1';
//$route['ami/selected'] = 'member/selected_friend/';
//$route['ajouter/ami'] = 'member/add_friend/';
//$route['ajouter/ami/(:any)/(:any)'] = 'member/add_friend/$1/$2';
//$route['supprimer/ami/(:any)/(:any)'] = 'member/del_friend/$1/$2';
//$route['supprimer/ami/(:any)'] = 'member/del_friend/$1';
//-------------------------------------------- messagerie interne ---------------------------------
$route['boite/messagerie/(:any)'] = 'member/inbox/$1';
$route['voir/messages'] = 'messagerie/view_inbox';





$route['reply/pm/(:any)/(:any)'] = 'member/repondre/$1/$2';
$route['reply/pm/(:any)/(:any)/(:any)'] = 'member/repondre/$1/$2/$3';

//------------------------------------ reglement --------------------------------------------------
$route['regles/website'] = 'rules/index';

