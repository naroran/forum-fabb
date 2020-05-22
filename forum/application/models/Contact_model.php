<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact_model extends CI_Model {
function __construct() {
parent::__construct();
}
//----------------------------- insert new msg -----------------------------------------------
public function insert_new_msg($data){
$this->db->insert('fabb_contact', $data);
return $this->db->insert_id();
}
//----------------------------- get report -----------------------------------------------
public function get_reports(){
$this->db->select('contact_id, contact_read, contact_object, contact_date, contact_idm, 
member_pseudo, online_id,member_level');
$this->db->join('fabb_members', 'fabb_contact.contact_idm = fabb_members.member_id','left');
$this->db->join('fabb_online','fabb_online.online_id = member_id','left');
$this->db->order_by('contact_id', 'DESC');
return $this->db->get('fabb_contact');
}
//----------------------------- get_message -----------------------------------------------
public function get_message($id){
$this->db->select('contact_idm, contact_object, contact_date, contact_text, contact_read, member_id, member_pseudo, member_avatar, member_location, member_registred, member_post, member_signature');
$this->db->join('fabb_members','member_id = contact_idm','left');
$this->db->where('contact_id',$id);
return $this->db->get('fabb_contact');
}
//----------------------------- get_message -----------------------------------------------
public function update_read($id){
$this->db->set('contact_read','1');
$this->db->where('contact_id', $id);
$this->db->update('fabb_contact');
}
//----------------------------------------------------------------
public function del_report($mess){
$this->db->where('contact_id',$mess);
$this->db->delete('fabb_contact');
return $this->db->affected_rows();
}
}//end class
