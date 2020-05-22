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
 defined ('FABB') OR exit("read the installation instructions carefully OR re-install fabb ");
/**
* class extends Controller Class
*
* @package		fabb
* @author		faci abdelhafid
* @link		<https://www.forum-fabb.com/>
*/
	class Member extends CI_Controller {
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
		$this->load->model(array('msgs_model','forum_model'));
		$this->load->library(array('pagination','encryption','form_validation','alert','bbcode'));
		$this->load->config('glyph');
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
		if(auth_deny($this->status,MEMBER)){show_error(ERR_NOT_CONNECTED, 403,$heading = 'Nous Avons Rencontré Une Exception');}
		if($this->idM!=$this->uri->segment(3))exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception'));
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
			//last topic
			//add last post
			// last member
			// last annonce
	}    
    /**
     * index  dashboard member
     *
     * @return void
     */
    public function index()
	{
		$data['pic']=$this->top_pic();
		$data['menu']=menu($this->_menu());
		 $data['render']='bienvenue';
		 $this->display($data);
	}	
	/**
	 * _menu render menu
	 *
	 * @return void
	 */
	protected function _menu()
	{
		  $tpid=$this->member_model->total_post_idm($this->idM);
		  $ttid=$this->member_model->total_topic_idm($this->idM);
		  $array=array(
		 'lvl'=> $this->lvl,
		 'blink'=> 'member',
		 'msg'=> $this->msg,
		 'nbr_msg'=> $this->nbr_msg,
		 'avatar'=> $this->avatar,
		 'pseudo'=> $this->pseudo,
		 'email'=> $this->email,
		 'idM'=>$this->idM,
		 'status'=> $this->status	,
		 'tpid'=>$tpid,
		 'ttid'=>$ttid);
			return $array;
	}	
	/**
	 * display shows all data
	 *
	 * @param  mixed $data
	 * @return void
	 */
	public function display($data)
	{
			$this->load->view('inc/header',$data);
			$this->load->view('inc/topPage',$data);
			$this->load->view('inc/navBar',$data);
			$this->load->view('member/index',$data);
			$this->load->view('inc/footer', $data);
	}	
	/**
	 * top_pic img forum
	 *
	 * @return void
	 */
	public function top_pic()
	{
		  $this->load->model('admin_model');
		  $photo=$this->admin_model->get_pics();
		  foreach($photo->result() as $pic):
		  return $pic->pic_file;
		  endforeach;
	}	
	/**
	 * visit_profil visit profil member
	 *
	 * @return void
	 */
	public function visit_profil()
	{
		if(!$this->uri->segment(4))
		{
		       show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception');
		}
		elseif($this->uri->segment(4)=='member')
		  {     $data['pic']=$this->top_pic();
				$data['title']='visite de profil';
				$data['menu']=menu($this->_menu());
		        $data['render']='visit profil';
			    $data['rep']=$this->member_model->info_user($this->idM);
			    $this->display($data);
			    return;
		}
		elseif($this->uri->segment(4)=='self')
		{
		       $this->view_profil($this->idM);
		}
		else{
			   $uid=$this->uri->segment(4);
			   if(!$this->member_model->is_memberId($uid))
			   {
			      show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception');
		       }else{
				$data['pic']=$this->top_pic();
				$data['menu']=menu($this->_menu());
				switch($this->status){
				case MEMBER:
				$memberstatus='membre';
				break;
				case MODO:
				$memberstatus='modérateur';
				break;
				case ADMIN:
				$memberstatus='administrateur';
				break;
				}
				if(auth_equal($this->uri->segment(4),$this->idM)){
					 
					 $message='Voyant chère '.$memberstatus.' <strong> :: '. ucfirst($this->pseudo).'</strong>.'.br(1).
					 'Vous avez suivi un lien qui conduit vers la consultation de votre propre profil...! '.br(1).'
					 Vous voulez consulter votre propre profil ou vous voulez voir comment les autres membres voient votre
					 profil.'.br(2).'
					 <a class="btn btn-success btn-sm" href="'.base_url('member/visit_profil/'.$this->idM.'/member').'">Voir
					  comme
					 membre</a> |
					 <a class="btn btn-success btn-sm" href="'.base_url('member/visit_profil/'.$this->idM.'/self').'">Consulter
					 mon profil</a> | 
					 <a class="btn btn-success btn-sm" href="'.$this->agent->referrer().'">Retour</a>';
					 $this->alert->set('alert-success',$message,TRUE);
					 $data['render']='infos';
					 $this->display($data);
					
					/*if(auth_equal($this->status,ADMIN))
					{
					 $message.=' | <a class="btn btn-success btn-sm" href="'.base_url('admin/index/'.$this->idM).'">A-Panel</a>';
					}
					 $data['render']='infos';
					 $this->alert->set('alert-success',$message,TRUE);
					 $this->display($data);
					 }
					 elseif($this->uri->segment(4)=='self'){
					 $this->view_profil($this->idM);
					 }
					 elseif($this->uri->segment(4)=='member')
				     {
						$data['render']='visit profil';
						$data['rep']=$this->member_model->info_user($this->idM);
						$this->display($data);
						return;
					 }*/
			         }
					 else{
					 $data['render']='visit profil';
					 $data['rep']=$this->member_model->info_user($this->uri->segment(4));
					 $this->display($data);
					}
			}
		}
	}	
	/**
	 * view_profil view self profil
	 *
	 * @return void
	 */
	public function view_profil()
	{
			$data['pic']=$this->top_pic();
			$data['menu']=menu($this->_menu());
			$data['render']='view profil';
			$id = (int) $this->uri->segment(3);
				$query=$this->member_model->info_user($id);
			if($query->num_rows()>0)
			{
			 $data['rep']=&$query;
			$this->display($data);
			}
			  else{
				  show_404();
				  }
	}	
	/**
	 * update_profil update his profil
	 *
	 * @return void
	 */
	public function update_profil()
    {

		 $data['menu']=menu($this->_menu());
		 $data['pic']=$this->top_pic();
		 $data['render']='update profil';
		 $data['query']=$this->member_model->info_user($this->idM);
		 $this->form_validation->set_rules('act','Password Actuel','trim|required|callback_act_psw');
		 $this->form_validation->set_rules('password','Nouveau mot de Passe','trim|max_length[12]|min_length[6]');
		 $this->form_validation->set_rules('confirm','Confirmer MDP','trim|matches[password]');
		 $this->form_validation->set_rules('email','Addresse e-mail','trim|valid_email|callback_check_emails');
		 $this->form_validation->set_rules('tel','Téléphone','trim|numeric|max_length[15]|min_length[6]');
		 $this->form_validation->set_rules('localisation','Pays','trim|htmlspecialchars|max_length[40]');
		 $this->form_validation->set_rules('nom','Nom','trim|htmlspecialchars|max_length[24]|min_length[2]');
		 $this->form_validation->set_rules('website','Site web','trim|htmlspecialchars|callback_valid_url');
		 $this->form_validation->set_rules('prenom','Prenom','trim|htmlspecialchars|max_length[24]|min_length[2]');
		 $this->form_validation->set_rules('signature','Signature','trim|htmlspecialchars|max_length[128]');
		 $this->form_validation->set_rules('localisation','Pays','htmlspecialchars|max_length[32]|min_length[2]');
		 $this->form_validation->set_rules('func','Occupation','htmlspecialchars|max_length[64]|min_length[2]');
		 $this->form_validation->set_rules('avatar','Modifier Son Avatar','callback_check_avatar');
			if ($this->form_validation->run() == FALSE)
			{
			$this->display($data);
			}
			else{
				$query=$this->member_model->info_user($this->idM);
				foreach($query->result() as $user):
				$user->member_mdp;
				$user->member_pseudo;
				$user->member_email;
				$user->member_work;
				$user->member_name;
				$user->member_forname;
				$user->member_location;
				$user->member_gender;
				$user->member_phone;
				$user->member_website;
				$user->member_age;
				$user->member_avatar;
				$user->member_notify;
				$user->member_signature;
				endforeach;
			   if($this->input->post('ddn')){
			  $ddn = DateTime::createFromFormat('j/m/Y',$this->input->post('ddn'));
			  $age = $ddn->getTimestamp();
			  }
			  if($this->input->post('sexe')!='undefined'){
			  $sexe=$this->input->post('sexe');
			  }
			  if($this->input->post('email')){
			  $email=$this->input->post('email');
			  }
			  if($this->input->post('tel')){
			  $phone=$this->input->post('tel');
			  }
			  if($this->input->post('localisation')){
			  $location=$this->input->post('localisation');
			  }
			  if($this->input->post('nom')){
			  $name=$this->input->post('nom');
			  }
			  if($this->input->post('prenom')){
			  $forname=$this->input->post('prenom');
			  }
			  if($this->input->post('newsltr')){
			  $notify=$this->input->post('newsltr');
			  }
			  if($this->input->post('website')){
			  $website=$this->input->post('website');
			  }
			  if($this->input->post('func')){
			  $func=$this->input->post('func');
			  }
			  if($this->input->post('signature')){
			  $signature=trim($this->input->post('signature'));
			  }
			  $psw=$this->input->post('act');
			  $mdp=hash('sha512',$psw);
			  if($this->input->post('password')){
			  $pass=$this->input->post('password');
			  $password=hash('sha512',$pass);
			  }
			  $mdp= isset($password)?$password:$user->member_mdp;
			  $email= isset($email)?strtolower($email):$user->member_email;
			  $notify=isset($notify)?$notify:$user->member_notify;
			  $name=isset($name)?$name:$user->member_name;
			  $forname=isset($forname)?$forname:$user->member_forname;
			  $age=isset($age)?$age:$user->member_age;
			  $sexe=isset($sexe)?$sexe:$user->member_gender;
			  $phone=isset($phone)?$phone:'';
			  $location=isset($location)?$location:$user->member_location;
			  $website=isset($website)?$website:$user->member_website;
			  $func=isset($func)?$func:$user->member_work;
			  $signature=isset($signature)?$signature:$user->member_signature;
			  if($_FILES['avatar']['size']>0){
			  $file = $_FILES['avatar']['tmp_name'];
			  $sourceProperties = getimagesize($file);
			  $fileNewName = time();
			  $folderPath = "./assets/avatars/";
			  $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
			  $imageType = $sourceProperties[2];
			  switch ($imageType)
			  {
			  case IMAGETYPE_PNG:
			  $imageResourceId = imagecreatefrompng($file);
			  $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
			  imagepng($targetLayer,$folderPath. $fileNewName.'.'.$ext);
			  break;
			  case IMAGETYPE_GIF:
			  $imageResourceId = imagecreatefromgif($file);
			  $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
			  imagegif($targetLayer,$folderPath. $fileNewName.'.'.$ext);
			  break;
			  case IMAGETYPE_JPEG:
			  $imageResourceId = imagecreatefromjpeg($file);
			  $targetLayer =imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
			  imagejpeg($targetLayer,$folderPath. $fileNewName.'.'.$ext);
			  break;
			  }
			  $avatar=$fileNewName.'.'.$ext	;
			}
			else{
				 $avatar=$user->member_avatar;
				 }
			$array=array(
			'member_pseudo'=>strtolower($this->pseudo),
			'member_id'=>$this->idM,
			'member_mdp'=>$mdp,
			'member_email'=>strtolower($email),
			'member_level'=>$this->status,
			'member_phone'=>$phone,
			'member_location'=>$location,
			'member_name'=>$name,
			'member_forname'=>$forname,
			'member_age'=>$age,
			'member_gender'=>$sexe,
			'member_work'=>$func,
			'member_avatar'=>strtolower($avatar),
			'member_signature'=>ucfirst($signature),
			'member_last_visit'=>time(),
			'member_website'=>$website,
			'member_ip'=>$this->input->ip_address(),
			'member_notify'=>$notify);
			if($this->member_model->update_member($array))
			{
				$data['menu']=menu($this->_menu());
				$data['pic']=$this->top_pic();
				$data['render']='infos';
				$this->alert->set('alert-success',' Les changements ont été mis à jour avec succès.'.br(2).'
				<a class="btn btn-success btn-sm" href="'.base_url('member').'">Retour U-Panel</a> |
				<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a>',TRUE);
				if(isset($avatar)){$this->session->set_userdata('avatar',$avatar);}
				$this->display($data);
			}
		}
	}    
    /**
     * valid_url checks valid url
     *
     * @return void
     */
    public function valid_url()
	{
	    if($this->input->post('website'))
		{
			$url =  $this->input->post('website');
			if(!preg_match( '/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$url))
			{
			$this->form_validation->set_message('valid_url', '<span style="font-size:0.8em;color:red">La forme de votre addresse URL n\'est pas valide...</span>');
			return false;
		    }
	    }
	}	
	/**
	 * act_psw actual password is mandatory
	 *
	 * @return void
	 */
	public function act_psw()
	{
			$this->load->model('config_model');
			$psw=$this->input->post('act');
			$hash=hash('sha512',$psw);
			$query=$this->member_model->info_user($this->idM);
			foreach($query->result() as $val):
			$pass= $val->member_mdp;
			 if (strcmp($pass,$hash)==0)
			{
				return TRUE;
			}
			else
			{
		     $this->form_validation->set_message('act_psw','<span style="font-size:90%;color:red">Soit le {field} n\'est pas  valide, soit le champ n\'a pas été renseigné....</span>');
				return FALSE;
			}
			endforeach;
	}	
	/**
	 * check_emails is valid email
	 *
	 * @return void
	 */
	public function check_emails()
	{       $email=strtolower($this->input->post('email'));
	        $query=$this->member_model->check_email($this->idM);
			foreach($query->result() as $val):
			 if ($email==$val->member_email)
			{
				$this->form_validation->set_message('check_emails', '<span style="font-size:0.8em;color:red">Cette {field} n\'est pas disponible : '.$email.'.</span>');
				return FALSE;
			}else return TRUE;
			endforeach;
	}    
    /**
     * check_avatar is hard work to check avatar
     *
     * @return void
     */
    public function check_avatar()
	{
	   if($_FILES['avatar']['size'] != 0)
	   {
			$upload_dir = './assets/avatars/';
			if (!is_dir($upload_dir))
			{
			 mkdir($upload_dir);
			}
			$config['upload_path']   = $upload_dir;
			$config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|PNG|JPG|GIF';
			$config['max_size']      = 10000;
			$config['max_width']     = 100;
			$config['max_height']    = 100;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('avatar'))
			{
				$this->form_validation->set_message('check_avatar', $this->upload->display_errors());
				return false;
			}
			else{
				return true;
			}
		}
	}  
  /**
   * member_list shows members list
   *
   * @return void
   */
  public function member_list()
    {
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['render']='list membre';
		$data['memberlist']='active';
		$resp=$this->member_model->count_all_member();
		$page = $this->uri->segment(4,0);
		$limit=$this->input->post('limit')?$this->input->post('limit'):$this->config_model->member_par_page();
		$config['base_url'] = base_url('member/member_list/'.$this->idM.'/');
		$config['total_rows'] = $resp;
		$config['per_page'] =$limit ;
		$config['num_links'] = 2;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<ul class="pagination pagination-ms">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = array('class' => 'page_link');
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$data['link'] = $this->pagination->create_links();
		$order_by =array('member_id', 'member_pseudo', 'member_post', 'member_last_visit');
		$tri_by = array('ASC', 'DESC');
		$sort=$this->input->post('sort')?$this->input->post('sort'):0;
		$tri=$this->input->post('tri')?$this->input->post('tri'):0;
		$data['resp']=$this->member_model->get_data_member($order_by[$sort],$tri_by[$tri],$limit,$page);
		$this->display($data);
    }  
  /**
   * select_friend select a friend to add it in list
   *
   * @return void
   */
  public function select_friend()
   {

		  $data['addfriend']='active';
		  $data['pic']=$this->top_pic();
		  $data['render']='select friend';
		  $this->blink='user';
		  $data['menu']=menu($this->_menu());
		  $this->display($data);
    }  
  /**
   * selected_friend checks selected friend
   *
   * @return void
   */
  public function selected_friend()
  {
      $data['addfriend']='active';
	  $data['pic']=$this->top_pic();
	  $this->blink='user';
	  $data['menu']=menu($this->_menu());
		if($this->input->post('pseudo')){
		 $friend = $this->input->post('pseudo');
		}
		elseif($this->uri->segment(4)){
			$friend=$this->uri->segment(4);
			}
		elseif(!$this->uri->segment(4)){
			$friend='unknow';
			}
		$resp=$this->member_model->get_id_friend($friend);
		if (!$friend)
		{
						$this->alert->set('alert-danger',' Le champ est vide, veuillez renseigner un pseudo.'.br(2).'
			<a class="btn btn-success btn-sm" href="'.base_url('member/select_friend/'.$this->idM).'">Ressayer</a> |
			<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a>',TRUE);
				 $data['render']='infos';
						 $data['menuvertical']='vrai';
			$this->display($data);
		}
			  if($resp->num_rows()==0)
					  {
				 $data['menuvertical']='vrai';
		if($friend=='unknow'){
			$friend='2- Par défaut, certains pseudos sont réservés par l\'administarteur, dans tout les cas vous ne pouvez pas les inviter.<br>';
			}else{$friend='2- Le membre: <strong>'.$friend.'</strong> n\'éxiste pas.<br>';}
						$this->alert->set('alert-danger','<p>Plusieur cas sont possible:<br>
						1- vous avez valider un champ vide.<br>
						'.$friend.'
						veuillez re-essayez svp..!'.br(2).'
			<a class="btn btn-success btn-sm" href="'.base_url('member/select_friend/'.$this->idM).'">Ressayer</a> |
			<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a>',TRUE);
				 $data['render']='infos';
						 $data['menuvertical']='vrai';
			$this->display($data);
						 }
		if($resp->num_rows()>0){
				foreach($resp->result() as $row):
				$id_friend=$row->member_id;
				endforeach;
		 $query=$this->member_model->select_amis_from($this->idM,$id_friend);
		  if ($query->num_rows()>0)
		   {
			  $this->alert->set('alert-danger','<p>Le membre: <strong>'.$friend.'</strong> éxiste déjà sur votre liste des amis,
			  ou déjà une amitié a été proposée...!<br>
			  veuillez re-essayez svp...!'.br(2).'
			  <a class="btn btn-primary btn-sm" href="'.$this->agent->referrer().'">Retour</a> |
				<a class="btn btn-primary btn-sm" href="'.base_url('member/select_friend/'.$this->idM).'">Ressayer</a> |
				<a class="btn btn-primary btn-sm" href="'.base_url('forum').'">Forum</a>',TRUE);
					 $data['render']='infos';
							 $data['menuvertical']='vrai';
				$this->display($data);
	        }
		   if ($query->num_rows()==0)
			{
		      if ($id_friend == $this->idM)
				{
				 $this->alert->set('alert-danger','<p>Soyez sérieux(se) <strong>'.$this->pseudo.'</strong>'. br(2).'
				 On ne peut pas proposer une amitié à soi-m&ecirc;me..!'. br(2).'
				 <a class="btn btn-success btn-sm" href="'.$this->agent->referrer().'">Retour</a> |
				 <a class="btn btn-success btn-sm" href="'.base_url('member/select_friend/'.$this->idM).'">Ressayer</a> |
				 <a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a>',TRUE);
					 $data['render']='infos';
						 $data['menuvertical']='vrai';
			    $this->display($data);
			    }
			    else
			    {
				   $array=array(
				   'friend_from' => $this->idM,
				   'friend_to'=>$id_friend,
				   'friend_confirm'=>'0',
				   'friend_since'=>time(),
						);
					   $this->member_model->add_amis($array);
					   $this->alert->set('alert-success','<p><strong>'.$friend.'</strong> a été correctement ajouté à vos amis.'. br(1).'
					 un message lui a été envoyé pour le prévenir. Cependant il faut qu\'il donne son accord. '. br(1).'
					 autrement votre amitié reste en instance..!'.br(2).'
					<a class="btn btn-success btn-sm" href="'.base_url('member/select_friend/'.$this->idM).'">Ajouter Autre Ami</a> |
					<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a>',TRUE);
					$data['render']='infos';
					$data['menuvertical']='vrai';
					$this->display($data);
			    }
			}
	    }
	}	
	/**
	 * list_friends lists all friends
	 *
	 * @return void
	 */
	public function list_friends()
	{
		$data['listami']='active';
		$data['pic']=$this->top_pic();
		$data['menu']=menu($this->_menu());
		$data['render']='friends';
		$data['query']=$this->member_model->from_friends($this->idM);
		$data['query_2']=$this->member_model->confirm_friends($this->idM);
		$data['pending']=$this->member_model->stand_by($this->idM);
		$this->display($data);

    }	
	/**
	 * add_friend add friend
	 *
	 * @return void
	 */
	public function add_friend()
	{
		   $data['menu']=menu($this->_menu());
		   $data['render']='add friend';
		   $data['addfriend']='active';
		   $data['pic']=$this->top_pic();
		   $add = htmlspecialchars($this->uri->segment(4));
		   if (!$add || $add!=='add')
		   {
				$data['query']=$this->member_model->unchecked_amis($this->idM);
				$this->display($data);
			}
			 else
			{
				$membre = (int)$this->uri->segment(4);
				$this->member_model->update_add_member($membre,$this->sm_idM);
				$this->alert->set('alert-success','<p>Le membre a été ajouté correctement à votre liste d\'ami.</p>',TRUE);
							 $this->display($data);
			}
	}	
	/**
	 * confirm_friend confirmation is necessary to be friend
	 *
	 * @return void
	 */
	public function confirm_friend()
	{
	   $data['menu']=menu($this->_menu());
	   $data['addfriend']='active';
	   $data['pic']=$this->top_pic();
	   $data['render']='infos';
	   $friend = (int)$this->uri->segment(4);
		$name = rawurldecode($this->uri->segment(5));
		if($this->member_model->update_add_member($friend,$this->idM)==TRUE)
		{
		    $this->alert->set('alert-success','<p>Le membre :: '.$name.' a été ajouté correctement à votre liste d\'amis.</p>'.
			 br(2).'
			<a class="btn btn-success btn-sm" href="'.base_url('member/list_friends/'.$this->idM).'">Retour Liste Ami</a> |
			<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a>',TRUE);
	    }else
		{
			$this->alert->set('alert-success','<p>Nous somme désolé, le membre :: '.$name.' n\'a pas été ajouté correctement à votre liste d\'amis.'.br(1).'Veuillez ressayer ultérieurement.</p>'.
			br(2).'
			<a class="btn btn-success btn-sm" href="'.base_url('member/list_friends/'.$this->idM).'">Retour Liste Ami</a> |
			<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a>',TRUE);
		}
				 $data['menuvertical']='vrai';
				 $this->display($data);
	}

	/**
	 * inbox  message inbox
	 *
	 * @return void
	 */
	public function inbox()
	{
		$data['render']='inbox';
		$data['mymessage']='active';
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['resp']=$this->msgs_model->get_all_msg($this->idM);
		$data['menuvertical']='vrai';
		$this->display($data);
	}	
	/**
	 * new_pm write new private msg
	 *
	 * @return void
	 */
	public function new_pm()
	{
		$this->_check_flood('new_pm');
		$data['mymessage']='active';
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['render']='ecrire message';
		$to=$this->input->post('to');
		$this->form_validation->set_rules('to', 'Destinataire', 'required|trim|htmlspecialchars|callback_destinataire');
		$this->form_validation->set_rules('objet', 'Objet', 'required|trim|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('message', 'Message', 'required|min_length[3]|max_length[2500]');
			if ($this->form_validation->run() == FALSE)
			{
				 $data['menuvertical']='vrai';
				 $this->display($data);
				}
				else
			{
			  $to=$this->input->post('to');
			  $objet=$this->input->post('objet');
			  $message=$this->input->post('message');
			  $rep=$this->msgs_model->get_user_pseudo($to);
			  foreach($rep->result()as $row):
			  $membre=$row->member_pseudo;
			  endforeach;
			  if($membre==$this->input->post('to'))
			  {
			    $data=array(
				'pmsg_sender'=>$this->idM,
				'pmsg_recept'=>$row->member_id,
				'pmsg_object'=>$objet,
				'pmsg_text'=>$message,
				'pmsg_time'=>time(),
				'pmsg_read'=>'0'
				);
					if($this->msgs_model->insert_new_msg($data))
					{
					  $array=array('flood_ip'=>$this->ip,
							'flood_time'=>time(),
							'flood_idm'=>$this->idM,
							'flood_act'=>'new_pm'
							 );
						$query=$this->msgs_model->time_flood($this->idM,'new_pm');
						if($query->num_rows()>0)
						{
						 $this->msgs_model->update_flood($this->idM,'new_pm');
						}
						   else
						   {
							   $this->msgs_model->insert_flood($array);
						   }
						   $data['pic']=$this->top_pic();
						   $data['render']='infos';
						   $this->alert->set('alert-success','<p>Votre message est envoyé avec succes à ' .$to.br(2).'
						   <a class="btn btn-success btn-sm" href="'.base_url('nouveau/message/'.$this->idM).'">Nouveau Méssage</a> |
						   <a class="btn btn-success btn-sm" href="'.base_url('member').'">U-Panel</a>',TRUE);
						   $data['menu']=menu($this->_menu());
						   $this->display($data);
					}
			}
			else{
			$data['render']='echec_pm';
			$data['e_new_pm']='Un probleme est survenu lors de l\'envoi de votre méssage. Veuillez ressayer ulterieurement,                 ou contacter l\'administrateur pour une eventuelle investigation plus approfondie';
				$data['destinataire']=$to;
			$data['menu']=menu($this->_menu());
			  $this->load->view('inc/header');
			  $this->load->view('inc/navBar',$data);
			  $this->load->view('member/u_panel',$data);
			  $this->load->view('inc/footer');
				}
		}
	}	
	/**
	 * consulter is there msg inbox?
	 *
	 * @return void
	 */
	public function consulter()
	{
		$data['menu']=menu($this->_menu());
		$data['render']='consulter';
		$id_mess = (int) $this->uri->segment(4);
	    $query= $this->msgs_model->info_message($id_mess);
		foreach($query->result() as $row):
		$row->pmsg_recept;
		endforeach;
		if ($row->pmsg_read == 0)
		{
			   $this->msgs_model->msg_is_read($id_mess);
		   if($this->nbr_msg>0)
		   {
			   $this->nbr_msg-=$this->nbr_msg;
		   }
		}
		  $data['query']=&$query;
		  $data['menuvertical']='vrai';
		  $data['pic']=$this->top_pic();
		  $this->display($data);
		}	
	/**
	 * repondre reply private msg
	 *
	 * @return void
	 */
	public function repondre()
    {
					$this->_check_flood('reply_pm');
					$data['render']='repondre pm';
					 $data['pic']=$this->top_pic();
					 $data['menu']=menu($this->_menu());
					if($this->uri->segment(4))
					{
					 $data['query']=$this->msgs_model->user_by_id($this->uri->segment(4));
					}
					if($this->uri->segment(5)){
					$data['dest']=$this->uri->segment(5);
					}
					$this->form_validation->set_rules('objet', 'Objet', 'required|trim|htmlspecialchars|min_length[3]|max_length[255]');
					$this->form_validation->set_rules('message', 'Message', 'required|htmlspecialchars|min_length[3]|max_length[3000]');
					if ($this->form_validation->run() == FALSE)
					{
					$this->display($data);
					}
				  else{
				  $pseudo=$this->uri->segment(5);
				  $message =$this->badword($this->input->post('message'));
				  $titre =$this->badword($this->input->post('objet'));
				  $temps = time();
				  $dest = (int)$this->uri->segment(4);
				  $data=array('pmsg_sender'=>$this->idM,
							'pmsg_recept'=>$dest,
							'pmsg_object'=>$titre,
							'pmsg_text'=>$message,
							'pmsg_time'=>time(),
							'pmsg_read'=>'0'
					);
					  if($this->msgs_model->insert_new_msg($data)){
						  $act='reply_pm';
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
								 $this->alert->set('alert-success','<p>Votre réponse a été envoyé à '.$pseudo.' avec succes</p>
								<a class="btn btn-success btn-sm" href="'.base_url('boite/messagerie/'.$this->idM).'">Inbox</a> |
								<a class="btn btn-success btn-sm" href="'.base_url('member').'">U-Panel</a>',TRUE);
								  $data['menu']=menu($this->_menu());
								  $data['pic']=$this->top_pic();
								$data['render']='infos';
								$this->display($data);
						    }
							else{
							 $this->alert->set('alert-success','<p>Oooops, Un problème non attendu.<br>
							  votre réponse n\'a pas été correctement envoyé à '.$pseudo.'. Si le problème persiste, veuillez contacter l\'administrateur</p>
								<a class="btn btn-success btn-sm" href="'.base_url('boite/messagerie/'.$this->idM).'">Inbox</a> |
								<a class="btn btn-success btn-sm" href="'.base_url('member').'">U-Panel</a>',TRUE);
							$data['render']='infos';
								$this->display($data);
							}
			}
	}	
	/**
	 * del_pm delete private msg
	 *
	 * @return void
	 */
	public function del_pm()
	{
			$data['menu']=menu($this->_menu());
			$data['pic']=$this->top_pic();
			$data['render']='infos';
			$id_mess=$this->uri->segment(4);
			 if($this->uri->segment(5)==='delete')
			 {
			   $this->alert->set('alert-warning','<p>Attention : Vous voulez vraiment supprimer ce méssage..!</p>'.br(2).'
			   <a class="btn btn-danger btn-sm" href="'.base_url('delete/message/'.$this->idM).'/'.$id_mess.'/1">Supprimer</a> |
			    <a class="btn btn-success btn-sm" href="'.base_url('delete/message/'.$this->idM).'/'.$id_mess.'/0">Annuler</a>',TRUE);
			    $this->display($data);
			}
					elseif ($this->uri->segment(5)=='1')
					{
						$id_mess=$this->uri->segment(4);
						$resp= $this->msgs_model->delete_pm($id_mess);
							if($resp>0){
									$this->alert->set('alert-success','<p>Le message a été supprimé avec succes..!<br></p>
									<p><a class="btn btn-success btn-sm" href="'.base_url('message/inbox/'.$this->idM).'">Retour</a></p>',TRUE);
							$this->display($data);
									}else {
								$this->alert->set('alert-danger','<p>Si le méssage n\'est pas supprimé, veuillez nous contacter pour une éventuelle intervention manuelle..!</p><p><a class="btn btn-success btn-sm" href="'.base_url('message/inbox/'.$this->idM).'">Retour</a></p>',TRUE);
							$this->display($data);
								}
					}
					else{
					   redirect('message/inbox/'.$this->idM);
					   }
	}	
	/**
	 * check_confirm_psw the twice password must be equal
	 *
	 * @return void
	 */
	public function check_confirm_psw()
	{
				 if ($this->input->post('password') !== $this->input->post('confirm'))
				{
						$this->form_validation->set_message('check_confirm_psw','<span style="font-size:90%;color:red">Les deux mots de passe doivent etre identique.</span>');
						return FALSE;
				}
				else
				{
						return TRUE;
				}
	}
/**
 * del_friend delete friend from list
 *
 * @return void
 */
public function del_friend()
{
			   $del=$this->uri->segment(4);
			  $id = (int)$this->uri->segment(5);
			  $pseudo=rawurldecode($this->uri->segment(6));
						if ($del=='del')
			{
				$data['render']='infos';
				$data['menuvertical']='vrai';
				$data['pic']=$this->top_pic();
				$data['menu']=menu($this->_menu());
				$data['menu']=menu($this->_menu());
				$this->alert->set('alert-danger','<p>Etes vous certain de vouloir supprimer '.$pseudo.' de votre liste d\'ami ?'.br(2).'</p>
				  <p><a class="btn btn-danger btn-sm" href="'.base_url('member/del_friend/'.$this->idM.'/oui/'.$id.'/'.rawurlencode($pseudo)).'">Oui, supprimer</a> |
				  <a class="btn btn-success btn-sm" href="'.base_url('member/list_friends/'.$this->idM).'">Annuler</a></p></p>',TRUE);
					$this->display($data);
			}
			else
{
				   $data['render']='infos';
				 $data['menuvertical']='vrai';
				 $data['pic']=$this->top_pic();
				  $data['menu']=menu($this->_menu());
		           $id = (int)$this->uri->segment(5);
		           $this->member_model->delete_ami_from($this->idM,$id);
			       $pseudo=rawurldecode($this->uri->segment(6));
		           $this->alert->set('alert-success','<p>'.$pseudo.' ::  a été supprimé avec succes de votre liste d\'ami...!<br></p>
				<p><a class="btn btn-success btn-sm" href="'.base_url('member/list_friends/'.$this->idM).'">Liste amis</a>
				<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a>
				</p>',TRUE);
			   $this->display($data);
		}
	 }	
	/**
	 * denied_friendship i dont accept your friendship
	 *
	 * @return void
	 */
	public function denied_friendship()
	{
				$data['menu']=menu($this->_menu());
			     $data['render']='infos_action';
				 $data['menuvertical']='vrai';
				  $data['pic']=$this->top_pic();
		   $friend=(int)$this->uri->segment(4);
		   $name=$this->uri->segment(5);
			$rep=$this->msgs_model->get_user_pseudo($name);
			foreach($rep->result()as $row):
			$member=$row->member_pseudo;
			$id=$row->member_id;
			endforeach;
			if($id!=$friend || $name!=$member){
				show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception');
				return;
				}
			if($member==$name)
			{
				$msg='Désolé votre amitié ne peut &ecirc;tre acceptée, les raisons ne concernent que moi.<br>
				Merci de l\'avoir proposé.';
			    $data=array(
				'pmsg_sender'=>$this->idM,
				'pmsg_recept'=>$id,
				'pmsg_object'=>'Amitié refusée.',
				'pmsg_text'=>$msg,
				'pmsg_time'=>time(),
				'pmsg_read'=>'0'
				);
				 if($this->msgs_model->insert_new_msg($data))
				 {
					$this->alert->set('alert-success','<p>Un message a été envoyé à '.$name.' l\'informant du refus de votre amitié.'.br(2).'
					<a class="btn btn-success btn-sm" href="'.base_url('member/list_friends/'.$this->idM).'">Retour Liste Amis</a> |
					<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a>',TRUE);
					$data['menu']=menu($this->_menu());
					   $data['render']='infos';
					 $data['menuvertical']='vrai';
					  $data['pic']=$this->top_pic();
					  $this->member_model->delete_pending_friend($this->idM,$id);
						$this->display($data);
				 }
			}
	}	
	/**
	 * search serch data on forum
	 *
	 * @return void
	 */
	public function search()
	{
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['title']='forum fabb';
		$this->form_validation->set_rules('term','Mot De Recherche', 'required|trim|htmlspecialchars|strtolower|min_length[3]|max_length[32]|regex_match[#^[a-zA-Z0-9_. -]{1,}$#]');
			if ($this->form_validation->run() == FALSE)
			{
				$data['blink']='search';
				$this->load->view('inc/header',$data);
				$this->load->view('inc/topPage',$data);
				$this->load->view('inc/navBar',$data);
				$this->load->view('search/search',$data);
				$this->load->view('inc/footer',$data);
			}
			else{
				$this->result();
				}
	}	
	/**
	 * result fire results search
	 *
	 * @return void
	 */
	public function result()
	{
			$data['menu']=menu($this->_menu());
				  $data['pic']=$this->top_pic();
			$data['title']='forum fabb';
			$searched_term = $this->input->post('term');
			$rows=$this->member_model->cherche($searched_term);
			if($rows->num_rows()==0){
				$data['advise']='Mot de recherche :<span style=" padding:2px 4px;background-color:yellow"> ' .$searched_term.'</span> n\'a abouti à aucun résultat. <br>
				Essayez d\'affiner votre recherche avec d\'autres mots plus explicites.';
			$this->load->view('inc/header',$data);
			$this->load->view('inc/topPage',$data);
			$this->load->view('inc/navBar',$data);
			$this->load->view('search/search',$data);
			$this->load->view('inc/footer');
			}
			else{
			$num_rows=$rows->num_rows();
			$config['base_url'] = base_url('member/result');
			$config['total_rows'] = $num_rows;
			$config['per_page'] = $this->config_model->search_result();
			$config['uri_segment'] = 3;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = 'First';
			$config['last_link'] = 'Last';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links();
			$data['resp'] = $this->member_model->limitsearch($searched_term,$config["per_page"], $page);
			$this->load->view('inc/header',$data);
			$this->load->view('inc/topPage',$data);
			$this->load->view('inc/navBar',$data);
			$this->load->view('search/result',$data);
			$this->load->view('inc/footer',$data);
		}
	}	
	/**
	 * read_more read integral search
	 *
	 * @return void
	 */
	public function read_more()
	{
				if($this->uri->segment(3)){
				$id=$this->uri->segment(3);
				$data['post_text']=$this->member_model->search_post($id);
				$this->load->view('search/read_more',$data);
				}
	}	
	/**
	 * badword handle bad word
	 *
	 * @param  mixed $text
	 * @return void
	 */
	protected function badword($text)
	{
		$this->load->model('poster_model');
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
	 * destinataire checks destination msg
	 *
	 * @return void
	 */
	public function destinataire()
	{
		if($this->lvl<MEMBER || $this->idM!=$this->uri->segment(3)) show_error(ERR_NOT_CONNECTED, 403,$heading = 'Nous Avons Rencontré Une Exception');
		$to=$this->input->post('to');
		if($to==$this->pseudo){
		$this->form_validation->set_message('destinataire', '<span style="font-size:11px;color:red">Vous ne pouvez pas envoyer un message
		 à vous m&ecirc;me.</span>');
		return FALSE;
			}
		$query=$this->msgs_model->get_user_pseudo($to);
		if($query->num_rows()==0)
		{
		$this->form_validation->set_message('destinataire', '<span style="font-size:11px;color:red">le %s renseigné : ('.$to.') n\'existe pas.</span>');
		return FALSE;
		}
		else {
		return TRUE;
		}
	}	
	/**
	 * del_account i want to delete my account
	 *
	 * @return void
	 */
	public function del_account()
	{
		if($this->uri->segment(3)!=$this->idM) show_error(ERR_NOT_CONNECTED, 403,$heading = 'Nous Avons Rencontré Une Exception');
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['render']='infos';
		$data['menuvertical']='vrai';
		if($this->uri->segment(4)==1)
		{
				if($this->member_model->delete_account($this->idM)>0)
				{
					$this->member_model->member_deconexion($this->idM);
					$this->session->sess_destroy();
					echo'<p style="font-size:16px;margin-right:auto; margin-left:auto;color:white; padding:100px 50px; background:red;">Votre compte est supprimé avec succès.<br><br><br><br>
					<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Quitter</a></p>';
				}
		}
		else{
				 if($this->status==ADMIN)
			{
					$this->alert->set('alert-danger','<p style="color:red !important;font-size:18px;">Avertissement à '.$this->pseudo.' </p>
				<p>Vous &ecirc;tes administrateur, vous ne pouvez pas supprimer votre compte.<br>
				Le lien de suppression de compte est là, c\'est juste pour vous aviser que les membres de votre forum sont en mesure de supprimer leurs comptes.</p>
				<a class="btn btn-success btn-sm" href="'.base_url('member/index/'.$this->idM).'">Retour</a>',TRUE);
				$this->display($data);
			}
				   elseif($this->status==MODO)
				  {
					$this->alert->set('alert-danger','<p style="color:red !important;font-size:18px;">Avertissement à '.$this->pseudo.' </p>
					<p>Vous &ecirc;tes moderateur, vous ne pouvez pas supprimer votre compte.<br>
					Si vous insister sur la suppression de votre compte, veuillez contacter votre administrateur.</p>
						<a class="btn btn-success btn-sm" href="'.base_url('member/index/'.$this->idM).'">Retour</a>',TRUE);
					$this->display($data);
				   }
				   else
				   {
						$data['menu']=menu($this->_menu());
						$data['pic']=$this->top_pic();
						$data['render']='infos';
						$data['menuvertical']='vrai';
						$this->alert->set('alert-danger','<p style="color:red !important;font-size:18px;">Avertissement à '.$this->pseudo.'</p>
						<p>Soyez attentif, vous &ecirc;tes sur le point de supprimer votre compte.<br>
						1- Votre compte sera supprimé définitivement et vous ne serez pas en mesure de vous
						 re-connecter avec les identifiants actuels.<br>
						2- Votre contribution sur le forum ne sera pas supprimé.<br>
						3- Vous pouvez vous enregistrer de nouveau sur le forum en utilisant une addresse email différente.<br>
						4- Si après la suppression, vous considérez que c\'était une erreur, vous pouvez toujours retrouver votre compte en envoyant un méssage à l\'administrateur. Cette action n\'est pas automatique, elle peut prendre du temps.'.br(2).'
						</p>
						<a class="btn btn-success btn-sm" href="'.base_url('member/del_account/'.$this->idM.'/1').'">Supprimer</a> |
						<a class="btn btn-success btn-sm" href="'.base_url('member/index/'.$this->idM).'">Annuler</a>',TRUE);
						$this->display($data);
					}
	    }
    }	
	/**
	 * _check_flood we dont accept toomach msg at once
	 *
	 * @param  mixed $act
	 * @return void
	 */
	protected function _check_flood($act)
	{
	    $timeflood=$this->config_model->flood();
		$query=$this->msgs_model->time_flood($this->idM,$act);
		if($query->num_rows()>0)
		{
			foreach($query->result() as $value):
			$postime=$value->flood_time;
			endforeach;
			$flood=time()- $postime;
			if ($timeflood > $flood)
				{
			      return(show_error(ERR_FLOOD, 403,$heading = 'Nous Avons Rencontré Une Exception'));
				}
		}
		}
}
?>