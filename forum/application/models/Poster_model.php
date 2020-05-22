<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Poster_model extends CI_Model {
function __construct() {
parent::__construct();
}
public function get_data_forum($forum){ 
return $this->db->where('forum_id',$forum)
->get('fabb_forum');
}
//------------------------- add topic---------------------------------------------------
public function insert_new_topic($data){
$this->db->insert('fabb_topic', $data);
return $this->db->insert_id();
}			
//--------------------------------------------------------------------------------------
public function insert_into_post($data){
$this->db->insert('fabb_post',$data);
return $this->db->insert_id(); 
}		
//--------------------------------------------------------------------------------
public function update_first_and_lastpost($newpost,$newtopic){	
$this->db->set('topic_lastpost',$newpost);
$this->db->set('topic_firstpost',$newpost);
$this->db->where('topic_id',$newtopic);
$this->db->update('fabb_topic');
return $this->db->affected_rows();
}	
//--------------------------------------------------------		
public function update_forum($newpost,$forum){
$this->db->set('forum_post','forum_post + 1',false);
$this->db->set('forum_topic','forum_topic + 1',false);
$this->db->set('forum_last_post_id',$newpost);
$this->db->where('forum_id',$forum); 
$this->db->update('fabb_forum');
return $this->db->affected_rows();			
}			
//-------------------------------------------------------------------
public function update_members($post,$id){
$this->db->set('member_post',$post,false);
$this->db->where('member_id',$id);
$this->db->update('fabb_members');
return $this->db->affected_rows();
}			
//----------------------------------- topic locked --------------------------------------------------
public function locked_topic($topic){	
$this->db->select('topic_locked');			 			 
$this->db->where('topic_id',$topic);
$query=$this->db->get('fabb_topic');
foreach($query->result() as $val):
$locked=$val->topic_locked;
endforeach;
if($locked==1)return TRUE;
else return FALSE;
}			  
//-------------------------- add post------------------------------------------------------
public function get_reply_topic($topic){
$this->db->select('topic_id, topic_title, fabb_topic.topic_forum_id,
forum_name, forum_auth_view, forum_auth_post, forum_auth_topic, forum_auth_annonce, forum_auth_modo');
$this->db->JOIN('fabb_forum','fabb_forum.forum_id = fabb_topic.topic_forum_id','left');
$this->db->where('topic_id',$topic);
return $this->db->get('fabb_topic');
}			  
//------------------------------ d'ont modify url topic number -----------------------------			  
public function max_topic(){
$this->db->select_max('topic_id', 'max_topic');
return $this->db->get('fabb_topic');			 
}				  
//---------------------------------------------------------------------------------------------
public function reply_id_forum($topic){
$this->db->select('topic_forum_id, topic_post');
$this->db->where('topic_id',$topic);
return $this->db->get('fabb_topic');	
}	
//-------------------------------------------------------------------------------------------
public function update_topic($newpost,$topic){
$this->db->set('topic_post','topic_post+1',FALSE);
$this->db->set('topic_lastpost',$newpost);	
$this->db->where('topic_id',$topic);
$this->db->update('fabb_topic');			
return $this->db->affected_rows();
}			  
public function update_reply_forum($newpost,$forum){
$this->db->set('forum_post','forum_post+1',FALSE);
$this->db->set('forum_last_post_id',$newpost);		
$this->db->where('forum_id',$forum);	  
$this->db->update('fabb_forum');
return $this->db->affected_rows();
}			  
//--------------------mettre à jour forum_membre------------------------
public function update_reply_membre($id){
$this->db->set('member_post','member_post+1',FALSE);
$this->db->where('member_id',$id);	
$this->db->update('fabb_members');	
return $this->db->affected_rows();
}			  
//------------------------------------------------ forum_topic_view -----------------------------
public function update_forum_topic_view($post,$id,$topic){	
$this->db->set('tv_post_id',$post);
$this->db->set('tv_post','1');			 			 
$this->db->where('tv_id',$id);
$this->db->where('tv_topic_id',$topic);
$this->db->update('fabb_topic_view');
return $this->db->affected_rows();			 			 		 
}			  
//-------------------------editer post----------------------------------------------------------
public function check_createur_post($post){
$this->db->select('post_owner,forum_id, post_text, post_time, post_topic_id, post_forum_id,member_pseudo');
$this->db->join('fabb_members', 'fabb_post.post_owner = fabb_members.member_id','left');	
$this->db->join('fabb_forum', 'fabb_post.post_forum_id = fabb_forum.forum_id','left');
$this->db->where('post_id',$post);
return $this->db->get('fabb_post');
}			  
//--------------------------------------------------------------------
public function post_data($post){
$this->db->where('post_id',$post);
return $this->db->get('fabb_post');
}
//--------------------------------------------------------------------
public function check_post($post){
$this->db->select('post_topic_id');
$this->db->where('post_id',$post);	
$this->db->order_by('post_topic_id','DESC');
$this->db->limit(1);
$query=$this->db->get('fabb_post');
if($query->num_rows()>0){
foreach($query->result() as $val):
return $val->post_topic_id;
endforeach;
}
else{
return false;}
}
//-------------------------------------------------------------------------------
public function topic_data($topic){
$this->db->where('topic_id',$topic);
return $this->db->get('fabb_topic');
}			  
//--------------------------------------------------------------------------------------
public function forum_data($forum){
$this->db->where('forum_id',$forum);
return $this->db->get('fabb_forum');
}
//-----------------------------------------------------------------------------------------------
public function createur_post($post){
$this->db->select('post_text');
$this->db->where('post_id',$post);
return $this->db->get('fabb_post');
}	
//------------------------------------------------------------------------------------------------------------
public function update_edit_post($msg,$post){
$this->db->set('post_text',$msg);
$this->db->set('post_time',time());
$this->db->where('post_id', $post);
$this->db->update('fabb_post');
return $this->db->affected_rows();
}	
//----------------------------------- add one view to this topic -----------------------------
public function update_topic_vu($id){
$this->db->set('topic_viewed','topic_viewed + 1',FALSE);
$this->db->where('topic_id', $id);
$this->db->update('fabb_topic');
return $this->db->affected_rows();
}	
//-------------------------- add to forum tv --------------------------------------------
public function insert_tv($array){
return $this->db->insert('fabb_topic_view',$array);
}	
public function get_id_forum($topic){
$this->db->select('topic_titre, forum_topic.forum_id,
forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo');
$this->db->join('forum_forum', 'forum_forum.forum_id = forum_topic.forum_id', 'left');
$this->db->where('topic_id',$topic);
return $this->db->get(' forum_topic');	
}
public function get_data_post($post){
$this->db->select('post_createur, forum_post.topic_id, topic_titre, forum_topic.forum_id,
forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo');
$this->db->from('forum_post');
$this->db->join('forum_topic', 'forum_topic.topic_id = forum_post.topic_id', 'left');
$this->db->join('forum_forum', 'forum_forum.forum_id = forum_topic.forum_id', 'left');
$this->db->where('forum_post.post_id',$post);
return $this->$db->get(); 
}
//------------------------------------------------------------------------------------------------
public function get_link_editable_post($topic,$time){
$this->db->select('COUNT(*) AS nbr');
$this->db->where('topic_id',$topic);
$this->db->where('post_time<',$time);
return $query=$this->db->get('forum_post');
} 
//---------------------------- ordre du post -----------------------------------
public function ordre_du_post($topic){
$this->db->select('topic_firstpost, topic_lastpost'); 
$this->db->where('topic_id=',$topic);
return $this->db->get('fabb_topic');
}
//---------------------------- delete post -----------------------------------
public function delete_post($post){
$this->db->where('post_id',$post);
$this->db->delete('fabb_post'); 
return $this->db->affected_rows();		
}
public function modify_topic_last_post($topic){
$this->db->select('post_id');
$this->db->where('post_topic_id',$topic);
$this->db->order_by('post_id','DESC');
$this->db->limit(1);
return $this->db->get('fabb_post');
}	
public function modify_forum_last_post_id($forum){
$this->db->select('post_id');
$this->db->where('post_forum_id',$forum);
$this->db->order_by('post_id','DESC');
$this->db->limit(1);
return $this->db->get('fabb_post');
}
//------------------------------------------------------
public function update_lastpost_topic($last,$topic){
$this->db->set('topic_lastpost',$last);
$this->db->where('topic_id',$topic);
$this->db->update('fabb_topic');
return $this->db->affected_rows();
}
//---------------------------------------------------------
public function update_msg_lastpost_forum($last, $forum){
$this->db->set('forum_post','forum_post-1',FALSE);
$this->db->set('forum_last_post_id', $last);			
$this->db->where('forum_id',$forum);
$this->db->update('fabb_forum');
return $this->db->affected_rows();
}
public function update_post_topic($topic){
$this->db->set('topic_post','topic_post-1',false);
$this->db->where('topic_id',$topic);
$this->db->update('fabb_topic');
return $this->db->affected_rows();
}
public function update_post_member($id){			
$this->db->set('member_post','member_post-1',FALSE);
$this->db->where('member_id',$id);
$this->db->update('fabb_members');
return $this->db->affected_rows();           
}
//----------------------------------------------------------------------------------------			
public function update_post_forum($forum){
$this->db->set('forum_post','forum_post-1',FALSE);
$this->db->where('forum_id',$forum);
$this->db->update('fabb_forum');
return $this->db->affected_rows();
}
//---------------------------------------------------------------------------------
public function get_forum_id($topic){
$this->db->select('topic_id,forum_id,forum_auth_modo');
$this->db->join('fabb_forum', 'fabb_topic.topic_forum_id = fabb_forum.forum_id','left');		 
$this->db->where('topic_id',$topic);
return $this->db->get('fabb_topic');
}
//---------------------------------------------------------------------------------
public function nbr_post_topic($topic){
$this->db->select('COUNT(post_id) AS nbr_post');		 
$this->db->where('post_topic_id',$topic);
return $this->db->get('fabb_post');
}
//---------------------------------------------------------------------------------	
public function delete_topic($topic){
$this->db->where('topic_id',$topic);
$query=$this->db->delete('fabb_topic');
return $this->db->affected_rows();	
}
//----------------------------------------------------------------------------------
public function update_nbr_msg_members($topic){
$this->db->select('post_owner,COUNT(post_id) AS nbr_post');	 
$this->db->where('post_topic_id',$topic);
$this->db->group_by('post_owner');
$query=$this->db->get('fabb_post');
foreach($query->result() as $val):
$this->db->set('member_post','member_post-'.$val->nbr_post,FALSE);
$this->db->where('member_id',$val->post_owner);
$this->db->update('fabb_members'); 
endforeach;
return $this->db->affected_rows();
}
//----------------------------------------------------------------------------------
public function delete_topic_forum_post($topic){
$this->db->where('post_topic_id',$topic);
$query=$this->db->delete('fabb_post'); 		
return $this->db->affected_rows();
}
//------------------------------------------------
public function last_post_forum($forum){
$this->db->select('post_id');
$this->db->where('post_forum_id',$forum);				
$this->db->order_by('post_id','DESC');
$this->db->limit(1);
return $this->db->get('fabb_post');				
}
//------------------------------------------------
public function lastpost_topic($forum){
$this->db->select('topic_lastpost,topic_id');
$this->db->where('topic_forum_id',$forum);				
$this->db->order_by('topic_id','DESC');
$this->db->limit(1);
$query= $this->db->get('fabb_topic');
if($query->num_rows()==false){
return FALSE;
}else{
foreach($query->result() as $val):
$id=$val->topic_lastpost;
endforeach;
return $id;
}				
}		
//---------------------------------------------------------------------------------	
public function update_fabb_forum($nbr,$id,$forum){
$this->db->set('forum_topic','forum_topic-1',FALSE);
if($nbr>0){
$this->db->set('forum_post','forum_post-'.$nbr,FALSE);
}
if($id===FALSE){
$this->db->set('forum_last_post_id','0');
}else{$this->db->set('forum_last_post_id',$id,FALSE);}
$this->db->where('forum_id',$forum);
$this->db->update('fabb_forum');
return $this->db->affected_rows();
}
//------------------------------------------ 		 
public function check_badwords()
{
return $this->db->get('fabb_badwords');
}
//--------------------------------- edit post ant-flood ----------------------------------
public function editpost_flood($id){
$this->db->select('MAX(post_time) as max_time');
$this->db->where('post_createur',$id);
return $this->db->get('forum_post');			 
}				  	
//------------------------------------------ 		 
public function idbadword($badword)
{
$this->db->select('id');
$this->db->where('bad_word',$badword);
return $this->db->get('forum_badwords');
}  
//---------------------------------------------- update flood -----------------------------------
public function update_flood($ip,$id){
$this->db->set('flood_time',time());				 
$this->db->where('flood_ip',$ip);
$this->db->where('flood_idm',$id);		 			 
$this->db->update('fabb_flood');
}
//---------------------------------------------- update flood -----------------------------------
public function insert_flood($array){
$this->db->insert('fabb_flood',$array);
}
//---------------------------------------------- session_user -----------------------------------
public function session_exists($ip){
$this->db->select('flood_id');
$this->db->where('flood_ip',$ip);	
$this->db->order_by('flood_id','DESC');
$this->db->limit(1);
return $this->db->get('fabb_flood')
->num_rows();
}			 			 
//--------------------------------- reply topic flood ----------------------------------
//Contrôle anti flood
public function isinto_flood($id,$ip){
$this->db->select('flood_time');
$this->db->where('flood_idm',$id);
$this->db->where('flood_ip',$ip);			  
$this->db->order_by('flood_time','DESC');
$this->db->limit(1);
return $this->db->get('fabb_flood');
}	
//--------------------------------- delete old time flood ----------------------------------
//Contrôle anti flood
public function oldtimeflood($ip,$timeflood){
$this->db->where('flood_ip',$ip);              
if($this->db->where('flood_time<',time()-$timeflood,false)){
$this->db->delete('fabb_flood');}
}		
//--------------------------------- has any post ----------------------------------
//Contrôle anti flood
public function has_posted($ip,$id){
$this->db->select('flood_time');
$this->db->where('flood_ip',$ip);				  
$this->db->where('flood_idm',$id);
$this->db->order_by('flood_time','DESC');
$this->db->limit(1);
if($this->db->get('fabb_flood')
->num_rows()>0){
return TRUE;
}else{
return FALSE;
}
}				  
}//end class
