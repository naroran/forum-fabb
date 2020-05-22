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
class Poster extends CI_Controller {
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
	/**
	 * __construct
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url','func'));
		$this->load->model(array('poster_model','msgs_model', 'config_model','forum_model'));
		$this->load->library(array('form_validation','bbcode','alert'));
		$this->lvl = $this->session->has_userdata('lvl')?$this->session->lvl:1;
		$this->pseudo = $this->session->has_userdata('pseudo')?$this->session->pseudo:'';
		$this->email = $this->session->has_userdata('email')?$this->session->email:'';
		$this->avatar = $this->session->has_userdata('avatar')?$this->session->avatar:'';
		$this->idM = $this->session->has_userdata('idM')?$this->session->idM:0;
		$this->msg = $this->session->has_userdata('msg')?$this->session->msg:NULL;
		$this->nbr_msg = $this->session->has_userdata('nbr_msg')?$this->session->nbr_msg:0;
		$this->status = $this->session->has_userdata('status')?$this->session->status:VISITOR;
		$this->bann = $this->session->has_userdata('bann')?$this->session->bann:BANNED;
		if(!$this->input->ip_address()){show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception');}
		$this->ip= $this->session->has_userdata('ip')?$this->session->ip:$this->input->ip_address();
		if($this->bann){show_error(ERR_BANN, 403,$heading = 'Nous Avons Rencontré Une Exception');}
		if($this->forum_model->bad_bot($this->ip)==true){show_error(ERR_HACK, 403,$heading = 'Nous Avons
		Rencontré Une Exception');}
		if(auth_deny($this->status,MEMBER)){show_error(ERR_NOT_CONNECTED, 403,$heading = 'Nous Avons Rencontré Une Exception');}
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
	 * index send member to default page 
	 *
	 * @return void
	 */
	public function index(){
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['title']='poster message';
		$data['render']='';
		switch($this->lvl){
		case MEMBER:
		$view='member/index';
		break;
		case MODO:
		$view='modo/index';
		break;
		case ADMIN:
		$view='admin/index';
		break;
		}				
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
	}
		
	/**
	 * add_topic let me add a topic
	 *
	 * @return void
	 */
	function add_topic(){
		$this->_check_flood('add_topic');
		$data['menu']=menu($this->_menu());
		$this->load->model('title_page_model');
		$data['pic']=$this->top_pic();
		$data['title']=$this->title_page_model->title_forum_index();
		$forum=(int)$this->uri->segment(3);
		$data['forum']=$this->poster_model->get_data_forum($forum);
		$this->form_validation->set_rules('titre', 'Titre', 'required|trim|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('message', 'Message', 'required|min_length[32]|max_length[3000]');
		if ($this->form_validation->run() == FALSE)
		{
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('forum/new_topic',$data);
		$this->load->view('inc/footer',$data);
		}
		else{    
		$array=array('topic_forum_id'=>$forum,
		'topic_title'=>$this->badword($this->input->post('titre')),
		'topic_owner'=>$this->idM,
		'topic_viewed'=>'1',					
		'topic_time'=>time(),
		'topic_sort'=>$this->input->post('mess'));
		$new_topic=$this->poster_model->insert_new_topic($array);
		$array=array(
		'post_owner'=> $this->idM,
		'post_text'=>$this->badword($this->input->post('message')),
		'post_time'=>time(),
		'post_topic_id'=> $new_topic,
		'post_forum_id'=>$forum);
		$new_post=$this->poster_model->insert_into_post($array);
		$this->poster_model->update_first_and_lastpost($new_post,$new_topic);	
		$this->poster_model->update_forum($new_post,$forum);
		$post='member_post+1';
		$this->poster_model->update_members($post,$this->idM);
		$array=array(
		'tv_id'=>$this->idM,
		'tv_topic_id'=>$new_topic,
		'tv_forum_id'=>$forum,
		'tv_post_id'=>$new_post,
		'tv_post'=>'1'		
		);
		$this->poster_model->insert_tv($array);
		$array=array('flood_ip'=>$this->ip,
		'flood_time'=>time(),
		'flood_idm'=>$this->idM,
		'flood_act'=>'add_topic'
		 );
		$query=$this->msgs_model->time_flood($this->idM,'add_topic');
		if($query->num_rows()>0){
		$this->msgs_model->update_flood($this->idM,'add_topic');
		}
		else {$this->msgs_model->insert_flood($array);
		}
		$data['menu']=menu($this->_menu()); 
		$data['pic']=$this->top_pic();
		$data['render']='infos';
		switch($this->lvl){
		case MEMBER:
		$panel='U-panel';
		$view='member/index';
		$url='member/index/'.$this->idM;
		break;
		case MODO:
		$panel='M-panel';
		$view='modo/index';
		$url='modo/index/'.$this->idM;
		break;
		case ADMIN:
		$panel='A-panel';
		$view='admin/index';
		$url='admin/index/'.$this->idM;
		break;
		}
		$this->alert->set('alert-success','Le topic a été ajouté avec succes.'.br(2).'
		<a class="btn btn-success btn-sm" href="'.base_url('voir/topic/'.$new_topic).'"> Voir le topic </a> |
		<a class="btn btn-success btn-sm" href="'.base_url($url).'"> '.$panel.' </a> |
		<a class="btn btn-success btn-sm" href="'.base_url('voir/forum/'.$forum).'"> Forum </a> | 
		<a class="btn btn-success btn-sm" href="'.$this->agent->referrer().'"> Retour </a>');				
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
		}
	}	
	/**
	 * reply add reply
	 *
	 * @return void
	 */
	public function reply(){
		$this->_check_flood('reply_post');
		$topic=(int)$this->uri->segment(3);	
		$data['menu']=menu($this->_menu());
		$this->load->model('title_page_model');
		$data['pic']=$this->top_pic();
		$data['title']=$this->title_page_model->title_forum_index();
		if($this->poster_model->locked_topic($topic)==TRUE)
		{
		show_error(ERR_TOPIC_VERR, 403,$heading = 'Nous Avons Rencontré Une Exception');
		}
		$data['rep']=$this->poster_model->get_reply_topic($topic);
		$this->form_validation->set_rules('message','Message', 'required|min_length[3]');
		if ($this->form_validation->run() == FALSE)
		{
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);				 
		$this->load->view('inc/navBar',$data);
		$this->load->view('forum/new_post',$data);
		$this->load->view('inc/footer',$data);
		}	
		else
		{
		$message = $this->badword($this->input->post('message',true));
		$rep=$this->poster_model->reply_id_forum($topic);
		foreach($rep->result() as $value):
		$forum = $value->topic_forum_id;
		$nbr_post=$value->topic_post;
		endforeach;
		$arraypost=array('post_owner'=> $this->idM,
		'post_text'=>$message,
		'post_time'=>time(),
		'post_topic_id'=>$topic,
		'post_forum_id'=>$forum
		);
		$newpost=$this->poster_model->insert_into_post($arraypost);
		$this->poster_model->update_topic($newpost,$topic);
		$this->poster_model->update_reply_forum($newpost,$forum);
		$this->poster_model->update_reply_membre($this->idM);
		$this->poster_model->update_forum_topic_view($newpost,$this->idM,$topic);
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['title']=$this->title_page_model->title_forum_index();
		$array=array('flood_ip'=>$this->ip,
		'flood_time'=>time(),
		'flood_idm'=>$this->idM,
		'flood_act'=>'reply_post'
		 );
		$query=$this->msgs_model->time_flood($this->idM,'reply_post');
		if($query->num_rows()>0){
		$this->msgs_model->update_flood($this->idM,'reply_post');
		}
		else {$this->msgs_model->insert_flood($array);
		}
		switch($this->lvl){
		case MEMBER:
		$panel='U-panel';
		$view='member/index';
		$url='member/index/'.$this->idM;
		break;
		case MODO:
		$panel='M-panel';
		$view='modo/index';
		$url='modo/index/'.$this->idM;
		break;
		case ADMIN:
		$panel='A-panel';
		$view='admin/index';
		$url='admin/index/'.$this->idM;
		break;
		}
		$data['render']='infos';
		$this->alert->set('alert-success','<p>Votre réponse est ajouté avec succes.'.br(2).'
		'.anchor_popup('poster/lastpost/'.$topic.'/'.$newpost,'Voir la réponse',array('class'=>'btn btn-primary btn-sm')).' | 
		<a class="btn btn-success btn-sm" href="'.base_url('voir/topic/'.$topic).'">Voir topic </a> |
		<a class="btn btn-success btn-sm" href="'.base_url($url).'">'.$panel.' </a>
		</p>
		',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);		
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
		} 
	}			
	/**
	 * editer_post edit post
	 *
	 * @return void
	 */
	public function editer_post(){
		$this->_check_flood('edit_post');
		$data['menu']=menu($this->_menu());
		$this->load->model('title_page_model');
		$data['pic']=$this->top_pic();
		$data['title']=$this->title_page_model->title_forum_index();
		$post=(int)$this->uri->segment(3);
		$edit=$this->poster_model->check_createur_post($post);
		if($edit->num_rows()==0){
		show_error(POST_NOT_EXISTS, 403,$heading = 'Nous Avons Rencontré Une Exception');
		}
		foreach($edit->result() as $value){
		$topic=$value->post_topic_id;
		$auth_modo=$value->forum_auth_modo;
		$post_owner=$value->post_owner;
		$post_time=$value->post_time;
		$text_edit=$value->post_text;
		}
		if (auth_deny($this->status,MEMBER)&& $post_owner != $this->idM){
		show_error(ERR_AUTH_EDIT, 403,$heading = 'Nous Avons Rencontré Une Exception');
		}
		else{
		$data['post']=&$post;
		//----------------------------------------------------
		$data_post= $this->poster_model->post_data($post);
		foreach($data_post->result() as $respost){
		$topic=$respost->post_topic_id;
		$data['topic_id']=&$topic;
		$data['post_text']=$respost->post_text;		
		}
		$data_topic= $this->poster_model->topic_data($topic);
		foreach($data_topic->result() as $resptopic){
		$forum_id=$resptopic->topic_forum_id;
		$data['forum_id']=&$forum_id;				
		$data['topic_titre']=$resptopic->topic_title;
		$data['topic_createur']=$resptopic->topic_owner;		
		}
		$data_forum= $this->poster_model->forum_data($forum_id);
		foreach($data_forum->result() as $respforum){
		$data['forum_name']=$respforum->forum_name;
		}
		$data_text= $this->poster_model->createur_post((int)$this->uri->segment(3));
		foreach($data_text->result() as $text){
		$editeur_text=$text->post_text;
		}
		$this->form_validation->set_rules('message', 'Message', 'required|min_length[3]|max_length[3000]');
		if ($this->form_validation->run() == FALSE){	
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('forum/edit_post',$data);
		$this->load->view('inc/footer');
		}else{
		$message = $this->badword(trim($this->input->post('message')));
		$this->poster_model->update_edit_post($message,$post);
		$this->poster_model->update_topic_vu($topic);
		$array=array('flood_ip'=>$this->ip,
		'flood_time'=>time(),
		'flood_idm'=>$this->idM,
		'flood_act'=>'edit_post'
		 );
		if($this->msgs_model->has_post($this->ip,'edit_post') > 0)
		{
		$this->msgs_model->update_flood($this->idM,'edit_post');
		}
		else {$this->msgs_model->insert_flood($array);
		}
		switch($this->lvl){
		case MEMBER:
		$panel='U-panel';
		$view='member/index';
		$url='member/index/'.$this->idM;
		break;
		case MODO:
		$panel='M-panel';
		$view='modo/index';
		$url='modo/index/'.$this->idM;
		break;
		case ADMIN:
		$panel='A-panel';
		$view='admin/index';
		$url='admin/index/'.$this->idM;
		break;
		}
		$data['render']='infos';
		$this->alert->set('alert-success','<p>Votre post a été édité avec succes.'.br(2).'
		<a class="btn btn-success btn-sm" href="'.$this->agent->referrer().'"> Retour </a> |
		<a class="btn btn-success btn-sm" href="'.base_url($url).'"> '.$panel.' </a> | 
		'.anchor_popup('poster/view_edit_post/'.$post,'Voir le Post?',array('class'=>'btn btn-primary btn-sm')).'</p>
		',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);		
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
		}	
		}				
		}
	
	/**
	 * delete_post delete post
	 *
	 * @return void
	 */
	public function delete_post(){
		$this->_check_flood('delete_post');
		$data['menu']=menu($this->_menu());
		$this->load->model('title_page_model');
		$data['pic']=$this->top_pic();
		$data['title']=$this->title_page_model->title_forum_index();
		$post=(int)$this->uri->segment(3);
		$data['post']=&$post;
		$data_edit=$this->poster_model->check_createur_post($post);
		foreach($data_edit->result() as $val)
		{
		$topic=$val->post_topic_id;
		$post_createur=$val->post_owner;
		$post_time=$val->post_time;
		$text_edit=$val->post_text;
		$forumid=$val->post_forum_id;
		$pseudo_createur=$val->member_pseudo;						
		}
		if (auth_deny($this->status,MEMBER) && $val->post_owner != $this->idM)
		{

		show_error(ERR_AUTH_DELETE, 403,$heading = 'Nous Avons Rencontré Une Exception');
		}
		else{
		$array=array('flood_ip'=>$this->ip,
		'flood_time'=>time(),
		'flood_idm'=>$this->idM,
		'flood_act'=>'delete'
		 );
		$query=$this->msgs_model->time_flood($this->idM,'delete_post');
		if($query->num_rows()>0){
		$this->msgs_model->update_flood($this->idM,'delete_post');
		}
		else {$this->msgs_model->insert_flood($array);
		}
		switch($this->status){
		case MEMBER:
		$panel='U-panel';
		$view='member/index';
		$url='member/index/'.$this->idM;
		break;
		case MODO:
		$panel='M-panel';
		$view='modo/index';
		$url='modo/index/'.$this->idM;
		break;
		case ADMIN:
		$panel='A-panel';
		$view='admin/index';
		$url='admin/index/'.$this->idM;
		break;
		}	
		if($post_createur==$this->idM){
		$owner='vous-m&ecirc;me';
		}else{
		$owner=$pseudo_createur;
		}	  
		$data['render']='infos';
		$this->alert->set('alert-danger','<p>Êtes vous certains de vouloir supprimer le post ::<strong> #'.$post.'</strong>, creé par '.$owner.', le '.date('d-m-Y à H:i:s',$post_time).' ?</p>
		<p><a class="btn btn-danger btn-sm" href="'.base_url('supprimer/post/'.$post.'/'.$topic).'">Supprimer</a> | 
		<a class="btn btn-success btn-sm" href="'.$this->agent->referrer().'">Retour</a> | 
		<a class="btn btn-success btn-sm" href="'.base_url($url).'">'.$panel.'</a> | 
		</p>',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
		}
	}
	
	/**
	 * del_post please confirm to delete post
	 *
	 * @return void
	 */
	public function del_post(){
		$data['menu']=menu($this->_menu());
		$this->load->model('title_page_model');
		$data['pic']=$this->top_pic();
		$data['title']=$this->title_page_model->title_forum_index();
		$post=$this->uri->segment(3);
		if($this->poster_model->check_post($post)==false)
		{
		$data['render']='infos';
		switch($this->lvl){
		case MEMBER:
		$panel='U-panel';
		$view='member/index';
		$url='member/index/'.$this->idM;
		break;
		case MODO:
		$panel='M-panel';
		$view='modo/index';
		$url='modo/index/'.$this->idM;
		break;
		case ADMIN:
		$panel='A-panel';
		$view='admin/index';
		$url='admin/index/'.$this->idM;
		break;
		}
		$this->alert->set('alert-warning','<p>Ce post est déjà supprimé ou n\'a jamais éxisté.</p>
		<p>
		<a class="btn btn-danger btn-sm" href="'.base_url('forum').'">Retour forum</a> | 
		<a class="btn btn-danger btn-sm" href="'.base_url($url).'">'.$panel.'</a>		   
		</p>',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
		return;
		}
		$resp=$this->poster_model->check_createur_post($post);
		foreach($resp->result() as $val)
		{
		$topic = $val->post_topic_id;
		$poster = $val->post_owner;
		$post_time = $val->post_time;
		$text_edit = $val->post_text;
		$forum = $val->post_forum_id;
		}
		if (auth_deny($this->status,MODO) && $poster != $this->idM && $topic!==$this->uri->segment(4))
		{
		show_error(ERR_AUTH_DELETE, 403,$heading = 'Nous Avons Rencontré Une Exception');
		}
		else 
		{
		$ordre_post=$this->poster_model->ordre_du_post($topic);
		foreach($ordre_post->result() as $row)
		{
		$first_post=$row->topic_firstpost;
		$last_post=$row->topic_lastpost;
		}
		if ($first_post==$post) 
		{
		if (auth_deny($this->status,MODO))
		{
		$data['render']='infos';
		$this->alert->set('alert-danger','<p>'.ERR_AUTH_DELETE_TOPIC.'</p>',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('member/index',$data);
		$this->load->view('inc/footer',$data);
		return;
		}
		$data['render']='infos';
		switch($this->lvl){
		case MODO:
		$panel='M-panel';
		$view='modo/index';
		$url='modo/index/'.$this->idM;
		break;
		case ADMIN:
		$panel='A-panel';
		$view='admin/index';
		$url='admin/index/'.$this->idM;
		break;
		}
		$this->alert->set('alert-danger','<p>Vous avez choisi de supprimer un post.
		Cependant ce post est le premier du topic autour duquel la discussion est ouverte . Voulez vous vraiment supprimer le topic ?</p>
		<p class="text-center"> 
		<a class="btn btn-danger btn-sm" href="'.base_url('delete/topic/'.$topic.'/'.$forum).'">Supprimer</a> | 
		<a class="btn btn-success btn-sm" href="'.base_url('voir/topic/'.$topic).'">Annuler</a>
		</p>',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
		return;
		}
		elseif ($last_post==$post)  
		{
		if (auth_deny($this->status,MEMBER) && $poster != $this->idM && $topic!==$this->uri->segment(4))
		{
		$data['render']='infos';
		$this->alert->set('alert-danger','<p>'.ERR_AUTH_DELETE.'</p>',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('member/index',$data);
		$this->load->view('inc/footer',$data);
		return;
		}
		$this->poster_model->delete_post($post);
		$lpost=$this->poster_model->modify_topic_last_post($topic);
		foreach($lpost->result() as $row)
		{
		$last_post=$row->post_id;
		}
		$this->poster_model->update_lastpost_topic($last_post,$topic);	
		$this->poster_model->update_msg_lastpost_forum($last_post, $forum);
		
		$this->poster_model->update_post_topic($topic);
		$this->poster_model->update_post_member($poster);
		$data['render']='infos';
		switch($this->lvl){
		case MEMBER:
		$panel='U-panel';
		$view='member/index';
		$url='member/index/'.$this->idM;
		break;
		case MODO:
		$panel='M-panel';
		$view='modo/index';
		$url='modo/index/'.$this->idM;
		break;
		case ADMIN:
		$panel='A-panel';
		$view='admin/index';
		$url='admin/index/'.$this->idM;
		break;
		}			
		// et un msg
		$this->alert->set('alert-success','<p>Le message a été supprimé avec succes  ...!<br><br>
		<a class="btn btn-success btn-sm" href="'.base_url('voir/topic/'.$topic).'">Retour au topic</a> 
		<a class="btn btn-success btn-sm" href="'.base_url($url).'">'.$panel.'</a>
		<a class="btn btn-success btn-sm" href="'.base_url('forum').'"> forum</a></p>',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
		}
		else 
		{
		$this->poster_model->delete_post($post);
		$this->poster_model->update_post_forum($forum);          
		$this->poster_model->update_post_topic($topic);
		$this->poster_model->update_post_member($poster);
		$data['render']='infos';
		switch($this->lvl){
		case MEMBER:
		$panel='U-panel';
		$view='member/index';
		$url='member/index/'.$this->idM;
		break;
		case MODO:
		$panel='M-panel';
		$view='modo/index';
		$url='modo/index/'.$this->idM;
		break;
		case ADMIN:
		$panel='A-panel';
		$view='admin/index';
		$url='admin/index/'.$this->idM;
		break;
		}		
		// et un msg
		$this->alert->set('alert-success','<p>Le message a été supprimé avec succes  ...!<br />
		<a class="btn btn-success btn-sm" href="'.base_url('voir/topic/'.$topic).'">topic</a> | 
		<a class="btn btn-success btn-sm" href="'.base_url($url).'">'.$panel.'</a> | 
		<a class="btn btn-success btn-sm" href="'.base_url('forum').'"> forum</a></p>',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
		}
		}
	}
//----------------------------------------------------------------------------------------				
	/**
	 * delete_topic delete disered topic
	 *
	 * @return void
	 */
	public function delete_topic(){	
		$this->_check_flood('delete_topic');
		$data['menu']=menu($this->_menu());
		$this->load->model('title_page_model');
		$data['pic']=$this->top_pic();
		$data['title']=$this->title_page_model->title_forum_index();
		$topic=(int)$this->uri->segment(3);
		$forum=(int)$this->uri->segment(4);
		if (auth_deny($this->status,MODO))
		{
		$this->load->library('alert');
		$this->alert->set('alert-danger','<p>'.ERR_AUTH_DELETE_TOPIC.br(2).
		anchor('contact','contact',array('class'=>'btn btn-primary btn-sm')).' | '. 
		anchor('voir/topic/'.$topic,'Retour',array('class'=>'btn btn-primary btn-sm')).'</p>',TRUE);
		$data['render']='infos';
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);		
		$this->load->view('inc/navBar',$data);
		$this->load->view('member/index',$data);
		$this->load->view('inc/footer',$data);
		}
		else 
		{
		$query=$this->poster_model->nbr_post_topic($topic);
		foreach($query->result() as $val)
		{
		$nbr_post=$val->nbr_post;
		}
		$this->poster_model->update_nbr_msg_members($topic);
		$this->poster_model->delete_topic($topic);	
		$lastpost=$this->poster_model->lastpost_topic($forum);		
		$this->poster_model->update_fabb_forum($nbr_post,$lastpost,$forum);
		//   et un msg
		$this->load->library('alert');
		$array=array('flood_ip'=>$this->ip,
		'flood_time'=>time(),
		'flood_idm'=>$this->idM,
		'flood_act'=>'delete'
		 );
		$query=$this->msgs_model->time_flood($this->idM,'delete_topic');
		if($query->num_rows()>0){
		$this->msgs_model->update_flood($this->idM,'delete_topic');
		}
		else {$this->msgs_model->insert_flood($array);
		}
		$data['render']='infos';
		switch($this->lvl){
		case MODO:
		$panel='M-panel';
		$view='modo/index';
		$url='modo/index/'.$this->idM;
		break;
		case ADMIN:
		$panel='A-panel';
		$view='admin/index';
		$url='admin/index/'.$this->idM;
		break;
		}				
		$this->alert->set('alert-success','<p>Le topic a été supprimé avec succès !<br /></p>
		<p> <a class="btn btn-success btn-sm" href="'.base_url('forum').'">Retour forum</a> | 
		<a class="btn btn-success btn-sm" href="'.base_url($url).'">'.$panel.'</a></p>
		',TRUE);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);	
		$this->load->view('inc/navBar',$data);
		$this->load->view($view,$data);
		$this->load->view('inc/footer',$data);
		} //Fin du else		
	}		
	/**
	 * _menu shows menu app
	 *
	 * @return void
	 */
	protected function _menu(){
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
		'idM'=>$this->idM	,
		'tpid'=>$tpid,
		'ttid'=>$ttid,		
		);
		return $array;
		}	
		//---------------------------- top picture --------------------------------------		
		/**
		 * top_pic top image
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
		//----------------------------------- anti flood -----------------------------------------		
		/**
		 * _check_flood chack anti flood post
		 *
		 * @param  mixed $act
		 * @return void
		 */
		protected function _check_flood($act){
		$timeflood=$this->config_model->flood();
		$query=$this->msgs_model->time_flood($this->idM,$act);
		foreach($query->result() as $val){
		$posttime=$val->flood_time;
		if($posttime>=time()-$timeflood){
		show_error(ERR_FLOOD, 403,$heading = 'Nous Avons Rencontré Une Exception');	 
		break;
		}
		}
	}		
//-------------------------------------------- bad words -----------------------------				 	
	/**
	 * badword check if bad word exists
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
//-----------------------------------------------------------------------------	
	/**
	 * lastpost shows last post
	 *
	 * @return void
	 */
	public function lastpost(){
		$t=$this->uri->segment(3);
		$p=$this->uri->segment(4);	
		$data['topic']=$this->forum_model->topic_lastpost($t,$p);
		$data['t']=&$t;
		$data['p']=&$p;
		$data['menu']=menu($this->_menu());	
		$this->load->view('forum/lastpost',$data);
	}
//-----------------------------------------------------------------------------	
	/**
	 * view_edit_post how u fil your edited post
	 *
	 * @return void
	 */
	public function view_edit_post(){
		$post=$this->uri->segment(3);	
		$data['data_post']=$this->forum_model->view_edit_post($post);
		$data['post']=&$post;
		$data['menu']=menu($this->_menu());	
		$this->load->view('forum/view_edit_post',$data);
	}
}		 