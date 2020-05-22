<?php
/**
 * fabb is an open source application developed within codeigniter framework
 *
 * This content is released under the GNU General Public License version 3
 *
 * Copyright (c) 2018 - 2020, faci abdelhafid bulletin board :: fabb
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see https://www.gnu.org/licenses/
 *
 * The GNU General Public License does not permit incorporating your program
 * into proprietary programs.  If your program is a subroutine library, you
 * may consider it more useful to permit linking proprietary applications with
 * the library.  If this is what you want to do, use the GNU Lesser General
 * Public License instead of this License.  But first, please read
 * https://www.gnu.org/licenses/why-not-lgpl.html
 *
 * @see commercial  use doc/commercial.txt
 * @package	Fabb  application web community
 * @author	faci abdelhafid <admin@forum-fabb.com>
 * @subpackage Controllers
 * @copyright	Copyright (c) 2018 - 2020, fabb <https://www.forum-fabb.com/>
 * @link	<https://forum-fabb.com/contact>
 * @since	Version 1.7.19
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
defined ('FABB') OR exit("read the installation instructions carefully OR re-install fabb");
	/**
	 * Contact class make contact to fabb
	 */
class Contact extends CI_Controller {
	/**
	* @var string $lvl reference to active session member level
	 */
	 public $lvl;
	/**
	 * @var string $pseudo reference to active session member pseudo
	 */
	 public $pseudo;
	/**
	 * @var string  $email reference to active session member email
	 */
	 public $email;
	 /**
	 * @var string reference to active session member avatar
	 */
	 public $avatar;
	 /**
	 * @var int $idM reference to active session member identification
	 */
	 public $idM;
	 /**
	 * @var string $msg reference to active session member message
	 */
	 public $msg;
	 /**
	 * @var int $nbr_msg reference to active session member number msg
	 */
	 public $nbr_msg;
	/**
	 * @var string $status reference to active session state member
	 */
	public $status;
	/**
	 * @var string $ip reference to active session ip member
	 */
	public $ip;
/**
 * __construct initianize the class
 *
 * @return void
 */
function __construct() {
	parent::__construct();
	$this->load->helper(array('form','url'));
	$this->load->model(array('contact_model','forum_model','config_model','msgs_model'));
	$this->load->library(array('form_validation','user_agent','encryption','alert'));
	$this->lvl = $this->session->has_userdata('lvl')?(int)$this->session->lvl:1;
	$this->pseudo = $this->session->has_userdata('pseudo')?$this->session->pseudo:'';
	$this->email = $this->session->has_userdata('email')?$this->session->email:'';
	$this->avatar = $this->session->has_userdata('avatar')?$this->session->avatar:'';
	$this->idM = $this->session->has_userdata('idM')?(int)$this->session->idM:0;
	$this->msg = $this->session->has_userdata('msg')?$this->session->msg:NULL;
	$this->nbr_msg = $this->session->has_userdata('nbr_msg')?$this->session->nbr_msg:0;
	$this->status = $this->session->has_userdata('status')?$this->session->status:VISITOR;
	if(!$this->input->ip_address()){exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception'));}
	$this->ip=$this->session->has_userdata('ip')?$this->session->ip:$this->input->ip_address();
    if($this->forum_model->bad_bot($this->input->ip_address())==true){
    exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception'));}
	if($this->member_model->is_online($this->ip)>0){
	$this->member_model->update_online($this->idM,$this->ip);
	}else{
	$query=dataVisitor($this->ip);
	$country=$query['country'];
	$code=$query['countryCode'];
	$city=$query['city'];
		$platform=$this->agent->platform();
		if ($this->agent->is_browser())
		{
		$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
		$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
		$agent = $this->agent->mobile();
		}
		else
		{
		$agent = 'Unidentified';
		}
	    $array=array('online_id'=>$this->idM,
					 'online_time'=>time(),
					 'online_ip'=>$this->ip,
					 'online_country'=>$country,
					 'online_code'=>$code,
					 'online_city'=>$city,
					 'online_platform'=>$platform,
					 'online_browser'=>$agent
					);
	    $this->member_model->insert_online($array);
	    }
	if(auth_access($this->status,PENDING))
	{
	  $this->load->model('msgs_model');
	  $query=$this->msgs_model->unread_msg($this->idM);
	  $this->session->set_userdata('nbr_msg',$query);
	}
	if(auth_equal($this->status,VISITOR))
	{
redirect('login');
	}
	//add last post
	// last member
	// last annonce
}	
	/**
	 * _menu display menu
	 *
	 * @return void
	 */
	protected function _menu(){
			  $tpid=$this->member_model->total_post_idm($this->idM);
		      $ttid=$this->member_model->total_topic_idm($this->idM);
			  $array=array(
		     'lvl'=> $this->lvl,
		     'blink'=> 'panel',
		     'msg'=> $this->msg,
		     'nbr_msg'=> $this->nbr_msg,
		     'avatar'=> $this->avatar,
		     'pseudo'=> $this->pseudo,
		     'email'=> $this->email,
			 'idM'=>$this->idM,
			 'status'=> $this->status,
			 'tpid'=>$tpid,
			 'ttid'=>$ttid,
		);
		return $array;
		}
/**
 * display display all data
 *
 * @param  mixed $data
 * @return void
 */
public function display($data){
			 	$this->load->view('inc/header',$data);
				$this->load->view('inc/topPage',$data);
			    $this->load->view('inc/navBar',$data);
			    $this->load->view('member/index',$data);
			    $this->load->view('inc/footer', $data);
	}
/**
 * top_pic display img forum
 *
 * @return void
 */
public function top_pic(){
	$this->load->model('admin_model');
	  $photo=$this->admin_model->get_pics();
	  foreach($photo->result() as $row):
	  return $row->pic_file;
	  endforeach;
	}
/**
 * report_msg add any msg
 *
 * @return void
 */
public function report_msg(){
	$data['start_time']=microtime(true);
	$data['menu']=menu($this->_menu());
			 $data['pic']=$this->top_pic();
		  $this->form_validation->set_rules('object', 'Objet :','required|trim|min_length[3]|max_length[256]');
		  $this->form_validation->set_rules('msg', 'Message :','required|min_length[3]|max_length[3000]');
			 if ($this->form_validation->run() == FALSE)
                {
				 		$this->load->view('inc/header');
						$this->load->view('inc/topPage',$data);
		                $this->load->view('inc/navBar',$data);
				        $this->load->view('member/probleme');
				        $this->load->view('inc/footer');
			     }
			   else{
				   $email_sender=$this->email;
				   $pseudo=$this->pseudo;
				   $object=$this->input->post('object');
				   $content=$this->input->post('msg');
				   $sender=$this->idM;
				   $array=array('contact_idm'=>$this->idM,
				               'contact_object'=>$object,
							   'contact_text'=>$content,
							   'contact_date'=>time(),
							   'contact_read'=>0,
				   );
						 $new_msg=$this->contact_model->insert_new_msg($array);
						 if($new_msg!=NULL){
					$this->alert->set('alert-success','<p>Votre message a été envoyé correctement.<br>
Merci <strong style="color:green">'.$this->pseudo.'</strong> de nous avoir contacté, vous receverez une réponse dans les plus bref délais possibles.'.br(2).'
			<a class="btn btn-success btn-sm" href="'.base_url('member/index'.$this->idM).'"> U-Panel</a> |
			<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a> |
			<a class="btn btn-success btn-sm" href="'.base_url('contact').'">Autre méssage</a> '
			,TRUE);
				 		$this->load->view('inc/header',$data);
						$this->load->view('inc/topPage',$data);
		                $this->load->view('inc/navBar',$data);
				        $this->load->view('member/infos',$data);
				        $this->load->view('inc/footer',$data);
					}
					else{
					$this->alert->set('alert-danger','<p>Un problème s\'est produit lors de l\'envoi de votre message.<br/>
veuillez réssayer ultérieurement et nous vous demandons de bien vouloir nous execuser de cette défaillance technique que nous ne pouvons pas prévoir.<br/></p>',TRUE);
				 		$this->load->view('inc/header',$data);
						$this->load->view('inc/topPage',$data);
		                $this->load->view('inc/navBar',$data);
				        $this->load->view('member/infos',$data);
				        $this->load->view('inc/footer',$data);
			   }
			   }
}
/**
 * reactivate reactivate the member account
 *
 * @return void
 */
public function reactivate(){
	$this->_check_flood('re-activate');
	$key=sha1(microtime());
	$data['menu']=menu($this->_menu());
		 $data['action'] = 'contact/reactivate';
	  $this->load->model('title_page_model');
	  $this->title_page_model->title_forum_index();
	  $photo=$this->admin_model->get_pics();
	  foreach($photo->result() as $pic):
	  $data['pic']=$pic->pic_file;
	  endforeach;
		 $this->load->library('form_validation');
		 $this->form_validation->set_rules('field', 'Adresse Email ','trim|valid_email|required');
        $this->form_validation->set_rules('password', 'Mot de passe','required');
		if($this->form_validation->run()==FALSE)
                {
				$this->load->view('inc/header',$data);
				$this->load->view('inc/topPage',$data);
			    $this->load->view('inc/navBar',$data);
			    $this->load->view('users/user_connexion',$data);
			    $this->load->view('inc/footer',$data);
                }
                else
				 {
			  $field=trim(strtolower($this->input->post('field')));
			  $psw=hash('sha512',($this->input->post('password')));
			  $query=$this->member_model->check_login($psw,$field);
			  if($query->num_rows()==0)
			  {
					$this->alert->set('alert-danger','Votre connexion a echoué, veuillez vérifier vos identifiants.'.br(4).'
					<a class="btn btn-primary btn-sm" href="'.base_url().'">Aller Page Home</a> |
					<a class="btn btn-primary btn-sm" href="'.base_url('forum').'">Aller Page Forum</a> |
					<a class="btn btn-primary btn-sm" href="'.base_url('contact/reactivate').'">Ressayer</a>',false);
					$this->infos($data);
			  }
		  else{
					foreach($query->result() as $row)
					{
						  $pseudo= $row->member_pseudo;
						  $email=$row->member_email;
						  $avatar=$row->member_avatar;
						  $lvl=$row->member_level;
						  $id=$row->member_id;
					}
				     $array=array('ip'=>$this->ip,
								   'time'=>time(),
								   'id'=> $id,
								   'lvl'=> PENDING,
								   'key'=>$key
								   );
			       $activate=$this->member_model->reactivate_member($array);
				    if($activate>0){
						$act='re-activate';
				    $array=array('flood_ip'=>$this->ip,
				                'flood_time'=>time(),
								'flood_idm'=>$this->idM,
								'flood_act'=>$act
					             );
				  $query=$this->msgs_model->time_flood($this->idM,$act);
				  if($query->num_rows()>0){
					  $this->msgs_model->update_flood($this->idM,$act);
					  }
					  else {$this->msgs_model->insert_flood($array);}
					   $msg='';
					        $mail=explode('@',$row->member_email);
                            $dns=explode('.',$mail[1]);
                            switch ( $dns[0]){
	                           case 'google':
				                    $msg.= '<input type="button" class="btn-success" value="Activer maintenant"
									onclick="self.location=\'https://accounts.google.com/ServiceLogin?hl=fr&continue=http://www.google.fr/%23q%3Dgoogle.gmail%26hl%3Dfr%26biw%3D1280%26bih%3D744\'"/>
	 ';
	                          break;
	                          case 'yahoo':
		                          $msg.='
                                     <input type="button" class="btn-success" value="Activer maintenant" onclick="window.location=\'https://login.yahoo.com/config/mail?&.src=ym&.intl=fr\'"/>
';
		                        break;
		                             case 'msn':
				                          $msg.= '
		                              <input type="button" class="btn-success"
									  value="Activer maintenant" onclick="window.location=\'https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=11&ct=1378244191&rver=6.1.6195.0&wp=MBI_SSL&wreply=https:%2F%2Flogin.secure.emea.msn.com%2Fwlsignin.aspx%3Fru%3Dhttp%253a%252f%252ffr.msn.com%252f&lc=1036&id=1184\'"/>';
		                               break;
		                             default:
                                     $mail=explode('@',$row->member_email);
		                             $msg.= '
<input type="button"class="btn btn-success btn-xs" value="Activer maintenant" onclick="window.location=\'http://www.'.$mail[1].'\'"/>';
}
		            $this->member_model->update_last_visite($id);
	$date=date('d - m - Y');
	$heure=date('H-i-s');
	$destinataire=$email;
	$sujet = 'validation d\'inscription';
	$message= "
<!doctype html>
<html>
<head>
<meta charset=\"utf-8\">
<title>confirmation d'inscription</title>
<style type=\"text/css\">
body{ width:72%;margin-left:auto; margin-right:auto;
font-family:Arial, Helvetica, sans-serif;
font-size:1em;
text-align:justify;
line-height:2em;
}
</style>
</head>
<body>
<p>Message de confirmation.</p>
<p>Bienvenue ".$pseudo."
Vous ou une personne tierce a procédé le ".$date." à ".$heure." à la reactivation de votre compte sur ".$this->config_model->website_title().". <br>
Si vous n'&ecirc;tes pas à l'origine de cette action, veuillez ignorer cet email.<br>
Sinon, veuillez cliquer ci-dessous sur confirmer mon email.<br>
<a href=\"".base_url('valid/email/'.$key)."\">Oui, confirmer mon email</a><br>
si le lien n'est pas fonctionnel, copier/coller le lien ci-dessous dans la barre d'adresse de votre navigateur et valider.<br>
	  ".base_url('valid/email/'.$key)." <br/>
				  Cordialement le Webmaster
	   </body>
</html>
";
	 $headers="MIME-Version: 1.0\r\n";
	 $headers  .= "Content-type: text/html; charset=utf-8\r\n";
	 $headers .= "To: $pseudo <$email>\r\n";
	 $headers.="From: <".$this->config_model->admin_contact().">\r\n";
	  $headers .="\r\n";
   mail($email, $sujet, $message, $headers);
					  $this->alert->set('alert-success','Félicitation votre compte a été re-activé avec succès et
					  sans problème.'.br(1).'
					  Un méssage a été envoyer à :'.$field.nbs(2).'
					  Veuiller cliquer sur le lien contenu dans ce massage pour activer votre compte.
					  Nous somme très heureux de vous revoir de nouveau parmi nous.'.br(2).'
					   <a class="btn btn-success btn-sm" href="'.base_url('home').'">Home</a>&nbsp;&nbsp;
					   <a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a> ',FALSE);
					   $this->infos($data);
					return;
					  }
					  else{
					  $this->alert->set('alert-danger','Nous somme désolé, nous n\'avons pas pu réactiver votre compte
					   automatiquement.'.br(1).'
					  Ni aumoins, vous pouvez créer un nouveau compte en vous enregistrant de nouveau.'.br(1).'
					  Merci pour votre compréhension.'.br(2).'
					   <a class="btn btn-success btn-sm" href="'.base_url('home').'">Home</a> |
					   <a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a> |
					   <a class="btn btn-success btn-sm" href="'.base_url('register/inscription').'">S\'enregistrer</a> ',FALSE);
					   $this->infos($data);
					   return;
					      }
						   }
				}
	}        
        /**
         * _check_flood reload page is not allowed
         *
         * @param  mixed $act
         * @return void
         */
        protected function _check_flood($act){
		$timeflood=$this->config_model->flood();
            $query=$this->msgs_model->time_flood($this->idM,$act);
			if($query->num_rows()>0){
			foreach($query->result() as $value):
			$postime=$value->flood_time;
			endforeach;
			$flood=time()- $postime;
			if ($timeflood > $flood) {
				return(show_error(ERR_FLOOD, 403,$heading = 'Nous Avons Rencontré Une Exception'));
							 }
			}
		}
/**
 * infos display all data
 *
 * @param  mixed $data
 * @return void
 */
public function infos($data){
			 	$this->load->view('inc/header',$data);
				$this->load->view('inc/topPage',$data);
			    $this->load->view('inc/navBar',$data);
			    $this->load->view('users/infos',$data);
			    $this->load->view('inc/footer', $data);
	}

}
?>