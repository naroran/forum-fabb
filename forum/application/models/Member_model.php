<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member_model extends CI_Model {
function __construct() {
parent::__construct();
}
public function is_online($ip){
$this->db->select('*');			
$this->db->where('online_ip',$ip);	
$this->db->order_by('online_time','DESC');
$this->db->limit(1);			
$qury=$this->db->get('fabb_online');
return $qury->num_rows();
}
//---------------------------- update online -------------------
public function update_online($ip){
$this->db->set('online_id',$this->idM); 			
$this->db->set('online_time',time()); 
$this->db->where('online_ip',$ip);			
$this->db->update('fabb_online');	
}
//---------------------------- insert online --------------------
public function insert_online($array)
{	 
$this->db->insert('fabb_online',$array);
}
//------------------------------- get member list --------------------------------------
public function get_data_member($sort,$tri,$limit,$page){
$this->db->select('member_id, member_pseudo,member_level, member_avatar, member_registred, member_post, member_last_visit, online_id');
$this->db->join('fabb_online', 'online_id = member_id', 'left');
$this->db->order_by($sort,$tri);
$this->db->limit($limit,$page);
return $this->db->get('fabb_members');
}	
//--------------------------------- is_member ----------------------------------
//Contrôle anti flood
public function is_memberId($id){
$this->db->select('*');
$this->db->where('member_id',$id);
$this->db->order_by('member_pseudo');
$this->db->limit(1);   
return $this->db->get('fabb_members')
->num_rows();			 
}				
//------------------------------------ is connected ------------------------------------------
public function is_connected($ip)
{
$this->db->select('online_id');
$this->db->where('online_ip',$ip); 
$this->db->order_by('online_id','DESC');
$this->db->limit(1);
$query=$this->db->get('fabb_online');
if($query->num_rows()>0)return true;else return false;
}
//------------------------------------ update_like_visitor -------------------------------
public function online_deleted($array)
{	
$this->db->set('online_id',$array['id']);
$this->db->set('online_time',time());
$this->db->set('online_country',$array['country']);
$this->db->set('online_city',$array['city']);
$this->db->set('online_code',$array['code']);
$this->db->set('online_platform',$array['platform']);
$this->db->set('online_browser',$array['agent']);
$this->db->where('online_ip',$array['ip']);
$this->db->update('fabb_online');
return $this->db->affected_rows();
}	
//--------------------------------- last visite -----------------------------------
public function update_last_visite($ip,$id){
$this->db->set('member_last_visit',time());
$this->db->set('member_ip',$ip);
$this->db->where('member_id',$id);			
return $this->db->update('fabb_members');
}	
//----------------------------------------------------------------------------------------------------
public function count_all_member(){	
return $this->db->count_all_results('fabb_members');
}
//------------------------------- member deconnexion ---------------------------------	
public function member_deconexion($id){	
$this->db->where('online_id',$id);
$this->db->delete('fabb_online');	
}	
//------------------------------------------ check email ---------------------------------------
public function check_email($id){	
$this->db->select('member_email');
$this->db->where('member_id !=',$id);
return $this->db->get('fabb_members');
}	
//------------------------------------- update member -------------------------
public function update_member($data) {
return($this->db->replace('fabb_members', $data));
}
//------------------------------------- login ----------------------------------
public function check_login($psw,$field){
$this->db->select('*');
$this->db->where('member_mdp',$psw);
$user=is_email($field);
if($user)
{
$this->db->where('member_email',$field);
} else {	   
$this->db->where('member_pseudo',$field);
}
return $this->db->get('fabb_members');
}	
//-------------------------------------------------------------------------------
public function get_id_friend($pseudo){
$this->db->select('member_id');
$this->db->where('member_pseudo',$pseudo);
return $this->db->get('fabb_members');
}	
//------------------------------ select amis from -------------------------------------------
public function select_amis_from($id,$id_friend){
$this->db->where('friend_from', $id);
$this->db->where('friend_to', $id_friend);
$this->db->or_where('friend_from', $id);
$this->db->where('friend_to', $id_friend);		
return $this->db->get('fabb_friends');
}
//--------------------------------------------- add amis ------------------------------
public function add_amis($array){
$this->db->insert('fabb_friends',$array);  
}
//------------------------------ list_friends --------------------------------------------
public function from_friends($id){	
$this->db->select('friend_to AS friend, friend_since, member_pseudo, online_id');
$this->db->join('fabb_members','member_id =friend_to','left');
$this->db->join('fabb_online','online_id = member_id','left');			 
$this->db->where('friend_from',$id);
$this->db->where('friend_confirm','1');
$this->db->order_by('member_pseudo');
return $this->db->get('fabb_friends');
}
//------------------------------ list_friends --------------------------------------------
public function stand_by($id){	
$this->db->select('friend_to AS friend, friend_since, member_pseudo, online_id');
$this->db->join('fabb_members','member_id =friend_to','left');
$this->db->join('fabb_online','online_id = member_id','left');			 
$this->db->where('friend_from',$id);
$this->db->where('friend_confirm','0');
$this->db->order_by('member_pseudo');
return $this->db->get('fabb_friends');
}
//----------------------------- count friends -----------------------------------
public function confirm_friends($id){	
$this->db->select('friend_from');
$this->db->where('friend_to',$id);
$this->db->where('friend_confirm', '0');
return $this->db->get('fabb_friends');
}
//----------------------------- count friends -----------------------------------
public function pending_friends($id){	
$this->db->select('friend_to');
$this->db->where('friend_to !=',$id);
$this->db->where('friend_confirm', '0');
return $this->db->get('fabb_friends');
}
//----------------------------- count friends -----------------------------------
public function total_from($id){	
$this->db->select('friend_from');
$this->db->where('friend_to',$id);
$this->db->where('friend_confirm', '1');		
return $this->db->get('fabb_friends');
}
//----------------------------- count friends -----------------------------------
public function total_to($id){	
$this->db->select('friend_to');
$this->db->where('friend_from',$id);
$this->db->where('friend_confirm', '1');		
return $this->db->get('fabb_friends');
}
//-------------------------------------------- select add amis ----------------------------------------
function unchecked_amis($id){
$this->db->select('friend_from,friend_since, member_pseudo');
$this->db->join('fabb_members', 'member_id=friend_from', 'left');
$this->db->where('friend_to',$id);		 
$this->db->where('friend_confirm','0');
return $this->db->get('fabb_friends');
}	
//-------------------------------------------- select add amis ----------------------------------------
function delete_account($id){
$this->db->set('member_level',2);
$this->db->where('member_id',$id);		
$this->db->update('fabb_members');
return $this->db->affected_rows();
}	
//-------------------------------------------- del_by_pseudo ----------------------------------------
function del_by_pseudo($pseudo){
$this->db->set('member_level',2);
$this->db->where('member_pseudo',$pseudo);		
if($this->db->update('fabb_members')){
return $this->db->affected_rows();}
else{return false;}
}	
//-------------------------------------------- del_by_pseudo ----------------------------------------
function isDeleted_pseudo($pseudo){
$this->db->select('member_level');
$this->db->where('member_pseudo',$pseudo);	
$this->db->limit(1);
return $this->db->get('fabb_members');
}
//---------------------------------------------- add user ----------------------------------
function add_users($data) {
$this->db->insert('fabb_members', $data);
return $this->db->insert_id();
}			 
//----------------------------------------- select admin ------------------------------
function admin_pseudo(){
$this->db->select('member_pseudo');
$this->db->where('member_level',6);		
$query=$this->db->get('fabb_members');
foreach($query->result() as $admin){
return $admin->member_pseudo;
}
}
//------------------------------------- forget psw ----------------------------------------------
public function forget_psw($email){	
$this->db->select('member_id, member_pseudo');
$this->db->where('member_email',$email);
$this->db->order_by('member_id');
$this->db->limit(1);			
return ($this->db->get('fabb_members'));
}			 
//------------------------------------------ update psw -----------------------------------
public function update_key($key,$mail){
$this->db->set('member_last_visit',time());
$this->db->set('member_key',$key);
$this->db->where('member_email',$mail);			
$this->db->update('fabb_members');
return $this->db->affected_rows();
}			 
//------------------------- confir email -----------------------------------------------------------
public function confirm_mail($key){
$this->db->select('*');					
$this->db->where('member_key',$key);						
return $this->db->get('fabb_members');
}			 
//----------------------------------- validate new member -----------------------------
public function validate_new_member($key){
$this->db->set('member_level',4,false);
$this->db->set('member_last_visit',time());				
$this->db->where('member_key',$key);
$this->db->update('fabb_members');
return $this->db->affected_rows();
}			 
//--------------------------------------- set new key ----------------------------------------
public function set_newkey($pseudo)
{
$this->db->set('member_key',sha1(microtime()));
$this->db->where('member_last_visit',time());
$this->db->where('member_pseudo',$pseudo);
$this->db->update('fabb_members');
}
//----------------------------- send welcome msg -----------------------------------------------
public function send_welcome_msg($data){
$this->db->insert('fabb_pmsgs', $data);
}
public function get_all_users() {
return $this->db->get('fabb_members');
} 
public function process_create_user($data) {
if ($this->db->insert($this->table, $data)) {
return true;
} else {
return false;
}
}
//-----------------------------------------------------------------------------------------------------------		
public function info_user($id){
$this->db->select('fabb_members.*, COUNT(topic_owner) AS tt_topic');
$this->db->join('fabb_topic', 'topic_owner = member_id', 'left');
$this->db->where('member_id',$id);
return $this->db->get('fabb_members');
}
//-------------------------------------------- select add amis ----------------------------------------
function select_add_amis($friend_id){
$query ='SELECT ami_from, ami_date, membre_pseudo 
FROM forum_amis
LEFT JOIN forum_membres ON membre_id = ami_from
WHERE ami_to ="'.$friend_id.'" AND ami_confirm = 0
ORDER BY ami_date DESC';
return $this->db->query($query);		   }
//--------------------------------- update add friend ------------------------------------------
function update_add_member($friend,$id){
$this->db->set('friend_confirm','1');
$this->db->where('friend_to',$friend);
$this->db->where('friend_from',$id);
if($this->db->update('fabb_friends')){
return TRUE;
}else return FALSE;
}
//------------------------------------- delete amis from ----------------------------------------------------
public function delete_ami_from($id,$ami){
$this->db->where('friend_from',$id);
$this->db->where('friend_to',$ami);
$this->db->where('friend_confirm','1');
return $this->db->delete('fabb_friends');
}
//------------------------------------- delete amis to ----------------------------------------------------
public function delete_pending_friend($id,$ami){
$this->db->where('friend_from',$id);
$this->db->where('friend_to',$ami);
$this->db->where('friend_confirm','0');
return $this->db->delete('fabb_friends');
}
//----------------------------------------- verif_key --------------------------------
public function verif_key($email){
$this->db->select('*');						
$this->db->where('member_email',$email);			
return ($this->db->get('fabb_members'));
}			
//------------------------------------------ update psw -----------------------------------
public function update_psw($psw,$key,$email){
$this->db->set('member_mdp',$psw);
$this->db->set('member_last_visit',time());
$this->db->set('member_key',$key);
$this->db->where('member_email',$email);			
$this->db->update('fabb_members');
return $this->db->affected_rows();
}
//------------------------------- register flood --------------------------------
public function register_flood($pseudo){
$this->db->select('member_last_visit');
$this->db->where('member_pseudo',$pseudo);
$this->db->order_by('member_pseudo');
return $this->db->get('fabb_members',0,1);
}
//------------------------------- new pasw flood --------------------------------
public function new_psw_flood($email){
$this->db->select('MAX(member_last_visit) AS last_visite');
$this->db->where('member_email',$email);
return $this->db->get('fabb_members');			 
}
//------------------------------------ last key -----------------------------------------------------
public function last_key($email){
$this->db->select('member_key');			
return ($this->db->get('fabb_members'));
}
//--------------------------------- search --------------------------------------
public function cherche($term) {
$this->db->select('fabb_topic.topic_id, fabb_topic.topic_title, 
post_id, post_time, post_owner, post_text,
member_avatar, member_pseudo, member_id');
$this->db->join('fabb_post', 'fabb_topic.topic_id = fabb_post.post_topic_id', 'left');		
$this->db->join('fabb_members', 'fabb_members.member_id = fabb_post.post_owner', 'left');
$this->db->like('topic_title',$term);				
return $this->db->get('fabb_topic');
} 
//------------------------------------------------------------------------------------------	
public function limitsearch($term,$offset,$pages) {
$this->db->select('fabb_topic.topic_id, fabb_topic.topic_title, 
post_id, post_time, post_owner, post_text,
member_avatar, member_pseudo, member_id, member_registred');
$this->db->join('fabb_post', 'fabb_topic.topic_id = fabb_post.post_topic_id', 'left');		
$this->db->join('fabb_members', 'fabb_members.member_id = fabb_post.post_owner', 'left');
$this->db->like('topic_title',$term);
$this->db->limit($offset,$pages);					
return $this->db->get('fabb_topic');
} 
//----------------------------------------------------------------------------------------	
public function search_post($id){
$this->db->select('post_text');
$this->db->where('post_id',$id);
return $this->db->get('fabb_post');
}
//--------------------------------- last visite -----------------------------------
public function reactivate_member($array){
$this->db->set('member_last_visit',time());
$this->db->set('member_key',$array['key']);
$this->db->set('member_ip',$array['ip']);
$this->db->set('member_level',$array['lvl']);
$this->db->where('member_id',$array['id']);			
$this->db->update('fabb_members');
return $this->db->affected_rows();
}	
//--------------------------------- last visite -----------------------------------
public function delete_oldflood(){
$this->db->where('flood_lastconxn >',time()-300,false);
$this->db->delete('fabb_flood');
return $this->db->affected_rows();
}	
//--------------------------------- last visite -----------------------------------
public function insert_flood($array){
$this->db->insert('fabb_flood',$array);	
}	
//--------------------------------- reply topic flood ----------------------------------
public function anti_flood($ip){
$this->db->select_max('flood_lastconxn');
$this->db->where('flood_ip',$ip);
$this->db->order_by('flood_lastconxn','DESC');
$this->db->limit(1);			  
return $this->db->get('fabb_flood');			 
}	
//--------------------------------- is_member ----------------------------------
public function is_member($pseudo){
$this->db->select('member_id');
$this->db->where('member_pseudo',$pseudo);
return $this->db->get('fabb_members')
->num_rows();			 
}		
//--------------------------------- is_inactif ----------------------------------
public function is_inactif($order,$tri){
$periode=$this->config_model->in_actif();
$time=time()-(2592000*$periode);
$this->db->select('*');
$this->db->where('member_last_visit <',$time);
$this->db->order_by($order,$tri);
return $this->db->get('fabb_members');
}					  		  				
//----------------------------------- testimo --------------------------------
public function testimo(){
$this->db->select('testimo_date, testimo_text, member_pseudo, member_avatar');
$this->db->join('fabb_members','fabb_testimo.testimo_idm=fabb_members.member_id','left');
$this->db->order_by('testimo_date','DESC');
return $this->db->get('fabb_testimo');		
}
//----------------------------------- testimo --------------------------------
public function new_testimo($array){
if ($this->db->insert('fabb_testimo', $array)) {
return TRUE;
} else {
return FALSE;
}
}
//--------------------------- check flood testmo ------------------------------------
public function duplicate_timeflood($id){
$this->db->select('testimo_date');
$this->db->where('testimo_idM',$id);
$this->db->order_by('testimo_date','DESC');
$this->db->limit('1');
$query=$this->db->get('fabb_testimo');
foreach($query->result() as $val):
$value= $val->testimo_date;
endforeach;
return $value;
}
//--------------------------------------------------------------
public function loop_email($mail){
$this->db->select('member_pseudo');
$this->db->where_in('member_email',$mail);
return $this->db->get('fabb_members');
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
//----------------------------------- total post idm --------------------
public function total_post_idm($id){
$this->db->select('post_id');
$this->db->where('post_owner',$id);
return $this->db->get('fabb_post')->num_rows();
}	
//----------------------------------- total topic idm --------------------
public function total_topic_idm($id){
$this->db->select('topic_id');
$this->db->where('topic_owner',$id);
return $this->db->get('fabb_topic')->num_rows();
}												
//----------------------------------- total topic idm --------------------
public function has_avatar($id){
$this->db->select('member_avatar');
$this->db->where('member_id',$id);
$this->db->limit(1);
$query=$this->db->get('fabb_members');
if($query->num_rows()>0){
foreach($query->result() as $avatar){
return $avatar->member_avatar;
}
}
return false;
}	
}//end class
