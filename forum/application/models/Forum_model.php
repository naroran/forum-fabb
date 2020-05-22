<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forum_model extends CI_Model {
function __construct() {
parent::__construct();
}
public function get_configuration(){
//Récupération des variables de configuration		
return $this->db->get('fabb_config');
}
public function get_all_forums($status)
{
$this->db->select('cat_id, cat_name, 
fabb_forum.forum_id, forum_name, forum_desc, forum_post, forum_topic,
forum_auth_view, fabb_topic.topic_id, fabb_topic.topic_post,topic_time,
post_id, post_time, post_owner, 
member_avatar, member_pseudo, member_id');
$this->db->join('fabb_forum', 'fabb_cat.cat_id = fabb_forum.forum_cat_id', 'left');
$this->db->join('fabb_post', 'fabb_post.post_id = fabb_forum.forum_last_post_id', 'left');
$this->db->join('fabb_topic', 'fabb_topic.topic_id = fabb_post.post_topic_id', 'left');		
$this->db->join('fabb_members', 'fabb_members.member_id = fabb_post.post_owner', 'left');
$this->db->where('forum_auth_view <='.$status);
$this->db->where('forum_group','discussion');
$this->db->order_by('cat_order, forum_order DESC');						
return $this->db->get('fabb_cat');
}
//---------------------------------------------------------------------------------------------------------	   
public function lastannonce(){
$this->db->select('COUNT(post_id) AS tt_ann,topic_lastpost'); 
$this->db->join('fabb_post', 'fabb_topic.topic_id = fabb_post.post_topic_id', 'left'); 
$this->db->where('topic_sort','Annonce'); 
$this->db->group_by('topic_lastpost'); 			
return $this->db->get('fabb_topic'); 
}
//--------------------------------------------- last topic ------------------------------------------------------------	   
public function lastpost(){
$this->db->select('COUNT(post_id) AS tt_post,topic_lastpost'); 
$this->db->join('fabb_post', 'fabb_topic.topic_id = fabb_post.post_topic_id', 'left'); 			 
$this->db->where('topic_sort','Message'); 
$this->db->group_by('topic_lastpost'); 			
return $this->db->get('fabb_topic'); 
}
//---------------------------------------------------------------------------------------------------------	   
public function this_topic($topic){
//A partir d'ici, on va compter le nombre de messages pour n'afficher que les 15 premiers
$this->db->select('topic_title, topic_post, topic_forum_id, topic_lastpost,topic_sort, cat_name,
forum_name, forum_auth_view, forum_auth_topic, forum_auth_post'); 
$this->db->join('fabb_forum','fabb_topic.topic_forum_id = fabb_forum.forum_id','left');
$this->db->join('fabb_cat','fabb_cat.cat_id = fabb_forum.forum_cat_id','left'); 
$this->db->where('topic_id',$topic);
$query=$this->db->get('fabb_topic');
return $query;
}	
//---------------------------------------------------- total post --------------------------------------				  
public function total_Post($topic){
$this->db->select('post_id');
$this->db->where('post_topic_id',$topic);	
return $this->db->get('fabb_post')->num_rows();		
}		  
//----------------------------------------------------------------------------------------------
public function get_connected_topic($id,$forum,$post_p_page,$page){
$this->db->select('topic_id, topic_title, topic_owner, topic_viewed, topic_post,topic_sort,topic_firstpost, 
topic_time, topic_lastpost,topic_locked,
TA.member_pseudo AS owner, post_id, post_owner, post_time, TB.member_pseudo AS last_owner,tv_id, tv_post_id, tv_post');
$this->db->join('fabb_members TA', 'TA.member_id = fabb_topic.topic_owner', 'left');
$this->db->join('fabb_post', 'fabb_topic.topic_lastpost = fabb_post.post_id', 'left');
$this->db->join('fabb_members TB', 'TB.member_id = fabb_post.post_owner', '');   
$this->db->join('fabb_topic_view ','fabb_topic.topic_id = fabb_topic_view.tv_topic_id AND 
fabb_topic_view.tv_id = '.$id, 'left');  
//$this->db->where('forum_group','discussion');
$this->db->where('fabb_topic.topic_forum_id',$forum);
$this->db->order_by('topic_lastpost', 'DESC');
$this->db->limit($post_p_page,$page);
return $this->db->get('fabb_topic');
}
//----------------------------------------------------------------------------------------------------		  
public function get_all_topic($forum,$post_p_page,$page){
//On prend tout ce qu'on a sur les Annonces du forum
$this->db->select('fabb_topic.topic_id, topic_title, topic_owner, topic_viewed, topic_post, 
topic_time, topic_lastpost,topic_locked,
Mb.member_pseudo AS owner, post_id, post_owner, post_time, Ma.member_pseudo AS last_owner');
$this->db->join('fabb_members Mb', 'Mb.member_id = fabb_topic.topic_owner', 'left');
$this->db->join('fabb_post', 'fabb_topic.topic_lastpost = fabb_post.post_id', 'left');
$this->db->join('fabb_members Ma', 'Ma.member_id = fabb_post.post_owner', 'left');   
//$this->db->where('forum_group','discussion');
$this->db->where('topic_forum_id',$forum);
$this->db->order_by('topic_lastpost', 'DESC');
$this->db->limit($post_p_page,$page);
return $this->db->get('fabb_topic');
}	
public function get_post_owner($topic,$post_p_page,$page){
$this->db->select('post_id , post_owner , post_text , post_time,
member_id, member_pseudo, member_registred, member_avatar, member_location, member_post, member_signature');
$this->db->join('fabb_members','fabb_members.member_id = fabb_post.post_owner','left');
$this->db->where('post_topic_id',$topic);
$this->db->order_by('post_id');
$this->db->limit($post_p_page,$page);
return $this->db->get('fabb_post');
}
//--------------------------------------------- last topic ------------------------------------------------------------	   
public function topic_lastpost($topic,$lastpost){
$this->db->select('topic_title,topic_viewed,topic_time,topic_post,member_id,post_time,member_pseudo,member_avatar,
member_registred,member_post,post_text,member_location,forum_name,cat_name'); 
$this->db->join('fabb_post', 'fabb_topic.topic_id=fabb_post.post_topic_id', 'left');
$this->db->join('fabb_members', 'fabb_members.member_id=fabb_post.post_owner', 'left');			 			 
$this->db->join('fabb_forum', 'fabb_forum.forum_id=fabb_post.post_forum_id', 'left');	
$this->db->join('fabb_cat', 'fabb_cat.cat_id=fabb_forum.forum_cat_id', 'left');
$this->db->where('topic_id',$topic);
$this->db->where('topic_lastpost',$lastpost);
$this->db->order_by('post_time','DESC');
$this->db->limit(1); 		
return $this->db->get('fabb_topic'); 
}
//--------------------------------------------- last topic ------------------------------------------------------------	   
public function view_edit_post($post){
$this->db->select('topic_title,topic_post,member_id,post_time,member_pseudo,member_avatar,
member_registred,member_post,post_text,post_id,member_location,forum_name,cat_name'); 
$this->db->join('fabb_topic', 'fabb_post.post_topic_id=fabb_topic.topic_id', 'left');
$this->db->join('fabb_members', 'fabb_members.member_id=fabb_post.post_owner', 'left');			 			 
$this->db->join('fabb_forum', 'fabb_forum.forum_id=fabb_post.post_forum_id', 'left');	
$this->db->join('fabb_cat', 'fabb_cat.cat_id=fabb_forum.forum_cat_id', 'left');
$this->db->where('post_id',$post);
$this->db->order_by('post_id','DESC');
$this->db->limit(1); 		
return $this->db->get('fabb_post'); 
}
//---------------------------------- move topic ----------------------------------
public function selectForumTo($forum){
$this->db->select('forum_id,forum_name');
$this->db->where('forum_id <>',$forum);					
return $this->db->get('fabb_forum');
}
//-------------------------------- deplacer ---------------------------------------------
public function check_moving_topic($topic)
{
$this->db->select('forum_auth_modo,forum_id, forum_cat_id, forum_topic, forum_post');
$this->db->join('fabb_forum','fabb_forum.forum_id = fabb_topic.topic_forum_id','left');
$this->db->where('topic_id',$topic);	
return $this->db->get('fabb_topic');
}
//------------------------------------------ old last post -------------------------------------------
public function old_lastPost($oldforum)
{	
$this->db->select('post_id');
$this->db->where('post_forum_id',$oldforum);
$this->db->order_by('post_id','DESC');
$this->db->limit(1);
return $this->db->get('fabb_post');
}		
//----------------------------------- move post ---------------------------
public function movePost_newForum($forum,$topic)
{			
$this->db->set('post_forum_id',$forum);
$this->db->where('post_topic_id',$topic);
$this->db->update('fabb_post');
return $this->db->affected_rows()>0;
}		
//--------------------------------------- move to new forum  --------------------------------
public function moveToForum($last_post,$nbr_post,$forumid)
{		
$this->db->set('forum_last_post_id',$last_post);
$this->db->set('forum_topic','forum_topic + 1',FALSE);
$this->db->set('forum_post','forum_post +'.$nbr_post,FALSE);
$this->db->where('forum_id',$forumid);
$this->db->update('fabb_forum');
return $this->db->affected_rows();	
}		
//------------------------------------------ new last post -------------------------------------------
public function new_last_post($oldforum)
{	
$this->db->select('post_id');
$this->db->where('post_forum_id',$oldforum);
$this->db->order_by('post_id','DESC');
$this->db->limit(1);
$query= $this->db->get('fabb_post');
foreach($query->result() as $value):
return $value->post_id;
endforeach;
}			
//--------------------------------------- update old forum  --------------------------------
public function updateOldForum($nbr_post,$last_post,$from)
{		
$this->db->set('forum_post','forum_post -'.$nbr_post,FALSE);
$this->db->set('forum_topic','forum_topic-1',FALSE);
$this->db->set('forum_last_post_id',$last_post);
$this->db->where('forum_id',$from);
$this->db->update('fabb_forum');
return $this->db->affected_rows();	
}	
//---------------------------------------------------------------------
public function totalPost(){
return $this->db->count_all('fabb_post');
}					
//-------------------------------- forum de destination ---------------------------------------------
public function data_destination($newForumId)
{
$this->db->select('forum_cat_id');
$this->db->where('forum_id',$newForumId);	
return $this->db->get('fabb_forum');
}				
//------------------------------------- move topic to ---------------------------------------
public function moveTopic_newForum($forum,$topic)
{
$this->db->set('topic_forum_id',$forum);
$this->db->where('topic_id',$topic);
$this->db->update('fabb_topic');
return $this->db->affected_rows()>0;
}
//----------------------------------- check new forum  ---------------------------
public function chechNewForum($forumId)
{			
$this->db->select('COUNT(topic_id)');
$this->db->where('topic_forum_id',$forumId);
$this->db->order_by('topic_id','DESC');
$this->db->limit(1);
return $this->db->count_all('fabb_topic');
}
//--------------------------- nbr post -----------------------------
public function nbrPostopic($topic)
{			
$this->db->select('post_id');
$this->db->where('post_topic_id',$topic);
$query=$this->db->get('fabb_post');
return $query->num_rows();
}
//--------------------------- nbr post -----------------------------
public function nbrPostopic_2($forum)
{			
$this->db->select('forum_topic,forum_post,forum_last_post_id');
$this->db->where('forum_id',$forum);
return $this->db->get('fabb_forum');
}		
//-------------------------------- from forum ------------------------------------------
public function from_forum($from)
{			
$this->db->select('post_id');
$this->db->where('post_forum_id',$from);
$this->db->order_by('post_id','DESC');
$this->db->limit(1);
$query=$this->db->get('fabb_post');
foreach($query->result() as $value):
return $value->post_id;
endforeach;
}
//--------------------------------------- forum over --------------------------------
public function forum_over($nbr_post,$last_post,$from)
{		
$this->db->set('forum_post','forum_post -'.$nbr_post,FALSE);
$this->db->set('forum_topic','forum_topic-1',FALSE);
$this->db->set('forum_last_post_id',$last_post);
$this->db->where('forum_id',$from);
$this->db->update('fabb_forum');
return $this->db->affected_rows();	
}
//--------------------------------------- update new forum  --------------------------------
public function updateNewForum($nbr_post,$last_post,$from)
{		
$this->db->set('forum_post','forum_post +'.$nbr_post,FALSE);
$this->db->set('forum_topic','forum_topic + 1',FALSE);
$this->db->set('forum_last_post_id',$last_post);
$this->db->where('forum_id',$from);
$this->db->update('fabb_forum');
return $this->db->affected_rows();	
}	
//------------------------------------------ new old last post -------------------------------------------
public function new_old_last_post($oldforum)
{	
$this->db->select('post_id');
$this->db->where('post_forum_id',$oldforum);
$this->db->order_by('post_id','DESC');
$this->db->limit(1);
return $this->db->get('fabb_post');
}			
//---------------------------------------- update --------------------------------------------------
public function update_post_forum($nbr_post,$last_post,$from)
{	 
$this->db->set('forum_post','forum_post +'.$nbr_post,FALSE);
$this->db->set('forum_topic','forum_topic + 1',FALSE);
$this->db->set('forum_last_post_id',$last_post);
$this->db->where('forum_id',$from);
$this->db->update('fabb_forum');
return $this->db->affected_rows();
}
//--------------------------------------------------------------
public function get_nbr_topics($forum){
$this->db->select('count(post_id) as tt_post,forum_name,forum_topic, topic_sort,forum_group,topic_title');	
$this->db->join('fabb_topic','fabb_forum.forum_id = fabb_topic.topic_forum_id','left');
$this->db->join('fabb_post','fabb_topic.topic_id = fabb_post.post_topic_id','left');		   
$this->db->where('forum_id',$forum);		 
return $this->db->get('fabb_forum');
}	
//--------------------------------------------------------------
public function nbr_topics($topic){
$this->db->select('post_id');	
$this->db->where('post_topic_id',$topic);	
$this->db->order_by('post_id','DESC');		 
$query= $this->db->get('fabb_post');
return $query->num_rows();
}			  
//---------------------------- lock topic -------------------------------------------
public function data_lock($topic){
//lock topic
$this->db->select('topic_locked');
$this->db->where('topic_id',$topic);	
$query=$this->db->get('fabb_topic');	
foreach($query->result() as $val):
return $val->topic_locked;
endforeach;		
}		
public function visitors_online()
{
$this->db->select('online_ip');		
$this->db->where('online_id','0');
$this->db->where('online_time >',time()-300,false);
return $this->db->get('fabb_online')->num_rows();
}
public function members_online()
{	
$this->db->select('member_id, member_pseudo,online_id');
$this->db->join('fabb_members','online_id=member_id','left');
$this->db->where('online_time >',time()-300,false);
$this->db->where('online_id <>',0);
return $this->db->get('fabb_online');
}
public function count_users()
{
return $this->db->count_all_results('fabb_members');
}
public function count_all_topic()
{
return $this->db->count_all_results('fabb_topic');
}
public function count_all_forum()
{
return $this->db->count_all_results('fabb_forum');
}	
public function get_last_user()
{
$this->db->order_by('member_id', 'DESC');
$this->db->limit(1,0);	  
return $this->db->get('fabb_members');
}
//------------------------------------------ tv -------------------------------
public function get_connected_annonces($id,$forum){
$this->db->select('fabb_topic.topic_id, topic_title,topic_sort, topic_owner, topic_viewed, topic_post, topic_time,          topic_lastpost,topic_locked,
TB.member_pseudo AS pseudo_owner, TB.member_avatar AS pseudo_avatar,TB.member_id AS pseudo_id, 
post_owner, post_time, TA.member_pseudo AS pseudo_lastpost,TA.member_pseudo AS pseudo_lastpost,tv_id, tv_post_id, tv_post, post_id'); 
$this->db->join('fabb_members TB', 'TB.member_id = fabb_topic.topic_owner', 'left');
$this->db->join('fabb_post', 'fabb_topic.topic_lastpost = fabb_post.post_id', 'left');
$this->db->join('fabb_members TA' ,'TA.member_id = fabb_post.post_owner', 'left');
$this->db->join('fabb_topic_view ','fabb_topic.topic_id = fabb_topic_view.tv_topic_id AND fabb_topic_view.tv_id = '.$id, 'left');    
$this->db->where('fabb_topic.topic_forum_id',$forum);
$this->db->order_by('topic_lastpost DESC');
$query=$this->db->get('fabb_topic');
return $query;
}
//---------------------------------------------------------------
public function get_annonces($forum){
$this->db->select('fabb_topic.topic_id, topic_title,topic_sort, topic_owner, topic_viewed, topic_post, topic_time,          topic_lastpost,
TB.member_pseudo AS pseudo_owner, TB.member_avatar AS pseudo_avatar,TB.member_id AS pseudo_id, 
post_owner, post_time, TA.member_pseudo AS pseudo_lastpost, post_id'); 
$this->db->join('fabb_members TB', 'TB.member_id = fabb_topic.topic_owner', 'left');
$this->db->join('fabb_post', 'fabb_topic.topic_lastpost = fabb_post.post_id', 'left');
$this->db->join('fabb_members TA' ,'TA.member_id = fabb_post.post_owner', 'left');    
$this->db->where('fabb_topic.topic_forum_id ='.$forum); 
$this->db->order_by('topic_lastpost DESC');
return $this->db->get('fabb_topic');
}		  
//------------------------------------------ all annonces ----------------------------------------------
public function all_annonces($status)
{
$this->db->select('cat_id, cat_name, 
fabb_forum.forum_id, forum_name, forum_desc, forum_post, forum_topic,
forum_auth_view, fabb_topic.topic_id, fabb_topic.topic_post,topic_time, topic_sort,
post_id, post_time, post_owner, 
member_avatar, member_pseudo, member_id');
$this->db->join('fabb_forum', 'fabb_cat.cat_id = fabb_forum.forum_cat_id', 'left');
$this->db->join('fabb_post', 'fabb_post.post_id = fabb_forum.forum_last_post_id', 'left');
$this->db->join('fabb_topic', 'fabb_topic.topic_id = fabb_post.post_topic_id', 'left');		
$this->db->join('fabb_members', 'fabb_members.member_id = fabb_post.post_owner', 'left');
$this->db->where('forum_auth_view <='.$status);
$this->db->where('forum_group','Annonce');
$this->db->order_by('cat_order, forum_order DESC');						
return $this->db->get('fabb_cat');
}
//----------------------------------------------------------------------------------------------------
public function get_id_topic($topic){
$this->db->where('topic_id'.$topic);
$query=$this->db->get('fabb_topic');
return $query;
}		
//----------------------------------------- topic deja vu --------------------------
public function viewed_topic($topic,$id){
$this->db->where('tv_topic_id',$topic);			 
$this->db->where('tv_id',$id);
return $this->db->get('fabb_topic_view');
}
//-----------------------------------------------------------------------------------
public function update_first_tv($post,$topic,$id){	
$this->db->set('tv_post_id',$post);
$this->db->where('tv_topic_id',$topic);
$this->db->where('tv_id',$id);
$this->db->update('fabb_topic_view');
}
//--------------------------------------------------------------------------------------------------------
public function add_one_view($topic){  
$this->db->set('topic_viewed','topic_viewed+1',FALSE);
$this->db->where('topic_id',$topic);	
$this->db->update('fabb_topic');
}
//-------------------------------------------------------------------------------------
public function moved_forum($forum){
$this->db->select('forum_id, forum_name');
$this->db->where('forum_id<>',$forum);
return $this->db->get('fabb_forum');
}
//------------------------------update lock topic--------------------------------------
public function update_lock_topic($topic){
$this->db->set('topic_locked','1');			 			 
$this->db->where('topic_id',$topic);
$this->db->update('fabb_topic');
return;
}
//--------------------------------lock_topic -----------------------------------------
public function data_lock_topic($topic){
$this->db->select('fabb_topic.topic_forum_id, forum_auth_modo,topic_owner');
$this->db->join('fabb_forum','fabb_forum.forum_id = fabb_topic.topic_forum_id','left');
$this->db->where('topic_id',$topic);	
$query=$this->db->get('fabb_topic');	
return $query;	
}
//------------------------------------------- update unlock topic--------------------------------
public function unlock_topic($topic)
{
$this->db->select('fabb_topic.topic_forum_id, forum_auth_modo, topic_owner');
$this->db->join('fabb_forum','fabb_forum.forum_id = fabb_topic.topic_forum_id','left');
$this->db->where('topic_id',$topic);	
$query=$this->db->get('fabb_topic');	
return $query;
}
//------------------------------------------ update lock topic---------------------------
public function update_unlock_topic($topic){
$this->db->set('topic_locked','0');			 			 
$this->db->where('topic_id',$topic);
$this->db->update('fabb_topic');
}
//---------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
public function get_moved_topic($topic){	
$query= 'SELECT forum_topic.forum_id, auth_modo
FROM forum_topic
LEFT JOIN forum_forum 
ON forum_forum.forum_id = forum_topic.forum_id
WHERE topic_id ='.$topic;
$query=$this->db->query($query);	
return $query;
}
//-------------------------------------------------------------------------------------------
public function update_moved_topic($topic,$data){
$this->db->where('topic_id',$topic);
$this->db->update('forum_topic',$data);	
return $this->db->affected_rows();
}
//---------------------------------------------------------------
public function update_moved_post($destination,$topic){
$this->db->set('post_forum_id',$destination);
$this->db->where('topic_id',$topic);
$this->db->update('forum_post');
return $this->db->affected_rows();
}
//----------------------------------------------------------------------------
public function select_nbr_post($topic){
$query='SELECT COUNT(*) AS nombre_post
FROM forum_post WHERE topic_id ='.$topic;
return $this->db->query($query);
}
//---------------------------------------------------------
public function get_origine_post($origine){		
$this->db->select('post_id');
$this->db->where('post_forum_id',$origine);
$this->db->order_by('post_id','DESC');
$this->db->limit(1,0);
$query=$this->db->get('forum_post');
return $query;
}
//------------------------------------------------------------------------
public function update_origine_post($nombrepost,$last_post,$origine){
$this->db->set('forum_post','forum_post -'.$nombrepost,FALSE);
$this->db->set('forum_topic','forum_topic - 1',FALSE);
$this->db->set('forum_last_post_id',$last_post);												
$this->db->where('forum_id',$origine);												
return  $this->db->update('forum_forum');												
}
//------------------------------------------------------------------------
public function get_forum_last_post_id($destination){		 
$this->db->select('post_id');	
$this->db->where('post_forum_id',$destination);	
return $this->db->get('forum_post');			
}
//---------------------------------------------------------------
public function update_move_forum_forum($destination,$data){		 
$this->db->where('forum_id',$destination);
$this->db->update('forum_forum',$data);	
}
public function first_view_topic($id,$topic,$forum,$post){	
$this->db->set('tv_id',$id);			 
$this->db->set('tv_topic_id',$topic);
$this->db->set('tv_forum_id',$forum);
$this->db->set('tv_post_id',$post);			 			 
return $this->db->insert('fabb_topic_view');		 	 
}
//------------------------- visitors day ------------------------------------------
public function visitors_day($id,$time,$ip){
$this->db->set('day_id',$id);
$this->db->set('day_time',$time);
$this->db->set('day_ip',$ip);
$this->db->replace('fabb_visitors_day');
}		 
// ------------------------------- forum version ---------------------------
public function forum_version(){
if($this->db->get('forum_version')){
return true;
}
else{
return false;
}
}	
//----------------------------------- liste tables --------------------
public function list_table(){
return $this->db->list_tables();
}	
//----------------------------------- top adds --------------------
public function add_top_index(){
$this->db->select('add_code');
$this->db->where('add_page','index');
$this->db->where('add_position','top');
$this->db->where('add_stat','1');
$this->db->order_by('add_code','RANDOM');
$this->db->limit(1);
return $this->db->get('fabb_adds');
}
//----------------------------------- bottom adds --------------------
public function add_bottom_index(){
$this->db->select('add_code');
$this->db->where('add_page','index');
$this->db->where('add_position','bottom');
$this->db->where('add_stat','1');
$this->db->order_by('add_code','RANDOM');
$this->db->limit(1);
return $this->db->get('fabb_adds');
}		
//----------------------------------- top adds --------------------
public function add_top_forum(){
$this->db->select('add_code');
$this->db->where('add_page','forum');
$this->db->where('add_position','top');
$this->db->where('add_stat','1');
$this->db->order_by('add_code','RANDOM');
$this->db->limit(1);
return $this->db->get('fabb_adds');
}		
//----------------------------------- bottom adds --------------------
public function add_bottom_forum(){
$this->db->select('add_code');
$this->db->where('add_page','forum');
$this->db->where('add_position','bottom');
$this->db->where('add_stat','1');
$this->db->order_by('add_code','RANDOM');
$this->db->limit(1);
return $this->db->get('fabb_adds');
}	
//----------------------------------- top adds --------------------
public function add_top_topic(){
$this->db->select('add_code');
$this->db->where('add_page','topic');
$this->db->where('add_position','top');
$this->db->where('add_stat','1');
$this->db->order_by('add_code','RANDOM');
$this->db->limit(1);
return $this->db->get('fabb_adds');
}	
//----------------------------------- bottom adds --------------------
public function add_bottom_topic(){
$this->db->select('add_code');
$this->db->where('add_page','topic');
$this->db->where('add_position','bottom');
$this->db->where('add_stat','1');
$this->db->order_by('add_code','RANDOM');
$this->db->limit(1);
return $this->db->get('fabb_adds');
}	
//----------------------------------- bad bots --------------------
public function bad_bot($ip){
$this->db->select('bot_id');
$this->db->where('bot_ip',$ip);
$this->db->where('bot_state','1');
$this->db->order_by('bot_id','DESC');
$this->db->limit(1);
if($this->db->get('fabb_bots')->num_rows()>0){
return true;
}else{return false;} 
}	
//---------------------------- forum name unique -------------------------
public function uniqForumName($catid,$name){
	
	$this->db->select('forum_name');
	$this->db->where('forum_cat_id',$catid);
	$query=$this->db->get('fabb_forum');
	$match=array();
	foreach($query->result() as $row):
	$match[].=strtolower($row->forum_name);
	endforeach;
	if(in_array(strtolower($name),$match)){
		return true;
		}else{return false;
		}
	
	}
//----------------------------------- insert bots --------------------
public function insert_bot($array){
$this->db->insert('fabb_bots',$array);
}	
}//end class













