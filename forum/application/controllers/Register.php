<?php
/**
* fabb An open source application developed within codeigniter framework
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
* along with this program.  If not, see https:
*
* The GNU General Public License does not permit incorporating your program
* into proprietary programs.  If your program is a subroutine library, you
* may consider it more useful to permit linking proprietary applications with
* the library.  If this is what you want to do, use the GNU Lesser General
* Public License instead of this License.  But first, please read
* https:
*
* @see commercial  use doc/commercial.txt
* @package	Fabb  application web community
* @author	faci abdelhafid <admin@forum-fabb.com>
* @subpackage Controllers
* @copyright	Copyright (c) 2018 - 2020, fabb <https://www.forum-fabb.com>
* @link	<https://www.forum-fabb.com>
* @since	Version 1.7.19
* @filesource
*/
defined('BASEPATH') OR exit('No direct script access allowed');
defined ('FABB') OR exit("read the installation instructions carefully OR re-install fabb");
/**
* class extends Controller Class
*
* @package		fabb
* @author		faci abdelhafid
* @link		<https://www.forum-fabb.com/>
*/
class Register extends CI_Controller {
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
* @var int $nbr_msg reference to active session member inbox msg
*/
public $nbr_msg;
/**
* @var string $msg reference to any msg for active session member
*/
public $msg;
/**
* @var string $status reference to active session state member
*/
public $status;
/**
* @var string $ip reference to active session ip member
*/
public $ip;
/**
* @var string $bann reference to banned member
*/
public $bann;
/**
* __construct
*
* @return mixed
*/
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url','captcha','security'));
		$this->load->model(array('forum_model','poster_model','config_model','msgs_model'));
		$this->load->library(array('pagination','encryption','alert'));
		$this->lvl = $this->session->has_userdata('lvl')?$this->session->lvl:1;
		$this->pseudo = $this->session->has_userdata('pseudo')?$this->session->pseudo:'';
		$this->email = $this->session->has_userdata('email')?$this->session->email:'';
		$this->avatar = $this->session->has_userdata('avatar')?$this->session->avatar:'';
		$this->idM = $this->session->has_userdata('idM')?$this->session->idM:0;
		$this->msg = $this->session->has_userdata('msg')?$this->session->msg:NULL;
		$this->nbr_msg = $this->session->has_userdata('nbr_msg')?$this->session->nbr_msg:0;
		$this->status = $this->session->has_userdata('status')?$this->session->status:VISITOR;
		$this->bann = $this->session->has_userdata('bann')?$this->session->bann:BANNED;
		if(!$this->input->ip_address()){exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception'));}
		$this->ip= $this->session->has_userdata('ip')?$this->session->ip:$this->input->ip_address();
		if($this->bann){show_error(ERR_BANN, 403,$heading = 'Nous Avons Rencontré Une Exception');}
		if($this->forum_model->bad_bot($this->ip)==true){exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons
		Rencontré Une Exception'));}
		if($this->member_model->is_online($this->ip)>0){
		$this->member_model->update_online($this->ip);
		}
		else {
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
		//last topic
		//add last post
		// last member
		// last annonce
	}
	/**
	 * index
	 *
	 * @return void
	 */
	public function index() {
		$this->inscription();
	}
	/**
	 * inscription
	 *
	 * @return void
	 */
	public function inscription(){
		$this->_check_flood('register');
		$data['render']='';
		$data['start_time']=microtime(true);
		$data['menu']=menu($this->_menu());
		$data['action']='register/inscription';
		$this->load->model('title_page_model');
		$this->title_page_model->title_forum_index();
		$data['pic']= $this->top_pic();
		switch($this->status){
		case BANNED:
		$this->alert->set('alert-danger','1- Pour l\'instant, vous &ecirc;tes banni. Si vous
		jugez que c\'est une erreur de notre part, veuillez contacter l\'administrateur :<br>
		'.safe_mailto($this->config_model->admin_contact(),' nous-contacter ','class="btn btn-success btn-xs"').br(2));
		$data['render']='infos_action';
		$data['title']='register';
		$data['keyword']='register';
		$data['description']='register';
		$this->infos($data);
		break;
		case DELETED:
		$this->alert->set('alert-danger','1- Vous avez déjà procéder à la suppression de votre compte.<br>
		vous pouvez vous enregistez de nouveau à condition d\'utiliser une adresse email déférente de celle
		que vous avez renseigné dans votre précédent compte.
		');
		$data['render']='infos_action';
		$data['title']='register';
		$data['keyword']='register';
		$data['description']='register';
		$this->infos($data);
		break;
		case PENDING:
		$this->alert->set('alert-danger','1- Veuillez confirmer votre adresse e-mail : '.$this->email.'<br>
		2- Tant que vous n\'avez pas confirmé votre adresse email votre compte ne peut &ecirc;tre activé.<br>
		3- Si vous n\'avez pas re&ccedil;u de message de confirmation, veuillez cliquer sur le lien juste au-dessous: <br>
		autre message. Pour recevoir un autre message de confirmation.'.br(2).'
		<a class="btn btn-primary btn-xs" href="'.base_url().'">Aller Page Home</a> |
		<a class="btn btn-primary btn-xs" href="'.base_url('forum').'">Aller Page Forum</a> |
		<a class="btn btn-primary btn-xs" href="'.base_url('member/reconfirm').'">Autre Méssage</a>
		');
		$data['render']='infos_action';
		$data['title']='register';
		$data['keyword']='register';
		$data['description']='register';
		$this->infos($data);
		break;
		case MEMBER:
		if($this->agent->referrer()){
		$back=$this->agent->referrer();
		}else{$back=base_url('forum');}
		$this->alert->set('alert-warning','Vous &ecirc;tes déjà connecté. Cette action n\'est pas necessaire.'.br(2).'
		<a class="btn btn-success btn-sm" href="'.$back.'">Retour</a>'
		,FALSE);
		$data['title']='register';
		$data['keyword']='register';
		$data['description']='register';
		$this->infos($data);
		break;
		case MODO:
		if($this->agent->referrer()){
		$back=$this->agent->referrer();
		}else{$back=base_url();}
		$this->alert->set('alert-danger','Mais voyons chère(e) modérateur(ce) '.$this->pseudo.'?'.br(1).'
		Vous &ecirc;tes déjà connecté. Cette action n\'est pas necessaire.'.br(2).'
		<a class="btn btn-success btn-sm" href="'.$back.'">Retour</a>',FALSE);
		$data['title']='register';
		$data['keyword']='register';
		$data['description']='register';
		$this->infos($data);
		break;
		case ADMIN:
		$this->alert->set('alert-danger','Mais voyons chere(e) administrateur?'.br(1).'
		Vous &ecirc;tes déjà connecté. Cette action n\'est pas necessaire.<br>',FALSE);
		$data['title']='register';
		$data['keyword']='register';
		$data['description']='register';
		$this->infos($data);
		break;
		default:
		$ses_captcha=$this->session->userdata('captchaWord');
		$userCaptcha = $this->input->post('captcha');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pseudo', 'Pseudo',
		'required|alpha_dash|trim|min_length[3]|max_length[32]|is_unique[fabb_members.member_pseudo]|is_unique[fabb_pseudos.pseudo_value]');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|max_length[16]|min_length[6]');
		$this->form_validation->set_rules('conf_psw', 'Confirmer MP', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Addresse email', 'required|valid_email|is_unique[fabb_members.member_email]');
		if (strcmp($userCaptcha, $ses_captcha)!=0)
		{
		$this->form_validation->set_rules('captcha', 'Code securité', 'required|callback_checkAntibot');
		}
		if ($this->form_validation->run() == FALSE)
		{
		$image = $this->generateCaptcha();
		$this->session->set_userdata('captchaWord', $image['word']);
		$data['title']='register';
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('users/signup',$image);
		$this->load->view('inc/footer',$data);
		}
		else
		{
		$array=array('flood_ip'=>$this->ip,
		'flood_time'=>time(),
		'flood_idm'=>$this->idM,
		'flood_act'=>'register'
		 );
		$query=$this->msgs_model->time_flood($this->idM,'register');
		if($query->num_rows()>0){
		$this->msgs_model->update_flood($this->idM,'register');
		}
		else {$this->msgs_model->insert_flood($array);
		}
		$data['key']=sha1(microtime());
		$data['pseudo']=$this->input->post('pseudo');
		$array=array(
		'member_pseudo'=>$this->input->post('pseudo'),
		'member_mdp'=>hash('sha512',$this->input->post('password')),
		'member_email'=>strtolower(trim($this->input->post('email'))),
		'member_level'=>'3',
		'member_signature'=>'',
		'member_name'=>'',
		'member_forname'=>'',
		'member_age'=>'',
		'member_gender'=>'undefined',
		'member_avatar'=>'aghnostos.png',
		'member_location'=>'',
		'member_registred'=>time(),
		'member_last_visit'=>time(),
		'member_post'=>0,
		'member_ip'=>getip($this->input->ip_address()),
		'member_key'=>$data['key'],
		'member_notify'=>'1'
		);
		$this->session->unset_userdata('captchaWord');
		$last_id=$this->member_model->add_users($array);
		$data['ip']=$array['member_ip'];
		$to=$array['member_email'];
		$sujet = 'validation d\'inscription';
		$content=nl2br('
		<p class="text-justify">Bonjour et bienvenue '.$array['member_pseudo'].'</p>
		<p> vous venez de vous inscrire sur le site forum-fabb.com le'.date('d-m-Y').' à'.date('H-i-s').'
		Cette inscription est effectuée depuis L\'adresse IP :'.$data['ip'].' <br/>
		Si vous n\'etes pas à l\'origine de cette inscription sur le site ou une personne tierce a abusé de votre identité ou ce message vous est arrivé par erreur veuillez l\'ignorer  SVP.<br/>
		Si non, pour confirmer votre inscription et activer votre compte, veuillez cliquez sur le lien ci-dessous.<br/>
		<a class="btn btn-primary btn-sm" href="'.base_url('valid/email/'.$data['key']).'"> Oui, confirmer mon inscription</a><br/>
		Nous vous demandons cette opération  pour nous prévenir du spam et des abus .<br/>
		NB: Si le lien ci dessus n\'est pas fonctionnel, veuillez copier/coller dans la barre d\'adresse de votre navigateur le lien suivant pour valider votre compte manuellement :
		'.base_url('valid/email/'.$data['key']).' <br/>
		Cordialement le Webmaster </p>
		');
		$this->load->model('smtp_model');
		$this->load->library('phpmailer_lib');
		$mail = $this->phpmailer_lib->load();
		if($this->smtp_model->active()==true){
		$mail->isSMTP();
		$mail->Host     = $this->smtp_model->hostsmtp();
		$mail->SMTPAuth = true;
		$mail->Username = $this->smtp_model->usersmtp();
		$mail->Password = $this->smtp_model->pswsmtp();
		$mail->SMTPSecure = $this->smtp_model->cryptsmtp();
		$mail->Port     = $this->smtp_model->portsmtp();
		}
		$mail->setFrom($this->config_model->admin_contact(),$this->config_model->title_forum());
		$mail->addReplyTo($this->config_model->admin_contact(),'No-reply');
		$mail->AddAddress($to);
		$mail->Subject =$sujet;
		$mail->isHTML(true);
		$this->load->add_package_path(APPPATH.'third_party/resources', FALSE);
		$htmlBody=$this->load->view('htmlHeader',$data,true);
		$htmlBody.=$this->load->view('register',$data,true);
		$htmlBody.=$this->load->view('htmlFooter',$data,true);
		$this->load->remove_package_path(APPPATH.'third_party/resources');
		$mail->Body = $htmlBody;
		$mail->CharSet = 'UTF-8';
		$mail->AltBody =$content;
		if($mail->send())
		{
		// et un p'tit msg pour admin
		$query=dataVisitor($this->input->ip_address());
		$country=$query['country'];
		$city=$query['city'];
		$header="MIME-Version: 1.0\r\n";
		$header.= "Content-type: text/html; charset=utf-8\r\n";
		$header.= "To: Admin <".$this->config_model->admin_contact().">\r\n";
		$header.="From: Your forum <".$this->config_model->admin_contact().">\r\n";
		$header.="\r\n";
		$text='
		<h4>Nouvelle inscription</h4>
		<p>
		Une nouvelle inscription vient d\'&ecirc;tre enregistrée sur le forum.<br>
		Pseudo:: '.ucfirst($array['member_pseudo']).'<br>
		Email:: '.$array['member_email'].'<br>
		Ip:: '.$array['member_ip'].'<br>
		Date:: '.date('d-m-Y').' à '.date('H:i:s').'<br>
		Pays:: '.$country.'<br>
		Ville:: '.$city.'<br>
		</p>
		';
		mail($this->config_model->admin_contact(),'nouvelle inscription',$text,$header);
		$this->alert->set('alert-success','<p>Félicitation '.ucfirst($array['member_pseudo']).'<br>
		votre enregistrement sur le site '.$this->config_model->website_title().' s\'est deroulé correctement.<br>
		Ce pendant votre compte reste inactif, pour l\'activer veuillez cliquez sur le lien d\'activation que vous trouverez dans le message envoyé à '.$array['member_email'].'<br>
		NB: Vous avez le droit de rectifier vos informations à tout moment en se rendant sur la page "U-Panel" une fois votre compte est activé. </p>
		<p>
		<a clas="btn btn-success btn-sm" href="'.base_url('home').'"> Page accueil</a> |
		<a clas="btn btn-success btn-sm" href="'.base_url('forum').'"> Page forum</a>
		</p>',TRUE);
		$data['pic']=$this->top_pic();
		$data['render']='infos';
		$this->display($data);
		}
		else
		{
		$this->alert->set('alert-danger','Apparemment, le message envoyé à '.$this->input->post('to').' a échoué.<br>
		<a class="btn btn-success btn-sm" href="'.base_url('admin/index/'.$this->idM).'"> Retour Admin </a> |
		<a class="btn btn-success btn-sm" href="'.base_url('forum').'"> Forum </a>');
		$data['render']='infos';
		$data['pic']=$this->top_pic();
		$this->display($data);
		}
		}
		}
	}

	/**
	 * _check_flood
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
	 * generateCaptcha
	 *
	 * @return void
	 */
	public function generateCaptcha(){
		$vals = array(
		'img_path' => './assets/cap/',
		'img_url' => base_url('assets/cap/'),
		'img_width'   => 150,
		'img_height'  => 30,
		'expiration'  => 1800,
		'word_length' => 6,
		'font_size'	  => 16,
		'font_path'	  => './assets/cap/font/times.ttf',
		'pool'        => '23456789+abcdefghjkmnpqrstuvwxyz*ABCDEFGHJKL#MNPQRSTUVWXYZ',
		'colors'      => array(
			'background' => array(0, 51, 153),
			'border'     => array(0, 0, 0),
			'text'       => array(255, 255, 255),
			'grid'       => array(204,153,0)
			)
		);
		/* Generate the captcha */
		return create_captcha($vals);
	}

	/**
	 * checkAntibot
	 *
	 * @param  mixed $userCaptcha
	 * @param  mixed $ses_captcha
	 * @return void
	 */
	public function checkAntibot($userCaptcha, $ses_captcha){
		if (strcmp($userCaptcha, $ses_captcha)!=0)
		{
		$this->form_validation->set_message('checkAntibot', '<span style=" font-size:11px;color:red;">Le code de verification est invalide</span>');
		return FALSE;
		}
		else
		{
		return TRUE;
		}
	}	
	/**
	 * _menu
	 *
	 * @return void
	 */
	protected function _menu(){
		$this->load->config('glyph');
		$tpid=$this->member_model->total_post_idm($this->idM);
		$ttid=$this->member_model->total_topic_idm($this->idM);
		$array=array('lvl'=> $this->lvl,
		'msg'=> $this->msg,
		'nbr_msg'=> $this->nbr_msg,
		'blink'=>'register',
		'avatar'=> $this->avatar,
		'pseudo'=> $this->pseudo,
		'email'=> $this->email,
		'idM'=>$this->idM,
		'status'=> $this->status	,
		'tpid'=>$tpid,
		'ttid'=>$ttid,
		 'sign-white'=>$this->config->item('sign-white'),			 
		 'home'=>$this->config->item('home'),
		 'userplus-white'=>$this->config->item('userplus-white'),
		 'userplus-blue'=>$this->config->item('userplus-blue'),
		);
		return $array;
	}

	/**
	 * top_pic
	 *
	 * @return void
	 */
	public function top_pic(){
		$this->load->model('admin_model');
		$photo=$this->admin_model->get_pics();
		foreach($photo->result() as $pic):
		$data['pic']=$pic->pic_file;
		endforeach;
		return $data['pic'];
	}

	/**
	 * infos
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
	
	/**
	 * display
	 *
	 * @param  mixed $data
	 * @return void
	 */
	public function display($data){
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('register/index',$data);
		$this->load->view('inc/footer',$data);
	}
}
