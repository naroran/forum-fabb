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
class Users extends CI_Controller {
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
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','captcha','security','cookie'));
		$this->load->model(array('forum_model','poster_model','config_model','smtp_model'));
		$this->load->library(array('pagination','encryption','form_validation','alert'));
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
		if(auth_access($this->status,PENDING))
		{
		$this->load->model('msgs_model');
		$query=$this->msgs_model->unread_msg($this->idM);
		$this->nbr_msg=$query;
		}
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
		$this->connexion();
	}	
	/**
	 * connexion
	 *
	 * @return void
	 */
	public function connexion(){
		$data['start_time']=microtime(true);
		$data['menu']=menu($this->_menu());
		$data['action'] = 'login';
		$this->load->model('title_page_model');
		$this->title_page_model->title_forum_index();
		$data['pic']=$this->top_pic();
		if($this->status!=VISITOR){
		if($this->agent->referrer()==base_url('users/connexion')){
		$back=base_url('forum');
		}
		elseif($this->agent->referrer()!=base_url('users/connexion')){
		$back=$this->agent->referrer();
		}
		elseif(!$this->agent->referrer())
		{
		$back=base_url('forum');
		}
		$this->alert->set('alert-warning','Vous &ecirc;tes déjà connecté. Cette action n\'est pas necessaire.'.br(2).'
		<a class="btn btn-success btn-sm" href="'.$back.'">Retour</a>',FALSE);
		$data['title']='register';
		$this->infos($data);
		}
		else{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('field', 'Pseudo OR Adresse Email','trim|required');
		$this->form_validation->set_rules('password', 'Mot de passe','trim|required');
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
		$field=$this->input->post('field');
		$psw=hash('sha512',$this->input->post('password'));
		$query=$this->member_model->check_login($psw,$field);
		if($query->num_rows()==0){
		$this->load->library('alert');
		$this->alert->set('alert-danger','Votre connexion a echoué, veuillez vérifier vos identifiants.'.br(4).'
		<a class="btn btn-primary btn-xs" href="'.base_url().'">Aller Page Home</a> |
		<a class="btn btn-primary btn-xs" href="'.base_url('forum').'">Aller Page Forum</a> |
		<a class="btn btn-primary btn-xs" href="'.base_url('login').'">Ressayer</a>
		');
		$data['title']='connexion';
		$this->infos($data);
		}
		else{
		foreach($query->result() as $row){
		$pseudo= $row->member_pseudo;
		$email=$row->member_email;
		$lvl= $row->member_level;
		$id=$row->member_id;
		$avatar=$row->member_avatar;
		switch($lvl){
		case BANNED:
		$msg='';
		$session=array(
		'pseudo'=>$pseudo,
		'email'=>$email,
		'lvl'=>$lvl,
		'idM'=>$id,
		'avatar'=>$avatar,
		'nbr_msg'=>$msg,
		'status'=>BANNED,
		'ip'=>$this->input->ip_address()
		);
		$this->session->set_userdata($session);
		$this->member_model->update_last_visite($this->session->ip,$this->session->idM);
		exit(show_error(ERR_BANN, 403,$heading = 'Nous Avons Rencontré Une Exception'));
		break;
		case DELETED:
		$this->alert->set('alert-warning',
		'Causes possible d\'un compte supprimé:'.br(2).'
		1- Vous ou une personne tierce (co-compte) a déjà procédé à la suppression de
		votre compte.<br>
		2- Compte inactif depuis plus de 6 mois.<br>
		3- compte a fait l\'objet d\'aggression des reglements du forum.<br>
		<hr>
		Comment réactiver son compte?'.br(2).'
		1- Vous pouvez vous enregistrer avec un nouveau compte.<br>
		2- Vous pouvez re-activer votre compte.<br>
		Pour re-activer votre compte cliquez sur: Réactiver mon compte<br>
		Si l\'opération de réactivation automatique échoue, veuillez contacter l\'administrateur.'.br(2).'
		<a class="btn btn-primary btn-sm" href="'.base_url('home/index').'">Home</a> |
		<a class="btn btn-primary btn-sm" href="'.base_url('forum').'">Forum</a> |
		<a class="btn btn-primary btn-sm" href="'.base_url('contact/reactivate').'">Ré-activer Mon Compte</a> ',TRUE);
		$data['title']='connexion';
		$this->infos($data);
		break;
		case PENDING:
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
		$session=array(
		'ip'=>$this->input->ip_address(),
		'pseudo'=>$pseudo,
		'email'=>$email,
		'lvl'=>$lvl,
		'idM'=>$id,
		'avatar'=>$avatar,
		'msg'=>$msg,
		'status'=>PENDING);
		$this->session->set_userdata($session);
		$this->member_model->update_last_visite($this->session->ip,$this->session->idM);
		$this->load->library('alert');
		$this->alert->set('alert-danger','Bienvenue '.ucfirst($pseudo).', votre compte est actuellement
		en attente de confirmation de votre addresse email.<br>
		veuillez consulter votre boite et cliquez sur le lien de confirmation dans cet email.<br>
		Si vous n\'avez pas re&ccedil;u de message, vous pouvez toujours damander l\'envoi d\'un autre
		message.'.br(2).'
		<a class="btn btn-success btn-xs" href="'.base_url('logout').'">Quitter</a> |
		<a class="btn btn-success btn-xs" href="'.base_url('users/reconfirm').'">Autre Méssage</a>
		'.$msg.'',TRUE);
		$data['title']='connexion';
		$this->infos($data);
		break;
		case MEMBER:
		$this->load->model('msgs_model');
		$query=$this->msgs_model->unread_msg($id);
		$session=array(
		'pseudo'=>$pseudo,
		'email'=>$email,
		'lvl'=>$lvl,
		'idM'=>$id,
		'avatar'=>$avatar,
		'nbr_msg'=>$query,
		'status'=>MEMBER,
		'ip'=>$this->input->ip_address()
		);
		$this->session->set_userdata($session);
		$this->load->model('msgs_model');
		$query=$this->msgs_model->unread_msg($this->session->idM);
		$this->session->set_userdata('nbr_msg',$query);
		$this->member_model->update_last_visite($this->session->userdata('ip'),$this->session->userdata('idM'));
		redirect(base_url('member/index/'.$this->session->idM));
		break;
		case MODO:
		$this->load->model('msgs_model');
		$query=$this->msgs_model->unread_msg($id);
		$session=array(
		'pseudo'=>$pseudo,
		'email'=>$email,
		'lvl'=>$lvl,
		'idM'=>$id,
		'avatar'=>$avatar,
		'nbr_msg'=>$query,
		'status'=>MODO,
		'ip'=>$this->input->ip_address()
		);
		$this->session->set_userdata($session);
		$this->member_model->update_last_visite($this->session->ip,$this->session->idM);
		redirect(base_url('modo/index/'.$this->session->idM));
		break;
		case ADMIN:
		$this->load->model('msgs_model');
		$query=$this->msgs_model->unread_msg($id);
		$session=array(
		'pseudo'=>$pseudo,
		'email'=>$email,
		'lvl'=>$lvl,
		'idM'=>$id,
		'avatar'=>$avatar,
		'nbr_msg'=>$query,
		'status'=>ADMIN,
		'ip'=>$this->input->ip_address()
		);
		$this->session->set_userdata($session);
		$this->member_model->update_last_visite($this->session->userdata('ip'),$this->session->userdata('idM'));
		redirect(base_url('admin/index/'.$this->session->idM));
		break;
		}
		// end swich
		}//end else
		}
		}
		}
	}	
	/**
	 * check_login
	 *
	 * @param  mixed $password
	 * @param  mixed $field
	 * @return void
	 */
	public function check_login($password,$field){
		$psw=hash('sha512',(trim($password)));
		$query=$this->member_model->check_login($psw,strtolower($field));
		if($query->num_rows()==0){
		$this->form_validation->set_message('check_login', '<span style=" font-size:11px;color:red;">Mot de passe ou identifiant est invalide.</span>');
		return FALSE  ;
		}
		else{
		return TRUE;
		}
	}	
	/**
	 * reconfirm
	 *
	 * @return void
	 */
	public function reconfirm(){
		$data['key']=sha1(microtime());
		$message=nl2br('Salut '. $this->pseudo.'<br>
		Nous vous informons que votre compte sur le site <a href="'.base_url().'">'.$this->config_model->title_forum().'</a>  est toujours en attente de confirmation de votre adresse email.<br>
		Vous ou quelqu\'un autre a demandé l\'envoi d\'un message pour confirmer votre adresse email. Si vous &ecirc;tes à
		l\'origine de cette action veuillez cliquer sur le lien ci-dessous.<br>
		<a class="btn btn-primary btn-sm" href="'.base_url('valid/email/'.$data['key']).'">Oui confirmer mon inscription</a><br>
		NB: Si le lien ci-dessus n\'est pas fonctionnel, veuillez copier/coller dans la barre d\'adresse de votre
		navigateur le lien suivant et valider :<br>
		'.base_url('valid/email/'.$data['key']).'
		Cordialement le Webmaster  ');
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
		$mail->setFrom($this->config_model->admin_contact(),$this->config_model->raison());
		$mail->addReplyTo($this->config_model->admin_contact(),'No-reply');
		$data['date']=date('d - m - Y');
		$data['heure']=date('H-i-s');
		$data['pseudo']=$this->pseudo;
		$data['object'] = "Rappel de confirmation email";
		$mail->AddAddress($this->email);
		$mail->Subject = $data['object'];
		$mail->isHTML(true);
		$this->load->add_package_path(APPPATH.'third_party/resources', FALSE);
		$htmlBody=$this->load->view('reconfirm',$data,true);
		$this->load->remove_package_path(APPPATH.'third_party/resources');
		$mail->Body = $htmlBody;
		$mail->CharSet = 'UTF-8';
		$mail->AltBody =$message;
		if($mail->send()){
		$this->member_model->update_key($data['key'],$this->email);
		$this->load->library('alert');
		$this->alert->set('alert-success','<p>Un message a été envoyé à '.$this->email.'<br>
		Veuillez vérifier votre boite email pour confirmer et activer votre compte.<br>
		Merci de vous voir parmi nous de nouveau.<p>
		<p style="color:red !important;">Important :: veuillez vous déconnecter avant de quiter cette page.</p>'.br(2).'
		<a class="btn btn-primary btn-xs" href="'.base_url().'">Page Home</a> |
		<a class="btn btn-primary btn-xs" href="'.base_url('forum').'">Page Forum</a> |
		<a class="btn btn-primary btn-xs" href="'.base_url('logout').'">Quitter</a>
		');
		$data['pic']=$this->top_pic();
		$data['menu']=menu($this->_menu());
		$data['title']='reactivation de compte';
		$this->infos($data);
		}else{
		$this->load->library('alert');
		$this->alert->set('alert-danger','Nous sommes désolés, le méssage n\'a pas été envoyé correctement.<br>
		Veuillez ressayer ultérieurement.'.br(2).'
		<a class="btn btn-primary btn-xs" href="'.base_url().'">Page Home</a> |
		<a class="btn btn-primary btn-xs" href="'.base_url('forum').'">Page Forum</a> |
		<a class="btn btn-primary btn-xs" href="'.base_url('logout').'">Quitter</a>');
		$data['pic']=$this->top_pic();
		$data['menu']=menu($this->_menu());
		$data['title']='register';
		$this->infos($data);
		}
	}	
	/**
	 * _anti_flood
	 *
	 * @param  mixed $pseudo
	 * @return void
	 */
	protected function _anti_flood($pseudo=''){
		if($pseudo){
		$this->load->model('Messagerie_model');
		$query1=$this->messagerie_model->get_flood_time();
		foreach($query1->result() as $val):
		$t_flood=$val->config_valeur;
		endforeach;
		$query2=$this->member_model->register_flood($pseudo);
		foreach($query2->result() as $val2):
		$postime=$val2->membre_derniere_visite;
		endforeach;
		$flood=time()-$postime;
		if ($flood<$t_flood) {
		return ERR_FLOOD;
		}
		}
	}	
	/**
	 * badword
	 *
	 * @param  mixed $text
	 * @return void
	 */
	protected function badword($text){
		$badwords=array();
		$masque=array();
		$badword=$this->poster_model->check_badwords();
		foreach($badword->result_array() as $row){
		array_push($badwords,$row['badword_word']);
		array_push($masque,$row['badword_replace']);
		$text = str_ireplace($badwords, $masque, $text);
		}
		return $text;
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
		'pool'        => '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ',
		'colors'      => array(
		'background' => array(0, 51, 153),
		'border'     => array(0, 0, 0),
		'text'       => array(255, 255, 255),
		'grid'       => array(204,153,0)
		)
		);
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
		$this->form_validation->set_message('checkAntibot', 'Le code de verification est invalide');
		return FALSE;
		}
		else
		{
		return TRUE;
		}
	}	
	/**
	 * email_confirm
	 *
	 * @return void
	 */
	public function email_confirm(){
		$this->load->library('alert');
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$key=$this->uri->segment(3);
		$query=$this->member_model->confirm_mail($key);
		if($query->num_rows()>0){
		foreach($query->result() as $row){
		if(($row->member_key==$key) && ($row->member_level>PENDING))
		{
		$this->alert->set('alert-success',' Cette action n\'est pas necessaire vous avez déjà activé votre compte.<br><br/>
		<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Quiter</a>',TRUE);
		$this->infos($data);
		return;
		}
		elseif(($row->member_key==$key) && ($row->member_level==PENDING))
		{
		$this->member_model->validate_new_member($key);
		$msg='';
		$session=array(
		'pseudo'=>$row->member_pseudo,
		'email'=>$row->member_email,
		'lvl'=>MEMBER,
		'idM'=>$row->member_id,
		'avatar'=>$row->member_avatar,
		'nbr_msg'=>$msg,
		'status'=>MEMBER,
		'ip'=>$this->input->ip_address()
		);
		$this->session->set_userdata($session);
		$this->member_model->set_newkey($row->member_pseudo);
		$this->alert->set('alert-success','<p>Merci '.ucfirst($row->member_pseudo).' d\'avoir valider votre email.<br/>
		Vous pouvez acceder dès maintenant au site en utilisant vos identifiants actuels. <br/>
		Un message interne vous a été envoyé par notre equipe. N\'oubliez pas de le consulter.'.br(2).'
		<a class="btn btn-success btn-sm" href="'.base_url('forum').'">forum</a> |
		<a class="btn btn-success btn-sm" href="'.base_url('panel/index/'.$row->member_id).'">U-Panel</a>|
		<a class="btn btn-success btn-sm" href="'.base_url('message/inbox/'.$row->member_id).'">Lire Message</a>
		</p>',TRUE);
		$titre = 'Bienvenue';
		$temps = time();
		$message = 'Encore une fois, nous vous souhaitons la bienvenue sur notre forum.
		Et nous sommes entièrement à votre disposition.<br>
		Si vous rencontrez des problèmes n’hésitez pas à nous contacter en utilisant la page contact.<br>
		Le lien de la page contact se trouve sur toutes les pages dans la section footer.';
		$array = array('pmsg_sender' => '1',
		'pmsg_recept' =>$row->member_id,
		'pmsg_object' => $titre,
		'pmsg_text' => $message,
		'pmsg_time' => time(),
		'pmsg_read' => '0',
		);
		$this->member_model->send_welcome_msg($array);
		$this->infos($data);
		return;
		}
		}
		}
		else{
		$this->alert->set('alert-danger',' Nous sommes désolés, on \'a pas pu vérifier votre clé.<br><br/>
		<a class="btn btn-danger btn-sm" href="'.base_url('forum').'">Quitter</a>',TRUE);
		$this->infos($data);
		}
	}	
	/**
	 * forget_psw
	 *
	 * @return void
	 */
	public function forget_psw(){
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$this->form_validation->set_rules('email', 'E-mail','trim|required|callback_check_forget_psw');
		if ($this->form_validation->run() == FALSE)
		{
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('users/forget_psw',$data);
		$this->load->view('inc/footer',$data);
		}
		else{
		$email=trim(strtolower($this->input->post('email')));
		$resp=$this->member_model->forget_psw($email);
		if($resp->num_rows()>0)
		{
		foreach($resp->result() as $val):
		$pseudo=$val->member_pseudo;
		endforeach;
		$data['key']=sha1(microtime());
		$this->member_model->update_key($data['key'],$email);
		$date=date('d - m - Y');
		$heure=date('H-i-s');
		$message=  'Bonjours <strong>'.$pseudo.' </strong><br>
		vous venez de demander de mettre à jour votre mot de passe sur le site <a href="https://www.forum-fabb.com">
		forum-fabb.com</a>  le  '.$date.'. à '. $heure .'<br>
		Cette demande est effectu&eacute;e depuis L\'adresse IP :'. $this->ip .'<br>
		Si ce message vous est arrivé par erreur veuillez l\'ignorer  SVP.
		Si non, pour confirmer votre demande de mise à jour de votre mot de passe, veuillez cliquez sur le lien ci-dessous.<br>
		Nous vous demandons cette opération  pour nous prévenir du spam et des abus .<br>
		<a href="'.base_url('new/password/'.$data['key']).'"> changer maintenant mon mot de passe</a><br>
		NB: Si le lien n\'est pas fonctionnel, veuillez copier/coller dans la barre d\'adresse de votre navigateur le lien
		suivant ensuite valider :<br>'
		.base_url('new/password/'.$data['key']).'<br><br>
		Cordialement  le webmaster.';
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
		$mail->setFrom($this->config_model->admin_contact(),$this->config_model->raison());
		$mail->addReplyTo($this->config_model->admin_contact(),'No-reply');
		$data['date']=date('d - m - Y');
		$data['heure']=date('H-i-s');
		$data['pseudo']=$pseudo;
		$data['object'] = "Récuperation de mot de passe";
		$mail->AddAddress($email);
		$mail->Subject = $data['object'];
		$mail->isHTML(true);
		$this->load->add_package_path(APPPATH.'third_party/resources', FALSE);
		$htmlBody=$this->load->view('forget_psw',$data,true);
		$this->load->remove_package_path(APPPATH.'third_party/resources');
		$mail->Body = $htmlBody;
		$mail->CharSet = 'UTF-8';
		$mail->AltBody =$message;
		if($mail->send())
		{
		$this->load->library('alert');
		$this->alert->set('alert-success','Un message a été envoyé à <span style="color:red;">'.$email. ' .</span><br/><br/>
		Veuillez vérifier votre boite E-mail pour confirmer votre demande de re-initialisation de votre mot de passe.<br/>
		sincères salutations.<br/>',FALSE);
		$this->infos($data);
		}
		}
		}
	}	
	/**
	 * check_forget_psw
	 *
	 * @param  mixed $forget
	 * @return void
	 */
	public function check_forget_psw($forget){
		$forget=$this->input->post('email');
		$resp=$this->member_model->forget_psw($forget);
		$num_rows =$resp->num_rows();
		if($num_rows==0){
		$this->form_validation->set_message('check_forget_psw', '<span style=" font-size:11px;color:red;">On a pas pu vérifier cette addresse email, veuillez recommencer svp..!</span>');
		return FALSE  ;
		}
		else{
		return TRUE;
		}
	}	
	/**
	 * new_psw
	 *
	 * @return void
	 */
	public function new_psw(){
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$this->form_validation->set_rules('email', 'Addresse email','trim|required|callback_check_forget_psw');
		$this->form_validation->set_rules('psw', 'Nouveau Mot De Passe','required|min_length[6]|alpha_numeric');
		$this->form_validation->set_rules('confirm', 'Confirmez MDP','required|matches[psw]');
		if($this->form_validation->run()==FALSE){
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('users/new_psw',$data);
		$this->load->view('inc/footer',$data);
		}
		else {
		$email= strtolower(trim($this->input->post('email')));
		$resp=$this->member_model->verif_key($email);
		foreach($resp->result() as $row){
		$member_key= $row->member_key;
		if($member_key!=$this->uri->segment(3)){
		show_error(ERR_HACK, 403,$heading = '<span style="color:red">Nous Avons Rencontré Une Exception</span>');
		return;
		}
		$psw= hash('sha512',($this->input->post('psw')));
		$key=sha1(microtime());
		$update=$this->member_model->update_psw($psw,$key,$email);
		if($update>0){
		$this->alert->set('alert-success',' Votre mot de passe a été mis à jour avec succès.<br/><br/>
		Vous pouvez acceder dès maintenant au site en utilisant votre nouveau mot de passe.
		<br/><br/>
		<br/>',FALSE);
		$this->infos($data);
		return;
		}
		else {
							// et un petit message
		$this->alert->set('alert-danger',' On a pas pu mettre à jour votre mot de passe automatiquement, Ce pendant nous vous invitons avec inssistance à contacter l\'administrateur pour une eventuelle investigation sur ce probleme. Le cas échéant, une mise à jour manuelle de votre mot de passe a ne pas écarter.<br>
		Merci de votre compréhenssion.
		<br/><br/>
		<br/>');
		$this->infos($data);return;
		  }
		}
		}
	}	
	/**
	 * deconnexion
	 *
	 * @return void
	 */
	public function deconnexion(){
		$this->member_model->member_deconexion($this->idM);
		$this->session->sess_destroy();
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['title']='register';
		$this->alert->set('alert-success','vous vous &ecirc;tes déconnecté avec succès.
		Merci pour votre visite.'.br(2).'
		<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Quiter</a><br/>',false);
		$data['title']='logout';
		$this->infos($data);
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
		$array=array(
		'lvl'=> $this->lvl,
		'msg'=> $this->msg,
		'nbr_msg'=> $this->nbr_msg,
		'blink'=>'login',
		'avatar'=> $this->avatar,
		'pseudo'=> $this->pseudo,
		'email'=> $this->email,
		'idM'=>$this->idM,
		'status'=> $this->status,
		'idM'=>$this->idM,
		'tpid'=>$tpid,
		'sign-in'=>$this->config->item('sign-in'),
		'sign-white'=>$this->config->item('sign-white'),
		'home'=>$this->config->item('home'),

		'ttid'=>$ttid,
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
	 * _forgetPass_flood
	 *
	 * @return void
	 */
	protected function _forgetPass_flood(){
		$timeFlood=$this->config_model->time_flood();
		$query=$this->poster_model->anti_flood($this->idM);
		if($query->num_rows()>0){
		foreach($query->result() as $val):
		$lastconx=$val->flood_lastconxn;
		endforeach;
		if($timeFlood >=(time()- $lastconx))
		{
		exit(show_error(ERR_FLOOD, 403,$heading = 'Nous Avons Rencontré Une Exception'));
		}
		}
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
}
