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
	 * badbots class honeypot for badbots
	 */ 
class Badbots extends CI_Controller
{
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
		 * __construct construct function
		 *
		 * @return void
		 */
    public function __construct()
    {
        parent::__construct();
	$this->lvl = $this->session->has_userdata('lvl')?(int)$this->session->lvl:1;	
	$this->pseudo = $this->session->has_userdata('pseudo')?$this->session->pseudo:'';
	$this->email = $this->session->has_userdata('email')?$this->session->email:'';
	$this->avatar = $this->session->has_userdata('avatar')?$this->session->avatar:'';
	$this->idM = $this->session->has_userdata('idM')?(int)$this->session->idM:0;
	$this->msg = $this->session->has_userdata('msg')?$this->session->msg:NULL;
	$this->nbr_msg = $this->session->has_userdata('nbr_msg')?$this->session->nbr_msg:0;
	$this->status = $this->session->has_userdata('status')?$this->session->status:VISITOR;		
	if(!$this->input->ip_address()){exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception'));}
	$this->ip=$this->session->has_userdata('ip')? $this->session->ip:$this->input->ip_address();
    }
    /**
     * index The default function that gets called when visiting the page 
     *
     * @return void
     */
    public function index()
    {
		$this->load->model('forum_model');
		if($this->forum_model->bad_bot($this->ip)==true){
			exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception'));	
		}else{
     	$query=dataVisitor($this->ip);
		$country=$query['country']?$query['country']:'undefined';
		$code=$query['countryCode']?$query['countryCode']:'undefined';
		$city=$query['city']?$query['city']:'undefined';
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
		    $array=array(
			         'bot_date'=>time(),
					 'bot_ip'=>$this->ip,
					 'bot_country'=>$country,
					 'bot_code'=>$code,
					 'bot_city'=>$city,
					 'bot_platform'=>$platform,
					 'bot_agent'=>$agent,
                     'bot_state'=>'1'
					);
		$this->forum_model->insert_bot($array);
		if(auth_equal($this->status,ADMIN)){
		$this->load->library('alert');
		$this->alert->set('alert-success','<p>Félicitation chère administrateur, vous vous &ecirc;tes bloqué avec succès.</p>
		<p>Rappel :: Pour vous débloquer, Veuillez insérer dans la barre d\'adresse de votre navigateur url suivante::</p>
		<p><strong>'.base_url('badbots/safeip/'.$this->idM.'/'.rawurlencode($this->ip)).'</strong></p>
		<p>Essayer d\'accéder de votre choix aux différentes pages du forum </p>
		<p>Si non, vous pouvez tester les page dont les liens sont ci-dessous. </p>
		<p><a class="btn btn-primary btn-sm" href="'.base_url('forum').'">Forum</a>
		<a class="btn btn-primary btn-sm" href="'.base_url('admin/index/'.$this->idM).'">admin</a>
		<a class="btn btn-primary btn-sm" href="'.base_url('voir/forum').'">voir forum</a></p>',TRUE);
		$this->load->view('bots/infos');
		}else exit('No data on this page');
		}
    }
/**
 * safeip  end test to self locking
 *
 * @return void
 */
public function safeip(){
    	if(auth_equal($this->uri->segment(3),$this->idM)){
		$this->load->library('alert');
        $ip=rawurldecode($this->uri->segment(4));
		$this->load->model('admin_model');
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
         if($this->admin_model->freeadmin($this->ip)==true)
		 {
		$data['render']='infos'; 	   
		$this->alert->set('alert-success','<p>Félicitation à l\'administrateur, il est sorti saint et sauve du piège.</p> 
		<p><a class="btn btn-primary btn-sm" href="'.base_url('admin/index/'.$this->idM).'">Admin</a> |  
		<a class="btn btn-primary btn-sm" href="'.base_url('forum').'">Forum</a>  | 
		<a class="btn btn-primary btn-sm" href="'.base_url('admin/gerer_robots/'.$this->idM).'">gerer robots?</a> </p>',TRUE);
	             $this->display($data);
				return;
			 }
			   else{
				   	$this->load->model('member_model');
				   $this->alert->set('alert-danger','<p>Nous somme désolés, on \'a pas pu vérifier votre adress ip. <br>
				   les causes les plus probales sont ::<br>
				   1- vous vous &ecirc;tes déjà débloqué. Essayer de vous reconnecter de nouveau avec vos identifiants.<br>
				   2- Eteindre votre router pendant 10sec et re-essayer l\'étape 1.  </p>
				   <p> Déblocage manuel (méthode sans faille) ::<br>
				   1- Accéder à votre base de donnée.<br>
				   2- Sélectionner la table et si vous n\'avez pas changé le prefix des table, elle devra &ecirc;tre <strong>
				   fabb_bots</strong>.<br>
				   3- Supprimez l\'enregistrement qui contient votre IP dans la colonne <strong> bot_ip</strong>.<br> 
				   L\'adresse IP vous a été demandé de la garder avant de procéder au test. Et que vous en aurez
				    besoin en cas de problème. </p>
					<p>',TRUE);
				$this->member_model->member_deconexion($this->idM);
		        $this->session->sess_destroy();
	             $this->display($data);
				return;
		   }
		}else exit('No data on this page');
	}	
/**
 * top_pic get img forum
 *
 * @return void
 */
public function top_pic(){
	$this->load->model('admin_model');
	  $photo=$this->admin_model->get_pics();
	  foreach($photo->result() as $pic):
	  return $pic->pic_file;
	  endforeach;
	}	
	/**
	 * _menu get forum menu
	 *
	 * @return void
	 */
	protected function _menu(){
		$this->load->model('member_model');
				$tpid=$this->member_model->total_post_idm($this->idM);
		$ttid=$this->member_model->total_topic_idm($this->idM);
			  $array=array(
		     'lvl'=> $this->lvl,
		     'blink'=> 'forum',
		     'msg'=> $this->msg,
		     'nbr_msg'=> $this->nbr_msg,
		     'avatar'=> $this->avatar,			 			 			 		
		     'pseudo'=> $this->pseudo,		
		     'email'=> $this->email,
			 'status'=> $this->status,
			 'idM'=>$this->idM,	
			 'tpid'=>$tpid,
			 'ttid'=>$ttid,		
		);
		return $array;
		}	
/**
 * display fire data to display them
 *
 * @param  mixed $data
 * @return void
 */
public function display($data)
{
	$this->load->view('inc/header',$data);
	$this->load->view('inc/topPage',$data);		
	$this->load->view('inc/navBar',$data);
	$this->load->view('bots/infos',$data);
	$this->load->view('inc/footer',$data);
}
}
/* End of file captcha.php */
/* Location: ./application/controllers/captcha.php */