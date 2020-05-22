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
class Home extends CI_Controller {

   	 
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
	 * @var int $bann reference to active session banned member
	 */
	public $bann;
	/** 
	 * @var string $status reference to active session state member
	 */
	public $status;
	
    /**
     * __construct initilize the class
     *
     * @return mixed
     */
	function __construct() 
	{
	parent::__construct();

	$this->load->helper(array('form','url'));
	$this->load->model(array('forum_model','config_model'));
	$this->load->library(array('encryption','alert'));
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
 * index page index
 *
 * @return void
 */
public function index()
{
	$data['render']='index';
    $data['start_time']=microtime(true);
	$data['menu']=menu_home($this->_menu());
	$data['pic']=$this->top_pic();

		$data['count_visitors']=$this->forum_model->visitors_online();
		$data['count_members']=$this->forum_model->members_online();
		$data['totalMembres']=$this->forum_model->count_users();
		
        $data['texte_a_afficher'] = "<br>Online members : ";
		$data['totalPost'] = $this->forum_model->totalPost();	

	 $data['total_topic']=$this->forum_model->count_all_topic();
	  
	  
      $data['categorie'] = NULL;
	  $data['totalcat']=$this->db->count_all_results();
	   $data['last_member'] = $this->forum_model->get_last_user();

	  $this->load->model('title_page_model');

	  $this->title_page_model->title_forum_index();
	  
	  $data['title']=$this->title_page_model->title_forum_index();
      $data['title']='forum fabb';
	  $data['render']='index';
	  $data['description']='index forum';
	  $data['keyword']='index forum';
	  $data['testimo']=$this->member_model->testimo();
	  $this->load->model('admin_model');
	  $data['admin_avatar']=$this->admin_model->admin_avatar();
	   
	  $this->display($data);

	}
	

	
//------------------------------------------------------------------------	
public function display($data)
{

	$this->load->view('inc/header',$data);
	$this->load->view('inc/topPage',$data);		
	$this->load->view('inc/navBar',$data);
	$this->load->view('welcome',$data);
	$this->load->view('inc/footer',$data);

}
//--------------------------------------------------------
public function top_pic(){
	$this->load->model('admin_model');
	  $photo=$this->admin_model->get_pics();
	  foreach($photo->result() as $pic):
	  return $pic->pic_file;
	  endforeach;
	  
	}	
	
	//----------------------- config ------------------------------------
	protected function _menu(){
				$tpid=$this->member_model->total_post_idm($this->idM);
		$ttid=$this->member_model->total_topic_idm($this->idM);
		
			  $array=array(
		     'lvl'=> $this->lvl,
		     'blink'=> 'home',
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

//-----------------------------------------------------------------------------

public function testimo(){
	
	$data['menu']=menu($this->_menu());
	$data['pic']=$this->top_pic();
    $i=0;
	if($this->idM == 0){
		$i++;
		}
	elseif($this->status==BANNED){
		$i++;		
		}
		elseif($this->status==DELETED){
		$i++;		
		}
		elseif($this->status==PENDING){
		$i++;		
		}
		if($i>0){
			exit(show_error(ERR_RIGHT, 403,$heading = 'Nous Avons Rencontré Une Exception'));

			}
		
	$this->flood_testimo();
	
	$lastime=$this->member_model->duplicate_timeflood($this->idM);
	if($lastime>0){
		
	$this->alert->set('alert-danger','Vous avez déjà laisseé un téloignage il y a '.time_elapsed($lastime).'<br>
	       Nous vous remercions de cette action, mais le témoignage est autorisé à une seule fois.'.br(4).'  
		  <a class="btn btn-primary btn-xs" href="'.base_url('home').'">Aller Page Home</a> | 
		  <a class="btn btn-primary btn-xs" href="'.base_url('forum').'">Aller Page Forum</a> 
		  ');				  
				 					$this->infos($data);
									return;	
		
		}


			  
			 /* if($query->num_rows()==FALSE){
				  
				  
				$this->load->library('alert');  
				
		  $this->alert->set('alert-danger','Votre connexion a echoué, veuillez vérifier vos identifiants.'.br(4).'  
		  <a class="btn btn-primary btn-xs" href="'.base_url().'">Aller Page Home</a> | 
		  <a class="btn btn-primary btn-xs" href="'.base_url('forum').'">Aller Page Forum</a> | 
		  <a class="btn btn-primary btn-xs" href="'.base_url('home').'">Ressayer</a>
		  ');				  
				 					
				$this->load->view('inc/header',$data);
				$this->load->view('inc/topPage',$data);
			    $this->load->view('inc/navBar',$data);								
			    $this->load->view('users/infos',$data);	
			    $this->load->view('inc/footer',$data); 
				  
				  }
			  else{
			
*/
	
			 $this->load->library('form_validation');
			 
		$this->form_validation->set_rules('message', 'Votre Témoignage','trim|required|max_length[256]');
		//|callback_check_login

		
		if($this->form_validation->run()==FALSE)
                {
					$this->index();		
                }
			
				  else{
					  				  
					 $msg='';
					  $text=$this->badword(trim($this->input->post('message',true)));
					 
					  
					  
					  
					  $array=array(
					  'testimo_idM'=>$this->idM,
					  'testimo_date'=>time(),
					  'testimo_text'=>$text
					  );
					  if($this->member_model->new_testimo($array)==TRUE){
						  $this->member_model->update_online($this->idM,$this->ip);
						  
						  
						   $this->alert->set('alert-success','Merci '.$this->pseudo.'<br>
						   Votre témoignage est ajouté avec success. Nous vous remercions de nous avoir consacré un peu de
						    votre temps. '.br(4).'  
						  <a class="btn btn-primary btn-xs" href="'.base_url('home').'">Voir témoignage</a> | 
						  <a class="btn btn-primary btn-xs" href="'.base_url('forum').'">Aller Page Forum</a>
						  ');				  
													$this->infos($data);
						  
						  }else{
							  
							  $this->alert->set('alert-danger','Nous somme désolé, l\'ajout votre témoignage a échoué.<br>
							  Veuillez réssayer ultérieurement.'.br(4).'  
		  <a class="btn btn-primary btn-xs" href="'.base_url('home').'">Aller Page Home</a> | 
		  <a class="btn btn-primary btn-xs" href="'.base_url('forum').'">Aller Page Forum</a> 
		  ');				  
				 					$this->infos($data);	  
							  }
					  
					  
					  }


}


//-------------------------------- check login -----------------------------------------------

		 public function check_login($password,$field){
			 $this->load->model('config_model');
			 // $salt=$this->config_model->salt();
				  
			  $psw=hash('sha512',$password);
			  $query=$this->member_model->check_login($psw,$field);
			   if($query->num_rows()==0){
				   
		$this->form_validation->set_message('check_login', '<span style=" font-size:11px;color:red;">Mot de passe ou identifiant est invalide.</span>');
				 return FALSE  ;
                             }
							 else{
								 
								 return TRUE;
								 }
				   
				   
		 }
//----------------------------------- anti flood -----------------------------------------
        protected function flood_testimo(){
        
        
		$timeflood=(int)$this->config_model->flood();
		
		$lastime=(int)$this->member_model->duplicate_timeflood($this->idM);
			 
		 $flood=time()-$lastime;
			if ($flood<$timeflood) {
				
				show_error(ERR_FLOOD, 403,$heading = 'Nous Avons Rencontré Une Exception');	
				return true;		

		     }
			 else{return false;}
		
		}	
	//-------------------------------------------- bad words -----------------------------				 
				 
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

	
//------------------------------------ infos ------------------------------------	
public function infos($data)
{

	$this->load->view('inc/header',$data);
	$this->load->view('inc/topPage',$data);		
	$this->load->view('inc/navBar',$data);
	$this->load->view('users/infos',$data);
	$this->load->view('inc/footer',$data);

}

}
	?>
