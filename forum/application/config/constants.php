<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
//---------------------------------------------------------------------------------------------------------------
//custom constants
defined('ERR_HACK') OR define('ERR_HACK','<span style="color:red">On n\'a pas du tout envie de traiter avec les personnes mal-intentionnées ou encore avec les robots.</span>');
defined('ERR_AUTH') OR define('ERR_AUTH','<span style="color:red">On a pas pu vous édentifier, veuillez utiliser les liens du menu pour consulter cette page.</span>');
defined('ERR_AUTH_ADMIN')     OR define('ERR_AUTH_ADMIN','<span style="color:red"></span>Vous devez etre un admin pour acceder à cette page</span>');
defined('ERR_AUTH_MODO')     OR define('ERR_AUTH_MODO','<span style="color:red"></span>Vous devez &ecirc;tre un modérateur pour acceder à cette page</span>');
defined('ERR_IS_CONNECTED')   OR define('ERR_IS_CONNECTED','<span style="color:red">Cette action n\'est pas necessaire, vous etes déjà connecté(e).</span>');
defined('ERR_NOT_CONNECTED')   OR define('ERR_NOT_CONNECTED','<span style="color:red">Vous devez &ecirc;tre connecté, ou vous n\' &ecirc;tes pas autorisé(e) à acceder à cette page.</span>');
defined('ERR_IS_CONNEXION')   OR define('ERR_IS_CONNEXION','<span style="color:red">L\'addresse email ou le mot de passe est invalide, veuillez ressayer SVP....!</span>');
defined('ERR_WRONG_USER')     OR define('ERR_WRONG_USER','<span style="color:red">Erreur dans l\'identification du destinataire du message</span>');
defined('ERR_WRONG_KEY')     OR define('ERR_WRONG_KEY','<span style="color:red">Erreur dans l\'identification de la clé.</span>');

defined('ERR_AUTH_EDIT')     OR define('ERR_AUTH_EDIT','<span style="color:red">Erreur de moderation, vous ne pouvez pas mederer ce post</span>');
defined('POST_NOT_EXISTS')     OR define('POST_NOT_EXISTS','<span style="color:red">Le post que vous essayez d\'éditer n\'éxiste pas</span>');
defined('ERR_AUTH_DELETE_TOPIC')     OR define('ERR_AUTH_DELETE_TOPIC','<span style="color:red">Ce post est le sujet autour duquel est ouverte la discussion actuellement. <br>Vous devez &ecirc;tre un moderateur pour supprimer ce post. <br>Si vous insistez sur la suppression de ce topic veuillez contacter l\'administrateur en utilisant la page contact.</span>');
defined('ERR_AUTH_DELETE')     OR define('ERR_AUTH_DELETE','<span style="color:red">Vous devez etre un moderateur pour suprimer ce post</span>');
defined('ERR_AUTH_VERR')     OR define('ERR_AUTH_VERR','<span style="color:red">Vous devez etre un moderateur ou le createur du post pour verouiller ou deverouiller ce topic.</span>');

defined('ERR_TOPIC_VERR')     OR define('ERR_TOPIC_VERR','<span style="color:red">Ce sujet est verouillé, si vous etes le createur du sujet veuillez contacter un moderateur en utilisant la page contact.<br> Merci pour votre comprehention.</span>');
defined('ERR_AUTH_MOVE')     OR define('ERR_AUTH_MOVE','<span style="color:red">Vous devez etre un moderateur pour deplacer ce topic.<br></span>');
defined('ERR_FLOOD')     OR define('ERR_FLOOD','<span style="color:red">Requettes répétitives. Cette action n\'est pas autorisée sur le forum. veuillez attendre quelques secondes puis re-essayez svp...!.</span>');
defined('ERR_SESSION')     OR define('ERR_SESSION','<span style="color:red">Votre session a expirée, veuillez vous re-connecter ultérieurement.</span>');
defined('ERR_MALIN')     OR define('ERR_MALIN','<span style="color:red">ATTENTION : action non autorisée sur le site, vous risquez de supprimer votre compte.</span>');
defined('ERR_BANN')     OR define('ERR_BANN','<span style="color:red">IMPORTANT: Votre compte a été banni. Si vous juger autrement, veuillez contacter le webmaster.</span>');
defined('ERR_RIGHT')     OR define('ERR_RIGHT','<span style="color:red">IMPORTANT: Votre statut ne vous permet pas de laisser un témoignage ou de participer dans cette discussion.</span>');
defined('ERR_ACCESS')     OR define('ERR_ACCESS','<span style="color:red"><strong>IMPORTANT ::</strong> Votre statut ne vous permet pas d\'acceder à cette page.</span>');
defined('ERR_NO_CONTENT')     OR define('ERR_NO_CONTENT','<span style="color:red"><strong>IMPORTANT ::</strong> Cette page ne contient aucun contenu. Veuillez utiliser les liens du menu.</span>');


defined('BANNED')     OR define('BANNED',0);
defined('VISITOR')     OR define('VISITOR',1);
defined('DELETED')     OR define('DELETED',2);
defined('PENDING')     OR define('PENDING',3);
defined('MEMBER')     OR define('MEMBER',4);
defined('MODO')     OR define('MODO',5);
defined('ADMIN')     OR define('ADMIN',6);
