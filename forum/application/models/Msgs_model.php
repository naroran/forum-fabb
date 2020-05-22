<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msgs_model extends CI_Model {
function __construct() {
parent::__construct();
}
public function unread_msg($id){
$this->db->select('*');
$this->db->where('pmsg_recept',$id);
$this->db->where('pmsg_read','0');
return $this->db->get('fabb_pmsgs')->num_rows();
}
//----------------------------------- anti flood ----------------------------------------
public function msg_flood($id){
$this->db->select('pmsg_time');
$this->db->where('pmsg_sender',$id);
$this->db->order_by('pmsg_time ','DESC');
$this->db->limit(1);
return $this->db->get('fabb_pmsgs');			 
}
//----------------------------------- anti flood ----------------------------------------
public function check_flood($id,$act){
$this->db->select_max('flood_time');
if($id==0){
$this->db->where('flood_ip',$this->ip);
}else{
$this->db->where('flood_idm',$id);
}
$this->db->where('flood_act',$act);
$this->db->order_by('flood_time ','DESC');
$this->db->limit(1);
return $this->db->get('fabb_flood');			 
}	
//----------------------------------- insert flood ----------------------------------------
public function time_flood($id,$act){
$id=$id;
$act=$act;
$this->db->select('*');
if($id==0){
$this->db->where('flood_ip',$this->ip);
}else{
$this->db->where('flood_idm',$id);
}
$this->db->where('flood_act',$act);
return $this->db->get('fabb_flood');	
}				  		  
//----------------------------------- update flood ----------------------------------------
public function update_flood($id,$act){
$id=$id;
$act=$act;
$this->db->set('flood_time',time());
if($id==0){
$this->db->where('flood_ip',$this->ip);
}else{
$this->db->where('flood_idm',$id);
}
$this->db->where('flood_act',$act);
$this->db->update('fabb_flood');			 
}				  		  			  
//----------------------------------- insert flood ----------------------------------------
public function insert_flood($data){
return $this->db->insert('fabb_flood',$data);			 
}				  		  			  
//----------------------------------- has post ----------------------------------------
public function has_post($ip,$act){
$this->db->select('*');
$this->db->where('flood_ip',$ip);				 
$this->db->where('flood_act',$act);
return $this->db->get('fabb_flood')->num_rows();
}				  		  			  			  
//----------------------------------------------------------------------
public function get_user_pseudo($to){
$this->db->where('member_pseudo',$to);
$this->db->order_by('member_pseudo','DESC');
$this->db->limit(1);		 
return $this->db->get('fabb_members');
}
//-------------------------------- insert new msg ----------------------------
public function insert_new_msg($data){
return $this->db->insert('fabb_pmsgs',$data);
}
//----------------------------------------------------------------
public function delete_pm($mess){
$this->db->where('pmsg_id',$mess);
$this->db->delete('fabb_pmsgs');
return $this->db->affected_rows();
}
//--------------------------- edit flood ----------------------------
public function edit_flood(){
$this->db->select('config_valeur');
$this->db->where('config_nom','temps_flood');
return $this->db->get('forum_config');	
}
//----------------------------------------------------------------------------
public function get_all_msg($id){
$this->db->select('pmsg_read, pmsg_id, pmsg_sender, pmsg_object, pmsg_time, member_id, 
member_pseudo, online_id,member_level');
$this->db->join('fabb_members', 'fabb_pmsgs.pmsg_sender = fabb_members.member_id','left');
$this->db->join('fabb_online','fabb_online.online_id = member_id','left');
$this->db->where('pmsg_recept',$id);
$this->db->order_by('pmsg_id', 'DESC');
return $this->db->get('fabb_pmsgs');
}
//--------------------------------------------------------------------
public function ban_member($id){
$this->db->set('member_level',0);
$this->db->where('member_id',$id);			  
$this->db->update('fabb_members');
}
//----------------------------------- info message -------------------------------	
public function info_message($id_mess){
$this->db->select('pmsg_sender, pmsg_recept, pmsg_object, pmsg_time, pmsg_text, pmsg_read, member_id, member_pseudo, member_avatar, member_location, member_registred, member_post, member_signature');
$this->db->join('fabb_members','member_id = pmsg_sender','left');
$this->db->where('pmsg_id',$id_mess);
return $this->db->get('fabb_pmsgs');
}
//--------------------------------------------------
public function msg_is_read($id_mess){
$this->db->set('pmsg_read','1');
$this->db->where('pmsg_id', $id_mess);
$this->db->update('fabb_pmsgs');
}
//---------------------------------------------------
public function send_msg($data){
$this->db->insert('fabb_pmsgs', $data);	
}
public function user_by_id($id){
$this->db->select('*');
$this->db->where('member_id',$id);
$this->db->order_by('member_id');
$this->db->limit(1);
return $this->db->get('fabb_members');
}
}//end class
