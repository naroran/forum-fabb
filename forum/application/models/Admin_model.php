<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model {
function __construct() {
parent::__construct();
}
//------------------------------------- delete cat ----------------------
public function delete_cat($cat_id){
$this->db->where('cat_id',$cat_id);
$this->db->delete('fabb_cat');
return $this->db->affected_rows();
}	
//------------------------------------------- select cat id -----------------------------------
public function select_cat_id($cat_name){
$this->db->select('cat_id');
$this->db->where('cat_name',$cat_name);
return $this->db->get('fabb_cat');
}	
//------------------------------ nbr post ----------------------------------------
public function nbr_post($topic_id){
$this->db->select('post_id');
$this->db->where_in('post_topic_id',$topic_id);
return $this->db->get('fabb_post'); 
} 	
//------------------------------ nbr topic ----------------------------------------
public function nbr_topic($forum_id){
$this->db->select('topic_id');
$this->db->where_in('topic_forum_id',$forum_id,false);
return $this->db->get('fabb_topic');
} 
//------------------------------ retrieve forum id -------------------------
public function get_forum_id($cat_id){
$this->db->select('forum_id');
$this->db->where('forum_cat_id', $cat_id);
return $this->db->get('fabb_forum'); 
}
//---------------------------- nbr_forum -------------------------------------
public function nbr_forum($cat_id){
$this->db->where('forum_cat_id', $cat_id);
return $this->db->get('fabb_forum')->num_rows();
}
//------------------------------- save pic ----------------------------------	
public function store_pic($data){
$this->db->where('pic_title','photo forum');					
$this->db->update('fabb_pic',$data);
}	
//------------------------------- save logo ----------------------------------	
public function store_logo($data){
	$this->db->select('pic_title');	
	$array=array();	
	foreach($this->db->get('fabb_pic')->result() as $row):
	$array[].=$row->pic_title;
	endforeach;
	if(in_array('logo forum',$array))
	{
    $this->db->set('pic_file',$data['pic_file']);
	$this->db->where('pic_title','logo forum');		
	$this->db->update('fabb_pic');
	}else{
		$this->db->insert('fabb_pic',$data);
		}
}	
//---------------------------------------------------------------------------		
public function update_config($valeur,$data){
$this->db->set('config_value',$valeur);
$this->db->where('config_name',$data);			
$this->db->update('fabb_config');
}
//--------------------------- liste categorie ---------------------------------				 
public function list_cat(){  
$this->db->select('*');			
$this->db->order_by('cat_id','DSC');					 			 
return $this->db->get('fabb_cat');
}	
//-------------------------------------- max cat ---------------------------------
public function max_cat(){
$this->db->select_max('cat_order','ordre');
return $this->db->get('fabb_cat');			 
}
//-------------------------------- add cat ------------------------
public function add_cat($data){	
return $this->db->insert('fabb_cat',$data);
}	
//-----------------------------------------------------
public function get_all_cat(){
$this->db->select('*');
$this->db->order_by('cat_order','DESC');
return $this->db->get('fabb_cat');		
}					  					  
//------------------------------------ editable categorie ----------------------------------------		
public function editable_cat($cat){
$this->db->select('cat_name');
$this->db->where('cat_id',$cat);
return $this->db->get('fabb_cat');
}
//------------------------------------------------
public function get_ord_cat(){
$this->db->order_by('cat_order' ,'DESC');
return $this->db->get('fabb_cat');
}
//-------------------------------------
public function select_ord_cat(){
$this->db->select('cat_id, cat_order');
return $this->db->get('fabb_cat');
}	
//--------------------------------------- update ord cat ---------------------------
public function update_ord_cat($ord, $cat_id){
$this->db->set('cat_order',$ord);
$this->db->where('cat_id',$cat_id);
return $this->db->update('fabb_cat');						
}
//--------------------------- liste forum ---------------------------------				 
public function liste_forum(){  							 				 
$this->db->select('forum_id, forum_name,forum_post,forum_topic');
$this->db->order_by('forum_id','DSC');					 			 
return $this->db->get('fabb_forum');
}	
//-------------------------------- list forum ---------------------------------
public function create_forum()
{
$this->db->select('cat_id,cat_name');
$this->db->order_by('cat_order','DESC');
return $this->db->get('fabb_cat');	 
}
//----------------------------- max ordre forum ------------------------------		
public function max_ordre_forum(){
$this->db->select_max('forum_order', 'max_ordre');
return $this->db->get('fabb_forum');			 
}	


//-------------------------- verifier forum à editer -------------------------
public function verif_edited_forum($forum){
	
$this->db->select('forum_id');				
$this->db->where_in('forum_name',$forum);
return $this->db->count_all_results('fabb_forum');
}


//------------------------ create forum ----------------------
public function add_forum($data)
{
return $this->db->insert('fabb_forum',$data);
}
//----------------------------------------- selected forum -------------------------------------------
public function selected_forum($forum){
$this->db->select('forum_id, forum_name, forum_desc,forum_cat_id');
$this->db->where('forum_id',$forum);
return $this->db->get('fabb_forum');
}
//---------------------------- update edited forum --------------------------------------
public function update_edited_forum($data)
{
$this->db->set('forum_cat_id',$data['cat_id']);
$this->db->set('forum_name',$data['name']);
$this->db->set('forum_desc',$data['desc']);
$this->db->where('forum_id',$data['id']);
return $this->db->update('fabb_forum');
}
//------------------------------ move forum -------------------------------------------
public function move_forum($cat,$forum){
//Mise à jour
$this->db->set('forum_cat_id',$cat);
$this->db->where('forum_id',$forum);
$this->db->update('fabb_forum');
return $this->db->affected_rows();
}
//------------------------------  forum name -------------------------------------------
public function get_forum_name($forum){
$this->db->select('forum_name');
$this->db->where('forum_id',$forum);
return $this->db->get('fabb_forum');
}	
//------------------------------ cat name -------------------------------------------
public function get_cat_name($cat){
//Mise à jour
$this->db->select('cat_name');
$this->db->where('cat_id',$cat);
return $this->db->get('fabb_cat');
}								  
//--------------------------------------ordre forum -------------------------------------
public function ord_forum(){
$this->db->select('forum_id, forum_name, forum_order,
forum_cat_id, cat_id, cat_name');
$this->db->join('fabb_forum','cat_id = forum_cat_id','left');
$this->db->order_by('cat_order' ,'DESC');
return $this->db->get('fabb_cat');
}
//------------------------- get ordre forum -----------------------------
public function get_ord_forum()
{	
$this->db->select('forum_id, forum_order');
return $this->db->get('fabb_forum');
}	
//------------------------------- loop for forum
public function loop_ord_forum($order, $forum_id){
$this->db->set('forum_order' ,$order);
$this->db->where('forum_id',$forum_id);
$this->db->update('fabb_forum');
}	
//------------------------------- edit droit forum ----------------
public function edit_droit_forum($forum)
{		
$this->db->select('forum_id, forum_name, forum_auth_view,
forum_auth_post, forum_auth_topic, forum_auth_annonce, forum_auth_modo');
$this->db->where('forum_id',$forum);						
return $this->db->get('fabb_forum');
}	
//---------------------------------- update droits forum ---------------------
public function update_droit_forum($forum,$data){		
$this->db->where('forum_id',$forum);						
return $this->db->update('fabb_forum',$data);	
}
//----------------------------------------------------------------------------------
public function update_nbr_msg_members($forum){
$this->db->select('post_owner,COUNT(post_id) AS nbr_post');	 
$this->db->where('post_forum_id',$forum);
$this->db->group_by('post_owner');
$query=$this->db->get('fabb_post');
foreach($query->result() as $val):
$this->db->set('member_post','member_post-'.$val->nbr_post,FALSE);
$this->db->where('member_id',$val->post_owner);
$this->db->update('fabb_members'); 
endforeach;
return $this->db->affected_rows();
}				 
//-------------------------- delete forum -------------------------
public function delete_forum($forum){
$this->db->where('forum_id',$forum);
return $this->db->delete('fabb_forum');
}
//-------------------------- consulter topic -----------------------
public function consulter_topic($first,$offset){
$this->db->select('topic_id, topic_title,topic_forum_id, topic_post,topic_locked, topic_time, topic_owner, 
member_avatar,member_pseudo, member_id,forum_name');
$this->db->join('fabb_members', 'fabb_topic.topic_owner = fabb_members.member_id', 'left');
$this->db->join('fabb_forum', 'fabb_topic.topic_forum_id = fabb_forum.forum_id', 'left');
$this->db->order_by('topic_time', 'ASC');
$this->db->limit($first,$offset);	
return $this->db->get('fabb_topic');
}	
//----------------------------------- check createur topic -----------------------------
public function check_createur_topic($topic){
$this->db->select('*');
$this->db->where('topic_id',$topic);
return $this->db->get('fabb_topic');
}	
//----------------------------------- get post topic -----------------------------
public function get_post_topic($post){
$this->db->select('*');
$this->db->where('post_id',$post);
return $this->db->get('fabb_post');
}	
//----------------------------------- get forum topic -----------------------------
public function get_forum_topic($forum){
$this->db->select('*');
$this->db->where('forum_id',$forum);
return $this->db->get('fabb_forum');
}	
//----------------------------------- get forum topic -----------------------------
public function get_cat_topic($cat){
$this->db->select('*');
$this->db->where('cat_id',$cat);
return $this->db->get('fabb_cat');
}	
//----------------------------------- get forum topic -----------------------------
public function get_createur_topic($id){
$this->db->select('*');
$this->db->where('member_id',$id);
return $this->db->get('fabb_members');
}	
//---------------------- update_edit_post------------------------------------
public function update_edit_post($msg,$post){
$this->db->set('post_text',$msg);
$this->db->set('post_time',time());
$this->db->where('post_id', $post);
return $query=$this->db->update('fabb_post');
}
//----------------------------------- add one view to topic -----------------------------
public function update_topic_vu($id){
$this->db->set('topic_viewed','topic_viewed + 1',FALSE);
$this->db->where('topic_id', $id);
return $this->db->update('fabb_topic');
}
// ------------------------------------ del topic ------------------------                                   
public function del_topic($topic){
$this->db->where('topic_id',$topic);
$this->db->delete('fabb_topic');
return $this->db->affected_rows();
}			 				 				 	
//------------------------------- select membre -------------------------------			
public function select_member($membre){	
$this->db->where('member_pseudo',$membre);						
return $this->db->get('fabb_members');
}	
//-------------------- update profil memeber -------------------
public function update_profil_memeber($id,$data){	
$this->db->where('member_id',$id);						
$this->db->update('fabb_members',$data);
return $this->db->affected_rows();
}
//------------------------------- select membre by id-------------------------------			
public function member_by_id($id){		
$this->db->where('member_id',$id);						
return $this->db->get('fabb_members');
}
//---------------------------- update droit member ----------------------
public function update_droit_member($rang,$member){	
$this->db->set('member_level',$rang);
$this->db->where('LOWER(member_pseudo)',$member);						
return $this->db->update('fabb_members');
}	
//------------------------------ check bann member --------------------------------
public function check_bann_name($pseudo){
$this->db->select('member_id');
$this->db->where('member_pseudo',$pseudo);
if($this->db->get('fabb_members')->num_rows()>0)
{return true;}
else{ return false;}
}	
public function bann_member($member){	
$this->db->set('member_level',0,false);
$this->db->where('member_pseudo',$member);						
$this->db->update('fabb_members');
return $this->db->affected_rows();
}
//------------------------ active smtp -----------------------------
public function active_smtp(){
$this->db->select('smtp_name');
$this->db->where('smtp_active',1);
$query= $this->db->get('fabb_smtp');
foreach($query->result() as $val):
return $val->smtp_name;
endforeach;
}		
//-------------- verifier double request -----------------------
public function get_bann_member(){	
$this->db->select('member_id, member_pseudo,
member_email, member_avatar, member_last_visit');
$this->db->where('member_level',0);						
return $this->db->get('fabb_members');
}									
//--------------------------- add bad words ---------------------------------				 
public function add_badwords($array){
$this->db->insert('fabb_badwords', $array);
}	
//-----------------------------------------------
public function gerer_badwords($ordre,$tri,$first,$offset)
{
$this->db->distinct('badword_word');
$this->db->order_by($ordre,$tri);
$this->db->limit($first,$offset);					 			 
return $this->db->get('fabb_badwords');
}							 								
//------------------------------------------ update id --------------------------------------
public function delete_badwords($bad){
foreach($bad as $val)
{
$this->db->where_in('badword_id',$val);
$this->db->delete('fabb_badwords');
}
return $this->db->affected_rows();			
}
//-------------------------------------- insert smtp ----------------------
public function insert_smtp($data){
$this->db->replace('fabb_smtp',$data);
return $this->db->affected_rows();
}		
//--------------------------------------- data smtp ----------------------------		
public function smtp(){
return $this->db->get('fabb_smtp');
}			  			 
//--------------------------------------- get smtp ----------------------------		
public function get_smtp($id){
$this->db->select('*');
$this->db->where('smtp_id',$id);
return $this->db->get('fabb_smtp');
}
//------------------------ reset smtp -----------------------------
public function reset_smtp(){
$this->db->set('smtp_active',0);
$this->db->update('fabb_smtp');
}	
//------------------------ update choix smtp -----------------------------
public function update_choix($id){
$this->db->set('smtp_active',1);
$this->db->where('smtp_id',$id);			  
$this->db->update('fabb_smtp');
return $this->db->affected_rows();
}		
//-------------------------- insert ads ----------------------------------
public function insert_adds($array){
if($this->db->insert('fabb_adds',$array)){
return true;
}else{return false;}
}				  		  
//-------------------------- gestion ads ----------------------------------
public function gerer_adds(){
return $this->db->get('fabb_adds');
}	
//-------------------------- ipiadmin ---------------------------------
public function ip_admin($ip){
$this->db->select('bot_id');	
$this->db->where('bot_ip',$ip);
$this->db->order_by('bot_id','DESC');
$this->db->limit(1);		
if($this->db->get('fabb_bots')->num_rows()>0){
return true;
}else {return false;} 
}		
//------------------------------------- banned member ---------------------------------
public function banned_members(){
$this->db->select('member_id');
$this->db->where('member_level',0,false);		
return $this->db->get('fabb_members');
}
//------------------------------------- stat members ---------------------------------
public function deleted_account(){
$this->db->select('member_id');
$this->db->where('member_level',2,false);		
return $this->db->get('fabb_members');
}	
//------------------------------------- stat members ---------------------------------
public function pending_account(){
$this->db->select('member_id');
$this->db->where('member_level',3,false);		
return $this->db->get('fabb_members');
}
//------------------------------------- stat members ---------------------------------
public function actif_account(){
$this->db->select('member_id');
$this->db->where('member_level',4,false);		
return $this->db->get('fabb_members');
}		
//------------------------------------- stat members ---------------------------------
public function modo_account(){
$this->db->select('member_id');
$this->db->where('member_level',5,false);		
return $this->db->get('fabb_members');
}
//------------------------------------- stat members ---------------------------------
public function admin_account(){
$this->db->select('member_id');
$this->db->where('member_level',6,false);		
return $this->db->get('fabb_members');
}
//--------------------------- total visite 5min ---------------------------------				 
public function online_visitors(){  
$f =300;
$this->db->select('*');	  							 
$this->db->where('online_time >',time()-$f,false);
return $this->db->get('fabb_online');
}			
//--------------------------- total visite one day ---------------------------------				 
public function day_vositors()
{  
$d = 86400;	
$this->db->select('*');							 	
$this->db->where('online_time >',time()-$d,false);
return $this->db->count_all_results('fabb_online');
}	
//---------------------------  day detail ---------------------------------				 
public function day_data_visit()
{  
$d = 86400;	
$this->db->select('*');							 	
$this->db->where('online_time >',time()-$d,false);
return $this->db->get('fabb_online');
}					  
//--------------------------- total visite a week ---------------------------------				 
public function week_visitors(){  
$w=604800; 	
$this->db->select('*');				 						 	
$this->db->where('online_time >',time()-$w);
return $this->db->count_all_results('fabb_online');
}						  		
//--------------------------- total visite month ---------------------------------				 
public function month_visitors(){ 
$m =2592000; 
$this->db->select('*');				  							 		
$this->db->where('online_time >',time()-$m);
return $this->db->count_all_results('fabb_online');
}						  			  
//--------------------------- total visite year ---------------------------------				 
public function year_visitors(){
$y =31536000;  
$this->db->select('*'); 							 		
$this->db->where('online_time >',time()-$y);
return $this->db->count_all_results('fabb_online');
}	
//--------------------------- all time ---------------------------------				 
public function all_time_visit(){
$this->db->select('online_id'); 		
return $this->db->get('fabb_online')->num_rows();
}	
//----------------------- verif edited cat ------------------------------
public function verif_edit_cat($titre,$cat){
$this->db->where('cat_name<>',$titre);
$this->db->where('cat_id<>',$cat);
return $this->db->get('fabb_cat');
}				  	
//------------------------------ update categorie -------------------------------------------
public function update_edited_cat($titre,$cat){
//Mise à jour
$this->db->set('cat_name',$titre);
$this->db->where('cat_id',$cat);
return $this->db->update('fabb_cat');
}
//------------------------------------ retrieve img forum ------------------------
//fetch img forum from db
public function get_pics(){
$this->db->select('*');		
$this->db->where('pic_title','photo forum');
return $this->db->get('fabb_pic');
}
//------------------------------------------------------------
public function get_forum_config(){
$query = 'SELECT config_nom, config_valeur FROM forum_config';
return $this->db->query($query);
}	
//-----------------------------------------------------------
public function list_forum(){
$this->db->select('forum_id, forum_name, SUM(forum_topic) as nbr_topic');
$this->db->order_by('forum_order', 'DESC');
return $this->db->get('fabb_forum');
}				 
//------------------------------ count all member ----------------------------------------
public function total_member(){
return $this->db->get('fabb_members');
} 	
//--------------------------------nbr badwords ---------------
public function count_badwords()
{
return $this->db->count_all_results('fabb_badwords');
}
//------------------------ update smtp -----------------------------
public function update_smtp($id,$data){
$this->db->where('smtp_id',$id);
$this->db->update('fabb_smtp',$data);
return $this->db->affected_rows();
}	
//------------------------ delete smtp -----------------------------
public function delete_smtp($id){
$this->db->where('smtp_id',$id);
$this->db->delete('fabb_smtp');
return $this->db->affected_rows();
}	
//-------------------------------------------------------------------
public function edit_forum($forum){
$query = 'SELECT forum_id, forum_name, forum_desc,
forum_cat_id
FROM forum_forum
WHERE forum_id ='. $forum;
return $this->db->query($query);
}
//------------------------------------------------------------
public function get_all_config(){
$query='SELECT config_nom, config_valeur FROM forum_config';
return $this->db->query($query);				 		
}
//------------------------------- update membre provisoirement -------------------------------			
public function update_instant_member($pseudo,$id){		
$this->db->set('membre_pseudo',$pseudo);
$this->db->where('membre_id',$id);						
return $this->db->update('forum_membres');
}
//-------------------- concerned memeber -------------------
public function concerned_member($membre){	
$this->db->select('COUNT(*) AS nbr');
$this->db->where('member_pseudo',$membre);						
return $this->db->get('fabb_members');
}
//-------------------- not concerned memeber -------------------
public function verify_member($membre_id){	
$this->db->select('member_pseudo, member_email');
$this->db->where('member_id <>',$membre_id);						
return $this->db->get('fabb_members');
}	
//----------------------------------------------------------------------------
public function ban_members(){	
$this->db->select('member_id, member_pseudo');
$this->db->where('member_level',0);						
return $this->db->get('fabb_members');
}
public function edit_ban_member($membre){	
$this->db->select('member_id');
$this->db->where('LOWER(member_pseudo)',$membre);						
return $this->db->get('fabb_members');
}
public function debann_member($id){	
$this->db->set('member_level',4);
$this->db->where('member_id',$id);						
return $this->db->update('fabb_members');
}
//----------------------------------------- get post id -------------------------------------
public function select_post_id($id_topic){
$this->db->select('post_id');
foreach($id_topic as $val){
$this->db->or_where('topic_id', $val);
}
return $this->db->get('fabb_post'); 	
}		
//------------------------------------------ delete topic view --------------------------------------
public function delete_topic_view($id_post){
foreach($id_post as $val){
$this->db->or_where('tv_post_id',$val);
}
$this->db->delete('forum_topic_view');
return $this->db->affected_rows();
}					 
//------------------------------------------ delete post --------------------------------------
public function delete_post($topic_id){
foreach($topic_id as $val)
{
$this->db->or_where('topic_id',$val);
}
$this->db->delete('forum_post');
return $this->db->affected_rows();
}	
//------------------------------------------ delete topic --------------------------------------
public function delete_topic($forum_id){
foreach($forum_id as $val)
{
$this->db->or_where('forum_id',$val);
}
$this->db->delete('forum_topic');
return $this->db->affected_rows();
}	
//--------------------------- delete categorie ---------------------------------				 
public function select_cat($cat_name){
$sql='SELECT forum_categorie.cat_id, forum_forum.forum_id, forum_topic.topic_id, forum_post.post_id
FROM forum_categorie
LEFT JOIN forum_forum ON forum_c
ategorie.cat_id=forum_forum.forum_cat_id
LEFT JOIN forum_topic ON forum_forum.forum_cat_id=forum_topic.forum_id
LEFT JOIN forum_post ON forum_post.post_forum_id=forum_topic.topic_id
WHERE forum_categorie.cat_nom='.$cat_name;
}		
//--------------------------- delete categorie ---------------------------------	
public function del_cat($cat_name){  							 				 
$sql='delete forum_categorie, forum_forum, forum_topic, forum_post
FROM forum_categorie
LEFT JOIN forum_forum ON forum_categorie.cat_id=forum_forum.forum_cat_id
LEFT JOIN forum_topic ON forum_forum.forum_cat_id=forum_topic.forum_id
LEFT JOIN forum_post ON forum_post.post_forum_id=forum_topic.topic_id
WHERE forum_categorie.cat_nom='.$cat_name;
}
//----------------------------------------- autocomplete --------------------			  
public function autocomplete($search){
$this->db->order_by('member_id', 'DESC');
$this->db->like('member_pseudo', $search);
return $this->db->get('fabb_members')->result_array();
}
//----------------------------------------
function fetch_data($query)
{
$this->db->like('member_pseudo', $query);
$query = $this->db->get('fabb_members');
if($query->num_rows() > 0)
{
foreach($query->result_array() as $row)
{
$output[] = array(
'name'  => $row["member_pseudo"],
'image'  => $row["member_avatar"]
);
}
echo json_encode($output);
}
}
//-------------------------- delete pub ----------------------------------
public function del_add($id){
$this->db->where('add_id',$id);
if($this->db->delete('fabb_adds')){
return $this->db->affected_rows();
}else{ return false;}
}
//-------------------------- lock pub ----------------------------------
public function lock_add($id){
$this->db->set('add_stat',0);
$this->db->where('add_id',$id);
if($this->db->update('fabb_adds')){
return $this->db->affected_rows();
}else{ return false;}
}	
//-------------------------- lock pub ----------------------------------
public function unlock_add($id){
$this->db->set('add_stat',1);
$this->db->where('add_id',$id);
if($this->db->update('fabb_adds')){
return $this->db->affected_rows();
}else{ return false;}
}		
//-------------------------- view_add ----------------------------------
public function view_add($id){
$this->db->select('add_code');
$this->db->where('add_id',$id);
$this->db->where('add_stat',1);
return $this->db->get('fabb_adds');
}				
//-------------------------- edit adds ----------------------------------
public function edit_adds($array){
$this->db->set('add_page',$array['add_page']);
$this->db->set('add_format',$array['add_format']);
$this->db->set('add_position',$array['add_position']);
$this->db->set('add_title',$array['add_title']);
$this->db->set('add_code',$array['add_code']);
$this->db->set('add_date',time());
$this->db->where('add_id',$array['add_id']);
if($this->db->update('fabb_adds')){
return true;
}else{return false;}
}	
//-------------------------- chercher la pub adds ----------------------------------
public function grab_pub($id){
$this->db->where('add_id',$id);
return $this->db->get('fabb_adds'); 		
}
//-------------------------- gerer bots----------------------------------
public function gerer_bots(){
return $this->db->get('fabb_bots');
}	
//-------------------------- free admin----------------------------------
public function freeadmin($ip){
$this->db->where('bot_ip',$ip);
if($this->db->delete('fabb_bots')){
return $this->db->affected_rows();
}else {return false;} 
}		
//-------------------------- lock bot ----------------------------------
public function lock_bot($id){
$this->db->set('bot_state',1);
$this->db->where('bot_id',$id);
if($this->db->update('fabb_bots')){
return $this->db->affected_rows();
}else{ return false;}
}	
//-------------------------- unlock bot ----------------------------------
public function unlock_bot($id){
$this->db->set('bot_state',0);
$this->db->where('bot_id',$id);
if($this->db->update('fabb_bots')){
return $this->db->affected_rows();
}else{ return false;}
}	
//-------------------------- unlock bot ----------------------------------
public function delete_bot($id){
$this->db->where('bot_id',$id);
if($this->db->delete('fabb_bots')){
return $this->db->affected_rows();
}else {return false;} 
}
//-------------------------- admin avatar ----------------------------------
public function admin_avatar(){
$this->db->select('member_avatar');
$this->db->where('member_pseudo','admin');
foreach($this->db->get('fabb_members')->result() as $row){
$avatar=$row->member_avatar;
}return $avatar;
}
//------------------------------------ retrieve logo forum ------------------------
//fetch img forum from db
public function get_logo(){
$this->db->select('*');		
$this->db->where('pic_title','logo forum');
return $this->db->get('fabb_pic');
}
}//end class
